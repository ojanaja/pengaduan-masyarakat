<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('User.landing');
    }

    public function login(Request $request)
    {
        $username = Masyarakat::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
        }

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];
        $remember = $request->has('remember');

        if (Auth::guard('masyarakats')->attempt($credentials, $remember)) {
            // Authentication passed
            return redirect()->route('pekat.index');
        } else {
            // Authentication failed
            return redirect()->back()->withInput()->with(['pesan' => 'Login failed!']);
        }
    }

    public function formRegister()
    {
        return view('User.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'nik' => ['required'],
            'nama' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'no_telp' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with(['pesan' => $validate->errors()]);
        }

        $nik = Masyarakat::where('nik', $request->nik)->first();

        if ($nik) {
            return redirect()->back()->with(['pesan' => 'NIK sudah terdaftar']);
        }

        $username = Masyarakat::where('username', $request->username)->first();

        if ($username) {
            return redirect()->back()->with(['pesan' => 'Username sudah terdaftar']);
        }

        Masyarakat::create([
            'nik' => $data['nik'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'no_telp' => $data['no_telp'],
        ]);

        return redirect()->route('pekat.index');
    }

    public function logout()
    {
        Auth::guard('masyarakats')->logout();

        return redirect()->back();
    }

    public function storePengaduan(Request $request)
    {
        if (!Auth::guard('masyarakats')->user()) {
            return redirect()->route('pekat.index', '#loginModal')->with(['pesan' => 'Login dibutuhkan!'])->withInput();
        }

        $data = $request->all();

        $validate = Validator::make($data, [
            'isi_laporan' => ['required'],
            'judul_laporan' => ['required'],
            'kategori_laporan' => ['required']
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }

        if ($request->file('foto_laporan')) {
            $data['foto_laporan'] = $request->file('foto_laporan')->store('assets/pengaduan', 'public');
        }

        date_default_timezone_set('Asia/Bangkok');

        $pengaduan = Pengaduan::create([
            'tgl_pengaduan' => now(),
            'nik' => Auth::guard('masyarakats')->user()->nik,
            'kategori_laporan' => $data['kategori_laporan'],
            'judul_laporan' => $data['judul_laporan'],
            'isi_laporan' => $data['isi_laporan'],
            'foto_laporan' => $data['foto_laporan'] ?? null,
            'status' => '0',
        ]);

        if ($pengaduan) {
            return redirect()->route('pekat.laporan', 'me')->with(['pengaduan' => 'Berhasil terkirim!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['pengaduan' => 'Gagal terkirim!', 'type' => 'danger']);
        }
    }

    public function laporan($siapa = '')
    {
        $terverifikasi = Pengaduan::where([['nik', optional(Auth::guard('masyarakats')->user())->nik], ['status', '!=', '0']])->get()->count();
        $proses = Pengaduan::where([['nik', optional(Auth::guard('masyarakats')->user())->nik], ['status', 'proses']])->get()->count();
        $selesai = Pengaduan::where([['nik', optional(Auth::guard('masyarakats')->user())->nik], ['status', 'selesai']])->get()->count();

        $hitung = [$terverifikasi, $proses, $selesai];

        if ($siapa == 'me') {
            $pengaduan = Pengaduan::where('nik', optional(Auth::guard('masyarakats')->user())->nik)
                ->whereIn('status', ['proses', '0'])
                ->orderBy('tgl_pengaduan', 'desc')
                ->get();

            return view('User.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
        } else
            if ($siapa == 'selesai') {
                $pengaduan = Pengaduan::where('nik', optional(Auth::guard('masyarakats')->user())->nik)
                    ->whereIn('status', ['selesai'])
                    ->orderBy('tgl_pengaduan', 'desc')
                    ->get();

                return view('User.laporan', ['pengaduan' => $pengaduan, 'hitung' => $hitung, 'siapa' => $siapa]);
            }
    }

    public function cetakLaporanIndividu($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);

        $pdf = \PDF::loadView('User.cetak-individu', ['pengaduan' => $pengaduan]);
        return $pdf->download('laporan-pengaduan-individu.pdf');
    }

    public function formUpdate()
    {
        return view('User.lupaPassword');
    }

    public function update(Request $request)
    {
        $nik = $request->input('nik');
        $username = $request->input('username');
        $masyarakat = Masyarakat::where('nik', $nik)->where('username', $username)->first();

        if (!$masyarakat) {
            return redirect()->back()->with(['pesan' => 'Invalid NIK or Username']);
        }

        $masyarakat->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

        return redirect()->route('pekat.index');
    }
}

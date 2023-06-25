<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok');

        $pengaduan = Pengaduan::where('id_pengaduan', $request->id_pengaduan)->first();
        $tanggapan = Tanggapan::where('id_pengaduan', $request->id_pengaduan)->first();

        $pengaduan->update(['status' => $request->status]);
        $tanggapan = Tanggapan::create([
            'id_pengaduan' => $request->id_pengaduan,
            'tgl_tanggapan' => date('Y-m-d'),
            'tanggapan' => $request->tanggapan,
            'id_petugas' => Auth::guard('admins')->user()->id_petugas,
        ]);
        return redirect()->route('pengaduan.show', $pengaduan->id_pengaduan)->with(['status' => 'Berhasil Dikirim!']);
    }

    public function show($id_pengaduan)
    {
        $pengaduan = Pengaduan::with('tanggapan.petugas')->where('id_pengaduan', $id_pengaduan)->firstOrFail();

        return view('pengaduan.show', ['pengaduan' => $pengaduan]);
    }
}

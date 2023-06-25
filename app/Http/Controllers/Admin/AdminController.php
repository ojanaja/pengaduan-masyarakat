<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function formLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = Petugas::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak terdaftar']);
        }

        $auth = Auth::guard('admins')->attempt(['username' => $request->username, 'password' => $request->password]);

        if ($auth) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar']);
        }
    }

    public function logout()
    {
        Auth::guard('admins')->logout();

        return redirect()->route('admin.formLogin');
    }
}

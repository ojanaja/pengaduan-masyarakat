<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    public function index()
    {
        $masyarakat = Masyarakat::all();

        return view('admin.Masyarakat.index', ['masyarakat' => $masyarakat]);
    }

    public function show($nik)
    {
        $masyarakat = Masyarakat::where('nik', $nik)->FirstorFail();

        if (!$masyarakat) {
            abort(404);
        }

        return view('admin.Masyarakat.show', ['masyarakat' => $masyarakat]);
    }
}

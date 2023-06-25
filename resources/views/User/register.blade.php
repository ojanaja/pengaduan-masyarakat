@extends('layouts.user')

@section('css')
    <style>
        body {
            background: #000000;
        }

        .btn-purple {
            background: #000000;
            width: 100%;
            border: 1px solid #ffffff;
            color: #fff;
        }
    </style>
@endsection

<head>
    <title>SINAR - Register</title>
    <link rel="icon" href="../images/logo.png" type="image/x-icon" style="width: 100px; height: 100px;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <h2 class="text-center text-white mb-0 mt-5">SINAR</h2>
                <P class="text-center text-white mb-5">Sistem Informasi Pengaduan Masyarakat</P>
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="text-center mb-5">FORM DAFTAR</h2>
                        <form action="{{ route('pekat.register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="number" name="nik" placeholder="NIK" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Username" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="number" name="no_telp" placeholder="No. Telp" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-purple">REGISTER</button>
                        </form>
                    </div>
                </div>
                @if (Session::has('pesan'))
                    <div class="alert alert-danger mt-2">
                        {{ Session::get('pesan') }}
                    </div>
                @endif
                <a href="{{ route('pekat.index') }}" class="btn btn-purple text-white mt-3"
                    style="width: 100%; font-weight: 500;">Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.user')

@section('css')
    <style>
        body {
            background: #000000;
        }

        .btn-purple {
            background: #000000;
            width: 100%;
            color: #fff;
        }

        .btn-white {
            background: #fff;
            width: 100%;
            color: #000;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <h2 class="text-center text-white mb-0 mt-5">SINAR</h2>
                <P class="text-center text-white mb-5">Sistem Informasi Pengaduan Masyarakat</P>
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="text-center mb-5">Lupa Password</h2>
                        <form action="{{ route('pekat.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="nik" placeholder="NIK" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Username" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" name="new_password" placeholder="New Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" placeholder="Confirm New Password"
                                    class="form-control">
                            </div>
                            <button type="submit" class="btn btn-purple">Reset Password</button>
                        </form>
                    </div>

                </div>
                @if (Session::has('pesan'))
                    <div class="alert alert-danger mt-2">
                        {{ Session::get('pesan') }}
                    </div>
                @endif
                <a href="{{ route('pekat.index') }}" class="btn btn-white text-black mt-3"
                    style="width: 100%; font-weight: 500;">Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
@endsection

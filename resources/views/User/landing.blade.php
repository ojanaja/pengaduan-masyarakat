@extends('layouts.user')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <style>
        .btn-purple {
            background-color: #000000 !important;
            color: #fff !important;
            border: none !important;
            max-width: 25%;
        }
    </style>
@endsection

{{-- @section('title', 'SINAR - Sistem Informasi Pengaduan Masyarakat') --}}

<head>
    <title>SINAR - Sistem Informasi Pengaduan Masyarakat</title>
    <link rel="icon" href="../images/logo.png" type="image/x-icon" style="width: 100px; height: 100px;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


@section('content')
    {{-- Section Header --}}
    <section class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
            <div class="container">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('pekat.index') }}">
                        {{-- <h4 class="semi-bold mb-0 text-white">SINAR</h4>
                        <p class="italic mt-0 text-white"></p> --}}
                        <h4>
                            <img src="../images/logo-side.png" class="logo">
                        </h4>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        @if (Auth::guard('masyarakats')->check())
                            <ul class="navbar-nav text-center ml-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle ml-3 text-white" href="#" id="navbarDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::guard('masyarakats')->user()->nama }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('pekat.laporan', 'me') }}">Profile</a>
                                        <a class="dropdown-item" href="{{ route('pekat.logout') }}">Sign Out</a>
                                    </div>
                                </li>

                            </ul>
                        @else
                            <ul class="navbar-nav text-center ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link ml-3 text-white" href="#" data-toggle="modal"
                                        data-target="#aboutModal">Tentang SINAR</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white mr-1" href="#" data-toggle="modal"
                                        data-target="#loginModal">Masuk</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pekat.formRegister') }}" class="btn btn-outline-purple">Daftar</a>
                                </li>
                            </ul>
                        @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="text-center">
        <h2 class="medium text-white mt-3">Sistem Informasi Pengaduan Masyarakat</h2>
        <p class="italic text-white mb-5">Sampaikan laporan Anda kepada pemerintah Kabupaten Pemalang</p>
    </div>

    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>
</section>
{{-- Section Card Pengaduan --}}
<div class="row justify-content-center">
    <div class="col-lg-6 col-10 col">
        <div class="content shadow">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            @if (Session::has('pengaduan'))
                <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
            @endif

            <div class="card mb-3">Tulis Laporan Disini</div>

            <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <select name="kategori_laporan" class="form-control" required>
                        <option value="">Pilih Kategori Laporan</option>
                        <option value="Keamanan & Kriminalitas">Keamanan & Kriminalitas</option>
                        <option value="Lingkungan & Kebencanaan">Lingkungan & Kebencanaan</option>
                        <option value="Infrastruktur & Fasilitas Umum">Infrastruktur & Fasilitas Umum</option>
                        <option value="Pelayanan Publik">Pelayanan Publik</option>
                        <option value="Ketertiban Umum">Ketertiban Umum</option>
                        <option value="Korupsi & Penyalahgunaan Kekuasaan">Korupsi & Penyalahgunaan Kekuasaan</option>
                        <option value="Kesehatan & Sanitasi">Kesehatan & Sanitasi</option>
                        <option value="Lalu Lintas & Transportasi">Lalu Lintas & Transportasi</option>
                        <option value="Sosial & Kemanusiaan">Sosial & Kemanusiaan</option>
                        <option value="Penyalahgunaan Narkoba">Penyalahgunaan Narkoba</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="judul_laporan" placeholder="Masukkan Judul Laporan" class="form-control"
                        rows="4" value="{{ old('judul_laporan') }}" required>
                </div>
                <div class="form-group">
                    <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control" rows="4" required>{{ old('isi_laporan') }} </textarea>
                </div>
                <div class="form-group">
                    <input type="file" name="foto_laporan" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-custom mt-2">Kirim</button>
            </form>
        </div>
    </div>
</div>
{{-- Section Hitung Pengaduan --}}
@php
    use App\Models\Pengaduan;
@endphp
<div class="pengaduan mt-5">
    <div class="bg-purple">
        <div class="text-center">
            <h5 class="medium text-white mt-3">JUMLAH LAPORAN SEKARANG</h5>
            <p style="font-size: 18px; color:white;">{{ \App\Models\Pengaduan::count() }}</p>
        </div>
    </div>
</div>

{{-- Footer --}}
<div class="mt-5">
    <hr>
    <div class="text-center">
        <p class="italic text-secondary">© Kelompok 4</p>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="mt-3">Masuk terlebih dahulu</h3>
                <p>Silahkan masuk menggunakan akun yang sudah didaftarkan.</p>
                <form action="{{ route('pekat.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-purple text-white mt-1"
                            style="width: 100%">MASUK</button>
                        <a href="{{ route('pekat.formUpdate') }}" class="text-right font-weight-light">Lupa
                            Password?</a>
                    </div>
                </form>
                @if (Session::has('pesan'))
                    <div class="alert alert-danger mt-2">
                        {{ Session::get('pesan') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutModalLabel">Tentang SINAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your content here -->
                <p style="font-weight: 500; color: black">Sistem Informasi Pengaduan Masyarakat adalah suatu sistem
                    yang dirancang
                    untuk memudahkan
                    masyarakat dalam melaporkan masalah atau keluhan terkait dengan pelayanan publik, keamanan,
                    lingkungan, atau hal-hal lain yang memerlukan perhatian dari pihak berwenang. Sistem ini
                    memungkinkan masyarakat untuk mengirimkan pengaduan melalui platform digital yakni website, sehingga
                    mereka dapat dengan mudah menyampaikan keluhan atau masalah yang mereka
                    hadapi.</p>
                <p style="font-weight: 500; color:black">Website ini dibuat oleh Kelompok 4 yang beranggotakan</p>
                <ol>
                    <li>Fauzan (1217050054)</li>
                    <li>Haikal Mufid Mubarok (1217050059)</li>
                    <li>Iqbalul Hidayatus Sholihin Al Jauhar (1217050069)</li>
                    <li>Mochammad Rizky Ramadhani (1217050081)</li>
                    <li>Muhammad Dzikri (1217050090)</li>
                    <li>Muhammad Faiz Robbany (1217050092)</li>
                    <li>Muhammad Fakhri Fakhruddin (1217050093)</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-purple" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@if (Session::has('pesan'))
    <script>
        $('#loginModal').modal('show');
    </script>
@endif
@endsection

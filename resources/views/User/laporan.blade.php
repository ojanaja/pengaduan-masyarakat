@extends('layouts.user')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
@endsection

{{-- @section('title', 'SINAR - Sistem Informasi Pengaduan Masyarakat') --}}

<head>
    <title>SINAR - Sistem Informasi Pengaduan Masyarakat</title>
    <link rel="icon" href="../images/logo.png" type="image/x-icon" style="width: 100px; height: 100px;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
    .btn-purple {
        background: #000000 !important;
        border: 1px solid #000000 !important;
        color: #ffffff !important;
    }

    .btn-purple:hover {
        background: #000000 !important;
        border: 1px solid #000000 !important;
        color: #ffffff !important;
    }
</style>

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
                                {{-- <li class="nav-item">
                                        <a class="nav-link ml-3 text-white" href="{{ route('pekat.laporan') }}">Laporan</a>
                                    </li> --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link ml-3 text-white dropdown-toggle" href="#" id="navbarDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::guard('masyarakats')->user()->nama }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('pekat.logout') }}">Sign Out</a>
                                    </div>

                                    <form id="logout-form" action="{{ route('pekat.logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @else
                            <ul class="navbar-nav text-center ml-auto">
                                <li class="nav-item">
                                    <button class="btn text-white" type="button" class="btn btn-primary"
                                        data-toggle="modal" data-target="#loginModal">Masuk</button>
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
</section>
{{-- Section Card --}}
<div class="container">
    <div class="row justify-content-between">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 col">
            <div class="content content-top shadow">
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
                            <option value="Korupsi & Penyalahgunaan Kekuasaan">Korupsi & Penyalahgunaan Kekuasaan
                            </option>
                            <option value="Kesehatan & Sanitasi">Kesehatan & Sanitasi</option>
                            <option value="Lalu Lintas & Transportasi">Lalu Lintas & Transportasi</option>
                            <option value="Sosial & Kemanusiaan">Sosial & Kemanusiaan</option>
                            <option value="Penyalahgunaan Narkoba">Penyalahgunaan Narkoba</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="judul_laporan" placeholder="Masukkan Judul Laporan"
                            class="form-control" rows="4" value="{{ old('judul_laporan') }}" required>
                    </div>
                    <div class="form-group">
                        <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control" rows="4" required>{{ old('isi_laporan') }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="foto_laporan" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-custom mt-2">Kirim</button>
                </form>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-12 col">
            <div class="content content-bottom shadow">
                <div>
                    <img src="{{ asset('images/user_default.png') }}" alt="user profile" class="photo">
                    <div class="self-align">
                        <h5><a style="color: #000" href="#">{{ Auth::guard('masyarakats')->user()->nama }}</a>
                        </h5>
                        <p class="text-dark">{{ Auth::guard('masyarakats')->user()->username }}</p>
                    </div>
                    <div class="row text-center">
                        <div class="col">
                            <p class="italic mb-0">Terverifikasi</p>
                            <div class="text-center">
                                {{ $hitung[0] }}
                            </div>
                        </div>
                        <div class="col">
                            <p class="italic mb-0">Proses</p>
                            <div class="text-center">
                                {{ $hitung[1] }}
                            </div>
                        </div>
                        <div class="col">
                            <p class="italic mb-0">Selesai</p>
                            <div class="text-center">
                                {{ $hitung[2] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row ml-1 mt-5 mb-4">
        <div class="">
            <a class="d-inline tab {{ $siapa == 'me' ? 'tab-active' : '' }}"
                href="{{ route('pekat.laporan', 'me') }}">
                Status Laporan
            </a>
        </div>
        <div class="ml-3">
            <a class="d-inline tab {{ $siapa == 'selesai' ? 'tab-active' : '' }} mr-4"
                href="{{ route('pekat.laporan', 'selesai') }}">
                Laporan Selesai
            </a>
        </div>

    </div>
    @foreach ($pengaduan as $k => $v)
        <div class="col-lg-8">
            <div class="laporan-top">
                <img src="{{ asset('images/user_default.png') }}" alt="profile" class="profile">
                <div class="d-flex justify-content-between">
                    <div>
                        <p>{{ $v->user->nama }}</p>
                        @if ($v->status == '0')
                            <a class="btn btn-danger btn-sm">Pending</a>
                        @elseif($v->status == 'proses')
                            <a class="btn btn-warning btn-sm text-white">{{ ucwords($v->status) }}</a>
                        @else
                            <a class="btn btn-success btn-sm">{{ ucwords($v->status) }}</a>
                        @endif
                    </div>
                    <div>
                        <p>{{ \Carbon\Carbon::parse($v->tgl_pengaduan)->format('d M, h:i') }}</p>

                    </div>
                </div>
            </div>
            <div class="laporan-mid">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="judul-laporan" style="color: #000">
                        {{ $v->judul_laporan }}
                    </div>
                    <button type="button" class="btn btn-purple" data-toggle="modal"
                        data-target="#laporanModal{{ $v->id_pengaduan }}">
                        Lihat Detail
                    </button>

                </div>
            </div>
            <div class="modal fade" id="laporanModal{{ $v->id_pengaduan }}" tabindex="-1" role="dialog"
                aria-labelledby="laporanModalLabel{{ $v->id_pengaduan }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="laporanModalLabel{{ $v->id_pengaduan }}">Detail Laporan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="judul-laporan">
                                {{ $v->judul_laporan }}
                            </div>
                            <p>{{ $v->kategori_laporan }}</p>
                            <p>{{ $v->isi_laporan }}</p>
                            <img src="{{ Storage::url($v->foto_laporan) }}" class="gambar-lampiran"
                                style="width: 100%; max-height: auto;">

                            @php
                                $tanggapan = $v->tanggapan()->get();
                            @endphp
                            <div>
                                <br>
                                <strong style="font-size: 18px mb-3">Riwayat Tanggapan</strong>
                                @if ($tanggapan->isNotEmpty())
                                    @foreach ($tanggapan as $response)
                                        <br>
                                        <span class="light">{{ $response->updated_at->format('d/m/Y H:i') }}</span>
                                        <p class="mb-2" style="font-size: 17px; font-weight: bold; color: #000">
                                            {{ $response->tanggapan }}</p>
                                    @endforeach
                                @else
                                    <p>Tidak ada tanggapan</p>
                                @endif
                                @if ($v->status == 'selesai')
                                    <a href="{{ url('/user/cetak-laporan-individu/' . $v->id_pengaduan) }}"
                                        class="btn btn-purple" style="width: 25%">Export PDF</a>
                                @endif
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-purple" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
{{-- Footer --}}
<div class="mt-5">
    <hr>
    <div class="text-center">
        <p class="italic text-secondary">© Kelompok 4</p>
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

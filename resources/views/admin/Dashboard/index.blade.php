@extends('layouts.admin')

<head>
    <title>SINAR - Halaman Dashboard</title>
    <link rel="icon" href="../images/logo.png" type="image/x-icon" style="width: 100px; height: 100px;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

@section('header', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card-header">Petugas</div>
            <div class="card-body">
                <div class="text-center">
                    {{ $petugas }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card-header">Masyarakat</div>
            <div class="card-body">
                <div class="text-center">
                    {{ $masyarakat }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card-header">Pengaduan Pending</div>
            <div class="card-body">
                <div class="text-center">
                    {{ $pengaduan }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card-header">Pengaduan Proses</div>
            <div class="card-body">
                <div class="text-center">
                    {{ $proses }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card-header">Pengaduan Selesai</div>
            <div class="card-body">
                <div class="text-center">
                    {{ $selesai }}
                </div>
            </div>
        </div>
    </div>
@endsection

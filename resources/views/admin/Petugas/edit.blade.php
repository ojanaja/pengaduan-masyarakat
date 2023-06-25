@extends('layouts.admin')

<head>
    <title>SINAR - Form Edit Petugas</title>
    <link rel="icon" href="../images/logo.png" type="image/x-icon" style="width: 100px; height: 100px;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

@section('css')
    <style>
        .text-primary:hover {
            text-decoration: underline;
        }

        .text-grey {
            color: #6c757d;
        }

        .text-grey:hover {
            color: #6c757d;
        }
    </style>
@endsection

@section('header')
    {{-- <a href="{{ route('pengaduan.index') }}" class="text-primary">Data Pengaduan</a> --}}
    <a href="#" class="text-grey"></a>
    <a href="#" class="text-grey">Form Edit Petugas</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    Form Edit Petugas
                </div>
                <div class="card-body">
                    <form action="{{ route('petugas.update', $petugas->id_petugas) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="nama_petugas">Nama Petugas</label>
                            <input type="text" value="{{ $petugas->nama_petugas }}" name="nama_petugas" id="nama_petugas"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_petugas">Username</label>
                            <input type="text" value="{{ $petugas->username }}" name="username" id="username"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_petugas">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_petugas">No. Telp</label>
                            <input type="number" value="{{ $petugas->no_telp }}" name="no_telp" id="no_telp"
                                class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <div class="input-group mt-3">
                                <select name="level" id="level" class="custom-select">
                                    @if ($petugas->level == 'admin')
                                        <option selected value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                    @else
                                        <option value="admin">Admin</option>
                                        <option selected value="petugas">Petugas</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        {{-- <button type="submit" class="btn btn-warning text-white" style="width: 100%">UPDATE</button> --}}
                    </form>
                    <form action="{{ route('petugas.destroy', $petugas->id_petugas) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2">HAPUS</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

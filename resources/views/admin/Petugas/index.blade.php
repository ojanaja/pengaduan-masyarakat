@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

<head>
    <title>SINAR - Data Petugas</title>
    <link rel="icon" href="../images/logo.png" type="image/x-icon" style="width: 100px; height: 100px;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

@section('header', 'Data Petugas')

@section('content')
    <a href="{{ route('petugas.create') }}" class="btn btn-purple mb-2">Tambah Petugas</a>
    <table id="petugasTable" class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Petugas</th>
                <th>Username</th>
                <th>No. Telp</th>
                <th>Level</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($petugas as $k => $v)
                <tr>
                    <td>{{ $k += 1 }}</td>
                    <td>{{ $v->nama_petugas }}</td>
                    <td>{{ $v->username }}</td>
                    <td>{{ $v->no_telp }}</td>
                    <td>{{ $v->level }}</td>
                    <td><a href="{{ route('petugas.edit', $v->id_petugas) }}" style="text-decoration: underline">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#petugasTable').DataTable();
        });
    </script>
@endsection

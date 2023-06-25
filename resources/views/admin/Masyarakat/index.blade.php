@extends('layouts.admin')


@section('header', 'Data Masyarakat')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

<head>
    <title>SINAR - Data Masyarakat</title>
    <link rel="icon" href="../images/logo.png" type="image/x-icon" style="width: 100px; height: 100px;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

@section('content')
    <table id="masyarakatTable" class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Username</th>
                <th>No. Telp</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($masyarakat as $k => $v)
                <tr>
                    <td>{{ $k += 1 }}</td>
                    <td>{{ $v->nik }}</td>
                    <td>{{ $v->nama }}</td>
                    <td>{{ $v->username }}</td>
                    <td>{{ $v->no_telp }}</td>
                    <td><a href="{{ route('masyarakat.show', $v->nik) }}" style="text-decoration: underline">Lihat</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#masyarakatTable').DataTable();
        });
    </script>
@endsection

@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('header', 'Data Pengaduan')

<head>
    <title>SINAR - Data Pengaduan</title>
    <link rel="icon" href="../images/logo.png" type="image/x-icon" style="width: 100px; height: 100px;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

@section('content')
    <table id="pengaduanTable" class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Judul Laporan</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $k => $v)
                <tr>
                    <td>{{ $k += 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($v->tgl_pengaduan)->format('d-M-Y') }}</td>
                    <td>{{ $v->judul_laporan }}</td>
                    <td>
                        @if ($v->status == '0')
                            <button class="btn btn-danger btn-sm">Pending</button>
                        @elseif ($v->status == 'proses')
                            <button class="btn btn-warning text-white btn-sm">Proses</button>
                        @else
                            <button class="btn btn-success btn-sm">Selesai</button>
                        @endif
                    </td>
                    <td><a href="{{ route('pengaduan.show', $v->id_pengaduan) }}"
                            style="text-decoration: underline">Lihat</a>
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
            $('#pengaduanTable').DataTable();
        });
    </script>
@endsection

@extends('layouts.admin')

<head>
    <title>SINAR - Laporan Masyarakat</title>
    <link rel="icon" href="../images/logo.png" type="image/x-icon" style="width: 100px; height: 100px;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

@section('header', 'Laporan Masyarakat')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header">
                    Cari Berdasarkan Tanggal
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.getLaporan') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="from" id="form-control" placeholder="Tanggal Awal"
                                onfocusin="(this.type='date')" onfocusout="this.type='text'">
                        </div>
                        <div class="form-group">
                            <input type="text" name="to" id="form-control" placeholder="Tanggal Akhir"
                                onfocusin="(this.type='date')" onfocusout="this.type='text'">
                        </div>
                        <button type="submit" class="btn btn-purple" style="width: 25%">Cari Laporan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-header">
                    Data Berdasarkan Tanggal
                    <div class="float-right">
                        @if ($pengaduan ?? '')
                            <a href="{{ route('laporan.cetakLaporan', ['from' => $from, 'to' => $to]) }}"
                                class="btn btn-danger">EXPORT PDF</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if ($pengaduan ?? '')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Judul Laporan</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaduan as $k => $v)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td>{{ $v->tgl_pengaduan }}</td>
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
                                        <td>
                                            <a href="{{ route('laporan.cetakLaporanIndividu', ['id_pengaduan' => $v->id_pengaduan]) }}"
                                                class="btn btn-primary btn-sm">Export PDF</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">
                            Tidak ada data
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

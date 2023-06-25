<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Laporan Pengaduan</title>


<body>
    <div class="text-center">
        <h5>Laporan Pengaduan Masyarakat</h5>
    </div>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>NIK</th>
                    <th>Judul Laporan</th>
                    <th>Kategori Laporan</th>
                    <th>Isi Laporan</th>
                    <th>Status</th>
                    <th>Foto Laporan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ \Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->format('d-M-Y') }}</td>
                    <td>{{ $pengaduan->nik }}</td>
                    <td>{{ $pengaduan->judul_laporan }}</td>
                    <td>{{ $pengaduan->kategori_laporan }}</td>
                    <td>{{ $pengaduan->isi_laporan }}</td>
                    <td>{{ $pengaduan->status == '0' ? 'Pending' : ucwords($pengaduan->status) }}</td>
                    <td><img src="{{ public_path('storage/' . $pengaduan->foto_laporan) }}" class="gambar-lampiran"
                            style="width: 100px; max-height: auto;"></td>
                </tr>
            </tbody>
        </table>
    </div>
    </head>
    <style>
        @page {
            size: landscape;
            /* Specify the paper size (e.g., A4, Letter, etc.) */
            margin: 10mm;
            /* Set the margins (e.g., top, right, bottom, left) */
        }
    </style>
</body>

</html>

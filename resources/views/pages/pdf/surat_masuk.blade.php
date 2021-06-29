<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Surat</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            width : 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        table thead tr {
            background-color: #009879;
            color: #ffffff;
        }

        table th,
        table td {
            padding: 12px 15px;
        }

        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

    </style>
</head>

<body>
    <h1>Daftar Surat</h1>

    <table>
        <thead>
            <tr>
                <th width="15%">#</th>
                <th style="text-align: left">Surat</th>
                <th style="text-align: left">Pengirim</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data_surat_masuk as $surat_masuk)
                <tr>
                    <td>
                        <img src="{{ $surat_masuk->gambar }}" alt="" width="50">
                    </td>
                    <td style="vertical-align: middle">
                        <strong>{{ $surat_masuk->nomor_surat }}</strong><br>
                        Tanggal Surat : {{ date('d M Y', strtotime($surat_masuk->tanggal_surat)) }}
                    </td>
                    <td style="vertical-align: middle">{{ $surat_masuk->pengirim }}</td>
                </tr>
            @empty
                <tr>
                    <td style="text-align: center" colspan="3">Tidak ada data</td>
                </tr>                
            @endforelse
        </tbody>
    </table>
</body>

</html>

{{-- filepath: /Users/febriantok29/Data/Academics/Semester_5/6. Pemrograman Web Lanjut/asset_management/resources/views/reports/location_transfers/location_transfers_pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transfer Lokasi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan Transfer Lokasi</h1>
    <table>
        <thead>
            <tr>
                <th>Kode Transfer</th>
                <th>Nama Aset</th>
                <th>Lokasi Asal</th>
                <th>Lokasi Tujuan</th>
                <th>Jumlah</th>
                <th>Tanggal Transfer</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $transfer)
            <tr>
                <td>{{ $transfer->transfer_code }}</td>
                <td>{{ $transfer->asset->name }}</td>
                <td>{{ $transfer->fromLocation->name }}</td>
                <td>{{ $transfer->toLocation->name }}</td>
                <td>{{ $transfer->quantity }}</td>
                <td>{{ $transfer->formatted_transfer_date }}</td>
                <td>{{ $transfer->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
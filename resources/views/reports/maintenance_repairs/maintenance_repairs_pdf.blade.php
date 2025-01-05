{{-- filepath: /d:/BimBim/Data/Kuliah/website/asset_management/resources/views/reports/maintenance_repairs/maintenance_repairs_pdf.blade.php --}}
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Perbaikan dan Pemeliharaan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Laporan Perbaikan dan Pemeliharaan</h1>
    <table>
        <thead>
            <tr>
                <th>Kode Pemeliharaan</th>
                <th>Nama Aset</th>
                <th>Tanggal Pemeliharaan</th>
                <th>Masalah</th>
                <th>Teknisi</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $maintenance)
                <tr>
                    <td>{{ $maintenance->maintenance_code }}</td>
                    <td>{{ $maintenance->asset->name }}</td>
                    <td>{{ $maintenance->formatted_maintenance_date }}</td>
                    <td>{{ $maintenance->issue }}</td>
                    <td>{{ $maintenance->technician }}</td>
                    <td>{{ $maintenance->formatted_cost }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

{{-- filepath: /Users/febriantok29/Data/Academics/Semester_5/6. Pemrograman Web Lanjut/asset_management/resources/views/reports/vendor_purchases/vendor_purchases_pdf.blade.php --}}
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pembelian Vendor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

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

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan Pembelian Vendor</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Vendor</th>
                <th>Total Pembelian</th>
                <th>Pembelian Terakhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $vendor)
                <tr>
                    <td>{{ $vendor->id }}</td>
                    <td>{{ $vendor->name }}</td>
                    <td>{{ $vendor->purchases_count }}</td>
                    <td>{{ $vendor->last_purchase_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

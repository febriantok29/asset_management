@@ -1,56 +0,0 @@
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Ringkasan Aset</title>
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
    <h1>Laporan Ringkasan Aset</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Lokasi</th>
                <th>Tanggal Pembelian Terakhir</th>
                <th>Total Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $asset)
                <tr>
                    <td>{{ $asset->id }}</td>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->category->name }}</td>
                    <td>{{ $asset->stock }}</td>
                    <td>{{ $asset->location->name }}</td>
                    <td>{{ optional($asset->latestPurchase)->formatted_purchase_date }}</td>
                    <td>{{ optional($asset->latestPurchase)->formatted_total_cost }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

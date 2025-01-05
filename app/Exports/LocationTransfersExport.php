<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Transaction\AssetTransfer;

class LocationTransfersExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AssetTransfer::with('asset', 'fromLocation', 'toLocation')->get()->map(function ($transfer) {
            return [
                'transfer_code' => $transfer->transfer_code,
                'asset_name' => $transfer->asset->name,
                'from_location' => $transfer->fromLocation->name,
                'to_location' => $transfer->toLocation->name,
                'quantity' => $transfer->quantity,
                'transfer_date' => $transfer->formatted_transfer_date,
                'description' => $transfer->description,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Transfer',
            'Nama Aset',
            'Lokasi Asal',
            'Lokasi Tujuan',
            'Jumlah',
            'Tanggal Transfer',
            'Keterangan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 10,
            'F' => 20,
            'G' => 40,
        ];
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssetsSummaryExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->data->map(function ($asset) {
            return [
                'ID' => $asset->id,
                'Nama' => $asset->name,
                'Kategori' => $asset->category->name,
                'Lokasi' => $asset->latest_transfer_location_name,
                'Vendor' => $asset->vendor->name,
                'Tanggal Pembelian' => optional($asset->latestPurchase)->formatted_purchase_date,
                'Biaya' => optional($asset->latestPurchase)->formatted_total_cost,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Kategori',
            'Lokasi',
            'Vendor',
            'Tanggal Pembelian',
            'Biaya',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 30,
            'C' => 20,
            'D' => 20,
            'E' => 30,
            'F' => 20,
            'G' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }
}

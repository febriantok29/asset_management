<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MaintenanceRepairsExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($maintenance) {
            return [
                'Kode Pemeliharaan' => $maintenance->maintenance_code,
                'Nama Aset' => $maintenance->asset->name,
                'Tanggal Pemeliharaan' => $maintenance->formatted_maintenance_date,
                'Masalah' => $maintenance->issue,
                'Teknisi' => $maintenance->technician,
                'Biaya' => $maintenance->formatted_cost,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kode Pemeliharaan',
            'Nama Aset',
            'Tanggal Pemeliharaan',
            'Masalah',
            'Teknisi',
            'Biaya',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 30,
            'C' => 20,
            'D' => 30,
            'E' => 20,
            'F' => 20,
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

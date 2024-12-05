<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet; // Pastikan ini diimport

class FeeReportExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function collection()
    {
        return collect($this->students);
    }

    public function headings(): array
    {
        return ['No', 'Nama', 'Bulan'];
    }

    public function map($student): array
    {
        $months = collect($student['fee'])
            ->where('is_paid', false)
            ->pluck('month_name')
            ->implode(', ');

        return [
            $student['id'],             // No
            $student['name'],           // Nama
            $months                     // Bulan
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Set header row style
        $sheet->getStyle('A1:C1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'], // White text
                'size' => 12,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '00000000'], // Black background
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Apply borders to all cells
        $sheet->getStyle('A1:C' . (count($this->students) + 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], // Black border
                ],
            ],
        ]);

        // Set the width of columns based on the content
        foreach (range('A', 'C') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return $sheet;
    }

}

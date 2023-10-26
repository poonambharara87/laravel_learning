<?php

namespace App\Exports;


use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class StudentMarksExport implements FromArray, WithMapping, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->student);
    }

    protected $student;

    public function __construct(array $student)
    {
        $this->student = $student;
    }

    public function array(): array
    {
        return $this->student;
    }

    public function map($student): array
    {
        // Calculate the sum of specific columns
        $sum = $this->student['Marks']['hindi'] + $this->student['Marks']['english'] + $this->student['Marks']['math'] + $this->student['Marks']['drawing'];

        return [
            $this->student['name'],
            $this->student['email'],
            $this->student['Marks']['hindi'],
            $this->student['Marks']['english'],
            $this->student['Marks']['math'],
            $this->student['Marks']['drawing'],
            $sum
            // You can add more calculations here (percentage, CGPA, etc.)
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Hindi',
            'English',
            'Math',
            'Drawing',
            'Total',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D3D3D3']], // Light gray background color
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'], // Border color
                ],
            ],
        ]);

        $sheet->getStyle('A2:G' . ($sheet->getHighestRow()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'], // Border color
                ],
            ],
        ]);

        return [
            'A' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT]],
            'B' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT]],
            'C' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'D' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'E' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],  
            'F' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            'G' => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Get the total number of rows
                $numOfRows = count($this->student['Marks']);

                // // Set the SUM formula for the "Total" column for all rows
                for ($row = 2; $row <= $numOfRows + 1; $row++) {
                    $event->sheet->setCellValue("G{$row}", "=SUM(C{$row}:F{$row})");
                }

            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 80, 
            'B' => 170
        ];
    }




}





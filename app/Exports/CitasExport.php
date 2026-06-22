<?php

namespace App\Exports;

use App\Models\Cita;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CitasExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    public function collection()
    {
        return Cita::with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($cita, $index) {
                return [
                    'N°'            => $index + 1,
                    'Paciente'      => $cita->user->nombre . ' ' . $cita->user->apellido,
                    'Documento'     => $cita->user->tipo_id . ': ' . $cita->user->numero_id,
                    'Correo'        => $cita->user->email,
                    'Especialidad'  => $cita->especialidad,
                    'Fecha'         => $cita->fecha,
                    'Hora'          => substr($cita->hora, 0, 5),
                    'Estado'        => ucfirst($cita->estado),
                    'Registrado'    => $cita->created_at->format('d/m/Y H:i'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'N°',
            'Paciente',
            'Documento',
            'Correo',
            'Especialidad',
            'Fecha',
            'Hora',
            'Estado',
            'Registrado',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 25,
            'C' => 25,
            'D' => 30,
            'E' => 22,
            'F' => 14,
            'G' => 10,
            'H' => 14,
            'I' => 18,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $totalRows = $sheet->getHighestRow();

        // ── Cabecera ──────────────────────────────────────────────────────────
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold'  => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size'  => 11,
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1E50A2'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['rgb' => 'FFFFFF'],
                ],
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(22);

        // ── Filas de datos ────────────────────────────────────────────────────
        for ($row = 2; $row <= $totalRows; $row++) {
            $bgColor = $row % 2 === 0 ? 'EBF2FF' : 'FFFFFF';

            $sheet->getStyle("A{$row}:I{$row}")->applyFromArray([
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $bgColor],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color'       => ['rgb' => 'D0DEFF'],
                    ],
                ],
            ]);

            $sheet->getRowDimension($row)->setRowHeight(18);

            // Color del estado
            $estado = $sheet->getCell("H{$row}")->getValue();
            $color  = match (strtolower($estado ?? '')) {
                'aceptada'  => '166534',
                'cancelada' => '991B1B',
                default     => '854D0E',
            };
            $sheet->getStyle("H{$row}")->getFont()->getColor()->setRGB($color);
            $sheet->getStyle("H{$row}")->getFont()->setBold(true);
            $sheet->getStyle("H{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // ── Centrar columnas específicas ──────────────────────────────────────
        $sheet->getStyle("A2:A{$totalRows}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("F2:G{$totalRows}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("I2:I{$totalRows}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }

    public function title(): string
    {
        return 'Citas Clínica Colombia';
    }
}
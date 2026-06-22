<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cita;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index()
    {
        $users = User::with('citas')->orderBy('nombre')->get();
        return view('pdf', compact('users'));
    }

    public function generar($id)
    {
        require_once base_path('vendor/setasign/fpdf/fpdf.php');

        // Trae la cita específica con su usuario
        $cita = Cita::with('user')->findOrFail($id);
        $user = $cita->user;

        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false);

        $azul      = [30, 80, 162];
        $azulClaro = [219, 234, 254];
        $gris      = [100, 100, 100];
        $verde     = [22, 101, 52];
        $amarillo  = [133, 77, 14];
        $rojo      = [153, 27, 27];

        // Helper para limpiar caracteres especiales
        $utf = fn($str) => iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $str);

        // CABECERA
        $pdf->SetFillColor(...$azul);
        $pdf->Rect(0, 0, 210, 35, 'F');

        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->SetXY(10, 8);
        $pdf->Cell(190, 10, $utf('CLINICA SALUD COMPLETA'), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 11);
        $pdf->SetXY(10, 20);
        $pdf->Cell(190, 6, $utf('Informe de Cita'), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(10, 27);
        $pdf->Cell(190, 6, $utf('Fecha de generacion: ' . now()->format('d/m/Y H:i')), 0, 1, 'C');

        $pdf->Ln(20);

        // DATOS DEL PACIENTE
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFillColor(...$azul);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 9, $utf('  DATOS DEL PACIENTE'), 0, 1, 'L', true);
        $pdf->Ln(3);

        $campos = [
            ['Nombre completo',     $user->nombre . ' ' . $user->apellido],
            ['Tipo de documento',   $user->tipo_id],
            ['Numero de documento', $user->numero_id],
            ['Correo electronico',  $user->email],
        ];

        foreach ($campos as $i => [$label, $valor]) {
            $i % 2 === 0
                ? $pdf->SetFillColor(...$azulClaro)
                : $pdf->SetFillColor(255, 255, 255);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(...$gris);
            $pdf->Cell(65, 8, $utf('  ' . $label . ':'), 0, 0, 'L', true);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetTextColor(30, 30, 30);
            $pdf->Cell(125, 8, $utf($valor), 0, 1, 'L', true);
        }

        $pdf->Ln(6);

        // DETALLE DE LA CITA
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFillColor(...$azul);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 9, $utf('  DETALLE DE LA CITA'), 0, 1, 'L', true);
        $pdf->Ln(3);

        $detalle = [
            ['Fecha',        $cita->fecha],
            ['Hora',         substr($cita->hora, 0, 5)],
            ['Especialidad', $cita->especialidad],
            ['Estado',       ucfirst($cita->estado)],
        ];

        foreach ($detalle as $i => [$label, $valor]) {
            $i % 2 === 0
                ? $pdf->SetFillColor(...$azulClaro)
                : $pdf->SetFillColor(255, 255, 255);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(...$gris);
            $pdf->Cell(65, 8, $utf('  ' . $label . ':'), 0, 0, 'L', true);

            $pdf->SetFont('Arial', '', 10);

            // Color según estado
            if ($label === 'Estado') {
                switch ($cita->estado) {
                    case 'aceptada':  $pdf->SetTextColor(...$verde);    break;
                    case 'cancelada': $pdf->SetTextColor(...$rojo);     break;
                    default:          $pdf->SetTextColor(...$amarillo); break;
                }
            } else {
                $pdf->SetTextColor(30, 30, 30);
            }

            $pdf->Cell(125, 8, $utf($valor), 0, 1, 'L', true);
        }

        // PIE DE PÁGINA
        $pdf->Ln(10);
        $pdf->SetFillColor(...$azul);
        $pdf->Rect(0, 280, 210, 17, 'F');
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->SetTextColor(200, 210, 255);
        $pdf->SetXY(10, 284);
        $pdf->Cell(190, 5, $utf('Documento generado automaticamente por el sistema de la Clinica Salud Total'), 0, 1, 'C');
        $pdf->SetXY(10, 290);
        $pdf->Cell(190, 5, $utf('Este documento es de caracter informativo y confidencial'), 0, 1, 'C');

        $nombreArchivo = 'cita_' . $user->numero_id . '_' . now()->format('Ymd') . '.pdf';
        $pdf->Output('D', $nombreArchivo);
        exit;
    }
}
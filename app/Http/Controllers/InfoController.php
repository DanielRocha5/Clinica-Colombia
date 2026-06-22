<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Exports\CitasExport;
use Maatwebsite\Excel\Facades\Excel;

class InfoController extends Controller
{
    public function index()
    {
        $citas = Cita::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.informacion', compact('citas'));
    }

    public function exportExcel()
    {
        $nombre = 'citas_clinica_colombia_' . now()->format('Ymd_Hi') . '.xlsx';
        return Excel::download(new CitasExport, $nombre);
    }
}
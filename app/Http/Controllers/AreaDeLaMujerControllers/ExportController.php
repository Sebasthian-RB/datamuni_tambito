<?php

namespace App\Http\Controllers\AreaDeLaMujerControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{

    public function exportAsistencias(Request $request)
{
    $query = \App\Models\AreaDeLaMujerModels\AmPersonEvent::with(['amPerson', 'event']);

    if ($request->filled('search')) {
        $search = $request->search;
        $query->whereHas('amPerson', function ($q) use ($search) {
            $q->where('given_name', 'like', "%$search%")
              ->orWhere('paternal_last_name', 'like', "%$search%")
              ->orWhere('dni', 'like', "%$search%");
        });
    }

    if ($request->filled('event')) {
        $query->where('event_id', $request->event);
    }

    $records = $query->get();

    // Crear hoja de cálculo
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Encabezados
    $sheet->setCellValue('A1', '#');
    $sheet->setCellValue('B1', 'Persona');
    $sheet->setCellValue('C1', 'DNI');
    $sheet->setCellValue('D1', 'Evento');
    $sheet->setCellValue('E1', 'Estado');

    $row = 2;
    foreach ($records as $index => $record) {
        $persona = $record->amPerson;
        $sheet->setCellValue("A$row", $index + 1);
        $sheet->setCellValue("B$row", $persona->given_name . ' ' . $persona->paternal_last_name);
        $sheet->setCellValue("C$row", $persona->dni);
        $sheet->setCellValue("D$row", $record->event->name);
        $sheet->setCellValue("E$row", $record->status);
        $row++;
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $fileName = 'asistencias_' . now()->format('Ymd_His') . '.xlsx';

    // Headers para descarga
    return response()->streamDownload(function () use ($writer) {
        $writer->save('php://output');
    }, $fileName, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ]);
}

}

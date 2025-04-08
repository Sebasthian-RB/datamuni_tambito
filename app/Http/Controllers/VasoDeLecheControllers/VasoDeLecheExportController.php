<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use App\Models\VasoDeLecheModels\Committee;

class VasoDeLecheExportController extends Controller
{
    public function export($committeeId)
    {
        // Obtener el comité con sus miembros y menores
        $committee = Committee::with('vlFamilyMembers.vlMinors')->findOrFail($committeeId);

        // Crear una nueva instancia de PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Título de la hoja - Celda combinada para el título principal
        $sheet->setCellValue('A1', 'PADRÓN DE BENEFICIARIOS DEL PROGRAMA VASO DE LECHE');
        $sheet->mergeCells('A1:O1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:O1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Agregar la información de ubicación y datos del comité
        $sheet->setCellValue('A3', 'A - UBICACIÓN GEOGRÁFICA');
        $sheet->mergeCells('A3:B3');
        $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('A3:B3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $sheet->setCellValue('A4', 'EL TAMBO - HUANCAYO - JUNÍN');
        $sheet->mergeCells('A4:B4');
        $sheet->getStyle('A4')->getFont()->setItalic(true)->setSize(11);
        $sheet->getStyle('A4:B4')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $sheet->setCellValue('D3', 'NOMBRE DEL COMITÉ - ' . $committee->name);
        $sheet->mergeCells('D3:I4');
        $sheet->getStyle('D3')->getFont()->setSize(14);
        $sheet->getStyle('D3:I4')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Datos adicionales
        $sheet->setCellValue('D5', 'CORRESPONDIENTE MES: ' . now()->format('F Y'));
        $sheet->mergeCells('D5:I5');
        $sheet->getStyle('D5')->getFont()->setSize(11);
        $sheet->getStyle('D5:I5')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $sheet->setCellValue('K3', 'FECHA DE DISTRIBUCIÓN: ');
        $sheet->mergeCells('K3:N3');
        $sheet->getStyle('K3')->getFont()->setSize(11);
        $sheet->getStyle('K3:N3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $sheet->setCellValue('K4', 'PRESIDENTE(A): ' . $committee->president);
        $sheet->mergeCells('K4:N4');
        $sheet->getStyle('K4')->getFont()->setSize(11);
        $sheet->getStyle('K4:N4')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Cabeceras de la tabla de beneficiarios
        $sheet->setCellValue('A9', 'N°');
        $sheet->setCellValue('B9', 'Tipo de Documento Familiar');
        $sheet->setCellValue('C9', 'Número de Documento Familiar');
        $sheet->setCellValue('D9', 'Familiar/Apoderado(a)');        
        $sheet->setCellValue('E9', 'Tipo de Documento Beneficiario');
        $sheet->setCellValue('F9', 'Número de Documento Beneficiario');
        $sheet->setCellValue('G9', 'Beneficiario(a)');
        $sheet->setCellValue('H9', 'Parentesco');
        $sheet->setCellValue('I9', 'Sexo');
        $sheet->setCellValue('J9', 'Fecha de Nacimiento');
        $sheet->setCellValue('K9', 'Edad');
        $sheet->setCellValue('L9', 'Condición');
        $sheet->setCellValue('M9', 'Fecha de Empadronamiento');
        $sheet->setCellValue('N9', 'Fecha de Retiro');
        $sheet->setCellValue('O9', 'Grado de Instrucción');
        $sheet->setCellValue('P9', 'Vivienda');
        $sheet->setCellValue('Q9', 'Domicilio');

        // Estilo para las cabeceras de la tabla
        $sheet->getStyle('A9:Q9')->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('A9:Q9')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A9:Q9')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $sheet->getStyle('A9:Q9')->getFill()->getStartColor()->setRGB('8E6AB8'); // Color de fondo de cabeceras

        // Insertar los datos de los beneficiarios
        $row = 10; // Comienza a partir de la fila 10
        $num = 1; // Iniciar el contador para la columna "N°"
        foreach ($committee->vlFamilyMembers as $familyMember) {
            $minors = $familyMember->vlMinors; // Obtener los menores de este miembro de familia
        
            // Verificar si 'vlFamilyMember' tiene los atributos correctos
            $paternalLastName = $familyMember->paternal_last_name ?? '-';
            $maternalLastName = $familyMember->maternal_last_name ?? '';  // Si no existe, se deja vacío
            $givenName = $familyMember->given_name ?? '-';

            // Concatenar el nombre completo, si no existe el apellido materno no se incluye
            $fullName = $paternalLastName . ' ' . ($maternalLastName ? $maternalLastName . ' ' : '') . $givenName;

        
            if ($minors->isEmpty()) {
                // Si no tiene menores, solo se muestra la información del familiar
                $sheet->setCellValue('A' . $row, $num++);
                $sheet->setCellValue('B' . $row, $familyMember->identity_document);  // Tipo de Documento Familiar
                $sheet->setCellValue('C' . $row, $familyMember->id);     // Número de Documento Familiar
                $sheet->setCellValue('D' . $row, $fullName);                         // Familiar/Apoderado(a)
                $sheet->setCellValue('E' . $row, '-');                                // Tipo de Documento Beneficiario
                $sheet->setCellValue('F' . $row, '-');                                // Número de Documento Beneficiario
                $sheet->setCellValue('G' . $row, '-');                                // Beneficiario(a)
                $sheet->setCellValue('H' . $row, '-');                                // Parentesco
                $sheet->setCellValue('I' . $row, '-');                                // Sexo
                $sheet->setCellValue('J' . $row, '-');                                // Fecha de Nacimiento
                $sheet->setCellValue('K' . $row, '-');                                // Edad
                $sheet->setCellValue('L' . $row, '-');                                // Condición
                $sheet->setCellValue('M' . $row, '-');                                // Fecha de Empadronamiento
                $sheet->setCellValue('N' . $row, '-');                                // Fecha de Retiro
                $sheet->setCellValue('O' . $row, '-');                                // Grado de Instrucción
                $sheet->setCellValue('P' . $row, '-');                                // Vivienda
                $sheet->setCellValue('Q' . $row, '-');                                // Domicilio
                $row++;
            } else {
                // Si tiene menores, mostramos una fila para cada menor
                foreach ($minors as $minor) {
                    // Verificar si los apellidos y nombre del menor están disponibles
                    $minorPaternalLastName = $minor->paternal_last_name ?? '-';
                    $minorMaternalLastName = $minor->maternal_last_name ?? ''; // Si no existe, lo dejamos vacío
                    $minorGivenName = $minor->given_name ?? '-';

                    // Concatenar el nombre completo del menor, si no existe el apellido materno no se incluye
                    $minorFullName = $minorPaternalLastName . ' ' . ($minorMaternalLastName ? $minorMaternalLastName . ' ' : '') . $minorGivenName;
                    
                    $sheet->setCellValue('A' . $row, $num++);
                    $sheet->setCellValue('B' . $row, $familyMember->identity_document); // Tipo de Documento Familiar
                    $sheet->setCellValue('C' . $row, $familyMember->id);    // Número de Documento Familiar
                    $sheet->setCellValue('D' . $row, $fullName);                         // Familiar/Apoderado(a)
                    $sheet->setCellValue('E' . $row, $minor->identity_document);         // Tipo de Documento Beneficiario
                    $sheet->setCellValue('F' . $row, $minor->id);           // Número de Documento Beneficiario
                    $sheet->setCellValue('G' . $row, $minorFullName);  // Beneficiario(a)
                    $sheet->setCellValue('H' . $row, $minor->kinship);                   // Parentesco
                    $sheet->setCellValue('I' . $row, $minor->sex_type);                  // Sexo
                    $sheet->setCellValue('J' . $row, $minor->birth_date);                // Fecha de Nacimiento
                    $sheet->setCellValue('K' . $row, \Carbon\Carbon::parse($minor->birth_date)->age); // Edad
                    $sheet->setCellValue('L' . $row, $minor->condition);                 // Condición
                    $sheet->setCellValue('M' . $row, $minor->registration_date);         // Fecha de Empadronamiento
                    $sheet->setCellValue('N' . $row, $minor->withdrawal_date);           // Fecha de Retiro
                    $sheet->setCellValue('O' . $row, $minor->education_level);           // Grado de Instrucción
                    $sheet->setCellValue('P' . $row, $minor->dwelling_type);             // Vivienda
                    $sheet->setCellValue('Q' . $row, $minor->address);                   // Domicilio
                    $row++;
                }
            }
        }        

        // Ajustar el ancho de las columnas
        foreach (range('A', 'Q') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // Ajuste automático para cada columna
        }

        // Crear un escritor y guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'vaso_de_leche_padrón.xlsx';

        // Forzar la descarga del archivo
        return response()->stream(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}

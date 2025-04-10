<?php

namespace App\Http\Controllers\VasoDeLecheControllers;

use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use App\Models\VasoDeLecheModels\Committee;
use Carbon\Carbon;



class VasoDeLecheExportController extends Controller
{
    public function export($committeeId)
    {
        // Establecer el locale en español para Carbon
        Carbon::setLocale('es');

        // Obtener el comité con sus miembros y menores
        $committee = Committee::with('vlFamilyMembers.vlMinors')->findOrFail($committeeId);

        // Formatear la fecha en español y convertir a mayúsculas
        $mesEnEspanol = strtoupper(now()->translatedFormat('F Y')); 

        // Crear una nueva instancia de PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Título de la hoja - Celda combinada para el título principal
        $sheet->setCellValue('A1', 'PADRÓN DE BENEFICIARIOS DEL PROGRAMA VASO DE LECHE');
        $sheet->mergeCells('A1:AB1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12)->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Agregar la información de ubicación y datos del comité
        $sheet->setCellValue('A3', 'A - UBICACIÓN GEOGRÁFICA');
        $sheet->mergeCells('A3:B3');
        $sheet->getStyle('A3')->getFont()->setSize(9);
        $sheet->getStyle('A3:B3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A3:B3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrado horizontal

        $sheet->setCellValue('A4', 'EL TAMBO - HUANCAYO - JUNÍN');
        $sheet->mergeCells('A4:B4');
        $sheet->getStyle('A4')->getFont()->setSize(9);
        $sheet->getStyle('A4:B4')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A4:B4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrado horizontal

        $sheet->setCellValue('D3', 'NOMBRE DEL COMITÉ - ' . strtoupper($committee->name));
        $sheet->mergeCells('D3:W4');
        $sheet->getStyle('D3')->getFont()->setSize(11);
        $sheet->getStyle('D3:W4')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('D3:W4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);    // Centrar el texto (horizontal y verticalmente)
        
        // Datos adicionales
        $sheet->setCellValue('D5', 'CORRESPONDIENTE MES: ' . $mesEnEspanol);
        $sheet->mergeCells('D5:W5');
        $sheet->getStyle('D5')->getFont()->setSize(10);
        $sheet->getStyle('D5:W5')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('D5:W5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrado horizontal

        $sheet->setCellValue('Z3', 'FECHA DE DISTRIBUCIÓN: ');
        $sheet->mergeCells('Z3:AB3');
        $sheet->getStyle('Z3')->getFont()->setSize(10);
        $sheet->getStyle('Z3:AB3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $sheet->setCellValue('Z4', 'PRESIDENTE(A): ' . strtoupper($committee->president));
        $sheet->mergeCells('Z4:AB4');
        $sheet->getStyle('Z4')->getFont()->setSize(10);
        $sheet->getStyle('Z4:AB4')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Configuración de todas las cabeceras en un array estructurado
        $headers = [
            // [celda_inicio, texto, celdas_a_unir, tamaño_fuente, rotación]
            ['A6', 'N°', 'A6:A7', 10],
            ['B6', 'APELLIDOS Y NOMBRES DE LA MADRE Y/O APODERADO(A)', 'B6:B7', 10],
            ['C6', 'APELLIDOS Y NOMBRES DEL BENEFICIARIO(A)', 'C6:C7', 10],
            ['D6', 'DOC. IDENT.', 'D6:D7', 10, 90],
            ['E6', 'PARENT.', 'E6:E7', 10, 90],
            ['F6', 'SEXO', 'F6:G6', 8],
            ['F7', 'M', null, 10],
            ['G7', 'F', null, 10],
            ['H6', 'FECHA DE NACIMIENTO', 'H6:H7', 10],
            ['I6', 'BENEFICIARIO (EDAD Y CONDICIÓN)', 'I6:U6', 8],
            ['I7', '0', null, 10],
            ['J7', '1', null, 10],
            ['K7', '2', null, 10],
            ['L7', '3', null, 10],
            ['M7', '4', null, 10],
            ['N7', '5', null, 10],
            ['O7', '6', null, 10],
            ['P7', '7-13', null, 10],
            ['Q7', 'GESTANTE', null, 10, 90],
            ['R7', 'LACTANTE', null, 10, 90],
            ['S7', 'ANCIANO', null, 10, 90],
            ['T7', 'DISCAPACITADO', null, 10, 90],
            ['U7', 'PERSONA CON TBC', null, 10, 90],
            ['V6', 'FECHA DE', 'V6:W6', 8],
            ['V7', 'EMPADRONAMIENTO', null, 10, 90],
            ['W7', 'RETIRO', null, 10, 90],
            ['X6', 'GRADO DE INST.', 'X6:X7', 10, 90],
            ['Y6', 'VIVIENDA', 'Y6:Y7', 10, 90],
            ['Z6', 'DOMICILIO', 'Z6:Z7', 10],
            ['AA6', 'FIRMA', 'AA6:AA7', 10],
            ['AB6', 'HUELLA DACTILAR', 'AB6:AB7', 10]
        ];

        // Aplicar todas las cabeceras
        foreach ($headers as $header) {
            [$cell, $text, $merge, $size, $rotation] = array_pad($header, 5, null);
            
            $sheet->setCellValue($cell, $text);
            if ($merge) $sheet->mergeCells($merge);
            
            $style = $sheet->getStyle($cell);
            $style->getFont()->setSize($size);
            if ($rotation) $style->getAlignment()->setTextRotation($rotation);
        }

        // Aplicar estilos comunes
        $sheet->getStyle('A6:AB7')->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'wrapText' => true,
        ]);

        // Configurar anchos de columnas
        $columnWidths = [
            'A' => 4, 'B' => 30, 'C' => 30, 'D' => 3, 'E' => 3, 
            'F' => 3, 'G' => 3, 'H' => 11, 'I' => 2, 'J' => 2, 
            'K' => 2, 'L' => 2, 'M' => 2, 'N' => 2, 'O' => 2, 
            'P' => 4, 'Q' => 3, 'R' => 3, 'S' => 3, 'T' => 3, 
            'U' => 3, 'V' => 3, 'W' => 3, 'X' => 3, 'Y' => 3, 
            'Z' => 20, 'AA' => 10, 'AB' => 15
        ];

        foreach ($columnWidths as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        // Configurar alturas de filas
        $sheet->getRowDimension(6)->setRowHeight(20);
        $sheet->getRowDimension(7)->setRowHeight(100);
       
        // Insertar los datos de los beneficiarios
        $row = 8; // Comienza a partir de la fila 8
        $num = 1; // Iniciar el contador para la columna "N°"

        foreach ($committee->vlFamilyMembers as $familyMember) {
            $minors = $familyMember->vlMinors;
            
            // ===================== DATOS DEL FAMILIAR/APODERADO =====================
            // Formatear nombres (mayúsculas y eliminar espacios extras)
            $paternalLastName = strtoupper(trim($familyMember->paternal_last_name ?? ''));
            $maternalLastName = strtoupper(trim($familyMember->maternal_last_name ?? ''));
            $givenName = strtoupper(trim($familyMember->given_name ?? ''));
            
            // Construir nombre completo
            $fullName = trim("$paternalLastName $maternalLastName $givenName");
            $fullName = ($fullName !== '') ? $fullName : '-';
            
            // Formatear documento de identidad (mayúsculas)
            $familyDocType = strtoupper($familyMember->identity_document ?? '-');
            $familyDocNumber = strtoupper($familyMember->id ?? '-');

            if ($minors->isEmpty()) {
                // ===================== SIN MENORES =====================
                $sheet->setCellValue('A' . $row, $num++);
                $sheet->mergeCells('A' . $row . ':A' . ($row + 1));
                
                $sheet->setCellValue('B' . $row, $familyDocType);
                $sheet->mergeCells('B' . $row . ':B' . ($row + 1));
                
                $sheet->setCellValue('C' . $row, $familyDocNumber);
                $sheet->mergeCells('C' . $row . ':C' . ($row + 1));
                
                $sheet->setCellValue('D' . $row, $fullName);
                $sheet->mergeCells('D' . $row . ':D' . ($row + 1));
                
                // Resto de campos con valores por defecto
                $fields = ['E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q'];
                foreach ($fields as $field) {
                    $sheet->setCellValue($field . $row, '-');
                    $sheet->mergeCells($field . $row . ':' . $field . ($row + 1));
                }
                
                $row += 2;
            } else {
                // ===================== CON MENORES =====================
                foreach ($minors as $minor) {
                    // Formatear datos del menor
                    $minorPaternal = strtoupper(trim($minor->paternal_last_name ?? ''));
                    $minorMaternal = strtoupper(trim($minor->maternal_last_name ?? ''));
                    $minorGiven = strtoupper(trim($minor->given_name ?? ''));
                    $minorFullName = trim("$minorPaternal $minorMaternal $minorGiven");
                    $minorFullName = ($minorFullName !== '') ? $minorFullName : '-';
                    
                    // Documentos
                    $minorDocType = strtoupper($minor->identity_document ?? '-');
                    $minorDocNumber = strtoupper($minor->id ?? '-');
                    
                    // Parentesco y sexo (mayúsculas)
                    $kinship = strtoupper($minor->kinship ?? '-');
                    $sexType = strtoupper($minor->sex_type ?? '-');
                    
                    // Formatear fechas (DD/MM/YYYY)
                    $birthDate = $minor->birth_date ? Carbon::parse($minor->birth_date)->format('d/m/Y') : '-';
                    $regDate = $minor->registration_date ? Carbon::parse($minor->registration_date)->format('d/m/Y') : '-';
                    $withdrawalDate = $minor->withdrawal_date ? Carbon::parse($minor->withdrawal_date)->format('d/m/Y') : '-';
                    
                    // Edad (calculada desde la fecha de nacimiento)
                    $age = $minor->birth_date ? Carbon::parse($minor->birth_date)->age : '-';
                    
                    // Otros campos (mayúsculas)
                    $condition = strtoupper($minor->condition ?? '-');
                    $education = strtoupper($minor->education_level ?? '-');
                    $dwelling = strtoupper($minor->dwelling_type ?? '-');
                    $address = strtoupper($minor->address ?? '-');
                    
                    // Insertar datos
                    $sheet->setCellValue('A' . $row, $num++);
                    $sheet->mergeCells('A' . $row . ':A' . ($row + 1));
                    
                    $sheet->setCellValue('B' . $row, $familyDocType);
                    $sheet->mergeCells('B' . $row . ':B' . ($row + 1));
                    
                    $sheet->setCellValue('C' . $row, $familyDocNumber);
                    $sheet->mergeCells('C' . $row . ':C' . ($row + 1));
                    
                    $sheet->setCellValue('D' . $row, $fullName);
                    $sheet->mergeCells('D' . $row . ':D' . ($row + 1));
                    
                    // Datos del menor
                    $sheet->setCellValue('E' . $row, $minorDocType);
                    $sheet->mergeCells('E' . $row . ':E' . ($row + 1));
                    
                    $sheet->setCellValue('F' . $row, $minorDocNumber);
                    $sheet->mergeCells('F' . $row . ':F' . ($row + 1));
                    
                    $sheet->setCellValue('G' . $row, $minorFullName);
                    $sheet->mergeCells('G' . $row . ':G' . ($row + 1));
                    
                    $sheet->setCellValue('H' . $row, $kinship);
                    $sheet->mergeCells('H' . $row . ':H' . ($row + 1));
                    
                    $sheet->setCellValue('I' . $row, $sexType);
                    $sheet->mergeCells('I' . $row . ':I' . ($row + 1));
                    
                    $sheet->setCellValue('J' . $row, $birthDate);
                    $sheet->mergeCells('J' . $row . ':J' . ($row + 1));
                    
                    $sheet->setCellValue('K' . $row, $age);
                    $sheet->mergeCells('K' . $row . ':K' . ($row + 1));
                    
                    $sheet->setCellValue('L' . $row, $condition);
                    $sheet->mergeCells('L' . $row . ':L' . ($row + 1));
                    
                    $sheet->setCellValue('V' . $row, $regDate);
                    $sheet->mergeCells('V' . $row . ':V' . ($row + 1));
                    
                    $sheet->setCellValue('W' . $row, $withdrawalDate);
                    $sheet->mergeCells('W' . $row . ':W' . ($row + 1));
                    
                    $sheet->setCellValue('X' . $row, $education);
                    $sheet->mergeCells('X' . $row . ':X' . ($row + 1));
                    
                    $sheet->setCellValue('Y' . $row, $dwelling);
                    $sheet->mergeCells('Y' . $row . ':Y' . ($row + 1));
                    
                    $sheet->setCellValue('Z' . $row, $address);
                    $sheet->mergeCells('Z' . $row . ':Z' . ($row + 1));
                    
                    $row += 2;
                }
            }
        }   

        // Aplicar estilos a todas las celdas de datos (desde A8 hasta la última fila)
        $lastRow = $row - 1;
        $sheet->getStyle('A8:AB' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'wrapText' => true,
            'font' => [
                'size' => 9, // Tamaño de fuente 9
            ],
        ]);

        // Aplicar rotación de 90 grados a las columnas específicas
        $columnsToRotate = ['D', 'E', 'V', 'W', 'X', 'Y'];
        foreach ($columnsToRotate as $column) {
            $sheet->getStyle($column . '8:' . $column . $lastRow)->applyFromArray([
                'alignment' => [
                    'textRotation' => 90, // Texto vertical (90 grados)
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true, // Ajustar texto si es necesario
                ],
            ]);
        }

        // Ajustar altura de filas fusionadas alternadamente (50 y 20 puntos)
        for ($i = 8; $i <= $lastRow; $i += 2) {
            // Primera fila del grupo fusionado (altura 50)
            $sheet->getRowDimension($i)->setRowHeight(50);
            
            // Segunda fila del grupo fusionado (altura 20)
            if (($i + 1) <= $lastRow) {
                $sheet->getRowDimension($i + 1)->setRowHeight(20);
            }
        }

        // CONFIGURACIÓN DE IMPRESIÓN 
        $sheet->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE)
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4)
            ->setFitToWidth(1)
            ->setFitToHeight(0);

        $sheet->getPageMargins()
            ->setTop(0.5)
            ->setRight(0.5)
            ->setLeft(0.5)
            ->setBottom(0.5);

        // Definir el área de impresión (A1 hasta la última columna y fila con datos)
        $sheet->getPageSetup()->setPrintArea("A1:AB" . $lastRow);

        // Repetir filas de encabezado en cada página
        $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 7);

        // Opcional: Ajustar escala si el contenido no cabe
        $sheet->getPageSetup()->setScale(85); // 85% de escala


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

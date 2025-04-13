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

        // Obtener el comité con sus miembros ACTIVOS y menores ACTIVOS
        $committee = Committee::with(['vlFamilyMembers' => function($query) {
            $query->where('status', 1)
                ->with(['vlMinors' => function($query) {
                    $query->where('status', 1); // Solo menores con status = 1
                }]);
        }])->findOrFail($committeeId);

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
            ['H6', 'FECHA DE NACIMIENTO', 'H6:H7', 9],
            ['I6', 'BENEFICIARIO (EDAD Y CONDICIÓN)', 'I6:U6', 8],
            ['I7', '0', null, 9],
            ['J7', '1', null, 9],
            ['K7', '2', null, 9],
            ['L7', '3', null, 9],
            ['M7', '4', null, 9],
            ['N7', '5', null, 9],
            ['O7', '6', null, 9],
            ['P7', '7-13', null, 9],
            ['Q7', 'GESTANTE', null, 9, 90],
            ['R7', 'LACTANTE', null, 9, 90],
            ['S7', 'ANCIANO', null, 9, 90],
            ['T7', 'DISCAPACITADO', null, 9, 90],
            ['U7', 'PERSONA CON TBC', null, 9, 90],
            ['V6', 'FECHA DE', 'V6:W6', 8],
            ['V7', 'EMPADRONAMIENTO', null, 9, 90],
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

        $sheet->getStyle('B6:C6')->applyFromArray([
            'alignment' => [
                'wrapText' => true,            // Forzar salto de línea automático
                'vertical' => Alignment::VERTICAL_CENTER,  // Alinear arriba (aprovecha mejor el espacio)
                'horizontal' => Alignment::HORIZONTAL_CENTER,  // Alinear a la izquierda
                'shrinkToFit' => false         // Desactivar reducción automática
            ],
            'font' => [
                'size' => 10
            ]
        ]);

        $sheet->getStyle('H6')->applyFromArray([
            'alignment' => [
                'wrapText' => true,            // Forzar salto de línea automático
                'vertical' => Alignment::VERTICAL_CENTER,  // Alinear arriba (aprovecha mejor el espacio)
                'horizontal' => Alignment::HORIZONTAL_CENTER,  // Alinear a la izquierda
                'shrinkToFit' => false         // Desactivar reducción automática
            ],
            'font' => [
                'size' => 9
            ]
        ]);

        // Configurar anchos de columnas
        $columnWidths = [
            'A' => 4, 'B' => 18, 'C' => 18, 'D' => 3, 'E' => 3, 
            'F' => 3, 'G' => 3, 'H' => 10, 'I' => 2, 'J' => 2, 
            'K' => 2, 'L' => 2, 'M' => 2, 'N' => 2, 'O' => 2, 
            'P' => 4, 'Q' => 3, 'R' => 3, 'S' => 3, 'T' => 3, 
            'U' => 3, 'V' => 3, 'W' => 3, 'X' => 3, 'Y' => 3, 
            'Z' => 20, 'AA' => 15, 'AB' => 15
        ];

        foreach ($columnWidths as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        // Configurar alturas de filas
        $sheet->getRowDimension(6)->setRowHeight(20);
        $sheet->getRowDimension(7)->setRowHeight(90);
       
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
            $fullName = ($fullName !== '') ? $fullName : '';
            
            // Formatear documento de identidad (mayúsculas)
            $familyDocType = strtoupper($familyMember->identity_document ?? '');
            $familyDocNumber = strtoupper($familyMember->id ?? '');

            if ($minors->isEmpty()) {
                // ===================== SIN MENORES =====================
                $sheet->setCellValue('A' . $row, $num++);
                $sheet->mergeCells('A' . $row . ':A' . ($row + 1));
                
                $sheet->setCellValue('B' . $row, $fullName);
                $docPrefixFamilyMemberNoMinor = match($familyMember->identity_document) {
                    'DNI' => 'DNI N° ',
                    'Carnet de Extranjería' => 'Car. Extr. N° ',
                    'Pasaporte' => 'Pas. N° ',
                    'Otro' => 'Doc. N° ',
                    default => 'Doc. N° '
                };
                $sheet->setCellValue('B' . ($row + 1), $docPrefixFamilyMemberNoMinor . $familyDocNumber);

                
                // Resto de campos con valores por defecto
                $fields = ['C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB'];
                foreach ($fields as $field) {
                    $sheet->setCellValue($field . $row, '');
                    $sheet->mergeCells($field . $row . ':' . $field . ($row + 1));
                }
                
                $row += 2;
            } else {
                // ===================== CON MENORES =====================
                $firstRow = $row; // Guardar la primera fila del familiar
                $firstMinor = true; // Bandera para identificar el primer menor

                foreach ($minors as $minor) {
                    // Formatear datos del menor
                    $minorPaternal = strtoupper(trim($minor->paternal_last_name ?? ''));
                    $minorMaternal = strtoupper(trim($minor->maternal_last_name ?? ''));
                    $minorGiven = strtoupper(trim($minor->given_name ?? ''));
                    $minorFullName = trim("$minorPaternal $minorMaternal $minorGiven");
                    $minorFullName = ($minorFullName !== '') ? $minorFullName : '';
                    
                    // Documentos
                    $minorDocType = strtoupper($minor->identity_document ?? '');
                    $minorDocNumber = strtoupper($minor->id ?? '');
                    
                    // Parentesco y sexo (mayúsculas)
                    $kinship = strtoupper($minor->kinship ?? '');
                    $sexType = $minor->sex_type ?? null; 
                    
                    // Formatear fechas (DD/MM/YYYY)
                    $birthDate = $minor->birth_date ? Carbon::parse($minor->birth_date)->format('d/m/Y') : '';
                    $regDate = $minor->registration_date ? Carbon::parse($minor->registration_date)->format('d/m/Y') : '';
                    $withdrawalDate = $minor->withdrawal_date ? Carbon::parse($minor->withdrawal_date)->format('d/m/Y') : '';
                    
                    // Edad (calculada desde la fecha de nacimiento)
                    $age = $minor->birth_date ? Carbon::parse($minor->birth_date)->age : '';
                    
                    // Otros campos (mayúsculas)
                    $condition = strtoupper($minor->condition ?? '');
                    $education = strtoupper($minor->education_level ?? '');
                    $dwelling = strtoupper($minor->dwelling_type ?? '');
                    $address = strtoupper($minor->address ?? '');
                    
                    // Insertar datos  
                    $sheet->mergeCells('A' . $row . ':A' . ($row + 1));

                    // Solo poner datos en la columna B para el primer menor
                    if ($firstMinor) {
                        $sheet->setCellValue('B' . $row, $fullName);
                        $docPrefixFamilyMember = match($familyMember->identity_document) {
                            'DNI' => 'DNI N° ',
                            'Carnet de Extranjería' => 'Car. Extr. N° ',
                            'Pasaporte' => 'Pas. N° ',
                            'Otro' => 'Doc. N° ',
                            default => 'Doc. N° '
                        };
                        $sheet->setCellValue('B' . ($row + 1), $docPrefixFamilyMember . $familyDocNumber);
                        $firstMinor = false;
                    } else {
                        // Para los menores subsiguientes, dejar vacío
                        $sheet->setCellValue('B' . $row, '');
                        $sheet->setCellValue('B' . ($row + 1), '');
                        $sheet->mergeCells('B' . $row . ':B' . ($row + 1));
                    }

                    $sheet->setCellValue('C' . $row, $minorFullName);
                    $docPrefixMinor = match($minor->identity_document) {
                        'DNI' => 'DNI N° ',
                        'CNV' => 'CNV N° ',
                        'Carnet de Extranjería' => 'Car. Extr. N° ',
                        'Pasaporte' => 'Pas. N° ',
                        'Otro' => 'Doc. N° ',
                        default => 'Doc. N° '
                    };
                    $sheet->setCellValue('C' . ($row + 1), $docPrefixMinor . $minorDocNumber);


                    // Datos del menor
                    $sheet->setCellValue('D' . $row, $minorDocType);
                    $sheet->mergeCells('D' . $row . ':D' . ($row + 1));

                    $sheet->setCellValue('E' . $row, $kinship);
                    $sheet->mergeCells('E' . $row . ':E' . ($row + 1));


                    // Limpiar ambas celdas primero para el sexo del menor
                    $sheet->setCellValue('F' . $row, '');
                    $sheet->setCellValue('G' . $row, '');

                    // Marcar X según el sexo (sex_type es booleano: true=masculino, false=femenino)
                    if ($minor->sex_type === true || $minor->sex_type === 1) {
                        $sheet->setCellValue('F' . $row, 'X'); // Masculino
                    } else {
                        $sheet->setCellValue('G' . $row, 'X'); // Femenino
                    }

                    // Aplicar merge cells (como ya lo tienes)
                    $sheet->mergeCells('F' . $row . ':F' . ($row + 1));
                    $sheet->mergeCells('G' . $row . ':G' . ($row + 1));

                    $sheet->setCellValue('H' . $row, $birthDate);
                    $sheet->mergeCells('H' . $row . ':H' . ($row + 1));

                    
                    // Inicializar todas las celdas de condición como vacías
                    $conditionColumns = [
                        'I' => '', 'J' => '', 'K' => '', 'L' => '','M' => '', 'N' => '', 'O' => '', 'P' => '', 'Q' => '', 
                        'R' => '', 'S' => '', 'T' => '', 'U' => ''
                    ];

                    // Asignar 'X' según la condición del menor
                    switch ($minor->condition) {
                        case 'Menor de 1 año':
                            $conditionColumns['I'] = 'X';
                            break;
                        case 'Niño de 1 a 6 años':
                            if ($age >= 1 && $age <= 6) {
                                $col = chr(73 + $age); // 73 = ASCII para 'I' (I=0, J=1...O=6)
                                $conditionColumns[$col] = 'X';
                            }
                            break;
                        case 'Niño de 7 a 13 años':
                            $conditionColumns['P'] = 'X';
                            break;
                        case 'Madre gestante':
                            $conditionColumns['Q'] = 'X';
                            break;
                        case 'Madre lactante':
                            $conditionColumns['R'] = 'X';
                            break;
                        case 'Anciano':
                            $conditionColumns['S'] = 'X';
                            break;
                        case 'Discapacitado':
                            $conditionColumns['T'] = 'X';
                            break;
                        case 'Persona con TBC':
                            $conditionColumns['U'] = 'X';
                            break;
                    }

                    // Aplicar los valores a las celdas
                    foreach ($conditionColumns as $column => $value) {
                        $sheet->setCellValue($column . $row, $value);
                        $sheet->mergeCells($column . $row . ':' . $column . ($row + 1));
                    }
                    
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
                    
                    $sheet->setCellValue('AA' . $row, "");
                    $sheet->mergeCells('AA' . $row . ':AA' . ($row + 1));

                    $sheet->setCellValue('AB' . $row, "");
                    $sheet->mergeCells('AB' . $row . ':AB' . ($row + 1));

                    $row += 2;
                }

                $sheet->setCellValue('A' . $firstRow, $num++);
                $sheet->mergeCells('A' . $firstRow . ':A' . ($firstRow + 1));
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
                'font' => [
                    'size' => 8
                ]
            ]);
        }

        $sheet->getStyle('Z8:Z'.$lastRow)->applyFromArray([
            'alignment' => [
                'wrapText' => true,            // Forzar salto de línea automático
                'vertical' => Alignment::VERTICAL_CENTER,  // Alinear arriba (aprovecha mejor el espacio)
                'horizontal' => Alignment::HORIZONTAL_CENTER,  // Alinear a la izquierda
                'shrinkToFit' => false         // Desactivar reducción automática
            ],
            'font' => [
                'size' => 9
            ]
        ]);

        $sheet->getStyle('B8:B'.$lastRow)->applyFromArray([
            'alignment' => [
                'wrapText' => true,            // Forzar salto de línea automático
                'vertical' => Alignment::VERTICAL_CENTER,  // Alinear arriba (aprovecha mejor el espacio)
                'horizontal' => Alignment::HORIZONTAL_CENTER,  // Alinear a la izquierda
                'shrinkToFit' => false         // Desactivar reducción automática
            ],
            'font' => [
                'size' => 9
            ]
        ]);

        $sheet->getStyle('C8:C'.$lastRow)->applyFromArray([
            'alignment' => [
                'wrapText' => true,            // Forzar salto de línea automático
                'vertical' => Alignment::VERTICAL_CENTER,  // Alinear arriba (aprovecha mejor el espacio)
                'horizontal' => Alignment::HORIZONTAL_CENTER,  // Alinear a la izquierda
                'shrinkToFit' => false         // Desactivar reducción automática
            ],
            'font' => [
                'size' => 9
            ]
        ]);
        
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

        
        // Centrar tabla
        $sheet->getPageSetup()->setHorizontalCentered(true);
        $sheet->getPageSetup()->setVerticalCentered(true);

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

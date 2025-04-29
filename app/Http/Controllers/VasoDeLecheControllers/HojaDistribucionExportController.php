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

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HojaDistribucionExportController extends Controller
{
    use AuthorizesRequests;
    
    public function export($committeeId)
    {
        // Verificación de permiso
        $this->authorize('ver BD');

        // Establecer el locale en español para Carbon
        Carbon::setLocale('es');

        // Obtener el comité con sus miembros ACTIVOS y menores ACTIVOS
        $committee = Committee::with(['vlFamilyMembers' => function($query) {
            $query->where('status', 1)
                ->with(['vlMinors' => function($query) {
                    $query->where('status', 1); // Solo menores con status = 1
                }]);
        }])->findOrFail($committeeId);

        // Contar el número total de beneficiarios (menores activos)
        $totalBeneficiarios = 0;
        foreach ($committee->vlFamilyMembers as $familyMember) {
            $totalBeneficiarios += $familyMember->vlMinors->count();
        }

        // Formatear la fecha en español y convertir a mayúsculas
        $mesEnEspanol = strtoupper(now()->translatedFormat('F Y')); 
            // Versión abreviada:
        $mesEnEspanolAbrevAux = now()->translatedFormat('M-y'); // Esto producirá "Abr-25"
        $mesEnEspanolAbrev = ucfirst(strtolower($mesEnEspanolAbrevAux)); // Aseguramos "Abr" en lugar de "ABR"
        // Crear una nueva instancia de PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Título de la hoja - Celda combinada para el título principal
        $sheet->setCellValue('A1', 'PROGRAMA DEL VASO DE LECHE');
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12)->setUnderline(\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE);
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Agregar la información de ubicación y datos del comité
        $sheet->setCellValue('A3', 'HOJA DE DISTRIBUCIÓN DE PRODUCTOS A BENEFICIARIOS DEL PVL');
        $sheet->mergeCells('A3:G3');
        $sheet->getStyle('A3')->getFont()->setSize(10);
        $sheet->getStyle('A3:G3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A3:G3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrado horizontal

        $sheet->setCellValue('A5', 'COMITÉ                            : ' . strtoupper($committee->name));
        $sheet->mergeCells('A5:D5');
        $sheet->getStyle('A5')->getFont()->setSize(9);
        $sheet->getStyle('A5:D5')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A5:D5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); // Centrado horizontal

        $sheet->setCellValue('E5', 'NÚMERO DE COMITÉ           : ' . $committee->committee_number);
        $sheet->mergeCells('E5:G5');
        $sheet->getStyle('E5')->getFont()->setSize(9);
        $sheet->getStyle('E5:G5')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('E5:G5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); // Centrado horizontal

        $sheet->setCellValue('A6', 'NÚCLEO URBANO         : ' . strtoupper($committee->urban_core));
        $sheet->mergeCells('A6:D6');
        $sheet->getStyle('A6')->getFont()->setSize(9);
        $sheet->getStyle('A6:D6')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A6:D6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); // Centrado horizontal

        $sheet->setCellValue('E6', 'FECHA DE REPARTO           : ');
        $sheet->mergeCells('E6:G6');
        $sheet->getStyle('E6')->getFont()->setSize(9);
        $sheet->getStyle('E6:G6')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('E6:G6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); // Centrado horizontal

        $sheet->setCellValue('A7', 'N° DE BENEFICIARIOS : ' . strtoupper($totalBeneficiarios));
        $sheet->mergeCells('A7:D7');
        $sheet->getStyle('A7')->getFont()->setSize(9);
        $sheet->getStyle('A7:D7')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A7:D7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); // Centrado horizontal

        $sheet->setCellValue('E7', 'N° ACTA DE RECEP. DE ALIM. : ' . $mesEnEspanol);
        $sheet->mergeCells('E7:G7');
        $sheet->getStyle('E7')->getFont()->setSize(9);
        $sheet->getStyle('E7:G7')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('E7:G7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); // Centrado horizontal

        $sheet->setCellValue('C8', $mesEnEspanolAbrev);
        $sheet->mergeCells('C8:E8');
        $sheet->getStyle('C8')->getFont()->setSize(9);
        $sheet->getStyle('C8:E8')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('C8:E8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // Centrado horizontal

        $sheet->setCellValue('A9', 'N°');
        $sheet->mergeCells('A9:A10');
        $sheet->getStyle('A9')->getFont()->setSize(9);
        $sheet->getStyle('A9:A10')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A9:A10')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)  // Centrado horizontal
            ->setVertical(Alignment::VERTICAL_CENTER);    // Centrado vertical (nuevo)

        $sheet->setCellValue('B9', 'APELLIDOS Y/O NOMBRES DE APODERADO(A) Y/O SOCIO(A)');
        $sheet->mergeCells('B9:B10');
        $sheet->getStyle('B9')->getFont()->setSize(9);
        $sheet->getStyle('B9:B10')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('B9:B10')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)  // Centrado horizontal
            ->setVertical(Alignment::VERTICAL_CENTER);    // Centrado vertical (nuevo)

        $sheet->setCellValue('C9', 'N° DE BENEFICIARIOS');
        $sheet->mergeCells('C9:C10');
        $sheet->getStyle('C9')->getFont()->setSize(9);
        $sheet->getStyle('C9:C10')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('C9:C10')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)  // Centrado horizontal
            ->setVertical(Alignment::VERTICAL_CENTER);    // Centrado vertical (nuevo)

        $sheet->setCellValue('D9', 'CANTIDAD RECIBIDA');
        $sheet->mergeCells('D9:E9');
        $sheet->getStyle('D9')->getFont()->setSize(9);
        $sheet->getStyle('D9:E9')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('D9:E9')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)  // Centrado horizontal
            ->setVertical(Alignment::VERTICAL_CENTER);    // Centrado vertical (nuevo)
    
        // Ajustar la altura de la fila 10
        $sheet->getRowDimension(10)->setRowHeight(85);

        // 1. Obtener los productos del año actual
        $currentYear = now()->year;
        $productos = \App\Models\VasoDeLecheModels\Product::where('year', $currentYear)->orderBy('name')->get();

        if ($productos->isEmpty()) {
            throw new \Exception("No hay productos configurados para el año actual ($currentYear)");
        }

        // 2. Configuración dinámica de columnas
        $columnaInicioProductos = 'D';
        $cantidadProductos = count($productos);
        $columnaFinalProductos = chr(ord($columnaInicioProductos) + $cantidadProductos - 1);

        // 3. Encabezado principal para productos
        $sheet->setCellValue('D9', 'CANTIDAD RECIBIDA');
        $sheet->mergeCells('D9:' . $columnaFinalProductos . '9');
        $sheet->getStyle('D9')->applyFromArray([
            'font' => ['size' => 9, 'bold' => true],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ]
        ]);

        // 4. Encabezados individuales para cada producto
        foreach ($productos as $index => $producto) {
            $columna = chr(ord('D') + $index);
            $sheet->setCellValue($columna . '10', strtoupper($producto->name));
            $sheet->getStyle($columna . '10')->applyFromArray([
                'font' => ['size' => 9],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ]
            ]);
            $sheet->getColumnDimension($columna)->setWidth(15);
        }

        // 5. Configurar columnas de FIRMA y HUELLA
        $columnaFirma = chr(ord($columnaFinalProductos) + 1);
        $columnaHuella = chr(ord($columnaFirma) + 1);

        // FIRMA
        $sheet->setCellValue($columnaFirma . '9', 'FIRMA');
        $sheet->mergeCells($columnaFirma . '9:' . $columnaFirma . '10');
        $sheet->getStyle($columnaFirma . '9:' . $columnaFirma . '10')->applyFromArray([
            'font' => ['size' => 9, 'bold' => true],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ]
        ]);

        // HUELLA DACTILAR
        $sheet->setCellValue($columnaHuella . '9', 'HUELLA DACTILAR');
        $sheet->mergeCells($columnaHuella . '9:' . $columnaHuella . '10');
        $sheet->getStyle($columnaHuella . '9:' . $columnaHuella . '10')->applyFromArray([
            'font' => ['size' => 9, 'bold' => true],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ]
        ]);

        // 6. Ajustar anchos de columnas fijas
        $sheet->getColumnDimension('A')->setWidth(5);  // N°
        $sheet->getColumnDimension('B')->setWidth(20); // Nombres
        $sheet->getColumnDimension('C')->setWidth(11); // N° Beneficiarios
        $sheet->getColumnDimension($columnaFirma)->setWidth(15);
        $sheet->getColumnDimension($columnaHuella)->setWidth(12);

        // 7. Obtener miembros activos del comité con sus productos
        $members = $committee->vlFamilyMembers()
            ->wherePivot('status', 1)
            ->with([
                'vlMinors' => function($query) {
                    $query->where('status', 1);
                },
                'products' => function($query) use ($productos) {
                    $query->whereIn('product_id', $productos->pluck('id'));
                }
            ])
            ->get();

        // 8. Llenado de datos
        $row = 11;
        foreach ($members as $member) {
            $sheet->setCellValue('A' . $row, $row - 10); // Número de orden
            
            // Nombre completo (apellidos y nombres)
            $nombreCompleto = strtoupper(trim(
                ($member->paternal_last_name ?? '') . ' ' . 
                ($member->maternal_last_name ?? '') . ' ' . 
                ($member->given_name ?? '')
            ));
            $sheet->setCellValue('B' . $row, $nombreCompleto);

            // Número de menores activos asociados
            $numBeneficiarios = $member->vlMinors->count();
            $sheet->setCellValue('C' . $row, $numBeneficiarios);

            // Obtener productos recibidos como array clave-valor [product_id => quantity]
            $productosRecibidos = [];
            foreach ($member->products as $productoRecibido) {
                $productosRecibidos[$productoRecibido->id] = $productoRecibido->pivot->quantity;
            }

            // Llenar cantidades por producto
            foreach ($productos as $index => $producto) {
                $columna = chr(ord('D') + $index);
                $cantidad = $productosRecibidos[$producto->id] ?? 0; // 0 si no existe registro
                $sheet->setCellValue($columna . $row, $cantidad);
            }

            // Columnas de firma y huella (vacías)
            $sheet->setCellValue($columnaFirma . $row, '');
            $sheet->setCellValue($columnaHuella . $row, '');

            $row++;
        }

        // 9. Aplicar estilos a los datos
        $sheet->getStyle('A11:' . $columnaHuella . ($row-1))->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'font' => ['size' => 9]
        ]);

        // Establecer el rango desde A9 hasta la última columna y fila con "wrapText"
        $ultimaColumna = $columnaHuella; // Última columna (en este caso está definida por 'columnaHuella')
        $ultimaFila = $sheet->getHighestRow(); // Obtener la última fila

        // Aplicar "wrapText" desde A9 hasta la última fila y columna
        $sheet->getStyle('A9:' . $ultimaColumna . $ultimaFila)->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,  // Activar el ajuste de texto
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN], // Aplicar bordes finos
            ],
        ]);

        // Ajustar la altura de todas las filas de datos (desde la fila 11 hasta la última fila de datos)
        for ($i = 11; $i < $row; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(50);
        }

        // CONFIGURACIÓN DE IMPRESIÓN 
        $sheet->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT)
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4)
            ->setFitToWidth(1)
            ->setFitToHeight(0);

        $sheet->getPageMargins()
            ->setTop(0.5)
            ->setRight(0.5)
            ->setLeft(0.5)
            ->setBottom(0.5);
        
        // Repetir filas de encabezado en cada página
        $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);    

        
        // Centrar tabla
        $sheet->getPageSetup()->setHorizontalCentered(true);
        $sheet->getPageSetup()->setVerticalCentered(true);
        
        $writer = new Xlsx($spreadsheet);

        // Formatear el nombre del comité para el nombre del archivo
        $nombreComite = strtolower(str_replace(' ', '-', $committee->name));
        $nombreComite = preg_replace('/[^a-z0-9\-]/', '', $nombreComite); // Eliminar caracteres especiales
        
        // Formatear la fecha de descarga
        $fechaDescarga = now()->format('d-m-Y');
        
        // Crear el nombre del archivo
        $fileName = "hoja-distribucion-{$nombreComite}-{$fechaDescarga}.xlsx";

        return response()->streamDownload(
            function() use ($writer) {
                $writer->save('php://output');
            },
            $fileName
        );
    }
}

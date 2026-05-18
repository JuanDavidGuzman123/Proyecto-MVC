<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$excel = new Spreadsheet();
$sheet = $excel->getActiveSheet();

$sheet->setTitle('Villa Dorada');


// TITULOS
$sheet->mergeCells('A1:E1');
$sheet->setCellValue('A1', 'HOTEL VILLA DORADA');

$sheet->mergeCells('A2:E2');
$sheet->setCellValue('A2', 'Reporte de Reservas');


// ENCABEZADOS
$sheet->setCellValue('A4', 'Categoría');
$sheet->setCellValue('B4', 'Fecha Inicio');
$sheet->setCellValue('C4', 'Fecha Final');
$sheet->setCellValue('D4', 'Número Camas');
$sheet->setCellValue('E4', 'Total');


// ESTILO TITULO
$sheet->getStyle('A1')->applyFromArray([
    'font' => [
        'bold' => true,
        'size' => 22,
        'color' => ['rgb' => 'D4AF37']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '000000']
    ]
]);


// ESTILO SUBTITULO
$sheet->getStyle('A2')->applyFromArray([
    'font' => [
        'italic' => true,
        'size' => 12,
        'color' => ['rgb' => 'FFFFFF']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '333333']
    ]
]);


// ESTILO ENCABEZADOS
$sheet->getStyle('A4:E4')->applyFromArray([
    'font' => [
        'bold' => true,
        'color' => ['rgb' => '000000']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'D4AF37']
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN
        ]
    ]
]);

$reservas = $reservas ?? [];
// DATOS
$fila = 5;

foreach ($reservas as $reserva) {

    $sheet->setCellValue('A'.$fila, $reserva['categoria']);
    $sheet->setCellValue('B'.$fila, $reserva['fecha_inicio']);
    $sheet->setCellValue('C'.$fila, $reserva['fecha_final']);
    $sheet->setCellValue('D'.$fila, $reserva['numero_camas']);

    // TOTAL
    $total = $reserva['precio'] * $reserva['n_dias'];

    $sheet->setCellValue('E'.$fila, '$'.$total);

    // ESTILO FILAS
    $sheet->getStyle('A'.$fila.':E'.$fila)->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '999999']
            ]
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'FFFDF5']
        ]
    ]);

    $fila++;
}


// ANCHO COLUMNAS
$sheet->getColumnDimension('A')->setWidth(25);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(20);


if (ob_get_length()) {
    ob_end_clean();
}


// DESCARGA
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header('Content-Disposition: attachment; filename="Villa_Dorada_Reservas.xlsx"');

header('Cache-Control: max-age=0');


$writer = new Xlsx($excel);

$writer->save('php://output');

exit;
?>
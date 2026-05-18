<?php

require_once __DIR__ . '/../../fpdf/fpdf.php';

$reserva = $reserva ?? [];

$pdf = new FPDF();

$pdf->AddPage();



$pdf->SetFillColor(0,0,0);


$pdf->SetFont('Arial','B',22);

$pdf->SetTextColor(212,175,55);

$pdf->Cell(
    0,
    15,
    'HOTEL VILLA DORADA',
    0,
    1,
    'C',
    true
);

$pdf->Ln(5);



$pdf->SetTextColor(80,80,80);

$pdf->SetFont('Arial','',12);

$pdf->Cell(
    0,
    8,
    'Bienvenido a nuestro hotel',
    0,
    1,
    'C'
);

$pdf->Ln(10);


$pdf->SetFillColor(212,175,55);

$pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','B',14);

$pdf->Cell(
    0,
    10,
    'DATOS DE LA RESERVA',
    0,
    1,
    'C',
    true
);

$pdf->Ln(5);

$pdf->SetFont('Arial','',12);

$pdf->SetTextColor(40,40,40);


// CLIENTE
$pdf->SetFillColor(245,245,245);

$pdf->Cell(
    50,
    10,
    'Cliente:',
    1,
    0,
    'L',
    true
);

$pdf->Cell(
    140,
    10,
    ($reserva['name'] ?? '') . ' ' .
    ($reserva['last_name'] ?? ''),
    1,
    1
);



$pdf->Cell(
    50,
    10,
    'Email:',
    1,
    0,
    'L',
    true
);

$pdf->Cell(
    140,
    10,
    ($reserva['email'] ?? ''),
    1,
    1
);


$pdf->Cell(
    50,
    10,
    'Categoria:',
    1,
    0,
    'L',
    true
);

$pdf->Cell(
    140,
    10,
    ($reserva['categoria'] ?? ''),
    1,
    1
);


$pdf->Cell(
    50,
    10,
    'Habitacion:',
    1,
    0,
    'L',
    true
);

$pdf->Cell(
    140,
    10,
    ($reserva['numero'] ?? ''),
    1,
    1
);


$pdf->Cell(
    50,
    10,
    'Personas:',
    1,
    0,
    'L',
    true
);

$pdf->Cell(
    140,
    10,
    ($reserva['n_personas'] ?? ''),
    1,
    1
);



$pdf->Cell(
    50,
    10,
    'Fecha Inicio:',
    1,
    0,
    'L',
    true
);

$pdf->Cell(
    140,
    10,
    ($reserva['fecha_inicio'] ?? ''),
    1,
    1
);


$pdf->Cell(
    50,
    10,
    'Fecha Final:',
    1,
    0,
    'L',
    true
);

$pdf->Cell(
    140,
    10,
    ($reserva['fecha_final'] ?? ''),
    1,
    1
);

$inicio = new DateTime(
    $reserva['fecha_inicio'] ?? date('Y-m-d')
);

$fin = new DateTime(
    $reserva['fecha_final'] ?? date('Y-m-d')
);

$dias = $inicio->diff($fin)->days;

$total = $dias * ($reserva['precio'] ?? 0);

$pdf->Ln(10);


$pdf->SetFont('Arial','B',12);

$pdf->SetTextColor(212,175,55);

$pdf->Cell(
    95,
    12,
    'Precio por noche: $'.($reserva['precio'] ?? 0),
    1,
    0,
    'C'
);


// DIAS
$pdf->Cell(
    95,
    12,
    'Dias: '.$dias,
    1,
    1,
    'C'
);


// TOTAL
$pdf->SetFillColor(0,0,0);

$pdf->SetFont('Arial','B',16);

$pdf->Cell(
    0,
    15,
    'TOTAL: $'.$total,
    0,
    1,
    'C',
    true
);

$pdf->Ln(10);


//  MENSAJE FINAL
$pdf->SetTextColor(90,90,90);

$pdf->SetFont('Arial','I',11);

$pdf->MultiCell(
    0,
    8,
    "Gracias por elegir Hotel Villa Dorada.\n".
    "Esperamos que disfrutes una estadia inolvidable.\n".
    "Te esperamos con los mejores servicios y comodidad."
);

$pdf->Output();

?>
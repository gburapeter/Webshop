<?php


$order_id = $order->getOrderId();
$basket_contents = $order->getBasketContents();
require "/opt/tFPDF/fpdf.php";

$pdf = new FPDF();
$pdf->AddPage();

// Oldal címe
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(190, 10, 'Megrendelés összesítő', null, true, 'C');
$pdf->Cell(190, 10, 'Rendelésszám: ' . $order_id, null, true, 'C');

// Tartalom, fejléc
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetLineWidth(0.7);
$pdf->Cell(120, 10, 'Termék', 'B', false, 'L');
$pdf->Cell(30, 10, 'mennyiség', 'B', false, 'C');
$pdf->Cell(40, 10, 'ár', 'B', true, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(127, 127, 127);
$pdf->SetLineWidth(0.2);

// Tartalom, termék-sorok

foreach($basket_contents as $id => $row) {
    $prod = $row["prod"];
    $pcs  = $row["pcs"];

    $price = $prod->getPrice() * $pcs;
    $pdf->Cell(120, 10, $prod->getName(), 'B', false, 'L');
    $pdf->Cell(30, 10, $pcs, 'B', false, 'C');
    $pdf->Cell(40, 10, $price, 'B', true, 'C');
}

// Tartalom, lábléc
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.7);
$pdf->Cell(150, 10, 'Öszesen:', 'T', false, 'L');
$pdf->Cell(40, 10, $order->getTotal(), 'T', false, 'C');


$__PDF = $pdf->Output('S');
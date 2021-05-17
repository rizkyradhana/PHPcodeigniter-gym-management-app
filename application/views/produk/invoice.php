<?php
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial', 'B', 14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130, 5, 'EXECUTIVE GYM', 0, 0);
$pdf->Cell(59, 5, 'INVOICE', 0, 1); //end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(100, 5, 'Blok B Bisnis Square, Jl. Ahmad Yani No.1, ', 0, 0);
$pdf->Cell(30, 5, '', 0, 0);

$pdf->Cell(59, 5, 'Transaction Date/time', 0, 1);

$pdf->Cell(30, 5, 'Kedaleman, Kec. Cilegon,', 0, 0); //end of line
$pdf->Cell(100, 5, '', 0, 0);
$pdf->Cell(59, 5, $cart[0]['waktu'], 0, 1); //end of line

$pdf->Cell(130, 5, 'Kota Cilegon, Banten 42426', 0, 0);
$pdf->Cell(189, 10, '', 0, 1); //end of line

//billing address
$pdf->Cell(100, 5, 'Suplement Transaction', 0, 1); //end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189, 5, '', 0, 1); //end of line

//invoice contents
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(105, 5, 'Product name', 1, 0);
$pdf->Cell(25, 5, 'Quantity', 1, 0);
$pdf->Cell(25, 5, 'Price', 1, 0);
$pdf->Cell(34, 5, 'Total', 1, 1); //end of line

$pdf->SetFont('Arial', '', 12);

//Numbers are right-aligned so we give 'R' after new line parameter
$total = 0;
foreach ($cart as $dcart) {
    $pdf->Cell(105, 5, $dcart['nama'], 1, 0);
    $pdf->Cell(25, 5, $dcart['jumlah'], 1, 0);
    $pdf->Cell(25, 5, 'Rp' . $dcart['harga'], 1, 0, 'R');
    $pdf->Cell(34, 5, 'Rp' . $dcart['total'], 1, 1, 'R'); //end of line
    $total = $total + $dcart['total'];
}

//summary
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(135, 5, '', 0, 0);
$pdf->Cell(20, 5, 'Total', 0, 0, );
$pdf->Cell(34, 5, 'Rp' . $total, 1, 1, 'R'); //end of line

$pdf->Output();

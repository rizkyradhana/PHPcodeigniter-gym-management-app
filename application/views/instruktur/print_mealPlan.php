<?php
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial', 'B', 14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130, 5, 'MEAL PLAN MEMBER EXECUTIVE GYM', 0, 0);
$pdf->Cell(59, 5, '', 0, 1); //end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(100, 5, 'Name: ' . $mealPlan[0]['nama'], 0, 0);
$pdf->Cell(30, 5, '', 0, 0);

$pdf->Cell(59, 5, '', 0, 1);

$pdf->Cell(30, 5, 'Card id: ' . $mealPlan[0]['id'], 0, 0); //end of line
$pdf->Cell(100, 5, '', 0, 0);
// $pdf->Cell(59, 5, $cart[0]['waktu'], 0, 1); //end of line

$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(189, 10, '', 0, 1); //end of line

//invoice contents
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(60, 5, 'Food name', 1, 0);
$pdf->Cell(25, 5, 'Portion', 1, 0);
$pdf->Cell(25, 5, 'Calorie', 1, 0);
$pdf->Cell(25, 5, 'Protein', 1, 0); //end of line
$pdf->Cell(25, 5, 'Fat', 1, 0);
$pdf->Cell(30, 5, 'Carbohidrate', 1, 1);

$pdf->SetFont('Arial', '', 12);

//Numbers are right-aligned so we give 'R' after new line parameter
// $total = 0;
foreach ($mealPlan as $mp) {
    $pdf->Cell(60, 5, $mp['nama_makanan'], 1, 0);
    $pdf->Cell(25, 5, $mp['porsi'] . ' gr', 1, 0);
    $pdf->Cell(25, 5, $mp['kalori_mealPlan'] . ' kcal', 1, 0);
    $pdf->Cell(25, 5, $mp['protein_mealPlan'] . ' gr', 1, 0);
    $pdf->Cell(25, 5, $mp['lemak_mealPlan'] . ' gr', 1, 0);
    $pdf->Cell(30, 5, $mp['karbohidrat_mealPlan'] . ' gr', 1, 1);

    //end of line

}

//summary
// $pdf->SetFont('Arial', 'B', 12);

// $pdf->Cell(135, 5, '', 0, 0);
// $pdf->Cell(20, 5, 'Total', 0, 0, );
// $pdf->Cell(34, 5, 'Rp' . $total, 1, 1, 'R'); //end of line

$pdf->Output('I', 'Meal Plan_' . $mealPlan[0]['nama'] . '_' . $mealPlan[0]['id'] . '.pdf');

<?php

require('initialize.php');
$tip = $_GET['tip'];
$id = $_GET['id'];

// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);

switch($tip)
{
	
	case 'avtomobili': 
		$naslov = 'Осигурување на автомобил';
		break;
	
	case 'motorcilkli':
		$naslov = 'Осигурување на моторцикал';
		break;
			
	case 'tovarni':
		$naslov = 'Осигурување на товарно возило';
		break;
	
}

//$naslov= iconv('windows-1252', 'UTF-8', $naslov);


$pdf->AddPage();
$pdf->SetFont('Arial','B',16);



$pdf->Cell(40, 10, $naslov);
$pdf->Cell(50,30,'Hello World!');
$pdf->Output('osiguruvanje.pdf' , 'D');

?>
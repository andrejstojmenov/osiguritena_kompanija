<?php

require('initialize.php');
$tip = $_GET['tip'];
$id = $_GET['id'];

mysql_query("SET NAMES utf8");
$results = mysql_query("SELECT * FROM $tip
								JOIN `users`
								ON $tip.user_id = users.id
								WHERE $tip.id = $id
							  ")
								or die(mysql_error());
$result = mysql_fetch_assoc($results);

switch($tip)
{
	
	case 'avtomobili': 
		$naslov = 'Осигурување на автомобил';
		break;
	
	case 'motorcikli':
		$naslov = 'Осигурување на моторцикал';
		break;
			
	case 'tovarni':
		$naslov = 'Осигурување на товарно возило';
		break;
	
}

//$naslov= iconv('windows-1252', 'UTF-8', $naslov);

$pdf = new tFPDF();
$pdf->AddPage();

// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',24);

$pdf->Cell(0,10,$naslov,0,1,'C');
$pdf->Cell(0,10,' ',0,1,'C');
$pdf->SetFont('DejaVu','',14);
$pdf->Cell(0,10,'Податоци за корисникот',1,1,'C');
$pdf->Cell(0,10,' ',0,1,'C');
$pdf->Cell(0,10,'Име: ' . $result['ime'],0,1,'L');
$pdf->Cell(0,10,'Презиме: ' . $result['prezime'],0,1,'L');
$pdf->Cell(0,10,'Лична карта: ' . $result['licna_karta'] ,0,1,'L');
$pdf->Cell(0,10,'Адреса: ' . $result['adresa'],0,1,'L');
$pdf->Cell(0,10,'Телефон: ' . $result['telefon'],0,1,'L');

$pdf->Cell(0,10,' ',0,1,'C');
$pdf->Cell(0,10,'Податоци за осигурувањето',1,1,'C');
$pdf->Cell(0,10,' ',0,1,'C');
$pdf->Cell(0,10,'Регистерски број: '. $result['reg_br'],0,1,'L');
$pdf->Cell(0,10,'Број на шасија: '. $result['br_shasija'],0,1,'L');
$pdf->Cell(0,10,'Марка: '. $result['marka'],0,1,'L');
$pdf->Cell(0,10,'Тип: '. $result['tip'],0,1,'L');
$pdf->Cell(0,10,'Сила: '. $result['sila'],0,1,'L');
$pdf->Cell(0,10,'Зафатнина: '. $result['zafatnina'],0,1,'L');
$pdf->Cell(0,10,'Година: '. $result['godina'],0,1,'L');
$pdf->Cell(0,10,'Боја: '. $result['boja'],0,1,'L');
$pdf->Cell(0,10,'Цена: '. $result['cena']. ' Ден.',0,1,'C');

$pdf->Output('osiguruvanje.pdf' , 'D');

?>
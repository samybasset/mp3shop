<?php
while (ob_get_level())
ob_end_clean();
header("Content-Encoding: None", true);
require '../init.php';
$user = new User;
$date = new DateTime();
$order = new Order();
if($user->is_user_logged_in() == false) {
	header('location: ../index.php');
}

// if($_SESSION['role'] == 'admin')
// {
// 	$result = $db_handle->runQuery("select klant.naam, item.weborderID, album.titel, item.aantal, album.prijs
// 																	 from klant
// 																	 inner join (weborder
// 																	 inner join (item
// 																	 inner join album on album.ID = item.albumID)
// 																	 on weborder.ID = item.weborderID)
// 																	 on klant.ID = weborder.klantID");
// }


$result = $order->get_single_order($_SESSION['user']);


$header = array("Naam", "OrderID", "Titel", "aantal", "prijs");

require('fpdf181/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

foreach($header as $column_heading) {
	$pdf->Cell(39,16, $column_heading,1);
}
foreach($result as $row) {
	$pdf->SetFont('Arial','',11);
	$pdf->Ln();
	foreach($row as $column) {
		$pdf->Cell(39,16,$column,1);
	}
}
// $pdf->Cell(39,16, $result['naam'],1);

$pdf->Output();
?>

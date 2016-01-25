<?php 


	$q = $db->prepare("select klant.naam, item.weborderID, album.titel, item.aantal, album.prijs, role
										 from klant
										 inner join (weborder
										 inner join (item
										 inner join album on album.ID = item.albumID)
										 on weborder.ID = item.weborderID)
										 on klant.ID = weborder.klantID");
	$q->execute(array(":1" => $_SESSION['naam']));
	$row = $q->fetchAll(PDO::FETCH_ASSOC);
	require 'fpdf181/fpdf.php';
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(10, 40, 'hey');
	$pdf->Output();
?>
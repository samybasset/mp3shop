	<?php
	session_start();
	require_once("dbcontroller.php");
	$db_handle = new DBController();

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

		$result = $db_handle->runQuery("select klant.naam, item.weborderID, album.titel, item.aantal, album.prijs
																		 from klant
																		 inner join (weborder
																		 inner join (item
																		 inner join album on album.ID = item.albumID)
																		 on weborder.ID = item.weborderID)
																		 on klant.ID = weborder.klantID where weborderID = " . $_GET['weborderID'] . "");
	

	
	$header = array("Naam", "OrderID", "Titel", "aantal", "prijs");

	require('fpdf/fpdf.php');
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',12);		
	
	foreach($header as $column_heading) {
		$pdf->Cell(39,16, $column_heading,1);
}
	foreach($result as $row) {
		$pdf->SetFont('Arial','',11);	
		$pdf->Ln();
		foreach($row as $column)
			$pdf->Cell(39,16,$column,1);
	}

	$pdf->Output();
	?>




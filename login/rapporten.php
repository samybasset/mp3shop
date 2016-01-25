<?php include('../assets/includes/connect.php');
require 'fpdf181/fpdf.php'; 
session_start();
if($_SESSION['login'] != 1)
{
	echo '<script>location.href = "../index.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MP3 shop | manage albums</title>
	<!-- Font awesome CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class='rapporten'>
	<div class="wrapper">
		<div class="sidebar">
			<?php include 'assets/includes/header.php'; ?>
		</div>
		<div class="content">
			<div class="well"><h3>Manage users</h3></div>
			<div class="container">
				<form method='post' class='viewOrder'>
					<label for="chosenOrder">Choose an order</label>
					<select name="album-code" id="chosenOrder">
						<option value="">Choose an order</option>
						<option value="orders">Total ordered albums</option>
					</select>
					<input type="submit" class='btn btn-default' value='View order' name='submit'>
				</form>
				<?php if(isset($_POST['submit'])) ?>
				<table class="table table-hover">
						<tr>
							<th>Customor name</th>
							<th>Weborder</th>
							<th>Album titel</th>
							<th>Prijs</th>	
							<th>Aantal</th>
							<th>Bedrag</th>
						</tr>
					<tbody>
						<?php 
							$q = $db->prepare('select * from klant
															 where email = :1');
							$q->execute(array(":1" => $_SESSION['naam']));
							$row = $q->fetch(PDO::FETCH_ASSOC);

							if($row['role'] == 'user')
							{
								$q = $db->prepare("select klant.naam, item.weborderID, album.titel, item.aantal, album.prijs, role
																	 from klant
																	 inner join (weborder
																	 inner join (item
																	 inner join album on album.ID = item.albumID)
																	 on weborder.ID = item.weborderID)
																	 on klant.ID = weborder.klantID where email = :1");
								$q->execute(array(":1" => $_SESSION['naam']));
								$row = $q->fetchAll(PDO::FETCH_ASSOC);

								$bgcolor = true;
								$weborder = $row[0]['weborderID'];
								// echo gettype($wewborder);
								$subtotaal = 0;
								$totaal = 0;
								$totaalprijs = 0;
								$eerstekeer = true;

								foreach($row as $row)
								{
									if($row['role'] == 'user') {
										echo ($bgcolor ? "<tr class='even'>" : "<tr>");

										//check new weborder
										if($row['weborderID'] == $weborder)
										{
											if($eerstekeer)
											{

												echo "<td>".$row['naam']."</td>
															<td>".$row['weborderID']."</td>";
												$eerstekeer = false;
											}
											else
											{
												//klant en weborder niet herhalen
												echo "<td></td><td></td>";
											}
												echo "<td>".$row['titel']."</td>
															<td>".$row['prijs']."</td>
															<td>".$row['aantal']."</td>
															<td>".number_format($row['prijs'] * $row['aantal'],2, '.', '')."</td>
														</tr>";
												//keep track of totals
												$subtotaal += $row['aantal'];
												$totaal += $row['aantal'];
												$totaalprijs += $row['prijs'] * $row['aantal'];
										}
										else
										{
											// nieuwe weborder print eerst sub totaal.
											echo ($bgcolor ? "<tr class='even'>" : "<tr>");
												echo "<td></td><td></td>
															<td><b>Subtotaal</b></td>
															<td><b>".$subtotaal."</b></td><td></td><td></td>
														</tr>
														";
											$subtotaal = 0;
											$bgcolor = ($bgcolor ? false:true);
											//print nieuwe weborder
											echo ($bgcolor ? "<tr class='even'>" : "<tr>");
												echo "<td>".$row['naam']. "</td>
															<td>".$row['weborderID']."</td>
															<td>".$row['titel']."</td>
															<td>".$row['prijs']."</td>
															<td>".$row['aantal']."</td>
															<td>".number_format($row['prijs'] * $row['aantal'],2)."</td>
														</tr>";
											//totalen bij houden
											$subtotaal += $row['aantal'];
											$totaal += $row['aantal'];
											$totaalprijs += $row['prijs'] * $row['aantal'];
										}
										//Save nieuwe weborderID
										$weborder = $row['weborderID'];
									}
									
								}
							} 
							else 
							{
								$q = $db->prepare("select klant.naam, item.weborderID, album.titel, item.aantal, album.prijs, role
																	 from klant
																	 inner join (weborder
																	 inner join (item
																	 inner join album on album.ID = item.albumID)
																	 on weborder.ID = item.weborderID)
																	 on klant.ID = weborder.klantID");
								$q->execute();
								$row = $q->fetchAll(PDO::FETCH_ASSOC);

								$bgcolor = true;
								$weborder = $row[0]['weborderID'];
								// echo gettype($wewborder);
								$subtotaal = 0;
								$totaal = 0;
								$totaalprijs = 0;
								$eerstekeer = true;

								foreach($row as $row)
								{
										echo ($bgcolor ? "<tr class='even'>" : "<tr>");

										//check new weborder
										if($row['weborderID'] == $weborder)
										{
											if($eerstekeer)
											{

												echo "<td>".$row['naam']."</td>
															<td>".$row['weborderID']."</td>";
												$eerstekeer = false;
											}
											else
											{
												//klant en weborder niet herhalen
												echo "<td></td><td></td>";
											}
												echo "<td>".$row['titel']."</td>
															<td>".$row['prijs']."</td>
															<td>".$row['aantal']."</td>
															<td>".number_format($row['prijs'] * $row['aantal'],2, '.', '')."</td>
														</tr>";
												//keep track of totals
												$subtotaal += $row['aantal'];
												$totaal += $row['aantal'];
												$totaalprijs += $row['prijs'] * $row['aantal'];
										}
										else
										{
											// nieuwe weborder print eerst sub totaal.
											echo ($bgcolor ? "<tr class='even'>" : "<tr>");
												echo "<td></td><td></td>
															<td><b>Subtotaal</b></td>
															<td><b>".$subtotaal."</b></td><td></td><td></td>
														</tr>
														";
											$subtotaal = 0;
											$bgcolor = ($bgcolor ? false:true);
											//print nieuwe weborder
											echo ($bgcolor ? "<tr class='even'>" : "<tr>");
												echo "<td>".$row['naam']. "</td>
															<td>".$row['weborderID']."</td>
															<td>".$row['titel']."</td>
															<td>".$row['prijs']."</td>
															<td>".$row['aantal']."</td>
															<td>".number_format($row['prijs'] * $row['aantal'],2)."</td>
														</tr>";
											//totalen bij houden
											$subtotaal += $row['aantal'];
											$totaal += $row['aantal'];
											$totaalprijs += $row['prijs'] * $row['aantal'];
										}
										//Save nieuwe weborderID
										$weborder = $row['weborderID'];
								}
							}
							//print laatste subtotaal en eind totaal
							echo ($bgcolor ? "<tr class='even'>" : "<tr>");
								echo "<td></td><td></td><td></td>
											<td><b>Subtotaal</b></td>
											<td>".$subtotaal."</td><td></td>
										</tr>";

							echo "<tr><td></td><td></td><td></td>
										<td><b>Totaal: </b></td>
										<td>".$totaal."</td>

										<td>".number_format($totaalprijs,2, '.', '')."</td>
									</tr>";
						
							
						?>
					</tbody>
				</table>
				<?php 
					if(isset($_POST['submit']))
					{
						
					}
				?>
			</div>
		</div>
	</div>
</body>
<!-- Jquery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!-- Custom JS -->
<script src='../assets/js/script.js'></script>
</html>
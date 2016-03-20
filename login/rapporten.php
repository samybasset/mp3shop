<?php
	require '../init.php';
	$user = new User;
	$date = new DateTime();
	$order = new Order();
	if($user->is_user_logged_in() == false) {
		header('location: ../index.php');
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
				<table class="table table-hover">
						<tr>
							<th>Weborder</th>
							<th>Customor name</th>
							<th>Album titel</th>
							<th>Prijs</th>
							<th>Aantal</th>
							<th>Bedrag</th>
							<th>Download PDF</th>
						</tr>
					<tbody>
						<?php
							$get_role = $user->get_user_role($_SESSION['user']);
							if($get_role == 'user') {
								$get_orders = $order->get_single_order($_SESSION['user']);
							} elseif($get_role == 'admin') {
								$get_orders = $order->get_orders();
							}
							$subtotaal = 0;
							$totaal = 0;
							$totaal_albums = 0;
							$new_order = true;
							$weborder = $get_orders[0]['weborderID'];
							$even = true;

							foreach($get_orders as $get_order) {
								$_GET['weborderID'] = $get_order['weborderID'];
								$bedrag = $get_order['verkoopprijs'] * $get_order['aantal'];
								if($even) {
									echo '<tr class="even">';
								} else {
									echo "<tr>";
								}
								if($get_order['weborderID'] == $weborder) {
									if($new_order) {
										echo '<td>'.$get_order['naam'].'</td>
													<td>'.$get_order['weborderID'].'</td>';
									  $new_order = false;
									} else {
										//klant naam in een order niet herhalen
										echo '<td></td><td></td>';
									}


						     echo '	<td>'.$get_order['titel'].'</td>
												<td>'.$get_order['verkoopprijs'].'</td>
												<td>'.$get_order['aantal'].'</td>
												<td>&#8364;'.number_format($bedrag, 2, ",", "").'</td>
												<td><a href="pdftest.php?weborderID='.$_GET['weborderID'].'">Download PDF</a></td>
										  </tr>';
								 //totalen bij houden(aantal albums, prijs totaal prijs updaten)
								 $subtotaal+= $get_order['aantal'];
								 $totaal_albums += $get_order['aantal'];
								 $totaal += $bedrag;
								 $_GET['weborderID'] = $get_order['weborderID'];
							 } else {
								 if($even) {//check of even true is, als die true is dan krijgt de order een achtergrond kleurtje(elke order om en om)
									 echo '<tr class="even">';
								 } else {
									 echo '<tr>';
								 }
								 //weer geven van subtotalen per order, de extra td's zijn om de subtotalen op te schuiven
								 echo '
								 			 <td></td><td></td>
								 			 <td></td><td><b>Subtotaal: </b></td>
								 			 <td><b>'.$subtotaal.'</b><td></td><td></td></td></tr>';
								// reset subtotaal voor nieuwe order
								$subtotaal = 0;
								if($even) {//check of even true is, als die true is dan krijgt de order een achtergrond kleurtje(elke order om en om)
									echo '<tr class="even">';
									$even = false;
								} else {
									echo '<tr>';
									$even = true;
								}
								//Weergeef nieuwe orders
								echo '
											<td>'.$get_order['weborderID'].'</td>
											<td>'.$get_order['naam'].'</td>
											<td>'.$get_order['titel'].'</td>
											<td>'.$get_order['verkoopprijs'].'</td>
											<td>'.$get_order['aantal'].'</td>
											<td>&#8364;'.number_format($bedrag, 2, ",", "").'</td>
											<td><a href="pdftest.php?weborderID='.$_GET['weborderID'].'">Download PDF</a></td>
										</tr>';

   							$subtotaal += $get_order['aantal'];
								$totaal_albums += $get_order['aantal'];
								$totaal += $bedrag;
								$_GET['weborderID'] = $get_order['weborderID'];
								}
								$weborder = $get_order['weborderID'];
							 }

							 if($even) {
								 echo '<tr class="even">';
							 } else {
								 echo '<tr>';
							 }
							echo '		<td></td><td></td><td></td>';
							echo '		<td><b>Subtotaal</b></td>
								 				<td><b>'.$subtotaal.'</b></td><td></td>
											 </tr>';
							echo '<tr>
											<td></td><td></td><td></td>
											<td><b>Aantal verkochte albums:</b><td><b>'.$totaal_albums.'</b></td></td>
											<td><b>Totaal prijs: </b>'.number_format($totaal, 2, ",", "").'<td>
										</tr>';




						?>
					</tbody>
				</table>
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

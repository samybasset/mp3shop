<?php include('../assets/includes/connect.php'); 
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
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class='dashboard'>
	<div class="wrapper">
		<div class="sidebar">
			<?php include 'assets/includes/header.php'; ?>
		</div>
		<div class="content">
			<div class="well"><h3>Manage Albums</h3></div>
			<div class="container">
				<table class="table table-hover">
					<th>
						<tr>
							<td>Albumcode</td>
							<td>Titel</td>
							<td>Artiest</td>
							<td>Genre</td>
							<td>Prijs</td>
							<td>Voorraad</td>
							<td>Aantal</td>
							<td>Edit</td>
							<td>Delete</td>
						</tr>
					</th>	
					<tbody>
						<?php 
							$q = $db->prepare("select distinct * from album");
							$q->execute();
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo "
									<tr>
										<td>".$row['albumcode']."</td>
										<td>".$row['titel']."</td>
										<td>".$row['artiest']."</td>
										<td>".$row['genre']."</td>
										<td>".$row['prijs']."</td>
										<td>".$row['voorraad']."</td>
										<td>".$row['aantal']."</td>
										<td><button type='submit'></button></td>
										<td>edit delete</td>
									</tr>
								";
							}
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
</html>
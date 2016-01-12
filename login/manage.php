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
	<!-- Font awesome CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class='users'>
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
							<th>Albumcode</th>
							<th>Titel</th>
							<th>Artiest</th>
							<th>Genre</th>
							<th>Prijs</th>
							<th>Voorraad</th>
							<th>Aantal</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</th>	
					<tbody>
						<?php 
						// function for editing existing albums.
							function updateField($albumcode, $field, $value) {
								include '../assets/includes/connect.php';
								$q = $db->prepare('update album set '.$field.' = :1 where albumcode = :2');
								$q->execute(array(":1" => $value, ":2" => $albumcode));
							}

							function deleteRow($albumcode) {
								include '../assets/includes/connect.php';
								$q = $db->prepare('delete from album where albumcode = :1');
								$q->execute(array(":1" => $albumcode));
							}

							//Looping trough all albums and showing them in a table.
							$q = $db->prepare("select distinct * from album");
							$q->execute();
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo "
											<tr>
												<td>
													<form method='post'>
														<span>".$row['albumcode']."</span>
														<input type='text' name='val' value='".$row['albumcode']."'>
														<input type='hidden' name='row' value='albumcode'>
														<input type='hidden' name='albumcode' value='".$row['albumcode']."'>
														<input type='submit' name='submit' value='' class='editTable'>
													</form>
												</td>
												<td>
													<form method='post'>
														<span>".$row['titel']."</span>
														<input type='text' name='val' value='".$row['titel']."'>
														<input type='hidden' name='row' value='titel'>
														<input type='hidden' name='albumcode' value='".$row['albumcode']."'>
														<input type='submit' name='submit' value='' class='editTable'>
													</form>
												</td>
												<td>
													<form method='post'>
														<span>".$row['artiest']."</span>
														<input type='text' name='val' value='".$row['artiest']."'>
														<input type='hidden' name='row' value='artiest'>
														<input type='hidden' name='albumcode' value='".$row['albumcode']."'>
														<input type='submit' name='submit' value='' class='editTable'>
													</form>
												</td>
												<td>
													<form method='post'>
														<span>".$row['genre']."</span>
														<input type='text' name='val' value='".$row['genre']."'>
														<input type='hidden' name='row' value='genre'>
														<input type='hidden' name='albumcode' value='".$row['albumcode']."'>
														<input type='submit' name='submit' value='' class='editTable'>
													</form>
												</td>
												<td>
													<form method='post'>
														<span>".$row['prijs']."</span>
														<input type='text' name='val' value='".$row['prijs']."'>
														<input type='hidden' name='row' value='prijs'>
														<input type='hidden' name='albumcode' value='".$row['albumcode']."'>
														<input type='submit' name='submit' value='' class='editTable'>
													</form>
												</td>
												<td>
													<form method='post'>
														<span>".$row['voorraad']."</span>
														<input type='text' name='val' value='".$row['voorraad']."'>
														<input type='hidden' name='row' value='voorraad'>
														<input type='hidden' name='albumcode' value='".$row['albumcode']."'>
														<input type='submit' name='submit' value='' class='editTable'>
													</form>
												</td>
												<td>
													<form method='post'>
														<span>".$row['aantal']."</span>
														<input type='text' name='val' value='".$row['aantal']."'>
														<input type='hidden' name='row' value='aantal'>
														<input type='hidden' name='albumcode' value='".$row['albumcode']."'>
														<input type='submit' name='submit' value='' class='editTable'>
													</form>
												</td>
												<td><button type='text' class='edit'><i class='fa fa-pencil'></i></button></td>
												<td><form method='post'><input type='hidden' name='deleteID' value='".$row['albumcode']."'><input type='submit' name='delete' class='delete' value=''></td>
											</tr>
									";
							}
							if(isset($_POST['submit']))
							{
								// call the updatefield function with the correct parrameters that is collected from inputs in the while loop.
								updateField($_POST['albumcode'], $_POST['row'], $_POST['val']);
								echo '<script>location.href = "manage.php";</script>';
							}
							if(isset($_POST['delete']))
							{
									// call the deleteRow function with the correct parrameters that is collected from inputs in the while loop.
								deleteRow($_POST['deleteID']);
								echo '<script>location.href = "manage.php";</script>';
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
<!-- Custom JS -->
<script src='../assets/js/script.js'></script>
</html>
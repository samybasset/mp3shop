<?php
	require '../init.php';
	$user = new User;
	$date = new DateTime();
	$album = new Album();
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
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</th>
					<tbody>
						<?php
							$get_albums = $album->get_albums();
							foreach($get_albums as $get_album) {
								echo '
												<tr>
													<td>'.$get_album['ID'].'<input type="hidden" name="ID" value="'.$get_album['ID'].'"></td>
													<form method="post"><td><input type="text" name="val" value="'.$get_album['titel'].'"><button name="update"><i class="fa fa-check"></i></button><input type="hidden" name="ID" value="'.$get_album['ID'].'"><input type="hidden" name="row" value="titel"></td></form>
													<form method="post"><td><input type="text" name="val" value="'.$get_album['artiest'].'"><button name="update"><i class="fa fa-check"></i></button><input type="hidden" name="ID" value="'.$get_album['ID'].'"><input type="hidden" name="row" value="artiest"></td></form>
													<form method="post"><td><input type="text" name="val" value="'.$get_album['genre'].'"><button name="update"><i class="fa fa-check"></i></button><input type="hidden" name="ID" value="'.$get_album['ID'].'"><input type="hidden" name="row" value="genre"></td></form>
													<form method="post"><td><input type="text" name="val" value="'.$get_album['prijs'].'"><button name="update"><i class="fa fa-check"></i></button><input type="hidden" name="ID" value="'.$get_album['ID'].'"><input type="hidden" name="row" value="prijs"></td></form>
													<form method="post"><td><input type="text" name="val" value="'.$get_album['voorraad'].'"><button name="update"><i class="fa fa-check"></i></button><input type="hidden" name="ID" value="'.$get_album['ID'].'"><input type="hidden" name="row" value="voorraad"></td></form>
													<form method="post"><td></td></form>
													<form method="post"><td><input type="hidden" name="ID" value="'.$get_album['ID'].'"><button name="delete"><i class="fa fa-trash"></i></button></td></form>
												</tr>

								';
							}
							if(isset($_POST['update'])) {//if clicked on update field call update field function
								$album->update_field($_POST['ID'], $_POST['row'], $_POST['val']);
								echo '<script>location.href="manage.php"</script>';
								echo '<script>document.write("jeej")</script>';
							}

							if(isset($_POST['delete'])) { //if clicked on delete button call delete row function
								$album->delete_row($_POST['ID']);
								echo '<script>location.href="manage.php"</script>';
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

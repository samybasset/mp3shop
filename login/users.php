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
<body class='dashboard'>
	<div class="wrapper">
		<div class="sidebar">
			<?php include 'assets/includes/header.php'; ?>
		</div>
		<div class="content">
			<div class="well"><h3>Manage users</h3></div>
			<div class="container">
				<table class="table table-hover">
					<th>
						<tr>
							<th>userID</th>
							<th>username</th>
							<th>password</th>	
						</tr>
					</th>	
					<tbody>
						<?php 
						// function for editing existing albums.
							function updateField($userID, $field, $value) {
								include '../assets/includes/connect.php';
								$q = $db->prepare('update users set '.$field.' = :1 where userID = :2');
								$q->execute(array(":1" => $value, ":2" => $userID));
							}

							function deleteRow($userID) {
								include '../assets/includes/connect.php';
								$q = $db->prepare('delete from users where userID = :1');
								$q->execute(array(":1" => $userID));
							}

							//Looping trough all albums and showing them in a table.
							$q = $db->prepare("select distinct * from users");
							$q->execute();
							while($row = $q->fetch(PDO::FETCH_ASSOC))
							{
								echo "
										<form method='get'>
										<tr>
											<td>
												
													".$row['userID']."
											</td>
											<td>
													<span>".$row['username']."</span>
													<input type='hidden' name='row' value='username'>
													<input type='hidden' name='userID' value='".$row['userID']."'>
											</td>
											<td>
													<input type='submit' value='click here to reset password' name='reset'>
													<input type='hidden' name='userID' value='".$row['userID']."'>
												</form>
											</td>
										</tr>
										</form>
									";
							}
							if(isset($_POST['submit']))
							{
								// call the updatefield function with the correct parrameters that is collected from inputs in the while loop.
								updateField($_POST['userID'], $_POST['row'], $_POST['val']);
								echo '<script>location.href = "users.php";</script>';
								$q = prepare('select * from users');
								$q->execute();

								$row = $q-> fetch(PDO::FETCH_ASSOC);
								echo "<a href='resetpassword.php?userID=".$_GET['userID']."'>resetpassword.php'?userID=".$_GET['userID']."</a>";
							}
							if(isset($_POST['delete']))
							{
									// call the deleteRow function with the correct parrameters that is collected from inputs in the while loop.
								deleteRow($_POST['deleteID']);
								echo '<script>location.href = "users.php";</script>';
							}
							if(isset($_GET['reset']))
							{
								$q = $db->prepare('select * from users');
								$q->execute();
								// echo "<script>alert('hooray');</script>";
								$row = $q-> fetch(PDO::FETCH_ASSOC);
								echo "<a href='resetpassword.php?userID=".$_GET['userID']."'>resetpassword.php'?userID=".$_GET['userID']."</a>";
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
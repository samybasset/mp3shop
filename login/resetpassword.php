<?php
	require '../init.php';
	$user = new User;
	$date = new DateTime();
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
<body class='dashboard'>
	<div class="wrapper">
		<div class="sidebar">
			<?php include 'assets/includes/header.php'; ?>
		</div>
		<div class="content">
			<div class="well"><h3>Manage users</h3></div>
			<div class="container">
				<div class="well">
					<h4>Hello <?php echo $_SESSION['user'] ?>, fill in your new password to reset your password.</h4> <!-- Show username above password fields.-->
				</div>
				<form method='post'>
					<div class="form-group">
						<label>Please fill in a new password</label>
						<input type="password" class='form-control' name='password'>
					</div>
					<div class="form-group">
						<label>Please repeat filled in password</label>
						<input type="password" class='form-control' name='repeatPassword'>
					</div>
					<div class="form-group">
						<input type="submit" class='btn btn-default' value='Reset password' name='submit'>
					</div>
				</form>
				<?php
					if(isset($_POST['submit'])) {
						if($_POST['password'] == $_POST['repeatPassword']) {
							$user->update_password($_GET["ID"], $date->getTimestamp(),$_POST['password']);
							echo '<div class="alert alert-success" role="alert"><b>Succes!</b> Password changed. :)</div>';
						} else {
							echo '<div class="alert alert-danger" role="alert"><b>Oh oh!</b> Passwords don\'t match :(</div>';
						}
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

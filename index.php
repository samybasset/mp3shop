<?php
require 'init.php';
$_SESSION['login'] = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MP3 shop login</title>
	<!-- Font awesome CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div class="wrapper">
		<?php include 'assets/includes/header.php'; ?>
		<div class="container">
			<!-- Begin nav -->
			<!-- End nav -->
			<div class="well"><h3>Please login to see the album dashboard.</h3></div>
			<!-- Begin login form -->
			<form method="POST">
				<div class="form-group">
					<label for="name">Gebruikersnaam</label>
					<input type="text" class="form-control" id="name" name="name" placeholder="Voer gebruikersnaam in" required>
				</div>
				<div class="form-group">
					<label for="password">Wachtwoord</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Voer wachtwoord in" required>
				</div>
				<div class="form-group">
					<a href="register.php">Klik hier om aan te melden</a>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" name='submit' value='Login'>
				</div>
			</form>
      <?php
        if(isset($_POST['submit'])) {
          $user = new User();
          $get_user = $user->get_user($_POST['name']);
          if($user->user_login($_POST['name'], $get_user['salt'], $_POST['password']) > 0) {
            $_SESSION['login'] = 1;
            $_SESSION['user'] = $_POST['name'];
            header('location: login/');
          } elseif($user->user_login($get_user['email'], $get_user['salt'], $_POST['password']) == 0) {
            echo '<div class="alert alert-danger" role="alert"><b>Oh Oh! </b>Sorry pall, wrong username or password :(</div>';
          }

        }
      ?>
			<!-- End login form -->
		</div>
	</div>
</body>
<!-- Jquery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</html>

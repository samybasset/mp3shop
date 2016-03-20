<?php require 'init.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MP3 shop Register</title>
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
			<div class="well"><h3>Please register for an account.</h3></div>
			<!-- End nav -->
			<!-- Begin login form -->
			<form method="POST">
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" class='form-control' name='name' id='name' placeholder='Fill in name please' required>
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<input type="text" class='form-control' name='address' id='address' placeholder='Fill in address please' required>
				</div>
				<div class="form-group">
					<label for="postcode">Postcode</label>
					<input type="text" class='form-control' name='postcode' id='postcode' placeholder='Fill in postcode please' required>
				</div>
				<div class="form-group">
					<label for="city">City</label>
					<input type="text" class='form-control' name='city' id='city' placeholder='Fill in name please' required>
				</div>
				<div class="form-group">
					<label for="username">Email</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Fill in email please." required>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Fill in password please." required>
				</div>
				<div class="form-group">
					<a href="#">Klik hier om aan te melden</a>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" name='submit' value='Login'>
				</div>
			</form>
			<!-- End login form -->
			<?php
				if(isset($_POST['submit'])) {
					$user = new User();
					$date = new DateTime();
					$user->register_user($_POST['name'],
					 										 $_POST['address'],
															 $_POST['postcode'],
															 $_POST['city'],
															 $_POST['username'],
															 $date->getTimestamp(),
															 $_POST['password']
														 );
						echo '<div class="well"><strong>Account aangemaakt, u kunt nu inloggen</strong></div>';
						echo $user->register_user($_POST['name'],
						 										 $_POST['address'],
																 $_POST['postcode'],
																 $_POST['city'],
																 $_POST['username'],
																 $date->getTimestamp(),
																 $_POST['password']
															 );
				}
			 ?>
		</div>
	</div>
</body>
<!-- Jquery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</html>

<?php include('assets/includes/connect.php');
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MP3 shop login</title>
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
					<label for="username">Gebruikersnaam</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Voer gebruikersnaam in" required>
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
			<!-- End login form -->
			<?php 
				//if login button is posted
				if(isset($_POST['submit']))
				{
					if(!empty($_POST['username'] && $_POST['password']))
					{
						$username = $_POST['username'];
						$password = hash("sha256", $_POST['password']);
						// $password = $_POST['password'];
						$q = $db->prepare('select * from users where username = :1 AND password = :2');
						$q->execute(array(':1' => $username, ':2' => $password));
						$num = $q->rowCount();
						$row = $q->fetch(PDO::FETCH_ASSOC);
						if($num > 0)
						{
							$_SESSION['login'] = 1;
							echo '<script> location.href = "login/index.php";</script>';
						}
						else {
							echo '<div class="alert alert-danger" role="alert">Sorry stranger. :(</div>';
						}
					}
					else
					{
						echo '<div class="alert alert-danger" role="alert">Please fill in all the fields.</div>';
					}
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
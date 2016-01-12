<?php include('../assets/includes/connect.php'); 
session_start();
if($_SESSION['login'] != 1) // if loggin session doesnt equals 1 redirect too login page.
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
				<div class="well">
					<?php 
						$id = $_GET['userID']; // retrieve get variable from previous page
						$q = $db->prepare('select * from users where userID = :1'); // query select all whre userID = retrieved get variable
						$q->execute(array(":1" => $id));
						$row = $q->fetch(PDO::FETCH_ASSOC); // retrieve data from database.
					?>
					<h4>Hello <?php echo ucfirst($row['username']) ?>, fill in your new password to reset your password.</h4> <!-- Show username above password fields.-->
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
					if(isset($_POST['submit']))//if post submit.
					{
						if($_POST['password'] == $_POST['repeatPassword'])//if passwords match
						{
							$password = hash("sha256", $_POST['password']);//hashing password too sha256
							$q = $db->prepare("update users set `password` = :1 where userID = :2");//query update user password where id is the userID that is stored in Get variable.
							$q->execute(array(":1" => $password, ":2" => $_GET['userID']));// execute prepared query
							echo "<script>location.href = 'users.php'</script>";// switch location too users.php page.
						}
						else
						{
							echo '<div class="alert alert-danger" role="alert">Passwords dont match.</div>';// if passwords don't match show error message.
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
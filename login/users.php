<?php
	require '../init.php';
	$user = new User;
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
							$get_user_role = $user->get_user_role($_SESSION['user']);
							if($get_user_role == 'user') {//if the user role equals user then show a single user(only the logged in user can change his own password)
								$get_users = $user->get_single_user($_SESSION['user']);
							} elseif($get_user_role == 'admin') {// if the user role equals admin then show all users(admin can change all user passwords)
								$get_users = $user->get_users();
							}
							foreach($get_users as $user) {
								$_GET['ID'] = $user['ID'];
								echo '
										<form method="get">
											<tr>
												<td>'.$user['ID'].'</td>
												<td>'.$user['email'].'</td>
												<td><a href="resetpassword.php?ID='.$_GET["ID"].'">Reset wachtwoord</a></td>
												<td>'.$user['role'].'</td>
										  </tr>
										</form>';
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

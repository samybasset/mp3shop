<div class="username">
	<ul>
		<li><p>Logged in as: <span><?php echo $_SESSION['user'] ?></span><span><form method='post'><input type='submit' name='logout' value='Klik hier om uit te loggen'></form></span></p></li>
	</ul>
	<?php
	?>
</div>
<nav>
	<ul class='nav nav-pills nav-stacked'>
		<li><a href="index.php">Dashboard</a></li>
		<li><a href="manage.php">Manage Albums</a></li>
		<li><a href="rapporten.php">Rapporten</a></li>
		<li><a href="order.php">Order albums</a></li>
		<li><a href="users.php">Users</a></li>
	</ul>
</nav>
<?php
	if(isset($_POST['logout'])) {
		$_SESSION['login'] == 0;
		session_destroy();
		header("location: ../index.php");
	}
?>

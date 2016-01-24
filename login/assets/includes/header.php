<div class="username">
	<ul>
		<li><p>Logged in as: <span><?php echo $_SESSION['naam']; ?></span><span><form method='post'><input type='submit' name='submit' value='Klik hier om uit te loggen'></form></span></p></li>
	</ul>
</div>
<nav>
	<ul class='nav nav-pills nav-stacked'>
		<li><a href="index.php">Dashboard</a></li>
		<li><a href="manage.php">Manage Albums</a></li>
		<li><a href="rapporten.php">Rapporten</a></li>
		<li><a href="users.php">Users</a></li>
	</ul>
</nav>

<?php 
	if(isset($_POST['submit']))
	{
		$_SESSION['login'] = 0;
		echo "<script>location.href = '../index.php';</script>";
	}
 ?>
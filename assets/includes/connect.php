<?php 
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db_name = 'mp3shop';

	try {
		$db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_pass);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$result = $db->query('SELECT * FROM album');
		// while($row = $result->fetch(PDO::FETCH_ASSOC))
		// {
		// 	echo '<pre>';
		// 		print_r($row);
		// 	echo '</pre>';
		// }
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}

?>
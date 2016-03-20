<?php
	require '../init.php';
	$user = new User;
  $album = new Album;
	$cart = new Cart();
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
				<div class="orders">
          <form method="post">
            <input type="text" name="search" value="" placeholder="zoek album of genre">
            <button type="submit" name="submit" class='btn btn-primary'>Zoek album</button>
          </form>
				  <?php
          if(isset($_POST['submit'])) {
            $get_album = $album->search_album($_POST['search']);
						$row_count = count($get_album = $album->search_album($_POST['search']));
						if($row_count == 0) {
							echo '<hr>';
								echo '<div class="item">';
									echo '<div class="alert alert-danger" role="alert"><b>Bummer! <i class="fa fa-frown-o"></i></b> No albums found, try something else.</div>';
								echo '</div>';
						} else {
							foreach ($get_album as $get_album) {
	              echo '<hr>';
	                echo '<div class="item">
													<form method="post">';
		                  echo $get_album['artiest'] . ' - ' .$get_album['titel'] . '<br>';
											echo 'Genre: ' . $get_album['genre'] . '<br>';
		                  echo $get_album['prijs'] . '<br>';
		                  echo 'Aantal: <input type="text" name="aantal"><br>
														<button type="submit" name="order">Bestel album</button>';
										echo '</form>';
	                echo '</div>';
	            }
						}
          } else {
						$get_album = $album->get_albums();
						foreach ($get_album as $get_album) {
							echo '<hr>';
								echo '<div class="item">';
									echo '<form method="post">';
										echo $get_album['artiest'] . ' - ' .$get_album['titel'] . '<br>';
										echo 'Genre: ' . $get_album['genre'] . '<br>';
										echo $get_album['prijs'] . '<br>';
										echo '<input type="hidden" name="productID" value="'.$get_album['ID'].'">
													Aantal: <input type="text" name="aantal"><br>
													<button type="submit" name="order">Bestel album</button>';
									echo '</form>';
								echo '</div>';
					}
				}

           ?>
				</div>
        <div class="shoppingcart">
          <div class="well">
            Shoppingcart<form method="post"><button type="submit" name="empty_cart">Empty cart</button></form>
						<?php
							if(isset($_POST['empty_cart'])) {
								$cart->empty_cart();
							}
						 ?>
          </div>
					<table class="table table-hover">
							<tr>
								<th>ID</th>
								<th>titel</th>
								<th>Artiest</th>
								<th>Bedrag</th>
								<th>Aantal</th>
							</tr>
						<tbody>
							<?php
								$get_cart_items = $cart->add_to_cart(isset($_POST['productID']));
								if(isset($_POST['order'])) {
									$get_cart_items = $cart->add_to_cart($_POST['productID']);
									echo '<script>location.href = "order.php";</script>';
									print_r($_POST);
								}
								foreach($get_cart_items as $get_cart_item) {
									$get_items = $album->get_album($get_cart_item);
									foreach($get_items as $get_item) {
										echo '<tr>
														<td>'.$get_item['ID'].'</td>
														<td>'.$get_item['titel'].'</td>
														<td>'.$get_item['artiest'].'</td>
														<td>'.$get_item['prijs'].'</td>
														<td>2</td>
													</tr>';
										}
									}

							 ?>
						</tbody>
					</table>
        </div>
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

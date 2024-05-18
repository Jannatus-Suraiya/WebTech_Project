<?php 
 include '../Controllers/allCtrl.php';
if (empty($_SESSION['user_id'])) {
		$warning_msg[] = 'Please login first!';
	}

	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: login.php");
	}

?>
<style type="text/css">
	<?php include 'style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<title>DairyDirect - product detail page</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="main">
		<div class="banner">
			<h1>product detail</h1>
		</div>
		<div class="title2">
			<a href="home.php">home </a><span>/ product detail</span>
		</div>
		<section class="view_page">
			<?php 
				if (isset($_GET['pid'])) {
					$pid = $_GET['pid'];
					$select_products = $conn->prepare("SELECT * FROM `products` WHERE id = '$pid'");
					$select_products->execute();
					if ($select_products->rowCount()>0) {
						while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){


			?>
			<form method="post">
				<img src="image/<?php echo $fetch_products['image']; ?>">
				<div class="detail">
					<div class="price">TK <?php echo $fetch_products['price']; ?>/-</div>
					<div class="name"><?php echo $fetch_products['name']; ?></div>
					<div class="detail">
						<p> Dairy products are made from milk, most commonly from cows, but also from goats, sheep, and even buffalo! They come in a wide variety  including everyone's favorites like cheese, yogurt, and ice cream, but also butter, cream, and even lactose-free options.  Dairy products are a great source of calcium, protein, and other essential nutrients. </p>

					</div>
					<input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
					<div class="button">
						<button type="submit" name="add_to_wishlist" class="btn">add to wishlist<i class="bx bx-heart"></i></button>
						<input type="hidden" name="qty" value="1" min="0" class="quantity">
						<button type="submit" name="add_to_cart" class="btn">add to cart<i class="bx bx-cart"></i></button>
					</div>
				</div>
			</form>
			<?php 
						}
					}
				}
			?>
		</section>
		<?php include 'footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include '../Controllers/alert.php'; ?>
</body>
</html>
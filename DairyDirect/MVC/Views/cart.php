<?php 
 include '../Controllers/allCtrl.php';
if (empty($_SESSION['user_id'])) {
		$warning_msg[] = 'Please login first!';
	}

	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: login.php");
	}

		//delete item from cart
	if (isset($_POST['delete_item'])) {
		$cart_id1 = $_POST['cart_id'];
		//$cart_id1 = filter_var($cart_id1, FILTER_SANITIZE_STRING);

		$varify_delete_items = $conn->prepare("SELECT * FROM `cart` WHERE id =?");
		$varify_delete_items->execute([$cart_id1]);

		if ($varify_delete_items->rowCount()>0) {
			$delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
			$delete_cart_id->execute([$cart_id1]);
			$success_msg[] = "cart item delete successfully";
		}else{
			$warning_msg[] = 'cart item already deleted';
		}
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
	<title>DairyDirect - wishlist page</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="main">
		<div class="banner">
			<h1>my cart</h1>
		</div>
		<div class="title2">
			<a href="home.php">home </a><span>/ cart</span>
		</div>
		<section class="products">
			<h1 class="title">products added in cart</h1>
			<div class="box-container">
				<?php 
					$grand_total = 0;
					$select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
					$select_cart->execute([$user_id]);
					if ($select_cart->rowCount()>0) {
						while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
							$select_products = $conn->prepare("SELECT * FROM `products` WHERE id= ?");
							$select_products->execute([$fetch_cart['product_id']]);
							if ($select_products->rowCount()> 0 ) {
								$fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)
							
				?>
				<form method="post" action="" class="box">
					<input type="hidden" name="cart_id" value="<?=$fetch_cart['id']; ?>">
					<img src="image/<?=$fetch_products['image']; ?> " class="imgCart" >
					<h3 class="name"><?=$fetch_products['name']; ?></h3>
					<div class="flex">
						<p class="price">price TK <?=$fetch_products['price']; ?>/-</p>
						<input type="number" name="qty" required min="1" value="<?=$fetch_cart['qty']; ?>" max="99" maxlength="2" class="qty">
						<button type="submit" name="update_cart" class="bx bx-upload fa-upload"></button>
					</div>
					<p class="sub-total">sub total : <span>TK <?=$sub_total = ($fetch_cart['qty']* $fetch_cart['price']) ?></span></p>
					
					<button type="submit" name="delete_item" class="btn" onclick="return confirm('delete this item')">delete</button>
				</form>
				<?php 
							$grand_total+=$sub_total;
							}else{
								echo '<p class="empty">product was not found</p>';
							}
						}
					}else{
						echo '<p class="empty">no products added yet!</p>';
					}
				?>
			</div>
			<?php 
				if ($grand_total !=0) {
				
			?>
			<div class="cart-total">
				<p>total amount payable : <span>TK <?= $grand_total; ?>/-</span></p>
				<div class="button">
					<form method="post">
						<button type="submit" name="empty_cart" class="btn" onclick="return confirm('are you sure to empty your cart')">empty cart</button>
					</form>
					<a href="checkout.php" class="btn">proceed to checkout</a>
				</div>
			</div>
			<?php } ?>
		</section>
		<?php include 'footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include '../Controllers/alert.php'; ?>
</body>
</html>
<?php 
require_once('../Models/connection.php');
 session_start();
 if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
	}

	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: login.php");
	}
?>
<style type="text/css">
	<?php require_once('style.css'); ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<title>Dairy Direct</title>
</head>
<body>
	<?php require_once('header.php'); ?>
	<div class="main">
		
		<section class="home-section">
			<div class="slider">
				<div class="slider__slider slide1">
					<div class="overlay"></div>
					<div class="slide-detail">
						<h1><span>WELCOME TO DAIRY DIRECT</span></h1>
						<p><span>Made for those who seek a premium quality & freshness.</span></p>
						<a href="view_products.php" class="btn">shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="slider__slider slide2">
					<div class="overlay"></div>
					<div class="slide-detail">
						<h1><span>WELCOME TO DAIRY DIRECT</span></h1>
						<p><span>Dairy products now on your door steps.</span></p>						
						<a href="view_products.php" class="btn">shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="slider__slider slide3">
					<div class="overlay"></div>
					<div class="slide-detail">
						<h1><span>WELCOME TO DAIRY DIRECT</span></h1>
						<p><span>Made for those who seek a premium quality & freshness.</span></p>
						<a href="view_products.php" class="btn">shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="slider__slider slide4">
					<div class="overlay"></div>
					<div class="slide-detail">
						<h1><span>WELCOME TO DAIRY DIRECT</h1>
						<p><span>Made for those who seek a premium quality & freshness.</p>
						<a href="view_products.php" class="btn">shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="slider__slider slide5">
					<div class="overlay"></div>
					<div class="slide-detail">
						<h1><span>WELCOME TO DAIRY DIRECT</span></h1>
						<p><span>Dairy products now on your door steps.</span></p>
						<a href="view_products.php" class="btn">shop now</a>
					</div>
					<div class="hero-dec-top"></div>
					<div class="hero-dec-bottom"></div>
				</div>
				<!-- slide end -->
				<div class="left-arrow"><i class='bx bxs-left-arrow'></i></div>
                <div class="right-arrow"><i class='bx bxs-right-arrow'></i></div>
			</div>
		</section>
		<!-- home slider end -->
		<section class="thumb">
			<div class="box-container">
				<div class="box">
					<img src="img/thumb2.jpg" width="150" height="150">
					<h3>Milk</h3>
					<p>Lactose Free milk.</p>
					<a href="view_products.php" class="cart-btn"><i class="bx bx-chevron-right"></i></a>
				</div>
				<div class="box">
					<img src="img/thumb1.jpg" width="150" height="150">
					<h3>Butter</h3>
					<p>A wonderful source of good fat.</p>
					<a href="view_products.php" class="cart-btn"><i class="bx bx-chevron-right"></i></a>
				</div>
				<div class="box">
					<img src="img/thumb0.jpg" width="150" height="150">
					<h3>Goat Milk</h3>
					<p>Milk of domestic goats.</p>
					<a href="view_products.php" class="cart-btn"><i class="bx bx-chevron-right"></i></a>
				</div>
				<div class="box">
					<img src="img/thumb.jpg" width="150" height="150">
					<h3>Ghee</h3>
					<p>clarified butter.</p>
					<a href="view_products.php" class="cart-btn"><i class="bx bx-chevron-right"></i></a>
				</div>
			</div>
		</section>
		
		<section class="services">
			<div class="box-container">
				<div class="box">
					<img src="img/icon1.png">
					<div class="detail">
						<h3>24*7 support</h3>
						<p>one-on-one support</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon0.png">
					<div class="detail">
						<h3>gift vouchers</h3>
						<p>vouchers on every festivals</p>
					</div>
				</div>
				<div class="box">
					<img src="img/icon.png">
					<div class="detail">
						<h3>Delivery within The city</h3>
						<p>COD available</p>
					</div>
				</div>
			</div>
		</section>
		<?php require_once('footer.php'); ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php require_once('../Controllers/alert.php'); ?>
</body>
</html>
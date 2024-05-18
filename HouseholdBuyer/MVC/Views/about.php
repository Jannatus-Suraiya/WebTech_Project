<?php 
 include '../Models/connection.php';
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
	<?php include 'style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<title>Dairy Direct - about us page</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="main">
		<div class="banner">
			<h1>about us</h1>
		</div>
		<div class="title2">
			<a href="home.php">home </a><span>/ about</span>
		</div>
		<div class="about-category">
			<div class="box">
				<img src="img/a1.png">
				<div class="detail">
					<span>Ghee</span>
					<h1>Gawa Ghee</h1>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="img/a2.png">
				<div class="detail">
					<span>Milk</span>
					<h1>Lactose Free</h1>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="img/a3.png">
				<div class="detail">
					<span>Butter</span>
					<h1>Organic Butter</h1>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
			<div class="box">
				<img src="img/a4.png">
				<div class="detail">
					<span>Butter</span>
					<h1>Goat Butter</h1>
					<a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
		</div>
		<section class="services">
			<div class="title">
				<img src="img/download.jpg" class="logo">
				<h1>why choose us</h1>
				<p>Brought to you from the farm with love.
                </p>
			</div>
			<div class="box-container">
				<div class="box">
					<img src="img/icon2.png">
					<div class="detail">
						<h3>great savings</h3>
						<p>save big every order</p>
					</div>
				</div>
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
						<h3>worldwide delivery</h3>
						<p>dropship worldwide</p>
					</div>
				</div>
			</div>
		</section>
		<div class="about">
			<div class="row">
				<div class="img-box">
					<img src="img/a5.png">
				</div>
				<div class="detail">
					<h1>visit our the shop!</h1>
					<p>Derived from milk and produced in wide ranges of flavors, textures and forms by coagulation of the milk protein casein.</p>
                    <a href="view_products.php" class="btn">shop now</a>
				</div>
			</div>
		</div>
		<div class="testimonial-container">
			<div class="title">
				<img src="img/download.jpg" class="logo">
				<h1>what people say about us</h1>
				<p>BEST TASTING DAIRY PRODUCT ON THE MARKET!
                </p>
            </div>
                <div class="container">
                	<div class="testimonial-item active">
                		<img src="img/01.jpg">
                		<h1>sara smith</h1>
                		<p>"This butter tastes delicious. It also has fewer calories, lower cholesterol, and even lower percentage of saturated fat than other brands. And it tastes great unlike imitation butter spreads made from oils and other substances. There's just no comparison."</p>
                	</div>
                	<div class="testimonial-item">
                		<img src="img/02.jpg">
                		<h1>john smith</h1>
                		<p>"It’s a good product. Highly recommended."</p>
                	</div>
                	<div class="testimonial-item">
                		<img src="img/03.jpg">
                		<h1>selena ansari</h1>
                		<p>"I come 2 times a week to get white milk for the family and go old buttermilk for me. Lucky for me I'm only 12 miles from DairyDirect Farms."</p>
                	</div>
                	<div class="testimonial-item">
                		<img src="img/04.png">
                		<h1>alweena ansari</h1>
                		<p>"If you absolutely, positively want the best tasting milk on the market, DairyDirect is your only choice! We have visited the farm, we know where this milk comes from."</p>
                	</div>
                	<div class="left-arrow" onclick="nextSlide()"><i class="bx bxs-left-arrow-alt"></i></div>
                	<div class="right-arrow" onclick="prevSlide()"><i class="bx bxs-right-arrow-alt"></i></div>
                </div>
		</div>
		<?php include 'footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<script type="text/javascript">
		let slides = document.querySelectorAll('.testimonial-item');
		let index = 0;

		function nextSlide(){
		    slides[index].classList.remove('active');
		    index = (index + 1) % slides.length;
		    slides[index].classList.add('active');
		}
		function prevSlide(){
		    slides[index].classList.remove('active');
		    index = (index - 1 + slides.length) % slides.length;
		    slides[index].classList.add('active');
		}
	</script>
	<?php include '../Controllers/alert.php'; ?>
</body>
</html>
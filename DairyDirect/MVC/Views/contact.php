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
	<title>Dairy Direct - home page</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="main">
		<div class="banner">
			<h1>contact us</h1>
		</div>
		<div class="title2">
			<a href="home.php">home </a><span>/ contact us</span>
		</div>
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
						<h3>Within Dhaka delivery</h3>
						<p>from door to door</p>
					</div>
				</div>
			</div>
		</section>
		<div class="form-container">
			 <form method="post">
			 	<div class="title">
			 		<img src="img/download.jpg" class="logo">
			 		<h1>leave a message</h1>
			 	</div>
			 	<div class="input-field">
			 		<p>your name <sup>*</sup></p>
			 		<input type="text" name="name">
			 	</div>
			 	<div class="input-field">
			 		<p>your email <sup>*</sup></p>
			 		<input type="email" name="email">
			 	</div>
			 	<div class="input-field">
			 		<p>your number <sup>*</sup></p>
			 		<input type="text" name="number">
			 	</div>
			 	<div class="input-field">
			 		<p>your message <sup>*</sup></p>
			 		<textarea name="message"></textarea>
			 	</div>
			 	<button type="submit" name="submit-btn" class="btn">send message</button>
			 </form>
			 
		</div>
		<div class="address">
			 	<div class="title">
			 		<img src="img/download.jpg" class="logo">
			 		<h1>contact detail</h1>
			 		<p>With the right process, magic can happen.</p>
			 	</div>
			 	<div class="box-container">
			 		<div class="box">
			 			<i class="bx bxs-map-pin"></i>
			 			<div>
			 				<h4>address</h4>
			 				<p>House #20 (3rd Floor) Road # 17, Nikanjia-2 Dhaka, Bangladesh</p>
			 			</div>
			 		</div>
			 		<div class="box">
			 			<i class="bx bxs-phone-call"></i>
			 			<div>
			 				<h4>phone number</h4>
			 				<p>01700000000</p>
			 			</div>
			 		</div>
			 		<div class="box">
			 			<i class="bx bxs-map-pin"></i>
			 			<div>
			 				<h4>email</h4>
			 				<p>communications@gmail.com</p>
			 			</div>
			 		</div>
			 	</div>
			 </div>
		<?php include 'footer.php'; ?>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script src="script.js"></script>
	<?php include '../Controllers/alert.php'; ?>
</body>
</html>
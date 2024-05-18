<?php 
	include '../Controllers/allCtrl.php';
	//session_start();

	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
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
	<title>Dairy Direct - login now</title>
</head>
<body>
	<div class="main-container">
		<section class="form-container">
			<div class="title">
				<a href="home.php"><img src="img/download.jpg" alt="Logo"></a>
				<h1>login now</h1>
				<p>A premium dairy product that upraises quality, freshness & taste. Ingredients that will define the meaning of dairies.</p>
			</div>
			<form action="" method="post">
				<div class="input-field">
					<p>your email <sup>*</sup></p>
					<input type="email" name="email" required placeholder="enter your email" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
				</div>
				<div class="input-field">
					<p>your password <sup>*</sup></p>
					<input type="password" name="pass" required placeholder="enter your password" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
				</div>
				
				<input type="submit" name="submit" value="login now" class="btn">
				<p>do not have an account? <a href="register.php">register now</a></p>
			</form>
		</section>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<?php include '../Controllers/alert.php'; ?>
</body>
</html>

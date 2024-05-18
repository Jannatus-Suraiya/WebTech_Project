<?php 
	include '../Controllers/allCtrl.php';
	//session_start();

	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	} else {
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
	<title>DairyDirect - Register Now</title>
</head>
<body>
	<div class="main-container">
		<section class="form-container">
			<div class="title">
				<a href="home.php"><img src="img/download.jpg" alt="Logo"></a>
				<h1>Register Now</h1>
				<p>A premium dairy products that upraises quality, freshness & taste. Ingredients that will define the meaning of dairies.</p>
			</div>
			<form action="" method="post">
				<div class="input-field">
					<p>Your Name <sup>*</sup></p>
					<input type="text" name="name" required placeholder="Enter your name" maxlength="50">
				</div>
				<div class="input-field">
					<p>Your Email <sup>*</sup></p>
					<input type="email" name="email" required placeholder="Enter your email" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
				</div>
				<div class="input-field">
					<p>Your Role <sup>*</sup></p>
					<select name="role" required>
						<option value="">Select your role</option>
						<option value="Household Customer">Household Customer</option>
						<option value="Commercial Customer">Commercial Customer</option>
					</select>
				</div>
				<div class="input-field">
					<p>Your Password <sup>*</sup></p>
					<input type="password" name="pass" required placeholder="Enter your password" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
				</div>
				<div class="input-field">
					<p>Confirm Password <sup>*</sup></p>
					<input type="password" name="cpass" required placeholder="Enter your password again" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
				</div>
				<input type="submit" name="submit" value="Register Now" class="btn">
				<p>Already have an account? <a href="login.php">Login now</a></p>
			</form>
		</section>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<?php include '../Controllers/alert.php'; ?>
</body>
</html>

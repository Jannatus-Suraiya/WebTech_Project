<?php 
	include '../Controllers/allCtrl.php';
	//session_start();

	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	} else {
		$user_id = '';
	}

		// Register user
	if (isset($_POST['submit'])) {
		$id = unique_id();
		$name = $_POST['name'];
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		$email = $_POST['email'];
		$email = filter_var($email, FILTER_SANITIZE_STRING);
		$role = $_POST['role'];
		$role = filter_var($role, FILTER_SANITIZE_STRING);
		$pass = $_POST['pass'];
		$pass = filter_var($pass, FILTER_SANITIZE_STRING);
		$cpass = $_POST['cpass'];
		$cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

		$select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
		$select_user->execute([$email]);
		$row = $select_user->fetch(PDO::FETCH_ASSOC);

		if ($select_user->rowCount() > 0) {
			$warning_msg[] = 'Email already exists';
		} else {
			if ($pass != $cpass) {
				$warning_msg[] = 'Confirm your password';
			} else {
				$insert_user = $conn->prepare("INSERT INTO `users` (id, name, email, role, password) VALUES (?, ?, ?, ?, ?)");
				$insert_user->execute([$id, $name, $email, $role, $pass]);
				header('location: home.php');
				exit; // Ensure script stops after redirection
			}
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

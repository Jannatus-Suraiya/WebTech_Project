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
<style>
	<?php include 'style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- font awesome cdn link  -->
   <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<title>User Login page</title>
</head>
<body style="padding-left: 0 !important;">
	
		<?php include 'header.php'; ?>
		<div class="main">
			<div class="banner">
				<h1>update profile</h1>
			</div>
			<div class="title2">
				<a href="home.php">home </a><span>/ update profile</span>
			</div>
		<section>
			<?php 
				if (isset($message)) {
					foreach ($message as $message) {
						echo '
							<div class="message">
								<span>'.$message.'</span>
								<i class="bx bx-x" onclick="this.parentElement.remove();"></i>
							</div>
						';
					}
				}
			?>
			<div class="form-container" id="login">
				<form action="" method="post" enctype="multipart/form-data">
                    <div class="profile">
    <img src="img/<?= isset($fetch_users['profile']) ? $fetch_users['profile'] : '01.jpg' ?>" class="logo-image" width="100">
</div>
<h3>update profile</h3>
<input type="hidden" name="old_image" value="<?= isset($fetch_users['profile']) ? $fetch_users['profile'] : '' ?>">
<div class="input-field">
    <label>User name <sup>*</sup></label>
    <input type="text" name="name" maxlength="20" placeholder="Enter your username" oninput="this.value.replace(/\s/g,'')" value="<?= isset($fetch_users['name']) ? $fetch_users['name'] : '' ?>">
</div>
<div class="input-field">
    <label>User email <sup>*</sup></label>
    <input type="email" name="email" maxlength="20" placeholder="Enter your username" oninput="this.value.replace(/\s/g,'')" value="<?= isset($fetch_users['name']) ? $fetch_users['email'] : '' ?>">
</div>


					<div class="input-field">
						<label>old password <sup>*</sup></label>
						<input type="password" name="old_pass" maxlength="20" placeholder="Enter your password" oninput="this.value.replace(/\s/g,'')">
					</div>
					<div class="input-field">
						<label>new password <sup>*</sup></label>
						<input type="password" name="new_pass" maxlength="20" placeholder="Enter your password" oninput="this.value.replace(/\s/g,'')">
					</div>
					<div class="input-field">
						<label>confirm password <sup>*</sup></label>
						<input type="password" name="confirm_pass" maxlength="20" placeholder="Enter your password" oninput="this.value.replace(/\s/g,'')">
					</div>
					<div class="input-field">
						<label>upload profile <sup>*</sup></label>
						<input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp">
					</div>
					<input type="submit" name="submit" value="update profile" class="btn">
				</form>
			</div>
		</section>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include '../Controllers/alert.php'; ?>
</body>
</html>
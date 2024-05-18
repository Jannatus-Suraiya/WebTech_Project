<?php 
 include '../Controllers/allCtrl.php';
if (empty($_SESSION['user_id'])) {
		$warning_msg[] = 'Please login first!';
	}

	if (isset($_POST['logout'])) {
		session_destroy();
		header("location: login.php");
	}

		

	//Update Profile
	if(isset($_POST['submit'])){

	   $name = $_POST['name'];
	   $name = filter_var($name, FILTER_SANITIZE_STRING);
	   
	   //condition to update name
	   if (!empty($name)) {
	   	$select_name = $conn->prepare("SELECT * FROM `users` WHERE name = ?");
	   	$select_name->execute([$name]);

	   	if ($select_name->rowCount() > 0) {
	   		$message[] = 'username already taken!';
	   	}else{
	   		$update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id=?");
	   		$update_name->execute([$name, $user_id]);
	   	}
	   }


	   $email = $_POST['email'];
	   $email = filter_var($email, FILTER_SANITIZE_STRING);
	   
	   //condition to update email
	   if (!empty($email)) {
	   	$select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
	   	$select_email->execute([$email]);

	   	if ($select_email->rowCount() > 0) {
	   		$message[] = 'email already taken!';
	   	}else{
	   		$update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id=?");
	   		$update_email->execute([$email, $user_id]);
	   	}
	   }

	   //condition to update profile image
	   $old_image = $_POST['old_image'];
	   $image = $_FILES['image']['name'];
	   $image = filter_var($image, FILTER_SANITIZE_STRING);
	   $image_tmp_name = $_FILES['image']['tmp_name'];
	   $image_folder = 'image/'.$image;

	   $update_image = $conn->prepare("UPDATE `users` SET profile = ? WHERE id = ?");
	   $update_image->execute([$image, $user_id]);
	   move_uploaded_file($image_tmp_name, $image_folder);
	   if ($old_image != $image AND $old_image != '') {
	   	unlink('image/'.$old_image);
	   }
	   $message[] = 'profile updated!';

	   //condition to update password
	   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
	   $select_old_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
	   $select_old_pass->execute([$user_id]);

	   $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
	   $prev_pass = $fetch_prev_pass['password'];
	   $old_pass = sha1($_POST['old_pass']);
	   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
	   $new_pass = sha1($_POST['new_pass']);
	   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
	   $confirm_pass = sha1($_POST['confirm_pass']);
	   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

	   if ($old_pass != $empty_pass) {
	   	if ($old_pass != $prev_pass) {
	   		$message[] = 'old password not matched';
	   	}elseif ($new_pass != $confirm_pass) {
	   		$message[] = 'confirm password not matched';
	   	}else{
	   		if ($new_pass != $empty_pass) {
	   			$update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
	   			$update_pass->execute([$confirm_pass, $user_id]);
	   			$message[] = 'password updated successfully';
	   		}else{
	   			$message[] = 'please enter a new password';
	   		}
	   	}
	   }
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
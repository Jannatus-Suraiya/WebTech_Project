<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LOG AND REG</title>
	<link rel="stylesheet" href="../../style.css?v=<?php echo time(); ?>">
</head>

<body>
	<header>
		<!-- <h2 class="dairyD">DairyDirect</h2> -->
		<img src="../../DairyDirect.png" alt="Company Logo" width="95px" height="50px" align="left">
		<nav class="navigation">
			<a href="../../home.php">Home</a>
			<a href="  ">About</a>
			<a href="  ">Services</a>
			<a href="  ">Contact</a>
			<button class="btnlog-popup">Login</button>
		</nav>
	</header>

   <div class="wrapper">

      <span class="icon-close"><ion-icon name="close"></ion-icon></span>

   	<div class="from-box login">
   		<h2>Login</h2>
   		<form method="post" action="../Controllers/logCheckController.php">
         
         <div class="input-box">
         	<span class="icon"><ion-icon name="contact"></ion-icon></span>
         	<input type="text" name="id" required>
         	<label>ID</label>
         </div>

         <div class="input-box">
         	<span class="icon"><ion-icon name="lock"></ion-icon></span>
         	<input type="text" name="pass" required>
         	<label>Password</label>
         </div>

         <div class="remember-forgot">
         	<label><input type="checkbox">Remember me</label>
         	<a href="#">Forgot Password?</a>
         </div>
         
         <button name="log" type="submit" class="btn">Login</button>

         <div class="login-reg">
         	<p>Don't have an account?<a href="#" class="reg-link">Register</a></p>
         </div>

   		<?php 
         if(!empty($_SESSION['mess']))
         {
            echo $_SESSION['mess'];
         }?>
         </form>	
   	</div>

   	<div class="from-box reg">
   		<h2>Registration</h2>
   		<form method="post" action="../Controllers/regCheckController.php">
         
         <div class="input-box">
         	<span class="icon"><ion-icon name="contact"></ion-icon></span>
         	<input type="text" name="id" required>
         	<label>ID</label>
         </div>

         <div class="input-box">
         	<span class="icon"><ion-icon name="mail"></ion-icon></span>
         	<input type="text" name="email" required>
         	<label>Email</label>
         </div>

         <div class="input-box">
         	<span class="icon"><ion-icon name="lock"></ion-icon></span>
         	<input type="text" name="pass" required>
         	<label>Password</label>
         </div>

         <div class="remember-forgot">
         	<label><input type="checkbox">I agree to the terms & conditions</label>
         </div>
         
         <button name="log" type="submit" class="btn">Register</button>

         <div class="login-reg">
         	<p>Already have an account?<a href="#" class="login-link">Login</a></p>
         </div>

         </form>	
   	</div>

   </div>

   <script src="../../script.js"></script>
   <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
</body>
</html>
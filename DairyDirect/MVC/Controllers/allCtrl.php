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

	//login user
	if (isset($_POST['submit'])) {

		$email = $_POST['email'];
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$pass = $_POST['pass'];
		$pass = filter_var($pass, FILTER_SANITIZE_STRING);

		$select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? and password = ?");
		$select_user->execute([$email,$pass]);
		$row = $select_user->fetch(PDO::FETCH_ASSOC);

		if ($select_user->rowCount() > 0 ) {
			$_SESSION['user_id'] = $row['id'];
			$_SESSION['user_name'] = $row['name'];
			$_SESSION['user_email'] = $row['email'];
			$_SESSION['consumer_role'] = $row['role']; // Fixed missing semicolon
			header('location: home.php');
		}else{
			$warning_msg[] = 'incorrect username or password';
		}
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

	//adding products in wishlist
	if (isset($_POST['add_to_wishlist'])) {
		$id = unique_id();
		$product_id = $_POST['product_id'];

		$varify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
		$varify_wishlist->execute([$user_id, $product_id]);

		$cart_num = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
		$cart_num->execute([$user_id, $product_id]);

		if ($varify_wishlist->rowCount() > 0) {
			$warning_msg[] = 'product already exist in your wishlist';
		}else if ($cart_num->rowCount() > 0) {
			$warning_msg[] = 'product already exist in your cart';
		}else{
			$select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
			$select_price->execute([$product_id]);
			$fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

			$insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(id, user_id,product_id,price) VALUES(?,?,?,?)");
			$insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);
			$success_msg[] = 'product added to wishlist successfully';
		}
	}
	//adding products in cart
	if (isset($_POST['add_to_cart'])) {
		$id = unique_id();
		$product_id = $_POST['product_id'];

		$qty = $_POST['qty'];
		$qty = filter_var($qty, FILTER_SANITIZE_STRING);

		$varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
		$varify_cart->execute([$user_id, $product_id]);

		$max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
		$max_cart_items->execute([$user_id]);

		if ($varify_cart->rowCount() > 0) {
			$warning_msg[] = 'product already exist in your cart';
		}else if ($max_cart_items->rowCount() > 20) {
			$warning_msg[] = 'cart is full';
		}else{
			$select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
			$select_price->execute([$product_id]);
			$fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

			$insert_cart = $conn->prepare("INSERT INTO `cart`(id, user_id,product_id,price,qty) VALUES(?,?,?,?,?)");
			$insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
			$success_msg[] = 'product added to cart successfully';
		}
	}

	//adding products in cart
	if (isset($_POST['add_to_cart'])) {
		$id = unique_id();
		$product_id = $_POST['product_id'];

		$qty = 1;
		$qty = filter_var($qty, FILTER_SANITIZE_STRING);

		$varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
		$varify_cart->execute([$user_id, $product_id]);

		$max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
		$max_cart_items->execute([$user_id]);

		if ($varify_cart->rowCount() > 0) {
			$warning_msg[] = 'product already exist in your cart';
		}else if ($max_cart_items->rowCount() > 20) {
			$warning_msg[] = 'cart is full';
		}else{
			$select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
			$select_price->execute([$product_id]);
			$fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

			$insert_cart = $conn->prepare("INSERT INTO `cart`(id, user_id,product_id,price,qty) VALUES(?,?,?,?,?)");
			$insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
			$success_msg[] = 'product added to cart successfully';
		}
	}




	//adding products in wishlist
	if (isset($_POST['add_to_wishlist'])) {
		$id = unique_id();
		$product_id = $_POST['product_id'];

		$varify_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ? AND product_id = ?");
		$varify_wishlist->execute([$user_id, $product_id]);

		$cart_num = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
		$cart_num->execute([$user_id, $product_id]);

		if ($varify_wishlist->rowCount() > 0) {
			$warning_msg[] = 'product already exist in your wishlist';
		}else if ($cart_num->rowCount() > 0) {
			$warning_msg[] = 'product already exist in your cart';
		}else{
			$select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
			$select_price->execute([$product_id]);
			$fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

			$insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(id, user_id,product_id,price) VALUES(?,?,?,?)");
			$insert_wishlist->execute([$id, $user_id, $product_id, $fetch_price['price']]);
			$success_msg[] = 'product added to wishlist successfully';
		}
	}
	//adding products in cart
	if (isset($_POST['add_to_cart'])) {
		$id = unique_id();
		$product_id = $_POST['product_id'];

		$qty = $_POST['qty'];
		$qty = filter_var($qty, FILTER_SANITIZE_STRING);

		$varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");
		$varify_cart->execute([$user_id, $product_id]);

		$max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
		$max_cart_items->execute([$user_id]);

		if ($varify_cart->rowCount() > 0) {
			$warning_msg[] = 'product already exist in your cart';
		}else if ($max_cart_items->rowCount() > 20) {
			$warning_msg[] = 'cart is full';
		}else{
			$select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
			$select_price->execute([$product_id]);
			$fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

			$insert_cart = $conn->prepare("INSERT INTO `cart`(id, user_id,product_id,price,qty) VALUES(?,?,?,?,?)");
			$insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
			$success_msg[] = 'product added to cart successfully';
		}
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

	//Checkout product
	if (isset($_POST['place_order'])) {

		$name = $_POST['name'];
		$name = filter_var($name, FILTER_SANITIZE_STRING);
		$number = $_POST['number'];
		$number = filter_var($number, FILTER_SANITIZE_STRING);
		$email = $_POST['email'];
		$email = filter_var($email, FILTER_SANITIZE_STRING);
		$address = $_POST['flat'].', '.$_POST['street'].', '.$_POST['city'].', '.$_POST['country'].', '. $_POST['pincode'];
		$address = filter_var($address, FILTER_SANITIZE_STRING);
		$address_type = $_POST['address_type'];
		$address_type = filter_var($address_type, FILTER_SANITIZE_STRING);
		$method = $_POST['method'];
		$method = filter_var($method, FILTER_SANITIZE_STRING);

		$varify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
		$varify_cart->execute([$user_id]);

		if (isset($_GET['get_id'])) {
			$get_product = $conn->prepare("SELECT * FROM `products` WHERE id=? LIMIT 1");
			$get_product->execute([$_GET['get_id']]);
			if ($get_product->rowCount() > 0) {
				while($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)){
					$insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
			        $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $fetch_p['id'], $fetch_p['price'], 1]);
			            header('location:order.php');
					
					
				}
			}else{
				$warning_msg[] = 'somthing went wrong';
			}
		}elseif ($varify_cart->rowCount()>0) {
			while($f_cart = $varify_cart->fetch(PDO::FETCH_ASSOC)){
				$insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, name, number, email, address, address_type, method, product_id, price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
			        $insert_order->execute([unique_id(), $user_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_cart['price'], $f_cart['qty']]);
			            header('location:order.php');
			}
			if ($insert_order) {
				$delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
				$delete_cart_id->execute([$user_id]);
				header('location: order.php');
			}
		}else{
			$warning_msg[] = 'somthing went wrong';
		}

	}
	//update product in cart

	if (isset($_POST['update_cart'])) {
		$cart_id = $_POST['cart_id'];
		$cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
		$qty = $_POST['qty'];
		$qty = filter_var($qty, FILTER_SANITIZE_STRING);

		$update_qty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
		$update_qty->execute([$qty, $cart_id]);

		$success_msg[] = 'cart quantity updated successfully';
	}
	

	

	//empty cart
	if (isset($_POST['empty_cart'])) {
		$varify_empty_item = $conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
		$varify_empty_item->execute([$user_id]);

		if ($varify_empty_item->rowCount() > 0) {
			$delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
			$delete_cart_id->execute([$user_id]);
			$success_msg[] = "empty successfully";
		}else{
			$warning_msg[] = 'cart item already deleted';
		}
		
	}

?>
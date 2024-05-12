<?php
session_start();
if(empty($_SESSION['id']))
{
	header("location:../Views/log.php");
}
if(isset($_GET['out']))
{
	session_destroy();
	header("location:../Views/log.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
Welcome,<?php echo $_SESSION['id']; ?>
<form>
<button name="out">Logout</button>
</form>
</body>
</html>
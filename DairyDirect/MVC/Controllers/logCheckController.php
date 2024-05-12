<?php
require_once('../Models/alldb.php');
session_start();
$id=$_POST['id'];
$pass=$_POST['pass'];
$status=auth($id,$pass);

if($status)
{
	$_SESSION['id']=$id;
	header("location:../Views/Dash.php");
}
else
{
	header("location:../Views/log.php");
	$_SESSION['mess']="Your ID & Pass is invalid";
}
?>
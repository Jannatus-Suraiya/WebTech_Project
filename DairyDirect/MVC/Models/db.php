<?php 

function conn()
{
	$serverName="localhost";
    $userName="root";
    $pass="";
    $dbName="abb";
    $conn=new mysqli($serverName,$userName,$pass,$dbName);
    return $conn;
}



?>


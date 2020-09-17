<?php 
require_once 'connection.php';
session_start();

if(isset($_SESSION['Email'])){
	echo "welcome ".$_SESSION['Email']."</br>";
	echo  '<a href="logout.php?logout">Logout</a>';
}else{
	header("location:user.php");
}







<?php
require_once 'connection.php';
session_start();
if(isset($_POST['login'])){
	$Email=$_POST['Email'];
    //echo $Email;
	$pass=$_POST['pass'];
    if(empty($Email) || empty($pass)){
    	header("location:user.php?empty=please fill in the blank");
    }else{
    	$query="select * from users where Email='$Email' and password='$pass'";
    	$result=mysqli_query($con,$query);
    	if(mysqli_fetch_assoc($result)){
    		$_SESSION['Email']=$_POST['Email'];
    		header("location:welcome.php");
    	}else{
    		header("location:user.php?invalid=invalid Email or password");
    	}
    }




}else{
	echo "not working";
}
if(isset($_POST['reset'])){
header("location:resetpass.php");

}








 ?>
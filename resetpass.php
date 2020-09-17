<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once 'connection.php';
require_once 'phpmailer/SMTP.php';
require_once 'phpmailer/OAuth.php';
require_once 'phpmailer/phpmailer.php';
require_once 'phpmailer/Exception.php';


$message="";
	
if(isset($_POST['Email'])){
	$Email=mysqli_real_escape_string($con, $_POST['Email']);
	$query="SELECT * FROM users WHERE Email='".$Email."'";
	$sql=mysqli_query($con,$query);
	if($sql->num_rows>0){
     //exit(json_encode(array("status"=> 1 ,"msg"=>'please check your Email Inbox')));
       $token="abcdefghijklmnopqrstuvwxyz1234567890";
       $token=str_shuffle($token);
       $token=substr($token, 0,8);
       $query1="UPDATE users SET token='$token',token_expire=date_add(now(),INTERVAL 5 MINUTE) WHERE Email='".$Email."'";
       mysqli_query($con,$query1);
       require_once 'phpmailer/PHPMailerAutoload.php';
     

	}else{
	//exit(json_encode(array("status"=> 0 ,"msg"=>'please check your Email')));
     $message.=" This email does not exist please check your email <br> "; 
	}
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
         <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

        <!-- Page level plugin CSS-->
        <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body>
	
<form action="resetpass.php" method="post">
            
                        <div class="acccap">
                            <div class="userinfo pull-left">&nbsp;</div>
                            <div class="posttext pull-left"><h3>Required Fields</h3></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="fullName" name="Email" class="form-control" placeholder="Rent" required="required" autofocus="autofocus" >
                                        <label for="firstName">Email/Username</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        
                        <!-- -->

                        
                        
                       
                       
                        
                        
                        <div class="form-group">
                            <div class="form-row">


                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input class="btn btn-primary btn-block" type="submit" id="contact" name="Reset" value="Reset" >
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        
                        <!-- <a class="btn btn-primary btn-block" href="login.html">Register</a> -->
                        
                    </form>
<br>
<p id="response"><?php if($message!=""){
	echo $message;
} ?></p>

<script
  src="http://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
  	

$(document).ready(function(){

	$('.reset').on('click',function(){
		var Email=$("#Email");
     if(Email.val()!=""){
       $("#Email").css('border','1px solid green');
       $.ajax({
       	url:'resetpass.php',
       	method:'POST',
       	dataType:'json',
       	data:"Email="+Email,
       	success:function(response){
       		if(response.status==0){
       			$("#response").html(response.msg).css('color',"red");
       		}else{
       			$("#response").html(response.msg).css('color',"green");
       		}
       	}
       });



     }else{
     	$("#Email").css('border','1px solid red')
     }
	});
});



  </script>
</body>
</html>
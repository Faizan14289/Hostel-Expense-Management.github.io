<?php


//-------------------------
function post_val($key) {
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return "";
}

function get_val($key) {
    if (isset($_GET[$key])) {
        return $_GET[$key];
    }
    return "";
}
$error_string="";
//-------------------------
$userna="admin";
$passw="admin";

if ($_POST) {
    $user = trim($_POST["User_Name"]);
    $pass = trim($_POST["password"]);
    
    if(strcmp($user, $userna)){
        $error_string .="Username not matched<br>";
        
    }
    if(strcmp($pass, $passw)){
         $error_string .="Password not matched";
         
    }
    if ($user == $userna && $pass==$passw)
    {
        header("location: admin_index.php");
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin - Register</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin.css" rel="stylesheet">

    </head>

    <body class="bg-dark">

        <div class="container">
            <div class="card card-register mx-auto mt-5">
                <div class="card-header">Login Admin</div>
                <div class="card-body">
                    <?php if ($error_string != "") { ?>
                        <p class="alert alert-danger"> <?= $error_string; ?> </p>
                    <?php }
                    ?>
                        <form action="admin_login.php"  method="post">
                        <div class="acccap">
                            <div class="userinfo pull-left">&nbsp;</div>
                            <div class="posttext pull-left"><h3>Required Fields</h3></div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="text" id="inputEmail" class="form-control" name="User_Name" placeholder="Username/Email" required="required" value="<?= post_val("user") ?>">
                                <label for="inputEmail">User Name</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                                        <label for="inputPassword">Password</label>
                                    </div>
                                </div>
                                

                            </div>
                        </div>
                        <!-- -->

                        
                        <input class="btn btn-primary btn-block" type="submit" value="Login">
                    </form>
                    
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    </body>

</html>



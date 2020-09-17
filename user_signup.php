<?php
include('setting.php');


//-------------------------
$error_string = "";
if ($_POST) {
    $fullname = trim($_POST["fullname"]);
    $user = trim($_POST["username"]);
    $pass = trim($_POST["password"]);
    $pass1 = trim($_POST["confirmPassword"]);
    $contct = trim($_POST["phone"]);
    $email = trim($_POST["email"]);

    //fullname validations
    if (strlen($fullname) == 0) {
        $error_string .= "Full name is required<br>";
    } else if (strlen($fullname) < 3) {
        $error_string .= "Full name should be atleast 3 characters<br>";
    } else if (strlen($fullname) > 100) {
        $error_string .= "Full name is too long<br>";
    }

    //email validation
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        $error_string .= "Email is not valid <br>";
    }

    //user name validation
    if (isset($user)) {
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql_u = "SELECT * FROM users WHERE user_name='$user'";
        $res_u = mysqli_query($db, $sql_u);
        if (mysqli_num_rows($res_u) > 0) {
            $error_string = "Sorry... username already taken";
        }
    }

    //password validation
    if (strlen($pass) < 4) {
        $error_string .= "Password should be atleast 4 characters <br>";
    } else {
        if ($pass !== $pass1) {
            $error_string .= "Password not matched";
        }
    }

    if ($error_string == "") {

        // $hased_pas = password_hash($pass, PASSWORD_BCRYPT, array("cost"=>10));
        $hash = md5($pass);
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        //print_r($_POST);
        $sql = "INSERT INTO users "
            . "(full_name, user_name,password,phone,email)"
            . " VALUES ('{$fullname}', '{$user}', '{$hash}', '{$contct}', '{$email}')";
        //echo $sql;
        $db->query($sql);
        $sql1 = "INSERT INTO account "
            . "(user_name)"
            . " VALUES ('{$user}')";
        //echo $sql;
        $db->query($sql1);
        if ($db->connect_errno) {
            die("unable to connecct");
        }
        $db->close();
        header("Location: user_index.php");
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

    <title>SB Admin - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Register an Account</div>
            <div class="card-body">
                <?php if ($error_string != "") { ?>
                    <p class="alert alert-danger"> <?= $error_string; ?> </p>
                <?php }
            ?>
                <form action="user_signup.php" method="post">
                    <div class="acccap">
                        <div class="userinfo pull-left">&nbsp;</div>
                        <div class="posttext pull-left">
                            <h3>Required Fields</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full Name" required="required" autofocus="autofocus" value="<?= post_val("fullname") ?>">
                                    <label for="firstname">Full Name</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <input type="text" id="username" class="form-control" name="username" placeholder="Username" required="required" value="<?= post_val("username") ?>">
                                    <label for="username">User Name</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                                    <label for="confirmPassword">Confirm password</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Contact/Phone" required="required" value="<?= post_val("phone") ?>">
                                    <label for="phone">Contact Phone</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email" required="required" value="<?= post_val("email") ?>">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <a class="btn btn-primary btn-block" href="login.html">Register</a> -->
                    <input class="btn btn-primary btn-block" type="submit" value="Register">
                </form>
                <div class="text-center">
                    <a class="d-block small mt-3" href="user_login.php">Login Page</a>

                </div>
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
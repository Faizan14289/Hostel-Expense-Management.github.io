<?php


require_once 'templates/auth.php';
include('setting.php');


$error_string = "";

if ($_POST) {
    $username = trim($_POST["username"]);
    $pass = trim($_POST["pass"]);

    if ($username) {
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql_u = "SELECT * FROM users WHERE user_name='" . $username . "'";
        $res_u = mysqli_query($db, $sql_u);

        if (mysqli_num_rows($res_u) <= 0) {
            $error_string = "Sorry... username does not exist";
        } else {
            $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($db->connect_errno) {
                die("unable to connecct");
            }

            $sql = "SELECT * FROM users WHERE user_name ='" . $username . "'";
            $result = $db->query($sql);
            if ($result) {
                $row = $result->fetch_object();

                if ($row) {
                    //$hased_pas = password_hash($pass, PASSWORD_BCRYPT, array("cost"=>8));
                    if (md5($pass) == $row->password) {
                        // if($row->password == $pass) {
                        initiateSession($row->id);
                        header("Location: sucessful_login.php");
                    } else {
                        $error_string = "Username or password doest not matched";
                    }
                } else {
                    $error_string = "Username or password doest not matched";
                }
            } else {
                $error_string = "Username or password doest not matched";
            }
        }
        if ($db->connect_errno) {
            die("unable to connecct");
        }
    }
}
?>
<html>

<head>
    <title>Account Holder</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<!-- login form -->

<body class="bg-dark">

    <div class="container">
        <div class="card card-register mx-auto mt-5">
            <div class="card-header">Login User</div>
            <div class="card-body">
                <form action="user_login.php" method="post">
                    <?php if ($error_string != "") { ?>
                        <p class="alert alert-danger"> <?= $error_string; ?> </p>
                    <?php
                    }
                    ?>
                    <div class="acccap">
                        <div class="posttext pull-left">
                            <h3>Required Fields</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <input type="text" id="fullName" name="username" class="form-control" required="required" autofocus="autofocus">
                                    <label for="firstName">Username</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-label-group">
                                    <input type="password" id="fullName" name="pass" class="form-control" required="required" autofocus="autofocus">
                                    <label for="firstName">Password</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">


                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input class="btn btn-primary btn-block" type="submit" name="login" value="Login">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input class="btn btn-primary btn-block" type="submit" name="forgetpassword" value="Forget Password">

                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- <a class="btn btn-primary btn-block" href="login.html">Register</a> -->

                </form>
            </div>
        </div>
    </div>


</body>

</html>
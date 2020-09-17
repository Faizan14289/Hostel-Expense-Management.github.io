<?php
require_once 'template/auth.php';
require_once 'functions.php';
include('setting.php');

$error_string = "";
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno) {
    die("unable to connecct");
}
if ($_POST) {
    //validate the link
    $username = get_val("username");
    $code = get_val("reset_code");

    $sql = "SELECT * FROM users WHERE email ='" . $username . "'";
    $result = $db->query($sql);
    if ($result) {
        $row = $result->fetch_object();

        if ($row) {
            //user found
            $reset_code = $row->reset_code;

            $expire = $row->expire;
                $time = time();
            if ($code == $reset_code) {
                if ($time < $expire) {
                    $pass = post_val("password");
                    $c_pass = post_val("confirm_password");
                    if ($pass) {
                        if ($c_pass) {
                            if ($pass == $c_pass) {
                                $hased_pas = md5($pass);
                                $sql = "UPDATE users SET reset_code =NULL, expire=0, password='" . $hased_pas . "' WHERE email ='" . $row->email . "'";
                                $result = $db->query($sql);
                                header("Location:reset_pass_succ.php");
                            } else {
                                $error_string .= "ERROR";
                            }
                        } else {
                            $error_string .= "C-ERROR";
                        }
                    } else {
                        $error_string .= "P-ERROR";
                    }
                }
            }
        } else {
            $error_string .= "1Username does not exist";
        }
    } else {
        $error_string .= "Username does not exist";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITE_TITLE; ?> :: Forget Password</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">


</head>

<body>

    <div class="container-fluid">



        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 breadcrumbf">
                        <a href="#">Recover Password</a>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xs-12 col-md-8">
                        <!-- POST -->
                        <div class="post">
                            <form action="" class="form newtopic" method="post">
                                <div class="postinfotop">
                                    <h2>Change Password</h2>
                                </div>

                                <!-- acc section -->
                                <div class="accsection">

                                    <div class="topwrap">
                                        <div class="userinfo pull-left">

                                        </div>
                                        <div class="posttext pull-left">

                                            <div class="row">
                                                <?php
                                                if ($error_string != "") { ?>
                                                    <p class="alert alert-danger"> <?= $error_string; ?> </p>
                                                <?php }
                                            ?>
                                                <div class="col-lg-6 col-md-6">
                                                    <input name="password" type="password" placeholder="New Password" class="form-control" />
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <input name="confirm_password" type="password" placeholder="Confirm Password" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- acc section END -->

                                <div class="postinfobot">

                                    <div class="pull-right postreply">
                                        <div class="pull-left smile"><a href="#"><i class="fa fa-smile-o"></i></a></div>
                                        <div class="pull-left"><button type="submit" class="btn btn-primary">Change Password</button></div>
                                        <div class="clearfix"></div>
                                    </div>


                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div><!-- POST -->



                    </div>



        </section>


    </div>




    <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
    <script type="text/javascript">
        var revapi;

        jQuery(document).ready(function() {
            "use strict";
            revapi = jQuery('.tp-banner').revolution({
                delay: 15000,
                startwidth: 1200,
                startheight: 278,
                hideThumbs: 10,
                fullWidth: "on"
            });

            $("#fake_avatar_input").click(function(e) {
                $("#avatar_input").click();
                e.preventDefault();
            });
        }); //ready
    </script>

    <!-- END REVOLUTION SLIDER -->
</body>

<!-- Mirrored from forum.azyrusthemes.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 27 Mar 2019 15:39:44 GMT -->

</html>
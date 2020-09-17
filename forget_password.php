<?php

require_once 'classes/swiftmailer-5.x/lib/swift_required.php';
require_once 'templates/auth.php';
require_once 'functions.php';
include('setting.php');

define("MAIL_HOST", "mail.printersdrivers.info");
define("MAIL_USER", "cs16@printersdrivers.info");
define("MAIL_PASS", "cs16@rcet");
define("MAIL_PORT", 587);
define("MAIL_FROM", "Forum");

define("SITE_TITLE", "Web Discussion Forum");   //appear on every title page
define("BASE_URL", "http://localhost/Account Holding/");   //can be used to make absolute urlsC:\wamp64\www\Account-Holding
$error_string = "";

if ($_POST) {
    $username = trim($_POST["username"]);

    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($db->connect_errno) {
        die("unable to connecct");
    }

    $sql = "SELECT * FROM users WHERE email ='" . $username . "'";
    $result = $db->query($sql);
    if ($result) {
        $row = $result->fetch_object();
        if ($row) {
            //user found
            $reset_code = makeKey(30, FALSE);
            $expire = time() + (60 * 60 * 2); //time+2hour
            $link = site_url("reset_pass.php?username=" . $row->email . "&reset_code=" . $reset_code);
            $email = file_get_contents("mail-template/forget-sample.html");
            $email = str_replace("<!-- display-name -->", $row->full_name, $email);
            $email = str_replace("<!-- link -->", $link, $email);
            //$email="<html><body><a href='".$link."'>click to reset</a></body></html>";
            //email send
            $message = Swift_Message::newInstance();
            $message->setSubject("Reset Password - Forum");
            $message->setFrom(MAIL_USER, MAIL_FROM);
            $message->setTo($row->email, $row->full_name);
            $message->setBody($email, "text/html");
            //transport
            $transport = Swift_SmtpTransport::newInstance();
            $transport->setHost(MAIL_HOST);
            $transport->setUsername(MAIL_USER);
            $transport->setPassword(MAIL_PASS);
            $transport->setPort(MAIL_PORT);
            //
            $mailer = Swift_Mailer::newInstance($transport);
            try {
                $sent = $mailer->send($message);
                if ($sent > 0) {
                    $sql = "UPDATE users SET reset_code ='" . $reset_code . "', expire=" . $expire . " WHERE email ='" . $row->email . "'";
                    $result = $db->query($sql);
                    header("Location: forget_success.php");
                    exit;
                } else {
                    $error_string = "Error sending email";
                }
            } catch (Exception $e) {
                echo die($e);
            }
        } else {
            $error_string = "Username does not exist";
        }
    } else {
        $error_string = "Username does not exist";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITE_TITLE; ?> :: Forget Password</title>

    <!-- Custom fonts for this template-->
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

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xs-12 col-md-8">
                        <!-- POST -->
                        <div class="post">
                            <form action="forget_password.php" class="form newtopic" method="post">
                                <div class="postinfotop">
                                    <h2>Forget Password</h2>
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
                                                    <input name="username" type="text" placeholder="User Name" class="form-control" value="<?= post_val("username"); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- acc section END -->

                                <div class="postinfobot">

                                    <div class="pull-right postreply">
                                        <div class="pull-left smile"><a href="#"><i class="fa fa-smile-o"></i></a></div>
                                        <div class="pull-left"><button type="submit" class="btn btn-primary">Reset Password</button></div>
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
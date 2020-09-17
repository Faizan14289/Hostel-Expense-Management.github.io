<?php
require_once 'templates/auth.php';

require_once 'functions.php';
define("BASE_URL", "http://localhost/Account-Holding/");

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
                            <form action="<?= site_url("login.php"); ?>" class="form newtopic" method="post">
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
                                                <p class="alert alert-success">Password reset email has been sent.<br>Please Check your email.</p>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div><!-- acc section END -->

                                <div class="postinfobot">


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
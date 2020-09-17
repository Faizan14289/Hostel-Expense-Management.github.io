<?php

include('setting.php');

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno) {
    die("Unable to Connect");
}

$sql = "SELECT * FROM users";
$result = $db->query($sql);




$error_string = "";
try {
    $db->begin_transaction();

    if ($_POST) {
        $bill = trim($_POST["add_bill"]);
        $rent = trim($_POST["add_rent"]);

        if (!is_numeric($rent)) {
            $error_string = "You must type integer values";
        }
        if ($bill<0) {
            $error_string = "You must Enter Positive Value";
        }
        if ($rent<0) {
            $error_string = "You must Enter Positive Value";
        }
        if (!is_numeric($bill)) {
            $error_string = "You must type integer values";
        }
        if ($error_string == "") {

            $sql = "SELECT COUNT(*) as count from account";
            $result = $db->query($sql);
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];


            $net_bill = $bill / $count;
            $net_rent = $rent / $count;


            $sql = "SELECT * FROM account";
            
            $result = $db->query($sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $userName = $row['user_name'];
                $pre_bill = $row['bill'];
                $pre_rent = $row['rent'];
                $pre_total = $row['total'];
                $pre_deposit = $row['deposit'];
                $pre_net_balance = $row['net_balance'];

                $new_bill = $pre_bill + $net_bill;
                $new_rent = $pre_rent + $net_rent;
                $new_total = $pre_total + $new_bill + $new_rent;
                $new_net_balance = $pre_deposit - $new_total;

                $sql = "UPDATE account SET bill=  $new_bill  WHERE user_name = '$userName'";
                $db->query($sql);
                $sql = "UPDATE account SET rent=  $new_rent WHERE user_name = '$userName'";
                $db->query($sql);
                $sql = "UPDATE account SET total= $new_total WHERE user_name = '$userName'";
                $db->query($sql);
                $sql = "UPDATE account SET net_balance= $new_net_balance WHERE user_name = '$userName'";
                $db->query($sql);
            }


            $db->commit();
            header("Location: admin_index.php");
        }
        
        
        
    }
} catch (Exception $e) {
     $db->rollBack();
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

    <title>Admin - Add Common Expenditure</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">


    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="admin_index.php">Common Account Holder - Admin</a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>



        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">


        </ul>

    </nav>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include("templates/admin_sidebar.php");
        ?>

        <div id="content-wrapper">

            <div class="container-fluid">
                <?php if ($error_string != "") { ?>
                    <p class="alert alert-danger"> <?= $error_string; ?> </p>
                <?php }
            ?>
                <div class="acccap" class="text-center">
                    <div class="userinfo pull-left">&nbsp;</div>
                    <div class="posttext pull-left">
                        <h3>Users Common Expenditures</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- form -->
                <div class="container">
                    <form action="account_common_expenditure.php" method="post">
                        <div class="acccap">
                            <div class="userinfo pull-left">&nbsp;</div>
                            <div class="posttext pull-left"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-label-group">


                                        <input type="text" name="add_bill" class="form-control" autofocus="autofocus">
                                        <label for="addbill">Add Bill</label>

                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-label-group">
                                        <input type="text" name="add_rent" class="form-control" autofocus="autofocus">
                                        <label for="addbill" class="font-size">Add Rent</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input class="btn btn-primary btn-block" type="submit" value="Add">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- form end-->

            </div>
            <!-- /.container-fluid -->


            <?php
            include("templates/footer.php");
            ?>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
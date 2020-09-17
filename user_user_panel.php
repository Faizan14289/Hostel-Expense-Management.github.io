<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="admin_index.php">Common Account Holder</a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>



        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">


        </ul>

    </nav>


    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'templates/user_sidebar.php'; ?>


        <!-- /.content-wrapper -->
        <!-- user -->
        <div id="content-wraper" class="container h-100 d-flex justify-content-center" style="margin-top: 40px;">
            <!-- UserPanel Overview -->
            <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            User Panel
                        </li>
                        <li class="breadcrumb-item active">login - Register</li>
                    </ol>
                </nav>
                <div class="row" style="margin-top: 50px;">
                    <div class="container-fluid">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">
                                    <p>To access your account details, click in the login<br>
                                        For new users click on the register page.
                                    </p>
                                </li>

                            </ol>
                        </nav>


                    </div>
                </div>

                <!-- Icon card -->
                <div class="row" style="margin-top: 50px;">
                    <div class="col-xl-6 col-sm-6 mb-6">
                        <div class="card text-white bg-primary o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">

                                </div>
                                <div class="text-center"><b>Login</b></div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="user_login.php">
                                <span class="text-center">Click Here</span>
                                <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-sm-6 mb-6 ">
                        <div class="card text-white bg-warning o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">

                                </div>
                                <div class="mr-5 text-center"><b>Creat New Account</b></div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="user_signup.php">
                                <span>Click Here</span>
                                <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>


                </div>

            </div>
        </div>
        <?php include('templates/footer.php'); ?>
    </div>

    </div>
    <!-- /#wrapper -->




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
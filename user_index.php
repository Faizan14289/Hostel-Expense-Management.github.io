<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User - Home</title>

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
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </nav>
                <!-- Icon card -->
                <div class="row" style="margin-top: 50px;">
                    <div class="container-fluid">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">
                                    <h3>Welcome</h3>
                                    <h5>Introduction</h5>
                                    <p>Its a web application for the tracking of account that is shared by different people</p>
                                    <p>If you are a student and living in a hostel or flat sharing with your firends.
                                        you can track your common expenditures. For this purpose Common Account Holder will be the
                                        best option for you.

                                    </p>
                                    <h5>Modules</h5>
                                    <p>There are two modules<br>
                                        1. Admin<br>
                                        2. User<br>
                                        Admin can add expenditures, remove them. Even he can remove the user too. Inshort all working
                                        is handled by the admin.<br>
                                        User can only view the account status.
                                    </p>
                                </li>

                            </ol>
                        </nav>


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
<?php
include('setting.php');
include('templates/auth.php');
$u_id = $_SESSION['id'];

?>
<?php
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno) {
    die("Unable to Connect");
}
$sql = "SELECT * FROM users WHERE id = $u_id";
$result = $db->query($sql);


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User - Profile</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php
    include('templates/user_navbar.php');
    ?>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'templates/user_login_sidebar.php'; ?>


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
                        <li class="breadcrumb-item active">Overview</li>
                    </ol>
                </nav>
                <!-- Icon card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="h5 text-center">User Profile</div>
                    </div>
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">

                                        <tr>
                                            <th>Name</th>
                                            <th>User Name</th>
                                            <th>Phone No.</th>
                                            <th>Email</th>
                                        </tr>
                                        <?php
                                        while ($user_data = mysqli_fetch_assoc($result)) {
                                            ?>

                                            <tr>
                                                <td><?php echo $user_data['full_name']; ?></td>
                                                <td><?php echo $user_data['user_name']; ?></td>
                                                <td><?php echo $user_data['phone']; ?></td>
                                                <td><?php echo $user_data['email']; ?></td>
                                            </tr>
                                        <?php
                                    }
                                    ?>

                                    </table>

                                </div>
                            </div>
                        </div>
                        <form action="user_edit_profile.php" method="post">
                            <input class="btn btn-primary btn-block" type="submit" value="Update Profile" style="margin-top:30px">
                        </form>
                    </div>


                </div>

                <!-- Footer -->

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
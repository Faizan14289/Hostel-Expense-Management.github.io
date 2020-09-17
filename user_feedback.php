<?php
include('setting.php');
include('templates/auth.php');
$u_id = $_SESSION['id'];

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno) {
    die("Unable to Connect");
}
$sql = "SELECT * FROM users WHERE id = $u_id";
$result = $db->query($sql);
$account_data = mysqli_fetch_assoc($result);

$error_string = "";

if ($_POST) {
    $fullname = $_POST['name'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $comment = $_POST['comment'];
    $date = date("Y-m-d");
    $time = date("H:i:s");

    $sql = "INSERT INTO feedback (`full_name`,`user_name`,`phone`,`comment`,`date`,`time`) 
    VALUES('$fullname','$username','$phone','$comment', '$date','$time')";
    $db->query($sql);
    header("location: user_feedback.php");
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

    <title>User - Feedback</title>

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
                        <div class="h5 text-center">Edit Profile</div>
                    </div>

                    <div class="card-body">
                        <form action="user_feedback.php" method="post">
                            <?php if ($error_string != "") { ?>
                                <p class="alert alert-danger"> <?= $error_string; ?> </p>
                            <?php
                        }
                        ?>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="name" name="name" value="<?php echo $account_data['full_name']; ?>" required="required" class="form-control">
                                            <label for="name">Full Name</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="phone" name="phone" value="<?php echo $account_data['phone']; ?>" required="required" class="form-control">
                                            <label for="phone">Phone No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="username" value="<?php echo $account_data['user_name']; ?>">

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-label-group">

                                            <textarea id="comment" name="comment" placeholder="Write something.." style="height:150px" class="form-control"></textarea>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-label-group">
                                            <input class="btn btn-primary btn-block" type="submit" name="send" value="Send">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
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
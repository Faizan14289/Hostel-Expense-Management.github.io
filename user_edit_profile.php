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
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $pass1 = $_POST['conformPassword'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    //fullname validations
    if (strlen($fullname) == 0) {
        $error_string .= "Full name is required<br>";
    } else if (strlen($fullname) < 3) {
        $error_string .= "Full name should be atleast 3 characters<br>";
    } else if (strlen($fullname) > 100) {
        $error_string .= "Full name is too long<br>";
    }

    //email validation
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
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

        $sql = "UPDATE users SET full_name = '$fullname' WHERE id = $u_id ";
        $db->query($sql);
        $sql = "UPDATE users SET user_name = '$username' WHERE id = $u_id ";
        $db->query($sql);
        $sql = "UPDATE users SET phone = '$phone' WHERE id = $u_id ";
        $db->query($sql);
        $sql = "UPDATE users SET email = '$email' WHERE id = $u_id ";
        $db->query($sql);
        $sql = "UPDATE users SET `password` = '$hash' WHERE id = $u_id ";
        $db->query($sql);

       header("location: user_profile.php");
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
                        <div class="h5 text-center">Edit Profile</div>
                    </div>

                    <div class="card-body">
                        <form action="user_edit_profile.php" method="post">
                            <?php if ($error_string != "") { ?>
                                <p class="alert alert-danger"> <?= $error_string; ?> </p>
                            <?php
                        }
                        ?>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="name" name="name" value="<?php echo $account_data['full_name']; ?>" required ="required" class="form-control">
                                            <label for="name">Full Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="username" name="username" value="<?php echo $account_data['user_name']; ?>" required="required" class="form-control">
                                            <label for="username">User Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="phone" name="phone" value="<?php echo $account_data['phone']; ?>" required="required" class="form-control">
                                            <label for="phone">Phone No</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="email" name="email" value="<?php echo $account_data['email']; ?>" required="required" class="form-control">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="password" id="password" name="password" required ="required" required="required" class="form-control">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="password" id="confirmPassword" name="conformPassword" required ="required" class="form-control">
                                            <label for="confirmPassword">Conform Password</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-label-group">
                                            <input class="btn btn-primary btn-block" type="submit" name="update" value="Update">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php
            include('templates/footer.php');
            ?>
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
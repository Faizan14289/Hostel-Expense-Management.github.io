<?php
include('setting.php');

$error_string="";
if ($_POST) {
    $user_t = trim($_POST["user"]);
    $Ren_t = trim($_POST["rent"]);
    $bill_l = trim($_POST["bill"]);
    $foods = trim($_POST["food"]);
    $others = trim($_POST["other"]);
    $deposit_t = trim($_POST["deposit"]);
    
    if (!is_numeric($Ren_t)) {
        $Ren_t = 0;
    }
    if (!is_numeric($bill_l)) {
        $bill_l = 0;
    }
    if (!is_numeric($foods)) {
        $foods = 0;
    }
    if (!is_numeric($others)) {
        $others = 0;
    }
    if (!is_numeric($deposit_t)) {
        $deposit_t = 0;
    }
    if ($bill_l < 0) {
        $error_string = "You must Enter Positive Value";
    }
    if ($Ren_t < 0) {
        $error_string = "You must Enter Positive Value";
    }
    if ($foods < 0) {
        $error_string = "You must Enter Positive Value";
    }
    if ($others < 0) {
        $error_string = "You must Enter Positive Value";
    }
    if ($deposit_t < 0) {
        $error_string = "You must Enter Positive Value";
    }
    if ($error_string == "") {
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql1 = "SELECT * from account where user_name = '$user_t' ";
        $result = $db->query($sql1);
        $pre_record = $result->fetch_object();

        $previous_rent = $pre_record->rent;
        $previous_bill = $pre_record->bill;
        $previous_food = $pre_record->food;
        $previous_others = $pre_record->other;
        $previous_total = $pre_record->total;
        $previous_deposit = $pre_record->deposit;
        $previous_netbalance = $pre_record->net_balance;

        $new_bill = $previous_bill + $bill_l;
        $new_rent = $previous_rent + $Ren_t;
        $new_food = $previous_food + $foods;
        $new_other = $previous_others + $others;
        $new_total = $new_rent + $new_bill + $new_food + $new_other;
        $new_deposit = $previous_deposit + $deposit_t;
        $new_netbalance = $new_deposit - $new_total;

        $sql2 = "UPDATE account SET bill=" . $new_bill . " WHERE user_name='" . $user_t . "'";
        $rs1 = $db->query($sql2);
        $sql3 = "UPDATE account SET rent=" . $new_rent . " WHERE user_name='" . $user_t . "'";
        $rs2 = $db->query($sql3);
        $sql4 = "UPDATE account SET food=" . $new_food . " WHERE user_name='" . $user_t . "'";
        $rs3 = $db->query($sql4);
        $sql5 = "UPDATE account SET other=" . $new_other . " WHERE user_name='" . $user_t . "'";
        $rs4 = $db->query($sql5);
        $sql6 = "UPDATE account SET total=" . $new_total . " WHERE user_name='" . $user_t . "'";
        $rs5 = $db->query($sql6);
        $sql7 = "UPDATE account SET deposit=" . $new_deposit . " WHERE user_name='" . $user_t . "'";
        $rs6 = $db->query($sql7);
        $sql8 = "UPDATE account SET net_balance=" . $new_netbalance . " WHERE user_name='" . $user_t . "'";
        $rs7 = $db->query($sql8);

        if ($db->connect_errno) {
            die("unable to connecct");
        }
        $db->close();
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Add Individual Expenditure</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body>

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

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="h5">Select User</div>
                    </div>
                    <div class="card-body">
                        <form action="account_individual_expenditure.php" method="post">
                            <?php if ($error_string != "") { ?>
                                <p class="alert alert-danger"> <?= $error_string; ?> </p>
                            <?php }
                        ?>
                            <?PHP
                            $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                            $sql = ("SELECT * FROM account a join users u where a.user_name=u.user_name");
                            $result = $db->query($sql);
                            $rowcount = mysqli_num_rows($result);
                            ?>
                            <select name="user" class="browser-default custom-select">
                                <option>Select anyone</option>
                                <?php
                                for ($i = 1; $i <= $rowcount; $i++) {     # code...
                                    $row = $result->fetch_object();
                                    $r = $row->user_name;
                                    $name = $row->full_name;
                                    ?>

                                    <option value="<?php echo $r; ?>">

                                        <?php echo $name; ?>
                                    </option>

                                <?php
                            }
                            ?>
                            </select>


                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="h5">Add Individual Expenditure</div>
                        </div>
                        <div class="card-body">

                            <div class="acccap">
                                <div class="userinfo pull-left">&nbsp;</div>
                                <div class="posttext pull-left">
                                    <h3></h3>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="rent" name="rent" class="form-control" autofocus="autofocus">
                                            <label for="rent">Rent</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="bill" name="bill" class="form-control" autofocus="autofocus">
                                            <label for="bill">Bill</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="food" name="food" class="form-control">
                                            <label for="food">Food</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="text" id="other" name="other" class="form-control">
                                            <label for="other">Others</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- -->

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-label-group">
                                            <input type="text" id="deposit" name="deposit" class="form-control">
                                            <label for="deposit">Deposit</label>
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

                    </div>
                </div>

    </body>

</html>
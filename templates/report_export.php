<?php
include("../setting.php");
include('auth.php');
$u_id = $_SESSION['id'];
$sql = "SELECT * FROM account a JOIN users u WHERE u.id = $u_id  AND a.user_name = u.user_name ";
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($db->connect_errno) {
    die("Unable to Connect");
}


$result = $db->query($sql);
?>
<html>

<head>
    <title>Export MySQL data to Excel in PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <br />
        <br />
        <br />
        <div class="table-responsive">
            <h2 class="test-center">Export MySQL data to Excel in PHP</h2><br />
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Deposit</th>
                    <th>Net Balance</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '  
       <tr>  
         <td>' . $row['full_name'] . '</td>  
         <td>' . $row['total'] . '</td>  
         <td>' . $row['deposit'] . '</td>  
         <td>' . $row['net_balance'] . '</td>  
         
       </tr>  
        ';
                }
                ?>
            </table>
            <br />
            <form method="post" action="export.php">
                <input type="submit" name="export" class="btn btn-success" value="Export" />
            </form>
        </div>
    </div>
</body>

</html>
<?php
//export.php  
include("../setting.php");
include('auth.php');
$u_id = $_SESSION['id'];
$output = '';

if (isset($_POST["export"])) {
     $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
     $sql = "SELECT * FROM account a JOIN users u WHERE u.id = $u_id  AND a.user_name = u.user_name ";
     $result = $db->query($sql);

     if (mysqli_num_rows($result) > 0) {
          $output .= '
                    <table class="table" bordered="2">  
                    <tr>  
                    <th>Name</th>
                    <th>Total</th>
                    <th>Deposit</th>
                    <th>Net Balance</th>
                    </tr>
               ';
          while ($row = mysqli_fetch_array($result)) {
               $output .= '
          <tr>  
               <td>' . $row["user_name"] . '</td>  
               <td>' . $row["total"] . '</td>  
               <td>' . $row["deposit"] . '</td>  
               <td>' . $row["net_balance"] . '</td>  
          </tr>
          ';
          }
          $output .= '</table>';
          header('Content-Type: application/xls');
          header('Content-Disposition: attachment; filename=download.xls');
          echo $output;
     }
}

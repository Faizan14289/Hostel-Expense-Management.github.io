<?php
    include ("../setting.php");
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if($db->connect_errno) {
        die("Unable to Connect");
    }
    

    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        
        $sql = "DELETE FROM users WHERE id = $id";
        $db->query($sql);
        

        
         
        header('location: ../admin_user_details.php');
      }

      if (isset($_GET['reset'])) {
        $id = $_GET['reset'];
        
        $sql = "SELECT user_name FROM users WHERE id = $id";
        $result=$db->query($sql);
        $row = mysqli_fetch_assoc($result);
        $userName = $row['user_name'];
        

        $sql = "UPDATE account SET rent=0 WHERE user_name = '$userName'";
        $result=$db->query($sql);
        $sql = "UPDATE account SET bill=0 WHERE user_name = '$userName'";
        $result=$db->query($sql);
        $sql = "UPDATE account SET food=0 WHERE user_name = '$userName'";
        $result=$db->query($sql);
        $sql = "UPDATE account SET total=0 WHERE user_name = '$userName'";
        $result=$db->query($sql);
        $sql = "UPDATE account SET deposit=0 WHERE user_name = '$userName'";
        $result=$db->query($sql);
        $sql = "UPDATE account SET net_balance=0 WHERE user_name = '$userName'";
        $result=$db->query($sql);
        
        
         
        header('location: ../admin_user_details.php');
      }


?>
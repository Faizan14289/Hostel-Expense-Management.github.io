<?php
    include ("../setting.php");
    $db = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if($db->connect_errno) {
        die("Unable to Connect");
    }
    

    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        
        $sql = "DELETE FROM feedback WHERE id = $id";
        $db->query($sql);
        

        
         
        header('location: ../admin_feedback.php');
      }

     


?>
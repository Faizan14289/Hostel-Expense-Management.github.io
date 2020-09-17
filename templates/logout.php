<?php
require_once 'auth.php';

logout();

header("Location: ../user_index.php");
exit;
?>

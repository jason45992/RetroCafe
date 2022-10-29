<?php
  session_start();
  // store to test if they *were* logged in
  $old_user = $_SESSION['user_id'];  
  unset($_SESSION['user_id']);
  unset($_SESSION['cart']);
  session_destroy();
  header('Location: login.php');
?>

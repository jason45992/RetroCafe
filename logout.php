<?php
  session_start();
  // store to test if they *were* logged in
  $old_user = $_SESSION['user_id'];  
  unset($_SESSION['user_id']);
  session_destroy();
  header('Location: index.php');
?>

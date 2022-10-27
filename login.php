<?php
  // create variables
  $email=$_POST['email'];
  $psw=$_POST['psw'];

  // estabilish new db connection
  @ $db = new mysqli('localhost', 'root', '','RetroCafe');

  //log if db connection error
  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

  //create new order
  $query = "SELECT * FROM user WHERE user.email = '".$email."' and user.password = '".$psw."';";
  $result = $db->query($query);

  //check if user cridential correct
  $num_results = $result->num_rows;
  if($num_results>0){
    echo "<script>window.location.href='index.html';</script>";
  }else{
    echo "<script>alert('Login fail. Please check your email and password.');window.location.href='login.html';</script>";
  };

  //close db connection
  $db->close();
?>
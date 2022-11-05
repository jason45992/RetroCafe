<?php
  // create variables
  $name=$_POST['name'];
  $username=$_POST['username'];
  $email=$_POST['email'];
  $psw=$_POST['psw'];
  $cfpsw=$_POST['cfpsw'];

  if($psw == $cfpsw){

    // estabilish new db connection
    @ $db = new mysqli('localhost', 'root', '','RetroCafe');

    //log if db connection error
    if (mysqli_connect_errno()) {
      echo 'Error: Could not connect to database.  Please try again later.';
      exit;
    }

    //create new order
    $query = "insert into user values (NULL, '".$name."', '".$username."', '".$email."', '".$psw."', 0)";
    $result = $db->query($query);

    //close db connection
    $db->close();
    //show success message and back to product menu page
    echo "<script>alert('Account created successully! You can login now.');window.location.href='login.php';</script>";
  } else {
    echo '<script>alert("Your password does not match.");window.location.href="signup.php"</script>';
  }

?>
<?php
session_start();
$name = $_GET["name"];
$username = $_GET["username"];
$user_id = $_SESSION['user_id'];

// estabilish new db connection
@ $db = new mysqli('localhost', 'root', '','RetroCafe');

//log if db connection error
if (mysqli_connect_errno()) {
	echo 'Error: Could not connect to database.  Please try again later.';
	exit;
}
$query = "UPDATE user SET username = '".$username."', name = '".$name."' WHERE id = ".$user_id.";";
$result = $db->query($query);

$_SESSION['user_name'] = $name;
$_SESSION['user_user_name'] = $username;
echo "<script>location.href='account_customer.php';</script>";
?>
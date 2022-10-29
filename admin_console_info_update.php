<?php

// estabilish new db connection
@ $db = new mysqli('localhost', 'root', '','RetroCafe');

//log if db connection error
if (mysqli_connect_errno()) {
	echo 'Error: Could not connect to database.  Please try again later.';
	exit;
}

$selectedid=$_GET['item_id'];
$nameNew=$_GET['item_name'];
$priceNew=$_GET['price'];
$quantityNew=$_GET['quantity'];
$descriptionNew=$_GET['description'];
$visableNew=$_GET['visable'];
$categoryNew=$_GET['category'];
$imgurlNew=$_GET['img_url'];

if($_GET['submit'] == 'Update'){
	if(!empty($selectedid) && ($selectedid != "AddNew")){
		//echo 'update';
		$query = "UPDATE product SET modified_date=CURRENT_TIMESTAMP, category = '".$categoryNew."', name = '".$nameNew."', img_url = '".$imgurlNew."', price = '".$priceNew."', quantity = '".$quantityNew."', description = '".$descriptionNew."', visable = '".$visableNew."' WHERE id = '".$selectedid."';";
		$result = $db->query($query);
		echo "<script>alert('update message');</script>";
	}
	else{
		//echo 'insert';
		$query = "INSERT INTO product SET modified_date=CURRENT_TIMESTAMP, category = '".$categoryNew."', name = '".$nameNew."', img_url = '".$imgurlNew."', price = '".$priceNew."', quantity = '".$quantityNew."', description = '".$descriptionNew."', visable = '".$visableNew."';";
		$result = $db->query($query);
		echo "<script>alert('insert message');</script>";
	}
}

else{
	// echo 'delete';
	$query = "DELETE FROM product WHERE id = '".$selectedid."';";
	$result = $db->query($query); 
	echo "<script>alert('delete message');</script>";
}
echo "<script>location.href='admin_console.php';</script>";

?>


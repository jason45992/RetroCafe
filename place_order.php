<?php
    session_start();
    $user_id="";
  if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
  }
    $user_name="";
  if(isset($_SESSION['user_name'])){
    $user_name = $_SESSION['user_name'];
  }
    $user_is_admin="";
  if(isset($_SESSION['user_is_admin'])){
    $user_is_admin = $_SESSION['user_is_admin'];
    }
    $cart_list="";
  if(isset($_SESSION['cart'])){
    $cart_list = $_SESSION['cart'];
    }
    $amount = $_SESSION['total']; 
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $contactnum = $_POST['contactnum'];
    $postalcode = $_POST['postalcode'];
    $address = $_POST['address'];

    // estabilish new db connection
    @ $db = new mysqli('localhost', 'root', '','RetroCafe');

    //log if db connection error
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.';
        exit;
    }

    //get current date time
    date_default_timezone_set('Asia/Singapore');
    $datetime = date('Y-m-d H:i:s', time());

    //create new order
    $query = "insert into orders values (NULL, '".$user_id."', '".$firstname."', '".$lastname."', '".$contactnum."', '".$postalcode."', '".$address."', '".$amount."', 'Processing', '".$datetime."');";
    $result = $db->query($query);

    //get order id just created
    $last_id = mysqli_insert_id($db);

    //create oder items
    $product_quantity = array_count_values($cart_list);
    foreach($product_quantity as $id => $quantity) {
        $query = "insert into order_items values ('".$last_id."', '".$id."', '".$quantity."');";
        $result = $db->query($query);
    }
    
    //close db connection
    $db->close();

    //destory cart
    unset($_SESSION['cart']);
    unset($_SESSION['sub_total']); 
    unset($_SESSION['tax']); 
    unset($_SESSION['total']);
    //show success message and back to product menu page
    echo "<script>window.location.href='confirmation.php?orderid=".$last_id."';</script>";
    
?>
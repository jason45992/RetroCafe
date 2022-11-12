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
  $user_email = $_SESSION['user_email'];
  $user_is_admin="";
  if(isset($_SESSION['user_is_admin'])){
    $user_is_admin = $_SESSION['user_is_admin'];
    }
  $orderid = $_GET['orderid']; 
?>

<html>

<head>
    <title>Retro Café</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar links -->
    <nav class="navbar">
        <a class="logo" href="index.php">
            <img src="image/logo.png">
        </a>
        <div class="nav-item">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="menu.php">Menu</a>
                </li>
                <li>
                    <a href="aboutus.php">About</a>
                </li>
                <?php
                    if($user_id){
                        if($user_is_admin == '0'){
                            echo "<li><a href=\"account_customer.php\">My Account</a></li>";
                            echo "<li><a href=\"cart.php\">Cart [0]</a></li>";
                        } else {
                            echo "<li><a href=\"account_admin.php\">Admin</a></li>";
                        }
                    }else{
                        echo "<li><a href=\"login.php\">Login</a></li>";
                    }
                ?>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="confirmation-title">
        <h1>Thank you for your order</h1>
        <p>We are sending an email confirmation to <?php echo $user_email ?> whith this information shortly.</p>
    </div>
    <div class="bar-broder">
        <div class="bar-progress" style="height: 20px;width:20%"></div>
    </div>
    <div class="bar-label">
        <label>Processing</label>
        <label>Shipped</label>
        <label>Delivered</label>
    </div>
    <div class="confirm-container">
        <div class="checkout-summary">
            <div class="header">Items to be shippped</div>
            <div class="content">
                <?php
                     // estabilish new db connection
                     @ $db = new mysqli('localhost', 'root', '','RetroCafe');
                     //log if db connection error
                     if (mysqli_connect_errno()) {
                         echo 'Error: Could not connect to database.  Please try again later.';
                         exit;
                     }
                     $query = "SELECT product.name, product.img_url, product.price, product.description, order_items.quantity, orders.amount 
                            FROM product, orders, order_items WHERE order_items.order_id = orders.id and order_items.product_id = product.id 
                            AND orders.id = '".$orderid."'";
                     $result = $db->query($query);
                     $sub_total = 0;
                     $total = 0;
                     $product_list = [];
                     $num_results = $result->num_rows;
                     for ($i=0; $i <$num_results; $i++) {
                        $row = $result->fetch_assoc();

                        array_push($product_list,$row);
                        $sub_price = $row['price'] * $row['quantity'];
                        $sub_price = number_format((float)$sub_price, 2, '.', '');
                        $sub_total += $sub_price;
                        $total = $row['amount'];
                        echo '<div class="item">
                            <div class="product-image">
                                <img src="'.$row['img_url'].'">
                            </div>
                            <div class="product-detail">
                                <div class="product-title">'.$row['name'].'</div>
                                <div class="product-quantity">x'.$row['quantity'].'</div>
                            </div>
                            <div class="product-price">$'.$sub_price.'</div>
                        </div>';
                     }
                     echo '<div class="sub"><div class="product-subtotal"><div>Subtotal</div><div>$'.$sub_total.'</div></div></div>
                        <div class="sub"><div class="product-subtotal"><div>Shipping</div><div>$5</div></div></div>
                        <div class="total"><div class="product-subtotal"><div>Total(GST inclusive)</div><div>$'.$total.'</div></div></div>';
                ?>
            </div>
        </div>
        <div class="shipping-summary">
            <div class="header">Shipping Address</div>
            <div class="info">
                <?php
                    // estabilish new db connection
                    @ $db = new mysqli('localhost', 'root', '','RetroCafe');
                    //log if db connection error
                    if (mysqli_connect_errno()) {
                        echo 'Error: Could not connect to database.  Please try again later.';
                        exit;
                    }
                    $query = "SELECT * FROM orders WHERE id = '".$orderid."'";
                    $result = $db->query($query);
                    $row = $result->fetch_assoc();
                    $shipping_address = $row['address'];
                    echo '<p><b>First Name:</b> '.$row['first_name'].'</p>
                    <p><b>Last Name:</b> '.$row['last_name'].'</p>
                    <p><b>Contact Number:</b> '.$row['contact_number'].'</p>
                    <p><b>Address:</b> '.$row['address'].'</p>
                    <p><b>Postal Code:</b> '.$row['postal_code'].'</p>';
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer">
            <div class="footer-info-item">
                <h3>Information</h3>
                <ul class="list-unstyled">
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="aboutus.php">Customer Service</a></li>
                    <li><a href="privacy_notice.pdf" target="_blank">Privacy Policy</a></li>
                    <li><a href="privacy_notice.pdf" target="_blank">Orders &amp; Returns</a></li>
                </ul>
            </div>
            <div class="footer-info-item">
                <?php
                if((isset($_SESSION['user_id'])) && ($_SESSION['user_is_admin'] == 0) ){
                    echo '<h3>My Account</h3>
                    <ul class="list-unstyled">
                        <li><a href="cart.php">View Cart</a></li>
                        <li><a href="account_customer.php">Track My Order</a></li>
                        <li><a href="aboutus.php">Help</a></li>
                    </ul>';
                }else if(empty($_SESSION['user_id'])){
                    echo '<h3>My Account</h3>
                    <ul class="list-unstyled">
                        <li><a href="login.php">View Cart</a></li>
                        <li><a href="login.php">Track My Order</a></li>
                        <li><a href="login.php">Help</a></li>
                    </ul>';
                }
                ?>
            </div>
            <div class="footer-info-item">
                <h3><span class=""></span> Newsletter</h3>
                <p>Sign up for exclusive offers.</p>
                <div class="">
                    <input type="email" class="" placeholder="Enter your email address">
                    <span class="">
                        <button class="" type="button">
                            Subscribe!
                        </button>
                    </span>
                </div>
                <br>
                <p class="copyright">Copyright &copy; 2022 Retro Café</p>
            </div>
        </div>
    </footer>
</body>
</html>

<!-- send email -->
<?php
require "/Applications/XAMPP/xamppfiles/htdocs/mail_patch.php";
use function mail_patch\mail;
$to      = $user_email;
$subject = 'Thank you for your order!';
$htmlContent = file_get_contents('email_template.html');
//update customer info
$htmlContent = updateCustomerInfo($user_name, $shipping_address, $sub_total, $total, $htmlContent);

//add items info
$item_info = "";
foreach($product_list as $x => $x_value) {
    if(isset($x_value['description'])){
        $sub_price = $x_value['price'] * $x_value['quantity'];
        $sub_price = number_format((float)$sub_price, 2, '.', '');
        $item_info .= addItemInfo($x_value['img_url'], $x_value['name'], $x_value['quantity'],$x_value['description'], $sub_price);
    }
}
$htmlContent = str_replace("item_info",$item_info, $htmlContent);

$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= 'From: service@retrocafe.com' . "\r\n" .
    'Reply-To: service@retrocafe.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $htmlContent, $headers,'-service@retrocafe.com');

function updateCustomerInfo($customer_name, $shipping_address, $sub_total, $total_amount, $htmlContent ){
    $htmlContent = str_replace("customer_name",$customer_name, $htmlContent);
    $htmlContent = str_replace("shipping_address",$shipping_address, $htmlContent);
    $htmlContent = str_replace("sub_total",$sub_total, $htmlContent);
    $htmlContent = str_replace("total_amount",$total_amount, $htmlContent);
    return $htmlContent;
};

function addItemInfo($img_url, $name, $quantity, $description, $sub_price){
    $item_template = file_get_contents('email_item_info.html');
    $item_template = str_replace("item_img_url",$img_url, $item_template);
    $item_template = str_replace("item_name",$name, $item_template);
    $item_template = str_replace("item_quantity",$quantity, $item_template);
    $item_template = str_replace("item_desc",$description, $item_template);
    $item_template = str_replace("item_price",$sub_price, $item_template);
    return $item_template;
};
?> 
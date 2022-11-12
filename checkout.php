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
  $sub_total = $_SESSION['sub_total']; 
  $tax = $_SESSION['tax']; 
  $total = $_SESSION['total']; 
?>
<html>

<head>
    <title>Retro Café</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.2.0/css/all.css">
    <link href="styles.css" rel="stylesheet">
    <script type="text/javascript" src="number.js"></script>
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
                            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                                echo "<li><a href=\"cart.php\">Cart [".count($_SESSION['cart'])."]</a></li>";
                            }else{
                                echo "<li><a href=\"cart.php\">Cart [0]</a></li>";
                            }
                            
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
    <div class="menu-bar checkout">
        <img src="image/menu.jpg" alt="Menu">
        <div class="container">
            <div class="text">
                <h2>Checkout</h2>
            </div>
        </div>
    </div>
    <div class="checkout-container">
        <div class="checkout-form">
            <form action="place_order.php" method="post">
                <div class="form-header">
                    <h4>Shipping Details</h4>
                </div>
                <div class="form-row">
                    <div>
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" placeholder="Your first name.." required>
                    </div>
                    <div>
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Your last name.." required>
                    </div>
                </div>
                <div class="form-row">
                    <div>
                        <label for="contactnum">Contact Number</label>
                        <input type="text" id="contactnum" name="contactnum" placeholder="Your contact number.." required onchange="validateNumber()">
                    </div>
                    <div>
                        <label for="postalcode">Postal Code</label>
                        <input type="text" id="postalcode" name="postalcode" placeholder="Your postal code.." required>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Your address.." required>
                    </div>
                </div>
                <div class="payment">
                    <h4>Payment Method</h4>
                    <p>
                        <i class="fa-brands fa-cc-paypal fa-2x"></i>
                        <i class="fa-brands fa-cc-apple-pay fa-2x"></i>
                        <i class="fa-brands fa-cc-visa fa-2x"></i>
                        <i class="fa-brands fa-cc-mastercard fa-2x"></i>
                    </p>
                </div>
                <div class="button">
                    <input type="button" onclick="location.href ='cart.php'"value="Back">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
        <div class="checkout-summary">
            <div class="header">Purchase Summary</div>
            <div class="content">
                    <?php
                    if(sizeof($cart_list) > 0){
                        $product_list = implode(",", $cart_list);
                        $product_quantity = array_count_values($cart_list);
                        // estabilish new db connection
                        @ $db = new mysqli('localhost', 'root', '','RetroCafe');
                        //log if db connection error
                        if (mysqli_connect_errno()) {
                            echo 'Error: Could not connect to database.  Please try again later.';
                            exit;
                        }
                        $query = "SELECT * FROM product WHERE id in (".$product_list.")";
                        $result = $db->query($query);
                        $num_results = $result->num_rows;
                        for ($i=0; $i <$num_results; $i++) {
                            $row = $result->fetch_assoc();
                            echo '<div class="item">
                                    <div class="product-image">
                                        <img src="'.$row['img_url'].'">
                                    </div>
                                    <div class="product-detail">
                                        <div class="product-title">'.$row['name'].'</div>
                                        <div class="product-quantity">x'.$product_quantity[$row['id']].'</div>
                                    </div>
                                    <div class="product-price">S$'.floatval($row['price'])*$product_quantity[$row['id']].'</div>
                                </div>';
                        }
                    }else{
                        echo "Shopping cart is empty!";
                    }
                    echo '<div class="sub"><div class="product-subtotal"><div>Subtotal</div><div>$'.$sub_total.'</div></div></div>
                        <div class="sub"><div class="product-subtotal"><div>Tax(7%)</div><div>$'.$tax.'</div></div></div>
                        <div class="sub"><div class="product-subtotal"><div>Shipping</div><div>$5</div></div></div>
                        <div class="total"><div class="product-subtotal"><div>Total</div><div>$'.$total.'</div></div></div></div>';
                    ?>
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
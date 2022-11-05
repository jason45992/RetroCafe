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
  $cart_list=[];
  if(isset($_SESSION['cart'])){
    $cart_list = $_SESSION['cart'];
    }
  if(isset($_GET['removeItem'])){
    foreach (array_keys($cart_list, $_GET['removeItem']) as $key) {
        unset($cart_list[$key]);
    }
    $_SESSION['cart'] = $cart_list;
    header('location: cart.php');
  }

  if(isset($_GET['decreaseIten'])){
    if (($key = array_search($_GET['decreaseIten'], $cart_list)) !== false) {
        unset($cart_list[$key]);
    }
    $_SESSION['cart'] = $cart_list;
    header('location: cart.php');
  }

  if(isset($_GET['addItem'])){
    array_push($cart_list, $_GET['addItem']);
    $_SESSION['cart'] = $cart_list;
    header('location: cart.php');
  }
  if (isset($_COOKIE['menu-scrollpos'])) {
    setcookie("menu-scrollpos", 0, time() + (86400 * 30));
  }
  
?>
<html>

<head>
    <title>Retro Café</title>
    <link href="styles.css" rel="stylesheet">
    <link href="cart.css" rel="stylesheet">
    <script type="text/javascript">
        function checkCart(is_empty) {
            if(is_empty){
                alert("Please add at least one item before check out.");
            }else{
                window.location.href = "checkout.php";
            }
        };
    </script>
</head>

<body>
    <!-- Navbar links -->
    <nav class="navbar">
        <a class="logo" href="index.php">
            <img src="logo.png">
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
    <div class="menu-bar">
        <img src="cart.jpg" alt="Menu">
        <div class="container">
            <div class="text">
                <h2>Shopping Cart</h2>
            </div>
        </div>
    </div>

    <div class="shopping-cart">
        <?php
            if(isset($cart_list) && sizeof($cart_list) > 0){
                echo '<div class="column-labels">
                        <label class="product-image">Image</label>
                        <label class="product-details">Product</label>
                        <label class="product-price">Price</label>
                        <label class="product-quantity">Quantity</label>
                        <label class="product-removal">Remove</label>
                        <label class="product-line-price">Total</label>
                    </div>';
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
                $sub_total = 0;
                for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
                    echo '<div class="product">
                            <div class="product-image">
                                <img src="'.$row['img_url'].'">
                            </div>
                            <div class="product-details">
                                <div class="product-title">'.$row['name'].'</div>
                                <p class="product-description">'.$row['description'].'</p>
                            </div>
                            <div class="product-price">'.$row['price'].'</div>
                            <div class="product-quantity">
                                <a class="remove-product" onclick="updateCokkie();" href="'.$_SERVER['PHP_SELF'].'?decreaseIten='.$row['id'].'">-</a>
                                <input type="text" value="'.$product_quantity[$row['id']].'" disabled="disabled">
                                <a class="remove-product" onclick="updateCokkie();" href="'.$_SERVER['PHP_SELF'].'?addItem='.$row['id'].'">+</a>
                            </div>
                            <div class="product-removal">
                                <a class="remove-product" onclick="updateCokkie();" href="'.$_SERVER['PHP_SELF'].'?removeItem='.$row['id'].'">Remove</a>
                            </div>
                            <div class="product-line-price">'.floatval($row['price'])*$product_quantity[$row['id']].'</div>
                        </div>';
                        $sub_total += floatval($row['price'])*$product_quantity[$row['id']];
				}
                $sub_total = number_format((float)$sub_total, 2, '.', '');
                $tax = $sub_total * 0.07;
                $tax = number_format((float)$tax, 2, '.', '');
                $total = $sub_total + $tax + 5;
                //store in session
                $_SESSION['sub_total'] = $sub_total; 
                $_SESSION['tax'] = $tax; 
                $_SESSION['total'] = $total; 
                echo '<div class="totals">
                        <div class="totals-item">
                            <label>Subtotal</label>
                            <div class="totals-value" id="cart-subtotal">'.$sub_total.'</div>
                        </div>
                        <div class="totals-item">
                            <label>Tax (7%)</label>
                            <div class="totals-value" id="cart-tax">'.$tax.'</div>
                        </div>
                        <div class="totals-item">
                            <label>Shipping</label>
                            <div class="totals-value" id="cart-shipping">5.00</div>
                        </div>
                        <div class="totals-item totals-item-total">
                            <label>Grand Total</label>
                            <div class="totals-value" id="cart-total">'.$total.'</div>
                        </div>
                    </div>';
            }else{ 
                echo "<p style=\"text-align: center;\">Shopping cart is empty!</p>";
            }
            if(empty($cart_list)){
                echo '<button class="checkout" onclick="checkCart(true);">Checkout</button>';
            }else{
                echo '<button class="checkout" onclick="checkCart(false);">Checkout</button>';
            }
        ?>
        
        

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
<!-- for cookie -->
<script type="text/javascript">
    function updateCokkie(){
        document.cookie = "cart-scrollpos="+window.scrollY;
    }
    window.scrollTo(0, <?php echo $_COOKIE['cart-scrollpos']; ?>);
</script>
</html>
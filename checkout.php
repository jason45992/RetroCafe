<?php
  session_start();
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
  $user_is_admin = $_SESSION['user_is_admin'];
  $cart_list = $_SESSION['cart'];
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
        <a class="logo" href="#">
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
                            echo "<li><a href=\"account_customer.php\">Account</a></li>";
                            if(count($_SESSION['cart']) > 0){
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
        <img src="menu.jpg" alt="Menu">
        <div class="container">
            <div class="text">
                <h2>Checkout</h2>
            </div>
        </div>
    </div>
    <div class="checkout-container">
        <div class="checkout-form">
            <form action="">
                <div class="form-header">
                    <h4>Shipping Details</h4>
                </div>
                <div class="form-row">
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="firstname" placeholder="Your name..">
                    </div>
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="firstname" placeholder="Your name..">
                    </div>
                </div>
                <div class="form-row">
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="firstname" placeholder="Your name..">
                    </div>
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="firstname" placeholder="Your name..">
                    </div>
                </div>
                <div>
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="firstname" placeholder="Your name..">
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
                    <input type="button" value="Back">
                    <input type="button" onclick="location.href='confirmation.php'" value="Submit">
                </div>
            </form>
        </div>
        <div class="checkout-summary">
            <div class="header">Purchase Summary</div>
            <div class="content">
                <div class="item">
                    <div class="product-image">
                        <img src="coffee.jpg">
                    </div>
                    <div class="product-detail">
                        <div class="product-title">Organic Nicaraguan Coffee</div>
                        <div class="product-quantity">x3</div>
                    </div>
                    <div class="product-price">S$12.99</div>
                </div>
                <div class="item">
                    <div class="product-image">
                        <img src="coffee.jpg">
                    </div>
                    <div class="product-detail">
                        <div class="product-title">Organic Nicaraguan Coffee</div>
                        <div class="product-quantity">x3</div>
                    </div>
                    <div class="product-price">S$12.99</div>
                </div>
                <div class="item">
                    <div class="product-image">
                        <img src="coffee.jpg">
                    </div>
                    <div class="product-detail">
                        <div class="product-title">Organic Nicaraguan Coffee</div>
                        <div class="product-quantity">x3</div>
                    </div>
                    <div class="product-price">S$12.99</div>
                </div>
                <div class="sub">
                    <div class="product-subtotal">
                        <div>Subtotal</div>
                        <div>S$33</div>
                    </div>
                </div>
                <div class="sub">
                    <div class="product-subtotal">
                        <div>Shipping</div>
                        <div>S$4</div>
                    </div>
                </div>
                <div class="total">
                    <div class="product-subtotal">
                        <div>Total</div>
                        <div>S$67</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer">
            <div class="footer-info-item">
                <h3>Information</h3>
                <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Customer Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Sitemap</a></li>
                    <li><a href="#">Orders &amp; Returns</a></li>
                </ul>
            </div>
            <div class="footer-info-item">
                <h3>My Account</h3>
                <ul class="list-unstyled">
                    <li><a href="#">Sign In</a></li>
                    <li><a href="#">View Cart</a></li>
                    <li><a href="#">My Wishlist</a></li>
                    <li><a href="#">Track My Order</a></li>
                    <li><a href="#">Help</a></li>
                </ul>
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
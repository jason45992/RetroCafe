<?php
  session_start();
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
  $user_is_admin = $_SESSION['user_is_admin'];
?>
<html>

<head>
    <title>Retro Café</title>
    <link href="styles.css" rel="stylesheet">
    <link href="cart.css" rel="stylesheet">
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
                        } else {
                            echo "<li><a href=\"account_admin.php\">Account</a></li>";
                        }
                    }else{
                        echo "<li><a href=\"login.php\">Login</a></li>";
                    }
                ?>
                <li>
                    <a href="cart.php"> Cart</a>
                </li>
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

        <div class="column-labels">
            <label class="product-image">Image</label>
            <label class="product-details">Product</label>
            <label class="product-price">Price</label>
            <label class="product-quantity">Quantity</label>
            <label class="product-removal">Remove</label>
            <label class="product-line-price">Total</label>
        </div>

        <div class="product">
            <div class="product-image">
                <img src="coffee.jpg">
            </div>
            <div class="product-details">
                <div class="product-title">Organic Nicaraguan Coffee</div>
                <p class="product-description">TRoasted, organic single-origin 100% Arabica coffee beans organically grown in the region of Nicaragua. Fully washed and traditionally fermented, this medium roast coffee has a fresh sharp acidity with citric notes of tangerine and a floral bouquet.</p>
            </div>
            <div class="product-price">12.99</div>
            <div class="product-quantity">
                <input type="number" value="2" min="1">
            </div>
            <div class="product-removal">
                <button class="remove-product">
                    Remove
                </button>
            </div>
            <div class="product-line-price">25.98</div>
        </div>

        <div class="product">
            <div class="product-image">
                <img src="coffee.jpg">
            </div>
            <div class="product-details">
                <div class="product-title">Organic Nicaraguan Coffee</div>
                <p class="product-description">TRoasted, organic single-origin 100% Arabica coffee beans organically grown in the region of Nicaragua. Fully washed and traditionally fermented, this medium roast coffee has a fresh sharp acidity with citric notes of tangerine and a floral bouquet. Grind fresh for the best ﬂavour. Suitable for cafetières and ﬁlter machines. Strength No. 3.</p>
            </div>
            <div class="product-price">45.99</div>
            <div class="product-quantity">
                <input type="number" value="1" min="1">
            </div>
            <div class="product-removal">
                <button class="remove-product">
                    Remove
                </button>
            </div>
            <div class="product-line-price">45.99</div>
        </div>

        <div class="totals">
            <div class="totals-item">
                <label>Subtotal</label>
                <div class="totals-value" id="cart-subtotal">71.97</div>
            </div>
            <div class="totals-item">
                <label>Tax (7%)</label>
                <div class="totals-value" id="cart-tax">3.60</div>
            </div>
            <div class="totals-item">
                <label>Shipping</label>
                <div class="totals-value" id="cart-shipping">15.00</div>
            </div>
            <div class="totals-item totals-item-total">
                <label>Grand Total</label>
                <div class="totals-value" id="cart-total">90.57</div>
            </div>
        </div>

        <button class="back">Back</button>
        <button class="checkout" onclick="location.href ='checkout.php'">Checkout</button>

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
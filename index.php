<?php
  session_start();
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
  $user_is_admin = $_SESSION['user_is_admin'];
  $cart_list = $_SESSION['cart'];
  if (isset($_COOKIE['menu-scrollpos'])) {
    setcookie("menu-scrollpos", 0, time() + (86400 * 30));
  }
  if (isset($_COOKIE['cart-scrollpos'])) {
    setcookie("cart-scrollpos", 0, time() + (86400 * 30));
  }
?>
<html>

<head>
    <title>Retro Café</title>
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
    <div>
        <!-- Banner -->
        <div class="banner">
            <img src="banner.jpg" alt="Banner">
            <div class="content">
                <h1>Unique Craft Cafe in NYC</h1>
                <p>Amet luctus venenatis lectus magna fringilla urna porttitor rhoncus dolor. A lacus vestibulum sed
                    arcu non. Dolor magna eget est lorem ipsum dolor sit amet consectetur.</p>
            </div>
        </div>
        <!-- Popular items -->
        <div class="topsales">
            <h2 class=""> Cake &amp; Dessert Cafe</h2>
            <div class="popular">
                <div class="gallery-inner">
                    <div class="">
                        <div class="popular-item">
                            <img src="cafe1.jpg">
                            <img class="overlay"src="cafe1.jpg">
                        </div>
                    </div>
                    <div class="">
                        <div class="popular-item">
                            <img src="cafe2.jpg">
                            <img class="overlay"src="cafe2.jpg">
                        </div>
                    </div>
                    <div class="">
                        <div class="popular-item">
                            <img src="cafe3.jpg">
                            <img class="overlay"src="cafe3.jpg">
                        </div>
                    </div>
                    <div class="">
                        <div class="popular-item">
                            <img src="cafe4.jpg">
                            <img class="overlay"src="cafe4.jpg">
                        </div>
                    </div>
                    <div class="">
                        <div class="popular-item">
                            <img src="cafe5.jpg">
                            <img class="overlay"src="cafe5.jpg">
                        </div>
                    </div>
                    <div class="">
                        <div class="popular-item">
                            <img src="cafe6.jpg">
                            <img class="overlay"src="cafe6.jpg">
                        </div>
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
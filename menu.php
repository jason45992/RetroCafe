<?php
  session_start();
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
  $user_is_admin = $_SESSION['user_is_admin'];
?>
<html>
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
                            echo "<li><a href=\"account_customer.php\">Account</a></li>";
                            echo "<li><a href=\"cart.php\">Cart</a></li>";
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
        <img src="menu.jpg" alt="Menu">
        <div class="container">
            <div class="text">
                <h1>Menu</h1>
            </div>
        </div>
    </div>
    <div class="menu-filter">
        <button id="btn-all" class="active" onclick="updateContentByFilter(this.id)">All</button>
        <button id="btn-coffee" class="inActive" onclick="updateContentByFilter(this.id)">Coffee</button>
        <button id="btn-cake" class="inActive" onclick="updateContentByFilter(this.id)">Cake</button>
    </div>
    <div class="menu-list">
        <div class="menu-item">
            <img src="food.jpg">
            <h2>TIRAMISU CAKE</h2>
            <p>Sample text. Click to select the text box. Click again or double click to start editing the text.</p>
            <p class="price">$19.99</p>
            <p><button>Add to Cart</button></p>
        </div>
        <div class="menu-item">
            <img src="food.jpg">
            <h2>TIRAMISU CAKE</h2>
            <p>Sample text. Click to select the text box. Click again or double click to start editing the text.</p>
            <p class="price">$19.99</p>
            <p><button>Add to Cart</button></p>
        </div>
        <div class="menu-item">
            <img src="food.jpg">
            <h2>TIRAMISU CAKE</h2>
            <p>Sample text. Click to select the text box. Click again or double click to start editing the text.</p>
            <p class="price">$19.99</p>
            <p><button>Add to Cart</button></p>
        </div>
        <div class="menu-item">
            <img src="food.jpg">
            <h2>TIRAMISU CAKE</h2>
            <p>Sample text. Click to select the text box. Click again or double click to start editing the text.</p>
            <p class="price">$19.99</p>
            <p><button>Add to Cart</button></p>
        </div>
        <div class="menu-item">
            <img src="food.jpg">
            <h2>TIRAMISU CAKE</h2>
            <p>Sample text. Click to select the text box. Click again or double click to start editing the text.</p>
            <p class="price">$19.99</p>
            <p><button>Add to Cart</button></p>
        </div>
        <div class="menu-item">
            <img src="food.jpg">
            <h2>TIRAMISU CAKE</h2>
            <p>Sample text. Click to select the text box. Click again or double click to start editing the text.</p>
            <p class="price">$19.99</p>
            <p><button>Add to Cart</button></p>
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

<script type="text/javascript" src="menu.js"></script>

</html>
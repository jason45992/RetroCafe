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
	<meta charset="ut£-8">
	<link rel="stylesheet" href="mystyle.css">
	<link href="styles.css" rel="stylesheet">
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
	<div class="wrapper">
		<img src="contactus.png" alt="About Us">
		<div class="container">
			<div class="text">
				<h1>About Us</h1>
			</div>
		</div>
		<div class="aboutus-info">
			<div class="info">
				<h1>01</h1>
				<h3>About Us</h3>
				<p>Retro Cafè provides a safe environment for customers to order fro online, fast delivery also ensure the food and cafe freshness.</p>
			</div>
			<div class="info">
				<h1>02</h1>
				<h3>Our Coffee</h3>
				<p>Rotate the blend origins often as part of an ongoing fine-tuning process to achieve sustained consistency in the taste.</p>
			</div>
			<div class="info">
				<h1>03</h1>
				<h3>Our Food</h3>
				<p>With an in-house cake bar, customers can look forward to a constantly-rotating menu of cakes, along with daily crafted bread.</p>
			</div>
			<div class="info">
				<h1>04</h1>
				<h3>Our Experience</h3>
				<p>Retro Cafè remains a mainstay for good coffee and simple, hearty and wholly satisfying fare, we are more than a restaurant.</p>
			</div>
		</div>
		<div class="about-container">
			<div class="leftcolumn">
				<img src="contactus1.png" alt="contact us image">
			</div>

			<div class="rightcolumn">
				<h1>Contact Us</h1>

				<form action="show_post.php" method="post">
					<label for="Name">Name:</label>
					<input type="text" name="Name" id="Name"><br>

					<label for="Email">E-mail:</label>
					<input type="email" name="Email" id="Email"><br>

					<label for="feedback"></label>
					<textarea type="textarea" name="feedback" id="feedback" required
						placeholder="Type your feedback here" rows="4" cols="35"></textarea><br>
					<input type="submit" value="Submit">
				</form>


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
                }else if($_SESSION['user_is_admin'] == 0){
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
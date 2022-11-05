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
  $user_user_name = $_SESSION['user_user_name'];
  $user_email= $_SESSION['user_email'];
  $user_is_admin="";
  if(isset($_SESSION['user_is_admin'])){
    $user_is_admin = $_SESSION['user_is_admin'];
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
	<div id="wrapper">
		<h1>My Account</h1><br><br>

		<div id="account_content">
			<h3>Personal Information</h3>
			<hr>
			<?php
				echo '<label><b>Name:</b> '.$user_name.'</label><br><label><b>Username:</b> '.$user_user_name.'</label><br><label><b>Email:</b> '.$user_email.'</label><br><br>';
			?>
			<div class="adminbutton">
				<button onclick="location.href='admin_console.php'">Admin Console</button>
				<button type="submit" class="btn" onclick="location.href='logout.php'">Logout</button>
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
<?php
  session_start();
  $is_edit = "";
  if(isset($_GET['edit'])){
    $is_edit = $_GET['edit'];
  }
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
  $cart_list="";
  if(isset($_SESSION['cart'])){
    $cart_list = $_SESSION['cart'];
    }
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
	<div id="wrapper">
		<h1>My Account</h1><br><br>

		<div id="account_content">
			<h2>Personal Information</h2>
			<hr>
			<?php
                if(empty($is_edit)){
                    echo '<div><label><b>Name:</b> '.$user_name.'</label><br><label><b>Username:</b> '.$user_user_name.'</label><br>
                    <label><b>Email:</b> '.$user_email.'</label></div><br><br>
                    <div class="edit" onclick="location.href=\'account_customer.php?edit=true\'"><button>Edit</button></div>';
                } else {
                    echo '<form action="user_profile_update.php" method="get">
                            <label><b>Name: </b><input name="name" value="'.$user_name.'" required></input></label><br>
                            <label><b>Username: </b><input name="username" value="'.$user_user_name.'" required></input></label><br>
                            <label><b>Email: </b>'.$user_email.'</label><br>
                            <div class="logout">
                            <input type="button" onclick="location.href=\'account_customer.php\'" value="Cancel"></input>
                            <input type="submit"></input>
                            </div>
                        </form>';
                }
			?>
            

			<h2>Order History</h2>
			<hr>
			<?php	
				// estabilish new db connection
				@ $db = new mysqli('localhost', 'root', '','RetroCafe');

				//log if db connection error
				if (mysqli_connect_errno()) {
					echo 'Error: Could not connect to database.  Please try again later.';
					exit;
				}
				$query = "SELECT LPAD(id, 8, '0') AS 'id', datetime, CONCAT(first_name, ' ', last_name) as 'name', amount, status 
                    FROM orders WHERE user_id = ".$user_id.";";
				$result = $db->query($query);
				$num_results = $result->num_rows;

				if($num_results > 0){
					echo '<table border="0"><tr><th>Order ID</th><th>Order Date</th><th>Ship-to-name</th><th>Total</th><th>Order Status</th></tr>';
					for ($i=0; $i <$num_results; $i++) {
						$row = $result->fetch_assoc();
						echo '<tr><td>'.$row['id'].'</td><td>'.$row['datetime'].'</td><td>'.$row['name'].'</td><td>'.$row['amount'].'</td><td>'.$row['status'].'</td></tr>';
					}
					echo '</table>';
				}else{
					echo '<div><p>No recent purchased found.</p></div>';
				}	
			?>
			<div class="logout">
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
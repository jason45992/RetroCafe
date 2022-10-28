<?php
  session_start();
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
  $user_is_admin = $_SESSION['user_is_admin'];
  $category = $_GET['category'];
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
        <button id="all" class="active" onclick="location.href='menu.php';">All</button>
        <button id="coffee" class="inActive" onclick="location.href='menu.php?category=coffee';">Coffee</button>
        <button id="cake" class="inActive" onclick="location.href='menu.php?category=cake';">Cake</button>
    </div>
    <div class="menu-list">
        <?php
            // estabilish new db connection
			@ $db = new mysqli('localhost', 'root', '','RetroCafe');
			//log if db connection error
			if (mysqli_connect_errno()) {
				echo 'Error: Could not connect to database.  Please try again later.';
				exit;
			}
			$query = "SELECT * FROM product";

            if($category && $category != 'all'){
                $query = $query." WHERE category='".$category."'";
            }

			$result = $db->query($query);
			$num_results = $result->num_rows;

			if($num_results > 0){
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
                    echo '<div class="menu-item"><img src="'.$row['img_url'].'"><h2>'.$row['name'].'</h2><p class="price">$'.$row['price'].'</p><p class="description">'.$row['description'].'</p><p><button>Add to Cart</button></p></div>';
				}
			}else{
				echo '<div><p>No recent purchased found.</p></div>';
			}	
        ?>
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
<script type="text/javascript">
    function updateContentByFilter(id) {
    if(id == "coffee"){
        document.getElementById("all").classList = ["inActive"];
        document.getElementById("coffee").classList = ["active"];
        document.getElementById("cake").classList = ["inActive"];

    }else if(id == "cake"){
        document.getElementById("all").classList = ["inActive"];
        document.getElementById("coffee").classList = ["inActive"];
        document.getElementById("cake").classList = ["active"];
    }
}
</script>

<?php 
echo '<script type="text/JavaScript"> updateContentByFilter("'.$category.'");</script>';
?>

</html>
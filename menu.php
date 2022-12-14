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

  $category = 'all';
  if(isset($_GET['category'])){
    $category = $_GET['category'];
    }
  if($category === NULL){
    $category = 'all';
  }

  $cart_list="";
  if(isset($_SESSION['cart'])){
    $cart_list = $_SESSION['cart'];
    }

  if (isset($_GET['buy'])) {
    $_SESSION['cart'][] = $_GET['buy'];
  }

  if (isset($_COOKIE['cart-scrollpos'])) {
    setcookie("cart-scrollpos", 0, time() + (86400 * 30));
  }
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
    <div class="menu-bar">
        <img src="image/menu.jpg" alt="Menu">
        <div class="container">
            <div class="text">
                <h1>Menu</h1>
            </div>
        </div>
    </div>
    <div class="menu-filter">
        <button id="all" class="active" onclick="location.href='menu.php?category=all';">All</button>
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
			$query = "SELECT * FROM product where product.visable = 1";

            if($category && $category != 'all'){
                $query = $query." and category='".$category."'";
            }

			$result = $db->query($query);
			$num_results = $result->num_rows;

			if($num_results > 0){
				for ($i=0; $i <$num_results; $i++) {
					$row = $result->fetch_assoc();
                    if(empty($user_id)){
                        echo '<div class="menu-item"><img src="'.$row['img_url'].'"><h2>'.$row['name'].'</h2>
                        <p class="price">$'.$row['price'].'</p><p class="description">'.$row['description'].'</p>
                        <p><button onclick="addToCart(0,'.$row['id'].',\''.$row['name'].'\',this);">Add to Cart</button></p></div>';
                    }else{
                        if($row['quantity'] > 0){
                            echo '<div class="menu-item"><img src="'.$row['img_url'].'"><h2>'.$row['name'].'</h2>
                            <p class="price">$'.$row['price'].'</p><p class="description">'.$row['description'].'</p>
                            <p><button onclick="addToCart(1,'.$row['id'].',\''.$row['name'].'\',this);">Add to Cart</button></p></div>';
                        } else {
                            echo '<div class="menu-item"><img src="'.$row['img_url'].'"><h2>'.$row['name'].'</h2>
                            <p class="price">$'.$row['price'].'</p><p class="description">'.$row['description'].'</p>
                            <p><button class="out-stock"">Out of Stock</button></p></div>';
                        }
                    }
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
<script type="text/javascript">
    function updateContentByFilter(id) {
        if(id == "coffee"){
            document.getElementById("all").classList = ["inActive"];
            document.getElementById("coffee").classList = ["active"];
            document.getElementById("cake").classList = ["inActive"];

        } else if(id == "cake"){
            document.getElementById("all").classList = ["inActive"];
            document.getElementById("coffee").classList = ["inActive"];
            document.getElementById("cake").classList = ["active"];
        } else {
            document.getElementById("all").classList = ["active"];
            document.getElementById("coffee").classList = ["inActive"];
            document.getElementById("cake").classList = ["inActive"];
        }
        document.cookie = "menu-scrollpos=0";
    };
</script>
<?php 
    echo '<script type="text/JavaScript"> updateContentByFilter("'.$category.'");</script>';
?>
<script type="text/javascript">
    function addToCart(is_login, product_id, product_name, el) {
        if(is_login){
            if(<?php echo empty($user_is_admin)?>){
                var path = "menu.php";
                var category = <?php echo $category; ?>;
                if(category){
                    path = path + "?category=" + category.id;
                }
                path = path + "&buy="+product_id;
                el.innerHTML = "Added";
                document.cookie = "menu-scrollpos="+window.scrollY;
                setTimeout(function() {
                    window.location.href = path;
                }, 500);
            }
        }else{
            alert("Please login first");
            window.location.href = "login.php";
        }
    };
</script>
<!-- for cookie -->
<script type="text/javascript">
    window.scrollTo(0, <?php echo $_COOKIE['menu-scrollpos']; ?>);
</script>
</html>
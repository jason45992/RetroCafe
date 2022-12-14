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
?>
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
    <div class="bg-img">
        <div class="signup form-wapper">
            <form action="signup-action.php" method="post" class="container">
                <div class="left">
                    <h1>Sign Up</h1>
                    <p>Sign up now to get 10% off your order and a change to win 12 months of Arabica instant coffee.</p>
                    <img src="image/logo_dark.png">
                </div>
                <div class="right">
                    <label for="name"><b>Name</b></label>
                    <input type="text" placeholder="Enter Name" name="name" required>

                    <label for="username"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" required>

                    <label for="email"><b>Email</b></label>
                    <input type="email" placeholder="Enter Email" name="email" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" id ="psw" required>

                    <label for="cfpsw"><b>Confirm Password</b></label>
                    <input type="password" placeholder="Enter Password Again" onchange="checkpwd()" name="cfpsw" id ="cfpsw" required>

                    <button type="submit" class="btn">Submit</button>
                </div>
            </form>
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
    <script>
        function checkpwd() {
            if (!(document.getElementById('psw').value == document.getElementById('cfpsw').value)) {
                alert("Your password does not match.");
            } 
        }
    </script>
</body>
</html>
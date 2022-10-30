<?php
  session_start();
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
  $user_is_admin = $_SESSION['user_is_admin'];
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
		<h1>Admin Console</h1>

		<div id="adminConsole_content">
			<table border="1">

				<tr>
					<th>Iteme Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Visable</th>
					<th>Modified Date</th>
				</tr>

				<tr>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
				</tr>

				<tr>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
				</tr>

				<tr>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
				</tr>

				<tr>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
					<td>xxxxxxxx</td>
				</tr>

			</table>
			<form action="show_get.php" method="get">
				<div class="row">
					<div>
						<label for="item_name">Item Name:</label>
						<input type="text" name="item_name" id="item_name">
					</div>
					<div>
						<label for="price">Price:</label>
						<input type="number" name="price" id="price">
					</div>
					<div>
						<label for="quantity">Quantity:</label>
						<input type="number" name="quantity" id="quantity">
					</div>
					<div>
						<label class="radio-header">Visable:</label>
						<div class="radio-grp">
							<input type="radio" name="visable" value="true" checked>
							<label for="visable">True</label>
							<input type="radio" name="visable" value="false">
							<label for="visable">False</label>
						</div>
					</div>
					<div class="form-dropdown">
						<select size="1" name="chooseitem">
							<option>Add New</option>
							<option value="item1"> Item #1 </option>
							<option value="item2"> Item #2 </option>
							<option value="item3"> Item #3 </option>
						</select>
					</div>

				</div>

				<br>
				<label id="description-label" for="description">Description:</label>
				<textarea type="textarea" name="description" id="description" rows="2" cols="80"></textarea>

			</form>
			<div class="form-btn-group">
				<input type="button" value="Back">
				<input type="submit" value="Submit">
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

				<p class="copyright">Copyright &copy; 2022 Retro Café</p>
			</div>
		</div>
	</footer>
</body>

</html>
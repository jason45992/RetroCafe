<?php
  session_start();
  $user_id = $_SESSION['user_id'];
  $user_name = $_SESSION['user_name'];
  $user_is_admin = $_SESSION['user_is_admin'];

// estabilish new db connection
@ $db = new mysqli('localhost', 'root', '','RetroCafe');

//log if db connection error
if (mysqli_connect_errno()) {
	echo 'Error: Could not connect to database.  Please try again later.';
	exit;
}

$selected=$_GET['selected'];
$selectedname='';
$selectedprice='';
$selectedquantity='';
$selecteddescription='';
$selectedvisable='';
$selectedcategory='';
$selectedimgurl='';


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
		<h1>Admin Console</h1>

		<div id="adminConsole_content">
			
				<?php	
				$query = "SELECT id, category, name, img_url, description, price, quantity, visable, modified_date FROM `product`;";
				$result = $db->query($query);
				$num_results = $result->num_rows;

				if($num_results > 0){
					echo '<table border="1"><tr>
					<th>Category</th>
					<th>Iteme Name</th>
					<th>Image URL</th>
					<th>Description</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Visable</th>
					<th>Modified Date</th></tr>';
					for ($i=0; $i <$num_results; $i++) {
						$row = $result->fetch_assoc();
						$itemid = $row['id'];

						if($selected==$itemid){
							$selectedcategory=$row['category'];
							$selectedname=$row['name'];
							$selectedimgurl=$row['img_url'];
							$selectedprice=$row['price'];
							$selectedquantity=$row['quantity'];
							$selecteddescription=$row['description'];
							$selectedvisable=$row['visable'];
						}
					echo '<tr>
					<td>'.$row['category'].'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['img_url'].'</td>
					<td>'.$row['description'].'</td>
					<td>'.$row['price'].'</td>
					<td>'.$row['quantity'].'</td>
					<td>'.$row['visable'].'</td>
					<td>'.$row['modified_date'].'</td>
				</tr>';
					
				}
				echo '</table>';
			}
			?>

			<form action="admin_console_info_update.php" method="get">

				<div class="row">


				<div style="display:none">
				<label for="item_id">Item id:</label>
				<input type="text" value="<?php echo $selected; ?>" name="item_id" id="item_id">
				</div>


				<div>
					<label for="category">Category:</label>
					<input type="text" value="<?php echo $selectedcategory; ?>" name="category" id="category">
				</div>


					<div>
				<label for="item_name">Item Name:</label>
				<input type="text" value="<?php echo $selectedname; ?>" name="item_name" id="item_name">
					</div>

					<div>
					<label for="img_url">Image URL:</label>
					<input type="text" value="<?php echo $selectedimgurl; ?>" name="img_url" id="img_url">
				</div>
				

					<div>
					<label for="price">Price:</label>
					<input type="number" min="0" value="<?php echo $selectedprice; ?>" name="price" id="price">
					</div>

					<div>
					<label for="quantity">Quantity:</label>
					<input type="number"  min="0" value="<?php echo $selectedquantity; ?>" name="quantity" id="quantity">
					</div>

					<div>
						<label class="radio-header">Visable:</label>
						<div class="radio-grp">

					
							<input type="radio" name="visable" value="1" checked="checked"
							<?php if ($selectedvisable == 1): ?>
               checked="checked"
			   <?php endif ?>>True<br>
			   <input type="radio" name="visable" value="0"
							<?php if ($selectedvisable == 0): ?>
               checked="checked"
			   <?php endif ?>>False<br>
			   


						</div>
					</div>
		
					<div class="form-dropdown">

						<select onchange="window.location.href='admin_console.php?selected='+this.value+''">
						<option value='AddNew' > Add New </option>
						<?php
						$query = "SELECT id, name FROM `product`;";
						$result = $db->query($query);
						$num_results = $result->num_rows;
		
						while($row = $result->fetch_assoc()){
							$dropdown = $row['name'];
							$itemid = $row['id'];

							if($selected==$itemid){
								echo '<option selected value='.$itemid.'>'.$dropdown.'</option>';
							}
							else{
								echo '<option value='.$itemid.'>'.$dropdown.'</option>';
							}
						}
						?>
						</select>
					</div>
				</div>

				<br>
				<label id="description-label" for="description">Description:</label>
				<textarea type="textarea"  name="description" id="description" rows="2" cols="92"><?php echo $selecteddescription; ?></textarea>
	
			
			
			<div class="form-btn-group">
				<input type="button" onclick="location.href ='account_admin.php'"value="Back">
				<input type="submit" name="submit" value="Update">
				<input type="submit" name="submit" value="Remove">
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
                if(isset($_SESSION['user_id'])){
                    echo '<h3>My Account</h3>
                    <ul class="list-unstyled">
                        <li><a href="cart.php">View Cart</a></li>
                        <li><a href="account_customer.php">Track My Order</a></li>
                        <li><a href="aboutus.php">Help</a></li>
                    </ul>';
                }else{
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
<?php
session_start();
include("functions/functions.php");
include("includes/db.php");
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>WELCOME TO INSAFE SERVICE</title>
	<link rel="stylesheet" href="styles/style.css" media="all"/>
</head>

<body>
	<div class="main_wrapper">
	
		<div class="header_area">
		
			<div class="header_logo">
				<a href="index.php">
					<img id="logo" src="images/main_logo.png" alt="" />
				</a>
			</div>
			
			<div id="form">
				<form method="get" action="search_results.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Serch Anything.."/>
					<input type="submit" name="search" value="Search"/>
				</form>
			</div>
			<a href="cart.php">
				<div class="cart">
					<ul>
						<li class="dropdown_header_cart">
							<div id="notification_total_cart" class="shopping-cart">
								<img src="images/cart_icon.png" id="cart" alt="" />
								<div class="notification_cart_no">
									<?php
										getTotalItem();
									?>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</a>
			
			<?php if(!isset($_SESSION['user_id'])){?>
			
			<div class="register-login">
				<div class="login">
					<a href="index.php?action=login">Login</a>
				</div>
				&nbsp;&nbsp;
				<div class="register">
					<a href="registration.php">Register</a>
				</div>
			</div>
			
			<?php }else{ ?>
			
			<?php 
			$select_user = mysqli_query($con,"select * from users where user_id = '$_SESSION[user_id]' ");
			$user_data = mysqli_fetch_array($select_user);
			?>
				<div id="profile">
					<ul>
						<li class="dropdown_header">
							<a>
							<?php if($user_data['user_image'] != '') {?>
								<span><img src="customer_area/customer_images/<?php echo $user_data['user_image']; ?>" alt="" /></span>
							<?php }else{ ?>
								<span><img src="images/profile-icon.png" alt="" /></span>
							<?php } ?>
							</a>
							
							<ul class="dropdown_menu_header">
								<li><a href="my_account.php?action=edit_account">Account Setting</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
							
						</li>
					</ul>
				</div>
			<?php }?>
			
		</div>
		
	<div class="menu_bar">
		<ul id="menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="all_products.php">All Product</a></li>
			<li><a href="my_account.php">My Account</a></li>
			<li><a href="cart.php">Shopping Cart</a></li>
			<li><a href="contact.php">Contact Us</a></li>
			<?php if(isset($_SESSION['user_id'])){?>
			<li><a href="logout.php">Logout</a></li>
			<?php }else{ ?>
			<li><a href="index.php?action=login">Login</a></li>
			<?php }?>
		</ul>
	</div>
	
	
	
<script>
let dropdownBtn = document.querySelector('.dropdown_header');
let menuContent = document.querySelector('.dropdown_menu_header');
dropdownBtn.addEventListener('click',()=>{
   if(menuContent.style.display===""){
      menuContent.style.display="block";
   } else {
      menuContent.style.display="";
   }
})
</script>
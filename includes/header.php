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
    <link rel="stylesheet" href="styles/style.css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
</head>

<body>
    <div class="container" style="background-color: #e3f2fd;">
        <div class="row pt-2" style="background: #e3f2fd;">
            <div class="col-md-3 p-0 m-0">
                <div class="header_logo">
                    <a href="index.php">
                        <img id="logo" src="images/main_logo.png" alt="" />
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <form method="get" action="search_results.php" enctype="multipart/form-data">
                    <div class="input-group mb-3" id="form">
                        <input type="text" name="user_query" class="form-control" placeholder="Serch Anything..">
                        <button class="btn btn-outline-secondary" type="submit" name="search">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-1">
                <a href="cart.php">
                    <div class="cart">
                        <ul>
                            <li class="dropdown_header_cart">
                                <div id="notification_total_cart" class="shopping-cart">
                                    <!-- <img src="https://via.placeholder.com/30x30" id="cart" alt="" /> -->
									<i style="font-size: 2rem;" class="bi bi-cart-check-fill"></i>
                                    <div class="notification_cart_no">
										<?php getTotalItem($pdo); ?>
									</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </a>
            </div>
			<?php if(!isset($_SESSION['user_id'])){?>
            <div class="col-md-4">
                <div class="register-login float-md-end">
                    <div class="login ">
                        <a class="btn btn-info" href="index.php?action=login">Login</a>
                        <a class="btn btn-info" href="registration.php">Register</a>
                    </div>
                </div>
            </div>
			<?php }else{ ?>
			
			<?php 
			$select_user = $pdo->query("SELECT * from users where user_id = '$_SESSION[user_id]'");
			$user_data = $select_user->fetch();
			?>
			<div class="col-md-4">
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
                <div class="register-login float-md-end">
                    <div class="login ">
                        <a class="btn btn-info" href="my_account.php">Dashboard</a>
                        <a class="btn btn-info" href="logout.php">Log Out</a>
                    </div>
                </div>
            </div>
			<?php }?>
        </div>
        <div class="row ">
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#0dcaf0;">
                <div class="container-fluid">
                    <a href="index.php" class="navbar-brand">Home</a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav">
                            <a href="all_products.php" class="nav-item nav-link text-white">All Product</a>
                            <a href="my_account.php" class="nav-item nav-link text-white">My Account</a>
                            <a href="cart.php" class="nav-item nav-link text-white">Shopping Cart</a>
                            <a href="contact.php" class="nav-item nav-link text-white">Contact Us</a>
                            <a href="logout.php" class="nav-item nav-link text-white">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
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
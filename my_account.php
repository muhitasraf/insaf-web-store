<?php 
	include("includes/header.php");
?>
	
	<div class="content_wrapper">
		<?php if(isset($_SESSION['user_id'])){ ?>
		<div class="user_container">
			<div class="user_contant">
				<?php
				if(isset($_GET['action'])){
					$action = $_GET['action'];
				}else{
					$action = '';
				}
				
				switch($action){
					case "edit_account";
					include('customer_area/edit_account.php');
					break;
					
					case "edit_profile";
					include('customer_area/edit_profile.php');
					break;
					
					case "change_password";
					include('customer_area/change_password.php');
					break;
					
					case "delete_account";
					echo $action;
					break;
					
					case "logout";
					echo $action;
					break;
					
					default;
					echo "Do you want to edit account?";
				}
				?>
			</div>
			<div class="user_sidebar">
				<?php 
					$run_image = $pdo->query("SELECT * from users where user_id = '$_SESSION[user_id]'");
					$row_image = $run_image->fetch();
					
					if($row_image['user_image'] !=''){
				?>	
				
				<div class="user_image" align="center">
					<img src="customer_area/customer_images/<?php echo $row_image['user_image']; ?>" alt="" />
				</div>
				
				<?php }else{ ?>
				<div class="user_image" align="center">
					<img src="customer_area/customer_images/<?php echo $row_image['user_image']; ?>" alt="" />
				</div>
				<?php } ?>
				<ul>
					<li><a href="my_account.php?action=my_order">My Order</a></li>
					<li><a href="my_account.php?action=edit_account">Edit Account</a></li>
					<li><a href="my_account.php?action=edit_profile">Edit Profile</a></li>
					<li><a href="my_account.php?action=change_password">Change Password</a></li>
					<li><a href="my_account.php?action=delete_account">Delete Account</a></li>
					<li><a href="my_account.php?action=logout">Logout</a></li>
				</ul>
			</div>
		</div>
		<?php }else{ ?>
		<h1>Account Setting Page</h1>
		<h5><a href="index.php?action=login">Login</a> to your account.</h5>
		<?php }?>
	</div>

<?php include("includes/footer.php");?>		
<?php 
	include("includes/header.php");
?>

<div class="row" style="margin-bottom:50px">
	<div class="" style="margin-top:40px">
		<div class="rounded d-flex justify-content-center">
			<div class="col-md-4 col-sm-12 shadow-lg p-3 bg-light">
				<div class="text-center">
					<h3 class="text-primary">Sign In</h3>
				</div>
				<form method="post" action=""  enctype="multipart/form-data">
					<div class="p-1">
						<label for="user_name">Full Name</label>
						<div class="input-group mb-1">
							<input class="form-control" type="text" name="user_name" placeholder="Full name" required>
						</div>
						<label for="user_email">Email</label>
						<div class="input-group mb-1">
							<input class="form-control" type="Email" name="user_email" placeholder="Email" required>
						</div>
						<label for="user_password">Password</label>
						<div class="input-group mb-1">
							<input type="password" name="user_password" class="form-control" placeholder="password" required>
						</div>
						<label for="confirm_password">Confirm Password</label>
						<div class="input-group mb-1">
							<input type="Password" name="confirm_password" class="form-control"  id="confirm_password2" placeholder="Confirm Password" required>
						</div>
						<label for="country">Country</label>
						<div class="input-group mb-1">
							<?php include('includes/country_list.php'); ?>
						</div>
						<label for="user_city">City</label>
						<div class="input-group mb-1">
							<input type="Text" name="user_city" class="form-control" required placeholder="City"  />
						</div>
						<label for="user_contact">Contact</label>
						<div class="input-group mb-1">
							<input type="Text" name="user_contact" class="form-control" required placeholder="Contact"  />
						</div>
						<label for="user_address">Address</label>
						<div class="input-group mb-1">
							<input type="Text" name="user_address" class="form-control" required placeholder="Address"  />
						</div>
						<label for="user_image">Image</label>
						<div class="input-group mb-1">
							<input type="file" name="user_image" class="form-control" required placeholder="Address"  />
						</div>
						<div class="d-grid gap-2">
							<button class="btn btn-primary text-center mt-2" type="submit" name="register">Register</button>
						</div>
						<p class="text-center mt-2">Don't have an account?
							<span class="text-primary">
								<a style="text-decoration:none;" href="index.php?action=login">Login</a>
							</span>
						</p>
						<p class="text-center text-primary">
							<a style="text-decoration:none;" href="checkout.php?forget_pass">Forget Password?</a>
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>	

<?php
if(isset($_POST['register'])){
	if(!empty($_POST['user_email']) && !empty($_POST['user_password']) && !empty($_POST['confirm_password']) && !empty($_POST['user_name']) ){
		
		$ip_address = getIpAddress();
		$user_name = ($_POST['user_name']);
		$user_email = trim($_POST['user_email']);
		$user_password = trim($_POST['user_password']);
		$hash_password = md5($user_password);
		
		$confirm_password = trim($_POST['confirm_password']);
		
		$user_image = $_FILES['user_image']['name'];
		$user_image_tmp = $_FILES['user_image']['tmp_name'];
		
		$user_country = trim($_POST['user_country']);
		$user_city = trim($_POST['user_city']);
		$user_address = trim($_POST['user_address']);
		$user_contact = trim($_POST['user_contact']);
		
		$check_exist = $pdo->query(" SELECT * from users where user_email = '$user_email' ");
		$row_register = $check_exist->fetchAll();
		$email_count = count($row_register);
		if($email_count > 0){
			echo "<script>alert('Email $user_email exist!')</script>";
		}elseif($row_register['$user_email'] != $user_email && $user_password == $confirm_password){
			move_uploaded_file($user_image_tmp,"customer_area/customer_images/$user_image");
			$run_insert = $pdo->query("INSERT into users (ip_address, user_name, user_email, user_password, user_country, user_city, user_contact, user_address, user_image)
			values ('$ip_address','$user_name', '$user_email','$hash_password', '$user_country','$user_city','$user_contact','$user_address','$user_image')");
			
			if($run_insert){
				$select_user = $pdo->query("SELECT * from users where user_email = '$user_email'");
				$row_user = $select_user->fetch();
				
				$_SESSION['user_id']=$row_user['user_id']."<br/>";
				$_SESSION['role']=$row_user['role'];
			}
			
			$run_cart = $pdo->query("SELECT * from cart where ip_address = '$ip_address'")->fetch();
			$check_cart = count($run_cart);
			
			if($check_cart == 0){
				$_SESSION['user_email']= $user_email;
				echo "<script>alert('Successfully login')</script>";
				echo "<script>window.open('customer_area/my_account.php','_self')</script>";
			}else{
				$_SESSION['user_email']= $user_email;
				echo "<script>alert('Successfully login')</script>";
				echo "<script>window.open('checkout.php','_self')</script>";
			}
		}
	}
}
?>
</div>

<?php include("includes/footer.php");?>		




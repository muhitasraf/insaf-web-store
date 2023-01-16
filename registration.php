<?php 
	include("includes/header.php");
?>

<div class="content_wrapper">
	<div class="registration_box">
		<form method="post" action=""  enctype="multipart/form-data">
			<table align="left" width="70%">
				<tr align="left">
					<td colspan="4">
						<h2>Register</h2><br/>
						<span>
							I have an account? <a href="index.php?action=login">Login Here</a><br/><br/>
						</span>
					</td>
				</tr>
				
				<tr>
					<td width="15%">Full Name: </td>				
					<td colspan="3"><input type="Text" name="user_name" required placeholder="Full Name"  /></td>
				</tr>
				
				<tr>
					<td width="15%">Email:</td>				
					<td colspan="3"><input type="Email" name="user_email" required placeholder="Email"  /></td>
				</tr>
				
				<tr>
					<td width="15%">Password:</td>				
					<td colspan="3"><input type="Password" id="confirm_password1" name="user_password" required placeholder="Password"  /></td>
				</tr>
				
				<tr>
					<td width="15%">Confirm Password:</td>				
					<td colspan="3"><input type="Password" id="confirm_password2" name="confirm_password" required placeholder="Confirm Password"  /></td>
				</tr>
				
				<tr>
					<td width="25%">Country:</td>				
					<td colspan="3">
						<?php include('includes/country_list.php'); ?>
					</td>
				</tr>
				
				<tr>
					<td width="15%">City:</td>				
					<td colspan="3"><input type="Text" name="user_city" required placeholder="City"  /></td>
				</tr>
				
				<tr>
					<td width="15%">Contact:</td>				
					<td colspan="3"><input type="Text" name="user_contact" required placeholder="Contact"  /></td>
				</tr>
				
				<tr>
					<td width="15%">Address:</td>				
					<td colspan="3"><input type="Text" name="user_address" required placeholder="Address"  /></td>
				</tr>
				
				<tr>
					<td width="15%">Image:</td>				
					<td colspan="3"><input type="file" name="user_image" required placeholder="Address"  /></td>
				</tr>
				
				<tr align="left">
					<td></td>		
					<td colspan="4">
						<input type="submit" name="register" value="Register"  />
					</td>
				</tr>
				
			</table>
		</form>
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




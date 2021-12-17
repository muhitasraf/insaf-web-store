
<div class="login_box">
	<form method="post" action="" >
		<table align="left" width="70%">
			<tr align="left">
				<td colspan="4">
					<h4>Login</h4><br/>
					<span>
						Dont Have an account? <a href="registration.php">Register Here</a><br/><br/>
					</span>
				</td>
			</tr>
			
			<tr>
				<td width="15%">Email:</td>				
				<td colspan="3"><input type="Email" name="user_email" required placeholder="Email"  /></td>
			</tr>
			
			<tr>
				<td width="15%">Password:</td>				
				<td colspan="3"><input type="Password" name="user_password" required placeholder="Password"  /></td>
			</tr>
			
			<tr align="left">
				<td></td>		
				<td colspan="4">
				<input type="submit" name="login" value="Login"  />
				</td>
			</tr>
			
			<tr align="left">
				<td></td>		
				<td colspan="4">
				<a href="checkout.php?forget_pass">Forget Password?</a>
				</td>
			</tr>
			
		</table>
	</form>
</div>
	
<?php
if(isset($_POST['login'])){
	
	$user_email = trim($_POST['user_email']);
	$user_password = trim($_POST['user_password']);
	$user_password = md5($user_password);
	
	$run_login = mysqli_query($con,"select * from users where user_email='$user_email' AND user_password='$user_password' "); 
	$check_login = mysqli_num_rows($run_login);
	
	$row_login = mysqli_fetch_array($run_login);
	
	if($check_login == 0){
		echo "<script>alert('Password or email not match.')</script>";
		exit();
	}
	
	$ip_address = getIpAddress();
	$run_cart = mysqli_query($con,"select * from cart where ip_address='$ip_address'");
	$check_cart = mysqli_num_rows($run_cart);
	
	if($check_login > 0 AND $check_cart==0){
		
		$_SESSION['user_id'] = $row_login['user_id'];
		$_SESSION['role']=$row_login['role'];
		$_SESSION['user_email'] = $user_email;
		
		echo "<script>alert('Successfully login.')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
		
	}else{
		
		$_SESSION['user_id'] = $row_login['user_id'];
		$_SESSION['role']=$row_login['role'];
		$_SESSION['user_email'] = $user_email;
		echo "<script>alert('Successfully login')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
	}
}
?>

<div class="row" style="margin-bottom:50px">
	<div class="" style="margin-top:50px">
		<div class="rounded d-flex justify-content-center">
			<div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
				<div class="text-center">
					<h3 class="text-primary">Sign In</h3>
				</div>
				<form method="POST" action="">
					<div class="p-4">
						<div class="input-group mb-3">
							<span class="input-group-text bg-primary">
								<i class="bi bi-person-plus-fill text-white"></i>
							</span>
							<input class="form-control" type="Email" name="user_email" placeholder="Email" required>
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text bg-primary">
								<i class="bi bi-key-fill text-white"></i>
							</span>
							<input type="password" name="user_password" class="form-control" placeholder="password" required>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">Remember Me</label>
						</div>
						<div class="d-grid gap-2">
							<button class="btn btn-primary text-center mt-2" type="submit" name="login">Login</button>
						</div>
						<p class="text-center mt-3">Don't have an account?
							<span class="text-primary"><a style="text-decoration:none;" href="registration.php">Sign Up</a></span>
						</p>
						<p class="text-center text-primary"><a style="text-decoration:none;" href="checkout.php?forget_pass">Forget Password?</a></p>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	
<?php
if(isset($_POST['login'])){
	$user_email = trim($_POST['user_email']);
	$user_password = trim($_POST['user_password']);
	$user_password = md5($user_password);
	
	$run_login = $pdo->query("SELECT * FROM users WHERE user_email='$user_email' AND user_password='$user_password' "); 
	$row_login = $run_login->fetch();
	$check_login = count($row_login);
	
	if($check_login == 0){
		echo "<script>alert('Password or email not match.')</script>";
		exit();
	}
	
	$ip_address = getIpAddress();
	$run_cart = $pdo->query("SELECT * FROM cart WHERE ip_address='$ip_address'");
	$check_cart = count($run_cart->fetch());
	
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

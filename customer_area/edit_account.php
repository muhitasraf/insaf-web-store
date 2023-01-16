<?php 
$select_user = $pdo->query("select * from users where user_id = '$_SESSION[user_id]'");
$fetch_user = $select_user->fetch();
?>
	<div class="registration_box">
		<form method="post" action=""  enctype="multipart/form-data">
			<table align="left" width="70%">
				<tr align="left">
					<td colspan="4">
						<h2>Edit Your Account</h2><br/>
					</td>
				</tr>
				
				<tr>
					<td width="15%">Change Email:</td>				
					<td colspan="3"><input type="Email" name="user_email" value="<?php echo $fetch_user['user_email']?>" required placeholder="Email"  /></td>
				</tr>
				
				<tr>
					<td width="30%">Current Password:</td>				
					<td colspan="3"><input type="password" name="current_password" required placeholder="Current Password"/>
					</td>
				</tr>
				
				<tr align="left">
					<td></td>		
					<td colspan="4">
					<input type="submit" name="edit_account" value="Update"  />
					</td>
				</tr>
				
			</table>
		</form>
	</div>
	

<?php
if(isset($_POST['edit_account'])){

	$user_email = trim($_POST['user_email']);
	$current_password = trim($_POST['current_password']);
	$hash_password = md5($current_password);
	
	$check_exist = $pdo->query("SELECT * FROM users WHERE user_email = '$user_email' ");
	
	$row_register = $check_exist->fetchAll();
	$email_count = count($row_register);
	if($email_count>0){
		echo "<script>alert('Email $user_email exist!')</script>";
	}elseif($fetch_user['user_password'] != $hash_password){
		echo "<script>alert('Your Current Password is wrong.')</script>";
	}else{
		$update_email = $pdo->query("UPDATE users SET user_email = '$user_email' WHERE user_id = '$_SESSION[user_id]'");
		if($update_email){
			echo "<script>alert('Email updated Successfully')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";
		}
	}
}
?>




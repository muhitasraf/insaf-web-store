<?php 
$select_user = mysqli_query($con,"select * from users where user_id = '$_SESSION[user_id]'");
$fetch_user = mysqli_fetch_array($select_user);
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
	
	$check_exist = mysqli_query($con," select * from users where user_email = '$user_email' ");
	$email_count = mysqli_num_rows($check_exist);
	$row_register = mysqli_fetch_array($check_exist);
	
	if($email_count>0){
		echo "<script>alert('Email $user_email exist!')</script>";
	}elseif($fetch_user['user_password'] != $hash_password){
		echo "<script>alert('Your Current Password is wrong.')</script>";
	}else{
		$update_email = mysqli_query($con,"update users set user_email = '$user_email' where user_id = '$_SESSION[user_id]'");
		if($update_email){
			echo "<script>alert('Email updated Successfully')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";
		}
	}
}
?>




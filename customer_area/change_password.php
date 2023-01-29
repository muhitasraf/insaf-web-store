<?php 
$select_user = $pdo->query("select * from users where user_id = '$_SESSION[user_id]'");
$fetch_user = $select_user->fetchAll();
?>
	<div class="registration_box">
		<form method="post" action=""  enctype="multipart/form-data">
			<table align="left" width="70%">
				<tr align="left">
					<td colspan="4">
						<h2>Edit Your Account</h2>
						<hr>
					</td>
				</tr>
				
				<tr>
					<td width="15%">Current Password:</td>				
					<td colspan="3"><input type="password" name="current_password" class="form-control" required placeholder="Current Password"/>
					</td>
				</tr>
				
				<tr>
					<td width="15%">New Password:</td>				
					<td colspan="3"><input type="password" id="confirm_password1" name="new_password" class="form-control" required placeholder="New Password"  /></td>
				</tr>
				
				<tr>
					<td width="35%">Confirm New Password:</td>				
					<td colspan="3"><input type="password" id="confirm_password2" name="confirm_new_password" class="form-control"  required placeholder="Confirm New Password"  /></td>
				</tr>
				
				<tr align="left">
					<td></td>		
					<td colspan="4">
						<input type="submit" class="btn-info form-control"  name="change_password" value="Update"  />
					</td>
				</tr>
				
			</table>
		</form>
	</div>
	

<?php
if(isset($_POST['change_password'])){
	
	$current_password = trim($_POST['current_password']);
	$hash_current_password = md5($current_password);
	$new_password = trim($_POST['new_password']);
	$hash_new_password = md5($new_password);
	$confirm_new_password = trim($_POST['confirm_new_password']);
	
	$select_password = $pdo->query("SELECT * from users where user_password = '$hash_current_password' and user_id = '$_SESSION[user_id]'")->fetchAll();
	if(count($select_password) == 0){
		echo "<script>alert('Current Password is empty.')</script>";
	}elseif($new_password != $confirm_new_password){
		echo "<script>alert('Password not match.')</script>";
	}else{
		$update_password = $pdo->query("UPDATE users set user_password = '$hash_current_password' WHERE user_id = '$_SESSION[user_id]'");
		if($update_password){
			echo "<script>alert('Password Updated.')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";
		}else{
			echo "<script>alert('Database Error: mysqli_error($con)')</script>";
		}
	}
}
?>




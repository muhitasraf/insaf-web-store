<?php 
$select_user = $pdo->query("SELECT * FROM users WHERE user_id = '$_SESSION[user_id]'");
$fetch_user = $select_user->fetch();
?>
	<div class="registration_box">
		<form method="post" action=""  enctype="multipart/form-data">
			<table align="left" width="70%">
				<tr align="left">
					<td colspan="4">
						<h2>Edit Profile</h2><br/>
					</td>
				</tr>
				<tr>
					<td width="15%">Change Name: </td>				
					<td colspan="3"><input type="Text" name="user_name" value="<?php echo $fetch_user['user_name']?>" required placeholder="Full Name"  /></td>
				</tr>
				<tr>
					<td width="25%">Country:</td>				
					<td colspan="3"><?php include('includes/country_list.php'); ?></td>
				</tr>
				<tr>
					<td width="15%">City:</td>				
					<td colspan="3"><input type="Text" name="user_city" value="<?php echo $fetch_user['user_city']?>" required placeholder="City"  /></td>
				</tr>
				<tr>
					<td width="15%">Contact:</td>				
					<td colspan="3"><input type="Text" name="user_contact" value="<?php echo $fetch_user['user_contact']?>" required placeholder="Contact"  /></td>
				</tr>
				<tr>
					<td width="15%">Address:</td>				
					<td colspan="3"><input type="Text" name="user_address" value="<?php echo $fetch_user['user_address']?>" required placeholder="Address"  /></td>
				</tr>
				<tr align="left">
					<td></td>		
					<td colspan="4">
					<input type="submit" name="edit_profile" value="Update"  />
					</td>
				</tr>
			</table>
		</form>
	</div>
	

<?php
if(isset($_POST['edit_profile'])){
	$ip_address = getIpAddress();
	$user_name = ($_POST['user_name']);
	
	$user_city = trim($_POST['user_city']);
	$user_address = trim($_POST['user_address']);
	$user_contact = trim($_POST['user_contact']);
	
	$update_profile = $pdo->query("UPDATE users SET user_name = '$user_name', user_city = '$user_city', user_address = '$user_address' user_contact ='$user_contact' WHERE user_id = '$_SESSION[user_id]'");
	
	if($update_profile){
		echo "<script>alert('Profile Updated Successfully.')</script>";
		echo "<script>window.open(window.location.href,'_self')</script>";
	}
}
?>




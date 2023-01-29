<?php 
$select_user = $pdo->query("SELECT * FROM users WHERE user_id = '$_SESSION[user_id]'");
$fetch_user = $select_user->fetch();
?>
	<div class="row">
		<form method="post" action=""  enctype="multipart/form-data">
			<div class="col-md-10">
				<div class="row my-2">
					<div class="col-md-4">
						<label for="basic-url" class="form-label">Change Name:</label>
					</div>
					<div class="col-md-8">
						<div class="input-group">
							<input type="text" class="form-control" name="user_name" value="<?php echo $fetch_user['user_name']?>" required placeholder="Full Name">
						</div>
					</div>					
				</div>
				<div class="row  my-2">
					<div class="col-md-4">
						<label for="basic-url" class="form-label">Country Name:</label>
					</div>
					<div class="col-md-8">
						<div class="input-group">
							<?php include('includes/country_list.php'); ?>
						</div>
					</div>					
				</div>
				<div class="row  my-2">
					<div class="col-md-4">
						<label for="basic-url" class="form-label">City Name:</label>
					</div>
					<div class="col-md-8">
						<div class="input-group">
							<input type="text" class="form-control" name="user_city" value="<?php echo $fetch_user['user_city']?>" required placeholder="City">
						</div>
					</div>					
				</div>
				<div class="row  my-2">
					<div class="col-md-4">
						<label for="basic-url" class="form-label">Contact Number:</label>
					</div>
					<div class="col-md-8">
						<div class="input-group">
							<input type="text" class="form-control" name="user_contact" value="<?php echo $fetch_user['user_contact']?>" required placeholder="Contact">
						</div>
					</div>					
				</div>
				<div class="row  my-2">
					<div class="col-md-4">
						<label for="basic-url" class="form-label">You Addressr</label>
					</div>
					<div class="col-md-8">
						<div class="input-group">
							<input type="text" class="form-control" name="user_address" value="<?php echo $fetch_user['user_address']?>" required placeholder="Address">
						</div>
					</div>					
				</div>
				<div class="row  my-2">
					<div class="col-md-4">
					</div>
					<div class="col-md-8">
						<div class="input-group">
							<input type="submit" class="btn btn-info form-control" name="edit_profile" value="Update">
						</div>
					</div>					
				</div>
			</div>
			<div class="col-md-2">
			</div>
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




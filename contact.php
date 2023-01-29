<?php include("includes/header.php");?>

	<form action="" method="post" enctype="multipart/form-data">
		<div class="row my-2">
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
				<div class="card">
					<div class="row my-2">
						<div class="col-md-6">
							<img src="images/email.webp" alt="">
						</div>
						<div class="col-md-6 px-4">
							<div class="row">
								<label for="full_name" class="col-form-label">Full Name</label>
								<div class="input-group">
									<input class="form-control" type="text" name="full_name" placeholder="Enter Full Name" required/>
								</div>
							</div>
							<div class="row">
								<label for="email" class="col-form-label">Your Email</label>
								<div class="input-group">
									<input class="form-control" type="email" name="email" placeholder="Enter Your Email" required/>
								</div>
							</div>
							<div class="row">
								<label for="problem_details" class="col-form-label">Your Problem</label>
								<div class="input-group">
									<textarea class="form-control" name="problem_details" rows="3"></textarea>
								</div>
							</div>
							<div class="row">
								<label for="email" class="col-form-label">Email</label>
								<div class="input-group">
									<input class="form-control" type="file" name="product_image"/>
								</div>
							</div>
							<div class="row">
								<div class="d-grid gap-2 my-2">
									<input type="submit" value="Send Message" class="btn btn-primary rounded">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
			</div>
		</div>
	</form>
<?php include("includes/footer.php");?>	
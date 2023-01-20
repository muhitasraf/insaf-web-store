<?php
include("includes/header.php");
?>
	<div class="row">
		<div class="col-md-2 p-0 m-0">
			<div class="d-grid gap-2">
				<div class="btn-group-vertical" aria-label="Vertical button group">
					<button style="background-color: #71a1e7; border-color: #71a1e7; color:white;" class="btn btn-success mt-1">Catagories</button>
					<?php getCategories($pdo); ?>
				</div>
			</div>
			<div class="d-grid pt-1 px-1">
				Short By
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
					<label class="form-check-label" for="flexCheckDefault">High To Low</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
					<label class="form-check-label" for="flexCheckChecked">Low To High</label>
				</div>
			</div>
		</div>

		<div class="col-md-10">
			<div class="row gy-2 my-1">
				<div class="container mt-1 mb-1">	
					<?php 
					$get_product_by_product_id = getProductDetails($pdo);
					foreach($get_product_by_product_id as $product_details){ 
						$pro_id = $product_details['product_id'];
						$pro_title = $product_details['product_title'];
						$title_slug = $product_details['title_slug'];
						$pro_categories = $product_details['product_categories'];
						$pro_price = $product_details['product_price'];
						$pro_description = $product_details['product_description'];
						$pro_image = $product_details['product_image'];
					?>
					<div class="card">	
						<div class="row g-0">	
							<div class="col-md-6 border-end">	
								<div class="d-flex flex-column justify-content-center">	
									<div class="main_image">	
										<img src="admin_area/product_images/<?php echo $pro_image;?>" id="main_product_image" width="350">	
									</div>	
									<div class="thumbnail_images">	
										<ul id="thumbnail">	
											<li><img onclick="changeImage(this)" src="https://i.imgur.com/TAzli1U.jpg" width="70"></li>	
											<li><img onclick="changeImage(this)" src="https://i.imgur.com/w6kEctd.jpg" width="70"></li>	
											<li><img onclick="changeImage(this)" src="https://i.imgur.com/L7hFD8X.jpg" width="70"></li>	
											<li><img onclick="changeImage(this)" src="https://i.imgur.com/6ZufmNS.jpg" width="70"></li>	
										</ul>	
									</div>	
								</div>	
							</div>	
							<div class="col-md-6">	
								<div class="p-3 right-side">	
									<div class="d-flex justify-content-between align-items-center">	
										<h3><?php echo $pro_title; ?></h3>	
									</div>	
									<div class="mt-2 pr-3 content">	
										<p><p><?php echo limit_details($pro_description); ?></p></p>	
									</div>	
									<h3>$<?php echo $pro_price; ?></h3>	
									<div class="ratings d-flex flex-row align-items-center">	
										<div class="d-flex flex-row">	
											<i class='bx bxs-star' ></i>	
											<i class='bx bxs-star' ></i>	
											<i class='bx bxs-star' ></i>	
											<i class='bx bxs-star' ></i>	
											<i class='bx bx-star' ></i>	
										</div>	
										<span>441 reviews</span>	
									</div>	
									<div class="mt-2">	
										<span class="fw-bold">Color</span>	
										<div class="colors">	
											<ul id="marker">	
												<li id="marker-1"></li>	
												<li id="marker-2"></li>	
												<li id="marker-3"></li>	
												<li id="marker-4"></li>
												<li id="marker-5"></li>	
											</ul>	
										</div>	
									</div>	
									<div class="product-qty">
										<i class="bi bi-plus-circle-fill"></i>
										<input class="btn btn-default btn-lg btn-qty" value="1" />
										<i class="bi bi-dash-circle-fill"></i>
									</div>
									<div class="row">
										<div class="col-md-12 top-10">
											<p>To order via Phone, <a href="tel:01981357914">Please call 01981357914</a></p>
										</div>
									</div>
									<div class="buttons d-flex flex-row mt-1 gap-3">	
										<button class="btn btn-outline-dark">Buy Now</button>	
										<button class="btn btn-dark">Add to Basket</button>	
									</div>
								</div>	
							</div>
						</div>
					</div>
					<div id="details" class="card">
						<div class="p-3 right-side">	
							<div class="d-flex justify-content-between align-items-center">	
								<h3><?php echo $pro_title; ?></h3>	
							</div>	
							<div class="mt-2 pr-3 content">	
								<p><?php echo $pro_description; ?></p>	
							</div>	
						</div>	
					</div>
					<?php } ?>
					<div id="details" class="card">
						<div class="p-3 right-side">	
						<?php if(!isset($_SESSION['user_id'])){?>
							<h2><a href="#">Login</a> To Comment</h2>
						<?php }else{ ?>
							<div class="form_box">	
								<form action="" method="post" enctype="multipart/form-data">
									<table align="center" width="100%">
										<tr>
											<td colspan="7">
												<h2>Add Comment:</h2> 
												<div class="border_bottom"></div>
											</td>
										</tr>
										<tr>
											<td></td>
											<td><textarea id="w3review" name="comment_text" rows="4" cols="50" placeholder="Write Comment"></textarea></td>
										</tr>
										<tr>
											<td></td>
											<td colspan="7"><input type="submit" name="insert_comment" value="comment যুক্ত করুন"/> </td>
										</tr>
									</table>
								</form>
							</div>
						<?php }?>
						<div id="comment_box">
							<?php getComments($pdo); ?>
						</div>	
						</div>	
					</div>
				</div>
			</div>	
		</div>
	</div>
<?php insertcomment($pdo); ?>

<?php include("includes/footer.php");?>	


<script>
	function changeImage(element) {
		var main_prodcut_image = document.getElementById('main_product_image');
		main_prodcut_image.src = element.src;
	}
</script>
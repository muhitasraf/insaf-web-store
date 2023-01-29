<?php
include("includes/header.php");
?>
	<div class="row">
		<div class="col-md-2 p-0 m-0">
			<div class="card shadow-sm d-grid gap-2 my-1">
				<div class="btn-group-vertical" aria-label="Vertical button group">
					<button style="background-color: #71a1e7; border-color: #71a1e7; color:white;" class="btn btn-success">Catagories</button>
					<?php getCategories($pdo); ?>
				</div>
			</div>
			
			<div class="card shadow-sm bg-light d-grid mt-1 pt-1 px-1 my-1">
				Short By
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
					<label class="form-check-label" for="flexCheckDefault">High To Low</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
					<label class="form-check-label" for="flexCheckChecked">Low To High</label>
				</div>
				Price Between 
				<div class="row">
					<div class="col-md-6"><input type="text" class="form-control" placeholder="min"></div>
					<div class="col-md-6">
						<input type="text" class="form-control" placeholder="max">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<button type="button" class="btn btn-info my-2 form-control">show</button>
					</div>
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
									<h3>৳<?php echo $pro_price; ?></h3>	
									<div class="ratings d-flex flex-row align-items-center">	
										<div class="d-flex flex-row">	
											<i class='bx bxs-star' ></i>	
											<i class='bx bxs-star' ></i>	
											<i class='bx bxs-star' ></i>	
											<i class='bx bxs-star' ></i>	
											<i class='bx bx-star' ></i>	
										</div>	
										<span><?php getProductReview($pdo); ?> reviews</span>	
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
										<a href="" class="btn btn-outline-info">Buy Now</a>	
										<a href="<?php echo $title_slug;?>?add_cart=<?php echo $pro_id;?>" class="btn btn-info">Add to Cart</a>
										<?php cart($pdo); ?>
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
							<div class="form_box">	
								<form action="" method="post" enctype="multipart/form-data">
									<div class="row mb-3">
										<div class="col-md-6">
											<h5>Review This Product</h5><hr>
											<p class="">
												<i class="bi bi-star star_p" style="color: #3fa2e8; font-size:30px;"></i>
												<i class="bi bi-star star_p" style="color: #3fa2e8; font-size:30px;"></i>
												<i class="bi bi-star star_p" style="color: #3fa2e8; font-size:30px;"></i>
												<i class="bi bi-star star_p" style="color: #3fa2e8; font-size:30px;"></i>
												<i class="bi bi-star star_p" style="color: #3fa2e8; font-size:30px;"></i>
												<i class="star_cn ps-4" style="color: #3fa2e8; font-size:30px;">5/0</i>
											</p>
											<textarea name="comment_text" rows="4" cols="50" class="form-control my-2" id="w3review"  placeholder="Write Comment"></textarea>
											<input type="hidden" name="star_count" class="form-control star_count" id="star_count" value="0"/>
											<?php if(!isset($_SESSION['user_id'])){?>
												<a style="text-decoration: none;text-align:center;" class="form-control" href="index.php?action=login">Login to review</a>
											<?php }else{ ?>
												<input type="submit" name="insert_comment" class="form-control"  value="Add Comment"/>
											<?php }?>
											
										</div>
										<div class="col-md-6">
											<h5>Average user rating</h5>
											<hr>
											<h4 class="bold padding-bottom-7">4.3 <small>/ 5</small></h4>
											<p class="">
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
											</p>
											<p class="">
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star" style="color: #3fa2e8;"></i>
											</p>
											<p class="">
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star" style="color: #3fa2e8;"></i>
												<i class="bi bi-star" style="color: #3fa2e8;"></i>
											</p>
											<p class="">
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star" style="color: #3fa2e8;"></i>
												<i class="bi bi-star" style="color: #3fa2e8;"></i>
												<i class="bi bi-star" style="color: #3fa2e8;"></i>
											</p>
											<p class="">
												<i class="bi bi-star-fill" style="color: #3fa2e8;"></i>
												<i class="bi bi-star" style="color: #3fa2e8;"></i>
												<i class="bi bi-star" style="color: #3fa2e8;"></i>
												<i class="bi bi-star" style="color: #3fa2e8;"></i>
												<i class="bi bi-star" style="color: #3fa2e8;"></i>
											</p>
										</div>
									</div>
									<?php getComments($pdo); ?>
								</form>
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
	var starCount = 0;
	$('.star_p').click(function(){
		console.log($(this).attr('class'))
		if($(this).attr('class')=='bi bi-star star_p'){
			$(this).removeClass('bi-star star_p');
			$(this).addClass('bi-star-fill star_p');
			starCount++;
		}else{
			$(this).removeClass('bi-star-fill star_p');
			$(this).addClass('bi-star star_p');
			starCount--;
		}
		$('.star_count').val(starCount);
		$('.star_cn').text('5/'+starCount);
	})
</script>
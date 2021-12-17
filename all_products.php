<?php include("includes/header.php");?>
	
	<div class="content_wrapper">
		<div id="sidebar">
			<div id="sidebar_title">Catagories</div>
				<ul id="cart">	
					<?php
						getCategories();
					?>
				</ul>
		</div>
		
		<div id="content_area">
			<div id="products_box">
				<?php
					$get_product = " select * from products";
					$run_product = mysqli_query($con,$get_product);
					while($row_product = mysqli_fetch_array($run_product)){
						$pro_id = $row_product['product_id'];
						$title_slug = $row_product['title_slug'];
						$pro_title = $row_product['product_title'];
						$pro_categories = $row_product['product_categories'];
						$pro_price = $row_product['product_price'];
						$pro_description = $row_product['product_description'];
						$pro_image = $row_product['product_image'];
						
						echo "
							<div id='single_product'>
								<h2>$pro_title</h2>
								<img class='img' src='admin_area/product_images/$pro_image' width='180' heigth='180'  />
								<p style='padding:10px;'><b>Price: $pro_price</b></p>
								<a href='$title_slug'><button class='detailsbtn'>Details</button></a>
								<a href='index.php?add_cart=$pro_id'><button class='cardbtn'>Add to Cart</button></a>
							</div>
						";
					}
				?>
				
				<?php
					getProductByCategories();
				?>	
			</div>
		</div>
	</div>

<?php include("includes/footer.php");?>		
<?php include("includes/header.php");?>
	
	<div class="content_wrapper">
		<div id="sidebar">
			<div id="sidebar_title">Catagories</div>
				<ul id="cart">	
					<?php
						getCategories($pdo);
					?>
				</ul>
		</div>
		
		<div id="content_area">
			<div id="products_box">
				<?php
					getAllProduct($pdo);
				?>
				
				<?php
					getProductByCategories($pdo);
				?>	
			</div>
		</div>
	</div>

<?php include("includes/footer.php");?>		
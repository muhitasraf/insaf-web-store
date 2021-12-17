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
					searchResult();
				?>
				
				<?php
					getProductByCategories();
				?>	
			</div>
		</div>
	</div>

<?php include("includes/footer.php");?>		
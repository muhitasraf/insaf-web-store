<?php 
	include("includes/header.php");
?>
<div class="content_wrapper">
	<?php if(!isset($_GET['action'])){?>
		<div id="sidebar">
			<div id="sidebar_title">Catagories</div>
				<ul id="cart">	
					<?php
						getCategories();
					?>
				</ul>
		</div>
		
		<div id="content_area">
			<?php cart(); ?>
			<div id="products_box">
				
				<?php getProduct(); ?>
				
				<?php getProductByCategories(); ?>
				
			</div>
		</div>
	<?php }else{ ?>

	<?php 
	include('login.php');
	}
	?>
</div>

<?php include("includes/footer.php");?>		
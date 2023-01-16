<?php
include("includes/header.php");
?>
	
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
				<?php getProductDetails($pdo) ?>	
			</div>
			
			<div class="comment_area">
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
<?php insertcomment($pdo); ?>

<?php include("includes/footer.php");?>		
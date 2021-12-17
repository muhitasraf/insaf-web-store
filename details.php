<?php
include("includes/header.php");
?>
	
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
					if(isset($_GET['title_slug'])){
						$pro_id = $_GET['title_slug'];
						$title_slug = $_GET['title_slug'];
						$run_query_by_product_id = mysqli_query($con," select * from products where title_slug = '$title_slug' ");
						
						while($row_product = mysqli_fetch_array($run_query_by_product_id)){
							$pro_id = $row_product['product_id'];
							$pro_title = $row_product['product_title'];
							$title_slug = $row_product['title_slug'];
							$pro_categories = $row_product['product_categories'];
							$pro_price = $row_product['product_price'];
							$pro_description = $row_product['product_description'];
							$pro_image = $row_product['product_image'];
							
							echo "
								<div id='single_product'>
									<h2>$pro_title</h2>
									<img src='admin_area/product_images/$pro_image' width='180' heigth='180'  />
									<p><b>$pro_price</b></p>
									
									<a href='index.php?add_cart=$pro_id'><button style='float:center'>Add TO Cart</button></a>
								</div>
								<div class='description_box'>
									$pro_description
								</div>
							";
						}
					}
				?>	
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
				<?php 
					
					$run_query_by_product_id = mysqli_query($con," select * from products where title_slug = '$_GET[title_slug]' ");
						
					$row_product = mysqli_fetch_array($run_query_by_product_id);
					$product_id = $row_product['product_id'];
					
					$run_comments = mysqli_query($con," select * from comments where product_id = '$product_id' ");
					$count_comments = mysqli_num_rows($run_comments);
					if($count_comments==0){
						echo "<h2>comments not found</h2>";
					}
					while($row_comments = mysqli_fetch_array($run_comments)){
						$comment_id = $row_comments['comment_id'];
						$user_name = $row_comments['user_name'];
						$comment_text = $row_comments['comment_text'];
						echo "
							<div id='comment_box'>
								<h2>Name: $user_name</h2>
								<p>Comment: $comment_text</p>
							</div>
						";
					}
				
				?>
			</div>
			</div>
			
		</div>
	</div>
<?php
if(isset($_POST['insert_comment'])){
	
	$comment_text = $_POST['comment_text'];
	
	$run_query_by_product_id = mysqli_query($con," select * from products where title_slug = '$_GET[title_slug]' ");
	$row_product = mysqli_fetch_array($run_query_by_product_id);
	$product_id = $row_product['product_id'];	
	$ip_address = getIpAddress();
	$user_id = $_SESSION['user_id'];
	$run_user = mysqli_query($con," select * from users where user_id = '$_SESSION[user_id]' ");
	while($row_user = mysqli_fetch_array($run_user)){
	$user_name = $row_user['user_name'];
	echo "$user_name";
	}
	$insert_comment = "insert into comments ( user_id, product_id, user_name, comment_text, ip_address) values ('$user_id', '$product_id','$user_name','$comment_text','$ip_address')";
	$insert_pro = mysqli_query($con, $insert_comment);
	
	if($insert_pro){
		echo "<script>alert('Comment has been uploaded successfully')</script>";
		echo "<script>window.open(window.location.href,'_self')</script>";
	}
}
?>

<?php include("includes/footer.php");?>		
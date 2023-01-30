
<?php 
$edit_product  = $pdo->query("SELECT * from products where product_id = '$_GET[product_id]' ");
$fetch_edit = $edit_product->fetch();
?>
<div class="d-flex justify-content-center">	
	<form action="" method="post" enctype="multipart/form-data">
		<table width="80%">
			<input type="hidden" name="das_header" class="das_header" id="das_header" value="Edit product">
			<tr>
				<td>Product Title</td>
				<td><input type="text" name="product_title" class="form-control my-2" value="<?php echo $fetch_edit['product_title']; ?>" size="60" required/></td>
			</tr>
			
			
			<tr>
				<td>Title Slug</td>
				<td><input type="text" name="title_slug" class="form-control my-2" value="<?php echo $fetch_edit['title_slug']; ?>" size="60" required/></td>
			</tr>
			
			<tr>
				<td>Category:</td>
				<td>
				<select name="product_categories" class="form-control my-2" id=""><option value="">Select Category</option>
					<?php
						$get_categories = "SELECT * from categories";
						$run_categories = $pdo->query($get_categories)->fetchAll();
						foreach($run_categories as $row_categories){
							$categories_id = $row_categories['categories_id'];
							$categories_title = $row_categories['categories_title'];
							if($fetch_edit['product_categories'] == $categories_id){
								echo "<option value='$fetch_edit[product_categories]' selected>$categories_title</option>";
							}else{
								echo "<option value='$categories_id'>$categories_title</option>";
							}
						}
					?>
				</select>
				</td>
			</tr>
			
			<tr>
				<td valign="top">Product Image:</td>
				<td>
					<input type="file" class="form-control my-2" name="product_image"/>
					<div class="edit_image my-2">
						<img src="product_images/<?php echo $fetch_edit['product_image'];?>" width="160" height="150" />
						<img src="product_images/<?php echo $fetch_edit['product_image'];?>" width="160" height="150" />
						<img src="product_images/<?php echo $fetch_edit['product_image'];?>" width="160" height="150" />
						<img src="product_images/<?php echo $fetch_edit['product_image'];?>" width="160" height="150" />
					</div>
				</td>
			</tr>
			
			<tr>
				<td>Product Price:</td>
				<td><input type="text" name="product_price" class="form-control my-2" value="<?php echo $fetch_edit['product_price'];?>" required/></td>
			</tr>
			
			<tr>
				<td  valign="top">Product Detils:</td>
				<td><textarea name="product_description" class="form-control my-2" rows="5" id="summernote"><?php echo $fetch_edit['product_description'];?></textarea></td>
			</tr>
			
			<tr>
				<td>Product Tag:</td>
				<td><input type="text" name="product_keywords" class="form-control my-2" value="<?php echo $fetch_edit['product_keywords'];?>" required/></td>
			</tr>
			
			<tr>
			<td></td>
				<td colspan="7">
					<input type="submit" class="btn btn-info form-control mb-5" name="edit_post" value="Update"/> 
				</td>
			</tr>
			
		</table>
	</form>
</div>

<?php
	if(isset($_POST['edit_post'])){
		$product_title = trim($_POST['product_title']);
		$title_slug = $_POST['title_slug'];
		$product_categories = $_POST['product_categories'];
		$product_price = $_POST['product_price'];
		$product_description = trim($_POST['product_description']);
		$product_keywords = $_POST['product_keywords'];
		
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];
		$date = date("F d,Y");
		
		if(!empty($_FILES['product_image']['name'])){
			if(move_uploaded_file($product_image_tmp,"product_images/$product_image")){
				unlink('product_images/'.$fetch_edit['product_image']);
				$update_product = $pdo->query("update products set product_categories ='$product_categories' , product_title ='$product_title', title_slug = '$title_slug', product_price = '$product_price', product_description = '$product_description', product_image = '$product_image', product_keywords = '$product_keywords', date = '$date' where product_id = '$_GET[product_id]' ");
			}
		}else{
			$update_product = $pdo->query("update products set product_categories ='$product_categories' , product_title ='$product_title', title_slug ='$title_slug', product_price = '$product_price', product_description = '$product_description', product_keywords = '$product_keywords', date = '$date' where product_id = '$_GET[product_id]' ");
		}
		if($update_product){
			echo "<script>alert('Product has been updated successfully')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";
		}
	}
	

?>

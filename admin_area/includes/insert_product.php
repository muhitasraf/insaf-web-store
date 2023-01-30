
<div class="form_box">	
	<form action="" method="post" enctype="multipart/form-data">
		<table width="85%">
			<input type="hidden" name="das_header" class="das_header" id="das_header" value="Add product">
			<tr>
				<td>Product Title</td>
				<td>
					<input class="form-control my-3" type="text" name="product_title" size="60" required>
				</td>
			</tr>
			<tr>
				<td>Category:</td>
				<td>
				<select name="product_categories  my-3"  class="form-control" id="">
					<option value="">Select Category</option>
					<?php
						$get_categories = "SELECT * from categories";
						$run_categories = $pdo->query($get_categories)->fetchAll();
						foreach($run_categories as $row_categories){
						$categories_id = $row_categories['categories_id'];
						$categories_title = $row_categories['categories_title'];
						echo "<option value='$categories_id'>$categories_title</option>";
						}
					?>
				</select>
				</td>
			</tr>
			<tr>
				<td>Product Image:</td>
				<td>
					<input type="file" name="product_image"  class="form-control  my-3" required>
				</td>
			</tr>
			
			<tr>
				<td>Product Price:</td>
				<td>
					<input type="text" name="product_price"  class="form-control  my-3" required>
				</td>
			</tr>
			
			<tr>
				<td  valign="top">Product Detils:</td>
				<td>
					<textarea name="product_description"  class="form-control  my-3" id="summernote" rows="5"></textarea>
				</td>
			</tr>
			<tr>
				<td>Product Tag:</td>
				<td>
					<input type="text" name="product_keywords"  class="form-control  my-3" required/>
				</td>
			</tr>
			<tr>
			<td></td>
				<td colspan="7">
					<input type="submit" name="insert_post"  class="btn-info form-control  mb-5" value="পণ্যটি যুক্ত করুন">
				</td>
			</tr>
		</table>
	</form>
</div>

<?php
	if(isset($_POST['insert_post'])){
		$product_title = $_POST['product_title'];
		$title_slug = slug($product_title);
		$product_categories = $_POST['product_categories'];
		$product_price = $_POST['product_price'];
		$product_description = trim($_POST['product_description']);
		$product_keywords = $_POST['product_keywords'];
		
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];
		move_uploaded_file($product_image_tmp,"product_images/$product_image");
		
		$insert_product = "INSERT INTO products ( product_categories, product_title, title_slug, product_price, 
			product_description, product_image, product_keywords) values ('$product_categories','$product_title',
			'$title_slug','$product_price','$product_description','$product_image','$product_keywords')";
		
		$insert_pro = $pdo->query($insert_product);
		
		if($insert_pro){
			echo "<script>alert('Product has been uploaded successfully')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";
		}
	}
	
	function slug($text){
		return mb_strtolower(preg_replace('/[ ,.@#$%^&*()_\/=]+/', '-', trim($text)), 'UTF-8');
		if(empty($text)){
			return 'no-title';
		}
	}
?>


<div class="form_box">	
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="das_header" class="das_header" id="das_header" value="Add Category">
		<table width="80%">
			<input type="hidden" name="das_header" class="das_header" id="das_header" value="Add Category">
			<tr>
				<td>Add new Category</td>
				<td>
					<input type="text" class="form-control my-2" name="product_categories" size="60" required/>
				</td>
			</tr>
			
			<tr>
				<td></td>
				<td colspan="7">
					<input type="submit" name="insert_cat" class="btn-info form-control" value="Add Category"> 
				</td>
			</tr>
			
		</table>
	</form>
</div>

<?php
	if(isset($_POST['insert_cat'])){

		$product_categories = $_POST['product_categories'];
		
		$insert_cat = $pdo->query("INSERT into categories ( categories_title) values('$product_categories')");
		
		if($insert_cat){
			echo "<script>alert('Category has been uploaded successfully')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";
		}
	}
?>

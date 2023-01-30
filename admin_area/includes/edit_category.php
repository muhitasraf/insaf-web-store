<?php 
$edit_cat = $pdo->query("SELECT * from categories where categories_id = '$_GET[categories_id]'");
$fetch_cat = $edit_cat->fetch();
?>
<div class="form_box">	
	
	<input type="hidden" name="das_header" class="das_header" id="das_header" value="Edit Category">
	<form action="" method="post" enctype="multipart/form-data">
		<table width="80%">
			<tr>
				<td>Add new Category</td>
				<td><input type="text" name="product_categories" class="form-control my-2" value="<?php echo $fetch_cat['categories_title']; ?>" size="60" required/></td>
			</tr>
			
			<tr>
				<td></td>
				<td colspan="7"><input type="submit" name="edit_cat" class="btn btn-info form-control" value="Update Category"/> </td>
			</tr>
			
		</table>
	</form>
</div>

<?php
	if(isset($_POST['edit_cat'])){

		$categories_title = $_POST['product_categories'];
		
		$edit_cat = $pdo->query("UPDATE categories set categories_title = '$categories_title' where categories_id = '$_GET[categories_id]' ");
		
		if($edit_cat){
			echo "<script>alert('Category has been updated successfully')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";
		}
	}
?>

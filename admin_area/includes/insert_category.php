
<div class="form_box">	
	<form action="" method="post" enctype="multipart/form-data">
		<table align="center" width="100%">
			<tr>
				<td colspan="7">
				<h2>Add Category</h2> 
				<div class="border_bottom"></div>
				</td>
				
			</tr>
			<tr>
				<td>Add new Category</td>
				<td><input type="text" name="product_categories" size="60" required/></td>
			</tr>
			
			<tr>
			<td></td>
				<td colspan="7"><input type="submit" name="insert_cat" value="Add Category"/> </td>
			</tr>
			
		</table>
	</form>
</div>

<?php
	if(isset($_POST['insert_cat'])){

		$product_categories = mysqli_real_escape_string($con,$_POST['product_categories']);
		
		$insert_cat = mysqli_query($con,"insert into categories ( categories_title) values('$product_categories')");
		
		if($insert_cat){
			echo "<script>alert('Category has been uploaded successfully')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";
		}
	}
?>

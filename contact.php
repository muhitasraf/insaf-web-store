<?php include("includes/header.php");?>

	<form action="" method="post" enctype="multipart/form-data">
		<table align="center" width="100%">
			<tr>
				<td colspan="7">
				<h2>Contact Us</h2> 
				<div class="border_bottom"></div>
				</td>
				
			</tr>
			<tr>
				<td>Your Name</td>
				<td><input type="text" name="product_title" size="60" required/></td>
			</tr>
			
			<tr>
				<td>Your Email:</td>
				<td><input type="text" name="product_keywords" required/></td>
			</tr>
			
			<tr>
				<td  valign="top">Descrive Problem:</td>
				<td><textarea name="product_description" rows="10"></textarea></td>
			</tr>
			
			<tr>
				<td>Product Image:</td>
				<td><input type="file" name="product_image"/></td>
			</tr>
			
			<tr>
			<td></td>
				<td colspan="7"><input type="submit" name="insert_post" value="পণ্যটি যুক্ত করুন"/> </td>
			</tr>
			
		</table>
	</form>
<?php include("includes/footer.php");?>	

<div class="view_product_box">
	<input type="hidden" name="das_header" class="das_header" id="das_header" value="View product">
	<form action="" method="post" enctype="multipart/form-data">
	<div class="search_box">
		<input type="text" id="search" placeholder="Search here"/>
	</div>
		<table class="table table-bordered" width="100%">
			<thead>
				<tr>
					<th><input type="checkbox" id="checkAll" />Check</th>
					<th>ID</th>
					<th>Title</th>
					<th>Price</th>
					<th>Image</th>
					<th>Views</th>
					<th>Date</th>
					<th>Status</th>
					<th>Delete</th>
					<th>Edit</th>
				</tr>
			</thead>
			<?php 
				$all_products = $pdo->query("SELECT * FROM products order by product_id DESC")->fetchAll();
				$i=1;
				foreach($all_products as $row){
			?>
			<tbody>
				<tr>
					<td><input type="checkbox" id="deleteAll[]" value="<?php echo $row['product_id']; ?>"/></td>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['product_title']; ?></td>
					<td><?php echo $row['product_price']; ?></td>
					<td><img src="product_images/<?php echo $row['product_image']; ?>" width="70" height="50" alt="" /></td>
					<td><?php echo $row['views']; ?></td>
					<td><?php echo $row['date']; ?></td>
					<td>
						<?php 
						if($row['visible']==1){
							echo "Approved";
						}else{
							echo "Pending";
						}
						?>
					</td>
					<td><a href="index.php?action=view_pro&delete_product=<?php echo $row['product_id']; ?>">Delete</a></td>
					<td><a href="index.php?action=edit_pro&product_id=<?php echo $row['product_id']; ?>">Edit</a></td>
				</tr>
			</tbody>
				<?php $i++;} ?>
				<tr>
					<td><input type="submit" name="delete_all" value="Remove" /></td>
				</tr>
		</table>
	</form>
</div>

<?php 
if(isset($_GET['delete_product'])){
	$delete_product = $pdo->query("DELETE FROM products where product_id = '$_GET[delete_product]' ");
	if($delete_product){
		echo "<script>alert('Product delete successfully.')</script>";
		echo "<script>window.open('index.php?action=view_pro','_self')</script>";
	}else{
		echo "<script>alert('Problem.')</script>";
	}
}

if(isset($_POST['deleteAll'])){
	$remove = $_POST['deleteAll'];
	foreach($remove as $key){
		$run_remove = $pdo->query("DELETE FROM products where product_id = '$key' ");
		if($run_remove){
			echo "<script>alert('Selected item delete successfully.')</script>";
			echo "<script>window.open('index.php?action=view_pro','_self')</script>";
		}else{
			echo "<script>alert('Selected item delete successfully.')</script>";
			echo "<script>window.open('index.php?action=view_pro','_self')</script>";
		}

	}
}
?>


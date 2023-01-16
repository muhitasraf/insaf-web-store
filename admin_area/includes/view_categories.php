
<div class="view_product_box">
	<h2>View Categories</h2>
	<div class="border_bottom"></div>
	<form action="" method="post" enctype="multipart/form-data">
	<div class="search_box">
		<input type="text" id="search" placeholder="Search here"/>
	</div>
		<table width="100%">
			<thead>
				<tr>
					<th><input type="checkbox" id="checkAll" />Check</th>
					<th>ID</th>
					<th>Category Name</th>
					<th>Status</th>
					<th>Delete</th>
					<th>Edit</th>
				</tr>
			</thead>
			<?php 
				$all_categories = $pdo->query("SELECT * from categories order by categories_id DESC")->fetchAll();
				$i=1;
				foreach($all_categories as $row){
			?>
			<tbody>
				<tr>
					<td><input type="checkbox" id="deleteAll[]" value="<?php echo $row['categories_id']; ?>"/></td>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['categories_title']; ?></td>
					<td>
						<?php 
						if($row['visible']==1){
							echo "Approved";
						}else{
							echo "Pending";
						}
						?>
					</td>
					<td><a href="index.php?action=view_cat&delete_category=<?php echo $row['categories_id']; ?>">Delete</a></td>
					<td><a href="index.php?action=edit_cat&categories_id=<?php echo $row['categories_id']; ?>">Edit</a></td>
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
if(isset($_GET['delete_category'])){
	$delete_category = $pdo->query("delete from categories where categories_id = '$_GET[delete_category]' ");
	if($delete_category){
		echo "<script>alert('Category delete successfully.')</script>";
		echo "<script>window.open('index.php?action=view_cat','_self')</script>";
	}else{
		echo "<script>alert('Problem.')</script>";
	}
}

if(isset($_POST['deleteAll'])){
	$remove = $_POST['deleteAll'];
	foreach($remove as $key){
		$run_remove = $pdo->query("delete from categories where categories_id = '$key' ");
		if($run_remove){
			
		}else{
			echo "<script>alert('Selected item delete successfully.')</script>";
			echo "<script>window.open('index.php?action=view_cat','_self')</script>";
		}

	}
}
?>


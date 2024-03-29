<?php include("includes/header.php");?>

<?php
	// Number of entries to show in a page. 
	$per_page_record = 12; 
	// Look for a GET variable page if not found default is 1.
	$page = isset($_GET["page"]) ? $_GET["page"] : 1;
	$start_from = ($page - 1) * $per_page_record;
?>
	
<div class="row">
	<div class="col-md-2 p-0 m-0">
		<div class="card shadow-sm d-grid gap-2 my-1">
			<div class="btn-group-vertical" aria-label="Vertical button group">
				<button style="background-color: #71a1e7; border-color: #71a1e7; color:white;" class="btn btn-success">Catagories</button>
				<?php getCategories($pdo); ?>
			</div>
		</div>
		
		<div class="card shadow-sm bg-light d-grid mt-1 pt-1 px-1 my-1">
			Short By
			<div class="form-check">
				<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
				<label class="form-check-label" for="flexCheckDefault">High To Low</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
				<label class="form-check-label" for="flexCheckChecked">Low To High</label>
			</div>
			Price Between 
			<div class="row">
				<div class="col-md-6"><input type="text" class="form-control" placeholder="min"></div>
				<div class="col-md-6">
					<input type="text" class="form-control" placeholder="max">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<button type="button" class="btn btn-info my-2 form-control">show</button>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-10">
		<div class="row gy-2 my-1">
			<?php cart($pdo); ?>
			<?php getAllProduct($pdo,$start_from, $per_page_record); ?>
			<?php getProductByCategories($pdo); ?>
		</div>	
		<div class="row gy-2 my-2 mb-5 ps-3 ">
			<div class="d-flex justify-content-center btn-group" role="group">
				<?php
					$query = "SELECT COUNT(*) products_count FROM products";
					$total_records = $pdo->query($query)->fetch()['products_count'];
					echo "<br>";
					// Number of pages required.   
					$total_pages = ceil($total_records / $per_page_record);
					$pagLink = "";

					if ($page >= 2) {
						echo "<a href='all_products.php?page=".($page - 1)."' class='mx-1'><button type='button' class='btn btn-outline-primary'>Prev</button></a>";
					}

					for ($i = 1; $i <= $total_pages; $i++) {
						if($i == $page){
							$pagLink .= "<a href='all_products.php?page=".$i."' class='mx-1'><button type='button' class='active btn btn-outline-primary'>".$i."</button></a>";
						}else{
							$pagLink .= "<a href='all_products.php?page=".$i."' class='mx-1'><button type='button' class='btn btn-outline-primary'>".$i."</button></a>";
						}
					};
					echo $pagLink;
					if ($page < $total_pages) {
						echo "<a href='all_products.php?page=" . ($page + 1) . "' class='mx-1'> <button type='button' class='btn btn-outline-primary'>Next</button> </a>";
					}
				?>
			</div>
		</div>
	</div>
</div>

<?php include("includes/footer.php");?>		
<?php include("includes/header.php");?>
	
<div class="row">
	<div class="col-md-2 p-0 m-0">
		<div class="d-grid gap-2">
			<div class="btn-group-vertical" aria-label="Vertical button group">
				<button style="background-color: #71a1e7; border-color: #71a1e7; color:white;" class="btn btn-success mt-1">Catagories</button>
				<?php getCategories($pdo); ?>
			</div>
		</div>
		<div class="d-grid pt-1">
			<div class="form-check">
				<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
				<label class="form-check-label" for="flexCheckDefault">High To Low</label>
			</div>
			<div class="form-check">
				<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
				<label class="form-check-label" for="flexCheckChecked">Low To High</label>
			</div>
		</div>
	</div>

	<div class="col-md-10">
		<div class="row gy-2 my-1">
			<?php cart($pdo); ?>
			<?php getProduct($pdo); ?>
			<?php getProductByCategories($pdo); ?>
		</div>	
	</div>
</div>

<?php include("includes/footer.php");?>		
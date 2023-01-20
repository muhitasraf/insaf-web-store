<?php
include("includes/header.php");
?>
<?php if (!isset($_GET['action'])) { ?>
	<div class="row">
		<div class="col-md-2 p-0 m-0">
			<div class="d-grid gap-2">
				<div class="btn-group-vertical" aria-label="Vertical button group">
					<button style="background-color: #71a1e7; border-color: #71a1e7; color:white;" class="btn mt-1">Catagories</button>
					<?php getCategories($pdo); ?>
				</div>
			</div>
			<div class="d-grid pt-1 px-1">
				
				Short By
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
			<?php if(strpos($_SERVER['REQUEST_URI'],'/index.php')){ ?>
			<div class="row my-1">
				<div style="height: 23rem;" id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
					<div class="carousel-indicators">
						<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
							class="active" aria-current="true" aria-label="Slide 1"></button>
						<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
							aria-label="Slide 2"></button>
						<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
							aria-label="Slide 3"></button>
					</div>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img style="height: 23rem;" src="https://via.placeholder.com/150" class="d-block w-100" alt="...">
							<div class="carousel-caption d-none d-md-block">
								<h5>First slide label</h5>
								<p>Some representative placeholder content for the first slide.</p>
							</div>
						</div>
						<div class="carousel-item">
							<img style="height: 23rem;" src="https://via.placeholder.com/150" class="d-block w-100" alt="...">
							<div class="carousel-caption d-none d-md-block">
								<h5>Second slide label</h5>
								<p>Some representative placeholder content for the second slide.</p>
							</div>
						</div>
						<div class="carousel-item">
							<img style="height: 23rem;" src="https://via.placeholder.com/150" class="d-block w-100" alt="...">
							<div class="carousel-caption d-none d-md-block">
								<h5>Third slide label</h5>
								<p>Some representative placeholder content for the third slide.</p>
							</div>
						</div>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
						data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
						data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
			<?php } ?>
			<div class="row gy-2 my-2">
				<?php cart($pdo); ?>
				<?php getProduct($pdo); ?>
				<?php getProductByCategories($pdo); ?>
			</div>	
		</div>
	</div>
<?php } else {
	include('login.php');
}
?>

<?php include("includes/footer.php"); ?>
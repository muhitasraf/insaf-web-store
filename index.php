<?php
include("includes/header.php");
?>
<?php if (!isset($_GET['action'])) { ?>
	<div class="row">
		<div class="col-md-2 p-0 m-0">
			<div class="card shadow-sm d-grid gap-2 my-1">
				<div class="btn-group-vertical">
					<button style="background-color: #71a1e7; border-color: #71a1e7; color:white;" class="btn">Catagories</button>
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
			<?php if(strpos($_SERVER['REQUEST_URI'],'/index.php')>1 || strlen($_SERVER['REQUEST_URI'])==17){ ?>
			<div class="row my-2">
				<div style="height: 23rem;" id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
					<div class="carousel-indicators">
						<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true"></button>
						<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
						<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
					</div>
					<div class="carousel-inner shadow-sm">
						<?php getSliderProduct($pdo); ?>
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
			</div>
			<?php } ?>
			<?php
				// Number of entries to show in a page. 
				$per_page_record = 12; 
				// Look for a GET variable page if not found default is 1.
				$page = isset($_GET["page"]) ? $_GET["page"] : 1;
				$start_from = ($page - 1) * $per_page_record;
			?>
			<div class="row gy-1 my-0">
				<?php cart($pdo); ?>
				<?php getAllProduct($pdo,$start_from, $per_page_record); ?>
				<?php getProductByCategories($pdo,$start_from, $per_page_record); ?>
			</div>
			<div class="row gy-2 my-2 mb-5 ps-3">
				<div class="d-flex justify-content-center btn-group" role="group">
					<?php
					    if(strpos($_SERVER['REQUEST_URI'],'categories')){
					        $categories_id = str_replace("categories-","",$_GET['categories']);
						    $query = "SELECT COUNT(*) products_count FROM products WHERE product_categories = $categories_id";
						    $search_link = '?page=';
					    }else{
                            $query = "SELECT COUNT(*) products_count FROM products";
                            $search_link = 'index.php?page=';
					    }
						$total_records = $pdo->query($query)->fetch()['products_count'];
						echo "<br>";  
						$total_pages = ceil($total_records / $per_page_record);
						$pagLink = "";
                        
						if ($page >= 2) {
							echo "<a href='".$search_link.($page - 1)."' class='mx-1'><button type='button' class='btn btn-outline-primary'>Prev</button></a>";
						}

						for ($i = 1; $i <= $total_pages; $i++) {
							if($i == $page){
								$pagLink .= "<a href='".$search_link.$i."' class='mx-1'><button type='button' class='active btn btn-outline-primary'>".$i."</button></a>";
							}else{
								$pagLink .= "<a href='".$search_link.$i."' class='mx-1'><button type='button' class='btn btn-outline-primary'>".$i."</button></a>";
							}
						};
						echo $pagLink;
						if ($page < $total_pages) {
							echo "<a href='".$search_link.($page + 1)."' class='mx-1'> <button type='button' class='btn btn-outline-primary'>Next</button> </a>";
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.carousel').carousel({
				interval: 2000
			})
		});
	</script>
<?php } else {
	include('login.php');
}
?>

<?php include("includes/footer.php"); ?>
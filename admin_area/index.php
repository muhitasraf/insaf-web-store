<?php 
session_start();
if(!isset($_SESSION['role']) && $_SESSION['role'] !='admin'){
	echo "<script>window.open('login.php','_self')</script>";
}else{
?>
<?php include '../includes/db.php'; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
	<meta name="theme-color" content="#7952b3">
	<style>
	.bd-placeholder-img {
		font-size: 1.125rem;
		text-anchor: middle;
		-webkit-user-select: none;
		-moz-user-select: none;
		user-select: none;
	}

	@media (min-width: 768px) {
		.bd-placeholder-img-lg {
			font-size: 3.5rem;
		}
	}
	</style>
	<link rel="stylesheet" href="https://getbootstrap.com/docs/5.0/examples/dashboard/dashboard.css">
</head>
<body>
	<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="">Insaf Shop</a>
		<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
		<div class="navbar-nav">
			<div class="nav-item text-nowrap">
			<a class="nav-link px-3" href="logout.php">Sign out</a>
			</div>
		</div>
	</header>

	<div class="container-fluid">
		<div class="row">
			<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
				<div class="position-sticky pt-3 px-2">
					<ul class="nav flex-column">
						<li class="nav-item">
							<span data-feather="home"></span>
							Dashboard
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=admin_profile">
							<span data-feather="users"></span>
							Admin Profile
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=edit_profile">
							<span data-feather="users"></span>
							Edit Profile
							</a>
						</li>
						<li class="nav-item">
							<span data-feather="file"></span>
							Products
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=add_pro">
							<span data-feather="shopping-cart"></span>
							Add Product
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=view_pro">
							<span data-feather="users"></span>
							View product
							</a>
						</li>
						<li class="nav-item">
							<span data-feather="bar-chart-2"></span>
							Categories
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=add_cat">
							<span data-feather="layers"></span>
							Add Categories
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=view_cat">
							<span data-feather="layers"></span>
							View Categories
							</a>
						</li>
						<li class="nav-item">
							<span data-feather="file-text"></span>
							User Create
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=add_user">
							<span data-feather="file-text"></span>
							Add User
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?action=view_users">
							<span data-feather="file-text"></span>
							View All User
							</a>
						</li>
					</ul>
				</div>
			</nav>

			<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2"><span class="header_title"></span></h1>
					<div class="btn-toolbar mb-2 mb-md-0">
						<div class="btn-group me-2">
							<button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
							<button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
						</div>
					</div>
				</div>
				<div class="row">
					<?php 
						if(isset($_GET['action'])){
							$action = $_GET['action'];
						}else{
							$action = '';
						}
						
						switch($action){
							case 'admin_profile';
							include 'includes/admin_profile.php';
							break;
							
							case 'edit_profile';
							include 'includes/edit_admin_profile.php';
							break;

							case 'add_pro';
							include 'includes/insert_product.php';
							break; 

							case 'view_pro';
							include 'includes/view_product.php';
							break;
							
							case 'edit_pro';
							include 'includes/edit_product.php';
							break;
							
							case 'add_cat';
							include 'includes/insert_category.php';
							break;
							
							case 'view_cat';
							include 'includes/view_categories.php';
							break;
							
							case 'edit_cat';
							include 'includes/edit_category.php';
							break;
							
							case 'view_users';
							include 'includes/view_users.php';
							break;
							
							case 'add_user';
							include 'includes/add_user.php';
							break;

							default;
							include 'includes/summary.php';
						}
					?>
				</div>
			</main>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
	<script>
		'use strict'
		feather.replace({ 'aria-hidden': 'true' })
	</script>
  	</body>
</html>

<script>
	$(document).ready(function() {
        $('#summernote').summernote();
		let dash_header = $('.das_header').val() ?? 'Dashboard';
		$('.header_title').text(dash_header);
    });	
</script>

<?php } ?>
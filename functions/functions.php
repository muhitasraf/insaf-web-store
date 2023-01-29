<?php

include './includes/db.php';

/*------------------------------------------Get_Ip_Address-----------------------------------------------*/
function getIpAddress(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

/*------------------------------------------Total_Item_Calculation-----------------------------------------*/
function getTotalItem(PDO $pdo){
	$ip_address = getIpAddress();
	$run_check_items = $pdo->query(" SELECT count(cart_id) as cart_id from cart WHERE ip_address = '$ip_address' ");
	$count_items = $run_check_items->fetchAll();
	echo $count_items[0]['cart_id'];
}

/*------------------------------------------Total_Price_Calculation----------------------------------------*/
function total_price(PDO $pdo){
	$total = 0;
	$ip_address = getIpAddress();
	$run_cart = $pdo->query("SELECT * from cart WHERE ip_address = '$ip_address' ");
	$fetch_carts = $run_cart->fetchAll();
	foreach($fetch_carts as $fetch_cart){
		$product_id = $fetch_cart['product_id'];
		$result_product = $pdo->query("SELECT * from products WHERE product_id = '$product_id' ");
		$fetch_products = $result_product->fetchAll();
		foreach($fetch_products as $fetch_product){
			$product_price = array($fetch_product['product_price']);
			$product_title = $fetch_product['product_title'];
			$product_image = $fetch_product['product_image'];
			$sign_price = $fetch_product['product_price'];
			$values = array_sum($product_price);
			
			$run_quality = $pdo->query("SELECT * from cart WHERE product_id = '$product_id' ");
			$row_quality = $run_quality->fetch();
			$quality = $row_quality ['quality'];
			$values_quality = $values *	$quality;
			$total = $total + $values_quality;
			
		}
	}
	echo $total;
}

/*------------------------------------------Get_Categories---------------------------------------------*/
function getCategories(PDO $pdo){
	$get_cats = $pdo->query("SELECT * FROM categories")->fetchAll();
	foreach($get_cats as $row_cats){
		$categories_id = $row_cats['categories_id'];
		$categories_title = $row_cats['categories_title'];
		$categories_title_slug = $row_cats['categories_title_slug'];
		// echo "<li><a href='index.php?categories=$categories_id'>$categories_title</a></li>";
		echo "<a class='btn btn-info' href='categories-$categories_id'>$categories_title</a>";
	}
}

/*------------------------------------------Add_To_Cart----------------------------------------------*/
function cart(PDO $pdo){
	if(isset($_GET['add_cart'])){
		$product_id = $_GET['add_cart'];
		$ip_address = getIpAddress();
		$run_check_product = $pdo->query("SELECT * FROM cart WHERE product_id = '$product_id' ");
		if(count($run_check_product->fetchAll())>0){
			echo "";
		}else{
			$fetch_product = $pdo->query("SELECT * FROM products WHERE product_id = '$product_id' ");
			$fetch_product = $fetch_product->fetch();
			$product_title = $fetch_product['product_title'];			
			$run_insert_product = $pdo->query("INSERT INTO cart ( product_id, product_title, ip_address ) VALUES ( '$product_id','$product_title','$ip_address')");
		}
	}
}

/*------------------------------------------Get_Praduct-----------------------------------------*/
function getAllProduct(PDO $pdo,$start_from, $per_page_record){
	if(!isset($_GET['categories'])){
		$get_products = $pdo->query("SELECT * FROM products ORDER BY product_id DESC LIMIT $start_from, $per_page_record")->fetchAll();
		foreach($get_products as $row_product){
			$pro_id = $row_product['product_id'];
			$pro_title = $row_product['product_title'];
			$title_slug = $row_product['title_slug'];
			$pro_categories = $row_product['product_categories'];
			$pro_price = $row_product['product_price'];
			$pro_description = $row_product['product_description'];
			$pro_image = $row_product['product_image'];
			$product_review = getAllProductReview($pdo,$title_slug);
			echo '<div class="col-sm-6 clo-md-4 col-lg-3">
					<div class="card shadow-sm h-100">
						<a style="text-decoration:none;color:black;" href="'.$title_slug.'">
						<img src="admin_area/product_images/'.$pro_image.'" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title">'.limit_title($pro_title).'</h5></a>
							<p><b><span style="color: rgb(232, 165, 78); font-size: 20px;">৳ '.$pro_price.'</span></b>'.'   '.$product_review.' reviews</p>
							<a id="a-hover"  class="card-footer bg-info p-2 mx-2 rounded shadow-sm" style="text-decoration:none;color:black;" href="index.php?add_cart='.$pro_id.'">Add Cart</a>
							<a id="a-hover"  class="card-footer bg-info p-2 rounded shadow-sm" style="text-decoration:none;color:black;" href="index.php?wish_list='.$pro_id.'">Wish List</a>
						</div>
					</div>
				</div>';
		}
	}
}

/*------------------------------------------Get_Product_By_Categories---------------------------------*/
function getProductByCategories(PDO $pdo){
	if(isset($_GET['categories'])){
		$categories_id = str_replace("categories-","",$_GET['categories']);
		$get_product_categories = $pdo->query("SELECT * from products WHERE product_categories = $categories_id")->fetchAll();
		$count_categories = count($get_product_categories);
		if($count_categories==0){
			echo "<div class='row ms-1'>
					<div class='card text-center'>
						<h2>There is no products in this category.</h2>
					</div>
				</div>";
		}
		foreach($get_product_categories as $row_product_categories){
			$pro_id = $row_product_categories['product_id'];
			$title_slug = $row_product_categories['title_slug'];
			$pro_title = $row_product_categories['product_title'];
			$pro_categories = $row_product_categories['product_categories'];
			$pro_price = $row_product_categories['product_price'];
			$pro_description = $row_product_categories['product_description'];
			$pro_image = $row_product_categories['product_image'];
			$product_review = getAllProductReview($pdo,$title_slug);			
			echo '<div class="col-sm-6 clo-md-4 col-lg-3">
					<div class="card h-100">
						<a style="text-decoration:none;color:black;" href="'.$title_slug.'">
						<img src="admin_area/product_images/'.$pro_image.'" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title">'.limit_title($pro_title).'</h5></a>
							<p><b><span style="color: rgb(232, 165, 78); font-size: 20px;">৳ '.$pro_price.'</span></b>'.'   '.$product_review.' reviews</p>
							<a id="a-hover"  class="card-footer bg-info p-2 mx-2 rounded shadow-sm" style="text-decoration:none;color:black;" href="index.php?add_cart='.$pro_id.'">Add Cart</a>
							<a id="a-hover"  class="card-footer bg-info p-2 rounded shadow-sm" style="text-decoration:none;color:black;" href="index.php?wish_list='.$pro_id.'">Wish List</a>
						</div>
					</div>
				</div>';
		}
	}
}

/*------------------------------------------Search_Engine--------------------------------------------*/
function searchResult(PDO $pdo){
	if(isset($_GET['search'])){
		$search_query = $_GET['user_query'];
		$get_product_by_product_id = $pdo->query("SELECT * FROM products WHERE product_keywords LIKE '%$search_query%'")->fetchAll();
		
		foreach($get_product_by_product_id as $row_product){
			$pro_id = $row_product['product_id'];
			$pro_title = $row_product['product_title'];
			$title_slug = $row_product['title_slug'];
			$pro_categories = $row_product['product_categories'];
			$pro_price = $row_product['product_price'];
			$pro_description = $row_product['product_description'];
			$pro_image = $row_product['product_image'];
			$product_review = getAllProductReview($pdo,$title_slug);			
			echo '<div class="col-sm-6 clo-md-4 col-lg-3">
					<div class="card h-100">
						<a style="text-decoration:none;color:black;" href="'.$title_slug.'">
						<img src="admin_area/product_images/'.$pro_image.'" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title">'.limit_title($pro_title).'</h5></a>
							<p><b><span style="color: rgb(232, 165, 78); font-size: 20px;">৳ '.$pro_price.'</span></b>'.'   '.$product_review.' reviews</p>
							<a id="a-hover"  class="card-footer bg-info p-2 mx-2 rounded shadow-sm" style="text-decoration:none;color:black;" href="index.php?add_cart='.$pro_id.'">Add Cart</a>
							<a id="a-hover"  class="card-footer bg-info p-2 rounded shadow-sm" style="text-decoration:none;color:black;" href="index.php?wish_list='.$pro_id.'">Wish List</a>
						</div>
					</div>
				</div>';
		}
	}
}

/*------------------------------------------Get Slider Praduct-----------------------------------------*/
function getSliderProduct(PDO $pdo){
	if(!isset($_GET['categories'])){
		$get_products = $pdo->query("SELECT * FROM products ORDER BY product_id DESC LIMIT 0, 3")->fetchAll();
		foreach($get_products as $key=>$row_product){
			$pro_id = $row_product['product_id'];
			$pro_title = $row_product['product_title'];
			$title_slug = $row_product['title_slug'];
			$pro_categories = $row_product['product_categories'];
			$pro_price = $row_product['product_price'];
			$pro_description = $row_product['product_description'];
			$pro_image = $row_product['product_image'];
			$product_review = getAllProductReview($pdo,$title_slug);
			$active = ($key==0) ? 'active' : ''; 
			echo '	<div class="carousel-item '.$active.'">
						<img style="height: 23rem;" src="admin_area/product_images/'.$pro_image.'" class="d-block w-100" alt="...">
						<div class="carousel-caption d-none d-md-block">
							<h5>'.($pro_title).'</h5>
							<p>Some representative placeholder content for the second slide.</p>
						</div>
					</div>';
		}
	}
}

/*----------------------------Convert Long Title To Short-----------------------------------*/
function limit_title($string){
	$string = strip_tags($string);
	if (strlen($string) > 30) {
		$stringCut = substr($string, 0, 30);
		$endPoint = strrpos($stringCut,' ');
		$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
		$string .= ' .......';
	}else{
		$string .= ' '.str_repeat('&nbsp;', 30-strlen($string));
	}
	return $string;
}

/*----------------------------Convert Long Description To Short------------------------------------*/
function limit_details($string){
	$string = strip_tags($string);
	if (strlen($string) > 30) {
		$stringCut = substr($string, 0, 200);
		$endPoint = strrpos($stringCut,' ');
		$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
		$string .= '... <a href="#details">Read More</a>';
	}
	return $string;
}

/*------------------------------------------Product Details--------------------------------------------*/
function getProductDetails(PDO $pdo){
	if(isset($_GET['title_slug'])){
		$pro_id = $_GET['title_slug'];
		$title_slug = $_GET['title_slug'];
		$get_product_by_product_id = $pdo->query("SELECT * FROM products WHERE title_slug = '$title_slug' ")->fetchAll();
		return $get_product_by_product_id;
	}	
}

/*------------------------------------------Comments By Product--------------------------------------------*/
function getComments(PDO $pdo){
	$get_product_by_product_id = $pdo->query(" SELECT * FROM products WHERE title_slug = '$_GET[title_slug]' ")->fetch();
	$product_id = $get_product_by_product_id['product_id'];
	
	$all_comments = $pdo->query(" SELECT * FROM comments WHERE product_id = '$product_id' ")->fetchAll();
	$count_comments = count($all_comments);
	if($count_comments==0){
		echo "<h2>No review exist for this product.</h2>";
	}
	foreach($all_comments as $row_comments){
		$comment_id = $row_comments['comment_id'];
		$user_name = $row_comments['user_name'];
		$comment_text = $row_comments['comment_text'];
		$star_count = $row_comments['star_count'];
		echo '	<div class="card mb-3">
					<div class="card-body">
						<div class="d-flex flex-start">
							<img class="rounded-circle shadow-1-strong me-3" src="https://i.imgur.com/hczKIze.jpg" alt="avatar" width="40" height="40" /><div id="comment_box" class="w-100">
							<div class="d-flex justify-content-between align-items-center mb-3">
								<h6 class="text-primary fw-bold mb-0">'.$user_name.'</h6>
								<p class="mb-0">
									<i class="bi bi-star'.($star_count>=1?'-fill':'').'" style="color: #aaa;"></i>
									<i class="bi bi-star'.($star_count>=2?'-fill':'').'" style="color: #aaa;"></i>
									<i class="bi bi-star'.($star_count>=3?'-fill':'').'" style="color: #aaa;"></i>
									<i class="bi bi-star'.($star_count>=4?'-fill':'').'" style="color: #aaa;"></i>
									<i class="bi bi-star'.($star_count>=5?'-fill':'').'" style="color: #aaa;"></i>
								</p>
							</div>
							<div class="d-flex justify-content-between align-items-center">
								<p class="small mb-0" style="color: black;">
									'.$comment_text.'
								</p>
							</div>
							</div>
						</div>
					</div>
				</div>';
	}
}

/*------------------------------------------Single Review--------------------------------------------*/
function getProductReview(PDO $pdo){
	$get_product_by_product_id = $pdo->query(" SELECT * FROM products WHERE title_slug = '$_GET[title_slug]' ")->fetch();
	$product_id = $get_product_by_product_id['product_id'];
	$all_review = $pdo->query(" SELECT count(product_id) reviews FROM comments WHERE product_id = '$product_id' ")->fetch();
	echo $all_review['reviews'];
}

/*------------------------------------------All Reviews--------------------------------------------*/
function getAllProductReview(PDO $pdo,$title_slug){
	$get_product_by_product_id = $pdo->query(" SELECT * FROM products WHERE title_slug = '$title_slug' ")->fetch();
	$product_id = $get_product_by_product_id['product_id'];
	$all_review = $pdo->query(" SELECT count(product_id) reviews FROM comments WHERE product_id = '$product_id' ")->fetch();
	return $all_review['reviews'];
}

/*------------------------------------------Insert Review--------------------------------------------*/
function insertComment(PDO $pdo){
	if(isset($_POST['insert_comment'])){
		$comment_text = $_POST['comment_text'];		
		$star_count = $_POST['star_count'];		
		$get_product_by_id = $pdo->query("SELECT * FROM products WHERE title_slug = '$_GET[title_slug]'")->fetch();
		$product_id = $get_product_by_id['product_id'];	
		$ip_address = getIpAddress();
		$user_id = $_SESSION['user_id'];
		$get_user = $pdo->query("SELECT * FROM users WHERE user_id = '$_SESSION[user_id]'")->fetch();
		$user_name = $get_user['user_name'];
		echo $user_name;
		$insert_comment = "INSERT INTO comments ( user_id, product_id, user_name, comment_text, star_count, ip_address) VALUES ('$user_id', '$product_id','$user_name','$comment_text','$star_count','$ip_address')";
		$insert_pro = $pdo->query($insert_comment);
		if($insert_pro){
			echo "<script>alert('Comment has been uploaded successfully')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";
		}
	}
}

?>
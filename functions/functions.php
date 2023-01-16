<?php
$con = mysqli_connect("localhost","root","","insaf_service_db");
if(mysqli_connect_errno()){
	echo "Failed to connect MyQlite DB:".mysqli_connect_error();
}

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
		echo "<li><a href='categories-$categories_id'>$categories_title</a></li>";
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
function getProduct(PDO $pdo){
	if(!isset($_GET['categories'])){
		$get_products = $pdo->query("SELECT * FROM products ORDER BY RAND() LIMIT 0,15")->fetchAll();
		foreach($get_products as $row_product){
			$pro_id = $row_product['product_id'];
			$pro_title = $row_product['product_title'];
			$title_slug = $row_product['title_slug'];
			$pro_categories = $row_product['product_categories'];
			$pro_price = $row_product['product_price'];
			$pro_description = $row_product['product_description'];
			$pro_image = $row_product['product_image'];
			echo "
				<div id='single_product'>
					<a style='text-decoration:none;color:black;' href='$title_slug'><h2>$pro_title</h2>
					<img class='img' src='admin_area/product_images/$pro_image' width='180' heigth='180'  /></a>
					<p style='padding:10px;'><b>Price: $pro_price Taka</b></p>
					<a href='$title_slug'><button class='detailsbtn'>Wishlist</button></a>
					<a href='index.php?add_cart=$pro_id'><button class='cardbtn'>Add to Cart</button></a>
				</div>
			";
		}
	}
}


/*------------------------------------------Get_Praduct-----------------------------------------*/
function getAllProduct(PDO $pdo){
	if(!isset($_GET['categories'])){
		$get_products = $pdo->query("SELECT * FROM products ORDER BY product_id DESC")->fetchAll();
		foreach($get_products as $row_product){
			$pro_id = $row_product['product_id'];
			$pro_title = $row_product['product_title'];
			$title_slug = $row_product['title_slug'];
			$pro_categories = $row_product['product_categories'];
			$pro_price = $row_product['product_price'];
			$pro_description = $row_product['product_description'];
			$pro_image = $row_product['product_image'];
			echo "
				<div id='single_product'>
					<a style='text-decoration:none;color:black;' href='$title_slug'><h2>$pro_title</h2>
					<img class='img' src='admin_area/product_images/$pro_image' width='180' heigth='180'  /></a>
					<p style='padding:10px;'><b>Price: $pro_price Taka</b></p>
					<a href='$title_slug'><button class='detailsbtn'>Wishlist</button></a>
					<a href='index.php?add_cart=$pro_id'><button class='cardbtn'>Add to Cart</button></a>
				</div>
			";
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
			echo "<h2>Product not fount</h2>";
		}
		foreach($get_product_categories as $row_product_categories){
			$pro_id = $row_product_categories['product_id'];
			$title_slug = $row_product_categories['title_slug'];
			$pro_title = $row_product_categories['product_title'];
			$pro_categories = $row_product_categories['product_categories'];
			$pro_price = $row_product_categories['product_price'];
			$pro_description = $row_product_categories['product_description'];
			$pro_image = $row_product_categories['product_image'];
			
			echo "
				<div id='single_product'>
					<a style='text-decoration:none;color:black;' href='$title_slug'><h2>$pro_title</h2>
					<img class='img' src='admin_area/product_images/$pro_image' width='180' heigth='180'  /></a>
					<p style='padding:10px;'><b>Price: $pro_price Taka</b></p>
					<a href='$title_slug'><button class='detailsbtn'>Wishlist</button></a>
					<a href='index.php?add_cart=$pro_id'><button class='cardbtn'>Add to Cart</button></a>
				</div>
			";
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
			$pro_categories = $row_product['product_categories'];
			$pro_price = $row_product['product_price'];
			$pro_description = $row_product['product_description'];
			$pro_image = $row_product['product_image'];
			
			echo "
				<div id='single_product'>
					<h2>$pro_title</h2>
					<img src='admin_area/product_images/$pro_image' width='180' heigth='180'  />
					<p><b>$pro_price</b></p>
					<a href='details.php?pro_id=$pro_id'>Details</a>
					<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add TO Cart</button></a>
				</div>
			";
		}
	}
}

function getProductDetails(PDO $pdo){
	if(isset($_GET['title_slug'])){
		$pro_id = $_GET['title_slug'];
		$title_slug = $_GET['title_slug'];
		$get_product_by_product_id = $pdo->query("SELECT * FROM products WHERE title_slug = '$title_slug' ")->fetchAll();
		
		foreach($get_product_by_product_id as $row_product){
			$pro_id = $row_product['product_id'];
			$pro_title = $row_product['product_title'];
			$title_slug = $row_product['title_slug'];
			$pro_categories = $row_product['product_categories'];
			$pro_price = $row_product['product_price'];
			$pro_description = $row_product['product_description'];
			$pro_image = $row_product['product_image'];
			
			echo "
				<div id='single_product'>
					<h2>$pro_title</h2>
					<img src='admin_area/product_images/$pro_image' width='180' heigth='180'  />
					<p><b>$pro_price</b></p>
					
					<a href='index.php?add_cart=$pro_id'><button style='float:center'>Add TO Cart</button></a>
				</div>
				<div class='description_box'>
					$pro_description
				</div>
			";
		}
	}	
}


function getComments(PDO $pdo){
	$get_product_by_product_id = $pdo->query(" SELECT * FROM products WHERE title_slug = '$_GET[title_slug]' ")->fetch();
	$product_id = $get_product_by_product_id['product_id'];
	
	$all_comments = $pdo->query(" SELECT * FROM comments WHERE product_id = '$product_id' ")->fetchAll();
	$count_comments = count($all_comments);
	if($count_comments==0){
		echo "<h2>comments not found</h2>";
	}
	foreach($all_comments as $row_comments){
		$comment_id = $row_comments['comment_id'];
		$user_name = $row_comments['user_name'];
		$comment_text = $row_comments['comment_text'];
		echo "
			<div id='comment_box'>
				<h2>Name: $user_name</h2>
				<p>Comment: $comment_text</p>
			</div>
		";
	}
}

function insertComment(PDO $pdo){
	if(isset($_POST['insert_comment'])){
		$comment_text = $_POST['comment_text'];		
		$get_product_by_id = $pdo->query("SELECT * FROM products WHERE title_slug = '$_GET[title_slug]'")->fetch();
		$product_id = $get_product_by_id['product_id'];	
		$ip_address = getIpAddress();
		$user_id = $_SESSION['user_id'];
		$get_user = $pdo->query("SELECT * FROM users WHERE user_id = '$_SESSION[user_id]'")->fetch();
		$user_name = $get_user['user_name'];
		echo $user_name;
		$insert_comment = "INSERT INTO comments ( user_id, product_id, user_name, comment_text, ip_address) VALUES ('$user_id', '$product_id','$user_name','$comment_text','$ip_address')";
		$insert_pro = $pdo->query($insert_comment);
		if($insert_pro){
			echo "<script>alert('Comment has been uploaded successfully')</script>";
			echo "<script>window.open(window.location.href,'_self')</script>";
		}
	}
}

?>
<?php
$con = mysqli_connect("localhost","root","","insaf_service_db");
if(mysqli_connect_errno()){
	echo "Failed to connect MyQlite DB:".mysqli_connect_error();
}

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
function getTotalItem(){
	global $con;
	$ip_address = getIpAddress();
	$run_check_items = mysqli_query($con," select * from cart where ip_address = '$ip_address' ");
	$count_items = mysqli_num_rows($run_check_items);
	echo $count_items;
}

/*------------------------------------------Total_Price_Calculation----------------------------------------*/
function total_price(){
	global $con;
	$total = 0;
	$ip_address = getIpAddress();
	$run_cart = mysqli_query($con," select * from cart where ip_address = '$ip_address' ");
	while($fetch_cart = mysqli_fetch_array($run_cart)){
		$product_id = $fetch_cart['product_id'];
		$result_product = mysqli_query($con," select * from products where product_id = '$product_id' ");
		while($fetch_product = mysqli_fetch_array($result_product)){
			$product_price = array($fetch_product['product_price']);
			$product_title = $fetch_product['product_title'];
			$product_image = $fetch_product['product_image'];
			$sign_price = $fetch_product['product_price'];
			$values = array_sum($product_price);
			
			$run_quality = mysqli_query($con," select * from cart where product_id = '$product_id' ");
			$row_quality = mysqli_fetch_array($run_quality);
			$quality = $row_quality ['quality'];
			$values_quality = $values *	$quality;
			$total = $total + $values_quality;
			
		}
	}
	echo $total;
}

/*------------------------------------------Get_Categories---------------------------------------------*/
function getCategories(){
	global $con;
	$get_cats = "select * from categories";
	$run_cats = mysqli_query($con,$get_cats);
	while($row_cats=mysqli_fetch_array($run_cats)){
		$categories_id = $row_cats['categories_id'];
		$categories_title = $row_cats['categories_title'];
		echo "<li><a href='index.php?categories=$categories_id'>$categories_title</a></li>";
	}
}

/*------------------------------------------Add_To_Cart----------------------------------------------*/
function cart(){
	if(isset($_GET['add_cart'])){
		global $con;
		$product_id = $_GET['add_cart'];
		$ip_address = getIpAddress();
		$run_check_product = mysqli_query($con," select * from cart where product_id = '$product_id' ");
		if(mysqli_num_rows($run_check_product)>0){
			echo "";
		}else{
			$fetch_product = mysqli_query($con," select * from products where product_id = '$product_id' ");
			$fetch_product = mysqli_fetch_array($fetch_product);
			$product_title = $fetch_product['product_title'];			
			$run_insert_product = mysqli_query($con," insert into cart ( product_id, product_title, ip_address ) values ( '$product_id','$product_title','$ip_address')");
		}
	}
}

/*------------------------------------------Get_Praduct-----------------------------------------*/
function getProduct(){
	if(!isset($_GET['categories'])){
		global $con;
		$get_product = " select * from products order by RAND() LIMIT 0,15";
		$run_product = mysqli_query($con,$get_product);
		
		while($row_product = mysqli_fetch_array($run_product)){
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
function getProductByCategories(){
	if(isset($_GET['categories'])){
		global $con;
		$categories_id = $_GET['categories'];
		$get_product_categories = "select * from products where product_categories = $categories_id";
		$run_product_categories = mysqli_query($con,$get_product_categories);
		$count_categories = mysqli_num_rows($run_product_categories);
		if($count_categories==0){
			echo "<h2>Product not fount</h2>";
		}
		while($row_product_categories = mysqli_fetch_array($run_product_categories)){
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
function searchResult(){
	if(isset($_GET['search'])){
		global $con;
		$search_query = $_GET['user_query'];
		
		$run_query_by_product_id = mysqli_query($con," select * from products where product_keywords like '%$search_query%' ");
		
		while($row_product = mysqli_fetch_array($run_query_by_product_id)){
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

?>
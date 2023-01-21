<?php include("includes/header.php");?>
<style>
.payment-info {
	background: blue;
	padding: 10px;
	border-radius: 6px;
	color: #fff;
	font-weight: bold;
}

.product-details {
	padding: 10px;
}

.cart-1 {
	background: #fff;
}

.p-about {
	font-size: 12px;
}

.table-shadow {
	-webkit-box-shadow: 5px 5px 15px -2px rgba(0,0,0,0.42);
	box-shadow: 5px 5px 15px -2px rgba(0,0,0,0.42);
}

.type {
	font-weight: 400;
	font-size: 10px;
}

label.radio {
	cursor: pointer;
}

label.radio input {
	position: absolute;
	top: 0;
	left: 0;
	visibility: hidden;
	pointer-events: none;
}

label.radio span {
	padding: 1px 12px;
	border: 2px solid #ada9a9;
	display: inline-block;
	color: #8f37aa;
	border-radius: 3px;
	text-transform: uppercase;
	font-size: 11px;
	font-weight: 300;
}

label.radio input:checked + span {
	border-color: #fff;
	background-color: blue;
	color: #fff;
}

.credit-inputs {
	background: rgb(102,102,221);
	color: #fff !important;
	border-color: rgb(102,102,221);
}

.credit-inputs::placeholder {
	color: #fff;
	font-size: 13px;
}

.credit-card-label {
	font-size: 9px;
	font-weight: 300;
}

.form-control.credit-inputs:focus {
	background: rgb(102,102,221);
	border: rgb(102,102,221);
}

.line {
	border-bottom: 1px solid rgb(102,102,221);
}

.information span {
	font-size: 12px;
	font-weight: 500;
}

.information {
	margin-bottom: 5px;
}

.items {
	-webkit-box-shadow: 5px 5px 4px -1px rgba(0,0,0,0.25);
	box-shadow: 5px 5px 4px -1px rgba(0, 0, 0, 0.08);
}

.spec {
	font-size: 11px;
}
</style>	
<div class="row bg-light my-2 gy-2 no-gutters">
	<div class="col-md-8">
		<div class="product-details mr-2">
			<div class="d-flex flex-row align-items-center">
				<i class="fa fa-long-arrow-left"></i>
				<span class="ml-2">Continue Shopping</span>
			</div>
			<hr>
			<h6 class="mb-0">Shopping cart</h6>
			<div class="d-flex justify-content-between"><span>You have <?php getTotalItem($pdo); ?> items in your cart</span>
				<div class="d-flex flex-row align-items-center">
					<span class="text-black-50">Total Price : </span>
					<div class="price ml-2">
						<span class="mr-1"> <?php total_price($pdo); ?> Tk</span>
					</div>
				</div>
			</div>
			<?php
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
						$single_price = $fetch_product['product_price'];
						$product_image = $fetch_product['product_image'];
						$sign_price = $fetch_product['product_price'];
						$values = array_sum($product_price);
						
						$run_quality = $pdo->query("SELECT * from cart WHERE product_id = '$product_id' ");
						$row_quality = $run_quality->fetch();
						$quality = $row_quality ['quality'];
						$values_quality = $values *	$quality;
						$total = $total + $values_quality;
			?>
				<div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
					<div class="d-flex flex-row">
						<img class="rounded" src="admin_area/product_images/<?php echo $product_image;?>" width="40">
						<div class="ms-2">
							<span class="font-weight-bold d-block"><?php echo $product_title; ?></span>
							<!-- <span class="spec">256GB, Navy Blue</span> -->
						</div>
					</div>
					<div class="d-flex flex-row align-items-center">
						<span class="d-block"><?php echo $quality;?></span>
						<span class="d-block ms-5 font-weight-bold">$<?php echo $single_price;?></span>
						<i class="fa fa-trash-o ms-3 text-black-50"></i>
					</div>
				</div>
			<?php }} ?>
		</div>
	</div>
	<div class="col-md-4">
		<div class="payment-info">
			<div class="d-flex justify-content-between align-items-center">
				<span>Card details</span>
				<img class="rounded" src="https://i.imgur.com/WU501C8.jpg" width="30">
			</div>
			<span class="type d-block mt-3 mb-1">Card type</span>
			<label class="radio">
				<input type="radio" name="card" value="payment" checked> 
				<span><img width="30" src="https://img.icons8.com/color/48/000000/mastercard.png"/></span> 
			</label>

			<label class="radio"> 
				<input type="radio" name="card" value="payment"> 
				<span><img width="30" src="https://img.icons8.com/officel/48/000000/visa.png"/></span> 
			</label>

			<label class="radio"> 
				<input type="radio" name="card" value="payment"> 
				<span><img width="30" src="https://img.icons8.com/ultraviolet/48/000000/amex.png"/></span> 
			</label>


			<label class="radio"> 
				<input type="radio" name="card" value="payment"> 
				<span><img width="30" src="https://img.icons8.com/officel/48/000000/paypal.png"/></span> 
			</label>
			<div>
				<label class="credit-card-label">Name on card</label>
				<input type="text" class="form-control credit-inputs" placeholder="Name">
			</div>
			<div>
				<label class="credit-card-label">Card number</label>
				<input type="text" class="form-control credit-inputs" placeholder="0000 0000 0000 0000">
			</div>
			<div class="row">
				<div class="col-md-6">
					<label class="credit-card-label">Date</label>
					<input type="text" class="form-control credit-inputs" placeholder="12/24">
				</div>
				<div class="col-md-6">
					<label class="credit-card-label">CVV</label>
					<input type="text" class="form-control credit-inputs" placeholder="342">
				</div>
			</div>
			<hr class="line">
			<div class="d-flex justify-content-between information">
				<span>Subtotal</span><span>$<?php total_price($pdo); ?>.00</span>
			</div>
			<div class="d-flex justify-content-between information">
				<span>Shipping</span><span>$20.00</span>
			</div>
			<div class="d-flex justify-content-between information">
				<span>Total(Incl. taxes)</span><span>$<?php echo total_price($pdo) ;?>.00</span>
			</div>
			<button class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="button">
				<a href="checkout.php" style="text-decoration:none;color:white">
				<span>$<?php echo total_price($pdo) ;?>.00</span>
				<span> Checkout<i class="fa fa-long-arrow-right ml-1"></i></span>
				</a>
			</button>
		</div>
	</div>
</div>

<?php
	if(isset($_POST['remove'])){
		foreach($_POST['remove'] as $remove_id){
			$run_delete = $pdo->query("DELETE FROM cart WHERE product_id='$remove_id' AND ip_address='$ip_address'");
			if($run_delete){
				echo "<script>window.open('cart.php','_self')</script>";
			}
		}
	}
	
	if(isset($_POST['continue'])){
		echo "<script>window.open('index.php','_self')</script>";
	}
	
	if(isset($_POST['quality']) || isset($_POST['h_product_id'])){
		foreach($_POST['h_product_id'] as $key=>$product_id){
			$quality = $_POST['quality'][$key];
			$run_quality = $pdo->query("UPDATE cart set quality = $quality where product_id = $product_id AND ip_address='$ip_address' ");
			if($run_quality){
				echo "<script>window.open('cart.php','_self')</script>";
			}
		}
	}
?>

<script>
	// $('.test').on('keyup',function(){
	// 	alert($('.test').val())
	// });
</script>

<?php include("includes/footer.php");?>		
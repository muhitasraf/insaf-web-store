<?php include("includes/header.php");?>
<style>

</style>	
<div class="row bg-light my-2 gy-2 m-2 no-gutters">
	<div class="col-md-8">
		<div class="product-details mr-2">
			<div class="d-flex flex-row align-items-center">
				<a href="index.php"><i class="fa fa-long-arrow-left"></i>
				<span class="ml-2">Continue Shopping</span></a>
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
				<span>Subtotal</span><span>৳<?php total_price($pdo); ?>.00</span>
			</div>
			<div class="d-flex justify-content-between information">
				<span>Shipping</span><span>৳20.00</span>
			</div>
			<div class="d-flex justify-content-between information">
				<span>Total(Incl. taxes)</span><span>৳<?php echo total_price($pdo) ;?>.00</span>
			</div>
			<button class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="button">
				<a href="checkout.php" style="text-decoration:none;color:white">
				<span>৳<?php echo total_price($pdo) ;?>.00</span>
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
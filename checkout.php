<?php include("includes/header.php");?>
	<?php
	if(!isset($_SESSION['user_id'])){
		include('login.php');
	}else{
		include('payment.php');
	}
	?>
<?php include("includes/footer.php");?>		
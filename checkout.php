<?php include("includes/header.php");?>
	
	<div class="content_wrapper">
		
		<?php
		if(!isset($_SESSION['user_id'])){
			include('login.php');
		}else{
			include('payment.php');
		}
		?>
	</div>

<?php include("includes/footer.php");?>		
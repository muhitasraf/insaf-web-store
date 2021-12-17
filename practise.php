<?php 
	include("includes/header.php");
?>	
	<input type="submit" name="comment" action=""/>
	
	<div id="comment_box">
		<?php
			if(isset($_POST['comment'])){
				$comment_id = $_POST['comment_id'];
				$comment_text = $_POST['comment_text'];
				$reply_text = $_POST['reply_text'];
				$run_query_by_comment_id = mysqli_query($con," select * from comments where comment_id = '$comment_id' ");
				
				while($row_product = mysqli_fetch_array($run_query_by_product_id)){
					$comment_id = $row_product['comment_id'];
					$comment_text = $row_product['comment_text'];
					$reply_text = $row_product['reply_text'];
					
					echo "
						<div id='single_product'>
							<h2>$comment_text</h2>
							<p><b>$reply_text</b></p>
						</div>
					";
				}
			}
		?>	
	</div>
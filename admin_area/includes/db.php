<?php
$con = mysqli_connect("localhost","root","","insaf_service_db");
if(mysqli_connect_errno()){
	echo "Failed to connect MyQlite DB:".mysqli_connect_error();
}else{
	echo "MyQlite Successfully connected";
}
?>
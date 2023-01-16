<?php
	try {
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$pdo = new PDO('mysql:host=localhost;dbname=insaf_service_db', $dbuser, $dbpass);
	}catch (PDOException $e){
		echo "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
?>
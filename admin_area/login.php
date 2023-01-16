
<?php session_start(); ?>

<head>
<meta charset="UTF-8">
<title>Log In</title>

<link rel="stylesheet" href="styles/admin_login.css" />

</head>

<body>

<nav><a href="#" class="focus">Log In</a></nav>

<form action="" method="post" enctype="multipart/form-data">

	<h2>Admin Login</h2>

	<input type="text" name="user_email" class="text-field" placeholder="UserEmail" />
    <input type="password" name="user_password" class="text-field" placeholder="Password" />
    
    <input type="submit" name="login" class="button" value="Log In" /></a>

</form>

</body>

<?php 
include('../includes/db.php');
if(isset($_POST['login'])){
	$user_email = trim($_POST['user_email']);
	$user_password = trim($_POST['user_password']);
	$hash_password = md5($user_password);
	$select_user = "SELECT * FROM users WHERE user_email ='$user_email' AND user_password ='$hash_password' ";
	$run_user = $pdo->query($select_user)->fetch();
	$check_user = count($run_user);
	if($check_user>0){
		$db_row = $run_user;
		$_SESSION['user_email'] = $db_row['user_email'];
		$_SESSION['user_name'] = $db_row['user_name'];
		$_SESSION['user_id'] = $db_row['user_id'];
		$_SESSION['role'] = $db_row['role'];
		
		if($db_row['role'] =='admin'){
			echo "<script>window.open('index.php?loged_in =You have successfully loged in','_self')</script>";
		}elseif($db_row['role'] =='guest'){
			echo "<script>alert('Password or email not match. You are not admin . You are guest.')</script>";
		}else{
			echo "<script>alert('Password or email not match.')</script>";
		}
	}
}
?>
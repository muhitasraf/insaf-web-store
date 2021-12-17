<?php
session_start();
$con=mysqli_connect("localhost","root","","user_database");
if(mysqli_connect_errno()){
    echo "not connected";
}else{
    echo "Mysqlite Successfuly connected.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container">
        <form id="signup" method="post" action="">
            <div class="header">
                <h3 style="padding-top:15px;text-align:center;">Verify Your Email</h3>   
            </div>
            <div class="sep"></div>
            <div class="inputs">
                <input type="text" name="code" placeholder="Enter Your code">
                <button id="submit" name="confirm" >Submit</button>            
            </div>   
        </form>   
    </div>    ​  
</body>
</html>
         
<?php

if(isset($_POST['confirm'])){
 
    $code=$_POST['code'];
    $verify=mysqli_query($con,"select * from userdata where code='$code' ");
    $check_code=mysqli_num_rows($verify);
    $get_username=mysqli_query($con,"select * from userdata where email='$email' ");

    if($check_code>0){
		$_SESSION['user_id'] = $user_id;
        $_SESSION['email'] = $email;
        $update_status=mysqli_query($con,"update userdata set code='0',status='verified' where code=$code ");
		if($update_status){
			echo "<script> alert('Successfully Verified'); </script>";
			echo "<script> window.open('profile.php','_self'); </script>";
		}else{
			echo "<script> alert('Wrong Code.'); </script>";
		}
		$user_id = $_SESSION['user_id'] ;
        $email = $_SESSION['email'] ;
    }
}

?>
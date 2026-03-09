<?php
session_start();
include "db_connect.php";

$message="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

$username=$_POST['username'];
$password=$_POST['password'];

$stmt=$conn->prepare("SELECT id,username,password_hash,role FROM users WHERE username=? OR email=?");
$stmt->bind_param("ss",$username,$username);
$stmt->execute();

$result=$stmt->get_result();
$user=$result->fetch_assoc();

if($user && password_verify($password,$user['password_hash'])){

$_SESSION['user_id']=$user['id'];
$_SESSION['username']=$user['username'];
$_SESSION['role']=$user['role'];

if($_SESSION['role'] === 'admin'){
header("Location: admin_dashboard.php");
}else{
header("Location: dashboard.php");
}

exit();

}else{

$message="Invalid login details.";

}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h2>Login</h2>

<p><?php echo $message; ?></p>

<form method="POST" action="login.php">

<input type="text" name="username" placeholder="Username or Email">

<input type="password" name="password" placeholder="Password">

<button type="submit">Login</button>

</form>

<a href="register.php">Create Account</a>

</div>

</body>
</html>
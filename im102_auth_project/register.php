<?php
include "db_connect.php";

if(!$conn){
    die("Database connection not established!");
}
$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

if(empty($username) || empty($email) || empty($password) || empty($confirm)){
$message = "All fields are required.";
}

elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
$message = "Invalid email format.";
}

elseif($password != $confirm){
$message = "Passwords do not match.";
}

elseif(strlen($password) < 8 || !preg_match('/[0-9]/',$password)){
$message = "Password must be at least 8 characters and contain a number.";
}

else{

$stmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
$stmt->bind_param("ss",$username,$email);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
$message = "Username or Email already exists.";
}

else{

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users(username,email,password_hash) VALUES(?,?,?)");
$stmt->bind_param("sss",$username,$email,$password_hash);

if($stmt->execute()){
$message = "Registration successful! You can now login.";

}else{
$message = "Error: Could not register.";
}
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h2>User Registration</h2>

<p><?php echo $message; ?></p>


<form method="POST" action="register.php">

Username:<br>
<input type="text" name="username"><br><br>

Email:<br>
<input type="email" name="email"><br><br>

Password:<br>
<input type="password" name="password"><br><br>

Confirm Password:<br>
<input type="password" name="confirm_password"><br><br>

<button type="submit">Register</button>

</form>

<a href="login.php">Already have an account? Login</a>

</body>
</html>
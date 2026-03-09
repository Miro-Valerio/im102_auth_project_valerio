<?php

function requireLogin(){

session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

}

function requireAdmin(){

requireLogin();

if($_SESSION['role'] !== 'admin'){
die("Access Denied. Administrators only.");
}

}

function isLoggedIn(){
return isset($_SESSION['user_id']);
}

function isAdmin(){
return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

?>
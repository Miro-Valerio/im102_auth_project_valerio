<?php
require_once "auth_functions.php";

requireAdmin();
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="admin_dashboard.css">
</head>

<body>

<div class="container">

<h1>Admin Dashboard</h1>

<p>Welcome, Admin <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

<h2>Admin Controls</h2>

<ul>
<li><a href="#">Manage Users</a></li>
<li><a href="#">System Settings</a></li>
<li><a href="#">View All Posts</a></li>
</ul>

<hr>

<div class="bottom-links">
<a href="dashboard.php">User Dashboard</a> |
<a href="logout.php">Logout</a>
</div>

</div>

</body>
</html>
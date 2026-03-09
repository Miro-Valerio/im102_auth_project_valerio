<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>


<nav class="navbar">
    <div class="nav-container">
        <a href="#" class="logo">My Dashboard</a>
        <ul class="nav-links">
           <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="admin_dashboard.php">Admin Dashboard</a></li>  
            <?php endif; ?>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>


<div class="container">
    <h1>Welcome to Your Dashboard</h1>
    <p>Hello, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</p>
</div>

</body>
</html>
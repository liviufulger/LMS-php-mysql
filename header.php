<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteFury</title>
    <link rel="stylesheet" href="/COM6011/style.css"> <!-- Link your CSS file -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    

</head>
<body>

<header class="header">
    <div class="flex-container">
        <h1 class="site-title">ByteFury</h1>

        <div class="menu-icon" onclick="toggleMenu()">
            &#9776; 
        </div>

        <!-- Navigation Bar -->
        <nav class="nav-bar">
            <ul>
                <li><a href="/COM6011/index.php">Home</a></li>
                <li><a href="/COM6011/courses.php">Courses</a></li>
                <li><a href="/COM6011/admin/index.php">Admin</a></li>
            </ul>
        </nav>
    </div>

   
    <div class="auth-container">
        <?php if (isset($_SESSION['username'])): ?>
            <p class="greeting">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <?php endif; ?>
        
        <div class="sign-in-btn">
            <?php
            if (isset($_SESSION['username'])) {
                echo "<a href='/COM6011/logout.php'>Logout</a>"; 
            } else {
                echo "<a href='/COM6011/login.php'>Sign In</a>"; 
            }
            ?>
        </div>
    </div>
</header>
<script src="script.js"></script>



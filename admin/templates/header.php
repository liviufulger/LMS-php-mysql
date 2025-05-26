<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: /COM6011/login.php');
    exit();
}


if ($_SESSION['role'] !== 'admin') {
    echo "<p>You must be an admin to access the dashboard. Please contact your administrator or log in with an admin account.</p>";
    echo "<a href='/COM6011/index.php'>Return to Home</a>"; 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteFury - Admin Dashboard</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">

</head>
<body>

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1><a href="./index.php">ByteFury - CMS</a></h1>
                <p><?php echo "Welcome to the Admin Dashboard, " . $_SESSION['username']. "!";?></p>
            </div>
            <nav class="menu-list">
                <ul>
                
                <li><a href="manage_courses.php">Manage Courses</a></li>
                <li><a href="manage_lessons.php">Manage Lessons</a></li>
                <li><a href="manage_quizzes.php">Manage Quizzes</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="/COM6011/">Visit Website</a></li>
                </ul>
            </nav>
            <div class="sign-in-btn">
            <?php
            if (isset($_SESSION['username'])) {
                echo "<a href='../logout.php'>Logout</a>"; 
            } else {
                echo "<a href='../login.php'>Sign In</a>"; 
            }
            ?>
        </div>
        </aside>
        
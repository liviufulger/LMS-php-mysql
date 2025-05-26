<?php
include "templates/header.php";
include "../connect.php";


// Fetching courses from the database
$coursesQuery = "SELECT * FROM courses";
$coursesResult = mysqli_query($conn, $coursesQuery);

// Fetching lessons from the database
$lessonsQuery = "SELECT * FROM lessons";
$lessonsResult = mysqli_query($conn, $lessonsQuery);

// Fetching quizzes from the database
$quizzesQuery = "SELECT * FROM quizzes";
$quizzesResult = mysqli_query($conn, $quizzesQuery);


?>


    <div class="dashboard">
   
        <main class="main-content">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>This is the Admin Dashboard where you can manage courses, lessons, and quizzes.</p>
    </main>
    </div>

</body>
</html>

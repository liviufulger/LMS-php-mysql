<?php
include'header.php'; 
include"connect.php";
?>

<main class="courses-section">
    <h2 class="courses-title">Explore Our Courses</h2>
    <p class="courses-subtitle">Level up your programming skills with our expertly crafted courses.</p>

    <div class="courses-list">
        <?php
            // Fetch all courses from the database
            $sqlSelect = "SELECT * FROM courses";
            $result = mysqli_query($conn, $sqlSelect);
            while ($course = mysqli_fetch_array($result)) {
        ?>
            <div class="course-card">
                <img src="<?php echo $course['image_path']; ?>" alt="Course Thumbnail" class="course-image">
                <div class="course-info">
                    <h3 class="course-title"><?php echo ($course['title']); ?></h3>
                    <p class="course-description"><?php echo substr(($course['description']), 0, 100); ?>...</p>
                    <div class="flex">
                        <p class="course-details"><?php echo ($course['modules']); ?> Lessons</p>
                        <!-- Redirect to lessons.php with course ID -->
                        <a href="lessons.php?course_id=<?php echo $course['id']; ?>" class="view-lessons-btn">View Lessons</a>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
    </div>
</main>

<?php include'footer.php'; // Include footer dynamically ?>

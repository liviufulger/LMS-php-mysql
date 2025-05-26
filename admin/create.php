<?php
include "templates/header.php";

$showForm = isset($_GET['form']) ? $_GET['form'] : null;
?>

<div class="dashboard">
    <div class="main-content">
        <h2>Create New Entities</h2>


        <!-- Create Course Form -->
        <div id="courseForm" class="create-form"
            style="display: <?php echo ($showForm == 'courseForm') ? 'block' : 'none'; ?>;">
            <h3>Create a New Course</h3>
            <form action="process.php" method="POST">
                <input type="hidden" name="action" value="create_course">
                <label for="title">Course Title:</label>
                <input type="text" name="title" id="title" required><br>

                <label for="description">Course Description:</label>
                <textarea name="description" id="description" required></textarea><br>

                <label for="modules">Number of Modules:</label>
                <input type="number" name="modules" id="modules" required><br>

                <label for="hours">Total Hours:</label>
                <input type="number" name="hours" id="hours" required><br>

                <label for="image_path">Image Path:</label>
                <input type="text" name="image_path" id="image_path" required><br>

                <button type="submit" name="submit">Create Course</button>
            </form>
        </div>

        <!-- Create Lesson Form -->
        <div id="lessonForm" class="create-form"
            style="display: <?php echo ($showForm == 'lessonForm') ? 'block' : 'none'; ?>;">
            <h3>Create a New Lesson</h3>
            <form action="process.php" method="POST">
                <input type="hidden" name="action" value="create_lesson">
                <label for="title">Lesson Title:</label>
                <input type="text" name="title" id="title" required><br>

                <label for="content">Lesson Content:</label>
                <textarea name="content" id="content" required></textarea><br>

                <label for="course_id">Select Course:</label>
                <select name="course_id" id="course_id" required>
                    <option value="">-- Select Course --</option>
                    <?php
                    // Fetch courses for dropdown
                    include "../connect.php";
                    $coursesQuery = "SELECT * FROM courses";
                    $coursesResult = mysqli_query($conn, $coursesQuery);
                    while ($course = mysqli_fetch_assoc($coursesResult)) {
                        echo "<option value='" . $course['id'] . "'>" . htmlspecialchars($course['title']) . "</option>";
                    }
                    ?>
                </select><br>

                <button type="submit" name="submit">Create Lesson</button>
            </form>
        </div>

        <!-- Create Quiz Form -->
        <div id="quizForm" class="create-form"
            style="display: <?php echo ($showForm == 'quizForm') ? 'block' : 'none'; ?>;">
            <h3>Create a New Quiz</h3>
            <form action="process.php" method="POST">
                <input type="hidden" name="action" value="create_quiz">
                <label for="question">Quiz Question:</label>
                <input type="text" name="question" id="question" required><br>

                <label for="options">Quiz Options (comma separated):</label>
                <input type="text" name="options" id="options" required><br>

                <label for="correct_option">Correct Option:</label>
                <input type="text" name="correct_option" id="correct_option" required><br>

                <label for="lesson_id">Select Lesson:</label>
                <select name="lesson_id" id="lesson_id" required>
                    <option value="">-- Select Lesson --</option>
                    <?php
                    // Fetch lessons for dropdown
                    $lessonsQuery = "SELECT * FROM lessons";
                    $lessonsResult = mysqli_query($conn, $lessonsQuery);
                    while ($lesson = mysqli_fetch_assoc($lessonsResult)) {
                        echo "<option value='" . $lesson['id'] . "'>" . htmlspecialchars($lesson['title']) . "</option>";
                    }
                    ?>
                </select><br>

                <button type="submit" name="submit">Create Quiz</button>
            </form>
        </div>
    </div>
</div>

<?php
include "templates/footer.php";
?>

<!-- JavaScript to toggle forms -->
<script>
    function showForm(formId) {
        // Hide all forms first
        const forms = document.querySelectorAll('.create-form');
        forms.forEach(form => {
            form.style.display = 'none';  // Hide all forms
        });

        // Show only the selected form
        document.getElementById(formId).style.display = 'block';  // Show selected form
    }
</script>
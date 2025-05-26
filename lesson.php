<?php
include('header.php');
include("connect.php"); 

// Get the lesson_id from the URL
$lesson_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Fetch lesson details from the database
$lessonQuery = "SELECT * FROM lessons WHERE id = ?";
$stmt = $conn->prepare($lessonQuery);
$stmt->bind_param("i", $lesson_id);
$stmt->execute();
$lessonResult = $stmt->get_result();
$lesson = $lessonResult->fetch_assoc();

// Mark lesson as completed if the user is logged in and has not completed it yet
if ($userId) {
    $checkCompletionQuery = "SELECT * FROM user_progress WHERE user_id = ? AND lesson_id = ? AND completed = 1";
    $stmt = $conn->prepare($checkCompletionQuery);
    $stmt->bind_param("ii", $userId, $lesson_id);
    $stmt->execute();
    $completionResult = $stmt->get_result();

    if ($completionResult->num_rows === 0) {
        $markCompletionQuery = "INSERT INTO user_progress (user_id, course_id, lesson_id, completed, updated_at)
                                VALUES (?, ?, ?, 1, NOW())
                                ON DUPLICATE KEY UPDATE completed = 1, updated_at = NOW()";
        $stmt = $conn->prepare($markCompletionQuery);
        $stmt->bind_param("iii", $userId, $lesson['course_id'], $lesson_id);
        $stmt->execute();
    }
}
$stmt->close();


// Fetch quiz questions for the lesson 
$quizQuery = "SELECT * FROM quizzes WHERE lesson_id = ?";
$stmt = $conn->prepare($quizQuery);
$stmt->bind_param("i", $lesson_id);
$stmt->execute();
$quizResult = $stmt->get_result();

$stmt->close(); // Close statement

?>

<main class="lesson-content">
    <article class="lesson-article">
        <h2 class="lesson-title"><?php echo $lesson['title']; ?></h2>
        <p class="lesson-text"><?php echo nl2br($lesson['content']); ?></p>
    </article>

    <?php if ($quizResult->num_rows > 0): ?>
        <section class="quiz-section">
            <h2>Lesson Quiz</h2>

            <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $lesson_id . '&submitted=1'; ?>" method="post">
                <?php
                $question_number = 1;
                while ($quiz = $quizResult->fetch_assoc()) {
                    $options = json_decode($quiz['options'], true); // Decode the JSON options
                    ?>
                    <div class='quiz-question'>
                        <h3>Question <?php echo $question_number; ?>: <?php echo htmlspecialchars($quiz['question']); ?></h3>
                        <?php foreach ($options as $option): ?>
                            <div>
                                <input type='radio' name='question_<?php echo $quiz['id']; ?>' value='<?php echo htmlspecialchars($option); ?>' required>
                                <?php echo htmlspecialchars($option); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php
                    $question_number++;
                }
                ?>
                <button class="quiz-button" type="submit" name="submit_quiz">Submit Quiz</button>
            </form>
        </section>
    <?php endif; ?>

    <?php
    // Handle quiz submission
    if (isset($_POST['submit_quiz'])) {
        $score = 0;
        $total_questions = 0;

        foreach ($_POST as $question_key => $selected_option) {
            if (strpos($question_key, 'question_') === 0) {
                $total_questions++;
                $quiz_id = str_replace('question_', '', $question_key);

                // Fetch the correct answer for the question
                $stmt = $conn->prepare("SELECT correct_option FROM quizzes WHERE id = ?");
                $stmt->bind_param("i", $quiz_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $quiz = $result->fetch_assoc();
                $stmt->close();

                if ($selected_option == $quiz['correct_option']) {
                    $score++;
                }
            }
        }

        // Check for the next lesson
        $nextLessonQuery = "SELECT * FROM lessons WHERE course_id = ? AND id > ? ORDER BY id ASC LIMIT 1";
        $stmt = $conn->prepare($nextLessonQuery);
        $stmt->bind_param("ii", $lesson['course_id'], $lesson_id);
        $stmt->execute();
        $nextLessonResult = $stmt->get_result();
        $nextLesson = $nextLessonResult->fetch_assoc();
        ?>

        <div id='quiz-result' class='quiz-result'>
            <h1>Your Score: <?php echo $score; ?> / <?php echo $total_questions; ?></h1>
            <a href='index.php' class='btn'>Back to Courses</a>
            <a href="lessons.php?course_id=<?php echo $lesson['course_id']; ?>" class="btn">Back to Lessons</a>
            
            <?php if ($nextLesson): ?>
                <a href="lesson.php?id=<?php echo $nextLesson['id']; ?>" class="btn">Next Lesson</a>
            <?php else: ?>
                <p>Congratulations! You've completed all lessons in this course.</p>
            <?php endif; ?>
        </div>
        <?php
    }
    ?>
    
</main>

<?php include'footer.php'; ?>

<script>
    if (window.location.search.includes('submitted=1')) { 
        document.getElementById("quiz-result").scrollIntoView({ behavior: "smooth" });
    }
</script>

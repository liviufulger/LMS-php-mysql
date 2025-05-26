<?php
include 'header.php'; 
include 'connect.php'; 

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Fetch course details
$courseQuery = "SELECT * FROM courses WHERE id = ?";
$stmt = $conn->prepare($courseQuery);
$stmt->bind_param('i', $course_id);
$stmt->execute();
$courseResult = $stmt->get_result();
$course = $courseResult->fetch_assoc();

// Fetch all lessons for the course
$lessonsQuery = "SELECT * FROM lessons WHERE course_id = ? ORDER BY lesson_order ASC";
$stmt = $conn->prepare($lessonsQuery);
$stmt->bind_param('i', $course_id);
$stmt->execute();
$lessonsResult = $stmt->get_result();

// Fetch user’s completed lessons for unlocking
$completedLessons = [];
if ($userId) {
    $progressQuery = "SELECT lesson_id FROM user_progress WHERE user_id = ? AND course_id = ? AND completed = 1";
    $stmt = $conn->prepare($progressQuery);
    $stmt->bind_param('ii', $userId, $course_id);
    $stmt->execute();
    $progressResult = $stmt->get_result();

    while ($row = $progressResult->fetch_assoc()) {
        $completedLessons[] = $row['lesson_id'];
    }
}
$stmt->close();
?>

<main class="lessons-section">
    <h2 class="lessons-course-title"><?php echo htmlspecialchars($course['title']); ?></h2>
    <p class="lessons-subtitle"><?php echo htmlspecialchars($course['description']); ?></p>

    <div class="lessons-list">
        <?php
        $isUnlocked = true; // The first lesson is unlocked for all users, including guests.
        while ($lesson = $lessonsResult->fetch_assoc()) {
            $lessonId = $lesson['id'];
            $lessonTitle = htmlspecialchars($lesson['title']);
            $isCompleted = in_array($lessonId, $completedLessons);

            // Determine CSS class for unlocked/locked status
            $cardClass = $isUnlocked ? 'unlocked' : 'locked';

            // Check if the lesson is unlocked (first lesson or previous lessons are completed)
            if ($isUnlocked) {
                $lessonLink = "<a href='lesson.php?id={$lessonId}' class='start-lesson-btn'>Start Lesson</a>";
            } else {
                $lessonLink = $userId
                    ? "<span class='locked-lesson'>Locked - Complete previous lessons</span>"
                    : "<a href='/COM6011/signup.php' class='locked-lesson'>Register to Unlock</a>";
            }

            echo "<div class='lessons-card {$cardClass}'>
                    <h3 class='lessons-title'>{$lessonTitle}</h3>
                    {$lessonLink}
                  </div>";

            // Set the next lesson as unlocked if this one is completed
            $isUnlocked = $userId ? in_array($lessonId, $completedLessons) : false;
        }
        ?>
    </div>
</main>


<?php include 'footer.php'; ?>

<style>
/* .lessons-card {
    position: relative;
    padding: 20px;
    margin: 12px 0;

    border-radius: 8px;
    transition: border-color 0.3s ease;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
} */


</style>
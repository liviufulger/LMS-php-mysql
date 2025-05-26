<?php
include "templates/header.php";
include "../connect.php";

// Get entity type and ID from URL
$entity = isset($_GET['entity']) ? $_GET['entity'] : null;
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($entity && $id) {
    // Determine table and query based on the entity
    switch ($entity) {
        case 'course':
            $query = "SELECT * FROM courses WHERE id = ?";
            break;
        case 'lesson':
            $query = "SELECT * FROM lessons WHERE id = ?";
            break;
        case 'quiz':
            $query = "SELECT * FROM quizzes WHERE id = ?";
            break;
        default:
            echo "Invalid entity!";
            exit();
    }

    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if data exists
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "No record found for this ID.";
        exit();
    }
} else {
    echo "Invalid request. Entity or ID is missing.";
    exit();
}
?>
<div class="dashboard">
<div class="main-content">
    <?php if ($entity == 'course'): ?>
        <h2>Course Details</h2>
        <p><strong>Title:</strong> <?php echo htmlspecialchars($data['title']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($data['description']); ?></p>
        <p><strong>Modules:</strong> <?php echo htmlspecialchars($data['modules']); ?></p>
        <p><strong>Hours:</strong> <?php echo htmlspecialchars($data['hours']); ?></p>
        <p><strong>Image Path:</strong> <?php echo htmlspecialchars($data['image_path']); ?></p>

    <?php elseif ($entity == 'lesson'): ?>
        <h2>Lesson Details</h2>
        <p><strong>Title:</strong> <?php echo htmlspecialchars($data['title']); ?></p>
        <p><strong>Content:</strong> <?php echo nl2br(htmlspecialchars($data['content'])); ?></p>
        <p><strong>Course ID:</strong> <?php echo htmlspecialchars($data['course_id']); ?></p>

    <?php elseif ($entity == 'quiz'): ?>
        <h2>Quiz Details</h2>
        <p><strong>Question:</strong> <?php echo htmlspecialchars($data['question']); ?></p>
        <p><strong>Options:</strong> <?php echo implode(', ', json_decode($data['options'], true)); ?></p>
        <p><strong>Correct Option:</strong> <?php echo htmlspecialchars($data['correct_option']); ?></p>
        <p><strong>Lesson ID:</strong> <?php echo htmlspecialchars($data['lesson_id']); ?></p>

    <?php endif; ?>
    </div>
</div>

<?php include "templates/footer.php"; ?>

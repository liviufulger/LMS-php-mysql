<?php
// Start the session to handle flash messages
session_start();

// Check if entity and ID are passed in the URL
$entity = isset($_GET['entity']) ? $_GET['entity'] : null;
$id = isset($_GET['id']) ? (int)$_GET['id'] : null; // Cast to int for safety

if ($entity && $id) {
    include "../connect.php";

    // Use a switch statement to delete from the appropriate table based on the entity
    switch ($entity) {
        case 'course':
            $sqlDelete = "DELETE FROM courses WHERE id = ?";
            break;
        case 'lesson':
            $sqlDelete = "DELETE FROM lessons WHERE id = ?";
            break;
        case 'quiz':
            $sqlDelete = "DELETE FROM quizzes WHERE id = ?";
            break;
        default:
            echo "Invalid entity!";
            exit();
    }

    // Prepare and execute the delete query
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $id); // Bind the id as an integer

    if ($stmt->execute()) {
        // Set a flash message to notify about successful deletion
        $_SESSION['delete'] = ucfirst($entity) . " deleted successfully.";

        // Redirect to the correct management page and exit
        switch ($entity) {
            case 'course':
                header("Location: manage_courses.php");
                exit();  // Exit immediately after header
            case 'lesson':
                header("Location: manage_lessons.php");
                exit();  // Exit immediately after header
            case 'quiz':
                header("Location: manage_quizzes.php");
                exit();  // Exit immediately after header
        }
    } else {
        // Handle the error if deletion failed
        die("Error deleting $entity: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle case when entity or ID is missing
    echo "Invalid request. Entity or ID missing.";
    exit();
}

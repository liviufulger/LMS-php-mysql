<?php
include "../connect.php";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Identify which action is being performed (course, lesson, quiz creation)
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create_course':
                createCourse($conn);
                break;
            
            case 'create_lesson':
                createLesson($conn);
                break;

            case 'create_quiz':
                createQuiz($conn);
                break;

            default:
                echo "Invalid action!";
        }
    }
}

// Function to create a new course
function createCourse($conn) {
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['modules']) && isset($_POST['hours']) && isset($_POST['image_path'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $modules = $_POST['modules'];
        $hours = $_POST['hours'];
        $image_path = $_POST['image_path'];

        // Prepared statement to insert the course into the database
        $stmt = $conn->prepare("INSERT INTO courses (title, description, modules, hours, image_path) VALUES (?, ?, ?, ?, ?)");
        // Bind the parameters (ssii stands for string, string, int, int, string)
        $stmt->bind_param("ssiis", $title, $description, $modules, $hours, $image_path);

        if ($stmt->execute()) {
            echo "Course created successfully!";
            header("Location: manage_courses.php"); // Redirect to manage courses page
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}


// Function to create a new lesson
function createLesson($conn) {
    if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['course_id'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $course_id = $_POST['course_id'];

        // Prepared statement to insert the lesson into the database
        $stmt = $conn->prepare("INSERT INTO lessons (title, content, course_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $content, $course_id);

        if ($stmt->execute()) {
            echo "Lesson created successfully!";
            header("Location: manage_lessons.php"); // Redirect to manage lessons page
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Function to create a new quiz
function createQuiz($conn) {
    if (isset($_POST['question']) && isset($_POST['options']) && isset($_POST['correct_option']) && isset($_POST['lesson_id'])) {
        $question = $_POST['question'];
        $options = explode(',', $_POST['options']);  // Splitting the options into an array
        $options_json = json_encode($options);  // Converting the array to JSON
        $correct_option = $_POST['correct_option'];
        $lesson_id = $_POST['lesson_id'];

        // Prepared statement to insert the quiz into the database
        $stmt = $conn->prepare("INSERT INTO quizzes (question, options, correct_option, lesson_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $question, $options_json, $correct_option, $lesson_id);

        if ($stmt->execute()) {
            echo "Quiz created successfully!";
            header("Location: manage_quizzes.php"); // Redirect to manage quizzes page
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}



// Check if the update form was submitted
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $entity = $_POST['entity'];

    // Perform the update based on the entity
    switch ($entity) {
        case 'course':
            // Update course
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image_path = $_POST['image_path'];
            $modules = $_POST['modules'];
            $hours = $_POST['hours'];

            $stmt = $conn->prepare("UPDATE courses SET title = ?, description = ?, image_path = ?, modules = ?, hours = ? WHERE id = ?");
            $stmt->bind_param("sssiii", $title, $description, $image_path, $modules, $hours, $id);
            if ($stmt->execute()) {
                header("Location: manage_courses.php");
                exit();
            } else {
                echo "Error updating course: " . $stmt->error;
            }
            $stmt->close();
            break;

        case 'lesson':
            // Update lesson
            $title = $_POST['title'];
            $content = $_POST['content'];
            $course_id = $_POST['course_id'];

            $stmt = $conn->prepare("UPDATE lessons SET title = ?, content = ?, course_id = ? WHERE id = ?");
            $stmt->bind_param("ssii", $title, $content, $course_id, $id);
            if ($stmt->execute()) {
                header("Location: manage_lessons.php");
                exit();
            } else {
                echo "Error updating lesson: " . $stmt->error;
            }
            $stmt->close();
            break;

        case 'quiz':
            // Update quiz
            $question = $_POST['question'];
            $options = json_encode(explode(",", $_POST['options'])); // Convert to JSON
            $correct_option = $_POST['correct_option'];
            $lesson_id = $_POST['lesson_id'];

            $stmt = $conn->prepare("UPDATE quizzes SET question = ?, options = ?, correct_option = ?, lesson_id = ? WHERE id = ?");
            $stmt->bind_param("sssii", $question, $options, $correct_option, $lesson_id, $id);
            if ($stmt->execute()) {
                header("Location: manage_quizzes.php");
                exit();
            } else {
                echo "Error updating quiz: " . $stmt->error;
            }
            $stmt->close();
            break;
    }
}

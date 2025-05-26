<?php
include "templates/header.php";

// Get the entity and id from the URL
$entity = isset($_GET['entity']) ? $_GET['entity'] : null;
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if ($entity && $id) {
    include "../connect.php";

    // Use a switch to select the correct table based on the entity
    switch ($entity) {
        case 'course':
            $sqlEdit = "SELECT * FROM courses WHERE id = ?";
            break;
        case 'lesson':
            $sqlEdit = "SELECT * FROM lessons WHERE id = ?";
            break;
        case 'quiz':
            $sqlEdit = "SELECT * FROM quizzes WHERE id = ?";
            break;
        default:
            echo "Invalid entity!";
            exit();
    }

    // Prepare and execute the query
    $stmt = $conn->prepare($sqlEdit);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if data is found
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "No record found.";
        exit();
    }
}
?>
<div class="dashboard">
    <div class="main-content">
        <div class="edit-form w-100 mx-auto p-4" style="max-width:700px;">
            <form action="process.php" method="post">
                <input type="hidden" name="entity" value="<?php echo $entity; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="content" id="hiddenContent">

                <?php if ($entity == 'course'): ?>
                    <h3>Edit Course</h3>
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($data['title']); ?>"
                        required>

                    <label for="description">Description</label>
                    <textarea id="description" name="description"
                        required><?php echo htmlspecialchars($data['description']); ?></textarea>

                    <label for="image_path">Image Path</label>
                    <input type="text" id="image_path" name="image_path"
                        value="<?php echo htmlspecialchars($data['image_path']); ?>">

                    <label for="modules">Modules</label>
                    <input type="number" id="modules" name="modules"
                        value="<?php echo htmlspecialchars($data['modules']); ?>" required>

                    <label for="hours">Hours</label>
                    <input type="number" id="hours" name="hours" value="<?php echo htmlspecialchars($data['hours']); ?>"
                        required>

                <?php endif; ?>

                <?php if ($entity == 'lesson'): ?>

                    <h3>Edit Lesson</h3>
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($data['title']); ?>"
                        required>


                    <label for="content">Content</label>
                    <textarea id="content" name="content"
                        required><?php echo htmlspecialchars($data['content']); ?></textarea>



                    <label for="course_id">Course ID</label>
                    <input type="number" id="course_id" name="course_id"
                        value="<?php echo htmlspecialchars($data['course_id']); ?>" required>

                <?php endif; ?>

                <?php if ($entity == 'quiz'): ?>
                    <h3>Edit Quiz</h3>
                    <label for="question">Question</label>
                    <input type="text" id="question" name="question"
                        value="<?php echo htmlspecialchars($data['question']); ?>" required>

                    <label for="options">Options (comma-separated)</label>
                    <textarea id="options" name="options"
                        required><?php echo implode(', ', json_decode($data['options'], true)); ?></textarea>

                    <label for="correct_option">Correct Option</label>
                    <input type="text" id="correct_option" name="correct_option"
                        value="<?php echo htmlspecialchars($data['correct_option']); ?>" required>

                    <label for="lesson_id">Lesson ID</label>
                    <input type="number" id="lesson_id" name="lesson_id"
                        value="<?php echo htmlspecialchars($data['lesson_id']); ?>" required>

                <?php endif; ?>


                <button type="submit" name="update">Update</button>
            </form>
        </div>
    </div>
</div>


<script>
    // Initialize Quill editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],        // Toggle formatting options
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],      // List formatting options
                ['link', 'image']                                 // Insert link and image options
            ]
        }
    });

    // Update the hidden input with the Quill editor content when the form is submitted
    document.querySelector('form').onsubmit = function () {
        var content = quill.root.innerHTML; // Get the HTML content of the Quill editor
        document.getElementById('hiddenContent').value = content; // Set it in the hidden input field
    };
</script>


<?php
include "templates/footer.php";
?>
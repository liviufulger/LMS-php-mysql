<?php
include "templates/header.php";
include "../connect.php";

// Fetching courses from the database
$lessonsQuery = "SELECT * FROM lessons";
$lessonsResult = mysqli_query($conn, $lessonsQuery);
?>

<div class="dashboard">
    <main class="main-content">
        <h2>Manage Lessons</h2>
        <p>Below are the available lessons. You can add, edit, or delete lessons:</p>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Lesson Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($lessonsResult) > 0) {
                    while ($lesson = mysqli_fetch_assoc($lessonsResult)) {
                        echo "<tr><td>" . htmlspecialchars($lesson['title']) . "</td>
              <td>
                  <a href='view.php?entity=lesson&id=" . $lesson['id'] . "' class='view-btn'>View</a>
                  <a href='edit.php?entity=lesson&id=" . $lesson['id'] . "' class='edit-btn'>Edit</a>
                  <a href='delete.php?entity=lesson&id=" . $lesson['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this course?\");'>Delete</a>
              </td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No lessons found.</td></tr>";
                }
                ?>

            </tbody>
        </table>
        
        <button onclick="window.location.href='create.php?form=lessonForm'">Create New Lesson</button>
    </main>
</div>
</body>

</html>
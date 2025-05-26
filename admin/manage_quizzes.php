<?php
include "templates/header.php";
include "../connect.php";

// Fetching courses from the database
$quizzesQuery = "SELECT * FROM quizzes";
$quizzesResult = mysqli_query($conn, $quizzesQuery);
?>

<div class="dashboard">
        <main class="main-content">
            <h2>Manage Quizzes</h2>
            <p>Below are the available quizzes. You can add, edit, or delete quizzes:</p>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Quiz Question</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($quizzesResult) > 0) {
                        while ($quiz = mysqli_fetch_assoc($quizzesResult)) {
                            echo "<tr><td>" . htmlspecialchars($quiz['question']) . "</td>
                            <td>
                                <a href='view.php?entity=quiz&id=" . $quiz['id'] . "' class='view-btn'>View</a>
                                <a href='edit.php?entity=quiz&id=" . $quiz['id'] . "' class='edit-btn'>Edit</a>
                               <a href='delete.php?entity=quiz&id=" . $quiz['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this course?\");'>Delete</a>
                            </td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No quizzes found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button onclick="window.location.href='create.php?form=quizForm'">Create New Quiz</button>
        </main>
    </div>
</body>
</html>

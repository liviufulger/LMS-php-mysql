<?php
include "templates/header.php";
include "../connect.php";

// Fetching courses from the database
$coursesQuery = "SELECT * FROM courses";
$coursesResult = mysqli_query($conn, $coursesQuery);

?>


<style>


#showFormBtn {
    background-color: #007acc;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    display: block;
    margin: 20px auto;
    transition: background-color 0.3s;
}

#showFormBtn:hover {
    background-color: #005f99;
}


</style>

    <div class="dashboard">
        <main class="main-content" >
            <h2>Manage Courses</h2>
            <p>Below are the available courses. You can add, edit, or delete courses:</p>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Course Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
if (mysqli_num_rows($coursesResult) > 0) {
    while ($course = mysqli_fetch_assoc($coursesResult)) {
        echo "<tr><td>" . htmlspecialchars($course['title']) . "</td>
              <td>
                  <a href='view.php?entity=course&id=" . $course['id'] . "' class='view-btn'>View</a>
                  <a href='edit.php?entity=course&id=" . $course['id'] . "' class='edit-btn'>Edit</a>
                  <a href='delete.php?entity=course&id=" . $course['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this course?\");'>Delete</a>
              </td></tr>";
    }
} else {
    echo "<tr><td colspan='2'>No courses found.</td></tr>";
}
?>

                </tbody>
            </table>
            <button onclick="window.location.href='create.php?form=courseForm'">Create New Course</button>

        </main>
    </div>



</body>
</html>

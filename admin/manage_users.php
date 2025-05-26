<?php
include "templates/header.php";
include "../connect.php";

// Define variables for the actions and confirmation messages
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$message = ""; // Variable to store confirmation message

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Update user query
    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $email, $role, $id);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>User updated successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error updating user: " . htmlspecialchars($stmt->error) . "</div>";
    }
    $stmt->close();
}

// Handle delete action
if ($action === 'delete' && $id) {
    // Delete user query
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $message = "<div class='alert alert-success'>User deleted successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error deleting user: " . htmlspecialchars($stmt->error) . "</div>";
    }
    $stmt->close();
}

// Fetch all users for the table display
$sqlSelectUsers = "SELECT * FROM users";
$usersResult = mysqli_query($conn, $sqlSelectUsers);
?>

<div class="dashboard">
    <main class="main-content">
        <h2>Manage Users</h2>

        <!-- Display Confirmation Message -->
        <?php if ($message): ?>
            <div class="confirmation-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- User Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($usersResult) > 0) {
                    while ($user = mysqli_fetch_assoc($usersResult)) {
                        echo "<tr>
                            <td>" . htmlspecialchars($user['username']) . "</td>
                            <td>" . htmlspecialchars($user['email']) . "</td>
                            <td>" . htmlspecialchars($user['role']) . "</td>
                            <td>
                                <a href='manage_users.php?action=edit&id=" . $user['id'] . "' class='edit-btn'>Edit</a>
                                <a href='manage_users.php?action=delete&id=" . $user['id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                            </td>
                          </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Edit User Form -->
        <?php if ($action === 'edit' && $id): ?>
            <?php
            // Fetch the user details for editing
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = $result->fetch_assoc();
            $stmt->close();
            ?>
            <div class="edit-form" style="max-width:700px;">
                <h3>Edit User</h3>
                <form action="manage_users.php?action=edit&id=<?php echo $id; ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username"
                            value="<?php echo htmlspecialchars($userData['username']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"
                            value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            <option value="user" <?php if ($userData['role'] === 'user')
                                echo 'selected'; ?>>User</option>
                            <option value="admin" <?php if ($userData['role'] === 'admin')
                                echo 'selected'; ?>>Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update_user">Update User</button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </main>
</div>

<?php
include "templates/footer.php";
?>

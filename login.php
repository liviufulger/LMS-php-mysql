<?php
include 'header.php';
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Store the intended redirect page in a session variable
            $_SESSION['redirect_url'] = ($user['role'] === 'admin') ? '/COM6011/admin/index.php' : '/COM6011/index.php';
            $_SESSION['login_success'] = true;
        } else {
            $error = "Invalid credentials!";
        }
    } else {
        $error = "User not found!";
    }
}
?>

<?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php elseif (isset($_SESSION['login_success']) && $_SESSION['login_success']): ?>
        <p>Login successful! Redirecting...</p>
        
        <script>
            setTimeout(() => {
                window.location.href = "<?php echo $_SESSION['redirect_url']; ?>";
            }, 500); 
        </script>
    <?php endif; ?>

<style>
   /* Centering Container */
.login-container-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px; /* Added padding for larger screens */
}

/* Login Form Container */
.login-container {
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

/* Form Header */
.login-container h2 {
    font-size: 28px;
    font-weight: 600;
    color: #4A90E2;
    margin-bottom: 20px;
}

/* Input Fields */
.login-input {
    padding: 12px 15px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 100%;
    margin-bottom: 10px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

/* Input Focus Styling */
.login-input:focus {
    outline: none;
    border-color: #FFC107; /* Yellow border on focus */
    box-shadow: 0 0 8px rgba(255, 193, 7, 0.3); /* Yellow glow */
}

/* Login Button */
.login-button {
    margin-top: 20px;
    width: 50%;
    background-color: #FFC107; /* Yellow background */
    color: #333;
    font-weight: 600;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

/* Login Button Hover */
.login-button:hover {
    background-color: #FFB300; /* Darker yellow */
    transform: translateY(-3px) scale(1.05); /* Slight scaling effect */
}

/* Register Text Styling */
.register-text {
    margin-top: 20px;
    font-size: 14px;
    color: #555;
}

/* Register Link Styling */
.register-text a {
    color: #FFC107;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

/* Register Link Hover */
.register-text a:hover {
    color: #FFB300;
    text-decoration: underline;
}

/* Larger Font Adjustments for Bigger Screens */
@media (min-width: 768px) {
    .login-container h2 {
        font-size: 32px;
    }

    .login-input {
        font-size: 18px;
    }

    .login-button {
        font-size: 18px;
    }
}

</style>
<div class="login-container-wrapper">
    <div class="login-container">
        <h2>Sign in!</h2>
        <form action="login.php" method="POST" class="login-form">
            <input type="text" name="username" placeholder="Username or Email" required class="login-input"><br>
            <input type="password" name="password" placeholder="Password" required class="login-input"><br>
            <button type="submit" name="submit" class="login-button">Login</button>
        </form>
        
        
        <p class="register-text">Don't have an account? <a href="signup.php">Register here</a></p>
    </div>
</div>


    <?php include'footer.php'; ?>

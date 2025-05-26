<?php
include 'header.php';
include 'connect.php'; 

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $role = 'user'; // Assign role 'user' by default

    // Check if username or email already exists
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "Username or Email already exists.";
    } else {
        // Insert new user with a role
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $username, $email, $password, $role);
        
        if ($stmt->execute()) {
            echo "Registration successful!";
            header("Location: /COM6011/login.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
<style>
/* Centering Container */
.signup-container-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px; /* Added padding for larger screens */
}

/* Signup Form Container */
.signup-container {
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

/* Form Header */
.signup-container h2 {
    font-size: 28px;
    font-weight: 600;
    color: #4A90E2;
    margin-bottom: 20px;
}



/* Input Fields */
.signup-input {
    padding: 12px 15px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 100%;
    margin-bottom: 10px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

/* Input Focus Styling */
.signup-input:focus {
    outline: none;
    border-color: #FFC107; /* Yellow border on focus */
    box-shadow: 0 0 8px rgba(255, 193, 7, 0.3); /* Yellow glow */
}

/* Signup Button */
.signup-button {
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

/* Signup Button Hover */
.signup-button:hover {
    background-color: #FFB300; /* Darker yellow */
    transform: translateY(-3px) scale(1.05); /* Slight scaling effect */
}

/* Login Text Styling */
.login-text {
    margin-top: 20px;
    font-size: 14px;
    color: #555;
}

/* Login Link Styling */
.login-text a {
    color: #FFC107;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

/* Login Link Hover */
.login-text a:hover {
    color: #FFB300;
    text-decoration: underline;
}

/* Larger Font Adjustments for Bigger Screens */
@media (min-width: 768px) {
    .signup-container h2 {
        font-size: 32px;
    }

    .signup-input {
        font-size: 18px;
    }

    .signup-button {
        font-size: 18px;
    }
}

</style>


<div class="signup-container-wrapper">
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form action="signup.php" method="POST" class="signup-form">
            <input type="text" name="username" placeholder="Username" required class="signup-input"><br>
            <input type="email" name="email" placeholder="Email" required class="signup-input"><br>
            <input type="password" name="password" placeholder="Password" required class="signup-input"><br>
            <button type="submit" name="submit" class="signup-button">Sign Up</button>
        </form>
        
        
        <p class="login-text">Already have an account? <a href="/COM6011/login.php">Login here</a></p>
    </div>
</div>

<?php include'footer.php'; ?>
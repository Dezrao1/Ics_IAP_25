<?php
// process_signin.php
require_once 'Services/db.php'; // Changed from 'Service/db.php'

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email) || empty($password)) {
        header("Location: signin.php?error=All fields are required");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signin.php?error=Invalid email format");
        exit();
    }

    // Check if user exists
    $sql = "SELECT id, username, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['loggedin'] = true;
            
            header("Location: index.php?login=success");
            exit();
        } else {
            header("Location: signin.php?error=Invalid email or password");
            exit();
        }
    } else {
        header("Location: signin.php?error=Invalid email or password");
        exit();
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: signin.php");
    exit();
}
?>
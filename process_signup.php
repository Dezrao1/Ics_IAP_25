<?php
// process_signup.php
require_once 'Services/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validate inputs
    if (empty($username) || empty($email) || empty($_POST['password'])) {
        die("All fields are required");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Insert into database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);
    
    if ($stmt->execute()) {
        header("Location: index.php?signup=success");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
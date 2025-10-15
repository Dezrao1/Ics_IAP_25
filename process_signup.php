<?php
// process_signup.php
session_start();

// Check if ClassAutoLoad.php exists before requiring it
if (!file_exists('ClassAutoLoad.php')) {
    $_SESSION['signup_error'] = "System configuration error. Please contact support.";
    header("Location: signup.php");
    exit();
}

require_once 'ClassAutoLoad.php';

// Process form submission - check if request method is set first
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate that all required fields are present
    if (!isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password'])) {
        $_SESSION['signup_error'] = "Please fill in all required fields.";
        header("Location: signup.php");
        exit();
    }
    
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Generate verification token
    $token = bin2hex(random_bytes(32));
    
    // Save user to database (pseudo-code)
    // $db->saveUser($username, $email, $password, $token);
    
    // Try to send verification email if EmailService is available
    if (class_exists('EmailService')) {
        try {
            $emailService = new EmailService(
                'smtp.gmail.com',
                587,
                'your-email@gmail.com',
                'your-app-password'
            );
            
            $emailSent = $emailService->sendVerificationEmail($email, $username, $token);
            
            if ($emailSent) {
                $_SESSION['signup_success'] = "Account created! Verification email sent to $email.";
            } else {
                $_SESSION['signup_success'] = "Account created! Please check your email for verification instructions.";
                error_log("Failed to send verification email to: $email");
            }
        } catch (Exception $e) {
            $_SESSION['signup_success'] = "Account created! Please check your email for verification instructions.";
            error_log("Email sending error: " . $e->getMessage());
        }
    } else {
        $_SESSION['signup_success'] = "Account created successfully!";
    }
    
    header("Location: signup.php");
    exit();
} else {
    // If not a POST request, redirect back to signup form
    $_SESSION['signup_error'] = "Invalid request method.";
    header("Location: signup.php");
    exit();
}
?>
<?php
// signin.php
session_start();

// First, try to load the autoloader
if (!file_exists('ClassAutoLoad.php')) {
    die("Error: ClassAutoLoad.php not found. Please check your installation.");
}

require_once 'ClassAutoLoad.php';

// Check if EmailService class exists using the autoloader
$emailService = null;
if (class_exists('EmailService')) {
    try {
        // Initialize email service with your SMTP credentials
        $emailService = new EmailService(
            'smtp.yourprovider.com', 
            587, 
            'your-email@yourwebsite.com', 
            'your-email-password'
        );
    } catch (Exception $e) {
        error_log("EmailService initialization failed: " . $e->getMessage());
        $emailService = null;
    }
} else {
    error_log("EmailService class not available - proceeding without email functionality");
}

// Check if Forms class exists
if (!class_exists('Forms')) {
    die("Error: Forms class not found. Please check your installation.");
}

try {
    // Pass email service to Forms (note lowercase 'e' in $emailService)
    $forms = new Forms($emailService);
    
    // Display signin form
    $forms->signin();
    
} catch (Exception $e) {
    // Fallback basic signin form if Forms class fails
    echo "<h2>Sign In</h2>";
    echo "<form method='post' action='process_signin.php'>";
    echo "  <div><label>Email: <input type='email' name='email' required></label></div>";
    echo "  <div><label>Password: <input type='password' name='password' required></label></div>";
    echo "  <button type='submit'>Sign In</button>";
    echo "</form>";
    echo "<p>System temporarily limited. Please contact support if issues persist.</p>";
    
    error_log("Forms initialization error: " . $e->getMessage());
}
?>
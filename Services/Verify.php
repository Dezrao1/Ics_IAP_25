<?php
// verify.php
require_once 'EmailService.php';
require_once 'Users.php'; // Your user management class

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Verify token against database (pseudo-code)
    // $user = $db->findUserByToken($token);
    
    if ($user) {
        // Activate the account
        // $db->activateUser($user['id']);
        
        echo "<h2>Email Verified Successfully!</h2>";
        echo "<p>Your account has been activated. You can now <a href='signin.php'>sign in</a>.</p>";
    } else {
        echo "<h2>Invalid or Expired Token</h2>";
        echo "<p>The verification link is invalid or has expired. Please request a new verification email.</p>";
    }
} else {
    echo "<h2>Invalid Request</h2>";
    echo "<p>No verification token provided.</p>";
}

// After verifying token
header("Location: signin.php?account_activated=true");
exit();

?>
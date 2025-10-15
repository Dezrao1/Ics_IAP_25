<?php
require_once 'ClassAutoLoad.php';

// Check if EmailService class exists
if (!class_exists('EmailService')) {
    die("Error: EmailService class not found.");
}

// Initialize email service with your SMTP credentials
try {
    $emailService = new EmailService(
        'smtp.yourprovider.com',  // Your SMTP host
        587,                      // Your SMTP port
        'your-email@yourwebsite.com', // Your SMTP username
        'your-email-password'     // Your SMTP password
    );
} catch (Exception $e) {
    die("Error initializing email service: " . $e->getMessage());
}

// Prepare email content
$mailContent = [
    'name_from' => 'ICS C Community',
    'email_from' => 'no-reply@icsccommunity.com',
    'name_to' => 'Receiver Name',
    'email_to' => 'receiver@example.com',
    'subject' => 'Welcome to ICS C Community',
    'body' => 'This is a new semester. <b>Let\'s make the most of it!</b>'
];

// Generate a token (if needed for verification emails)
$token = bin2hex(random_bytes(32));

// Send the email using EmailService
try {
    $EmailSent = $emailService->sendVerificationEmail(
        $mailContent['email_to'], 
        $mailContent['name_to'], 
        $token
    );
    
    if ($emailSent) {
        echo "Email sent successfully to " . $mailContent['email_to'];
    } else {
        echo "Failed to send email.";
    }
} catch (Exception $e) {
    echo "Error sending email: " . $e->getMessage();
}
?>
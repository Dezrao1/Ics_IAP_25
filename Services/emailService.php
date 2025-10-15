<?php
// Services/EmailService.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    private $smtpHost;
    private $smtpPort;
    private $smtpUsername;
    private $smtpPassword;
    private $defaultDomain;
    
    public function __construct($host, $port, $username, $password, $domain = null) {
        $this->smtpHost = $host;
        $this->smtpPort = $port;
        $this->smtpUsername = $username;
        $this->smtpPassword = $password;
        $this->defaultDomain = $domain ?: 'yourwebsite.com';
    }
    
    public function sendVerificationEmail($toEmail, $userName, $token) {
        $domain = $this->getDomain();
        $verificationLink = "http://" . $domain . "/verify.php?token=" . $token;
        
        $subject = "Verify Your Account";
        $message = "
        <html>
        <head>
            <title>Account Verification</title>
        </head>
        <body>
            <h2>Welcome, $userName!</h2>
            <p>Thank you for signing up. Please verify your email address to activate your account.</p>
            <p><a href='$verificationLink'>Verify Email Address</a></p>
            <p>Or copy and paste this link in your browser:<br>$verificationLink</p>
            <p>This verification link will expire in 24 hours.</p>
        </body>
        </html>
        ";
        
        $fromEmail = "no-reply@" . $domain;
        
        return $this->sendEmailWithPHPMailer($fromEmail, 'System', $toEmail, $userName, $subject, $message);
    }
    
    public function sendEmail($fromEmail, $fromName, $toEmail, $toName, $subject, $body) {
        return $this->sendEmailWithPHPMailer($fromEmail, $fromName, $toEmail, $toName, $subject, $body);
    }
    
    private function sendEmailWithPHPMailer($fromEmail, $fromName, $toEmail, $toName, $subject, $body) {
        $mail = new PHPMailer(true);
        
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = $this->smtpHost;
            $mail->SMTPAuth = true;
            $mail->Username = $this->smtpUsername;
            $mail->Password = $this->smtpPassword;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $this->smtpPort;
            
            // Recipients
            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($toEmail, $toName);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Email sending failed: " . $mail->ErrorInfo);
            return false;
        }
    }
    
    private function getDomain() {
        if (isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])) {
            return $_SERVER['HTTP_HOST'];
        }
        return $this->defaultDomain;
    }
}
?>

<?php
// Initialize session if needed
session_start();

// Set header to return JSON response
header('Content-Type: application/json');

// Database connection
require_once 'config/database.php';
// Include PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to generate secure random token
function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

try {
    // Get and validate email
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    
    if (!$email) {
        throw new Exception('Invalid email format');
    }

    // Check if email exists in database
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        throw new Exception('No account found with this email address');
    }

    // Generate reset token and expiry (24 hours from now)
    $token = generateToken();
    $expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

    // Store reset token in database
    $stmt = $pdo->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
    $stmt->execute([$token, $expiry, $email]);

    // Create reset link
    $resetLink = "https://sectorlinksolutions.ie/reset-password.php?token=" . $token;

    // Configure PHPMailer
    $mail = new PHPMailer(true);
    
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'timberwolf.webhostingireland.ie';    // Replace with your SMTP host
    $mail->SMTPAuth   = true;
    $mail->Username   = 'contact@sectorlinksolutions.ie'; // Replace with your email
    $mail->Password   = 'gJ@vMyLeR4US';          // Replace with your password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('contact@sectorlinksolutions.ie', 'Sector Link Solutions');
    $mail->addAddress($email);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';
    
    // HTML email body
    $htmlBody = "
    <html>
    <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
        <h2>Password Reset Request</h2>
       
        <p>You have requested to reset your password. Click the button below to reset your password:</p>
        <p style='margin: 25px 0;'>
            <a href='{$resetLink}' 
               style='background-color: #007bff; 
                      color: white; 
                      padding: 12px 25px; 
                      text-decoration: none; 
                      border-radius: 5px; 
                      display: inline-block;'>
                Reset Password
            </a>
        </p>
        <p>This link will expire in 24 hours.</p>
        <p>If you didn't request this, please ignore this email.</p>
        <br>
        <p>Best regards,<br>Sector Link Solutions Team</p>
        <p style='font-size: 12px; color: #666; margin-top: 20px;'>
            If the button doesn't work, copy and paste this link into your browser:<br>
            {$resetLink}
        </p>
    </body>
    </html>";

    // Plain text body (for email clients that don't support HTML)
    $textBody = "Hello,\n\n"
              . "You have requested to reset your password. Click the link below to reset your password:\n\n"
              . $resetLink . "\n\n"
              . "This link will expire in 24 hours.\n\n"
              . "If you didn't request this, please ignore this email.\n\n"
              . "Best regards,\nSector Link Solutions Team";

    $mail->Body    = $htmlBody;
    $mail->AltBody = $textBody;

    if ($mail->send()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Password reset instructions have been sent to your email'
        ]);
    } else {
        throw new Exception('Failed to send reset email');
    }

} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>

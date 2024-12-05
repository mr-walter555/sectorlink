<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Recipient email
    $to = "chigeluwalyer@gmail.com";

    // Create email headers with additional parameters
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Compose email body
    $email_body = "You have received a new message from your website contact form.\n\n" .
        "Name: $name\n" .
        "Email: $email\n" .
        "Phone: $phone\n" .
        "Subject: $subject\n\n" .
        "Message:\n$message";

    try {
        // Enable error reporting for debugging
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        // Attempt to send email
        $mail_sent = mail($to, "New Contact Form Submission: $subject", $email_body, $headers);
        
        if ($mail_sent) {
            header("Location: contact.php?status=success");
            exit();
        } else {
            // Log the error
            error_log("Failed to send email from contact form. Error: " . error_get_last()['message']);
            header("Location: contact.php?status=error");
            exit();
        }
    } catch (Exception $e) {
        // Log any exceptions
        error_log("Exception in contact form: " . $e->getMessage());
        header("Location: contact.php?status=error");
        exit();
    }
} else {
    // If someone tries to access this file directly, redirect them to the contact page
    header("Location: contact.php");
    exit();
}
?> 
<?php
session_start();

// Check if PDO connection exists, if not, include database connection
if (!isset($pdo)) {
    require_once 'config/database.php';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

// Function to send email using PHPMailer
function sendEmail($name, $email, $message)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'timberwolf.webhostingireland.ie'; // Replace with your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'contact@sectorlinksolutions.ie'; // Replace with your email
        $mail->Password = 'gJ@vMyLeR4US'; // Replace with your password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('contact@sectorlinksolutions.ie', 'Sector Link Solutions');
        $mail->addAddress('contact@sectorlinksolutions.ie');
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Message:</strong></p>
            <p>{$message}</p>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mail Error: " . $mail->ErrorInfo);
        return false;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if (sendEmail($name, $email, $message)) {
        $_SESSION['success_message'] = "Thank you! Your message has been sent.";
    } else {
        $_SESSION['error_message'] = "Sorry, there was an error sending your message. Please try again later or contact us directly at contact@sectorlinksolutions.ie";
        error_log("Contact form submission failed for email: " . $email);
    }

    header('Location: contact.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <section class="about-hero">

        <div class="container">

            <div class="about-hero-content">
                <h1>Contact Us</h1>
                <nav class="hero-breadcrumb">
                    <a href="index.php">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Contact Us</span>
                </nav>
            </div>


        </div>


    </section>


    <main class="contact-container">
        <div class="contact-content-wrapper">
            <!-- Left side - Image Stack -->
            <div class="contact-image-stack">
                <div class="image-box main-image">
                    <img src="./images/pexels-a-darmel-8134096.jpg" alt="Diverse Team Meeting">
                </div>
                <div class="image-box accent-image">
                    <img src="./images/pexels-cottonbro-7437488.jpg" alt="Business Partnership">
                </div>
            </div>

            <!-- Right side - Contact Form -->
            <div class="contact-form-wrapper">
                <h1>Get in Touch</h1>
                <?php if (isset($_SESSION['success_message'])): ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: '<?php echo $_SESSION['success_message']; ?>',
                            confirmButtonColor: '#ff4500'
                        });
                    </script>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '<?php echo $_SESSION['error_message']; ?>',
                            confirmButtonColor: '#ff4500'
                        });
                    </script>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>

                <p>Please fill out the form below and we'll get back to you as soon as possible.</p>
                <form action="contact.php" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required minlength="2" maxlength="50" placeholder="Enter your full name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required placeholder="Enter your email address">
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required minlength="10" maxlength="1000" placeholder="Type your message here..."></textarea>
                    </div>

                    <button type="submit" class="submit-btn" style="background-color: orangered;">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <!-- Top Footer Section -->
            <div class="footer-top">
                <!-- Company Info -->
                <div class="footer-col">

                    <p class="footer-desc">
                        Sector Link Solutions is a pioneering recruitment company committed to helping organisations achieve their diversity and inclusion goals.
                    </p>


                </div>

                <!-- Quick Links -->
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="live-jobs.php">Live Jobs</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="footer-col">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="healthcare.php">Healthcare Staffing</a></li>
                        <li><a href="permanent.php">Permanent Recruitment</a></li>
                        <li><a href="temporary.php">Temporary Recruitment</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <div class="contact-info">
                        <p><i class="fas fa-envelope"></i>contact@sectorlinksolutions.ie</p>
                        <p><i class="fas fa-map-marker-alt"></i> Dublin, Ireland</p>
                    </div>

                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="footer-bottom">
                <div class="copyright">
                    <p>&copy; 2024 Your Company. All rights reserved.</p>
                </div>
                <div class="footer-links">
                    <a href="privacy.php">Privacy Policy</a>
                    <a href="terms-and-conditions.php">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
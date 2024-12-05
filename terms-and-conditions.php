<?php
session_start();
require_once 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions | Sector Link Solutions</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .terms-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        .terms-container h1 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 2.5rem;
        }

        .terms-container h2 {
            color: #444;
            margin: 2rem 0 1rem;
            font-size: 1.8rem;
        }

        .terms-container p {
            line-height: 1.6;
            margin-bottom: 1rem;
            color: #666;
        }

        .terms-container ul {
            margin-left: 2rem;
            margin-bottom: 1rem;
        }

        .terms-container li {
            margin-bottom: 0.5rem;
            line-height: 1.6;
            color: #666;
        }

        .effective-date {
            font-style: italic;
            color: #888;
            margin-bottom: 2rem;
        }

        .section {
            margin-bottom: 2rem;
        }

        .contact-info {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 6px;
            margin-top: 2rem;
        }

        .contact-info h3 {
            color: #333;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    
    <section class="about-hero">
        <div class="container">
            <div class="about-hero-content">
                <h1>Terms and Conditions</h1>
                <nav class="hero-breadcrumb">
                    <a href="index.php">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Terms and Conditions</span>
                </nav>
            </div>
        </div>
    </section>

    <div class="terms-container">
        <h1>Terms and Conditions</h1>
        <p class="effective-date">Effective Date: 1st October 2024</p>

        <div class="section">
            <h2>1. Introduction</h2>
            <p>These Terms and Conditions govern your use of the Sector Link Solutions website, including registration, job applications, and associated features. By using our website, you agree to be bound by these terms. If you do not agree, please do not use this website.</p>
        </div>

        <div class="section">
            <h2>2. User Account</h2>
            <ul>
                <li><strong>Eligibility:</strong> Users must be at least 18 years old to register and use this website.</li>
                <li><strong>Account Security:</strong> You are responsible for maintaining the confidentiality of your login credentials. Notify us immediately if you suspect unauthorised access to your account.</li>
                <li><strong>Accuracy of Information:</strong> You must provide accurate and truthful information during registration and profile updates. Misrepresentation may result in account suspension or termination.</li>
            </ul>
        </div>

        <div class="section">
            <h2>3. Use of Website</h2>
            <p>This website is intended for personal, non-commercial use to register, upload resumes, view job listings, and apply for jobs.</p>
            <p>Users are prohibited from:</p>
            <ul>
                <li>Posting false or misleading information</li>
                <li>Uploading malicious files or content</li>
                <li>Engaging in unlawful or fraudulent activity</li>
                <li>Attempting to disrupt or compromise website security</li>
            </ul>
        </div>

        <div class="section">
            <h2>4. Job Listings and Applications</h2>
            <ul>
                <li>While we strive to ensure the accuracy of job postings, Sector Link Solutions is not liable for inaccuracies or errors.</li>
                <li>By applying for a job, you agree to allow Sector Link Solutions to share your application details with potential employers.</li>
                <li>Submission of an application does not guarantee employment, as hiring decisions rest solely with the employer.</li>
            </ul>
        </div>

        <div class="section">
            <h2>5. CV and Cover Letter Management</h2>
            <ul>
                <li>Users are responsible for ensuring that uploaded CVs and cover letters are accurate, current, and free from viruses or harmful content.</li>
                <li>Uploading a new CV will replace the previous CV stored on your profile.</li>
            </ul>
        </div>

        <div class="section">
            <h2>6. Intellectual Property</h2>
            <ul>
                <li>All content on this website, including text, graphics, logos, and software, is the property of Sector Link Solutions and protected by intellectual property laws.</li>
                <li>By uploading your CV or other materials, you grant Sector Link Solutions a non-exclusive, worldwide license to use the content for recruitment purposes.</li>
            </ul>
        </div>

        <div class="section">
            <h2>7. Privacy</h2>
            <p>Your use of this website is subject to our Privacy Policy. We are committed to protecting your personal information.</p>
        </div>

        <div class="section">
            <h2>8. Termination of Use</h2>
            <p>Sector Link Solutions reserves the right to terminate your access to the website if you breach these Terms and Conditions or engage in any prohibited activity.</p>
        </div>

        <div class="section">
            <h2>9. Disclaimer of Liability</h2>
            <p>Sector Link Solutions provides this website "as is" and makes no warranties of any kind, express or implied.</p>
            <p>We are not liable for:</p>
            <ul>
                <li>Loss of data or unauthorised access to your account</li>
                <li>Errors in job listings or decisions made by employers</li>
                <li>Technical issues or website downtime</li>
            </ul>
        </div>

        <div class="section">
            <h2>10. Changes to Terms and Conditions</h2>
            <p>We may update these terms periodically. Continued use of the website after changes are made constitutes acceptance of the revised terms.</p>
        </div>

        <div class="section">
            <h2>11. Governing Law</h2>
            <p>These terms are governed by the laws of Nigeria. Disputes will be resolved exclusively in Nigeria.</p>
        </div>

        <div class="section contact-info">
            <h2>12. Contact Us</h2>
            <p>If you have any questions about these Terms and Conditions, please contact us at contact@sectorlinksolutions.ie</p>
        </div>
    </div>
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


    <script src="script.js"></script>
</body>
</html>

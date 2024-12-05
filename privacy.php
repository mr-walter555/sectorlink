<?php
session_start();
require_once 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | Sector Link Solutions</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .privacy-policy {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        .privacy-policy h1 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 2.5rem;
        }

        .privacy-policy h2 {
            color: #444;
            margin: 2rem 0 1rem;
            font-size: 1.8rem;
        }

        .privacy-policy p {
            line-height: 1.6;
            margin-bottom: 1rem;
            color: #666;
        }

        .privacy-policy ul {
            margin-left: 2rem;
            margin-bottom: 1rem;
        }

        .privacy-policy li {
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
                <h1>Privacy Policy</h1>
                <nav class="hero-breadcrumb">
                    <a href="index.php">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Privacy Policy</span>
                </nav>
            </div>
        </div>
    </section>

    <div class="privacy-policy container">
        <h1>Privacy Policy</h1>
        <p class="effective-date">Effective Date: 1st October 2024</p>

        <div class="section">
            <p>At Sector Link Solutions, we are committed to protecting the privacy and security of your personal data. This Privacy Policy explains how we collect, use, disclose, and protect your information when you visit our website or use our services. As a company operating in the European Union, we adhere to the General Data Protection Regulation (GDPR) and other relevant data protection laws.</p>
        </div>

        <div class="section">
            <h2>1. Who We Are</h2>
            <p>Sector Link Solutions is a recruitment company specializing in connecting organizations with skilled professionals. Our website allows organizations to request recruiting services and professionals to apply for job opportunities. For the purposes of GDPR, Sector Link Solutions is the data controller of your personal data.</p>
        </div>

        <div class="section">
            <h2>2. What Information We Collect</h2>
            <p>We collect and process different types of personal data depending on your interaction with our website and services, including but not limited to:</p>
            <ul>
                <li>Personal Identification Information: Name, email address, phone number, mailing address, date of birth, and other similar identifiers.</li>
                <li>Professional Information: Employment history, educational background, certifications, skills, and other job-related information.</li>
                <li>Application Information: CVs, cover letters, references, and other materials you submit as part of a job application.</li>
                <li>Technical Data: IP address, browser type, operating system, device information, and usage data collected through cookies and similar technologies.</li>
                <li>Communication Data: Messages and communications you send to us through our website or directly to our team.</li>
            </ul>
        </div>

        <div class="section">
            <h2>3. How We Use Your Information</h2>
            <p>We use your personal data for the following purposes:</p>
            <ul>
                <li>Recruitment Services: To match candidates with job opportunities, process applications, and communicate with you about potential employment.</li>
                <li>Client Services: To facilitate recruitment requests from organizations and manage client relationships.</li>
                <li>Website Functionality: To operate, maintain, and improve our website, ensuring a seamless user experience.</li>
                <li>Compliance and Legal Obligations: To comply with applicable laws, regulations, and legal processes, including GDPR requirements.</li>
                <li>Communication: To send you updates, newsletters, and other information relevant to our services, if you have opted to receive such communications.</li>
            </ul>
        </div>

        <div class="section">
            <h2>4. Legal Basis for Processing</h2>
            <p>We process your personal data on the following legal bases:</p>
            <ul>
                <li>Consent: Where you have provided your explicit consent for the processing of your personal data.</li>
                <li>Contractual Necessity: Where processing is necessary for the performance of a contract with you.</li>
                <li>Legal Obligation: Where we are required to process your personal data to comply with legal obligations.</li>
                <li>Legitimate Interests: Where processing is necessary for our legitimate business interests.</li>
            </ul>
        </div>

        <div class="section">
            <h2>5. Data Sharing and Disclosure</h2>
            <p>We may share your personal data with:</p>
            <ul>
                <li>Employers and Clients: To facilitate job applications and recruitment processes.</li>
                <li>Service Providers: Third-party vendors who provide services on our behalf.Third-party vendors who provide services on our behalf, such as IT support, hosting services, and data analytics. These providers are bound by confidentiality agreements and are not permitted to use your data for any other purpose.</li>
                <li>Legal and Regulatory Authorities: Where required by law or legal proceedings.</li>
                <li>Business Transfers: In case of merger, acquisition, or sale ofof all or part of our business, your personal data may be transferred to the acquiring entity.</li>
            </ul>
        </div>

        <div class="section">
            <h2>6. International Data Transfers</h2>
            <p>Your personal data may be transferred to, and processed in, countries outside of the European Economic Area (EEA). In such cases, we ensure that appropriate safeguards are in place, such as standard contractual clauses approved by the European Commission, to protect your personal data.</p>
        </div>

        <div class="section">
            <h2>7. Data Security</h2>
            <p>We implement robust security measures to protect your personal data from unauthorized access, alteration, disclosure, or destruction. These measures include encryption, access controls, and regular security audits. However, please note that no method of transmission over the Internet or electronic storage is 100% secure, and we cannot guarantee absolute security.</p>
        </div>

        <div class="section">
            <h2>8. Data Retention</h2>
            <p>We retain your personal data only for as long as necessary to fulfil the purposes for which it was collected, including any legal, accounting, or reporting requirements. When your data is no longer needed, we will securely delete or anonymize it.</p>
        </div>

        <div class="section">
            <h2>9. Your Rights</h2>
            <p>Under GDPR, you have the following rights:</p>
            <ul>
                <li>Right to Access:You have the right to request a copy of the personal data we hold about you.</li>
                <li>Right to Rectification:You can request correction of any inaccurate or incomplete personal data we hold about you.</li>
                <li>Right to Erasure:You have the right to request the deletion of your personal data in certain circumstances.</li>
                <li>Right to Restrict Processing:You can request that we restrict the processing of your personal data in specific situations.</li>
                <li>Right to Data Portability:You have the right to receive your personal data in a structured, commonly used, and machine-readable format and to have it transferred to another data controller.</li>
                <li>Right to Object:You can object to the processing of your personal data where we are relying on legitimate interests as the legal basis.</li>
                <li>Right to Withdraw Consent:If we are processing your data based on your consent, you have the right to withdraw that consent at any time.
            </ul>
            To exercise these rights, please contact us using the information provided in the "Contact Us" section below.
        </div>

        <div class="section">
            <h2>10. Cookies and Tracking</h2>
            <p>We use cookies and similar technologies to enhance browsing experience experience, analyse website traffic, and personalize content. For more information about how we use cookies and how you can manage your preferences, please refer to our Cookie Policy..</p>
        </div>

        <div class="section">
            <h2>11. Policy Updates</h2>
            <p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal obligations. We will notify you of any significant changes by posting the updated policy on our website and, where appropriate, notifying you via email. Please review this Privacy Policy periodically to stay informed about how we protect your personal data.</p>
        </div>

        <div class="section contact-info">
            <h2>12. Contact Us</h2>
            <p>For questions or concerns about this Privacy Policy, contact us at:</p>
            <p><strong>Sector Link Solutions</strong></p>
            <p>Email: contact@sectorlinksolutions.ie</p>
        </div>
    </div>
    
    <footer class="footer">
            <div class="footer-container">
                <!-- Top Footer Section -->
                <div class="footer-top">
                    <!-- Company Info -->
                    <div class="footer-col">
                        <div class="footer-logo">
                            <h3>Your Logo</h3>
                        </div>
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
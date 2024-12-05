<?php
// Add this at the very top of the file
session_start();

// Check if PDO connection exists, if not, include database connection
if (!isset($pdo)) {
    require_once 'config/database.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sector Link Solutions - Healthcare Staffing Services in Ireland">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">

    <!-- CSS Files -->
    <link rel="stylesheet" href="styles.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">

    <title>Temporary Recruitment | Sector Link Solutions</title>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <!-- Header -->

    <main>
        <!-- Hero Section -->
        <section class="about-hero">

            <div class="container">

                <div class="about-hero-content">
                    <h1>Temporary Recruitment</h1>
                    <nav class="hero-breadcrumb">
                        <a href="index.php">Home</a>
                        <i class="fas fa-chevron-right"></i>
                        <span>Temporary Recruitment</span>
                    </nav>
                </div>


            </div>


        </section>
        <section class="healthcare-intro-section">
            <div class="container">
                <div class="content-wrapper">
                    <!-- Text Content Column -->
                    <div class="text-column">
                        <div class="section-header">
                            <span class="overline">Temporary Recruitment</span>
                            <h2 class="title">Flexible Healthcare Staffing Solutions</h2>
                        </div>
                        <div class="content">
                            <p class="lead-text">
                                At Sector Link Solutions, we understand the dynamic and often unpredictable nature of the healthcare industry. Whether it's covering unexpected staff shortages, managing seasonal demand, or handling short-term projects, having access to reliable temporary healthcare professionals is essential. That's why we offer specialized Temporary Healthcare Staffing Services to hospitals, clinics, nursing homes, and home care providers across Ireland.
                            </p>
                            <p class="lead-text">
                                Our temporary staffing solutions are designed to provide you with the flexibility and responsiveness you need to maintain high standards of patient care, no matter the circumstances. We connect healthcare providers with a pool of qualified, experienced professionals who are ready to step in and deliver quality care whenever and wherever it's needed.
                            </p>
                            <a href="live-jobs.php" class="learn-more-btn">
                                View Live Jobs
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="image-column">
                        <div class="image-box">
                            <img src="./images/-137_rectangle_updated.webp" alt="Healthcare professionals collaborating">
                            <div class="pattern-dots"></div>
                            <div class="pattern-lines"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="healthcare-solutions-section">
            <div class="container">
                <div class="section-header centered">
                    <span class="overline">Our Expertise</span>
                    <h2 class="title">Temporary Staffing Offerings</h2>
                    <p class="lead-text" style="text-align: center;">We offer a comprehensive range of staffing services tailored to the specific needs of healthcare providers</p>
                </div>

                <div class="points-list">
                    <div class="point">
                        <div class="point-icon">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <div class="point-content">
                            <h3>Registered Nurses (RNs)</h3>
                            <p>We provide experienced registered nurses who are trained to deliver high-quality care in various healthcare settings, including acute care hospitals, long-term care facilities, and home health environments.</p>
                        </div>
                    </div>

                    <div class="point">
                        <div class="point-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div class="point-content">
                            <h3>Healthcare Assistants (HCAs)</h3>
                            <p>Our healthcare assistants are skilled in providing essential support to nursing staff and ensuring the comfort and well-being of patients. They are available for both temporary and permanent placements.</p>
                        </div>
                    </div>

                    <div class="point">
                        <div class="point-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="point-content">
                            <h3>Specialised Healthcare Professionals</h3>
                            <p>We also recruit specialized healthcare professionals such as physiotherapists, occupational therapists, pharmacists, and other allied health professionals to meet the specific needs of your facility.</p>
                        </div>
                    </div>

                    <div class="point">
                        <div class="point-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="point-content">
                            <h3>Home Care Workers</h3>
                            <p>We offer compassionate and qualified home care workers who can provide personalized care to individuals in the comfort of their own homes. Our home care workers are trained to assist with daily living activities, medication management, and other essential services.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="why-choose-section">
            <div class="why-choose-container">
                <div class="section-header centered">

                    <h2 class="title">Why Choose Us</h2>
                    <p class="subtitle">Delivering excellence through our core values and commitments</p>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Rapid Response</h3>
                        <p>We understand that healthcare needs can change quickly. Our team is available 24/7 to respond to your temporary staffing requests, ensuring you have the right professionals in place when you need them the most.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <h3>High-Quality Candidates</h3>
                        <p>All of our temporary staff are thoroughly vetted, including Garda vetting, and are chosen for their skills, experience, and dedication to patient care. We only provide candidates who meet the highest professional standards.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <h3>Flexible Contracts</h3>
                        <p>Whether you need staff for a day, a week, or several months, we offer flexible contract options tailored to your specific requirements. We can also provide staff on short notice, helping you manage unexpected demands with ease.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <h3>Cost-Effective Solutions</h3>
                        <p>Temporary staffing can be a cost-effective way to manage fluctuations in demand without the long-term commitment of permanent hires. We offer competitive rates and transparent pricing to ensure you get the best value for your staffing investment.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-puzzle-piece"></i>
                        </div>
                        <h3>Seamless Integration</h3>
                        <p>Our temporary staff are accustomed to stepping into new environments quickly and efficiently. We ensure that they are well-prepared to integrate smoothly into your team and start delivering care from day one.</p>
                    </div>
                </div>

                <!-- Add shapes container -->
                <div class="why-choose-shapes">
                    <div class="shape shape-1"></div>
                    <div class="shape shape-2"></div>
                    <div class="shape shape-3"></div>
                    <div class="shape shape-4"></div>
                    <div class="shape shape-5"></div>
                </div>
            </div>
        </section>
        <section class="offers-section">
            <div class="offers-container">
                <div class="section-header centered">
                    <span class="overline">Our Process</span>
                    <h2 class="title">How We Work</h2>
                    <p class="subtitle">A systematic approach to healthcare staffing solutions</p>
                </div>

                <div class="offers-grid">
                    <div class="offer-card">
                        <span class="offer-number">01</span>
                        <div class="offer-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Request a Consultation</h3>
                            <p>Contact us with your temporary staffing needs. Our team will work with you to understand your specific requirements and the type of healthcare professionals you need.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">02</span>
                        <div class="offer-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Candidate Selection</h3>
                            <p>We'll provide you with a shortlist of available and qualified candidates who match your needs. You can choose the best fit for your team.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">03</span>
                        <div class="offer-icon">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Placement and Support</h3>
                            <p>Once a candidate is selected, we handle all the logistics of the placement, including compliance checks and onboarding. Our support doesn't end there—we'll stay in touch to ensure the temporary placement is a success.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">04</span>
                        <div class="offer-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Ongoing Flexibility</h3>
                            <p>If your needs change, we're here to help. Whether you need to extend a contract, replace a staff member, or find additional help, we offer the flexibility to adapt to your evolving requirements.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="banner-section">
            <div class="banner-container">
                <div class="banner-content">
                    <h2>Partner with Us for Temporary Staffing Success</h2>
                    <p>At Sector Link Solutions, we're dedicated to providing healthcare providers across Ireland with the temporary staffing support they need to deliver outstanding patient care. Our goal is to help you maintain seamless operations, even in the face of staffing challenges, by providing access to a pool of skilled and dependable healthcare professionals.</p>
                    <div class="banner-buttons">
                        <a href="#contact" class="primary-btn">
                            Get Started
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="#about" class="secondary-btn">
                            Learn More
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="banner-shape banner-shape-1"></div>
            <div class="banner-shape banner-shape-2"></div>
            <div class="banner-shape-dots">

            </div>
        </section>

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








    </main>

    <!-- Footer -->

    <!-- JavaScript Files -->
    <script src="js/main.js"></script>
    <script src="js/healthcare.js"></script>
</body>

</html>
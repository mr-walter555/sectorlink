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

    <title>Healthcare Staffing | Sector Link Solutions</title>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <!-- Header -->

    <main>
        <!-- Hero Section -->
        <section class="about-hero">

            <div class="container">

                <div class="about-hero-content">
                    <h1>Healthcare Staffing</h1>
                    <nav class="hero-breadcrumb">
                        <a href="index.php">Home</a>
                        <i class="fas fa-chevron-right"></i>
                        <span>Healthcare Staffing</span>
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
                            <span class="overline">Healthcare Staffing Services</span>
                            <h2 class="title">Expert Healthcare Recruitment</h2>
                        </div>
                        <div class="content">
                            <p class="lead-text">
                                At Sector Link Solutions, we specialise in providing top-tier healthcare staffing solutions to hospitals, clinics, nursing homes, and home care services across Ireland. Our mission is to connect healthcare providers with skilled, compassionate, and reliable professionals who are committed to delivering exceptional patient care.
                            <p class="lead-text">Our Commitment to Quality Care
                                In the healthcare industry, quality care begins with the right team. Whether you’re a large hospital or a small home care provider, having access to highly qualified healthcare professionals is crucial to ensuring patient safety and satisfaction. At Sector Link Solutions, we understand the unique challenges and demands of the healthcare sector, and we are dedicated to helping you meet those needs efficiently and effectively.
                            </p>
                            </p>
                            <a href="live-jobs.php" class="learn-more-btn">
                                View Live Healthcare Jobs
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
                    <h2 class="title">Healthcare Staffing Solutions</h2>
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
                            <i class="fas fa-network-wired"></i>
                        </div>
                        <h3>Extensive Candidate Network</h3>
                        <p>We have a vast network of vetted healthcare professionals ready to meet your staffing needs. Our rigorous recruitment process ensures that we provide only the best candidates who meet your exact requirements.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-puzzle-piece"></i>
                        </div>
                        <h3>Tailored Staffing Solutions</h3>
                        <p>We understand that every healthcare provider has unique needs. Whether you need staff for short-term assignments, long-term placements, or emergency cover, we offer flexible solutions tailored to your specific situation.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-check"></i>
                        </div>
                        <h3>Compliance and Regulatory Adherence</h3>
                        <p>In a highly regulated industry like healthcare, compliance is critical. All our candidates undergo thorough background checks, including Garda vetting, to ensure they meet all professional and regulatory standards. We also handle all the necessary documentation and compliance requirements, so you can focus on what you do best—providing excellent care.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>24/7 Support</h3>
                        <p>Healthcare never stops, and neither do we. Our team is available 24/7 to support your staffing needs, ensuring that you always have access to the right professionals when you need them.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h3>Dedicated Account Management</h3>
                        <p>When you partner with Sector Link Solutions, you'll be assigned a dedicated account manager who will work closely with you to understand your needs and provide ongoing support. We are committed to building long-term relationships and ensuring your complete satisfaction.</p>
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
                            <h3>Consultation</h3>
                            <p>We start by understanding your staffing needs, the specific skills and experience required, and your organizational culture.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">02</span>
                        <div class="offer-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Candidate Matching</h3>
                            <p>We carefully select candidates from our extensive database who meet your criteria. We provide you with a shortlist of highly qualified professionals for your consideration.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">03</span>
                        <div class="offer-icon">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Placement</h3>
                            <p>Once you've selected a candidate, we handle the placement process, including all necessary compliance checks and onboarding.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">04</span>
                        <div class="offer-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Ongoing Support</h3>
                            <p>We don't just stop at placement. Our team continues to support both you and the candidate to ensure a smooth integration and successful outcome.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="banner-section">
            <div class="banner-container">
                <div class="banner-content">
                    <h2>Partner with Us Today</h2>
                    <p>At Sector Link Solutions, we are more than just a staffing agency—we are your strategic partner in healthcare. Our goal is to provide you with the skilled professionals you need to maintain the highest standards of patient care. Let us help you build a strong, capable, and compassionate healthcare team.</p>
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
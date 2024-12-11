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

    <title>Permanent Recruitment | Sector Link Solutions</title>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <!-- Header -->

    <main>
        <!-- Hero Section -->
        <section class="about-hero">

            <div class="container">

                <div class="about-hero-content">
                    <h1>Permanent Recruitment</h1>
                    <nav class="hero-breadcrumb">
                        <a href="index.php">Home</a>
                        <i class="fas fa-chevron-right"></i>
                        <span>Permanent Recruitment</span>
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
                            <span class="overline">Permanent Recruitment</span>
                            <h2 class="title">Invest in Long-Term Excellence</h2>
                        </div>
                        <div class="content">
                            <p class="lead-text">
                                At Sector Link Solutions, we know that building a strong, dedicated, and skilled healthcare team is the foundation for delivering exceptional patient care. Our Permanent Healthcare Staffing Services are designed to help hospitals, clinics, nursing homes, and home care providers across Ireland find and hire top-quality healthcare professionals who are committed to making a long-term impact.
                            </p>
                            <p class="lead-text">
                                The success of your healthcare organization depends on the quality and stability of your team. Permanent staff not only bring continuity to patient care but also help foster a positive, collaborative work environment. Sector Link Solutions is here to support you in finding the right permanent hires—professionals who are not just qualified but also align with your values and culture.
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
                    <h2 class="title">Permanent Staffing Offerings</h2>
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
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h3>Rigorous Screening Process</h3>
                        <p>We take the time to thoroughly vet each candidate, including conducting in-depth interviews, reference checks, and Garda vetting. Our goal is to ensure that every candidate we present to you meets your professional standards and is a strong fit for your team.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3>Tailored Recruitment Strategy</h3>
                        <p>We work closely with you to understand your specific needs, organizational culture, and long-term goals. This allows us to tailor our recruitment strategy and find candidates who not only have the right skills but also share your vision for patient care.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-network-wired"></i>
                        </div>
                        <h3>Extensive Network</h3>
                        <p>With access to a broad network of healthcare professionals, we are well-equipped to source candidates across various disciplines and experience levels. Whether you need a senior specialist or a recent graduate, we can find the right fit for your organization.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <h3>Focus on Retention</h3>
                        <p>We believe that recruitment is just the beginning. Our approach emphasizes finding candidates who are likely to thrive in your environment, helping to reduce turnover and increase retention of your permanent staff.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3>Dedicated Support</h3>
                        <p>From the initial consultation to the final hiring decision, we provide ongoing support to ensure a smooth recruitment process. Your dedicated account manager will be there every step of the way, offering insights and assistance to help you make the best hiring decisions.</p>
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
                            <h3>Consultation and Needs Assessment</h3>
                            <p>We begin by understanding your staffing needs, including the skills, experience, and qualities you are looking for in a candidate. We also take into account your organizational culture and goals.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">02</span>
                        <div class="offer-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Candidate Sourcing and Screening</h3>
                            <p>We leverage our extensive network and recruitment expertise to identify and screen candidates who meet your criteria. Our rigorous selection process ensures that only the most qualified and suitable candidates are presented to you.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">03</span>
                        <div class="offer-icon">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Interviews and Selection</h3>
                            <p>We work with you to coordinate interviews, provide feedback, and assist in the decision-making process. Our goal is to facilitate a smooth and efficient recruitment experience.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">04</span>
                        <div class="offer-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Onboarding and Integration</h3>
                            <p>Once you've selected a candidate, we support the onboarding process to ensure a successful integration into your team. We remain available to address any questions or concerns during this critical transition period.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="banner-section">
            <div class="banner-container">
                <div class="banner-content">
                    <h2>Build Your Dream Team with Sector Link Solutions</h2>
                    <p>At Sector Link Solutions, we are more than just a recruitment agency—we are your partner in building a healthcare team that is committed to excellence. By providing you with access to top-tier permanent staff, we help you create a stable, high-performing workforce that delivers outstanding care.</p>
                    <div class="banner-buttons">
                        <a href="register.php" class="primary-btn">
                            Get Started
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
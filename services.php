<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Company Name</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Header -->
    <?php include 'components/navbar.php'; ?>

    <main>
        <section class="about-hero">
            <div class="corner-shapes">
                <div class="shape top-left"></div>
                <div class="shape top-right"></div>
                <div class="shape bottom-left"></div>
                <div class="shape bottom-right"></div>
            </div>
            <div class="container">

                <div class="about-hero-content">
                    <h1>Our Services</h1>
                    <nav class="hero-breadcrumb">
                        <a href="index.php">Home</a>
                        <i class="fas fa-chevron-right"></i>
                        <span>Services</span>
                    </nav>
                </div>


            </div>


        </section>
        
        
        <section class="services-section">
            <div class="services-container">
                <div class="section-header centered">
                    <span class="overline">Our Services</span>
                    <h2 class="title">Comprehensive Recruitment Solutions</h2>
                    <p class="subtitle">Tailored services to meet your staffing needs</p>
                </div>

                <div class="services-grid">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-hospital"></i>
                        </div>
                        <h3>Healthcare Staffing</h3>
                        <p>Specialized recruitment solutions for healthcare professionals and medical facilities</p>
                        <a href="healthcare.php" class="service-link">
                        Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Permanent Recruitment</h3>
                        <p>Strategic talent acquisition for long-term organizational success</p>
                        <a href="permanent.php" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Temporary Recruitment</h3>
                        <p>Flexible staffing solutions to meet your short-term business needs</p>
                        <a href="temporary.php" class="service-link">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Updated shapes container -->
                <div class="service-shapes">
                    <div class="shape shape-1"></div>
                    <div class="shape shape-2"></div>
                    <div class="shape shape-3"></div>

                </div>
            </div>
        </section>
        <section class="banner-section">
            <div class="banner-container">
                <div class="banner-content">
                    <h2>Ready to Build Your Diverse Team?</h2>
                    <p>Let's work together to create an inclusive workplace that drives innovation and success.</p>
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
                <div class="banner-shape banner-shape-1"></div>
                <div class="banner-shape banner-shape-2"></div>
                <div class="banner-shape-dots"></div>
            </div>
        </section>
        <section class="offers-section">
            <div class="offers-container">
                <div class="section-header centered">
                    <span class="overline">What We Offer</span>
                    <h2 class="title">Comprehensive Solutions</h2>
                    <p class="subtitle">End-to-end support for employers and candidates</p>
                </div>

                <div class="offers-grid">
                    <div class="offer-card">
                        <span class="offer-number">01</span>
                        <div class="offer-icon">
                            <i class="fas fa-users-viewfinder"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Diversity Focused Recruitment</h3>
                            <p>We specialize in sourcing and placing candidates from a wide range of cultural, ethnic, and professional backgrounds. Our recruitment process is designed to identify and match the best talent with the specific needs of our clients.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">02</span>
                        <div class="offer-icon">
                            <i class="fas fa-person-walking-arrow-right"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Onboarding and Integration Support</h3>
                            <p>Beyond recruitment, we provide comprehensive onboarding services to help new employees settle into their roles and integrate into the Irish workplace culture.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">03</span>
                        <div class="offer-icon">
                            <i class="fas fa-people-roof"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Community Integration Assistance</h3>
                            <p>We recognize the challenges that come with relocating to a new country. That's why we offer tailored support to help employees and their families adjust to life in Ireland.</p>
                        </div>
                    </div>

                    <div class="offer-card">
                        <span class="offer-number">04</span>
                        <div class="offer-icon">
                            <i class="fas fa-comments-dollar"></i>
                        </div>
                        <div class="offer-content">
                            <h3>Consulting Services</h3>
                            <p>We offer strategic consulting to help organizations develop and implement effective diversity and inclusion strategies that align with business goals.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                            Leading recruitment agency connecting international talent with Irish opportunities.
                        </p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="footer-col">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="#home">Home</a></li>
                            <li><a href="#about">About Us</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#live-jobs">Live Jobs</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div class="footer-col">
                        <h4>Services</h4>
                        <ul>
                            <li><a href="#">Job Search</a></li>
                            <li><a href="#">Recruitment Solutions</a></li>
                            <li><a href="#">Career Advice</a></li>
                            <li><a href="#">CV Writing</a></li>
                            <li><a href="#">Interview Tips</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="footer-col">
                        <h4>Contact Us</h4>
                        <div class="contact-info">
                            <p><i class="fas fa-phone"></i> +353 (0)1 234 5678</p>
                            <p><i class="fas fa-envelope"></i> info@yourcompany.ie</p>
                            <p><i class="fas fa-map-marker-alt"></i> Dublin, Ireland</p>
                        </div>
                        <div class="newsletter">
                            <h4>Newsletter</h4>
                            <form class="subscribe-form">
                                <input type="email" placeholder="Enter your email">
                                <button type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="footer-bottom">
                    <div class="copyright">
                        <p>&copy; 2024 Your Company. All rights reserved.</p>
                    </div>
                    <div class="footer-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </footer>




    </main>




    <!-- Footer -->

    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
</body>

</html>
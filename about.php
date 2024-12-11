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
    <title>About Us - Your Recruitment Agency</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'components/navbar.php'; ?>


    <main>
        <section class="about-hero">
           
            <div class="container">

                <div class="about-hero-content">
                    <h1>About Us</h1>
                    <nav class="hero-breadcrumb">
                        <a href="index.php">Home</a>
                        <i class="fas fa-chevron-right"></i>
                        <span>About Us</span>
                    </nav>
                </div>


            </div>


        </section>

        <!-- Who We Are Section -->
        <section class="who-we-are-section">
            <div class="who-we-are-container">
                <div class="content-wrapper">

                    <div class="image-stack">
                        <div class="image-box main-image">
                            <img src="./images/pexels-a-darmel-8134096.jpg" alt="Diverse Team Meeting">
                        </div>
                        <div class="image-box accent-image">
                            <img src="./images/pexels-cottonbro-7437488.jpg" alt="Business Partnership">
                        </div>
                        <div class="pattern-dots"></div>
                        <div class="pattern-lines"></div>
                    </div>
                    <!-- Text Content -->
                    <div class="text-column">
                        <div class="who-we-are-header">
                            <span class="who-we-are-overline">Who We Are</span>
                            <h2 class="who-we-are-title">Your Partner in Diverse Recruitment</h2>
                        </div>



                        <div class="text-content-box">
                            <p>Sector Link Solutions is a pioneering recruitment company committed to helping organisations achieve their diversity and inclusion goals. We specialise in connecting businesses across Ireland with a diverse range of skilled professionals, while also ensuring that these employees are effectively onboarded and integrated into the Irish society.</p>
                        </div>
                        <div class="highlight-item">
                            <div class="highlight-header">
                                <i class="fas fa-eye"></i>
                                <span class="highlight-label">Our Vision</span>
                            </div>
                            <div class="highlight-content">
                                <p>To be Ireland's leading force in creating diverse and inclusive workplaces, transforming organizational cultures and empowering businesses to thrive through diversity.</p>
                            </div>
                        </div>

                        <div class="highlight-item">
                            <div class="highlight-header">
                                <i class="fas fa-bullseye"></i>
                                <span class="highlight-label">Our Mission</span>
                            </div>
                            <div class="highlight-content">
                                <p>To bridge the gap between Irish employers and international talent by providing comprehensive recruitment solutions that promote workplace diversity, foster inclusive environments, and support successful integration of professionals from all backgrounds.</p>
                            </div>
                        </div>


                    </div>


                    <!-- Image Stack -->

                </div>
            </div>


        </section>

        <!-- Company Stats -->



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

        <section class="why-choose-section">
            <div class="why-choose-container">
                <div class="section-header centered">

                    <h2 class="title">Why Choose Us</h2>
                    <p class="subtitle">Delivering excellence through our core values and commitments</p>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users-between-lines"></i>
                        </div>
                        <h3>Commitment to Diversity</h3>
                        <p>We are passionate about promoting diversity and inclusion in the workplace. Our recruitment strategies are designed to attract and retain top talent from a wide array of backgrounds, helping organizations create a truly inclusive environment.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-circle-nodes"></i>
                        </div>
                        <h3>Holistic Approach</h3>
                        <p>We go beyond traditional recruitment by offering support that addresses the full spectrum of an employee's journey—from hiring to integration into the community. This holistic approach ensures both employer and employee success.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3>Expertise and Insight</h3>
                        <p>With deep knowledge of the Irish market and a strong network of international talent, we are uniquely equipped to help businesses meet their diversity targets while maintaining high standards of quality and performance.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-handshake-angle"></i>
                        </div>
                        <h3>Continuous Support</h3>
                        <p>Our relationship with clients and candidates doesn't end at placement. We provide ongoing support to ensure long-term success, helping employees grow within their roles and adapt to their new environments.</p>
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
        <section class="banner-section">
            <div class="banner-container">
                <div class="banner-content">
                    <h2>Ready to Build Your Diverse Team?</h2>
                    <p>Let's work together to create an inclusive workplace that drives innovation and success.</p>
                    <div class="banner-buttons">
                        <a href="register.php" class="primary-btn">
                            Get Started
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        
                    </div>
                </div>
                <div class="banner-shape banner-shape-1"></div>
                <div class="banner-shape banner-shape-2"></div>
                <div class="banner-shape-dots"></div>

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

    <!-- Scripts -->
</body>

</html>
<?php
session_start();
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect=' . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

// Check if job_id is provided
if (!isset($_GET['job_id'])) {
    header('Location: live-jobs.php');
    exit();
}

$job_id = filter_var($_GET['job_id'], FILTER_SANITIZE_NUMBER_INT);

// Fetch job details
try {
    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
    $stmt->execute([$job_id]);
    $job = $stmt->fetch();

    if (!$job) {
        header('Location: live-jobs.php');
        exit();
    }

    // Fetch user details
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply - <?php echo htmlspecialchars($job['job_title']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .job-header {
            background: linear-gradient(135deg, #1a65e5, #58a056);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            height: 40vh;
        }
        
        .job-meta-badge {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            backdrop-filter: blur(10px);
        }
        
        .job-section {
            padding: 2rem 0;
            border-bottom: 1px solid #eee;
            width: 900px;
        }
        
        .section-header h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }
        
        .content-item {
            padding: 1rem 0;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            padding-left: 1rem;
        }
        
        .content-item:hover {
            background: #f8f9fa;
            padding-left: 1.5rem;
        }
        
        .description-content .content-item {
            border-left-color: #1a65e5;
            text-align: justify;
        }
        
        .requirements-content .content-item {
            border-left-color: #1a65e5;
            text-align: left;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        
        .benefits-content .content-item {
            border-left-color: #1a65e5;
        }
        
        .text-primary { color: #1a65e5 !important; }
        .text-warning { color: #ffc107 !important; }
        .text-success { color: #58a056 !important; }

        @media (max-width: 1200px) {
            .job-section {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .job-header {
                height: auto;
                padding: 2rem 0;
            }
            
            .content-item {
                padding-left: 0.5rem;
            }
            
            .content-item:hover {
                padding-left: 1rem;
            }
        }

        @media (max-width: 576px) {
            .job-meta-badge {
                margin-bottom: 0.5rem;
            }
            
            .display-4 {
                font-size: 2rem;
            }
        }
       
        @media (max-width: 991px) {
            .application-sidebar {
                position: static;
                margin-top: 2rem;
            }
        }
    </style>
</head>

<body class="bg-light">
    <?php include 'components/navbar.php'; ?>

    <!-- Hero Header Section -->
    <div class="job-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mt-5"><?php echo htmlspecialchars($job['job_title']); ?></h1>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <span class="badge job-meta-badge px-3 py-2">
                            <i class="fas fa-briefcase me-2"></i><?php echo htmlspecialchars($job['employment_type']); ?>
                        </span>
                        <span class="badge job-meta-badge px-3 py-2">
                            <i class="fas fa-map-marker-alt me-2"></i><?php echo htmlspecialchars($job['location']); ?>
                        </span>
                        <span class="badge job-meta-badge px-3 py-2">
                            <i class="fas fa-money-bill-wave me-2"></i><?php echo htmlspecialchars($job['salary_range']); ?>
                        </span>
                    </div>
                    <p class="text-white-50">
                        <i class="fas fa-clock me-2"></i>Posted <?php echo date('M d, Y', strtotime($job['created_at'])); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="job-section mb-3">
                   
                    <div class="content">
                        <h4 class="mb-3">Job Description</h4>
                        <div class="description-content mb-4">
                            <?php 
                            $descriptions = explode("\n", strip_tags($job['job_description']));
                            foreach($descriptions as $desc): 
                                if(trim($desc)): ?>
                                    <div class="content-item">
                                        <?php echo htmlspecialchars(trim($desc)); ?>
                                    </div>
                            <?php 
                                endif;
                            endforeach; ?>
                        </div>

                        <h4 class="mb-3">Requirements</h4>
                        <div class="requirements-content mb-4">
                            <ul class="list-unstyled">
                            <?php 
                            $requirements = explode("\n", strip_tags($job['requirements']));
                            foreach($requirements as $req): 
                                if(trim($req)): ?>
                                    <li>
                                        <i class="fas fa-circle me-2" style="font-size: 0.5em"></i>
                                        <?php echo htmlspecialchars(trim($req)); ?>
                                    </li>
                            <?php 
                                endif;
                            endforeach; ?>
                            </ul>
                        </div>

                        <h4 class="mb-3">Benefits</h4>
                        <div class="benefits-content">
                            <ul class="list-unstyled">
                            <?php 
                            $benefits = explode("\n", strip_tags($job['benefits']));
                            foreach($benefits as $benefit): 
                                if(trim($benefit)): ?>
                                    <li>
                                        <i class="fas fa-circle me-2" style="font-size: 0.5em"></i>
                                        <?php echo htmlspecialchars(trim($benefit)); ?>
                                    </li>
                            <?php 
                                endif;
                            endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add application form here -->
            <div class="col-lg-8">
                <div class="job-section mb-3">
                    <h4 class="mb-4">Apply for this Position</h4>
                    <form id="applicationForm" action="process_application.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                            </div>

                        </div>  
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="resume" class="form-label">Resume/CV</label>
                                <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                                <small class="text-muted">Accepted formats: PDF</small>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="background-color: orangered; border-color: orangered;">Submit Application</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


   
            

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('applicationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('process_application.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Application Submitted!',
                            text: data.message,
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'my_applications.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again.'
                    });
                });
        });
    </script>

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
                        <p><i class="fas fa-envelope"></i> contact@sectorlinksolutions.ie</p>
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
                        <a href="privacy.php">Privacy Policy</a>
                        <a href="terms-and-conditions.php">Terms of Service</a>
                        <a href="#">Cookie Policy</a>
                    </div>
            </div>
        </div>
    </footer>
</body>

</html>
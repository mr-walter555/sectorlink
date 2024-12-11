<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "sectorlink";

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post New Job - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="dashboard-nav">
        <div class="nav-container">
            <div class="nav-brand">
                <button class="sidebar-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                
            </div>

            <div class="nav-actions">
                <div class="nav-icons">
                    <div class="notification-icon">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <div class="user-icon">
                        <i class="fas fa-user-circle"></i>
                        <span><?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="dashboard-container">
    <div class="sidebar">
            <h2><i class="fas fa-user-shield"></i> Admin Panel</h2>
            <ul class="sidebar-menu">
                <li>
                    <a href="admin_dashboard.php">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="post_job.php">
                        <i class="fas fa-plus-circle"></i>
                        <span>Post New Job</span>
                    </a>
                </li>
                <li>
                    <a href="manage_jobs.php">
                        <i class="fas fa-briefcase"></i>
                        <span>View Posted Jobs</span>
                    </a>
                </li>
                <li>
                    <a href="applications.php">
                        <i class="fas fa-file-alt"></i>
                        <span>Applications</span>
                    </a>
                </li>
                <li>
                    <a href="change_password.php" class="active">
                        <i class="fas fa-key"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="admin_logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>Post New Job</h1>
            </div>

            <div class="job-form-container">
                <form class="job-form" id="jobForm" method="POST" action="process_job.php" onsubmit="return submitForm(event)">
                    <div class="form-section">
                        <h3>Basic Information</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="job_title">Job Title</label>
                                <input type="text" id="job_title" name="job_title" required>
                                <span class="input-hint">Keep it clear and specific</span>
                            </div>

                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" id="position" name="position" required>
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" required>
                            </div>

                            <div class="form-group">
                                <label for="salary_range">Salary Range</label>
                                <input type="text" id="salary_range" name="salary_range">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>Job Details</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="employment_type">Employment Type</label>
                                <select id="employment_type" name="employment_type" required>
                                    <option value="">Select Type</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Remote">Remote</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="experience">Experience Level</label>
                                <select id="experience" name="experience" required>
                                    <option value="">Select Experience</option>
                                    <option value="Entry">Entry Level</option>
                                    <option value="Mid">Mid Level</option>
                                    <option value="Senior">Senior Level</option>
                                    <option value="Executive">Executive Level</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="industry">Industry</label>
                                <select id="industry" name="industry" required>
                                    <option value="">Select Industry</option>
                                    <option value="customer-service">Customer Service and Call Centers</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="IT">Information Technology (IT)</option>
                                    <option value="Finance">Finance and Banking</option>
                                    <option value="Education">Education</option>
                                    <option value="Construction">Construction and Engineering</option>
                                    <option value="Hospitality">Hospitality and Tourism</option>
                                    <option value="Retail">Retail and E-commerce</option>
                                    <option value="Manufacturing">Manufacturing and Logistics</option>
                                    <option value="Legal">Legal</option>
                                    <option value="Creative">Creative and Media</option>
                                    <option value="Telecommunications">Telecommunications</option>
                                    <option value="Energy">Energy and Utilities</option>
                                    <option value="Government">Government and Public Sector</option>
                                    <option value="Pharmaceutical">Pharmaceutical and Life Sciences</option>
                                    <option value="Aviation">Aviation</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>Detailed Information</h3>
                        <div class="form-group">
                            <label for="job_description">Job Description</label>
                            <textarea id="job_description" name="job_description" rows="6" required></textarea>

                        </div>

                        <div class="form-group">
                            <label for="requirements">Requirements</label>
                            <textarea id="requirements" name="requirements" rows="6" required placeholder="List the required qualifications, skills, and experience..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="benefits">Benefits (Optional)</label>
                            <textarea id="benefits" name="benefits" rows="4" placeholder="List the benefits and perks offered with this position..."></textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-paper-plane"></i> Post Job
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/p4mvuh10n7v6eet1rtystce9dpew3e1q7ldi6k0n8h1ilhtq/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: '#job_description, #requirements, #benefits',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save(); // This saves content to the original textarea
                });
            }
        });

        function submitForm(event) {
            event.preventDefault();

            // Update TinyMCE content before submission
            tinymce.triggerSave();

            // Get form values
            const form = document.getElementById('jobForm');
            const formData = new FormData(form);

            // Basic validation
            const jobDescription = formData.get('job_description');
            const requirements = formData.get('requirements');

            if (!jobDescription.trim() || !requirements.trim()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Required Fields Empty',
                    text: 'Please fill in all required fields including job description and requirements.'
                });
                return false;
            }

            // Show loading state
            Swal.fire({
                title: 'Posting Job...',
                text: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit form using fetch
            fetch('process_job.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log('Raw response:', data); // For debugging
                
                try {
                    const jsonData = JSON.parse(data);
                    if (jsonData.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Job posting has been successfully created.',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'manage_jobs.php';
                            }
                        });
                    } else {
                        throw new Error(jsonData.message || 'Failed to create job posting');
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    throw new Error('Invalid server response');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'An error occurred while submitting the form.'
                });
            });

            return false;
        }
    </script>

    <script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');
        const dashboardNav = document.querySelector('.dashboard-nav');
        
        sidebar.classList.toggle('active');
    }

    // Close sidebar when clicking outside
    document.addEventListener('click', function(event) {
        const sidebar = document.querySelector('.sidebar');
        const toggle = document.querySelector('.sidebar-toggle');
        
        if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    });
    </script>

</body>

</html>
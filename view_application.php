<?php
// Add these lines at the very top of the file
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

// Check if application ID is provided
if (!isset($_GET['id'])) {
    header("Location: applications.php");
    exit();
}

// Include database connection
require_once 'config/database.php';

try {
    $id = $_GET['id'];

    // First get application details
    $query1 = "SELECT * FROM applications WHERE id = :id";
    $stmt1 = $pdo->prepare($query1);
    $stmt1->execute(['id' => $id]);
    $application = $stmt1->fetch();

    if (!$application) {
        echo "No application found with ID: " . $id;
        exit();
    }

    // Get user details including cv_path and phone
    $query2 = "SELECT fullname, email, cv_path, phone FROM users WHERE id = :id";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->execute(['id' => $application['user_id']]);
    $user = $stmt2->fetch();

    // Get job details
    $query3 = "SELECT job_title, location, employment_type, salary_range 
               FROM jobs WHERE id = :id";
    $stmt3 = $pdo->prepare($query3);
    $stmt3->execute(['id' => $application['job_id']]);
    $job = $stmt3->fetch();

    // Combine all data
    $application = array_merge($application, $user, $job);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    error_log("Error: " . $e->getMessage());
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Application - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin_dashboard.css">
    <style>
        .application-details {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin: 20px 0;
        }

        .section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 1.2em;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-label {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 5px;
        }

        .info-value {
            font-weight: 500;
            color: #333;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .action-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .approve-btn {
            background-color: #28a745;
            color: white;
        }

        .reject-btn {
            background-color: #dc3545;
            color: white;
        }

        .back-btn {
            background-color: #6c757d;
            color: white;
        }

        .cv-preview {
            margin-top: 15px;
        }

        .cv-frame {
            width: 100%;
            height: 500px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
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
                    <a href="admin_logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <div class="header">
                <h1>Application Details</h1>
                <div class="header-icons">
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

            <button class="action-btn back-btn" onclick="window.location.href='applications.php'">
                <i class="fas fa-arrow-left"></i> Back to Applications
            </button>
            <div class="application-details">
                <div class="section">
                    <h2 class="section-title">Applicant Information</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Full Name</div>
                            <div class="info-value"><?php echo htmlspecialchars($application['fullname']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value"><?php echo htmlspecialchars($application['email']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Phone</div>
                            <div class="info-value"><?php echo htmlspecialchars($application['phone']); ?></div>
                        </div>
                    </div>
                </div>

                <!-- Job Information -->


                <!-- Application Status -->


                <!-- CV Preview -->
                <div class="section">
                    <h2 class="section-title">CV/Resume</h2>
                    <div class="cv-preview">
                        <?php 
                            $cv_path = $application['cv_path'];
                            // Add debugging
                            error_log("CV Path: " . $cv_path);
                            
                            // Ensure the path starts with the uploads directory if it's not absolute
                            if (!empty($cv_path) && !str_starts_with($cv_path, '/')) {
                                $cv_path = 'uploads/' . $cv_path;
                            }
                            
                            if (!empty($cv_path) && file_exists($cv_path)) {
                                echo '<object data="' . htmlspecialchars($cv_path) . '" type="application/pdf" class="cv-frame">
                                        <p>It appears you don\'t have a PDF plugin for this browser. 
                                        You can <a href="' . htmlspecialchars($cv_path) . '" target="_blank">click here to download the PDF file</a>.</p>
                                      </object>';
                                
                               
                            } else {
                                echo "<p>CV file not found. Path: " . htmlspecialchars($cv_path) . "</p>";
                                error_log("CV file not found at path: " . $cv_path);
                            }
                        ?>
                    </div>
                </div>

                
            
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateApplicationStatus(id, status) {
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to ${status} this application?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: status === 'approved' ? '#28a745' : '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('update_application_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                id: id,
                                status: status
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Updated!',
                                    `Application has been ${status}.`,
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        });
                }
            });
        }
    </script>
</body>

</html>
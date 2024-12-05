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

    // Fetch job details
    $stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $job = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$job) {
        $_SESSION['swal_message'] = [
            'icon' => 'error',
            'title' => 'Error',
            'text' => 'Job not found'
        ];
        header("Location: manage_jobs.php");
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['swal_message'] = [
        'icon' => 'error',
        'title' => 'Error',
        'text' => 'Database error: ' . $e->getMessage()
    ];
    header("Location: manage_jobs.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Job - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .job-details {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .job-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .job-title {
            font-size: 1.8rem;
            color: #333;
            margin: 0;
        }

        .job-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .meta-item {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
        }

        .meta-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .meta-value {
            font-size: 1.1rem;
            color: #333;
            font-weight: 500;
        }

        .meta-value ul {
            margin-left: 1.5rem;
        }

        .job-description {
            white-space: pre-line;
            line-height: 1.6;
            color: #444;
        }

        .action-buttons {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .editable {
            padding: 5px;
            border: 1px solid transparent;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .editable:hover {
            border-color: #ddd;
            background: #fff;
        }

        .editable.editing {
            border-color: #007bff;
            background: #fff;
        }

        .meta-value textarea {
            width: 100%;
            min-height: 100px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
            font-size: inherit;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
            </div>
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
                <h1>View Job Details</h1>
                <a href="manage_jobs.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Jobs
                </a>
            </div>

            <div class="job-details">
                <div class="job-header">
                    <h2 class="job-title editable" contenteditable="false" data-field="job_title"><?php echo htmlspecialchars($job['job_title']); ?></h2>
                    <span class="status-badge <?php echo $job['status'] == 'active' ? 'status-active' : 'status-inactive'; ?>">
                        <?php echo ucfirst($job['status']); ?>
                    </span>
                </div>

                <div class="job-meta">
                    <div class="meta-item">
                        <div class="meta-label">Position</div>
                        <div class="meta-value editable" contenteditable="false" data-field="position"><?php echo htmlspecialchars($job['position']); ?></div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Location</div>
                        <div class="meta-value editable" contenteditable="false" data-field="location"><?php echo htmlspecialchars($job['location']); ?></div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Employment Type</div>
                        <div class="meta-value editable" contenteditable="false" data-field="employment_type"><?php echo htmlspecialchars($job['employment_type']); ?></div>
                    </div>

                    <div class="meta-item">
                        <div class="meta-label">Salary Range</div>
                        <div class="meta-value editable" contenteditable="false" data-field="salary_range"><?php echo htmlspecialchars($job['salary_range']); ?></div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Experience</div>
                        <div class="meta-value editable" contenteditable="false" data-field="experience"><?php echo htmlspecialchars($job['experience']); ?></div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Industry</div>
                        <div class="meta-value editable" contenteditable="false" data-field="industry"><?php echo htmlspecialchars($job['industry']); ?></div>
                    </div>

                </div>
                <div class="meta-item">
                    <div class="meta-label">Job Description</div>
                    <div class="meta-value editable" contenteditable="false" data-field="job_description">
                        <?php echo strip_tags($job['job_description'], '<p><br>'); ?>
                    </div>
                </div>

                <div class="meta-item">
                    <div class="meta-label">Requirements</div>
                    <div class="meta-value editable" contenteditable="false" data-field="requirements">
                        <?php echo strip_tags($job['requirements'], '<ul><li><strong><br>'); ?>
                    </div>
                </div>

                <div class="meta-item">
                    <div class="meta-label">Benefits</div>
                    <div class="meta-value editable" contenteditable="false" data-field="benefits">
                        <?php echo strip_tags($job['benefits'], '<ul><li><br>'); ?>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-primary" onclick="toggleEdit(this)">
                        <i class="fas fa-edit"></i> <span>Edit Job</span>
                    </button>

                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleEdit(button) {
            const editables = document.querySelectorAll('.editable');
            const isEditing = button.querySelector('span').textContent === 'Save Changes';

            if (isEditing) {
                // Save changes logic here
                const jobData = {};
                editables.forEach(el => {
                    // Get innerHTML instead of textContent to preserve HTML formatting
                    jobData[el.dataset.field] = el.innerHTML.trim();
                });

                // Send to server
                fetch('update_job.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: <?php echo $job['id']; ?>,
                            data: jobData
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Changes saved successfully!',
                                confirmButtonColor: '#007bff'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to save changes: ' + (data.message || 'Unknown error'),
                                confirmButtonColor: '#007bff'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to save changes: ' + error.message,
                            confirmButtonColor: '#007bff'
                        });
                    });

                button.querySelector('span').textContent = 'Edit Job';
                button.querySelector('i').className = 'fas fa-edit';
            } else {
                button.querySelector('span').textContent = 'Save Changes';
                button.querySelector('i').className = 'fas fa-save';
            }

            editables.forEach(el => {
                el.contentEditable = !isEditing;
                el.classList.toggle('editing', !isEditing);
            });
        }

        function toggleStatus(id, currentStatus) {
            const newStatus = currentStatus === 'active' ? 'inactive' : 'active';

            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to change the status to ${newStatus}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`update_job_status.php?id=${id}&status=${newStatus}`, {
                            method: 'POST'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to update status',
                                    confirmButtonColor: '#007bff'
                                });
                            }
                        });
                }
            });
        }
    </script>
</body>

</html>
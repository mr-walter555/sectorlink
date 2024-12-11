<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config/database.php';

// Get user data from database
try {
    $stmt = $pdo->prepare("SELECT fullname, profile_image FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    $user_name = $user['fullname'] ?? 'Guest';
} catch (PDOException $e) {
    $user_name = 'Guest';
    $user = ['fullname' => 'Guest', 'profile_image' => ''];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">
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
                        <span class="notification-badge">2</span>
                    </div>
                    <div class="user-icon">
                        <?php if (!empty($user['profile_image'])): ?>
                            <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile">
                        <?php else: ?>
                            <i class="fas fa-user-circle"></i>
                        <?php endif; ?>
                        <span><?php echo htmlspecialchars($user['fullname']); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
 
    <div class="dashboard-container">
        <div class="sidebar">
            <h2><i class="fas fa-user"></i> My Dashboard</h2>
            <ul class="sidebar-menu">
                <li>
                    <a href="dashboard.php">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="my_applications.php">
                        <i class="fas fa-file-alt"></i>
                        <span>My Applications</span>
                    </a>
                </li>

                <li>
                    <a href="profile.php">
                        <i class="fas fa-user-circle"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="account_settings.php">
                        <i class="fas fa-cog"></i>
                        <span>Account Settings</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main-content">
        <div class="header">
                <h1>My Applications</h1>
                
            </div>
            <div style="text-align: right; margin-bottom: 20px;">
                <a href="live-jobs.php" class="browse-jobs-btn">
                    <i class="fas fa-search"></i> Browse Jobs
                </a>
            </div>
            <div class="applications-container">
                <div class="applications-list">
                    <?php
                    // Database connection
                    require_once 'config/database.php';

                    try {
                        $user_id = $_SESSION['user_id'];

                        // Get specific application ID from URL if provided
                        $application_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

                        if ($application_id) {
                            // Query for specific application
                            $query = "SELECT * FROM applications WHERE user_id = :user_id AND id = :application_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute([
                                'user_id' => $user_id,
                                'application_id' => $application_id
                            ]);
                            $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } else {
                            // Query for all applications
                            $query = "SELECT * FROM applications WHERE user_id = :user_id ORDER BY applied_at DESC";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute(['user_id' => $user_id]);
                            $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        }

                        if ($applications) {
                    ?>
                            <table class="applications-table">
                                <thead>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Position</th>
                                        <th>Application Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($applications as $row) {
                                        // Show pending status until shortlisted
                                        $status = ($row['status'] === 'shortlisted') ? 'shortlisted' : ($row['status'] === 'rejected' ? 'rejected' : 'pending');
                                        $status_class = strtolower($status);

                                        $job_query = "SELECT job_title, position FROM jobs WHERE id = :job_id";
                                        $job_stmt = $pdo->prepare($job_query);
                                        $job_stmt->execute(['job_id' => $row['job_id']]);
                                        $job = $job_stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($job['job_title'] ?? 'Job Title Not Available'); ?></td>
                                            <td><?php echo htmlspecialchars($job['position'] ?? 'Position Not Available'); ?></td>
                                            <td><i class="fas fa-calendar"></i> <?php echo date('M d, Y', strtotime($row['applied_at'])); ?></td>
                                            <td><span class="status <?php echo $status_class; ?>"><?php echo htmlspecialchars($status); ?></span></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                    <?php
                        } else {
                            if ($application_id) {
                                echo '<div class="no-applications">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <p>Application not found or access denied.</p>
                                        <a href="my_applications.php" class="browse-jobs-btn">View All Applications</a>
                                      </div>';
                            } else {
                                echo '<div class="no-applications">
                                        <i class="fas fa-file-alt"></i>
                                        <p>You haven\'t submitted any applications yet.</p>
                                        <a href="live-jobs.php" class="browse-jobs-btn">Browse Jobs</a>
                                      </div>';
                            }
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <style>
        .applications-container {
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .applications-list {
            margin-top: 20px;
            overflow-x: auto;
        }

        .applications-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .applications-table th,
        .applications-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .applications-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        .applications-table tr:hover {
            background-color: #f8f9fa;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 500;
            text-transform: capitalize;
            display: inline-block;
        }

        .status.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status.reviewing {
            background-color: #cce5ff;
            color: #004085;
        }

        .status.shortlisted {
            background-color: #d4edda;
            color: #155724;
        }

        .status.rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .no-applications {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .no-applications i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #ddd;
        }

        .browse-jobs-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .browse-jobs-btn:hover {
            background: #0056b3;
        }
    </style>
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
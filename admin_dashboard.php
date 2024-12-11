<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
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
                    <a href="change_password.php">
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
                <h1>Admin Dashboard</h1>
            </div>
            
            <div class="stats-container">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="stats-info">
                        <h3>Total Jobs Posted</h3>
                        <p class="stats-number"><?php
                            require_once 'config/database.php';
                            $stmt = $pdo->query("SELECT COUNT(*) FROM jobs");
                            echo $stmt->fetchColumn();
                        ?></p>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-info">
                        <h3>Total Applications</h3>
                        <p class="stats-number"><?php
                            $stmt = $pdo->query("SELECT COUNT(*) FROM applications");
                            echo $stmt->fetchColumn();
                        ?></p>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stats-info">
                        <h3>Active Listings</h3>
                        <p class="stats-number"><?php
                            $stmt = $pdo->query("SELECT COUNT(*) FROM jobs WHERE status = 'active'");
                            echo $stmt->fetchColumn();
                        ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

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
                <h1>My Dashboard</h1>
                
            </div>
            <div class="stats-container">
                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <div class="stats-info">
                        <h3>Applications Sent</h3>
                        <?php
                        try {
                            require_once 'config/database.php';
                            $user_id = $_SESSION['user_id'];
                            $query = "SELECT COUNT(*) FROM applications WHERE user_id = :user_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute(['user_id' => $user_id]);
                            $applications_count = $stmt->fetchColumn();
                            echo '<p class="stats-number">' . $applications_count . '</p>';
                        } catch (PDOException $e) {
                            echo '<p class="stats-number">0</p>';
                        }
                        ?>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stats-info">
                        <h3>Jobs Shortlisted</h3>
                        <?php
                        try {
                            require_once 'config/database.php';
                            $user_id = $_SESSION['user_id'];
                            $query = "SELECT COUNT(*) FROM applications WHERE user_id = :user_id AND status = 'shortlisted'";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute(['user_id' => $user_id]);
                            $shortlisted_count = $stmt->fetchColumn();
                            echo '<p class="stats-number">' . $shortlisted_count . '</p>';
                        } catch (PDOException $e) {
                            echo '<p class="stats-number">0</p>';
                        }
                        ?>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stats-info">
                        <h3>Jobs Pending</h3>
                        <?php
                        try {
                            require_once 'config/database.php';
                            $user_id = $_SESSION['user_id'];
                            // Modified query to count applications that are not shortlisted or rejected
                            $query = "SELECT COUNT(*) FROM applications WHERE user_id = :user_id AND status NOT IN ('shortlisted', 'rejected')";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute(['user_id' => $user_id]);
                            $pending_count = $stmt->fetchColumn();
                            echo '<p class="stats-number">' . $pending_count . '</p>';
                        } catch (PDOException $e) {
                            echo '<p class="stats-number">0</p>';
                        }
                        ?>
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

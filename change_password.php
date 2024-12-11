<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

require_once 'config/database.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verify current password
    $stmt = $pdo->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->execute([$_SESSION['admin_username']]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($current_password, $admin['password'])) {
        if ($new_password === $confirm_password) {
            if (strlen($new_password) >= 8) {
                // Update password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE username = ?");
                if ($update_stmt->execute([$hashed_password, $_SESSION['admin_username']])) {
                    $message = "Password successfully updated!";
                    $messageType = "success";
                } else {
                    $message = "Error updating password. Please try again.";
                    $messageType = "error";
                }
            } else {
                $message = "New password must be at least 8 characters long.";
                $messageType = "warning";
            }
        } else {
            $message = "New passwords do not match.";
            $messageType = "error";
        }
    } else {
        $message = "Current password is incorrect.";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <style>
        .password-form-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
      
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
        .password-field {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            padding: 5px;
        }
        .password-toggle:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <?php if ($message): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '<?php echo $messageType; ?>',
                title: '<?php echo $message; ?>',
                showConfirmButton: true,
                timer: 3000
            });
        });
    </script>
    <?php endif; ?>

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
                <h1>Change Password</h1>
            </div>
            
            <div class="password-form-container">
                <form method="POST" action="change_password.php">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <div class="password-field">
                            <input type="password" id="current_password" name="current_password" placeholder="Enter your current password" required>
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('current_password', this)"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <div class="password-field">
                            <input type="password" id="new_password" name="new_password" placeholder="Enter your new password" required>
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('new_password', this)"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <div class="password-field">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" required>
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('confirm_password', this)"></i>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-btn">Change Password</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    function togglePassword(inputId, icon) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('active');
    }

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

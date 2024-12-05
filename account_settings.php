<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config/database.php';

// Get user data
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
} catch (PDOException $e) {
    $error = "Error fetching user data";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['form_type'] ?? '';
    
    if ($type === 'profile') {
        $fullname = $_POST['fullname'] ?? '';
        $email = $_POST['email'] ?? '';
        
        try {
            $stmt = $pdo->prepare("UPDATE users SET fullname = ?, email = ? WHERE id = ?");
            $stmt->execute([$fullname, $email, $_SESSION['user_id']]);
            $success = "Profile updated successfully";
        } catch (PDOException $e) {
            $error = "Error updating profile";
        }
    }
    
    if ($type === 'password') {
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        if ($new_password === $confirm_password) {
            // Verify current password
            if (password_verify($current_password, $user['password'])) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                try {
                    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
                    $stmt->execute([$hashed_password, $_SESSION['user_id']]);
                    $success = "Password updated successfully";
                } catch (PDOException $e) {
                    $error = "Error updating password";
                }
            } else {
                $error = "Current password is incorrect";
            }
        } else {
            $error = "New passwords do not match";
        }
    }

    if ($type === 'delete_account') {
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        if (password_verify($confirm_password, $user['password'])) {
            try {
                $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                $stmt->execute([$_SESSION['user_id']]);
                session_destroy();
                header("Location: login.php");
                exit();
            } catch (PDOException $e) {
                $error = "Error deleting account";
            }
        } else {
            $error = "Password is incorrect";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
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
                <h1>Account Settings</h1>
                <div class="header-icons">
                    <div class="notification-icon">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">2</span>
                    </div>
                    <div class="user-icon">
                        <?php if (!empty($user['profile_image'])): ?>
                            <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        <?php else: ?>
                            <i class="fas fa-user-circle"></i>
                        <?php endif; ?>
                        <span><?php echo htmlspecialchars($user['fullname']); ?></span>
                    </div>
                </div>
            </div>

            <?php if (isset($error) || isset($success)): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: '<?php echo isset($error) ? 'error' : 'success' ?>',
                        title: '<?php echo isset($error) ? 'Error' : 'Success' ?>',
                        text: '<?php echo isset($error) ? htmlspecialchars($error) : htmlspecialchars($success) ?>',
                        confirmButtonColor: '<?php echo isset($error) ? '#d33' : '#3085d6' ?>'
                    });
                });
            </script>
            <?php endif; ?>

            <div class="settings-container">
               
                <div class="settings-card">
                    <h2>Change Password</h2>
                    <form method="POST" action="" style="box-shadow: none;">
                        <input type="hidden" name="form_type" value="password">
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" id="current_password" name="current_password" required placeholder="Enter your current password">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password" required placeholder="Enter your new password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm your new password">
                        </div>
                        <button type="submit" class="btn-primary">Change Password</button>
                    </form>
                </div>

                <div class="settings-card">
                    <h2>Delete Account</h2>
                    <form method="POST" action="" style="box-shadow: none;" id="deleteAccountForm">
                        <input type="hidden" name="form_type" value="delete_account">
                        <div class="form-group">
                            <p class="warning-text" style="color: #d33; margin-bottom: 20px;">
                                Warning: This action is permanent and cannot be undone. 
                                All your data, including your profile, applications, and settings will be permanently deleted.
                            </p>
                        </div>
                        <button type="button" class="btn-delete" onclick="confirmDelete()">Delete Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Please enter your password to confirm account deletion",
            icon: 'warning',
            input: 'password',
            inputPlaceholder: 'Enter your password',
            inputAttributes: {
                autocapitalize: 'off',
                autocorrect: 'off'
            },
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Delete Account',
            cancelButtonText: 'Cancel',
            showLoaderOnConfirm: true,
            preConfirm: (password) => {
                if (!password) {
                    Swal.showValidationMessage('Please enter your password')
                }
                return password;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('deleteAccountForm');
                const passwordInput = document.createElement('input');
                passwordInput.type = 'hidden';
                passwordInput.name = 'confirm_password';
                passwordInput.value = result.value;
                form.appendChild(passwordInput);
                form.submit();
            }
        });
    }
    </script>
</body>
</html> 
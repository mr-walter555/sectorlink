<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config/database.php';

// Get user data
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check if any data has changed
        $hasChanges = false;
        $fields = ['fullname', 'email', 'phone', 'location', 'bio'];

        foreach ($fields as $field) {
            if ($_POST[$field] !== $user[$field]) {
                $hasChanges = true;
                break;
            }
        }

        // Check if profile image was uploaded
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $hasChanges = true;
        }

        if (!$hasChanges) {
            echo "<script>
                Swal.fire({
                    icon: 'info',
                    title: 'No Changes',
                    text: 'No changes were made to your profile',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>";
            exit;
        }

        // Handle profile image upload
        $profile_image_path = $user['profile_image']; // Keep existing image by default

        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            // Validate file type
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['profile_image']['type'], $allowed_types)) {
                throw new PDOException('Invalid file type. Only JPG, PNG, and GIF files are allowed.');
            }

            // Generate unique filename
            $upload_dir = 'uploads/profile_images/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $filename = uniqid() . '_' . basename($_FILES['profile_image']['name']);
            $profile_image_path = $upload_dir . $filename;

            // Move uploaded file
            if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_image_path)) {
                throw new PDOException('Failed to upload image.');
            }

            // Delete old profile image if exists
            if (!empty($user['profile_image']) && file_exists($user['profile_image'])) {
                unlink($user['profile_image']);
            }
        }

        // Update user data including profile image
        $stmt = $pdo->prepare("UPDATE users SET 
            fullname = ?, 
            email = ?,
            phone = ?,
            location = ?,
            bio = ?,
            profile_image = ?
            WHERE id = ?");

        $stmt->execute([
            $_POST['fullname'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['location'],
            $_POST['bio'],
            $profile_image_path,
            $user_id
        ]);

        // Change to echo JavaScript for SweetAlert
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Profile updated successfully',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.reload();
            });
        </script>";
        exit;
    } catch (PDOException $e) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error updating profile: " . htmlspecialchars($e->getMessage()) . "'
            });
        </script>";
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">
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
        <!-- Sidebar (same as dashboard.php) -->
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
                <h1>My Profile</h1>
                
            </div>

            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <div class="profile-container">
                <div class="profile-grid">
                    <!-- Left side - Profile Form -->
                    <div class="profile-details">
                        <h2>Personal Information</h2>
                        <div class="profile-image-container">
                            <div class="current-profile-image">
                                <?php if (!empty($user['profile_image'])): ?>
                                    <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image">
                                <?php else: ?>
                                    <i class="fas fa-user-circle default-profile-icon"></i>
                                <?php endif; ?>
                            </div>
                            <div class="profile-image-upload">
                                <label for="profile_image" class="btn-secondary">
                                    <i class="fas fa-camera"></i> Change Profile Picture
                                </label>
                                <input type="file" id="profile_image" name="profile_image" accept="image/*" style="display: none;" onchange="previewImage(this)">
                            </div>
                        </div>
                        <form method="POST" class="profile-form" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="fullname">Full Name</label>
                                    <input type="text" id="fullname" name="fullname"
                                        value="<?php echo htmlspecialchars($user['fullname'] ?? ''); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email"
                                        value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" id="phone" name="phone"
                                        value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" id="location" name="location"
                                        value="<?php echo htmlspecialchars($user['location'] ?? ''); ?>">
                                </div>
                            </div>

                            <div class="form-group full-width">
                                <label for="bio">Professional Bio</label>
                                <textarea id="bio" name="bio" rows="4"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>

                    <!-- Right side - Documents -->
                    <div class="profile-documents">
                        <h2>My Documents</h2>
                        <div class="document-cards">
                            <div class="document-card">
                                
                                <div class="document-info">
                                    <h3>Resume/CV</h3>
                                    <?php if (!empty($user['cv_path'])): ?>
                                        <p>Last updated: <?php echo date('M d, Y', strtotime($user['updated_at'])); ?></p>
                                        <?php
                                        $filename = basename($user['cv_path']);
                                        $max_length = 30;
                                        if (strlen($filename) > $max_length) {
                                            $filename = substr($filename, 0, $max_length - 3) . '...';
                                        }
                                        ?>
                                        <p>File: <?php echo htmlspecialchars($filename); ?></p>
                                        <div class="document-actions">
                                            <button type="button" class="btn-secondary" onclick="document.getElementById('cv_upload').click()">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                            <button type="button" class="btn-danger" onclick="deleteDocument('cv')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <p>No CV uploaded yet</p>
                                        <div class="document-actions">
                                            <button type="button" class="btn-secondary" onclick="document.getElementById('cv_upload').click()">
                                                <i class="fas fa-upload"></i> Upload CV
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="document-card">
                                
                                <div class="document-info">
                                    <h3>Cover Letter Template</h3>
                                    <?php if (!empty($user['cover_letter_path'])): ?>
                                        <p>Last updated: <?php echo date('M d, Y', strtotime($user['updated_at'])); ?></p>
                                        <?php
                                        $filename = basename($user['cover_letter_path']);
                                        $max_length = 30;
                                        if (strlen($filename) > $max_length) {
                                            $filename = substr($filename, 0, $max_length - 3) . '...';
                                        }
                                        ?>
                                        <p>File: <?php echo htmlspecialchars($filename); ?></p>
                                        <div class="document-actions">
                                            <button type="button" class="btn-secondary" onclick="document.getElementById('cover_letter_upload').click()">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                            <button type="button" class="btn-danger" onclick="deleteDocument('cover_letter')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <p>No cover letter template uploaded yet</p>
                                        <div class="document-actions">
                                            <button type="button" class="btn-secondary" onclick="document.getElementById('cover_letter_upload').click()">
                                                <i class="fas fa-upload"></i> Upload Template
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden file inputs -->
                    <form id="document-upload-form" method="POST" enctype="multipart/form-data" style="display: none;">
                        <input type="file" id="cv_upload" name="cv_file" accept=".pdf,.doc,.docx" onchange="uploadDocument(this, 'cv')">
                        <input type="file" id="cover_letter_upload" name="cover_letter_file" accept=".pdf,.doc,.docx" onchange="uploadDocument(this, 'cover_letter')">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function uploadDocument(input, type) {
            if (input.files && input.files[0]) {
                const formData = new FormData();
                formData.append(type === 'cv' ? 'cv_file' : 'cover_letter_file', input.files[0]);
                formData.append('document_type', type);

                fetch('upload_document.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Document uploaded successfully',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || 'Error uploading document'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error uploading document'
                        });
                    });
            }
        }

        function deleteDocument(type) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('delete_document.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                document_type: type
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Your file has been deleted.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                throw new Error(data.message || 'Error deleting document');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: error.message || 'Error deleting document'
                            });
                        });
                }
            });
        }
        // Add this to your existing <script> section
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const currentImage = document.querySelector('.current-profile-image img');
                    if (currentImage) {
                        currentImage.src = e.target.result;
                    } else {
                        const newImage = document.createElement('img');
                        newImage.src = e.target.result;
                        document.querySelector('.current-profile-image').innerHTML = '';
                        document.querySelector('.current-profile-image').appendChild(newImage);
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        document.querySelector('.profile-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            // Add the profile image file if it exists
            const profileImageInput = document.getElementById('profile_image');
            if (profileImageInput.files.length > 0) {
                formData.append('profile_image', profileImageInput.files[0]);
            }

            fetch('profile.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(html => {
                    // Execute any script tags in the response
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const scripts = doc.getElementsByTagName('script');
                    for (let script of scripts) {
                        if (script.innerHTML) {
                            eval(script.innerHTML);
                        }
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An unexpected error occurred'
                    });
                });
        });
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
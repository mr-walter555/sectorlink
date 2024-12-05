<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->

</head>

<body>

    <nav class="navbar">
        <div class="nav-brand">
            <img src="./images/logo-removebg-preview.png" alt="<?php echo $siteName ?? 'Company Logo'; ?>" class="nav-logo">
            <span class="nav-brand-text"> <b>SECTOR LINK</b></span>
        </div>

        <div class="mobile-controls">
            <div class="mobile-profile">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="#" class="user-icon">
                        <?php
                        $stmt = $pdo->prepare("SELECT fullname, profile_image FROM users WHERE id = ?");
                        $stmt->execute([$_SESSION['user_id']]);
                        $user = $stmt->fetch();
                        if (!empty($user['profile_image'])): ?>
                            <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        <?php else: ?>
                            <span class="welcome-text">
                                <span class="first-letter"><?php echo isset($user['fullname']) ? substr($user['fullname'], 0, 1) : 'U'; ?></span>
                            </span>
                        <?php endif; ?>
                    </a>
                    <div class="mobile-sidebar">
                        <div class="sidebar-header">
                            <h3>Menu</h3>
                            <button class="close-sidebar">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="sidebar-content">
                            <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>
                    <div class="sidebar-overlay"></div>
                <?php else: ?>
                    <a href="login.php" class="user-icon">
                        <i class="fa-regular fa-user"></i>
                    </a>
                <?php endif; ?>
            </div>
            <div class="hamburger-menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <div class="dropdown">
                <button class="dropdown-toggle">
                    Services 
                </button>
                <div class="dropdown-menu">
                    <a href="healthcare.php">Healthcare Staffing</a>
                    <a href="permanent.php">Permanent Recruitment</a>
                    <a href="temporary.php">Temporary Recruitment</a>
                </div>
            </div>
            <a href="live-jobs.php">Live Jobs</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="nav-buttons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="user-dropdown">
                    <a href="#" class="user-icon">
                        <?php
                        $stmt = $pdo->prepare("SELECT fullname, profile_image FROM users WHERE id = ?");
                        $stmt->execute([$_SESSION['user_id']]);
                        $user = $stmt->fetch();
                        if (!empty($user['profile_image'])): ?>
                            <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        <?php else: ?>
                            <span class="welcome-text">
                                <span class="first-letter"><?php echo isset($user['fullname']) ? substr($user['fullname'], 0, 1) : 'U'; ?></span>
                            </span>
                        <?php endif; ?>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="user-dropdown-menu">
                        <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                        <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php" class="user-icon">
                    <i class="fa-regular fa-user"></i>
                </a>
                <a href="register.php" class="register-btn">Register</a>
            <?php endif; ?>
        </div>
    </nav>

    <style>
        .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 2rem;
            cursor: pointer;
            color: var(--text-color);
            display: none;
        }

        @media (max-width: 768px) {
            .close-btn {
                display: block;
            }

            .nav-links {
                position: fixed;
                right: -100%;
                top: 70px;
                flex-direction: column;
                background-color: #fff;
                width: 80%;
                height: calc(100vh - 70px);
                padding: 2rem 1rem;
                transition: 0.3s ease;
                box-shadow: -2px 0 4px rgba(0, 0, 0, 0.1);
                z-index: 999;
            }

            .nav-links.active {
                right: 0;
            }

            .nav-buttons {
                position: absolute;
                top: 15px;
                right: 60px;
                display: flex;
                align-items: center;
                gap: 1rem;
                padding: 0;
                background: none;
                box-shadow: none;
            }
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .profile-icon {
            font-size: 1.5rem;
            color: var(--primary-color);
            cursor: pointer;
            padding: 8px;
            border: 2px solid var(--primary-color);
            border-radius: 50%;
        }

        @media (max-width: 768px) {
            .profile-icon {
                font-size: 1.2rem;
                padding: 6px;
            }
        }

        .mobile-controls {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-controls {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .mobile-profile {
                display: flex;
                align-items: center;
            }

            .mobile-profile-img {
                width: 35px;
                height: 35px;
                border-radius: 50%;
                object-fit: cover;
            }

            .nav-buttons {
                display: none;
            }

            .mobile-profile .welcome-text {
                width: 35px;
                height: 35px;
                background: var(--primary-color);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
            }

            .mobile-profile .dropdown-content {
                position: absolute;
                top: 100%;
                right: 0;
                background: white;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                border-radius: 4px;
                min-width: 150px;
                z-index: 1000;
            }
        }

        .hamburger-menu {
            cursor: pointer;
            z-index: 1000;
        }

        .hamburger-menu .bar {
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 5px 0;
            transition: 0.4s;
        }

        .hamburger-menu.active .bar:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 6px);
        }

        .hamburger-menu.active .bar:nth-child(2) {
            opacity: 0;
        }

        .hamburger-menu.active .bar:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -6px);
        }

        /* New hover dropdown styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-size: inherit;
            color: inherit;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .dropdown-toggle i {
            font-size: 0.8em;
            transition: transform 0.3s ease;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
            min-width: 200px;
            z-index: 1000;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .dropdown-menu a:hover {
            background-color: #f5f5f5;
        }

        /* Desktop dropdown behavior */
        @media (min-width: 769px) {
            .dropdown:hover .dropdown-menu {
                display: block;
            }

            .dropdown:hover .dropdown-toggle i {
                transform: rotate(180deg);
            }
        }

        /* Mobile dropdown behavior */
        @media (max-width: 768px) {
            .dropdown-toggle.active+.dropdown-menu {
                display: block;
            }

            .dropdown-toggle.active i {
                transform: rotate(180deg);
            }

            .dropdown-menu {
                position: static;
                box-shadow: none;
                background: #f5f5f5;
                width: 100%;
            }
        }

        /* User dropdown styles */
        .user-dropdown {
            position: relative;
            display: inline-block;
            z-index: 1001;
        }

        .user-icon {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .user-icon i {
            transition: transform 0.3s ease;
        }

        .user-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            border-radius: 4px;
            min-width: 200px;
            z-index: 1001;
            margin-top: 5px;
        }

        .user-dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .user-dropdown-menu a:hover {
            background-color: #f5f5f5;
        }

        /* Desktop behavior */
        @media (min-width: 769px) {
            .user-dropdown:hover .user-dropdown-menu {
                display: block;
            }
            
            .user-dropdown:hover .user-icon i {
                transform: rotate(180deg);
            }
        }

        /* Mobile behavior */
        @media (max-width: 768px) {
            .user-dropdown.active .user-dropdown-menu {
                display: block;
            }
            
            .user-dropdown.active .user-icon i {
                transform: rotate(180deg);
            }
        }

        /* Add this new class */
        .user-dropdown.show .user-dropdown-menu {
            display: block;
        }

        .user-dropdown.show .user-icon i {
            transform: rotate(180deg);
        }

        .mobile-sidebar {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            max-width: 400px;
            height: 30vh;
            background: white;
            z-index: 1003;
            transition: right 0.3s ease;
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .mobile-sidebar.active {
            right: 0;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .close-sidebar {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px;
        }

        .sidebar-content {
            padding: 20px;
            overflow-y: auto;
        }

        .sidebar-content a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 10px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        .sidebar-content a:hover {
            background-color: #f5f5f5;
        }

        .sidebar-content i {
            width: 20px;
            text-align: center;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1002;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Ensure the mobile profile container doesn't affect the sidebar positioning */
        .mobile-profile {
            position: static;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector(".mobile-controls .hamburger-menu");
            const navLinks = document.querySelector(".nav-links");

            console.log('Hamburger element:', hamburger); // Debug line
            console.log('Nav links element:', navLinks); // Debug line

            if (hamburger && navLinks) {
                hamburger.addEventListener("click", () => {
                    console.log('Hamburger clicked'); // Debug line
                    hamburger.classList.toggle("active");
                    navLinks.classList.toggle("active");
                });

                // Only close menu for non-dropdown links
                document.querySelectorAll(".nav-links a:not(.dropdown-toggle):not(.dropdown-item)").forEach(n => n.addEventListener("click", () => {
                    hamburger.classList.remove("active");
                    navLinks.classList.remove("active");
                }));
            }

            // Add dropdown toggle functionality for mobile
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', (e) => {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        toggle.classList.toggle('active');
                    }
                });
            });

            // User dropdown functionality for mobile
            const userDropdowns = document.querySelectorAll('.user-dropdown');
            
            userDropdowns.forEach(dropdown => {
                const toggleButton = dropdown.querySelector('.user-icon');
                
                toggleButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    // Close all other dropdowns
                    userDropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            otherDropdown.classList.remove('show');
                        }
                    });
                    // Toggle current dropdown
                    dropdown.classList.toggle('show');
                });
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                userDropdowns.forEach(dropdown => {
                    if (!dropdown.contains(e.target)) {
                        dropdown.classList.remove('show');
                    }
                });
            });

            // Add sidebar functionality
            const mobileProfiles = document.querySelectorAll('.mobile-profile');
            
            mobileProfiles.forEach(profile => {
                const toggleButton = profile.querySelector('.user-icon');
                const sidebar = profile.querySelector('.mobile-sidebar');
                const overlay = profile.querySelector('.sidebar-overlay');
                const closeButton = profile.querySelector('.close-sidebar');
                
                if (toggleButton && sidebar && overlay) {
                    // Open sidebar
                    toggleButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        sidebar.classList.add('active');
                        overlay.classList.add('active');
                        document.body.style.overflow = 'hidden'; // Prevent background scrolling
                    });

                    // Close sidebar functions
                    const closeSidebar = () => {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                        document.body.style.overflow = ''; // Restore scrolling
                    };

                    // Close with button
                    closeButton.addEventListener('click', closeSidebar);

                    // Close with overlay
                    overlay.addEventListener('click', closeSidebar);

                    // Close with escape key
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape') {
                            closeSidebar();
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>
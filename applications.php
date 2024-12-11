<?php
session_start();

// Check if admin is logged in
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
    <title>Applications - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .applications-container {
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .search-box {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 80px;
            font-size: 14px;
        }

        .search-box:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
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

        .status-select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
        }

        .status-select:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .no-applications {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }

        .no-applications i {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .no-applications p {
            font-size: 18px;
            margin: 0;
        }

        .btn-action {
            padding: 8px 12px;
            margin: 0 4px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-view {
            background-color: #ffc107;
            color: #000;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-action:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <!-- Add this navbar section at the top of each admin page (after <body>) -->
    <nav class="dashboard-nav">
        <div class="nav-container">
            <div class="nav-brand">
                <button class="sidebar-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="admin_dashboard.php">
                    
                </a>
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
                <h1>Applications</h1>
            </div>
            <div class="search-bar">
                <input type="text" id="searchBox" placeholder="Search applications..." onkeyup="searchTable()">
            </div>
            <div class="applications-container">
                <div class="applications-list">
                    <?php
                    require_once 'config/database.php';

                    try {
                        // First get all applications
                        $applications_query = "SELECT * FROM applications ORDER BY applied_at DESC";
                        $applications_stmt = $pdo->prepare($applications_query);
                        $applications_stmt->execute();
                        $applications = $applications_stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($applications && !empty($applications)) {
                            // Get all jobs and users needed for these applications
                            $job_ids = array_column($applications, 'job_id');
                            $user_ids = array_column($applications, 'user_id');

                            // Only proceed with these queries if we have IDs
                            if (!empty($job_ids) && !empty($user_ids)) {
                                // Get jobs info
                                $jobs_query = "SELECT id, job_title, position FROM jobs WHERE id IN (" .
                                    str_repeat('?,', count($job_ids) - 1) . '?)';
                                $jobs_stmt = $pdo->prepare($jobs_query);
                                $jobs_stmt->execute($job_ids);
                                $jobs = $jobs_stmt->fetchAll(PDO::FETCH_ASSOC);
                                $jobs_map = array_column($jobs, null, 'id');

                                // Get users info
                                $users_query = "SELECT id, fullname FROM users WHERE id IN (" .
                                    str_repeat('?,', count($user_ids) - 1) . '?)';
                                $users_stmt = $pdo->prepare($users_query);
                                $users_stmt->execute($user_ids);
                                $users = $users_stmt->fetchAll(PDO::FETCH_ASSOC);
                                $users_map = array_column($users, null, 'id');

                                // Now render the table
                    ?>
                                <table class="applications-table" id="applicationsTable">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Job Title</th>
                                            <th>Position</th>
                                            <th>Application Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($applications as $application) {
                                            $status = empty($application['status']) ? 'pending' : $application['status'];
                                            $status_class = strtolower($status);
                                            $job = $jobs_map[$application['job_id']] ?? [];
                                            $user = $users_map[$application['user_id']] ?? [];
                                        ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($user['fullname'] ?? 'Unknown'); ?></td>
                                                <td><?php echo htmlspecialchars($job['job_title'] ?? 'Unknown'); ?></td>
                                                <td><?php echo htmlspecialchars($job['position'] ?? 'Unknown'); ?></td>
                                                <td><?php echo date('M d, Y', strtotime($application['applied_at'])); ?></td>
                                                <td>
                                                    <span class="status <?php echo htmlspecialchars($status_class); ?>">
                                                        <?php echo htmlspecialchars($status); ?>
                                                    </span>
                                                </td>
                                                <td class="action-buttons">
                                                    <button class="btn-action btn-view"
                                                        onclick="window.location.href='view_application.php?id=<?php echo htmlspecialchars($application['id']); ?>'">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <button class="btn-action btn-success"
                                                        data-id="<?php echo htmlspecialchars($application['id']); ?>"
                                                        onclick="updateStatus('<?php echo htmlspecialchars($application['id']); ?>', 'shortlisted')"
                                                        <?php echo $status === 'shortlisted' ? 'disabled' : ''; ?>>
                                                        <i class="fas fa-check"></i>
                                                    </button>

                                                    <button class="btn-action btn-delete"
                                                        data-id="<?php echo htmlspecialchars($application['id']); ?>"
                                                        onclick="updateStatus('<?php echo htmlspecialchars($application['id']); ?>', 'rejected')"
                                                        <?php echo $status === 'rejected' ? 'disabled' : ''; ?>>
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                    <?php
                            } else {
                                echo '<div class="no-applications">
                                        <i class="fas fa-file-alt"></i>
                                        <p>No valid applications found.</p>
                                      </div>';
                            }
                        } else {
                            echo '<div class="no-applications">
                                    <i class="fas fa-file-alt"></i>
                                    <p>No applications found.</p>
                                  </div>';
                        }
                    } catch (PDOException $e) {
                        error_log("Database Error: " . $e->getMessage());
                        echo '<div class="no-applications">
                                <i class="fas fa-exclamation-triangle"></i>
                                <p>An error occurred while fetching applications.</p>
                              </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function searchTable() {
            const input = document.getElementById('searchBox');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('applicationsTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header row
                const cells = rows[i].getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length - 1; j++) { // Skip last column (actions)
                    const cell = cells[j];
                    if (cell) {
                        const text = cell.textContent || cell.innerText;
                        if (text.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }

                rows[i].style.display = found ? '' : 'none';
            }
        }

        function updateStatus(applicationId, newStatus) {
            console.log('Updating status:', applicationId, newStatus); // Debug log

            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to mark this application as ${newStatus}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('application_id', applicationId);
                    formData.append('status', newStatus);

                    fetch('update_application_status.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Server response:', data); // Debug log

                            if (data.success) {
                                // Update UI
                                const row = document.querySelector(`button[data-id="${applicationId}"]`).closest('tr');
                                const statusCell = row.querySelector('td:nth-child(5)');

                                statusCell.innerHTML = `
                            <span class="status ${newStatus.toLowerCase()}">
                                ${newStatus}
                            </span>
                        `;

                                // Update button states
                                const shortlistBtn = row.querySelector('.btn-success');
                                const rejectBtn = row.querySelector('.btn-delete');

                                if (shortlistBtn) shortlistBtn.disabled = (newStatus === 'shortlisted');
                                if (rejectBtn) rejectBtn.disabled = (newStatus === 'rejected');

                                Swal.fire('Updated!', data.message, 'success');
                            } else {
                                Swal.fire('Error!', data.message, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error!', 'Failed to update status: ' + error.message, 'error');
                        });
                }
            });
        }
    </script>
    <!-- Add this script section at the bottom of each admin page (before </body>) -->
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
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

    // Modified query to include status in ORDER BY
    $stmt = $conn->query("SELECT * FROM jobs ORDER BY status DESC, created_at DESC");
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Jobs - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="admin_dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <!-- Add this navbar section at the top of each admin page (after <body>) -->
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
    </nav>
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
                <h1>Manage Jobs</h1>
                <p class="subtitle">View and manage all job listings</p>
            </div>

            <div class="search-bar">
                <input type="text" id="searchJobs" placeholder="Search jobs..." onkeyup="searchJobs()">
            </div>



            <table class="jobs-table">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Position</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Posted Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jobs as $job): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($job['job_title']); ?></td>
                            <td><?php echo htmlspecialchars($job['position']); ?></td>
                            <td><?php echo htmlspecialchars($job['location']); ?></td>
                            <td><?php echo htmlspecialchars($job['employment_type']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($job['created_at'])); ?></td>
                            <td>
                                <?php
                                $status = isset($job['status']) ? $job['status'] : 'active';  // Default to active if not set
                                $statusClass = $status == 'active' ? 'status-active' : 'status-inactive';
                                ?>
                                <span class="status-badge <?php echo $statusClass; ?>">
                                    <?php echo ucfirst($status); ?>
                                </span>
                            </td>
                            <td class="action-buttons">
                                <button class="btn-action btn-view" onclick="viewJob(<?php echo $job['id']; ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <button class="btn-action <?php echo $status == 'active' ? 'btn-warning' : 'btn-success'; ?>"
                                    onclick="toggleStatus(<?php echo $job['id']; ?>, '<?php echo $status; ?>')">
                                    <i class="fas <?php echo $status == 'active' ? 'fa-pause' : 'fa-play'; ?>"></i>
                                </button>
                                <button class="btn-action btn-delete" onclick="deleteJob(<?php echo $job['id']; ?>)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <script>
        function searchJobs() {
            const input = document.getElementById('searchJobs');
            const filter = input.value.toUpperCase();
            const table = document.querySelector('.jobs-table');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td');
                let txtValue = '';
                for (let j = 0; j < td.length - 1; j++) {
                    txtValue += td[j].textContent || td[j].innerText;
                }
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }

        function filterJobs() {
            // Implementation similar to searchJobs but for filters
        }

        function viewJob(id) {
            window.location.href = `view_job.php?id=${id}`;
        }

        function editJob(id) {
            window.location.href = `edit_job.php?id=${id}`;
        }

        function deleteJob(id) {
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
                    // Send delete request
                    fetch(`delete_job.php?id=${id}`, {
                            method: 'DELETE'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'Job has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete job.',
                                    'error'
                                );
                            }
                        });
                }
            });
        }

        function toggleStatus(id, currentStatus) {
            const newStatus = currentStatus === 'active' ? 'inactive' : 'active';

            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to change the status to ${newStatus}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`update_job_status.php?id=${id}&status=${newStatus}`, {
                            method: 'POST'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Updated!',
                                    'Job status has been updated.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Failed to update status.',
                                    'error'
                                );
                            }
                        });
                }
            });
        }
    </script>

    <?php if (isset($_SESSION['swal_message'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: '<?php echo $_SESSION['swal_message']['icon']; ?>',
                    title: '<?php echo $_SESSION['swal_message']['title']; ?>',
                    text: '<?php echo $_SESSION['swal_message']['text']; ?>',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    <?php
        unset($_SESSION['swal_message']);
    endif;
    ?>
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
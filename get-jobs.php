<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "sectorlink");

// Add error handling for connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Build the query with filters
$conditions = ["status = 'active'"];
$params = [];

// Keyword search
if (!empty($_GET['keyword'])) {
    $conditions[] = "(job_title LIKE ? OR job_description LIKE ?)";
    $keyword = '%' . $_GET['keyword'] . '%';
    $params[] = $keyword;
    $params[] = $keyword;
}

// Location filter
if (!empty($_GET['location'])) {
    $conditions[] = "location LIKE ?";
    $params[] = '%' . $_GET['location'] . '%';
}

// Job type filter
if (!empty($_GET['job_type'])) {
    $conditions[] = "employment_type = ?";
    $params[] = $_GET['job_type'];
}

// Experience level filter
if (!empty($_GET['experience'])) {
    $experienceLevels = $_GET['experience'];
    if (is_array($experienceLevels)) {
        $placeholders = str_repeat('?,', count($experienceLevels) - 1) . '?';
        $conditions[] = "experience IN ($placeholders)";
        foreach ($experienceLevels as $level) {
            $params[] = $level;
        }
    }
}

// Industry filter
if (!empty($_GET['industry'])) {
    $industries = $_GET['industry'];
    if (is_array($industries)) {
        $placeholders = str_repeat('?,', count($industries) - 1) . '?';
        $conditions[] = "industry IN ($placeholders)";
        $params = array_merge($params, $industries);
    } else {
        $conditions[] = "industry = ?";
        $params[] = $industries;
    }
}

// Handle salary range filter
if (!empty($_GET['salary_range'])) {
    $salaryConditions = [];
    foreach ($_GET['salary_range'] as $range) {
        if ($range === '120000+') {
            $salaryConditions[] = "CAST(SUBSTRING_INDEX(REGEXP_REPLACE(salary_range, '[^0-9]', ' '), ' ', 1) AS UNSIGNED) >= 120000";
        } else {
            list($min, $max) = explode('-', $range);
            $salaryConditions[] = "(
                CAST(SUBSTRING_INDEX(REGEXP_REPLACE(salary_range, '[^0-9]', ' '), ' ', 1) AS UNSIGNED) >= ? 
                AND CAST(SUBSTRING_INDEX(REGEXP_REPLACE(salary_range, '[^0-9]', ' '), ' ', 1) AS UNSIGNED) <= ?
            )";
            $params[] = intval($min);
            $params[] = intval($max);
        }
    }
    if (!empty($salaryConditions)) {
        $conditions[] = "(" . implode(" OR ", $salaryConditions) . ")";
    }
}

// Combine all conditions
$query = "SELECT * FROM jobs";
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}
$query .= " ORDER BY posted_date DESC";

// Prepare and execute the query
$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    die("Query preparation failed: " . mysqli_error($conn));
}

if (!empty($params)) {
    $types = str_repeat('s', count($params));
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

if (!mysqli_stmt_execute($stmt)) {
    die("Query execution failed: " . mysqli_stmt_error($stmt));
}

$result = mysqli_stmt_get_result($stmt);

$total_jobs = mysqli_num_rows($result);
?>

<!-- Results count -->
<div class="results-count mb-4">
    <p>Showing <?php echo $total_jobs; ?> jobs</p>
</div>

<div class="row">
    <?php
    if($total_jobs > 0) {
        while($job = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-lg-6">
                <div class="job-card">
                    <div class="job-header">
                        <div class="job-title-group"> 
                            <?php
                            $posted_date = strtotime($job['created_at']);
                            $current_date = time();
                            $days_ago = floor(($current_date - $posted_date) / (60 * 60 * 24));
                            
                            $date_text = '';
                            if($days_ago == 0) {
                                $date_text = 'Today';
                            } elseif($days_ago == 1) {
                                $date_text = 'Yesterday'; 
                            } else {
                                $date_text = $days_ago . ' days ago';
                            }
                            ?>
                            <span class="posted-date"><?php echo $date_text; ?></span>
                            <h3><?php echo htmlspecialchars($job['job_title']); ?></h3>
                        </div>
                        <div class="job-type"><?php echo htmlspecialchars($job['employment_type']); ?></div>
                    </div>
                    <div class="job-details">
                        <div class="job-location"><?php echo htmlspecialchars($job['location']); ?></div>
                        <div class="job-salary"><?php echo '£' . htmlspecialchars($job['salary_range']); ?></div>
                        <div class="job-description">
                            <?php 
                            // Truncate description to 150 characters
                            $desc = htmlspecialchars(strip_tags($job['job_description']));
                            echo strlen($desc) > 150 ? substr($desc, 0, 147) . '...' : $desc;
                            ?>
                        </div>
                        <a href="apply.php?job_id=<?php echo $job['id']; ?>" class="apply-btn">
                            Apply Now
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo '<div class="col-12"><p class="text-center">No jobs found</p></div>';
    }
    mysqli_close($conn);
    ?>
</div>
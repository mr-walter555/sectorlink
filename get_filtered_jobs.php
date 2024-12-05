<?php
require_once 'config/database.php';

// Build the query
$query = "SELECT * FROM jobs WHERE 1=1";
$params = [];

// Salary Range Filter
if (!empty($_GET['min_salary'])) {
    $query .= " AND CAST(REGEXP_REPLACE(salary_range, '[^0-9]', '') AS UNSIGNED) >= ?";
    $params[] = $_GET['min_salary'];
}
if (!empty($_GET['max_salary'])) {
    $query .= " AND CAST(REGEXP_REPLACE(salary_range, '[^0-9]', '') AS UNSIGNED) <= ?";
    $params[] = $_GET['max_salary'];
}

// Experience Level Filter
if (!empty($_GET['experience'])) {
    $placeholders = str_repeat('?,', count($_GET['experience']) - 1) . '?';
    $query .= " AND experience_level IN ($placeholders)";
    $params = array_merge($params, $_GET['experience']);
}

// Industry Filter - Enhanced version
if (!empty($_GET['industry'])) {
    // Define valid industries
    $valid_industries = [
        'Healthcare',
        'IT',
        'Finance',
        'Education',
        'Construction',
        'Hospitality',
        'Retail',
        'Manufacturing',
        'Legal',
        'Creative',
        'Telecommunications',
        'Energy',
        'Government',
        'Pharmaceutical',
        'Aviation',
        'Customer-Service'
    ];
    
    // Filter and validate incoming industries
    $selected_industries = array_filter($_GET['industry'], function($industry) use ($valid_industries) {
        return in_array($industry, $valid_industries);
    });
    
    if (!empty($selected_industries)) {
        $placeholders = str_repeat('?,', count($selected_industries) - 1) . '?';
        $query .= " AND industry IN ($placeholders)";
        $params = array_merge($params, $selected_industries);
    }
}

// Posted Date Filter
if (!empty($_GET['posted_date'])) {
    switch ($_GET['posted_date']) {
        case '24h':
            $query .= " AND created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY)";
            break;
        case '7d':
            $query .= " AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
            break;
        case '14d':
            $query .= " AND created_at >= DATE_SUB(NOW(), INTERVAL 14 DAY)";
            break;
        case '30d':
            $query .= " AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
            break;
    }
}

$query .= " ORDER BY created_at DESC";

// Prepare and execute the query
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output job cards
foreach ($jobs as $job) {
    ?>
    <div class="col-lg-6">
        <div class="job-card">
            <span class="posted-date">Posted <?php 
                $created_date = new DateTime($job['created_at']);
                $now = new DateTime();
                $days_ago = $created_date->diff($now)->days;
                
                if($days_ago == 0) {
                    echo "today";
                } elseif($days_ago == 1) {
                    echo "yesterday";
                } elseif($days_ago < 7) {
                    echo $days_ago . " days ago";
                } elseif($days_ago < 30) {
                    echo floor($days_ago/7) . " weeks ago";
                } elseif($days_ago < 365) {
                    echo floor($days_ago/30) . " months ago";
                } else {
                    echo floor($days_ago/365) . " years ago";
                }
            ?></span>
            <div class="job-header">
                <div class="job-title-group">
                    <h3><?php echo htmlspecialchars($job['job_title']); ?></h3>
                </div>
                <div class="job-type"><?php echo htmlspecialchars($job['employment_type']); ?></div>
            </div>
            <div class="job-details">
                <div class="job-location"><?php echo htmlspecialchars($job['location']); ?></div>
                <div class="job-salary"><?php echo htmlspecialchars($job['salary_range']); ?></div>
            </div>
        </div>
    </div>
    <?php
} 
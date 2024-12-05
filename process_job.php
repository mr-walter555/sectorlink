<?php
header('Content-Type: application/json');
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_username'])) {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit();
}

try {
    // Database connection
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "sectorlink";

    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get form data
    $job_title = $_POST['job_title'] ?? '';
    $position = $_POST['position'] ?? '';
    $location = $_POST['location'] ?? '';
    $salary_range = $_POST['salary_range'] ?? '';
    $employment_type = $_POST['employment_type'] ?? '';
    $experience = $_POST['experience'] ?? '';
    $job_description = $_POST['job_description'] ?? '';
    $requirements = $_POST['requirements'] ?? '';
    $benefits = $_POST['benefits'] ?? '';
    $industry = $_POST['industry'] ?? '';

    // Validate required fields
    if (empty($job_title) || empty($position) || empty($location) || empty($employment_type) || 
        empty($experience) || empty($job_description) || empty($requirements)) {
        throw new Exception('Please fill in all required fields');
    }

    // Prepare SQL statement
    $sql = "INSERT INTO jobs (job_title, position, location, salary_range, employment_type, 
            experience, job_description, requirements, benefits, industry, created_at) 
            VALUES (:job_title, :position, :location, :salary_range, :employment_type, 
            :experience, :job_description, :requirements, :benefits, :industry, :created_at)";

    $stmt = $conn->prepare($sql);

    // Get current timestamp
    $currentTimestamp = date('Y-m-d H:i:s');
    // Bind parameters
    $stmt->bindParam(':job_title', $job_title);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':salary_range', $salary_range);
    $stmt->bindParam(':employment_type', $employment_type);
    $stmt->bindParam(':experience', $experience);
    $stmt->bindParam(':job_description', $job_description);
    $stmt->bindParam(':requirements', $requirements);
    $stmt->bindParam(':benefits', $benefits);
    $stmt->bindParam(':industry', $industry);
    $stmt->bindParam(':created_at', $currentTimestamp);

    // Execute the statement
    $stmt->execute();

    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Job posted successfully'
    ]);

} catch (Exception $e) {
    // Log the error (in a production environment)
    error_log($e->getMessage());

    // Return error response
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred: ' . $e->getMessage()
    ]);
}
?> 
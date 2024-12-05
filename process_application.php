<?php
session_start();
require_once 'config/database.php';

// Initialize response array
$response = [
    'status' => 'error',
    'message' => ''
];

try {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Please login to apply');
    }

    // Validate inputs
    if (!isset($_POST['job_id']) || !isset($_POST['phone'])) {
        throw new Exception('All fields are required');
    }

    $job_id = filter_var($_POST['job_id'], FILTER_SANITIZE_NUMBER_INT);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $user_id = $_SESSION['user_id'];

    // Check if already applied
    $stmt = $pdo->prepare("SELECT id FROM applications WHERE user_id = ? AND job_id = ?");
    $stmt->execute([$user_id, $job_id]);
    if ($stmt->rowCount() > 0) {
        throw new Exception('You have already applied for this job');
    }

    // Handle CV upload if provided
    $cv_path = null;
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        if (!in_array($_FILES['cv']['type'], $allowedTypes)) {
            throw new Exception('Invalid file type. Only PDF, DOC, and DOCX files are allowed');
        }

        $cv_path = 'uploads/cv_' . uniqid() . '_' . basename($_FILES['cv']['name']);
        move_uploaded_file($_FILES['cv']['tmp_name'], $cv_path);
    }

    // Start transaction
    $pdo->beginTransaction();

    // Update user's phone number
    $stmt = $pdo->prepare("UPDATE users SET phone = ? WHERE id = ?");
    $stmt->execute([$phone, $user_id]);

    // Update user's CV path
    if ($cv_path) {
        $stmt = $pdo->prepare("UPDATE users SET cv_path = ? WHERE id = ?");
        $stmt->execute([$cv_path, $user_id]);
    }

    // Insert application
    $stmt = $pdo->prepare("INSERT INTO applications (user_id, job_id, status, applied_at) 
                          VALUES (?, ?, 'pending', NOW())");
    
    $stmt->execute([
        $user_id,
        $job_id
    ]);

    // Commit transaction
    $pdo->commit();

    $response['status'] = 'success';
    $response['message'] = 'Your application has been submitted successfully!';

} catch (Exception $e) {
    // Rollback transaction if started
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    // Delete uploaded file if exists
    if (isset($cv_path) && file_exists($cv_path)) {
        unlink($cv_path);
    }

    $response['message'] = $e->getMessage();
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response); 
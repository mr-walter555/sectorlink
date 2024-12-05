<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_username'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

// Validate required parameters
if (!isset($_POST['application_id']) || !isset($_POST['status'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit();
}

require_once 'config/database.php';

try {
    // Validate status value
    $allowed_statuses = ['pending', 'reviewing', 'shortlisted', 'rejected'];
    $status = strtolower($_POST['status']);
    
    if (!in_array($status, $allowed_statuses)) {
        echo json_encode(['success' => false, 'message' => 'Invalid status value']);
        exit();
    }

    // Update the application status
    $query = "UPDATE applications SET status = :status, updated_at = NOW() WHERE id = :id";
    $stmt = $pdo->prepare($query);
    
    $result = $stmt->execute([
        ':status' => $status,
        ':id' => $_POST['application_id']
    ]);

    if ($result) {
        echo json_encode([
            'success' => true, 
            'message' => 'Application status updated successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to update application status'
        ]);
    }

} catch (PDOException $e) {
    error_log($e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Database error occurred'
    ]);
}
?> 
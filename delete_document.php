<?php
session_start();
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not authenticated']);
    exit;
}

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);
$document_type = $data['document_type'] ?? '';
$user_id = $_SESSION['user_id'];

try {
    // Get current document path
    $column = ($document_type === 'cv') ? 'cv_path' : 'cover_letter_path';
    $stmt = $pdo->prepare("SELECT $column FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    
    if (!$user || empty($user[$column])) {
        echo json_encode(['success' => false, 'message' => 'Document not found']);
        exit;
    }

    // Delete the physical file
    $file_path = $user[$column];
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Update database to remove the file reference
    $stmt = $pdo->prepare("UPDATE users SET $column = NULL WHERE id = ?");
    $stmt->execute([$user_id]);

    echo json_encode(['success' => true, 'message' => 'Document deleted successfully']);

} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error deleting document: ' . $e->getMessage()]);
}
?> 
<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    die(json_encode(['success' => false, 'message' => 'Not authenticated']));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['success' => false, 'message' => 'Invalid request method']));
}

$user_id = $_SESSION['user_id'];
$document_type = $_POST['document_type'];
$upload_dir = 'uploads/documents/';

// Create directory if it doesn't exist
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

try {
    // Start transaction
    $pdo->beginTransaction();

    // Get existing document path
    $column = $document_type === 'cv' ? 'cv_path' : 'cover_letter_path';
    $stmt = $pdo->prepare("SELECT $column FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $existing_path = $stmt->fetchColumn();

    // Handle file upload
    if ($document_type === 'cv') {
        $file = $_FILES['cv_file'];
    } else {
        $file = $_FILES['cover_letter_file'];
    }

    // Validate file type
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed_extensions = ['pdf', 'doc', 'docx'];
    $allowed_mime_types = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    if (!in_array($file_extension, $allowed_extensions)) {
        throw new Exception('Invalid file type. Only PDF, DOC, and DOCX files are allowed.');
    }

    // Validate file mime type
    $file_mime_type = mime_content_type($file['tmp_name']);
    if (!in_array($file_mime_type, $allowed_mime_types)) {
        throw new Exception('Invalid file type detected.');
    }

    // Generate new filename using user ID and timestamp for uniqueness
    $new_filename = $user_id . '_' . $document_type . '_' . time() . '.' . $file_extension;
    $file_path = $upload_dir . $new_filename;

    // Move uploaded file to destination
    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        // Update database with new file path
        $updated_at = $document_type === 'cv' ? 'updated_at' : 'updated_at';
        $stmt = $pdo->prepare("UPDATE users SET $column = ?, $updated_at = NOW() WHERE id = ?");
        $stmt->execute([$file_path, $user_id]);

        // Delete old file if it exists
        if ($existing_path && file_exists($existing_path)) {
            unlink($existing_path);
        }

        // Commit transaction
        $pdo->commit();

        echo json_encode([
            'success' => true, 
            'message' => 'File uploaded successfully',
            'file_path' => $file_path
        ]);
    } else {
        throw new Exception('Error uploading file');
    }

} catch (Exception $e) {
    // Rollback transaction
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    // Delete newly uploaded file if it exists
    if (isset($file_path) && file_exists($file_path)) {
        unlink($file_path);
    }

    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} 
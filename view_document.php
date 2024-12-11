<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    exit('Unauthorized');
}

$type = $_GET['type'] ?? '';
$user_id = $_SESSION['user_id'];

// Get document path from database
$stmt = $pdo->prepare("SELECT {$type}_path FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$result = $stmt->fetch();

if (!$result || empty($result["{$type}_path"])) {
    exit('Document not found');
}

$file_path = $result["{$type}_path"];

// Verify file exists
if (!file_exists($file_path)) {
    exit('File not found');
}

// Set appropriate headers
$mime_type = mime_content_type($file_path);
header('Content-Type: ' . $mime_type);
header('Content-Disposition: inline; filename="' . basename($file_path) . '"');

// Output file
readfile($file_path); 
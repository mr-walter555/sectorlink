<?php
// Initialize session and database connection
session_start();
require_once 'config/database.php'; // Ensure you have this file with your DB credentials

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Function to validate file upload
function validateFile($file, $maxSize = 5242880) { // 5MB max size
    $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    
    if ($file['size'] > $maxSize) {
        return "File size must be less than 5MB";
    }
    
    if (!in_array($file['type'], $allowedTypes)) {
        return "Only PDF, DOC, and DOCX files are allowed";
    }
    
    return true;
}

// Initialize response array
$response = [
    'status' => 'error',
    'message' => ''
];

try {
    // Check if it's a POST request
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    // Validate and sanitize inputs
    $fullname = sanitize_input($_POST['fullname'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Basic validation
    if (empty($fullname) || empty($email) || empty($password)) {
        throw new Exception('All fields are required');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format');
    }
    
    if ($password !== $confirm_password) {
        throw new Exception('Passwords do not match');
    }
    
    if (strlen($password) < 8) {
        throw new Exception('Password must be at least 8 characters long');
    }

    // Validate CV upload
    if (!isset($_FILES['cv']) || $_FILES['cv']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('CV file is required');
    }
    
    $cvValidation = validateFile($_FILES['cv']);
    if ($cvValidation !== true) {
        throw new Exception($cvValidation);
    }

    // Validate Cover Letter upload
    if (!isset($_FILES['cover_letter']) || $_FILES['cover_letter']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Cover Letter file is required');
    }
    
    $clValidation = validateFile($_FILES['cover_letter']);
    if ($clValidation !== true) {
        throw new Exception($clValidation);
    }

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        throw new Exception('Email already registered');
    }

    // Generate unique filenames
    $cvFileName = uniqid('cv_') . '_' . basename($_FILES['cv']['name']);
    $clFileName = uniqid('cl_') . '_' . basename($_FILES['cover_letter']['name']);
    
    // Set upload directory
    $uploadDir = 'uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Move uploaded files
    move_uploaded_file($_FILES['cv']['tmp_name'], $uploadDir . $cvFileName);
    move_uploaded_file($_FILES['cover_letter']['tmp_name'], $uploadDir . $clFileName);

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password, cv_path, cover_letter_path, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$fullname, $email, $hashedPassword, $cvFileName, $clFileName]);

    // Set success response
    $response['status'] = 'success';
    $response['message'] = 'Registration successful! Please login to continue.';

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

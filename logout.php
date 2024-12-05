<?php
session_start();

// Check if it's a regular user session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Clear all session variables
$_SESSION = array();

// Delete session cookie if it exists
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Clear remember me cookie if it exists
if (isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time()-3600, '/');
}

// Destroy the session
session_destroy();

// Redirect to index page
header("Location: index.php");
exit();
?>
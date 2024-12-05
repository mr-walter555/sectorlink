<?php
session_start();

// Check if it's an admin session
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.php");
    exit();
}

// Set session timeout to 30 minutes
$session_timeout = 1800; // 30 minutes in seconds

// Check if session has timed out
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    // Session has expired
    session_unset();
    session_destroy();
    header("Location: admin_login.php?timeout=1");
    exit();
}

// Update last activity timestamp
$_SESSION['last_activity'] = time();

// Store admin status before clearing session
$isAdmin = true;

// Clear all session variables
$_SESSION = array();

// Delete session cookie if it exists
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Clear remember me cookie if it exists
if (isset($_COOKIE['admin_remember_token'])) {
    setcookie('admin_remember_token', '', time()-3600, '/');
}

// Destroy the session
session_destroy();

// Redirect to admin login
header("Location: admin_login.php");
exit();
?>
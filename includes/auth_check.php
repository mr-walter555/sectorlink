<?php
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function checkSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Check if last activity was set
    if (isset($_SESSION['last_activity'])) {
        // Calculate how long ago was the last activity
        $inactive = 1800; // 30 minutes in seconds
        $session_life = time() - $_SESSION['last_activity'];
        
        if ($session_life > $inactive) {
            session_destroy();
            header("Location: login.php?message=session_expired");
            exit();
        }
    }
    
    // Update last activity time stamp
    $_SESSION['last_activity'] = time();
} 
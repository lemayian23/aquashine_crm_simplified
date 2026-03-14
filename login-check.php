<?php 
// Authorization - Access Control
// Check whether the user is logged in or not

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check both possible session variables for compatibility
if (!isset($_SESSION['user']) && !isset($_SESSION['username'])) {
    // User is not logged in
    // Redirect to login page with message
    
    $_SESSION['no-login-message'] = "<div class='text-center alert alert-info' id='login-message' style='color:#1a57b9;'>Please Login to Access Admin Panel.</div>";
    
    // Redirect to login page using SITEURL constant
    if (defined('SITEURL')) {
        header('Location: ' . SITEURL . '/login.php');
    } else {
        // Fallback if SITEURL not defined
        header('Location: login.php');
    }
    exit();
}

// Optional: Sync the session variables for compatibility
if (isset($_SESSION['user']) && !isset($_SESSION['username'])) {
    $_SESSION['username'] = $_SESSION['user'];
} elseif (isset($_SESSION['username']) && !isset($_SESSION['user'])) {
    $_SESSION['user'] = $_SESSION['username'];
}

// Optional: Add last activity check for timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    // Session expired (1 hour)
    session_unset();
    session_destroy();
    $_SESSION['no-login-message'] = "<div class='text-center alert alert-warning'>Session expired. Please login again.</div>";
    header('Location: ' . (defined('SITEURL') ? SITEURL : '') . '/login.php');
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>
<?php
// timeout.php - Session timeout handling

// Check if last activity is set
if (isset($_SESSION['last_activity'])) {
    // Calculate session lifetime (1 hour = 3600 seconds)
    $inactive = 3600;
    
    // Check if session has expired
    if (time() - $_SESSION['last_activity'] > $inactive) {
        // Session expired - destroy it
        session_unset();
        session_destroy();
        
        // Redirect to login page with message
        $_SESSION['timeout-message'] = "<div class='text-center alert alert-warning'>Your session has expired. Please login again.</div>";
        header('Location: ' . (defined('SITEURL') ? SITEURL : '') . '/login.php');
        exit();
    }
}

// Update last activity time
$_SESSION['last_activity'] = time();
?>
<?php
// Prevent direct access
if (!defined('SESSION_CHECK_INCLUDED')) {
    define('SESSION_CHECK_INCLUDED', true);
    
    // Include constants for site configuration - with error handling
    $constants_path = __DIR__ . '/config/constants.php';
    if (file_exists($constants_path)) {
        include_once($constants_path);
    } else {
        // Try relative path as fallback
        include_once('config/constants.php');
    }
}

function checkSessionTimeout() {
    // Set the timeout duration (in seconds)
    $timeout = 1800; // 30 minutes

    // Ensure session is started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Check if user is logged in (using either session variable)
    if (!isset($_SESSION['user']) && !isset($_SESSION['username'])) {
        // Not logged in, no need to check timeout
        return;
    }

    // Check if the user has been inactive for too long
    if (isset($_SESSION['last_activity'])) {
        $inactive_time = time() - $_SESSION['last_activity'];
        
        if ($inactive_time > $timeout) {
            // Debugging - log the timeout
            error_log("Session timeout for user: " . ($_SESSION['username'] ?? $_SESSION['user'] ?? 'unknown'));
            
            // Clear session and destroy
            $_SESSION = array(); // Clear all session variables
            
            // Destroy the session cookie
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            
            session_destroy();
            
            // Set timeout message
            session_start(); // Restart session to set message
            $_SESSION['timeout-message'] = "<div class='text-center alert alert-warning'>Your session has expired due to inactivity. Please login again.</div>";
            
            // Redirect using JavaScript for reliability
            $login_url = (defined('SITEURL') ? SITEURL : '') . '/login.php';
            echo '<script>
                alert("Session expired due to inactivity. Please login again.");
                window.location.href = "' . $login_url . '";
            </script>';
            exit();
        }
    }

    // Update the last activity time
    $_SESSION['last_activity'] = time();
}

// Call the function to check session timeout
checkSessionTimeout();
?>
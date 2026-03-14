<?php


//Start session securely
if (session_status() === PHP_SESSION_NONE) {
    //Set sucure session parameters
    session_set_cookie_params([
        'lifetime' => 3600, // 1 hour
        'path' => '/', 
        'domain' => '', //Set domain production here
        'secure'  => false, //Set true if using https
        'httponly' => true, //Prevent Javascript access
    ]);
    session_start();
} 

//Define constants with environment detection
$environment = 'production'; //Change to development for local

if ($environment === 'development') {
    //Local Development Settings

    define('SITEURL', 'http://localhost/aquashine');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'aquashine');
} else {
    //Production Settings (Current Live)
    define('SITEURL', 'http://iwt.simba.co.ke');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'simbawebco');
    define('DB_PASSWORD', '+iu[VIFUEhfd');
    define('DB_NAME', 'simbawebco_aquashin_business_db_lab');
}

//Database connection with improved error handling
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!conn) {
    //Log error sucurely (do not expose credentials)
    error_log("Database connection failed: " .mysqli_connect_error());

    //Show user-friendly message
    if ($environment === 'development'){
        die("Database Connection Error: " . mysqli_connect_error());
    } else {
        die("System temporarily unavailable. Please try again later.");
    }
}

//Set charset  to handle special characters
mysqli_set_charset($conn, "utf8mb4");

//Optional : Set timezone for database queries
mysqli_query($conn, "SET time_zone = '+03:00'"); //Nairobi timezone

?>
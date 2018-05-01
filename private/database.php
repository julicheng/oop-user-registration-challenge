<?php 

// Credentials
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'user_registration_challenge';

// 1. Create a database connection
function db_connect() {
    global $dbhost, $dbuser, $dbpass, $dbname;
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    confirm_db_connect($connection);
    return $connection;
}

// Test if connection succeeded
function confirm_db_connect($connection) {
    if(mysqli_connect_errno()) {
    $msg = "Database connection failed: ";
    $msg .= mysqli_connect_error();
    $msg .= " (" . mysqli_connect_errno() . ")";
    exit($msg);
    }
}

// Close database connection
function db_disconnect($connection) {
    if(isset($connection)) {
        mysqli_close($connection);
    }
}

?>
<?php

// Establish connection to the database
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "driver_register";

$connection = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Check connection
if (mysqli_connect_errno()) {
    $error_code = mysqli_connect_errno();
    die("Database connection failed: " . mysqli_connect_error());
} else {
    //echo "Connection successful.";
}

?>

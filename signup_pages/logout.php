<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to about.html
header("Location: http://localhost/fine_management/main/html/");
exit;
?>

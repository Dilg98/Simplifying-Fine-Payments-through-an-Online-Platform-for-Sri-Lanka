<?php
session_start();

// Check if admin user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Database connection details
$servername = "127.0.0.1"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "admin_register"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve input values from the change password form
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_new_password = $_POST['confirm_new_password'];

// TODO: Validate form inputs

// Hash the current password for comparison
$hashed_current_password = md5($current_password); // Use a stronger hashing algorithm like bcrypt or Argon2

// Verify the current password before proceeding
$email = $_SESSION['email'];
$sql = "SELECT * FROM login WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $hashed_current_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Current password is correct, proceed with password change
    // TODO: Update the admin user's password in the database and redirect with success message
} else {
    // Current password is incorrect, redirect back to the change password page with error message
    header("Location: change-password.php?error=Incorrect current password");
    exit();
}

// Close statement and database connection
$stmt->close();
$conn->close();
?>

<?php
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

// Retrieve input values from the login form
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to check if the email and password match
$sql = "SELECT * FROM login WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

// Check if the query returned any rows
if ($result->num_rows > 0) {
    // Login successful
    // Start a session
    session_start();
    // Store email in session variable for later use
    $_SESSION['email'] = $email;
    // Redirect to admin area or dashboard
    header("Location: http://localhost/fine_management/signup_pages/admin_signup.html"); // Change this to the path of your admin dashboard file
} else {
    // Login failed
    // Redirect back to the login page with an error message
    header("Location: http://localhost/fine_management/login_pages/admin_login.html"); // Change this to the path of your login page with an error parameter
}

// Close database connection
$conn->close();
?>

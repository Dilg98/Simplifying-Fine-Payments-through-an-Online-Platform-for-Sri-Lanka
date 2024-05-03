<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: http://localhost/fine_management/login_pages/admin_login.html");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include_once "db_conn.php";

    // Validate email input
    $new_email = $_POST['email'];

    // Update the email in the database
    $email = $_SESSION['email'];
    $sql = "UPDATE admin SET email = '$new_email' WHERE email = '$email'";

    if (mysqli_query($conn, $sql)) {
        // Update session email
        $_SESSION['email'] = $new_email;
        header("Location: http://localhost/fine_management/settings/admin_set_email_success.html");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>

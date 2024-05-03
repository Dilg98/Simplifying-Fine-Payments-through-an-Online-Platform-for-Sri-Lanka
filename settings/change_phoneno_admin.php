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

    // Validate phone number input
    $new_phone = $_POST['phoneno'];

    // Update the phone number in the database
    $email = $_SESSION['email'];
    $sql = "UPDATE admin SET phone_no = '$new_phone' WHERE email = '$email'";

    if (mysqli_query($conn, $sql)) {
        header("Location: http://localhost/fine_management/settings/admin_set_phone_success.html");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>

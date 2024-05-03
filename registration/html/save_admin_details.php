<?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $mobileno = $_POST['mobileno'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $dob = $_POST['dob'];

        // Check if passwords match
        if ($password !== $confirmpassword) {
            echo "Error: Passwords do not match. Please refill the form.";
            exit(); // Stop further execution
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'admin_register');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            // Prepared statement to insert data into the register table
            $stmt = $conn->prepare("INSERT INTO register (full_name, email, password, con_password, mobile_no, gender, address, dob) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            // Bind parameters
            $stmt->bind_param("ssssisss", $name, $email, $hashed_password, $hashed_password, $mobileno, $gender, $address, $dob);
            // Execute the statement
            $execval = $stmt->execute();
            // Check if insertion was successful
            if ($execval === TRUE) {
                // Registration successful, redirect to login page
                header("Location: http://localhost/fine_management/login_pages/admin_login.html");
                exit(); // Stop further execution
            } else {
                echo "Error: " . $stmt->error;
            }
            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
    } else {
        // Redirect back to the registration form if accessed directly
        header("Location: adminreg.html");
        exit();
    }
?>



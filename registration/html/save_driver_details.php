<?php
    // Retrieve form data and sanitize
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $mobileno = $_POST['mobileno'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $licenseidtype = $_POST['licenseidtype'];
    $licenseidno = $_POST['licenseidno'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $bloodgroup = $_POST['bloodgroup'];
    $issuingautho = $_POST['issuingautho'];
    $issueddate = $_POST['issueddate'];
    $expirydate = $_POST['expirydate'];

    // Check if passwords match
    if ($password !== $confirmpassword) {
        echo "Error: Passwords do not match. Please refill the form.";
        exit(); // Stop further execution
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'driver_register');
    if($conn->connect_error){
        echo "Connection Failed: " . $conn->connect_error;
        die();
    } else {
        // Prepared statement to insert data into the register table
        $stmt = $conn->prepare("INSERT INTO register (full_name, dob, email, mobile_no, gender, address, license_type, license_id, password, blood_group, issuing_autho, issued_date, exp_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        // Bind parameters
        $stmt->bind_param("sssssssssssss", $fullname, $dob, $email, $mobileno, $gender, $address, $licenseidtype, $licenseidno, $hashed_password, $bloodgroup, $issuingautho, $issueddate, $expirydate);
        // Execute the statement
        $execval = $stmt->execute();
        // Check if insertion was successful
        if ($execval === TRUE) {
            // Registration successful, redirect to login page
            header("Location: http://localhost/fine_management/login_pages/driver_login.html");
            exit(); // Stop further execution
        } else {
            echo "Error: " . $stmt->error;
        }
        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    // Redirect back to the registration form if accessed directly
    header("Location: driverreg.html");
    exit();
?>








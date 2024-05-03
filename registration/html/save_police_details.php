<?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST['name'];
        $policeid = $_POST['policeid'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $email = $_POST['email'];
        $mobileno = $_POST['mobileno'];
        $gender = $_POST['gender'];
        $court = $_POST['court'];
        $policestation = $_POST['policestation'];
        $regDate = date('Y-m-d H:i:s'); // Current date and time

        // Check if passwords match
        if ($password !== $confirmpassword) {
            echo "Error: Passwords do not match. Please refill the form.";
            exit(); // Stop further execution
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'police_register');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            // Prepared statement to insert data into the table
            $stmt = $conn->prepare("INSERT INTO register (full_name, police_id, password, con_password, email, mobile_no, gender, court, police_station, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            // Bind parameters
            $stmt->bind_param("sssssissss", $name, $policeid, $hashed_password, $hashed_password, $email, $mobileno, $gender, $court, $policestation, $regDate);
            // Execute the statement
            if ($stmt->execute()) {
                // Registration successful, redirect to login page
                header("Location: http://localhost/fine_management/login_pages/policeofficer_login.html");
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
        header("Location: policereg.html");
        exit();
    }
?>

?>

<?php
// Include the database connection file
include 'config.php';

// Admin Login
session_start();
if (isset($_POST['login'])) {
    // Sanitize user input to prevent SQL injection
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // Input validation
    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields');</script>";
    }else{
         // Check if the username and password are correct
        $query = "SELECT * FROM admin WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $passwordHash = $row['password'];
            // Verify the password
            if (!password_verify($password, $passwordHash)) {
                echo "<script>alert('Invalid username or password');</script>";
            }else{
                // Password is correct, set session variables
                $_SESSION['admin'] = $row['id'];
                header("Location: index.php");
            }
        } else {
            echo "<script>alert('Invalid username or password');</script>";
        }
    }
}
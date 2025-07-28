<?php
// Admin Session Management
// Include the database connection file
include 'config.php';
// Start the session
session_start();
// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
}
else{
    // If logged in, you can access the session variables here
    $admin_id = $_SESSION['admin'];
    $stmt = "SELECT * FROM admin WHERE id = $admin_id";
    $result = mysqli_query($connect, $stmt);
    if ($result) {
        $admin = mysqli_fetch_assoc($result);
    } else {
        // Handle error if needed
        echo "Error fetching admin data: " . mysqli_error($connect);
        header("Location: login.php");
    }
}
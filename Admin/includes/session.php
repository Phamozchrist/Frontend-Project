<?php
// Admin Session Management
// Include the database connection file
include '../includes/config.php';
// Start the session
session_start();
$msg = '';
// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
}
else{
    // If logged in, you can access the session variables here
    $admin_id = $_SESSION['admin'];
    // You can also fetch other user details from the database if needed
    $stmt = $connect->prepare("SELECT * FROM admin WHERE id = ?") ;
    $stmt->bind_param('i',$admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
    } else {
        // Handle error if needed
        $msg = "<p>Error fetching user data: " . mysqli_error($connect) . "</p>";
        header("Location: login.php");
        exit();
    }
}
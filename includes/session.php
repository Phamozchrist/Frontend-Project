<?php
// User Session Management
require 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
} else {
    $user_id = $_SESSION['user'];

    // Prepare and execute the query
    $stmt = $connect->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch user data or redirect on error
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        $msg = "<p>Error fetching user data: " . mysqli_error($connect) . "</p>";
        header("Location: ../login.php");
        exit();
    }
}
?>

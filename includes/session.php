<?php
// User Session Management
include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
}
else{
    // If logged in, you can access the session variables here
    $user_id = $_SESSION['user'];
    // You can also fetch other user details from the database if needed
    $stmt = $connect->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    // Fetch the result
    $result = $stmt->get_result();
    if ($result) {
        $user = $result->fetch_assoc();
    } else {
        // Handle error if needed
        echo "Error fetching user data: " . mysqli_error($connect);
        header("Location: ../login.php");
    }
}

?>
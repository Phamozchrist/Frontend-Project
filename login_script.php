<?php
session_start();
include 'config.php';

// Collect user input
$username = mysqli_real_escape_string($connect, $_POST['username']);
$email = mysqli_real_escape_string($connect, $_POST['email']);
$password = mysqli_real_escape_string($connect, $_POST['password']);

// Prepare statement
$stmt = $connect->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        // Set session
        $_SESSION['user'] = $user['id'];
        header("Location: ../index.html");
        exit();
    } else {
        echo "Invalid password";
    }
} else {
    echo "No user found with that username or email";
}
?>

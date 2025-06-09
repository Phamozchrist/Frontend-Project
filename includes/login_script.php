<?php
include 'config.php';
session_start();
$emailOrUsername = $password = $successMsg = $msg ='';
$emailOrUsernameErr = $passwordErr = '';
if(isset($_SESSION['success'])){
    $successMsg = $_SESSION['success'];
    unset($_SESSION['success']);
}
// Check if the form is submitted
if (isset($_POST['login'])) {

    // Collect user input
    $emailOrUsername= mysqli_real_escape_string($connect, $_POST['emailOrUsername']);
    $password = mysqli_real_escape_string($connect, $_POST['login_password']);
    
    
    // Input validation
    if (empty($emailOrUsername)) {
        $emailOrUsernameErr = 'Please enter your username or email';
    }else {
        $emailOrUsernameErr = '';
    }

    if (empty($password)) {
        $passwordErr = 'Please enter your password';
    }else{
        $passwordErr = '';
    }
    if (empty($emailOrUsername) && empty($password)) {
        $msg = '<p class="msg=error">Please fill in all fields;</p>';
    }
    // Check if the username and password are correct
    $errors = $emailOrUsernameErr . $passwordErr;
    if(empty($errors)){
        $stmt = $connect->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $passwordHash = $row["password"];
            // Verify the password
            if (!password_verify($password, $passwordHash)) {
                $msg = '<p class="msg-error">Invalid username or password</p>';
            }else{
                // Password is correct, set session variables
                $_SESSION['user_id'] = $row['id'];
                if (isset($_POST['remember_me'])) {
                    // Set a cookie that lasts 7 days
                    setcookie("user_id", $row['id'], time() + (86400 * 7), "/");
                }
                header("Location: index.php");
            }
        }
    }else {
        $msg = '<p class="msg-error">User not found</p>';
    }
}
?>

<?php
include '../includes/config.php';
session_start();
$emailOrUsername = $login_password = $msg = $rememberMe = '';
$emailOrUsernameErr = $login_passwordErr = '';
if(isset($_SESSION['success'])){
    $msg = $_SESSION['success'];
    unset($_SESSION['success']);
}
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize user input to prevent sql injection
    $emailOrUsername= mysqli_real_escape_string($connect, $_POST['emailOrUsername']);
    $login_password = mysqli_real_escape_string($connect, $_POST['login_password']);
    $rememberMe = isset($_POST['remember_me']) ? true : false;

    // Input validation
    if (empty($emailOrUsername) || empty($login_password)) {
        $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> Please fill in all fields;</p>';
    }else{
        // Check if the username and password are correct
        $stmt = $connect->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $passwordHash = $row["password"];
            // Verify the password
            if (!password_verify($login_password, $passwordHash)) {
                $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> Invalid username or password</p>';
            }else{
                // Password is correct, set session variables
                $_SESSION['user'] = $row['id'];
                if (isset($_POST['remember_me'])) {

                    $token = bin2hex(random_bytes(32));
                
                    // Store in cookie for 7 days
                    setcookie("remember_token", $token, time() + (86400 * 7), "/", "", false, true);
                    // Store hashed token in database
                    $hashedToken = password_hash($token, PASSWORD_BCRYPT);

                    $updateStmt = $connect->prepare("UPDATE user SET remember_token = ? WHERE id = ?");
                    $updateStmt->bind_param("si", $hashedToken, $row['id']);
                    $updateStmt->execute();
                }
                header("Location: ../user/index.php");
            }
        }else {
            $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> User not found</p>';
        }
    }
}
?>

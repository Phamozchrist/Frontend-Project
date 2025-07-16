<?php
include '../includes/config.php';
session_start();
$email = $login_password = $msg = '';
$emailErr = $login_passwordErr = '';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize user input to prevent sql injection
    $email= mysqli_real_escape_string($connect, $_POST['email']);
    $login_password = mysqli_real_escape_string($connect, $_POST['login_password']);

    // Input validation
    if (empty($email) || empty($login_password)) {
        $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> Please fill in all fields;</p>';
    }else{
        // Check if the username and password are correct
        $stmt = $connect->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
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
                $_SESSION['admin'] = $row['id'];
                header("Location: admin/index.php");
            }
        }else {
            $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> Admin not found</p>';
        }
    }
}
?>

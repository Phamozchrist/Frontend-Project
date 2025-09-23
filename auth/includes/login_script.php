<?php
session_start();
include '../includes/config.php';
require '../vendor/autoload.php';
require_once 'includes/email_templates.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

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
        $stmt = $connect->prepare("SELECT * FROM user WHERE username = ? OR email = ? LIMIT 1");
        $stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $passwordHash = $user["password"];
            // Verify the password
            if (!password_verify($login_password, $passwordHash)) {
                $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> Invalid username or password</p>';
            }else{
                if ($user['is_verified'] == 0) {
                    // Generate new verification code
                    $acc_verification_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                    $verification_code_expires = date('Y-m-d H:i:s', strtotime('+15 minutes'));
                    $updateStmt = $connect->prepare("UPDATE user SET verification_code = ?, verification_code_expires = ? WHERE id = ?");
                    $updateStmt->bind_param("ssi", $verification_code, $verification_code_expires, $user['id']);
                    $updateStmt->execute();

                    // Store for verification.php
                    $_SESSION['verify_email'] = $user['email'];
                    $_SESSION['verify_name']  = $user['firstname'] . " " . $user['lastname'];

                    
                    $emailContent = generateVerificationEmail($acc_verification_code, "Verify Your account", "Use the following code to verify your account");
                    
                    $mail = new PHPMailer(true);

                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'stevofame15@gmail.com';
                        $mail->Password = 'jmebpvrceoxryham';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $mail->setFrom('stevofame15@gmail.com', 'Prefix');
                        $mail->addAddress($user['email'], $user['firstname']);

                        $mail->isHTML(true);
                        $mail->Subject = 'Verify Your Account';
                        $mail->Body    = $emailContent['html'];
                        $mail->AltBody = $emailContent['plain'];

                        $mail->send();
                    } catch (Exception $e) {
                        $msg = "Verification email could not be sent. Error: {$mail->ErrorInfo}";
                    }
                    header("Location: verification.php?email=" . urlencode($user['email']));
                    exit();
                }else{

                    $_SESSION['user'] = $user['id'];
                    if ($rememberMe) {
                        $token = bin2hex(random_bytes(32));
                        setcookie("remember_token", $token, time() + (86400 * 7), "/", "", false, true);
                        $hashedToken = password_hash($token, PASSWORD_BCRYPT);

                        $updateStmt = $connect->prepare("UPDATE user SET remember_token = ? WHERE id = ?");
                        $updateStmt->bind_param("si", $hashedToken, $user['id']);
                        $updateStmt->execute();
                    }

                    header("Location: ../user/index.php");
                    exit();
                }
            }
        }else {
            $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> User not found</p>';
        }
        $stmt->close();
    }
}

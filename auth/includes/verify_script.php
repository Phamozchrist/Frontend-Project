<?php
session_start(); 
require_once '../includes/config.php'; 
require_once '../vendor/autoload.php';
require_once 'includes/email_templates.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if (!isset($_SESSION['verify_email'])) {
    header("Location: register.php");
    exit();
}

$email = $_SESSION['verify_email'];
$name  = $_SESSION['verify_name'];
$msg   = "";

// Verify code
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['verify_code'])) {
    if (isset($_POST['code'])) {
        $verification_code = implode("", $_POST['code']); // turns [1,2,3,4,5,6] → "123456"
    }
    $verification_code = preg_replace('/\D/', '', $verification_code); // only digits
    $current_time = date('Y-m-d H:i:s');

    $stmt = $connect->prepare("SELECT verification_code_expires FROM user WHERE email=? AND verification_code=?");
    $stmt->bind_param("ss", $email, $verification_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($row['verification_code_expires'] > $current_time) {
            // Verify user
            $update = $connect->prepare("UPDATE user SET is_verified=1, verification_code=NULL, verification_code_expires=NULL WHERE email=?");
            $update->bind_param("s", $email);
            if ($update->execute()) {
                unset($_SESSION['verify_email'], $_SESSION['verify_name']);
                $_SESSION['success'] = '<p class="msg-success"><i class="fas fa-circle-check"></i> Email verified successfully. You can now log in!</p>';
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['error'] = "Error verifying account. Try again.";
            }
            $update->close();
        } else {
            $_SESSION['error'] = "Your verification code has expired. Please request a new one.";
        }
    } else {
        $_SESSION['error'] = "Invalid verification code.";
    }
    $stmt->close();
}

// Resend code
if (isset($_POST['resend_code'])) {
    $new_verification_code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // 6 digits only
    $expires  = date('Y-m-d H:i:s', strtotime('+15 minutes'));

    $stmt = $connect->prepare("UPDATE user SET verification_code=?, verification_code_expires=? WHERE email=?");
    $stmt->bind_param("sss", $new_verification_code, $expires, $email);

    if ($stmt->execute()) {
        $emailContent = generateVerificationEmail($new_verification_code, "Your New Verification Code", "Use the following code to verify your account");
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username = 'stevofame15@gmail.com';
            $mail->Password = 'jmebpvrceoxryham';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('stevofame15@gmail.com', 'Prefix');
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = "New Verification Code";
            $mail->Body    = $emailContent['html'];
            $mail->AltBody = $emailContent['plain'];
            $mail->send();

            $_SESSION['success'] = " A new verification code has been sent to your email.";
        } catch (Exception $e) {
            $_SESSION['error'] = "Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['error'] = "Error updating verification code.";
    }
    $stmt->close();
}

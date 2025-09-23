<?php
session_start();
require '../includes/config.php';
require '../vendor/autoload.php';
require_once 'includes/email_templates.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
$firstname = $lastname = $username = $email = $password = $confirmPassword = $msg  = $terms = '';
$firstnameErr = $lastnameErr = $usernameErr = $emailErr = $passwordErr = $confirmPasswordErr = $termsErr= '';

// validate input
function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// Post Request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = testInput($_POST['firstname']);
    $lastname = testInput($_POST['lastname']);
    $username = testInput($_POST['username']);
    $email = testInput($_POST['email']);
    $password = testInput($_POST['password']);
    $confirmPassword = testInput($_POST['confirm_password']);
    $terms = isset($_POST['terms']) ? true : false;
    $verification_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $verification_code_expires = date('Y-m-d H:i:s', strtotime('+15 minutes')); 

    
    // Validate Firstname
    if (empty($firstname)) {
        $firstnameErr = '<i class="fa-regular fa-circle-xmark"></i> Firstname is required';
    } elseif (!preg_match('/^[a-zA-Z]*$/', $firstname)) {
        $firstnameErr = '<i class="fa-regular fa-circle-xmark"></i> Only letters allowed';
    }elseif (strlen($firstname) < 3) {
        $firstnameErr = '<i class="fa-regular fa-circle-xmark"></i> Firstname must be at least 3 characters'; 
    }else{
        $firstnameErr = '';
    }

    // Validate Lastname
    if (empty($lastname)) {
        $lastnameErr = '<i class="fa-regular fa-circle-xmark"></i> Lastname is required';
    } elseif (!preg_match('/^[a-zA-Z]*$/', $lastname)) {
        $lastnameErr = '<i class="fa-regular fa-circle-xmark"></i> Only letters allowed';
    }elseif (strlen($lastname) < 3) {
        $lastnameErr = '<i class="fa-regular fa-circle-xmark"></i> Lastname must be at least 3 characters';
    }else{
        $lastnameErr = '';
    }
    
    //Validate Username
    if (empty($username)) {
        $usernameErr = '<i class="fa-regular fa-circle-xmark"></i> Username is required';
    } elseif (!preg_match('/^(?=.*[\d!@#$%?A-Za-z])[A-Za-z\d!@#$%?]+$/', $username)) {
        $usernameErr = '<i class="fa-regular fa-circle-xmark"></i> Username may only contain alphanumeric characters e.g ph@mozChrist33';
    } elseif (strlen($username) < 3) {
        $usernameErr = '<i class="fa-regular fa-circle-xmark"></i> Username must be at least 3 characters';
    }else{
        $usernameErr = '';
    }
    // Validate Email
    if (empty($email)) {
        $emailErr = '<i class="fa-regular fa-circle-xmark"></i> Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = '<i class="fa-regular fa-circle-xmark"></i> Invalid email format';
    }else{
        $emailErr = '';
    }

    // Validate Password
   if (empty($password)) {
        $passwordErr = '<i class="fa-regular fa-circle-xmark"></i> Password is required';
    } else if(!preg_match('/^(?=.*[A-Za-z])(?=.*[\d])(?=.*[!@#$%?])[A-Za-z\d!@#$%?]*$/',$password)){
        $passwordErr = '<i class="fa-regular fa-circle-xmark"></i> Password must include an uppercase, number, symbol e.g P@ssw0rd';
    } elseif (strlen($password) < 8) {
        $passwordErr = '<i class="fa-regular fa-circle-xmark"></i> Password must be at least 8 characters';
    } else {
        $passwordErr = '';
    }

    // Validate Confirm Password
    if (empty($confirmPassword)) {
        $confirmPasswordErr = '<i class="fa-regular fa-circle-xmark"></i> Password not confirmed';
    } elseif ($confirmPassword !== $password) {
        $confirmPasswordErr = '<i class="fa-regular fa-circle-xmark"></i> Password do not match';
    } else {
        $confirmPasswordErr = '';
    }

    // Validate Terms and Conditions
    if (!$terms) {
        $termsErr = '<i class="fa-regular fa-circle-xmark"></i> You must agree to the terms and conditions';
    } else {
        $termsErr = '';
    }

    if(empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($confirmPassword) || !$terms){
        $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> Please fill in all fields;</p>'; 
    }

    $name = $firstname . " " . $lastname; 
    $_SESSION['verify_email'] = $email;
    $_SESSION['verify_name'] = $name;

    // Display Success Message
    $error = $firstnameErr . $lastnameErr . $emailErr . $passwordErr . $usernameErr . $confirmPasswordErr . $termsErr;
    if (empty($error)) {
        $stmt = $connect->prepare('SELECT * FROM user WHERE username = ? OR email = ?');
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['username']  === $username)  $usernameErr = ' <i class="fa-regular fa-circle-xmark"></i> Username already taken';
                if ($row['email'] === $email)     $emailErr = '<i class="fa-regular fa-circle-xmark"></i> Email already registered';
                if ($row['username']  === $username && $row['email'] === $email){
                    $msg = '<i class="fa-regular fa-circle-xmark"></i> Username/Email has already been registered, proceed to log in.';
                }
            }
        }else{
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $insertStmt = $connect->prepare(
                "INSERT INTO user 
                (firstname, lastname, username, email, password, verification_code, verification_code_expires) 
                VALUES (?,?,?,?,?,?,?)"
            );
            $insertStmt->bind_param(
                'sssssss', 
                $firstname, $lastname, $username, $email, $passwordHash, $verification_code, $verification_code_expires
            );
            
            if ($insertStmt->execute()) {
                $emailContent = generateVerificationEmail($verification_code, "Email Verification", "Thank you for registering with Prefix");
                $mail = new PHPMailer(true);
                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'stevofame15@gmail.com';
                    $mail->Password = 'jmebpvrceoxryham';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    
                    // Recipients
                    $mail->setFrom('stevofame15@gmail.com', 'Prefix');
                    $mail->addAddress($email, $name);
                    
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Email Verification - Verify your Email';
                    $mail->Body    = $emailContent['html'];
                    $mail->AltBody = $emailContent['plain']; // plain-text fallback
                    
                    $mail->send();
                } catch (Exception $e) {
                    $msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                header("Location: verification.php?email=" . urlencode($email));
                exit();
            }else {
                 if ($connect->errno == 1062) {
                    if (strpos($connect->error, 'email') !== false) {
                        $emailErr = "Email already registered.";
                    } elseif (strpos($connect->error, 'username') !== false) {
                        $usernameErr = "Username already taken.";
                    } else {
                        $msg = "Duplicate entry detected.";
                    }
                } else {
                    $msg = "Database error: " . $connect->error;
                }
            }
            if (isset($insertStmt)) {
                $insertStmt->close();
            }
        }
        $stmt->close();
    }else{
        $msg = '<i class="fa-regular fa-circle-xmark"></i> Please fix all errors below;';
    }
}


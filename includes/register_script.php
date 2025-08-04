<?php
require 'config.php';
session_start();
$firstname = $lastname = $username = $email = $password = $confirmPassword = $msg  = $terms = '';
$firstnameErr = $lastnameErr = $usernameErr = $emailErr = $passwordErr = $confirmPasswordErr = $termsErr= '';
// Function to check if a field has an error


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
    } elseif (strlen($password < 8)) {
        $passwordErr = '<i class="fa-regular fa-circle-xmark"></i> Password must be at least 8 characters';
    }else {
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
        $msg = '<p class="msg=error"><i class="fa-regular fa-circle-xmark"></i> Please fill in all fields;</p>'; 
    }

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
                if ($row['email']     === $email)     $emailErr = '<i class="fa-regular fa-circle-xmark"></i> Email already registered';
                if(!empty($usernameErr) || !empty($emailErr)) {
                    $msg = 'i class="fa-regular fa-circle-xmark"></i> User already exists.';
                }
            }
        }
        if (empty($error)) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $insertStmt = $connect->prepare("INSERT INTO user (firstname, lastname, username, email, password) VALUES (?,?,?,?,?)");
            $insertStmt->bind_param('sssss',$firstname, $lastname, $username, $email, $passwordHash);
            
            if ($insertStmt->execute()) {
                $_SESSION['success'] = '<p class="msg-success"><i class="fa-regular fa-checked"></i> Registration successful! You can now log in.</p>';
                header("Location: ../user/login.php");

            }else {
                $msg = '<i class="fa-regular fa-circle-xmark"></i> Error: ' . mysqli_error($insertStmt);
            }
        }
    }else{
        $msg = '<i class="fa-regular fa-circle-xmark"></i> Please fix the errors below.';
    }

}
?>
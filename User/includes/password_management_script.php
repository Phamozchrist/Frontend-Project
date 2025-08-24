<?php
require '../includes/session.php';

$oldPassword = $newPassword = $confirmPassword = '';
$passwordErr = $newPasswordErr = $confirmPasswordErr = "";
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $oldPassword     = $_POST['password'];
    $newPassword     = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    $user_id         = intval($_SESSION['user']);

    // Validate old password
    if(empty($oldPassword)){
        $passwordErr = '<i class="fa-regular fa-circle-xmark"></i> Old Password is required';
    }
    // Validate new password
    if (empty($newPassword)) {
        $newPasswordErr = '<i class="fa-regular fa-circle-xmark"></i> New Password is required';
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%?])[A-Za-z\d!@#$%?]{8,}$/', $newPassword)) {
        $newPasswordErr = '<i class="fa-regular fa-circle-xmark"></i> Password must include a letter, number & symbol, min 8 chars';
    }

    // Validate confirm password
    if (empty($confirmPassword)) {
        $confirmPasswordErr = '<i class="fa-regular fa-circle-xmark"></i> Please confirm password';
    } elseif ($confirmPassword !== $newPassword) {
        $confirmPasswordErr = '<i class="fa-regular fa-circle-xmark"></i> Passwords do not match';
    }

    // Validate all fields
    if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
        $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> All fields are required</p>';
    }
    if (empty($newPasswordErr) && empty($confirmPasswordErr)) {
        // Verify old password from DB
        $stmt = $connect->prepare("SELECT password FROM user WHERE id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (!password_verify($oldPassword, $row['password'])) {
                $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> Incorrect old password</p>';
            } elseif (password_verify($newPassword, $row['password'])) {
                $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> New password cannot be same as old password</p>';
            } else {
                // Hash new password
                $hashed = password_hash($newPassword, PASSWORD_BCRYPT);

                $updateStmt = $connect->prepare("UPDATE user SET password=? WHERE id=?");
                $updateStmt->bind_param("si", $hashed, $user_id);

                if ($updateStmt->execute()) {
                    $msg = '<p class="msg-success"><i class="fa-regular fa-circle-check"></i> Password updated successfully</p>';
                } else {
                    $msg = '<p class="msg-error"><i class="fa-regular fa-circle-xmark"></i> Error: '.$updateStmt->error.'</p>';
                }
            }
        }
    }
}
?>
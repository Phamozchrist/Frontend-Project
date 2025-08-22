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
        $passwordErr = 'Old Password is required';
    }
    // Validate new password
    if (empty($newPassword)) {
        $newPasswordErr = 'New Password is required';
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%?])[A-Za-z\d!@#$%?]{8,}$/', $newPassword)) {
        $newPasswordErr = 'Password must include a letter, number & symbol, min 8 chars';
    }

    // Validate confirm password
    if (empty($confirmPassword)) {
        $confirmPasswordErr = 'Please confirm password';
    } elseif ($confirmPassword !== $newPassword) {
        $confirmPasswordErr = 'Passwords do not match';
    }

    // Validate all fields
    if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
        $msg = '<p class="msg-error">All fields are required</p>';
    }
    if (empty($newPasswordErr) && empty($confirmPasswordErr)) {
        // Verify old password from DB
        $stmt = $connect->prepare("SELECT password FROM user WHERE id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (!password_verify($oldPassword, $row['password'])) {
                $msg = '<p class="msg-error">Incorrect old password</p>';
            } elseif (password_verify($newPassword, $row['password'])) {
                $msg = '<p class="msg-error">New password cannot be same as old password</p>';
            } else {
                // Hash new password
                $hashed = password_hash($newPassword, PASSWORD_BCRYPT);

                $updateStmt = $connect->prepare("UPDATE user SET password=? WHERE id=?");
                $updateStmt->bind_param("si", $hashed, $user_id);

                if ($updateStmt->execute()) {
                    $msg = '<p class="msg-success">Password updated successfully</p>';
                } else {
                    $msg = '<p class="msg-error">Error: '.$updateStmt->error.'</p>';
                }
            }
        }
    }
}
?>
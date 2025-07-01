<?php
session_start();
session_destroy();
// Expire cookie
setcookie("remember_token", "", time() - 3600, "/", "", false, true);

// Remove token from database
if (isset($_SESSION['user_id'])) {
    $stmt = $connect->prepare("UPDATE user SET remember_token = NULL WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
}
header("Location: ../login.php");
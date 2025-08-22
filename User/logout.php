<?php
require_once '../includes/config.php';
session_start();
session_destroy();
// Expire cookie
setcookie("remember_token", "", time() - 3600, "/", "", false, true);

// Remove token from database
if (isset($_SESSION['user'])) {
    $stmt = $connect->prepare("UPDATE user SET remember_token = NULL WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user']);
    $stmt->execute();
}
header("Location: ../login.php");
?>
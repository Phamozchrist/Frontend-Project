<?php 
include '../includes/session.php';
if (isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    } else {
        header("Location: ../login.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Prefix - Settings </title>
</head>
<body>
    <section class="settings-section theme-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <?php include "includes/settings-sidebar.php"; ?>

        <main class="main-settings">
            <div id="themes-container" class="main-wrapper">
                <h4>Theme Settings</h4>
                <p>Choose a theme that suits your style and preferences.</p>
                <div class="theme-options">
                    <label for="theme">Select Theme</label>
                    <select name="theme" id="theme">
                        <option value="light-theme">Light</option>
                        <option value="dark-theme">Dark</option>
                        <option value="system-default-theme">System-default</option>
                    </select>
                </div>
            </div>
        </main>
    </section>
    <script src="../javascript/user.script.js"></script>
    <script src="../javascript/theme.js"></script>
    <script src="../javascript/msg.js"></script>
</body>
</html>
<?php 
include 'includes/password_management_script.php';
if (!isset($_SESSION['user'])) {
    if (isset($_COOKIE['user'])) {
        $_SESSION['user'] = $_COOKIE['user'];
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
<link rel="stylesheet" href="../style/rv.user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Prefix - Settings </title>
    <script>
        (function() {
            const savedTheme = localStorage.getItem("theme") || "system-default-theme";
            const prefersDark = window.matchMedia("(prefers-color-scheme: dark)");

            let themeToApply = savedTheme;
            if (savedTheme === "system-default-theme") {
                themeToApply = prefersDark.matches ? "dark-theme" : "light-theme";
            }

            // Remove any previous theme classes
            document.documentElement.classList.remove("light-theme", "dark-theme", "system-default-theme");
            document.documentElement.classList.add(themeToApply);

            // Listen for OS theme changes if system default is selected
            prefersDark.addEventListener("change", function() {
                if (localStorage.getItem("theme") === "system-default-theme") {
                    const newTheme = prefersDark.matches ? "dark-theme" : "light-theme";
                    document.documentElement.classList.remove("light-theme", "dark-theme");
                    document.documentElement.classList.add(newTheme);
                }
            });
        })();
    </script>
</head>
<body>
    <section class="settings-section password-management-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/rv-top-navbar.php"; ?>
        <!-- Rv Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <?php include "includes/settings-sidebar.php"; ?>

        <?php include "includes/bottom-navbar.php"; ?>
        <!-- Bottom Navigation bar -->

        <main class="main-settings">
            <div id="pass-container" class="main-wrapper">
                <h4>Password Management</h4>
                <p>Change your password to keep your account secure.</p>
                <form id="form" method="post">
                    <?php 
                        if (!empty($msg)) {
                            echo $msg;
                        }
                    ?>
                    <div class="form-box">
                        <label for="password">Old Password*</label>
                        <input type="password" name="password" id="password" class="<?=empty($passwordErr) ? '' : 'is-invalid';?>">  
                        <i class="fa-regular fa-eye show-password toggle-eye" data-target="password"></i>
                        <p class="password-err"><?=$passwordErr;?></p>
                    </div>
                    <div class="form-box">
                        <label for="new_password">New Password*</label>
                        <input type="password" name="new_password" id="new_password" class="<?=empty($newPasswordErr) ? '' : 'is-invalid';?>">  
                        <i class="fa-regular fa-eye show-password toggle-eye" data-target="new_password"></i>
                        <p class="new_password-err"><?=$newPasswordErr;?></p>
                        <p class="pass-inc">Password should be at least 8 characters including a number and a lowercase letter.</p>
                    </div>
                    <div class="form-box">
                        <label for="confirm_password">Confirm Password*</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="<?=empty($confirmPasswordErr) ? '' : 'is-invalid';?>">
                        <i class="fa-regular fa-eye show-password toggle-eye" data-target="confirm_password"></i>
                        <p class="confirm_password-err"><?=$confirmPasswordErr;?></p>
                    </div>
                    <div class="btnCon">
                        <button type="submit" name="save" id="button">
                            <span id="btnText">Save</span>
                            <span id="spinner" class="spinner hidden"></span>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </section>
    <script src="../javascript/user.script.js"></script>
    <script src="../javascript/msg.js"></script>
</body>
</html>
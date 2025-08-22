<?php 
require 'includes/script.php';
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
    <section class="settings-section auth-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <?php include "includes/settings-sidebar.php"; ?>

        <main class="main-settings">
            <div id="auth-container" class="main-wrapper">
                <h4>Two-Factor Authentication</h4>
                <p>Enable Two-Factor Authentication to add an extra layer of security to your account.</p>
                <div class="auth-btns">
                    <button class="enable-auth-btn">Enable</button>
                    <button class="disable-auth-btn">Disable</button>
                </div>
            </div>
        </main>
       <!-- Footer Section starts here -->
       <?php include "includes/footer.php"; ?>
       <!-- Footer Section ends here -->
    </section>
    <script src="../javascript/user.script.js"></script>
    <script src="../javascript/profile.js"></script>
    
    <script>
        (function() {
            const savedTheme = localStorage.getItem("theme") || "system-default-theme";
            const prefersDark = window.matchMedia("(prefers-color-scheme: dark)");

            let themeToApply = savedTheme;
            if (savedTheme === "system-default-theme") {
                themeToApply = prefersDark.matches ? "dark-theme" : "light-theme";
            }

            // Remove any previous theme classes
            document.body.classList.remove("light-theme", "dark-theme", "system-default-theme");
            document.body.classList.add(themeToApply);

            // Listen for OS theme changes if system default is selected
            prefersDark.addEventListener("change", function() {
                if (localStorage.getItem("theme") === "system-default-theme") {
                    const newTheme = prefersDark.matches ? "dark-theme" : "light-theme";
                    document.body.classList.remove("light-theme", "dark-theme");
                    document.body.classList.add(newTheme);
                }
            });
        })();
    </script>
</body>
</html>
<?php 
include '../includes/session.php';
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
    <section class="settings-section theme-section">
        <?php include_once "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include_once "includes/rv-top-navbar.php"; ?>
        <!-- Rv Top Navigition bar -->
         
        <?php include_once "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <?php include_once "includes/settings-sidebar.php"; ?>

        <?php include_once "includes/bottom-navbar.php"; ?>
        <!-- Bottom Navigation bar -->

        <main class="main-settings">
            <div id="themes-container" class="main-wrapper">
                <h4>Theme Settings</h4>
                <p>Choose a theme that suits your style and preferences.</p>
                <div class="theme-options">
                    <label for="theme">Select Theme</label>
                    <select name="theme" id="theme">
                        <option value="light-theme" selected>Light</option>
                        <option value="dark-theme">Dark</option>
                        <option value="system-default-theme">System Default</option>
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
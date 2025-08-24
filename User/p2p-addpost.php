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
    <title>P2P Marketplace</title>
    <link rel="stylesheet" href="../style/user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Prefix - P2P</title>
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
    <section class="p2p-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->
        <main>
            <div class="p2p-container">
                <h1>Create Post</h1>
                <!-- Create Post Form -->
                <div>
                    <form class="p2p-create-form" method="post" enctype="multipart/form-data">
                        <h2>Create a Post</h2>
                        <input type="text" name="title" placeholder="Item Title" required>
                        <input type="text" name="price" placeholder="Price" required>
                        <input type="text" name="phone_num" placeholder="Phone Number" required>
                        <textarea name="description" placeholder="Description" required></textarea>
                        <input type="file" name="image" accept="image/*">
                        <button type="submit" name="create_post">Post Item</button>
                    </form>
                </div>
                </div>
            </div>
            
        </main>
    </section>

    <script src="../javascript/user.script.js"></script>
</body>
</html>
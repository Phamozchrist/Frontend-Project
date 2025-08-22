<?php 
require '../includes/session.php';
if (isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    } else {
        header("Location: ../login.php");
        exit();
    }
};
// Get Category ID from URL
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category_id = intval($_GET['category']); // Use intval for security
    $stmt = "SELECT * FROM categories WHERE id = $category_id";
    $result = mysqli_query($connect, $stmt);
    if (mysqli_num_rows($result) > 0) {
        $category = mysqli_fetch_assoc($result);
    } else {
        header("Location: index.php");
        exit();
    }
    // Fetch products for this category
    $product_sql = "SELECT * FROM products WHERE product_category = $category_id ORDER BY id DESC";
    $product_query = mysqli_query($connect, $product_sql);
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
    <title>Prefix - <?=ucfirst($category['category_name']);?></title>
</head>
<body>
    <section class="orders-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <main>
            
        </main>
       <!-- Footer Section starts here -->
       <?php include "includes/footer.php"; ?>
       <!-- Footer Section ends here -->
    </section>

    <script src="../javascript/user.script.js"></script>
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
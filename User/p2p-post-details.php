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
// Fetch product details from database
if (isset($_GET['post']) && !empty($_GET['post'])) {
    $post_id = intval($_GET['post']);
    $sql = "SELECT p.*, u.username FROM p2p_posts p JOIN user u ON p.user_id = u.id WHERE p.id = $post_id";
    $query = mysqli_query($connect, $sql);
    if (mysqli_num_rows($query) > 0) {
        $post = mysqli_fetch_assoc($query);
    } else {
        header("Location: p2p.php");
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
    <title>Prefix - P2P - <?=ucfirst($post['title']);?></title>
</head>
<body>
    <section class="categories-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <main>
            <p class="r-nav">
                <a href="p2p.php">P2P <i class="fa-solid fa-angle-right"></i></a>
                <span><?=$post['title'];?></span>
            </p>
            <div class="product-details-container">
                <div class="product-image">
                    <img src="../admin/uploads/<?=$post['image']; ?>" alt="<?=$post['title']; ?>">
                </div>
                <div class="product-info">
                    <div class="product-title"><?=$post['title']; ?></div>
                    <div>
                        <span class="actual-price">$<?= $post['price']; ?></span>

                    </div>
                    
                    <div class="pd-promotions-wrapper" style="margin-top:80px;">
                        <ul>
                            <li><div class="pd-bullet"></div><a href="">Call <?=$post['phone_number'];?> if you're interested in this offer</a></li>
                        </ul>
                    </div>

                </div>
               
            </div>
            <div class="product-desc-wrapper">
                <h3 class="product-desc-header">Product details</h3>
                <div class="product-desc">
                    <?=$post['description']; ?>
                </div>
            </div>
        </main>
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
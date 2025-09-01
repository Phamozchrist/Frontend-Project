<?php
require '../includes/session.php';
if (!isset($_SESSION['user'])) {
    if (isset($_COOKIE['user'])) {
        $_SESSION['user'] = $_COOKIE['user'];
    } else {
        header("Location: ../login.php");
        exit();
    }
}

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
<link rel="stylesheet" href="../style/rv.user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Prefix - Categories - <?=ucfirst($category['category_name']);?></title>
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
    <section class="categories-section">
        <?php include "includes/navbar.php"; ?>
        <?php include "includes/sidebar.php"; ?>
        <?php include "includes/bottom-navbar.php"; ?>
        <?php include "includes/rv-top-navbar.php"; ?>
        <!-- Rv Top Navigition bar -->
        <main>   
            <p class="r-nav">
                <a href="index.php">Home <i class="fa-solid fa-angle-right"></i></a> 
                <a href="categories.php">Categories <i class="fa-solid fa-angle-right"></i></a> 
                <span><?=ucfirst($category['category_name']);?></span>
            </p>
            <div class="category-heading">
                <h1><?=ucfirst($category['category_name']);?></h1>
            </div>
            <div class="tds-section">
                <div class="tds-container">
                    <div class="tds-heading">
                        <h2><?=ucfirst($category['category_name']);?></h2>
                    </div>
                    <div class="tds-item-container">
                        <?php if(mysqli_num_rows($product_query) > 0): ?>
                            <?php while($product = mysqli_fetch_assoc($product_query)): ?>
                                <div class="tds-item">
                                    <a href="product-details.php?product=<?= $product['id']; ?>?<?=$product['product_name']; ?>">
                                        <div class="tds-item-sale">
                                            <?php
                                                if(isset($product['product_discount'])){
                                            ?>
                                            <small class="tds-discount">-<small class='discount'><?=$product['product_discount'];?></small>%</small>
                                            <?php } ;?>
                                            <img src="../admin/uploads/<?= $product['product_image']; ?>" alt="">
                                        </div>
                                        <h3><?=ucfirst($product['product_name']);?></h3>
                                        <p class="discount-price"></p>
                                        <p class="actual-price"><?=$product['product_price'];?></p>
                                    </a>
                                    <div class="addToCart-container">
                                        <button class="addToCart">Add to cart</button>
                                        <div class="inc-cart-count">
                                            <button><i class="fa-solid fa-minus"></i></button>
                                            <span>0</span>
                                            <button><i class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No products found in this category.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <script src="../javascript/user.script.js"></script>
</body>
</html>
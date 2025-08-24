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
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <main>
            <p class="r-nav">
                <a href="index.php">Home <i class="fa-solid fa-angle-right"></i></a>  
                <span><?=ucfirst($category['category_name']);?></span>
            </p>
            <div class="category-heading">
                <h1><?=ucfirst($category['category_name']);?></h1>
            </div>

            <div class= "flash-sale-section">
                <div class="fss-container">
                    <div class="fss-heading">
                        <h2><i class="fa-solid fa-tag"></i><?=ucfirst($category['category_name']);?></h2>
                        <p>Time: <span class="fss-countdown">12:00 PM - 1:00 PM</span></p>
                    </div>
                   <div class="fss-item-container">
                        <?php if(mysqli_num_rows($product_query) > 0): ?>
                            <?php while($product = mysqli_fetch_assoc($product_query)): ?>
                                <div class="fss-item">
                                    <a href="product-details.php?product=<?= $product['id']; ?>?<?=$product['product_name']; ?>">
                                        <div class="fss-item-sale">
                                            <?php
                                                if(isset($product['product_discount'])){
                                            ?>
                                            <small class="fss-discount">-<small class='discount'><?=$product['product_discount'];?></small>%</small>
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
       <!-- Footer Section starts here -->
       <?php include "includes/footer.php"; ?>
       <!-- Footer Section ends here -->
    </section>

    <script src="../javascript/user.script.js"></script>
</body>
</html>
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
// Fetch categories from the database
$query = $connect->prepare(
    "SELECT category_name,id
    FROM categories 
    WHERE category_name != 'Flash Sales'
    AND category_name != 'Top Deals'"
);
$query->execute();
$result1 = $query->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Prefix - All Products</title>
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
    <section>
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <main class="search-settings">
            <?php
                    $stmt = $connect->prepare(
                        "SELECT p.*, c.category_name 
                        FROM products p 
                        INNER JOIN categories c 
                        ON c.id = p.product_category 
                        WHERE c.category_name != 'Flash Sales'
                        AND c.category_name != 'Top Deals' 
                        ORDER BY p.id DESC"
                    );
                $stmt->execute();
                $result = $stmt->get_result();
                ?>
            <p class="r-nav">
                <a href="index.php">Home <i class="fa-solid fa-angle-right"></i></a> 
                <a href="allproducts.php">All Products <i class="fa-solid fa-angle-right"></i></a>
            </p>
            <div class="search-wrapper">
                <aside class="search-sidebar">
                    <h4>Categories</h4>
                    <ul class="sidebar-nav-container">
                        
                        <?php while ($category = mysqli_fetch_assoc($result1)):?>
                            <li><a href="category.php?category=?<?=$category['id']?>?<?=$category['category_name']?>"><?=$category['category_name']?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </aside>
                <div class="all-categories-section">
                    <div class="container">
                        <div class="item-container">
                            <?php if (mysqli_num_rows($result) > 0):?>
                            <?php while ($product = mysqli_fetch_assoc($result)): ?>
                            <div class="item">
                                <a href="product-details.php?product=<?= $product['id']; ?>?<?=$product['product_name']; ?>">
                                    <div class="item-sale">
                                        <?php if(isset($product['product_discount'])): ?>
                                        <small class="cat-discounts">-<small class='discount'><?= $product['product_discount']; ?></small>%</small>
                                        <?php endif; ?>
                                        <img src="../admin/uploads/<?= $product['product_image']; ?>" alt="">
                                    </div>
                                    <h3><?= ucfirst($product['product_name']); ?><i class="fa-solid fa-ellipsis"></i></h3>
                                    <p class="discount-price"></p>
                                    <p class="actual-price"><?= $product['product_price']; ?></p>
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
            
        </main>
    </section>

    <script src="../javascript/user.script.js"></script>
</body>
</html>
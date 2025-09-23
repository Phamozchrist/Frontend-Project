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
    <title>Prefix - Categories</title>
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
        <?php include_once "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include_once "includes/rv-top-navbar.php"; ?>
        <!-- Rv Top Navigition bar -->
         
        <?php include_once "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <?php include_once "includes/bottom-navbar.php"; ?>
        <!-- Bottom Navigation bar -->

        <main>
            <div class="category-heading">
                <h1>Categories</h1>
            </div>
            <?php
                $sql = "SELECT * FROM categories WHERE category_name != 'Flash Sales' AND category_name != 'Top Deals' ORDER BY id DESC";
                $query = mysqli_query($connect, $sql);
                while($category = mysqli_fetch_assoc($query)):
                    $cat_id = $category['id'];
                    $product_sql = "SELECT * FROM products WHERE product_category = $cat_id ORDER BY id DESC LIMIT 4";
                    $product_query = mysqli_query($connect, $product_sql);

                    // Only show category if it has products
                    if(mysqli_num_rows($product_query) > 0):
            ?>
            <div class="all-categories-section">
                <div class="container">
                    <div class="heading">
                        <h2><?= $category['category_name'] ?></h2>
                        <p><a href="category.php?category=<?=$category['id']?>?<?=$category['category_name']?>">See all  <i class="fa-solid fa-angle-right"></i></a></p>
                    </div>
                    <div class="item-container">
                        <?php while($product = mysqli_fetch_assoc($product_query)): ?>
                        <div class="item" data-id="<?= $product['id']; ?>">
                            <a href="product-details.php?product=<?= $product['id']; ?>?<?=$product['product_name']; ?>">
                                <div class="item-sale">
                                    <?php if(isset($product['product_discount'])): ?>
                                    <small class="cat-discounts">-<small class='discount'><?= $product['product_discount']; ?></small>%</small>
                                    <?php endif; ?>
                                    <img src="../admin/uploads/<?= $product['product_image']; ?>" alt="">
                                </div>
                                <h3><?= ucfirst($product['product_name']); ?></h3>
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
                    </div>
                </div>
            </div>
            <?php
                    endif;
                endwhile;
            ?>
        </main>
    </section>

    <script src="../javascript/user.script.js"></script>
</body>
</html>
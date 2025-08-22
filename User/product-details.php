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
if (isset($_GET['product']) && !empty($_GET['product'])) {
    $product_id = intval($_GET['product']);
    $sql = "SELECT p.*, c.category_name, c.id AS category_id 
            FROM products p 
            INNER JOIN categories c ON c.id = p.product_category 
            WHERE p.id = $product_id";
    $query = mysqli_query($connect, $sql);
    if (mysqli_num_rows($query) > 0) {
        $product = mysqli_fetch_assoc($query);
    } else {
        header("Location: categories.php");
        exit();
    }

} else {
    header("Location: categories.php");
    exit();
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
    <title>Prefix - <?=ucfirst($product['category_name']);?> - <?= htmlspecialchars($product['product_name']); ?></title>
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
                <?php if($product['category_name'] == 'Flash Sales'): ?>
                    <a href="flash-sales.php?category=<?=$product['category_id'];?>?<?=$product['category_name'];?>"><?=ucfirst($product['category_name']);?> <i class="fa-solid fa-angle-right"></i></a>
                <?php elseif ($product['category_name'] == 'Top Deals'): ?>
                    <a href="top-deals.php?category=<?=$product['category_id'];?>?<?=$product['category_name'];?>"><?=ucfirst($product['category_name']);?> <i class="fa-solid fa-angle-right"></i></a>
                <?php else: ?>
                    <a href="categories.php">Categories <i class="fa-solid fa-angle-right"></i></a>
                    <a href="category.php?category=<?=$product['category_id'];?>?<?=$product['category_name'];?>"><?=ucfirst($product['category_name']);?> <i class="fa-solid fa-angle-right"></i></a>
                <?php endif ?>
                <span><?= htmlspecialchars($product['product_name']); ?></span>
            </p>
            <div class="product-details-container">
                <div class="product-image">
                    <img src="../admin/uploads/<?= htmlspecialchars($product['product_image']); ?>" alt="<?= htmlspecialchars($product['product_name']); ?>">
                </div>
                <div class="product-info">
                    <div class="product-title"><?= htmlspecialchars($product['product_name']); ?></div>
                   
                    <?php if($product['category_name'] == "Flash Sales"):?>
                    <div class="fss-container">
                        <div class="fss-heading">
                            <h2><i class="fa-solid fa-tag"></i><?=ucfirst($product['category_name']);?></h2>
                            <p>Time: <span class="fss-countdown">12:00 PM - 1:00 PM</span></p>
                        </div>
                        <div class="fss-price">
                            <span class="discount-price"></span>
                            <span class="actual-price"><?= htmlspecialchars($product['product_price']); ?></span>
                            <?php
                                if(isset($product['product_discount'])){
                            ?>
                            <small class="product-discount">-<small class='discount'><?=$product['product_discount'];?></small>%</small>
                            <?php } ;?>
                        </div>
                    </div>
                    <?php else:?>
                    <div>
                        <span class="discount-price"></span>
                        <span class="actual-price"><?= htmlspecialchars($product['product_price']); ?></span>
                        <?php
                            if(isset($product['product_discount'])){
                        ?>
                        <small class="product-discount">-<small class='discount'><?=$product['product_discount'];?></small>%</small>
                        <?php } ;?>
                    </div>
                    <?php endif ?>
                    
                    <div class="addToCart-container">
                        <small style="font-size: 12px; color: #888;">In stock</small>
                        <button class="addToCart">Add to cart</button>
                        <div class="inc-cart-count">
                            <button><i class="fa-solid fa-minus"></i></button>
                            <span>1</span>
                            <button><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="pd-promotions-wrapper">
                        <h3>PROMOTIONS</h3>
                        <ul>
                            <li><div class="pd-bullet"></div><a href="">Call 08160421290 To Place Your Order</a></li>
                            <li><div class="pd-bullet"></div><a href="">Need extra money? Get a loan of up to N500,000 on Okash</a></li>
                            <li><div class="pd-bullet"></div><a href="">Enjoy cheaper shipping fees when you select a PickUp Station at checkout.</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="product-desc-wrapper">
                <h3 class="product-desc-header">Product details</h3>
                <div class="product-desc">
                    <?=$product['product_details']; ?>
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
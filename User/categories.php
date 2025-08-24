<?php 
require '../includes/session.php';
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
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

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
                        <div class="item">
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
    <script>
                // --- Add to Cart Logic for Categories Page ---
        document.addEventListener("DOMContentLoaded", function () {
        function getCart() {
            return JSON.parse(localStorage.getItem("cart") || "{}");
        }
        function setCart(cart) {
            localStorage.setItem("cart", JSON.stringify(cart));
            updateCartBadge();
        }
        function updateCartBadge() {
            let badge = document.querySelector(".cart-count-badge");
            if (!badge) return;
            let cart = getCart();
            let totalCount = Object.values(cart).reduce((sum, item) => sum + item.qty, 0);
            badge.textContent = totalCount > 0 ? totalCount : "";
        }

        // On page load, update cart badge
        updateCartBadge();

        document.querySelectorAll(".item").forEach(function (item) {
            const addBtn = item.querySelector(".addToCart");
            const incCart = item.querySelector(".inc-cart-count");
            const minusBtn = incCart.querySelector("button:first-child");
            const plusBtn = incCart.querySelector("button:last-child");
            const countSpan = incCart.querySelector("span");

            // Get product info
            const prodName = item.querySelector("h3").textContent.trim();
            const prodImg = item.querySelector("img").getAttribute("src");
            const prodPrice = item.querySelector(".actual-price").textContent.trim();

            // Load count from cart
            let cart = getCart();
            let qty = cart[prodName]?.qty || 0;
            if (qty > 0) {
            addBtn.style.display = "none";
            incCart.style.display = "flex";
            countSpan.textContent = qty;
            } else {
            addBtn.style.display = "block";
            incCart.style.display = "none";
            countSpan.textContent = "0";
            }

            addBtn.addEventListener("click", function () {
            qty = 1;
            addBtn.style.display = "none";
            incCart.style.display = "flex";
            countSpan.textContent = qty;
            cart = getCart();
            cart[prodName] = { qty, prodImg, prodPrice };
            setCart(cart);
            });

            plusBtn.addEventListener("click", function () {
            qty++;
            countSpan.textContent = qty;
            cart = getCart();
            cart[prodName] = { qty, prodImg, prodPrice };
            setCart(cart);
            });

            minusBtn.addEventListener("click", function () {
            if (qty > 1) {
                qty--;
                countSpan.textContent = qty;
                cart = getCart();
                cart[prodName] = { qty, prodImg, prodPrice };
                setCart(cart);
            } else {
                qty = 0;
                addBtn.style.display = "block";
                incCart.style.display = "none";
                cart = getCart();
                delete cart[prodName];
                setCart(cart);
            }
            });
        });
        });
    </script>
</body>
</html>
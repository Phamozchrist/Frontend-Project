<?php 
require 'includes/session.php';
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
    <title>Prefix - Categories</title>
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
                        <p><a href="">See all  <i class="fa-solid fa-angle-right"></i></a></p>
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
                                <p class="actual-price"><?= $product['product_price']; ?></p>
                                <span class="discount-price"></span>
                            </a>
                            <div class="addToCart-container">
                                <button id="addToCart">Add to cart</button>
                                <div class="inc-cart-count">
                                    <button><i class="fa-solid fa-minus"></i></button>
                                    <span>1</span>
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
       <!-- Footer Section starts here -->
       <?php include "includes/footer.php"; ?>
       <!-- Footer Section ends here -->
    </section>

    <script src="../javascript/user.script.js"></script>
</body>
</html>
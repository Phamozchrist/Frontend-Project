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
    <link rel="stylesheet" href="../style/rv.user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Prefix - Home</title>
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
    <section class="home-section">
        <?php include_once "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->
        <?php include_once "includes/rv-top-navbar.php"; ?>
        <!-- Rv Top Navigition bar -->

        <?php include_once "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <?php include_once "includes/bottom-navbar.php"; ?>
        <!-- Bottom Navigation bar -->

        <main>   
            <div class="user-hero-section">
                <div class="uhs-heading">
                    <h1>Welcome, <?=$user['firstname'];?></h1>
                    <p>Come and buy what we are selling ooo!</p>
                </div>

                <div class="uhs-subcontainer">
                    <div>
                        <p>Orders</p>
                        <a href="">
                            <p>View Details</p>
                            <small>></small>
                        </a>
                    </div>
                    <div>
                        <p>Posts</p>
                        <a href="p2p.php">
                            <p>View Details</p>
                            <small>></small>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class= "flash-sale-section">
                <div class="fss-container">
                    <div class="fss-heading">
                        <?php
                            $sql = "SELECT * 
                                    FROM categories   
                                    WHERE category_name = 'Flash Sales'";
                            $query = mysqli_query($connect, $sql);
                            $category = mysqli_fetch_assoc($query)
                        ?>
                        <h2><i class="fa-solid fa-tag"></i><?=$category['category_name']; ?></h2>
                        <p>Time: <span class="fss-countdown">12:00 PM - 1:00 PM</span></p>
                        <p><a href="flash-sales.php?category=<?=$category['id']; ?>?<?=$category['category_name']; ?>">See all  <i class="fa-solid fa-angle-right"></i></a></p>
                    </div>
                    <div class="fss-item-container">
                        <?php
                            $sql = "SELECT p.*, c.category_name 
                                    FROM products p 
                                    INNER JOIN categories c ON c.id = p.product_category 
                                    WHERE c.category_name = 'Flash Sales' 
                                    ORDER BY p.id ASC 
                                    LIMIT 4";
                            $query = mysqli_query($connect, $sql);
                            while($product = mysqli_fetch_assoc($query)):
                        ?>
                        <div class="fss-item">
                            <a href="product-details.php?product=<?=$product['id'];?>&<?=$product['product_name'];?>">
                                <div class="fss-item-sale">
                                    <?php
                                        if(isset($product['product_discount'])){
                                    ?>
                                    <small class="fss-discount">-<small class='discount'><?=$product['product_discount'];?></small>%</small> 
                                    <?php } ;?>
                                    <img src="../admin/uploads/<?=$product['product_image'];?>" alt="">
                                </div>
                                <h3><?=ucfirst($product['product_name']);?></h3>
                                <p class="discount-price"></p>
                                <p class="actual-price"><?=$product['product_price'];?></p>
                            </a>
                        </div>
                        <?php endwhile;?>
                    </div>
                </div>
                
            </div>
            <div class= "av-cat-section">
                <div class="acs-item-container">
                    <?php
                        $sql = "SELECT * FROM categories WHERE category_name != 'Flash Sales' AND category_name != 'Top Deals' ORDER BY id ASC";
                        $query = mysqli_query($connect, $sql);
                        while($category = mysqli_fetch_assoc($query)):
                            $cat_id = $category['id'];
                            $product_sql = "SELECT * FROM products WHERE product_category = $cat_id ORDER BY id DESC LIMIT 1";
                            $product_query = mysqli_query($connect, $product_sql);

                            // Only show category if it has products
                            if(mysqli_num_rows($product_query) > 0):
                    ?>
                    <a href="category.php?category=<?=$category['id'];?>?<?=$category['category_name'];?>">
                        <?php while($product = mysqli_fetch_assoc($product_query)): ?>
                        <div class="acs-item">
                            <div class="acs-item-sale">
                                <img src="../admin/uploads/<?=$product['product_image'];?>" alt="">
                            </div>
                            <p><?=$category['category_name'];?></p>
                        </div>
                        <?php endwhile;?>
                    </a>
                    <?php 
                        endif;
                        endwhile;
                    ?>
                </div>
            </div>
            <div class="tds-section">
                <div class="tds-container">
                    <div class="tds-heading">
                        <?php
                            $sql = "SELECT * 
                                    FROM categories   
                                    WHERE category_name = 'Top Deals'";
                            $query = mysqli_query($connect, $sql);
                            $category = mysqli_fetch_assoc($query)
                        ?>
                        <h2><?=$category['category_name']; ?></h2> 
                        <p>
                            <a href="top-deals.php?category=<?=$category['id'];?>?<?=$category['category_name'];?>">
                                See all  
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </p>
                    </div>
                    <div class="tds-item-container">
                        <?php
                            $sql = "SELECT p.*, c.category_name 
                                    FROM products p 
                                    INNER JOIN categories c ON c.id = p.product_category 
                                    WHERE c.category_name = 'Top Deals' 
                                    ORDER BY p.id ASC 
                                    LIMIT 4";
                            $query = mysqli_query($connect, $sql);
                            while($product = mysqli_fetch_assoc($query)):
                        ?>
                       
            
                        <div class="tds-item item" data-id="<?= $product['id']; ?>">
                            <a href="product-details.php?product=<?= $product['id']; ?>?<?= urlencode($product['product_name']); ?>">
                                <div class="tds-item-sale">
                                    <?php if(isset($product['product_discount'])) { ?>
                                    <small class="tds-discount">-<small class='discount'><?=$product['product_discount'];?></small>%</small>
                                    <?php } ?>
                                    <img src="../admin/uploads/<?=$product['product_image'];?>" alt="">
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
                        
                        <?php endwhile;?>
                    </div>
                </div>
            </div>
            <?php
            // 1️⃣ Get latest search word
            $user_id = $_SESSION['user'];
            $stmt = $connect->prepare(
                "SELECT word FROM lastsearch  WHERE user_id = ? ORDER BY id DESC LIMIT 1"
            );
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $lastSearch = $result->fetch_assoc();
            $searchWord = $lastSearch ? $lastSearch['word'] : '';
            if ($searchWord):
            ?>
            <div class="latest-search-section">
                <div class="lss-container">
                    <div class="lss-heading">
                        <h2>Latest Search: "<?= htmlspecialchars($searchWord) ?>"</h2>
                            <p>
                                <a href="search.php?search=<?= urlencode($searchWord) ?>">
                                    See all <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </p>
                        </div>
                        
                    <div class="lss-item-container">
                    <?php
                        if ($searchWord):
                            // 2️⃣ Fetch matching products
                            $stmt = $connect->prepare(
                                "SELECT p.*, c.category_name 
                                FROM products p 
                                INNER JOIN categories c ON c.id = p.product_category 
                                WHERE (
                                p.product_name LIKE ?
                                OR p.product_details LIKE ? 
                            )
                                AND c.category_name != 'Flash Sales'
                                AND c.category_name != 'Top Deals'  
                                ORDER BY p.id DESC LIMIT 4"
                            );
                            $likeSearch = "%" . $searchWord . "%";
                            $stmt->bind_param("ss", $likeSearch, $likeSearch);
                            $stmt->execute();
                            $productResult = $stmt->get_result();
                    ?>
                        <?php 
                            if (mysqli_num_rows($productResult)> 0):
                            while ($product = mysqli_fetch_assoc($productResult)): 
                        ?>
                        <div class="lss-item">
                            <a href="product-details.php?product=<?= $product['id']; ?>">
                                <div class="lss-item-sale">
                                    <?php if(isset($product['product_discount'])) { ?>
                                        <small class="lss-discount">-<small class='discount'><?=$product['product_discount'];?></small>%</small>
                                    <?php } ?>
                                    <img src="../admin/uploads/<?=$product['product_image'];?>" alt="">
                                </div>
                                <h3><?= ucfirst($product['product_name']); ?></h3>
                                <p class="discount-price"></p>
                                <p class="actual-price"><?= $product['product_price']; ?></p>
                            </a>
                        </div>
                        <?php endwhile; ?>
                        <?php endif;?>
                        <?php endif;?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </main>
    </section>


    <script src="../javascript/user.script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const countdownEl = document.querySelector(".fss-countdown");
            const container = document.querySelector(".flash-sale-section");
            
            function updateCountdown() {
                let now = new Date();
                let start = new Date();
                let end = new Date();
                
                // Sale runs 12:00 – 13:00 every day
                start.setHours(9, 0, 0, 0);
                end.setHours(18, 0, 0, 0);
                
                if (now >= start && now < end) {
                    // Sale is active
                    let secondsLeft = Math.floor((end - now) / 1000);
                    let mins = Math.floor(secondsLeft / 60);
                    let secs = secondsLeft % 60;
                    countdownEl.textContent = mins + "m : " + secs + "s";
                    container.style.display = "block";
                } else {
                    // Sale ended or not started
                    container.style.display = "none";
                }
            }
            
            updateCountdown(); // run immediately
            setInterval(updateCountdown, 1000); // update every second
        });
    </script>
</body>
</html>
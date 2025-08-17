<?php 
require 'includes/session.php';
if (isset($_SESSION['user'])) {
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
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <title>Prefix - Home</title>
</head>
<body>
    <section class="home-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

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
                            <a href="product-details.php?product=<?=$product['id'];?>?<?=$product['product_name'];?>">
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
                        <p><a href="top-deals.php?category=<?=$category['id']; ?>?<?=$category['category_name']; ?>">See all  <i class="fa-solid fa-angle-right"></i></a></p>
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
                       
            
                        <div class="tds-item">
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
            <div class= "latest-search-section">
                <div class="lss-container">
                    <div class="lss-heading">
                        <h2>Latest Search: Toy</h2>
                        <p><a href="Search.php">See all  <i class="fa-solid fa-angle-right"></i></a></p>
                    </div>
                    <div class="lss-item-container">
                        
                        <div class="lss-item">
                            <div class="lss-item-sale">
                                <small class="lss-discount">-20%</small>
                                <img src="uploads/flash-sale-1.png" alt="">
                            </div>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iste, in eius ducimus sed</h3>
                            <p>12,000  <span>₦12,000</span></p>
                        </div>
                        <div class="lss-item">
                            <div class="lss-item-sale">
                                <small class="lss-discount">-20%</small>
                                <img src="uploads/flash-sale-1.png" alt="">
                            </div>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iste, in eius ducimus sed</h3>
                            <p>₦120,000 <span>₦12,000</span></p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </main>
        <!-- <div class="container-2">
            <div class="slider-container">
                <div class="slider-track">
                    <div class="slide"><img src="../images/banner-img.png" alt=""></div>
                    <div class="slide"><img src="../images/banner-img.png" alt=""></div>
                    <div class="slide"><img src="../images/banner-img.png" alt=""></div>
                </div>
            </div>
        </div> -->

       <!-- <a href="../includes/logout.php">Logout</a> -->
       <!-- Footer Section starts here -->
       <?php include "includes/footer.php"; ?>
       <!-- Footer Section ends here -->
    </section>


    <script src="../javascript/user.script.js"></script>
</body>
</html>
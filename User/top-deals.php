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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <title>Prefix - Categories - Top Deals</title>
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
                <a href="Categories.php">Categories <i class="fa-solid fa-angle-right"></i></a> 
                <span>Top Deals</span>
            </p>
            <div class="category-heading">
                <h1>Top Deals</h1>
            </div>

            <div class= "top-deals-section">
                <div class="tds-container">
                    <div class="tds-heading">
                        <h2>Top Deals</h2>
                    </div>
                    <div class="tds-item-container">
                        <a href="product-details">
                        <div class="tds-item">
                            <div class="tds-item-sale">
                                <small class="tds-discount">-20%</small>
                                <img src="uploads/flash-sale-1.png" alt="">
                            </div>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iste, in eius ducimus sed</h3>
                            <p>12,000 <span>₦12,000</span></p>
                            
                            <div class="addToCart-container">
                                <button id="addToCart">Add to cart</button>
                                <div class="inc-cart-count">
                                    <button><i class="fa-solid fa-minus"></i></button>
                                    <span>1</span>
                                    <button><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        </a>
                        <div class="tds-item">
                            <div class="tds-item-sale">
                                <small class="tds-discount">-20%</small>
                                <img src="uploads/flash-sale-1.png" alt="">
                            </div>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iste, in eius ducimus sed</h3>
                            <p>12,000 <span>₦12,000</span></p>
                            
                            <div class="addToCart-container">
                                <button id="addToCart">Add to cart</button>
                                <div class="inc-cart-count">
                                    <button><i class="fa-solid fa-minus"></i></button>
                                    <span>1</span>
                                    <button><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="tds-item">
                            <div class="tds-item-sale">
                                <small class="tds-discount">-20%</small>
                                <img src="uploads/flash-sale-1.png" alt="">
                            </div>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iste, in eius ducimus sed</h3>
                            <p>12,000 <span>₦12,000</span></p>
                            
                            <div class="addToCart-container">
                                <button id="addToCart">Add to cart</button>
                                <div class="inc-cart-count">
                                    <button><i class="fa-solid fa-minus"></i></button>
                                    <span>1</span>
                                    <button><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="tds-item">
                            <div class="tds-item-sale">
                                <small class="tds-discount">-20%</small>
                                <img src="uploads/flash-sale-1.png" alt="">
                            </div>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iste, in eius ducimus sed</h3>
                            <p>12,000  <span>₦12,000</span></p>
                            
                            <div class="addToCart-container">
                                <button id="addToCart">Add to cart</button>
                                <div class="inc-cart-count">
                                    <button><i class="fa-solid fa-minus"></i></button>
                                    <span>1</span>
                                    <button><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="tds-item">
                            <div class="tds-item-sale">
                                <small class="tds-discount">-20%</small>
                                <img src="uploads/flash-sale-1.png" alt="">
                            </div>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iste, in eius ducimus sed</h3>
                            <p>₦12,000 <span>₦12,000</span></p>
                            
                            <div class="addToCart-container">
                                <button id="addToCart">Add to cart</button>
                                <div class="inc-cart-count">
                                    <button><i class="fa-solid fa-minus"></i></button>
                                    <span>1</span>
                                    <button><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </main>
           
       <!-- <a href="../includes/logout.php">Logout</a> -->
       <!-- Footer Section starts here -->
       <?php include "includes/footer.php"; ?>
       <!-- Footer Section ends here -->
    </section>


    <script src="../javascript/user.script.js"></script>
</body>
</html>
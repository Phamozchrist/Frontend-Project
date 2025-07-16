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

            <div class= "all-categories-section">
                <div class="container">
                    <div class="heading">
                        <h2>Phone & Tablet</h2>
                        <p><a href="">See all  <i class="fa-solid fa-angle-right"></i></a></p>
                    </div>
                    <div class="item-container">
                        
                        <a href="product-details.php">
                            <div class="item">
                                <div class="item-sale">
                                    <small class="discount">-20%</small>
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
                        <a href="">
                            <div class="item">
                                <div class="item-sale">
                                    <small class="discount">-20%</small>
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
                        
                        <div class="item">
                            <div class="item-sale">
                                <small class="discount">-20%</small>
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
                        <div class="item">
                            <div class="item-sale">
                                <small class="discount">-20%</small>
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
                        <div class="item">
                            <div class="item-sale">
                                <small class="discount">-20%</small>
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
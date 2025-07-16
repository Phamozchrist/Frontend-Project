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
                    <h1>Welcome, Stephen</h1>
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
                        <a href="">
                            <p>View Details</p>
                            <small>></small>
                        </a>
                    </div>
                </div>
            </div>
            <div class= "flash-sale-section">
                <div class="fss-container">
                    <div class="fss-heading">
                        <h2><i class="fa-solid fa-tag"></i>Flash Sales</h2>
                        <p>Time: <span class="fss-countdown">12:00 PM - 1:00 PM</span></p>
                        <p><a href="flash-sales.php">See all  <i class="fa-solid fa-angle-right"></i></a></p>
                    </div>
                    <div class="fss-item-container">
                        <div class="fss-item">
                            <div class="fss-item-sale">
                                <small class="fss-discount">-20%</small>
                                <img src="uploads/flash-sale-1.png" alt="">
                            </div>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iste, in eius ducimus sed</h3>
                            <p>12,000 <span>₦12,000</span></p>

                            <div>
                                <label for="">11 items left</label>
                                <input type="range">
                            </div>

                        </div>
                        <div class="fss-item">
                            <div class="fss-item-sale">
                                <small class="fss-discount">-20%</small>
                                <img src="uploads/flash-sale-1.png" alt="">
                            </div>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iste, in eius ducimus sed</h3>
                            <p>12,000 <span>₦12,000</span></p>

                            <div>
                                <label for="">11 items left</label>
                                <input type="range">
                            </div>

                        </div>
                        <div class="fss-item">
                            <div class="fss-item-sale">
                                <small class="fss-discount">-20%</small>
                                <img src="uploads/flash-sale-1.png" alt="">
                            </div>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iste, in eius ducimus sed</h3>
                            <p>12,000 <span>₦12,000</span></p>

                            <div>
                                <label for="">11 items left</label>
                                <input type="range">
                            </div>

                        </div>
                        <div class="fss-item">
                            <div class="fss-item-sale">
                                <small class="fss-discount">-20%</small>
                                <img src="uploads/flash-sale-1.png" alt="">
                            </div>
                            <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat iste, in eius ducimus sed</h3>
                            <p>₦120,000 <span>₦12,000</span></p>

                            <div>
                                <label for="">11 items left</label>
                                <input type="range">
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>
            <div class= "av-cat-section">
                <div class="acs-item-container">
                    <div class="acs-item">
                        <div class="acs-item-sale">
                            <img src="uploads/flash-sale-1.png" alt="">
                        </div>
                        <p>Phone & tablets</p>
                    </div>
                    <div class="acs-item">
                        <div class="acs-item-sale">
                            <img src="uploads/flash-sale-1.png" alt="">
                        </div>
                        <p>Phone & tablets</p>
                    </div>
                    <div class="acs-item">
                        <div class="acs-item-sale">
                            <img src="uploads/flash-sale-1.png" alt="">
                        </div>
                        <p>Phone & tablets</p>
                    </div>
                    <div class="acs-item">
                        <div class="acs-item-sale">
                            <img src="uploads/flash-sale-1.png" alt="">
                        </div>
                        <p>Phone & tablets</p>
                    </div>
                    <div class="acs-item">
                        <div class="acs-item-sale">
                            <img src="uploads/flash-sale-1.png" alt="">
                        </div>
                        <p>Phone & tablets</p>
                    </div>
                    <div class="acs-item">
                        <div class="acs-item-sale">
                            <img src="uploads/flash-sale-1.png" alt="">
                        </div>
                        <p>Phone & tablets</p>
                    </div>
                    <div class="acs-item">
                        <div class="acs-item-sale">
                            <img src="uploads/flash-sale-1.png" alt="">
                        </div>
                        <p>Phone & tablets</p>
                    </div>
                    <div class="acs-item">
                        <div class="acs-item-sale">
                            <img src="uploads/flash-sale-1.png" alt="">
                        </div>
                        <p>Phone & tablets</p>
                    </div>
                </div>
            </div>
            <div class= "top-deals-section">
                <div class="tds-container">
                    <div class="tds-heading">
                        <h2>Top Deals</h2>
                        <p><a href="top-deals.php">See all  <i class="fa-solid fa-angle-right"></i></a></p>
                    </div>
                    <div class="tds-item-container">
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
                                <img src="../images/banner-img.png" alt="">
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
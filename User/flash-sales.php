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
    <title>Prefix - Flash Sales</title>
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
                <span>Flash Sales</span>
            </p>
            <div class="category-heading">
                <h1>Flash Sales</h1>
            </div>

            <div class= "flash-sale-section">
                <div class="fss-container">
                    <div class="fss-heading">
                        <h2><i class="fa-solid fa-tag"></i>Flash Sales</h2>
                        <p>Time: <span class="fss-countdown">12:00 PM - 1:00 PM</span></p>
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
                            <p>12,000  <span>₦12,000</span></p>

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
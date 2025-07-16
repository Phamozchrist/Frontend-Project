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
<html lang="en" loading="lazy">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <title>Prefix - Cart </title>
</head>
<body>
    <section class="categories-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <main>
            <section class="cart-hero-section">
                <div class="cart-table-wrapper">
                    <h1 class="cart-title">Cart</h1>
                    <div class="cart-table">
                        <div class="cart-body">
                            <div>
                                <img src="${
                                item.prodImg
                                }" alt="Product" class="cart-product-img">
                            </div>
                            <p>${key}</p>
                            <span>${item.prodPrice}</span>
                        </div>
                        
                        <div class="r-btn-qty-container">
                            <button class="remove-btn"><i class="fas fa-trash"></i> Remove</button>
                            <div class="quantity-box">
                                <button class="qty-btn">-</button>
                                <input type="text" value="${item.qty}" min="1" class="qty-input">
                                <button class="qty-btn">+</button>
                            </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
                <div class="cart-summary">
                    <div class="summary-details">
                    <h2>Order Summary</h2>
                        <div class="summary-row"><span>Subtotal:</span><span>₦${subtotal.toLocaleString()}</span></div>
                        <div class="summary-row"><span>Shipping:</span><span>₦0</span></div>
                        <div class="summary-row total"><span>Total:</span><span>₦${subtotal.toLocaleString()}</span></div>
                        <button class="checkout-btn">Proceed to Checkout</button>
                    </div>
                </div>
            </section>
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
<?php 
require 'includes/checkout_script.php';
if (!isset($_SESSION['user'])) {
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
    <link rel="stylesheet" href="../style/rv.user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Prefix - Checkout Summary</title>
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
    <?php include_once "includes/checkout-top-navbar.php"; ?>
    <?php include_once "includes/sidebar.php"; ?>
    <?php include_once "includes/bottom-navbar.php"; ?>

    <main>
        <div class="container">
            <?php 
                if (!empty($msg)) {
                    echo $msg;
                }
            ?>
            <div class="order-container">
                <div class="left-column">
                    <div class="section">
                        <h2 class="section-title">1. CUSTOMER ADDRESS <a href="edit_address.php" class="action-button">Change  <i class="fa-solid fa-angle-right"></i></a></h2>
                        <div class="address-details">
                            <p class="name"><?=$user['firstname']?> <?=$user['lastname']?></p>
                           <?php if (!empty($user['address']) && !empty($user['city']) && !empty($user['phone_number'])): ?>
                            <p><?=$user['address']?> | <?=$user['city']?> | <?=$user['phone_number']?></p>
                            <?php else: ?>
                            <p style="color:red; font-weight:300; ">Address details not set. Please update your address.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="section">
                        <h2 class="section-title">2. DELIVERY DETAILS</h2>
                        <div class="delivery-details">
                            <p><strong>Door Delivery</strong></p>
                        </div>
                    </div>
                    <div class="section">
                        <h2 class="section-title">3. PAYMENT METHOD</h2>
                        <div class="address-details">
                            <p>Payment on delivery</p>
                        </div>
                    </div>
                </div>
                
                <div class="right-column">
                    <div class="order-summary">
                        <h2 class="section-head">Order summary</h2>

                        <?php if (empty($cart_items)): ?>
                            <p>Your cart is empty.</p>
                        <?php else: ?>
                            <div class="summary-item">
                                <span>Item's total (<?= $item_count ?>)</span>
                                <span>$<?= number_format($subtotal) ?></span>
                            </div>

                            <div class="summary-item">
                                <span>Delivery fees</span>
                                <span>$<?= number_format($delivery_fee, 1, '.', ',') ?></span>
                            </div>

                            <div class="total">
                                <span>Total</span>
                                <span>$<?= number_format($total, 2, '.', ',') ?></span>
                            </div>

                            <form method="post">
                                <button type="submit" name="crt-order" class="confirm-btn">Confirm order</button>
                            </form>
                            
                        <?php endif; ?>
                    </div>

                    <p class="terms">By proceeding, you are automatically accepting the Terms & Conditions</p>
                </div>
            </div>
        </div>
    </main>
    
    <script src="../javascript/user.script.js"></script>
    <script src="../javascript/msg.js"></script>
</body>
</html>
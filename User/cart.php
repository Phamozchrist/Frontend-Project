<?php 
require '../includes/session.php';
if (!isset($_SESSION['user'])) {
    if (isset($_COOKIE['user'])) {
        $_SESSION['user'] = $_COOKIE['user'];
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
<link rel="stylesheet" href="../style/rv.user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Prefix - Cart </title>
    
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
    <section class="cart-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/rv-top-navbar.php"; ?>
        <!-- Rv Top Navigition bar -->
         
        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <?php include "includes/bottom-navbar.php"; ?>
        <!-- Bottom Navigation bar -->

        <main>
            <section class="cart-hero-section">
                <div class="cart-table-wrapper">
                    <h1 class="cart-title">Cart</h1>
                    <div class="cart-table">
                        <!-- <div class="cart-body">
                            <div>
                                <img src="${
                                item.prodImg
                                }" alt="Product" class="cart-product-img">
                            </div>
                            <p>${key}</p>
                            <span>${item.prodPrice}</span>
                        </div>
                        
                        <div class="r-btn-qty-container">
                            <button class="remove-btn"><i class="fas fa-trash"></i></button>
                            <div class="quantity-box">
                                <button class="qty-btn">-</button>
                                <input type="text" value="${item.qty}" min="1" class="qty-input">
                                <button class="qty-btn">+</button>
                            </div>
                            </div>
                        </div>
                      -->
                    </div>
                </div>
                <div class="cart-summary">
                    <!-- <div class="summary-details">
                    <h2>Order Summary</h2>
                        <div class="summary-row"><span>Subtotal:</span><span>₦${subtotal.toLocaleString()}</span></div>
                        <div class="summary-row"><span>Shipping:</span><span>₦0</span></div>
                        <div class="summary-row total"><span>Total:</span><span>₦${subtotal.toLocaleString()}</span></div>
                        <button class="checkout-btn">Proceed to Checkout</button>
                    </div>
                </div> -->
            </section>
        </main>
       <!-- Footer Section starts here -->
       <?php include "includes/footer.php"; ?>
       <!-- Footer Section ends here -->
    </section>

    <script src="../javascript/user.script.js"></script>
</body>
</html>
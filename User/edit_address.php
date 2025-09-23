<?php 
require_once 'includes/checkout_script.php';
require_once 'includes/edit_address_script.php';
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
            <div class="order-container">
                <div class="left-column">
                    <div class="section" id="profile-container">
                        <h2 class="section-title">1. CUSTOMER ADDRESS </h2>
                        <form method="post">
                            <?php 
                                if (!empty($msg)) {
                                    echo $msg;
                                }
                            ?>
                            <div class="form-box2">
                                <div>
                                    <label for="phone_number">Phone No.</label>
                                    <input type="text" name="phone_number" id="phone_number" value="<?=$user["phone_number"];?>" placeholder="Enter your phone number e.g 081*******1">
                                </div>
                                <div>
                                    <label for="city">City / State</label>
                                    <select name="city" id="city">
                                        <option disabled selected >Select your city/state</option>
                                        <?php
                                            $states = [
                                                "Abia", "Adamawa", "Akwa Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue",
                                                "Borno", "Cross River", "Delta", "Ebonyi", "Edo", "Ekiti", "Enugu",
                                                "FCT - Abuja", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano", "Katsina",
                                                "Kebbi", "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger", "Ogun", "Ondo",
                                                "Osun", "Oyo", "Plateau", "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara"
                                            ];

                                            foreach ($states as $state) {
                                                $selected = (isset($user['city']) && $user['city'] === $state) ? 'selected' : '';
                                                echo "<option value=\"$state\" $selected>$state</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-box2">
                                <div>
                                    <label for="address">Address</label>
                                    <textarea name="address" placeholder="No Address yet" id="address" autocomplete="on"><?=$user["address"];?></textarea>
                                </div>
                            </div>
                            <div class="form-button">
                                <a href="checkout.php">Cancel</a>
                                <button type="submit" name="save_ainfo">Save</button>
                            </div>
                        </form>
                        
                    </div>
                    
                    <div class="section">
                        <h2 class="section-title">2. DELIVERY DETAILS</h2>
                    </div>
                    <div class="section">
                        <h2 class="section-title">3. PAYMENT METHOD</h2>
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
                            <button disabled class="confirm-btn">Confirm order</button>
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

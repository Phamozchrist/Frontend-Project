<?php 
require '../includes/session.php';
if (!isset($_SESSION['user'])) {
    if (isset($_COOKIE['user'])) {
        $_SESSION['user'] = $_COOKIE['user'];
    } else {
        header("Location: ../login.php");
        exit();
    }
}

$oruserID = $_SESSION['user'];

// Fetch orders for this user
$orstmt = $connect->prepare(
    "SELECT o.*, p.*, oi.*
    FROM orders o
    INNER JOIN order_items oi ON o.id = oi.order_id
    INNER JOIN products p ON oi.product_id = p.id
    WHERE o.user_id = ?
    ORDER BY o.id DESC
");
$orstmt->bind_param('i', $oruserID);
$orstmt->execute();
$result = $orstmt->get_result();
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
    <title>Prefix - Orders</title>
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
    <section class="orders-section">
        <?php include_once "includes/navbar.php"; ?>
        <?php include_once "includes/rv-top-navbar.php"; ?>
        <?php include_once "includes/sidebar.php"; ?>
        <?php include_once "includes/bottom-navbar.php"; ?>

        <main class="orders-main">
            <div class="orders-container">
                <p class="orders-heading">My Orders</p>

                <?php if ($result->num_rows > 0): ?>
                    <div class="ordered-items">
                        <?php while ($row = $result->fetch_assoc()):?>
                            <div class="ordered-item">
                                <img src="../admin/uploads/<?= htmlspecialchars($row['product_image']); ?>" alt="<?= htmlspecialchars($row['product_name']); ?>" class="order-product-img">
                                
                                <div class="order-info">
                                    <p class="order-name"><?= htmlspecialchars($row['product_name']); ?></p>
                                    <p class="order-qty">Qty: <?= $row['qty']; ?></p>
                                    <p class="order-status <?=$row['status']; ?>"><?=$row['status']; ?></p>
                                    <p class="order-date">Placed on: <?= date("M j, Y g:i A", strtotime($row['created_at'])); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="no-order">
                        <i class="fa-solid fa-dolly"></i>
                        <p>You have placed no orders yet!</p>
                        <p>All your orders will appear here once you place them.</p>
                        <button><a href="index.php">Continue Shopping</a></button>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </section>
    <script src="../javascript/user.script.js"></script>
</body>
</html>

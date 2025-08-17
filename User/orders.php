<?php 
require 'includes/session.php';
if (isset($_SESSION['user'])) {
    if (isset($_COOKIE['user'])) {
        $_SESSION['user'] = $_COOKIE['user'];
    } else {
        header("Location: ../login.php");
        exit();
    }
};
// Get Category ID from URL
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category_id = intval($_GET['category']); // Use intval for security
    $stmt = "SELECT * FROM categories WHERE id = $category_id";
    $result = mysqli_query($connect, $stmt);
    if (mysqli_num_rows($result) > 0) {
        $category = mysqli_fetch_assoc($result);
    } else {
        header("Location: index.php");
        exit();
    }
    // Fetch products for this category
    $product_sql = "SELECT * FROM products WHERE product_category = $category_id ORDER BY id DESC";
    $product_query = mysqli_query($connect, $product_sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <title>Prefix - <?=ucfirst($category['category_name']);?></title>
</head>
<body>
    <section class="orders-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <main>
            
        </main>
       <!-- Footer Section starts here -->
       <?php include "includes/footer.php"; ?>
       <!-- Footer Section ends here -->
    </section>

    <script src="../javascript/user.script.js"></script>
</body>
</html>
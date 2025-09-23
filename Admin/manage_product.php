<?php 
include 'includes/session.php'; 
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard - Manage Products</title>
</head>
<body class="sb-nav-fixed">
    <div class="container-fluid">
        <?php include_once 'includes/navbar.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>

        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Manage Products</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Products</li>
                        </ol>

                        <?php
                            $msg = $_SESSION['msg'] ?? '';
                            unset($_SESSION['msg']);
                            echo $msg;
                        ?>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Manage Products
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Details</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $stmt ="SELECT p.*, c.category_name 
                                                     FROM products p 
                                                     INNER JOIN categories c 
                                                     ON c.id = p.product_category 
                                                     ORDER BY p.id DESC";
                                            $result = mysqli_query($connect, $stmt);

                                            if (mysqli_num_rows($result) > 0):
                                                while ($product = mysqli_fetch_assoc($result)):
                                                    $image = !empty($product['product_image']) 
                                                        ? "uploads/" . htmlspecialchars($product['product_image']) 
                                                        : "../images/default-product.png";
                                        ?>
                                        <tr>
                                            <td class="text-truncate" style="max-width:100px;" title="<?=ucfirst($product['product_name'])?>"><?= htmlspecialchars(ucfirst($product['product_name'])); ?></td>
                                            <td class="text-truncate" style="max-width:250px;"><?= htmlspecialchars(ucfirst($product['product_details'])); ?></td>
                                            <td><img src="<?= $image; ?>" alt="<?= htmlspecialchars($product['product_name']); ?>" width="100"></td>
                                            <td>$<?= number_format((float)$product['product_price'], 2); ?></td>
                                            <td>
                                                <?= $product['product_discount'] > 0 
                                                    ? '-' . htmlspecialchars($product['product_discount']) . '%' 
                                                    : 'No Discount'; ?>
                                            </td>
                                            <td><?=(ucfirst($product['category_name'])); ?></td>
                                            <td><?= date('Y/m/d', strtotime($product['created_on'])); ?></td>
                                            <td>
                                                <a href="edit_product.php?edit=<?= $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="action.php?delete_product=<?= $product['id']; ?>" 
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('Are you sure you want to delete this product?');">
                                                   Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endwhile; else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No Products Found</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include_once 'includes/footer.php'; ?>
            </div>
        </div>        
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>

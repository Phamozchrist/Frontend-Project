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
    <title>Dashboard with various responsiveness</title>
</head>
<body class="sb-nav-fixed">
    <div class="container-fluid">
        <?php include_once 'includes/navbar.php'; ?>
        <!-- Top navigation bar -->

        <?php include_once 'includes/sidebar.php'; ?>
        <!-- Sidebar navigation bar -->

        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"> Hello, <?= $admin['firstname'];?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Products</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="manage_product.php">View Details</a>
                                        <div class="small text-white"><i class="fa-solid fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Category</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="manage_category.php">View Details</a>
                                        <div class="small text-white"><i class="fa-solid fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Users</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="manage_users.php">View Details</a>
                                        <div class="small text-white"><i class="fa-solid fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Orders</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="manage_orders.php">View Details</a>
                                        <div class="small text-white"><i class="fa-solid fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fa-solid fa-table me-1"></i>
                                        Latest products
                                    </div>
                                    <a href="manage_product.php" class="btn btn-info">Manage products</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="datatable-table table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product name</th>
                                            <th>Product details</th>
                                            <th>Product Category</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $connect->prepare("
                                            SELECT p.id, p.product_name, p.product_details, p.product_image, p.created_on, c.category_name
                                            FROM products p 
                                            INNER JOIN categories c ON c.id = p.product_category 
                                            ORDER BY p.id DESC 
                                            LIMIT 5
                                        ");
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            while ($product = $result->fetch_assoc()) {
                                                $productName   = htmlspecialchars(ucfirst($product['product_name']));
                                                $productDetails = htmlspecialchars(ucfirst($product['product_details']));
                                                $categoryName  = htmlspecialchars(ucfirst($product['category_name']));
                                                $dateCreated   = date('Y/m/d', strtotime($product['created_on']));
                                                $imagePath     = !empty($product['product_image']) 
                                                                    ? "uploads/" . $product['product_image'] 
                                                                    : "uploads/default-product.png";
                                                ?>
                                                <tr>
                                                    <td>
                                                        <img src="<?= $imagePath; ?>" 
                                                            alt="Product Image" 
                                                            width="120" 
                                                            class="img-thumbnail">
                                                    </td>
                                                    <td><?= $productName; ?></td>
                                                    <td class="text-truncate" style="max-width: 250px;"><?= $productDetails; ?></td>
                                                    <td><?= $categoryName; ?></td>
                                                    <td><?= $dateCreated; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center'>No products found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include_once 'includes/footer.php'; ?>
                <!-- Footer -->
            </div>
        </div>        
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
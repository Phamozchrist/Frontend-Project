<?php 
include 'includes/session.php'; 
if (isset($_SESSION['admin_id'])) {
    if (isset($_COOKIE['admin_id'])) {
        $_SESSION['admin_id'] = $_COOKIE['admin_id'];
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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Fonts/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard with various responsiveness</title>
</head>
<body class="sb-nav-fixed">
    <div class="container-fluid">
        <?php include 'includes/navbar.php'; ?>
        <!-- Top navigation bar -->

        <?php include 'includes/sidebar.php'; ?>
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
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fa-solid fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Category</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fa-solid fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Users</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fa-solid fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Orders</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
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
                                    <a href="managepost.php" class="btn btn-info">Manage products</a>
                                </div>
                            </div>
                            <div class="card-body">
                            <table id="datatablesSimple" class="datatable-table">
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
                                            // Fetch posts from the database
                                            $stmt = "SELECT p.*, c.category_name FROM products p INNER JOIN categories c ON c.id = p.product_category ORDER BY p.id DESC LIMIT 5";
                                            $result = mysqli_query($connect, $stmt);
                                            while ($product = mysqli_fetch_assoc($result)) {

                                        ?>
                                       <tr>
                                           <td><img src="uploads/<?=$product['product_image'];?>" alt="" width="150px"></td>
                                            <td><?=ucfirst($product['product_name']);?></td>
                                            <td><?=ucfirst($product['product_details']);?></td>
                                            <td><?=ucfirst($product['category_name']);?></td>
                                            <td><?=date('Y/m/d', strtotime($product['created_on']));?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include 'includes/footer.php'; ?>
                <!-- Footer -->
            </div>
        </div>        
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
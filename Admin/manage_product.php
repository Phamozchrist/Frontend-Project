<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard - Manage product</title>
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
                        <h1 class="mt-4">Manage Products</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Products</li>
                        </ol>
                        <?php
                            $msg = '';
                            if (isset($_SESSION['msg'])) {
                                $msg = $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                            echo $msg;
                        ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Manage Posts
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="datatable-table">
                                    <thead>
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
                                            // Fetch posts from the database
                                            $stmt = "SELECT p.*, c.category_name FROM products p INNER JOIN categories c ON c.id = p.product_category ORDER BY p.id DESC";
                                            $result = mysqli_query($connect, $stmt);
                                            while ($product = mysqli_fetch_assoc($result)) {

                                        ?>
                                       <tr>
                                            <td><?=ucfirst($product['product_name']);?></td>
                                            <td><?=ucfirst($product['product_details']);?></td>
                                            <td><img src="uploads/<?=$product['product_image'];?>" alt="" width="150px"></td>
                                            <td>$<?=ucfirst($product['product_price']);?></td>
                                            <td>-<?=ucfirst($product['product_discount']);?>%</td>
                                            <td><?=ucfirst($product['category_name']);?></td>
                                            <td><?=date('Y/m/d', strtotime($product['created_on']));?></td>
                                            <td>
                                                <a href="edit_product.php?edit=<?=$product['id'];?>" class="btn btn-warning">Edit</a>
                                                <a href="action.php?delete_product=<?=$product['id'];?>" class="btn btn-danger">Delete</a>
                                            </td>
                                            <?php if(mysqli_num_rows($result) == 0): ?>
                                                <td>No Product Found</td>
                                            <?php endif; ?>
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
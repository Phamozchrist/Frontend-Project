<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Fonts/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard - Manage post</title>
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
                        <h1 class="mt-4">Manage Posts</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Posts</li>
                        </ol>
                        <?php
                            $msg = '';
                            if (isset($_SESSION['msg'])) {
                                $msg = $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                            echo $msg
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
                                            <th>Product Name</th>
                                            <th>Product Details</th>
                                            <th>Image</th>
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
                                            <td><?=ucfirst($product['category_name']);?></td>
                                            <td><?=date('Y/m/d', strtotime($product['created_on']));?></td>
                                            <td>
                                                <a href="edit_product.php?edit=<?=$product['id'];?>" class="btn btn-warning">Edit</a>
                                                <a href="action.php?delete=<?=$product['id'];?>" class="btn btn-danger">Delete</a>
                                            </td>
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
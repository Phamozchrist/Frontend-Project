<?php 
include 'includes/session.php'; 
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Fonts/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Dashboard - Manage P2P Post</title>
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
                        <h1 class="mt-4">P2P</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage P2P Post</li>
                        </ol>
                    </div>
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
                            Manage P2P Post
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="datatable-table">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Phone no.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Fetch categories from the database
                                        $query = "SELECT p.*, u.username 
                                                  FROM p2p_posts p
                                                  INNER JOIN user u ON p.user_id = u.id 
                                                  ORDER BY p.id DESC";
                                        $result = mysqli_query($connect, $query);
                                        while ($post = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?=$post['username'];?></td>
                                        <td><?=$post['title'];?></td>
                                        <td><img src="../admin/uploads/<?= htmlspecialchars($post['image']); ?>" alt="<?= htmlspecialchars($post['title']); ?>" width="100"></td>
                                        <td><?=$post['price'];?></td>
                                        <td><?=$post['phone_number'];?></td>
                                        <td>
                                            <a href="action.php?delete_post=<?=$post['id'];?>" class="btn btn-danger">Delete</a>
                                           
                                        </td>
                                        <?php if(mysqli_num_rows($result) == 0): ?>
                                        <td>No Post found</td>
                                        <?php endif; ?>
                                            

                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
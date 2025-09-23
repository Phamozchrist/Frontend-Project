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
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Dashboard - Manage P2P Post</title>
</head>
<body class="sb-nav-fixed">
    <div class="container-fluid">
        <?php include_once 'includes/navbar.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>

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
                        $msg = $_SESSION['msg'] ?? '';
                        unset($_SESSION['msg']);
                        echo $msg;
                    ?>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Manage P2P Post
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Username</th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Phone no.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = $connect->prepare("
                                            SELECT p.*, u.username
                                            FROM p2p_posts p
                                            INNER JOIN user u ON p.user_id = u.id
                                            ORDER BY p.id DESC
                                        ");
                                        $query->execute();
                                        $result = $query->get_result();

                                        if ($result->num_rows > 0):
                                            while ($post = $result->fetch_assoc()):
                                                $image = !empty($post['image']) ? "../admin/uploads/" . htmlspecialchars($post['image']) : "../images/default-product.png";
                                    ?>
                                    <tr>
                                        <td class="text-truncate" style="max-width:200px;"><?= htmlspecialchars($post['username']); ?></td>
                                        <td class="text-truncate" style="max-width:200px;"><?= htmlspecialchars($post['title']); ?></td>
                                        <td class="text-truncate" style="max-width:200px;"><?= htmlspecialchars($post['description']); ?></td>
                                        <td><img src="<?= $image; ?>" alt="<?= htmlspecialchars($post['title']); ?>" width="100"></td>
                                        <td>$<?= number_format((float)$post['price'], 2); ?></td>
                                        <td><?= htmlspecialchars($post['phone_number']); ?></td>
                                        <td>
                                            <a href="action.php?delete_post=<?= $post['id']; ?>" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to delete this post?');">
                                               Delete
                                            </a>
                                        </td>                                
                                    </tr>
                                    <?php endwhile; else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No P2P posts found.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
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

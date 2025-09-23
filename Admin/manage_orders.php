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
    <title>Dashboard - Manage Orders</title>
</head>
<body class="sb-nav-fixed">
    <div class="container-fluid">
        <?php include_once 'includes/navbar.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>

        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Orders</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Orders</li>
                        </ol>
                    </div>

                    <?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                    ?>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Manage Orders
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>User ID</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = $connect->prepare("
                                            SELECT 
                                                o.id AS order_id, 
                                                o.user_id, 
                                                o.status, 
                                                o.created_at,
                                                oi.qty,
                                                p.product_name
                                            FROM orders o
                                            INNER JOIN order_items oi ON o.id = oi.order_id
                                            INNER JOIN products p ON oi.product_id = p.id
                                            ORDER BY o.id DESC
                                        ");
                                        $query->execute();
                                        $result= $query->get_result();
                                        if ($result->num_rows > 0): 
                                            while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?=$row['order_id'];?></td>
                                        <td><?=$row['user_id'];?></td>
                                        <td><?=$row['product_name'];?></td>
                                        <td><?=$row['qty'];?></td>
                                        <td>
                                            <form method="post" action="action.php" class="d-flex">
                                                <input type="hidden" name="order_id" value="<?=$row['order_id'];?>">
                                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                    <option value="pending"   <?=$row['status']=='pending'?'selected':'';?>>Pending</option>
                                                    <option value="processing"<?=$row['status']=='processing'?'selected':'';?>>Processing</option>
                                                    <option value="completed" <?=$row['status']=='completed'?'selected':'';?>>Completed</option>
                                                    <option value="cancelled" <?=$row['status']=='cancelled'?'selected':'';?>>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td><?=date("Y/m/d", strtotime($row['created_at']));?></td>
                                        <td>
                                            <a href="action.php?delete_order=<?=$row['order_id'];?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php else: ?>
                                    <tr><td colspan="7" class="text-center">No orders yet</td></tr>
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

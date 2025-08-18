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
    <title>Prefix - Manage Admins</title>
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
                        <h1 class="mt-4">Manage Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Admin</li>
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
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fa-solid fa-table me-1"></i>
                                        All Admins
                                    </div>
                                    <a href="add_admin.php" class="btn btn-info">Add more &plus;</a>
                                </div>
                            </div>
                        <div class="card-body">
                           
                            <table id="datatablesSimple" class="datatable-table">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Created_on</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Fetch categories from the database
                                        $query = "SELECT * FROM admin";
                                        $result = mysqli_query($connect, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?=$row['firstname'];?></td>
                                        <td><?=$row['lastname'];?></td>
                                        <td><?=$row['email'];?></td>
                                        <td><?=date('Y/m/d', strtotime($row['created_on']));?></td>
                                        <td>
                                            <a href="edit_admin.php?edit=<?=$row['id'];?>" class="btn btn-info">Edit</a>
                                            <a href="action.php?delete_admin=<?=$row['id'];?>" class="btn btn-danger">Delete</a>
                    
                                        </td>
                                        <?php if(mysqli_num_rows($result) == 0): ?>
                                        <td>No Category</td>
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
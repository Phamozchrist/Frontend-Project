<?php 
include 'includes/script.php';
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
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard - Addcategory</title>
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
                        <h1 class="mt-4">Add Category</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Category</li>
                        </ol>
                        
                        <?=$msg;?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Add Category
                            </div>
                            
                            <div class="card-body">
                               <form method="post">
                                    <div class="form-floating mb-3 w-50 m-auto">
                                        <input class="form-control" id="category" type="text" name="category" value="<?=$category ?>" placeholder="Product Category" required />
                                        <label for="inputEmail">Category Name</label>
                                        <button type="submit" name="add_category" class="btn btn-success m-2">Create</button>
                                    </div>
                               </form>
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
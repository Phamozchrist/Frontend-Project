<?php 
include 'includes/script.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
} 
// Get Product ID from URL
if (isset($_GET['edit']) && is_numeric($_GET['edit']) && !empty($_GET['edit'])) {
    $admin_id = (int)$_GET['edit'];
    $stmt = "SELECT * FROM admin WHERE id = $admin_id";
    $result = mysqli_query($connect, $stmt);
    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
    } else {
        header("Location: manage_admin.php");
    }
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
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
    <title>Dashboard - Add Admin</title>
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
                        <h1 class="mt-4">Edit Admin Info</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Admin</li>
                        </ol>
                        <?= isset($msg) ? $msg : ''; ?>
                        <div class="card mb-4">
                            <div class="card-body mt-2">
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-6 mt-2">
                                                <div class="form-floating">
                                                    <input class="form-control" id="firstName" type="text" name="first_name" placeholder="First Name" value="<?=$admin['firstname']?>" />
                                                    <label for="firstName">First name</label>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="form-floating">
                                                    <input class="form-control" id="lastName" type="text" name="last_name" placeholder="Last Name" value="<?=$admin['lastname']?>"/>
                                                    <label for="lastName">Last Name</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-floating">
                                                    <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="<?=$admin['email']?>"/>
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>
                                           
    
                                            <button type="submit" name="edit_admin" class="btn btn-success col-3 mt-4 mx-auto">Edit Admin Info</button>
                                        </div>
                                    </form>
                                </div>
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
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
<script>
    var editor = new FroalaEditor('#productDetails');
</script>
    <script src="script.js"></script>
</body>
</html>
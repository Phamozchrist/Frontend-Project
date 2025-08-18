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
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
    <title>Prefix - Add Admin</title>
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
                        <h1 class="mt-4">Add Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Admin</li>
                        </ol>
                        <?= isset($msg) ? $msg : ''; ?>
                        <div class="card mb-4">
                            <div class="card-body mt-2">
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-6 mt-2">
                                                <div class="form-floating">
                                                    <input class="form-control" id="firstName" type="text" name="first_name" placeholder="First Name" value="<?=htmlspecialchars($first_name)?>" />
                                                    <label for="firstName">First name</label>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="form-floating">
                                                    <input class="form-control" id="lastName" type="text" name="last_name" placeholder="Last Name" value="<?=htmlspecialchars($last_name)?>"/>
                                                    <label for="lastName">Last Name</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-6 mt-2">
                                                <div class="form-floating">
                                                    <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="<?=htmlspecialchars($email)?>"/>
                                                    <label for="email">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-2">    
                                                <div class="form-floating">
                                                    <input class="form-control" id="password" type="password" name="password" placeholder="Password" />
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                           
    
                                            <button type="submit" name="add_admin" class="btn btn-success col-3 mt-4 mx-auto">Add Admin</button>
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
    <script src="script.js"></script>
</body>
</html>
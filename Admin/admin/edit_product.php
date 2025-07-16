<?php 
include 'includes/script.php';
// Get Product ID from URL
if (isset($_GET['edit']) && is_numeric($_GET['edit']) && !empty($_GET['edit'])) {
    $product_id = (int)$_GET['edit'];
    $stmt = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($connect, $stmt);
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        header("Location: manageproduct.php");
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
    <link rel="stylesheet" href="style.css">
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
    <title>Dashboard - Addproduct</title>
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
                        <h1 class="mt-4">Add Product</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Products</li>
                        </ol>
                        <?= isset($msg) ? $msg : ''; ?>
                        <div class="card mb-4">
                            <div class="card-body mt-2">
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-6 mt-2">
                                                <div class="form-floating">
                                                    <input class="form-control" id="productName" type="text" value="<?=$product['product_name']; ?>" name="product_name" placeholder="Product Name" />
                                                    <label for="productName">Product Name</label>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="form-floating">
                                                    <input class="form-control" id="productdiscount" type="text" value="<?=$product['product_discount']; ?>" name="product_discount" placeholder="Product discount" />
                                                    <label for="discount">Product discount</label>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="form-input">
                                                    <?php if (!empty($product['product_image'])): ?>
                                                        <img src="uploads/<?=($product['product_image']);?>" alt="Current Image">
                                                    <?php endif; ?>
                                                    <input class="form-control p-3" id="postImage" type="file" name="product_image" />
                                                </div>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="form-floating">
                                                    <select name="category" id="category" class="form-control">
                                                        <option value="Category">Category</option>
                                                        <?php
                                                            $stmt = "SELECT * FROM categories";
                                                            $result = mysqli_query($connect, $stmt);
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                // Check if the category is selected
                                                                $selected = ($row['id'] == $product['post_category']) ? 'selected' : '';
                                                        ?>
                                                        <option value="<?=$row['id'];?>" <?=$selected;?> ><?=$row['category_name'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="inputEmail">Select Category</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-input">
                                                    <label for="productDetails">Post Details</label>
                                                    <!-- <div id="toolbar-container"></div>
                                                    <div id="editor-container"></div> -->
                                                    <textarea name="product_details" id="productDetails" name="product_details" class="form-control" cols="50">
                                                    <?=$product['product_details']; ?>
                                                    </textarea>
                                                </div>
                                            </div>
    
                                            <button type="submit" name="edit_product" class="btn btn-success col-3 mt-4 mx-auto">Add Post</button>
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
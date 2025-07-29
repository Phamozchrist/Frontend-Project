<?php
// // Include the session file to manage user sessions
include 'includes/session.php';

// Delete Category Action
if (isset($_GET['delete_cat'])) {
    $cat_id = (int)$_GET['delete_cat'];
    $stmt = "DELETE FROM categories WHERE id = $cat_id";
    if (mysqli_query($connect, $stmt)) {
        $_SESSION['msg'] = "<div class='alert alert-success'>Category deleted successfully</div>";
        header("Location: manage_category.php");
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Error deleting category: " . mysqli_error($connect) . "</div>";
        header("Location: manage_category.php");
    }
}

// Delete Product Action
if (isset($_GET['delete_product'])) {
    $product_id = (int)$_GET['delete_product'];
    $stmt = "DELETE FROM products WHERE id = $product_id";
    if (mysqli_query($connect, $stmt)) {
        $_SESSION['msg'] = "<div class='alert alert-success'>Product deleted successfully</div>";
        header("Location: manage_product.php");
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Error deleting product: " . mysqli_error($connect) . "</div>";
        header("Location: manage_product.php");
    }
}

// Delete Admin Action
if (isset($_GET['delete_admin'])) {
    $admin_id = (int)$_GET['delete_admin'];
    $stmt = "DELETE FROM admin WHERE id = $admin_id";
    if (mysqli_query($connect, $stmt)) {
        $_SESSION['msg'] = "<div class='alert alert-success'>Admin deleted successfully</div>";
        header("Location: manage_admins.php");
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Error deleting Admin: " . mysqli_error($connect) . "</div>";
        header("Location: manage_admins.php");
    }
}

// Delete User
if(isset($_GET['delete_user'])){
    $user_id = (int)$_GET['delete_user'];
    $stmt = "DELETE from user WHERE id = $user_id";
    if (mysqli_query($connect, $stmt)) {
        $_SESSION['msg'] = "<div class='alert alert-success'>Admin deleted successfully</div>";
        header("Location: manage_users.php");
    } else{
        $_SESSION['msg'] = "<div class='alert alert-danger'>Error deleting Admin: " . mysqli_error($connect) . "</div>";
        header("Location: manage_users.php");
    }
}
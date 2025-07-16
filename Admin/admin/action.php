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

// Delete Post Action
if (isset($_GET['delete_post'])) {
    $product_id = (int)$_GET['delete_post'];
    $stmt = "DELETE FROM posts WHERE id = $product_id";
    if (mysqli_query($connect, $stmt)) {
        $_SESSION['msg'] = "<div class='alert alert-success'>Post deleted successfully</div>";
        header("Location: managepost.php");
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Error deleting post: " . mysqli_error($connect) . "</div>";
        header("Location: managepost.php");
    }
}
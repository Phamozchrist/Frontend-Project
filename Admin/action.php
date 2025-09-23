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
if (isset($_GET['delete_user'])) {
    $user_id = (int)$_GET['delete_user'];

    // Delete orders first (to avoid foreign key issues)
    $stmt1 = $connect->prepare("DELETE FROM orders WHERE user_id = ?");
    $stmt1->bind_param("i", $user_id);
    $stmt1->execute();
    $stmt2 = $connect->prepare("DELETE FROM user WHERE id = ?");
    $stmt2->bind_param("i", $user_id);

    if ($stmt2->execute()) {
        $_SESSION['msg'] = "<div class='alert alert-success'>User and their orders deleted successfully</div>";
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Error deleting user: " . $stmt2->error . "</div>";
    }

    header("Location: manage_users.php");
    exit();
}

// Delete Post Action
if (isset($_GET['delete_post'])) {
    $post_id = (int)$_GET['delete_post'];
    $stmt = "DELETE FROM p2p_posts WHERE id = $post_id";
    if (mysqli_query($connect, $stmt)) {
        $_SESSION['msg'] = "<div class='alert alert-success'>Post deleted successfully</div>";
        header("Location: p2p.php");
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Error deleting category: " . mysqli_error($connect) . "</div>";
        header("Location: p2p.php");
    }
}

// Update Order Status
if (isset($_POST['order_id'], $_POST['status'])) {
    $order_id = (int)$_POST['order_id'];
    $status   = $_POST['status'];

    $stmt = $connect->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "<div class='alert alert-success'>Order status updated</div>";
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>Error: ".$stmt->error."</div>";
    }
    header("Location: manage_orders.php");
    exit();
}

// Delete Order
if (isset($_GET['delete_order'])) {
    $order_id = (int)$_GET['delete_order'];

    $connect->query("DELETE FROM order_items WHERE order_id = $order_id");
    $connect->query("DELETE FROM orders WHERE id = $order_id");

    $_SESSION['msg'] = "<div class='alert alert-success'>Order deleted</div>";
    header("Location: manage_orders.php");
    exit();
}

?>

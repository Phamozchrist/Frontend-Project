<?php
// // Include the session file to manage user sessions
include 'includes/session.php';

// Delete Category Action
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

?>
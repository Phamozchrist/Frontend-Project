<?php
require '../includes/script.php';
if (isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    } else {
        header("Location: ../login.php");
        exit();
    }
}
if (isset($_GET['edit_post']) && !empty($_GET['edit_post'])){
    $post_id = intval($_GET['edit_post']);
    $sql = "SELECT * FROM p2p_posts WHERE id = $post_id";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);

    } else {
        header('Location: p2p.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>P2P Marketplace</title>
    <link rel="stylesheet" href="../style/user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <title>Prefix - P2P</title>
    
</head>
<body>
    <section class="p2p-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->
        <main>
            <div class="p2p-container">
                <h1>Edit a Post</h1>
                <!-- Create Post Form -->
                <div>
                    <form class="p2p-create-form" method="post" enctype="multipart/form-data">
                        <h2>Edit Post</h2>
                        <input type="text" name="title" placeholder="Item Title" value="<?= $post['title'];?>">
                        <input type="text" name="price" placeholder="Price" value="<?= $post['price'];?>">
                        <input type="text" name="phone_num" placeholder="Phone Number" value="<?= $post['phone_number'];?>">
                        <textarea name="description" placeholder="Description"><?= $post['description'];?></textarea>
                        <input type="file" name="image" accept="image/*">
                        <button type="submit" name="edit_post">Edit Item</button>
                    </form>
                </div>
                </div>
            </div>
            
        </main>
        <?php include "includes/footer.php"; ?>
       <!-- Footer Section ends here -->
    </section>

    <script src="../javascript/user.script.js"></script>
</body>
</html>
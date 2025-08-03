<?php
require '../includes/session.php';
// Handle new post creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_post'])) {
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $price = floatval($_POST['price']);
    $desc = mysqli_real_escape_string($connect, $_POST['description']);
    $user_id = $_SESSION['user_id'];
    // Handle image upload if needed
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = rand(1000,9999) . "." . $ext;
        $target = "../admin/uploads/" . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image = $filename;
    }
    $sql = "INSERT INTO p2p_posts (user_id, title, price, description, image) VALUES ('$user_id', '$title', '$price', '$desc', '$image')";
    mysqli_query($connect, $sql);
}

// Fetch all P2P posts
$posts = mysqli_query($connect, "SELECT p.*, u.username FROM p2p_posts p JOIN user u ON p.user_id = u.id ORDER BY p.id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>P2P Marketplace</title>
    <link rel="stylesheet" href="../style/user.style.css">
</head>
<body>
    <?php include "includes/navbar.php"; ?>
    <?php include "includes/sidebar.php"; ?>
    <div class="p2p-main">
        <h1>P2P Marketplace</h1>
        <!-- Create Post Form -->
        <section>
            <form class="p2p-create-form" method="post" enctype="multipart/form-data">
                <h2>Create a Post</h2>
                <input type="text" name="title" placeholder="Item Title" required>
                <input type="number" name="price" placeholder="Price" required>
                <textarea name="description" placeholder="Description" required></textarea>
                <input type="file" name="image" accept="image/*">
                <button type="submit" name="create_post">Post Item</button>
            </form>
        </section>
        <!-- List of Posts -->
        <section>
            <h2 style="text-align:center; margin-bottom:18px;">Buy & Sell</h2>
            <div class="p2p-list">
                <?php while($post = mysqli_fetch_assoc($posts)): ?>
                    <div class="p2p-item">
                        <?php if($post['image']): ?>
                            <img src="../admin/uploads/<?= htmlspecialchars($post['image']); ?>" alt="<?= htmlspecialchars($post['title']); ?>">
                        <?php endif; ?>
                        <h3><?= htmlspecialchars($post['title']); ?></h3>
                        <div class="p2p-price">₦<?= htmlspecialchars($post['price']); ?></div>
                        <p><?= htmlspecialchars($post['description']); ?></p>
                        <small>Seller: <?= htmlspecialchars($post['username']); ?></small>
                        <div class="p2p-btns">
                            <button class="p2p-buy-btn">Buy</button>
                            <button class="p2p-chat-btn">Chat</button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
    </div>
</body>
</html>
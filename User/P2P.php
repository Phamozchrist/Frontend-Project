<?php
 require 'includes/session.php';
if (isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    } else {
        header("Location: ../login.php");
        exit();
    }
}
$user_id = $_SESSION['user'];
// Fetch all P2P posts
$posts = mysqli_query($connect, "SELECT p.*, u.username FROM p2p_posts p INNER JOIN user u ON p.user_id = u.id ORDER BY p.id DESC");
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
                <h1>P2P Marketplace</h1>
                <!-- Create Post Form -->
                <?php
                // ...existing code...
                
                $user_posts = mysqli_query($connect, "SELECT * FROM p2p_posts WHERE user_id = '$user_id' ORDER BY id DESC");
                ?>
                <!-- ...existing code... -->
               
                <!-- User's Unique Posts Section -->
                <h2 style="margin:28px 0 18px;" style="display: inline; width: 50%;">Your Posts</h2>
                <span><a href="p2p-addpost.php">Create Post</a></span>
                <div class="p2p-list-table">
                    <table class="p2p-table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Phone no.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($user_posts) > 0): ?>
                                <?php while($post = mysqli_fetch_assoc($user_posts)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($post['title']); ?></td>
                                    <td>
                                        <?php if($post['image']): ?>
                                            <img src="../admin/uploads/<?= htmlspecialchars($post['image']); ?>" alt="<?= htmlspecialchars($post['title']); ?>" width="70" style="border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
                                        <?php else: ?>
                                            <span style="color:#aaa;">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>₦<?= htmlspecialchars($post['price']); ?></td>
                                    <td><?= htmlspecialchars($post['phone_number']); ?></td>
                                    <td>
                                        <a href="p2p-post-details.php?post=<?=$post['id'];?>?<?=$post['title'];?>" class="p2p-btn p2p-edit">View</a>
                                        <a href="p2p-editpost.php?edit_post=<?=$post['id'];?>?<?=$post['title'];?>" class="p2p-btn p2p-edit">Edit</a>
                                        <a href="action.php?delete_post=<?=$post['id'];?>?<?=$post['title'];?>" class="p2p-btn p2p-delete" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;color:#888;">You have not created any post yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- ...rest of your page... -->
                <!-- Buy & Sell Table -->
                <h2 style="margin-bottom:18px;">Buy from other users</h2>
                <div class="p2p-list-table">
                    <table class="p2p-table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($posts) > 0): ?>
                                <?php while($post = mysqli_fetch_assoc($posts)): ?>
                                <tr>
                                    <td><?= htmlspecialchars(ucfirst($post['username'])); ?></td>
                                    <td><?= htmlspecialchars($post['title']); ?></td>
                                    <td>
                                        <?php if($post['image']): ?>
                                            <img src="../admin/uploads/<?= htmlspecialchars($post['image']); ?>" alt="<?= htmlspecialchars($post['title']); ?>" width="70" style="border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
                                        <?php else: ?>
                                            <span style="color:#aaa;">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>$<?= htmlspecialchars($post['price']); ?></td>
                                    <td>
                                        <a href="p2p-post-details.php?post=<?=$post['id'];?>?<?=$post['title'];?>" class="p2p-btn p2p-edit">Buy</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;color:#888;">No Post Found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </main>
        <?php include "includes/footer.php"; ?>
       <!-- Footer Section ends here -->
    </section>

    <script src="../javascript/user.script.js"></script>
</body>
</html>
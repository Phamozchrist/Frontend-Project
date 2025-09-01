<?php
 require '../includes/session.php';
if (!isset($_SESSION['user'])) {
    if (isset($_COOKIE['user'])) {
        $_SESSION['user'] = $_COOKIE['user'];
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
<link rel="stylesheet" href="../style/rv.user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Prefix - P2P</title>
    <script>
        (function() {
            const savedTheme = localStorage.getItem("theme") || "system-default-theme";
            const prefersDark = window.matchMedia("(prefers-color-scheme: dark)");

            let themeToApply = savedTheme;
            if (savedTheme === "system-default-theme") {
                themeToApply = prefersDark.matches ? "dark-theme" : "light-theme";
            }

            // Remove any previous theme classes
            document.documentElement.classList.remove("light-theme", "dark-theme", "system-default-theme");
            document.documentElement.classList.add(themeToApply);

            // Listen for OS theme changes if system default is selected
            prefersDark.addEventListener("change", function() {
                if (localStorage.getItem("theme") === "system-default-theme") {
                    const newTheme = prefersDark.matches ? "dark-theme" : "light-theme";
                    document.documentElement.classList.remove("light-theme", "dark-theme");
                    document.documentElement.classList.add(newTheme);
                }
            });
        })();
    </script>
</head>
<body>
    <section class="p2p-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/rv-top-navbar.php"; ?>
        <!-- Rv Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <?php include "includes/bottom-navbar.php"; ?>
        <!-- Bottom Navigation bar -->
        <main>
            <div class="p2p-container">
                <h1>P2P Marketplace</h1>
                <?php
                    $user_posts = mysqli_query($connect, "SELECT * FROM p2p_posts WHERE user_id = '$user_id' ORDER BY id DESC");
                ?>
                <div class="p2p-header">
                    <h2>Your Posts</h2>
                    <span>
                        <a href="p2p-addpost.php" class="p2p-create-btn">Create Post +</a>
                    </span>
                
                </div>
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
                            <?php 
                                if(mysqli_num_rows($user_posts) > 0):
                                while($post = mysqli_fetch_assoc($user_posts)): 
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($post['title']); ?></td>
                                    <td>
                                        <?php if($post['image']): ?>
                                            <img src="../admin/uploads/<?= htmlspecialchars($post['image']); ?>" alt="<?= htmlspecialchars($post['title']); ?>" width="70" style="border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
                                        <?php else: ?>
                                            <span style="color:#aaa;">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>$<?= htmlspecialchars($post['price']); ?></td>
                                    <td><?= htmlspecialchars($post['phone_number']); ?></td>
                                    <td>
                                        <a href="p2p-post-details.php?post=<?=$post['id'];?>?<?=$post['title'];?>" class="p2p-btn p2p-edit">View</a>
                                        <a href="#" class="p2p-btn p2p-delete" data-delete-url="action.php?delete_post=<?=$post['id'];?>?<?=$post['title'];?>" onclick="openDeleteModal(this); return false;">Delete</a>
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
                            <?php 
                                if(mysqli_num_rows($posts) > 0):
                                while($post = mysqli_fetch_assoc($posts)): 
                            ?>
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
    </section>

    <div id="deleteModal" class="p2p-modal">
        <div class="p2p-modal-content">
            <h3>Delete Post</h3>
            <p>Are you sure you want to delete this post?</p>
            <div class="p2p-modal-actions">
                <button id="cancelDelete" class="p2p-modal-btn p2p-cancel-btn">Cancel</button>
                <a id="confirmDelete" href="#" class="p2p-modal-btn p2p-ok-btn">OK</a>
            </div>
        </div>
    </div>
    <script src="../javascript/user.script.js"></script>
</body>
</html>
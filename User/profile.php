<?php
require '../includes/session.php';
if (isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    } else {
        header("Location: ../login.php");
        exit();
    }
}

// Example: Fetch user data (replace with your actual logic)
$user_id = $_SESSION['user'];
// Fetch all P2P posts
$posts = mysqli_query($connect, "SELECT p.*, u.username FROM p2p_posts p INNER JOIN user u ON p.user_id = u.id ORDER BY p.id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="../style/user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
</head>
<body>
    <?php include "includes/navbar.php"; ?>
    <?php include "includes/sidebar.php"; ?>
    <!-- Side Navigation bar -->

    <main class="profile-main">
        <div class="profile-card">
            <div class="profile-avatar">
                <form class="avatar-form">
                    <label for="profile_pic" class="avatar-upload">
                        <img src="../admin/uploads/default_profile.png" alt="Profile Picture">
                        <i class="fa-solid fa-camera"></i>
                        <input type="file" name="profile_pic" id="profile_pic" accept="image/*" style="display:none;">
                    </label>
                </form>
            </div>
            <div class="profile-info">
                <h2>Famous Stephen</h2> 
                <span class="online"><small></small> active</span>
                <span class="online">user</span>
                <button name="edit_profile" class="edit-btn">
                    <i class="fa-solid fa-pen"></i> Edit Profile
                </button>
                <p class="profile-email">stevo@gmail.com</p>
                <!-- Example additional fields -->
                <p class="profile-joined">Created on: <?= htmlspecialchars($user['joined'] ?? '2025-01-01'); ?></p>
            </div>
        </div>
        <?php
        // ...existing code...
        
            $user_posts = mysqli_query($connect, "SELECT * FROM p2p_posts WHERE user_id = '$user_id' ORDER BY id DESC");
        ?>
        <div class="p2p-list-table profile-post">
            <h2>Posts</h2>
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
    </main>
    <?php include "includes/footer.php"; ?>
    <!-- Footer Section ends here -->
    <script src="../javascript/user.script.js"></script>
</body>
</html>
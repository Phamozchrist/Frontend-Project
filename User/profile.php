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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="../style/user.style.css">
    <link rel="stylesheet" href="../style/rv.user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
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
    <?php include "includes/navbar.php"; ?>
    <?php include "includes/sidebar.php"; ?>
    <!-- Side Navigation bar -->

    <?php include "includes/rv-top-navbar.php"; ?>
    <!-- Rv Top Navigition bar -->

    <?php include "includes/bottom-navbar.php"; ?>
    <!-- Bottom Navigation bar -->

    <main class="profile-main">
        <div class="profile-card">
            <div class="profile-avatar">
                <div class="avatar-cover" method="post" enctype="multipart/form-data">
                    <label class="avatar-uploadCover" for="profileCover">
                        <input type="file" id="profileCover"
                        hidden disabled>
                        <i class="fa-solid fa-camera"></i>
                        <img src="../admin/uploads/<?=$user['cover_pics'];?>" id="profileCover" alt="Profile Picture">
                    </label>
                </div>
                <div class="avatar-form" method="post" enctype="multipart/form-data">
                    <label for ="profilePic" class="avatar-upload">
                        <input type="file" name="image" id="profilePic"
                        hidden disabled>
                        <i class="fa-solid fa-camera"></i>
                        <img src="../admin/uploads/<?=$user['profile_pics'];?>" id="profilePic" alt="Profile Picture">
                    </label>
                </div>
            </div>
            <div class="profile-info">
                <h2><?=$user['firstname']?> <?=$user['lastname']?> </h2> 
                <span class="online"><small></small> active</span>
                <span class="online">user</span>
                <button name="edit_profile" class="edit-btn">
                    <a href="edit_profile.php"><i class="fa-solid fa-pen"></i> Edit Profile</a>
                </button>
            </div>
        </div>
        <!-- About Section -->
        <div class="profile-about-section">
            <h3>More Info</h3>

            <p> <i class="fas fa-envelope"></i><?=$user['email'];?></p>
            <p> <i class="fas fa-location-dot"></i><?= isset($user['address']) ? $user['address'] : 'No address';?></p>
        </div>
        <div class="p2p-list-table profile-post">
            <?php
            // Fetch user's P2P posts
                $user_id = $_SESSION['user'];
                $user_posts = mysqli_query($connect, "SELECT * FROM p2p_posts WHERE user_id = '$user_id' ORDER BY id DESC");
            ?>
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
    <script src="../javascript/user.script.js"></script>
</body>
</html>
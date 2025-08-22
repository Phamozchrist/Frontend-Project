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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="../style/user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <style>
        .section {
            width: 100%;
            border-radius: 10px;
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        .section h3 {
            margin-top: 0;
            font-size: 18px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .section p {
            display: flex;
            align-items: center;
            gap: 20px;
            margin: 10px 10px 15px;

            i{
                color: #84e6d7;
                font-size: 20px;
                background-color: #f0f0f0;
                /* padding: 10px; */

                width: 40px;
                height: 40px;
                text-align: center;
                place-content: center;
                border-radius: 50%;
            }
        }
    </style>
</head>
<body>
    <?php include "includes/navbar.php"; ?>
    <?php include "includes/sidebar.php"; ?>
    <!-- Side Navigation bar -->

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
                <!-- About Section -->
                <div class="section">
                    <h3>More Info</h3>

                    <p> <i class="fas fa-envelope"></i><?=$user['email'];?></p>
                    <p> <i class="fas fa-location-dot"></i><?=$user['address'];?></p>
                </div>
                <!-- Example additional fields -->
                <p class="profile-joined">Created on: <?= htmlspecialchars($user['joined'] ?? '2025-01-01'); ?></p>
            </div>
        </div>
        <?php
        // ...existing code...
        // Fetch user's P2P posts
            $user_id = $_SESSION['user'];
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
    <script src="../javascript/user.script.js"></script>
    <script>
        (function() {
            const savedTheme = localStorage.getItem("theme") || "system-default-theme";
            const prefersDark = window.matchMedia("(prefers-color-scheme: dark)");

            let themeToApply = savedTheme;
            if (savedTheme === "system-default-theme") {
                themeToApply = prefersDark.matches ? "dark-theme" : "light-theme";
            }

            // Remove any previous theme classes
            document.body.classList.remove("light-theme", "dark-theme", "system-default-theme");
            document.body.classList.add(themeToApply);

            // Listen for OS theme changes if system default is selected
            prefersDark.addEventListener("change", function() {
                if (localStorage.getItem("theme") === "system-default-theme") {
                    const newTheme = prefersDark.matches ? "dark-theme" : "light-theme";
                    document.body.classList.remove("light-theme", "dark-theme");
                    document.body.classList.add(newTheme);
                }
            });
        })();
    </script>
</body>
</html>
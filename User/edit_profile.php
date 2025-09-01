<?php 
include 'includes/editprofile_script.php';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/user.style.css">
<link rel="stylesheet" href="../style/rv.user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <title>Prefix - Settings </title>
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
    <section class="settings-section edit-profile-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <?php include "includes/rv-top-navbar.php"; ?>
        <!-- Rv Top Navigition bar -->
         
        <?php include "includes/bottom-navbar.php"; ?>
        <!-- Bottom Navigation bar -->

        <?php include "includes/settings-sidebar.php"; ?>

        <main class="main-settings">
            <div id="profile-container">
                <h4>Edit Profile</h4>
                <div class="profile-card edit-profile-card">
                    <div class="profile-info">
                        <form method="post" enctype="multipart/form-data">
                            <?php 
                                if (!empty($msg)) {
                                    echo $msg;
                                }
                            ?>
                            <div class="profile-avatar">
                                <div class="avatar-cover">
                                    <label class="avatar-uploadCover" for="uploadCoverProfile">
                                        <input type="file" name="cover_pics" id="uploadCoverProfile" accept="image/*" style="display:none;">
                                        <i class="fa-solid fa-camera"></i>
                                        <img src="../admin/uploads/<?=$user['cover_pics'];?>" id="profileCover" alt="Profile Picture">
                                    </label>
                                </div>
                                <div class="avatar-form">
                                    <label for="uploadProfile" class="avatar-upload">
                                        <i class="fa-solid fa-camera"></i>
                                        <input type="file" name="profile_pics" id="uploadProfile" accept="image/*" style="display:none;">
                                        <img src="../admin/uploads/<?=$user['profile_pics'];?>" id="profilePic" alt="Profile Picture">
                                    </label>
                                </div>
                            </div>
                            <div class="form-box2">
                                <div>
                                    <label for="firstname">Firstname</label>
                                    <input type="text" name="firstname" id="" value="<?=$user["firstname"];?>">
                                </div>
                                <div>
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" id="" value="<?=$user["lastname"];?>">
                                </div>
                            </div>
                            <div class="form-box2">
                                <div>
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="" value="<?=$user["username"];?>">
                                </div>
                                <div>
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="" value="<?=$user["email"];?>">
                                </div>
                            </div>
                            <div class="form-box2">
                                <div>
                                    <label for="address">Address</label>
                                    <textarea name="address"><?=$user["address"];?></textarea>
                                </div>
                            </div>
                            <div class="form-button">
                                <button type="submit" name="save_uinfo">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <script src="../javascript/user.script.js"></script>
    <script src="../javascript/profile.js"></script>
    <script src="../javascript/msg.js"></script>
</body>
</html>
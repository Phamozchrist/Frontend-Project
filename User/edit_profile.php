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
        <?php include_once "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include_once "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <?php include_once "includes/rv-top-navbar.php"; ?>
        <!-- Rv Top Navigition bar -->
         
        <?php include_once "includes/bottom-navbar.php"; ?>
        <!-- Bottom Navigation bar -->

        <?php include_once "includes/settings-sidebar.php"; ?>

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
                                        <img src="../admin/uploads/<?= !empty($user['cover_pics']) ? htmlspecialchars($user['cover_pics']) : 'default-profile.png'; ?>" id="profileCover" alt="Cover Picture">
                                    </label>
                                </div>
                                <div class="avatar-form">
                                    <label for="uploadProfile" class="avatar-upload">
                                        <i class="fa-solid fa-camera"></i>
                                        <input type="file" name="profile_pics" id="uploadProfile" accept="image/*" style="display:none;">
                                        <img src="../admin/uploads/<?= !empty($user['profile_pics']) ? htmlspecialchars($user['profile_pics']) : 'default-profile.png'; ?>" id="profilePic" alt="Profile Picture">
                                    </label>
                                </div>
                            </div>
                            <div class="form-box2">
                                <div>
                                    <label for="firstname">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" value="<?=$user["firstname"];?>" placeholder="Enter your firstname">
                                </div>
                                <div>
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" value="<?=$user["lastname"];?>" placeholder="Enter your lastname">
                                </div>
                            </div>
                            <div class="form-box2">
                                <div>
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" value="<?=$user["username"];?>" placeholder="Enter your username">
                                </div>
                                <div>
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" value="<?=$user["email"];?>" placeholder="Enter your email">
                                </div>
                            </div>
                            <div class="form-box2">
                                <div>
                                    <label for="phone_number">Phone No.</label>
                                    <input type="text" name="phone_number" id="phone_number" value="<?=$user["phone_number"];?>" placeholder="Enter your phone number e.g 081*******1">
                                </div>
                                <div>
                                    <label for="city">City / State</label>
                                    <select name="city" id="city">
                                        <option disabled selected >Select your city/state</option>
                                        <?php
                                            $states = [
                                                "Abia", "Adamawa", "Akwa Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue",
                                                "Borno", "Cross River", "Delta", "Ebonyi", "Edo", "Ekiti", "Enugu",
                                                "FCT - Abuja", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano", "Katsina",
                                                "Kebbi", "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger", "Ogun", "Ondo",
                                                "Osun", "Oyo", "Plateau", "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara"
                                            ];

                                            foreach ($states as $state) {
                                                $selected = (isset($user['city']) && $user['city'] === $state) ? 'selected' : '';
                                                echo "<option value=\"$state\" $selected>$state</option>";
                                            }
                                        ?>
                                    </select>
                                    </div>

                            </div>
                            <div class="form-box2">
                                <div>
                                    <label for="address">Address</label>
                                    <textarea name="address" placeholder="No Address yet" id="address"><?=$user["address"];?></textarea>
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
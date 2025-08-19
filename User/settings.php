<?php 
require 'includes/script.php';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/user.style.css">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <title>Prefix - Settings </title>
</head>
<body>
    <section class="settings-section">
        <?php include "includes/navbar.php"; ?>
        <!-- Top Navigition bar -->

        <?php include "includes/sidebar.php"; ?>
        <!-- Side Navigation bar -->

        <main class="main-settings">
            <aside class="settings-sidebar">
                <h4>Settings Center</h4>
                <div style="display: none;">
                    <!-- <img src="../admin/uploads/" alt=""> -->
                    <div>
                        <p></p>
                        <p></p>
                    </div>

                </div>
                <ul class="sidebar-nav-container">
                    <li class="nested-nav nsn-1 close-nested-nav">General Settings
                        <ul class="nested-sidebar-nav">
                            <li class="themesBtn"><i class="fa-solid fa-palette"></i>Themes</li>
                        </ul>
                    </li>
                    <li class="nested-nav nsn-2 close-nested-nav">Account Management
                        <ul class="nested-sidebar-nav">
                            <li class="profileBtn"><i class="fa-solid fa-user"></i>Edit Profile</li>
                        </ul>
                    </li>
                    <li class="nested-nav nsn-3 close-nested-nav">Privacy & Security
                        <ul class="nested-sidebar-nav">
                            <li class="authBtn"><i class="fa-solid fa-fingerprint"></i>Two-Factor Authentication</li>
                            <li class="passBtn"><i class="fa-solid fa-key"></i>Password Management</li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <div style="width: 67%; margin-left: 28px;">
                <div id="default-settings"> 
                    <i class="fa-solid fa-gear"></i>
                    <p>Customize your experiences by adjusting preferences & account settings to suit your needs</p>
                </div>
                <div id="themes-container">
                    <h4>Theme Settings</h4>
                    <p>Choose a theme that suits your style and preferences.</p>
                    <div class="theme-options">
                        <div class="theme-option light-theme active" data-theme="light">
                            <span>Light Theme</span>
                        </div>
                        <div class="theme-option dark-theme" data-theme="dark">
                            <span>Dark Theme</span>
                        </div>
                        <div class="theme-option system-theme" data-theme="blue">
                            <span>System default</span>
                        </div>
                    </div>
                </div>
                <div id="profile-container">
                    <h4>Edit Profile</h4>
                    <div class="profile-card">
                        <div class="profile-avatar">
                            <form class="avatar-form">
                                <label for="profile_pic" class="avatar-upload">
                                    <img src="../admin/uploads/default_profile.png" alt="Profile Picture" id="profilePic" class="profile-pic">
                                    <i class="fa-solid fa-camera"></i>
                                    <input type="file" name="profile_pic" id="profile_pic" id="uploadProfile" accept="image/*" style="display:none;">
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
                </div>
                <div id="auth-container">
                    <h4>Two-Factor Authentication</h4>
                    <p>Enable Two-Factor Authentication to add an extra layer of security to your account.</p>
                    <div class="auth-btns">
                        <button class="enable-auth-btn">Enable</button>
                        <button class="disable-auth-btn">Disable</button>
                    </div>
                </div>
                <div id="pass-container">
                    <h4>Password Management</h4>
                    <p>Change your password to keep your account secure.</p>
                    <?php if(!empty($msg)) { ?>
                        <?=($msg);?>
                    <?php } ?>
                    <form id="form" method = "post">
                        <div class="form-box">
                            <input type="password" name="password" id="password" value="<?=$password;?>" class="<?=empty($passwordErr) ? '' : 'is-invalid';?>" required>  
                            <i class="fa-regular fa-eye show-password toggle-eye" data-target="password"></i>
                            <label for="password">Old Password*</label>
                            <p class="password-err"><?=$passwordErr;?></p>
                        </div>
                        <div class="form-box">
                            <input type="password" name="new_password" id="new_password" value="<?=$password;?>" class="<?=empty($newpasswordErr) ? '' : 'is-invalid';?>" required>  
                            <i class="fa-regular fa-eye show-password toggle-eye" data-target="new_password"></i>
                            <label for="new_password">New Password*</label>
                            <p class="new_password-err"><?=$passwordErr;?></p>
                            <p>Password should be at least 8 characters including a number and a lowercase letter.</p>
                        </div>
                        <div class="form-box">
                            <input type="password" name="confirm_password" value="<?=$confirmPassword;?>" id="confirm_password" class="<?=empty($confirmPasswordErr) ? '' : 'is-invalid';?>" required>
                            <i class="fa-regular fa-eye show-password toggle-eye" data-target="confirm_password"></i>
                            <label for="confirm_password">Confirm Password*</label>
                            <p class="confirm_password-err"><?=$confirmPasswordErr;?></p>
                        </div>
                        <div class="btnCon">
                            <button type="submit" name="save" id="button" disabled>
                                <span id="btnText">Save</span>
                                <span id="spinner" class="spinner hidden"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
       <!-- Footer Section starts here -->
       <?php include "includes/footer.php"; ?>
       <!-- Footer Section ends here -->
    </section>

    <script src="../javascript/user.script.js"></script>
    <script>
        const input1 = document.getElementById("uploadProfile");
        const profilePic = document.getElementById("profilePic");

        input1.addEventListener("change", function(){
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e){
                    profilePic.src = e.target.result; // show preview
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
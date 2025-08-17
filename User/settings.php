<?php 
require 'includes/script.php';
if (isset($_SESSION['user'])) {
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
                    <img src="../admin/uploads/" alt="">
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
                            <li class="profileBtn"><i class="fa-solid fa-user"></i>Profile</li>
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
            <div style="width: 70%; margin-left: 28px;">
                <div id="default-settings"> 
                    <i class="fa-solid fa-gear"></i>
                    <p>Customize your experiences by adjusting preferences & account settings to suit your needs</p>
                </div>
                <div id="themes-container">
                    
                </div>
                <div id="profile-container">
                    <div class="cover-image">
                        <input type="file" name="" id="" >
                    </div>
                    <div>
                        <input type="file" name="" id="">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </div>
                <div id="auth-container">
    
                </div>
                <div id="pass-container">
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
</body>
</html>
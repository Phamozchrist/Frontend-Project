<?php include 'includes/login_script.php';?>
<!DOCTYPE html>
<html lang="en" loading="lazy">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/login.rv.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"> -->
    <title>Prefix - Admin Login</title>
</head>
<body class="login-container">
    <!-- <?php include 'includes/loader.php';?> -->
    <div id="particles-js"></div>
    <div id="login-modal">
        <div class="login-logo-container">
            <div class="login-logo"></div>
            <p>PreFix</p>
        </div>
        <div class="login-header">
            <h1 class="dv-title">Log in as a PreFix Administrator</h1>
            <h1 class="mv-title">Log in only on a desktop or laptop</h1>
        </div>
        <div class="login-modal-content admin-modal-content">            
            <form id="form" method="post">
                <?=$msg;?>
                <div class="form-box">
                    <i class="fa-solid fa-user eU-icon"></i>
                    <input type="text" name="email" id="emailOrUsername" class="<?=empty($emailErr) ? '' : 'is-invalid';?>" value="<?= htmlspecialchars($email); ?>" required>
                    <label for="emailOrUsername">Email or Username</label>
                    <p class="emailOrUsername-err"><?=$emailErr;?></p>
                </div>
                <div class="form-box">
                    <i class="fa-solid fa-lock lp-icon"></i>
                    <input type="password" name="login_password" id="login_password" class="<?=empty($login_passwordErr) ? '' : 'is-invalid';?>" value="<?= htmlspecialchars($login_password); ?>" required>
                    <i class="fa-regular fa-eye show-password toggle-eye" data-target="login_password"></i>
                    <label for="login_password">Password</label>
                    <p class="login_password-err"><?=$login_passwordErr;?></p>
                </div>
                <div>
                    <button type="submit" id="button" disabled>
                        <span id="btnText">Log in</span>
                        <span id="spinner" class="spinner hidden"></span>
                    </button>
                </div>
            </form>
        </div>
        <div class="terms">
            <p>By logging in, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a> © 2025 Prefix. All rights reserved.</p>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <script src="../javascript/login_auth.js"></script>
</body>
</html>
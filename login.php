<?php include 'includes/login_script.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" href="images/pc logo.png" type="image/x-icon">
    <link rel="stylesheet" href="fonts/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"> -->
    <title>Prefix - Login</title>
</head>
<body class="login-container">
    <!-- <?php include 'includes/loader.php';?> -->
    <div id="particles-js"></div>
    <div id="login-modal">
        <div class="login-logo"></div>
        <div class="login-header">
            <h1>Log in to PreFix</h1>
        </div>
        <div class="login-modal-content">            
            <form id="form" method="post">
                <?php if(!empty($msg)) { ?>
                    <?=($msg);?>
                <?php } ?>
                <div class="form-box">
                    <i class="fa-solid fa-user eU-icon"></i>
                    <input type="text" name="emailOrUsername" id="emailOrUsername" class="<?=empty($emailOrUsernameErr) ? '' : 'is-invalid';?>" value="<?= htmlspecialchars($emailOrUsername); ?>" required>
                    <label for="emailOrUsername">Email or Username</label>
                    <p class="emailOrUsername-err"><?=$emailOrUsernameErr;?></p>
                </div>
                <div class="form-box">
                    <i class="fa-solid fa-lock lp-icon"></i>
                    <input type="password" name="login_password" id="login_password" class="<?=empty($login_passwordErr) ? '' : 'is-invalid';?>" value="<?= htmlspecialchars($login_password); ?>" required>
                    <i class="fa-regular fa-eye show-password toggle-eye" data-target="login_password"></i>
                    <label for="login_password">Password</label>
                    <p class="login_password-err"><?=$login_passwordErr;?></p>
                </div>
                <div class="login-details">
                    <div class="checkbox"> 
                        <label class="custom-checkbox">
                            <input type="checkbox" name="remember_me" id="remember_me">
                            <span class="checkmark"></span>
                            Keep me logged in
                        </label>
                    </div>
                    <p>forgot password?</p>
                </div>
                <div>
                    <button type="submit" id="button" disabled>Log in</button>
                </div>
            </form>
            
            <div class="social-media">
                <p>or continue with</p>
                <div class="social-icons">
                    <i class="fa-brands fa-instagram" style="background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); background-clip: text; color: transparent;"></i>
                    <i class="fa-brands fa-facebook" style="color: #3b5998;"></i>
                    <i class="fa-brands fa-twitter" style="color: #1DA1F2;"></i>
                    <i class="fa-brands fa-github" style="color: #000000;"></i>
                </div>
            </div>
        </div>
        <div class="login-footer">
            <p><a href="admin/login.php">Log in as an Administrator</a></p>
            <p>Don't have an account?<a href="register.php" id="trigger">   Create account</a></p>
        </div>
        <div class="terms">
            <p>By logging in, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a> © 2025 Prefix. All rights reserved.</p>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <script src="javascript/login_auth.js" defer></script>
</body>
</html>
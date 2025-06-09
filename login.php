<?php require 'includes/login_script.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/pc logo.png" type="image/x-icon">
    <link rel="stylesheet" href="fonts/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"> -->
    <title>Prefix - Login</title>
    <style>
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-color:rgb(255, 255, 255);
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <script>
         particlesJS.load('particles-js', 'particles.json');
    </script>
    
</head>
<body class="login-container">
    <?php include 'includes/loader.php';?>
    <div id="particles-js"></div>
    <div id="login-modal">
        <div class="login-logo"></div>
        <div class="login-header">
            <h1>Log in to PreFix</h1>
        </div>
        <div class="login-modal-content">            
            <form id="form" method="post">
                <?php if(!empty($successMsg)) { ?>
                    <?=($successMsg);?>
                <?php } ?>
                <?=$msg?>
                <div class="form-box">
                    <input type="text" name="emailOrUsername" id="emailOrUsername" class="<?=empty($emailOrUsernameErr) ? '' : 'is-invalid';?>" required>
                    <label for="emailOrUsername">Email or Username</label>
                    <p class="emailOrUsername-err"><?=$emailOrUsernameErr;?></p>
                </div>
                <div class="form-box">
                    <input type="password" name="login_password" id="login_password" class="<?=empty($passwordErr) ? '' : 'is-invalid';?>" required>
                    <label for="login_password">Password</label>
                    <p class="login_password-err"><?=$passwordErr;?></p>
                </div>
                <div class="login-details">
                    <div class="checkbox"> 
                        <label class="custom-checkbox">
                            <input type="checkbox" name="remember_me" id="remember_me">
                            <span class="checkmark"></span>
                            Keep me logged in
                            <p class="error"><?=$termsErr;?></p>
                        </label>
                    </div>
                    <p>forgot password?</p>
                </div>
                <div>
                    <button type="submit" id="button">Log in</button>
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
    


    <script src="auth.js"></script>
</body>
</html>
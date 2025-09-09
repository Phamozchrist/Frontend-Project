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
    <title>Prefix - Login</title>
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
<body class="login-container">
    <?php include_once '../includes/loader.php';?>
    <div id="particles-js"></div>
    <div id="login-modal">
        <div class="login-logo-container">
            <div class="login-logo"></div>
            <p>PreFix</p>
        </div>
        <div class="login-header">
            <h1 class="dv-title">Log in to PreFix</h1>
            <h1 class="mv-title">Log in</h1>
        </div>
        <?php if(!empty($msg)) { ?>
            <?=($msg);?>
        <?php } ?>
        <div class="login-modal-content">            
            <form id="form" method="post">
            <p class="rv-ca-container">Don't have an account?<a href="register.php" id="trigger">   Create account</a></p>
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
                    <p>Forgot password?</p>
                </div>
                <div>
                    <button type="submit" id="button" disabled>
                        <span id="btnText">Log in</span>
                        <span id="spinner" class="spinner hidden"></span>
                    </button>
                </div>
            </form>
        </div>
        <div class="login-footer">
            <p><a href="../admin/login.php">Log in as an Administrator</a></p>
            <p>Don't have an account?<a href="register.php" id="trigger">   Create account</a></p>
        </div>
        <div class="terms">
            <p>By logging in, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a> © 2025 Prefix. All rights reserved.</p>
        </div>
    </div>
    
    <script src="../javascript/login_auth.js"></script>
    <script src="../javascript/msg.js"></script>
</body>
</html>
<?php require "includes/register_script.php";?>
<!DOCTYPE html>
<html lang="en" loading="lazy">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/register.rv.css">
    <link rel="shortcut icon" href="../images/pc logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../fonts/css/all.min.css">
    <title>Prefix - Create an account</title>
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
    <?php include_once '../includes/loader.php';?>
    <div id="create-account-modal">
        <div class="create-account-container">
            <div>
                <p>Already have an account?  <a href="login.php" id="trigger1">Login</a></p>
                <h1>Create a PreFix account</h1>
                <p>Join us and start your journey with PreFix.</p>
            </div>
            <div class="create-account-img">
                <img src="../images/dark-mode-banner-img.png" alt="">
            </div>
        </div>
        
        <div class="create-account-modal-content">
            <div class="logo"></div>
            <p>Already have an account?  <a href="login.php" id="trigger1">Login</a></p>
            <form method="post" id="form">
                <h2>Sign up to PreFix</h2>
                <?php if(!empty($msg)) { ?>
                    <p class="msg-error"><?=$msg?></p>
                <?php } ?>
                <div>
                    <label for="email">Firstname*</label>
                    <input type="text" name="firstname" id="firstname"  value="<?= htmlspecialchars($firstname);?>" class="<?= empty($firstnameErr) ? '' : 'is-invalid';?>">
                    <p class="firstname-err"><?=$firstnameErr;?></p>
                </div>
                <div>
                    <label for="email">Lastname*</label>
                    <input type="text" name="lastname" id="lastname" value="<?= htmlspecialchars($lastname);?>" class="<?= empty($lastnameErr) ? '' : 'is-invalid';?>">  
                    <p class="lastname-err"><?=$lastnameErr;?></p>
                </div>
                <div>
                    <label for="email">Username*</label>
                    <input type="text" name="username" id="username" value="<?= htmlspecialchars($username);?>" class="<?= empty($usernameErr) ? '' : 'is-invalid';?>">  
                    <p class="username-err"><?=$usernameErr;?></p>
                    <p>Username may only contain alphanumeric characters or single hyphens, and cannot begin or end with a hyphen.</p>
                </div>
                <div>
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($email);?>" class="<?= empty($emailErr) ? '' : 'is-invalid';?>">   
                    <p class="email-err"><?=$emailErr;?></p>
                </div>
                <div>
                    <label for="password">Password*</label>
                    <input type="password" name="password" id="password" value="<?=$password;?>" class="<?=empty($passwordErr) ? '' : 'is-invalid';?>">  
                    <i class="fa-regular fa-eye show-password toggle-eye" data-target="password"></i>
                    <p class="password-err"><?=$passwordErr;?></p>
                    <p>Password should be at least 8 characters including a number and a lowercase letter.</p>
                </div>
                <div>
                    <label for="confirm_password">Confirm Password*</label>
                    <input type="password" name="confirm_password" value="<?=$confirmPassword;?>" id="confirm_password" class="<?=empty($confirmPasswordErr) ? '' : 'is-invalid';?>">
                    <i class="fa-regular fa-eye show-password toggle-eye" data-target="confirm_password"></i>
                    <p class="confirm_password-err"><?=$confirmPasswordErr;?></p>
                </div>
                <div class="login-details">
                    <div class="checkbox">
                        <label class="custom-checkbox">
                            <input type="checkbox" name="terms" id="terms">
                            <span class="checkmark"></span>
                            I agree to the Terms and Privacy Policy
                        </label>
                        <p class="terms-err"><?=$termsErr;?></p>
                    </div>
                </div>
                <div>
                    <button type="submit" id="button" disabled>
                        <span id="btnText">Continue ></span>
                        <span id="spinner" class="spinner hidden"></span>
                    </button>
                </div>
                <div class="create-account-footer">
                    <p>By creating an account, you agree to the <a href="">Terms of Service</a>. For more information about Prefix's privacy practices, see the <a href="">Prefix Privacy Statement</a>. We'll occasionally send you account-related emails.</p>
                </div>
            </form>           
        </div>
    </div>

    <script src="../javascript/auth.js"></script>
    <script src="../javascript/msg.js"></script>
</body>
</html>
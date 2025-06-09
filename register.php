<?php require "includes/register_script.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/pc logo.png" type="image/x-icon">
    <link rel="stylesheet" href="fonts/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <title>Prefix -Create an account</title>

</head>
<body>
    <?php include 'includes/loader.php';?>
    <div id="create-account-modal">
        <div class="create-account-container">
            <div>
                <h1>Create a PreFix account</h1>
                <p>Join us and start your journey with PreFix.</p>
            </div>
            <div class="create-account-img">
                <img src="images/dark-mode-banner-img.png" alt="">
            </div>
        </div>
        
        <div class="create-account-modal-content">
            <p>Already have an account?  <a href="login.php" id="trigger1">Login</a></p>
            <form method="post">
                <h2>Sign up to PreFix</h2>
                <?php if(!empty($msg)) { ?>
                    <p class="msg-error"><?=htmlspecialchars($msg);?></p>
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
                    <input type="text" name="email" id="email" value="<?= htmlspecialchars($email);?>" class="<?= empty($emailErr) ? '' : 'is-invalid';?>">   
                    <p class="email-err"><?=$emailErr;?></p>
                </div>
                <div>
                    <label for="password">Password*</label>
                    <input type="password" name="password" id="password" value="<?=$password;?>" class="<?=empty($passwordErr) ? '' : 'is-invalid';?>">  
                    <p class="password-err"><?=$passwordErr;?></p>
                    <p>Password should be at least 15 characters OR at least 8 characters including a number and a lowercase letter.</p>
                </div>
                <div>
                    <label for="confirm_password">Confirm Password*</label>
                    <input type="password" name="confirm_password" value="<?=$confirmPassword;?>" id="confirm_password" class="<?=empty($confirmPasswordErr) ? '' : 'is-invalid';?>">
                    <p class="confirm_password-err"><?=$confirmPasswordErr;?></p>
                </div>
                <div class="login-details">
                    <div class="checkbox">
                        <label class="custom-checkbox">
                            <input type="checkbox" name="terms" id="terms">
                            <span class="checkmark"></span>
                            I agree to the Terms and Privacy Policy
                        </label>
                        <p class="error"><?=$termsErr;?></p>
                    </div>
                </div>
                <div>
                    <button type="submit" id="button"><b>Continue ></b></button>
                </div>
                <div class="create-account-footer">
                    <p>By creating an account, you agree to the <a href="">Terms of Service</a>. For more information about Prefix's privacy practices, see the <a href="">Prefix Privacy Statement</a>. We'll occasionally send you account-related emails.</p>
                </div>
            </form>           
        </div>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="auth.js"></script>
</body>
</html>
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
</head>
<body>
    <div id="login-modal">
        <div class="login-logo"></div>
        <div class="login-header">
            <h1>Log in to prefix</h1>
        </div>
        <div class="login-modal-content">            
           
            <form id="form">
                <div class="form-box">
                    <input type="text" required>
                    <label for="email">Email or Username</label>
                </div>
                <div class="form-box">
                    <input type="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="login-details">
                    <div class="checkbox"> 
                        <label class="custom-checkbox">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            Keep me logged in
                        </label>
                    </div>
                    <p>forgot password?</p>
                </div>
                <div>
                    <button id="button">Log in</button>
                </div>
            </form>
            <p>Don't have an account?<a href="#" id="trigger">   Create account</a></p>
            <p>log in as an <a href="#">Administrator</a></p>
            <div class="social-media">
                <p>or continue with</p>
                <div class="social-icons">
                    <i class="fa-brands fa-google" style="background: linear-gradient(90deg, #004cc5, #cc1100, #eeae00, #00e476); background-clip: text; color: transparent;"></i>
                    <i class="fa-brands fa-facebook" style="color: #3b5998;"></i>
                    <i class="fa-brands fa-twitter" style="color: #1DA1F2;"></i>
                    <i class="fa-brands fa-github" style="color: #000000;"></i>
                </div>
            </div>
        </div>
        <div class="terms">
            
            <p>By logging in, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
        </div>
        <div class="modal-footer">
            <p>© 2025 Prefix. All rights reserved.</p>
        </div>
    </div>
    <div id="create-account-modal">
        <div class="create-account-modal-content">
            <div class="modal-header">
                <h1>Create Account</h1>
                <span class="close">&times;</span>
            </div>
            <form id="form-1">
                <div class="name">
                    <div>
                        <label for="firstname">First name</label>
                        <!-- <input type="text" placeholder="Enter your first Name" onkeydown="handlekeydown(event)"> -->
                    </div>
                    <div>
                        <label for="lastname">Last name</label>
                        <!-- <input type="text" placeholder="Enter your last Name" onkeydown="handlekeydown(event)"> -->
                    </div>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" placeholder="Enter your Email" onkeydown="handlekeydown(event)">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" placeholder="Create your Password" onkeydown="handlekeydown(event)">
                </div>
                <div class="checkbox">
                    <input type="checkbox"> 
                    <label for="checkbox">I agree to the Terms and Privacy Policy</label>
                </div>
                <div>
                    <button id="button-1"><b>Create Account</b></button>
                </div>
            </form>
            <div class="social-media">
                <p>OR</p>
                <div class="social-icons">
                    <i class="fa-brands fa-google" style="background: linear-gradient(45deg, #4285F4, #DB4437, #F4B400, #0F9D58); background-clip: text; color: transparent;"></i>
                    Sign Up with Google
                </div>
            </div>
            <p>Already have an account?<a href="#" id="trigger1"> Login</a></p>
        </div>
    </div>


    <!-- <script src="script.js"></script> -->
</body>
</html>
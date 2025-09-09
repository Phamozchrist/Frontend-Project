<aside class="settings-sidebar">
    <h4>Settings Center</h4>
    <a href="profile.php" class="settings-profile">
        <div>
            <img src="../admin/uploads/<?=$user['profile_pics']?>" alt="">
        </div>
        <div>
            <p><?=$user['firstname'];?> <?=$user['lastname'];?></p>
            <p><?=$user['email'];?></p>
        </div>

    </a>
    <ul class="sidebar-nav-container">
        <li class="nested-nav nsn-1 close-nested-nav">General Settings <i class="fa-solid fa-angle-down"></i>
            <ul class="nested-sidebar-nav">
                <li class="themesBtn"><a href="theme.php"><i class="fa-solid fa-circle-half-stroke"></i>Themes</a></li>
            </ul>
        </li>
        <li class="nested-nav nsn-2 close-nested-nav">Account Management <i class="fa-solid fa-angle-down"></i>
            <ul class="nested-sidebar-nav">
                <li class="profileBtn"><a href="edit_profile.php"><i class="fa-solid fa-user"></i>Edit Profile</a></li>
            </ul>
        </li>
        <li class="nested-nav nsn-3 close-nested-nav">Privacy & Security <i class="fa-solid fa-angle-down"></i>
            <ul class="nested-sidebar-nav">
                <li class="authBtn"><a href="two-factor-authentication.php"><i class="fa-solid fa-fingerprint"></i>Two-Factor Authentication</a></li>
                <li class="passBtn"><a href="password_management.php"><i class="fa-solid fa-key"></i>Password Management</a></li>
            </ul>
        </li>
    </ul>
    <div class="profile-links-footer  plf-logout">
        <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="../user/logout.php">Logout</a></li>
    </div>
</aside>
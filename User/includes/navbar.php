<header class="top-header">
    <div class="logo"></div>
    <form action="search.php" method="get" id="searchForm">
        <?php 
            if ($_SERVER['PHP_SELF'] == '/user/search.php'):
        ?>
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" placeholder="Search for items here" name="search" onclick="handleSearchkeydown()" value="<?=$search?>" id="searchInput" autocomplete="off">
        <?php else:?>
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" placeholder="Search for items here" name="search" onclick="handleSearchkeydown()" value="" id="searchInput" autocomplete="off">
        <?php endif;?>
    </form>
    <div class="cart-container">
        <div class="cart navbar-cart-icon">
            <a href="cart.php"><i class="fa-solid fa-shopping-cart"></i></a>
            <span class=".cart-count-badge"></span>
        </div>
        <div class="user-dp">
            <img src="../admin/uploads/<?= $user['profile_pics'];?>" alt="Dp">
            <i class="fa-solid fa-angle-down"></i>
        </div>
    </div>

</header>
<div class="profile-dropdown">
    <div class="profile-header">
        <div class="profile-info-details">
            <img src="../admin/uploads/<?=$user['profile_pics'];?>"  alt="Profile Picture" class="profile-pic">
            <div class="bio-name"><?=$user['firstname'];?> <?=$user['lastname'];?></div>
        </div>
        <button class="profile-btn"><a href="profile.php">View Profile</a></button>
    </div>
    <div class="profile-links">
        <h3>Account</h3>
        <ul>
            <li><i class="fas fa-gear"></i><a href="settings.php">Settings & Privacy</a></li>
        </ul>
    </div>
    <div class="profile-links-footer">
        <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="../user/logout.php">Logout</a></li>
    </div>
</div>

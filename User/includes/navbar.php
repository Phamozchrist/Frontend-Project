<?php
if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['search'])){
    $lastSearch = $_GET['search'];
    $user_id = $_SESSION['user'];
    
    $sql = $connect->prepare('INSERT INTO lastSearch (word,user_id) VALUES (?,?)');
    $sql->bind_param("si", $lastSearch,$user_id);
    $sql->execute();

}
?>
<header class="top-header">
    <div class="logo"></div>
    <form action="search.php" method="get" id="searchForm">
        <?php 
            if ($_SERVER['PHP_SELF'] == '/user/search.php'):
        ?>
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" placeholder="Search for items here" name="search" value="<?=$search?>" id="searchInput" autocomplete="off">
        <?php else:?>
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" placeholder="Search for items here" name="search" value=" " id="searchInput" autocomplete="off">
        <?php endif;?>
    </form>
    <div class="cart-container">
        <div class="cart navbar-cart-icon">
            <a href="cart.php"><i class="fa-solid fa-shopping-cart"></i></a>
            <span class="cart-count-badge"></span>
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
            <div class="bio-name">
                <span><?=$user['firstname'];?> <?=$user['lastname'];?></span>
            </div>
        </div>
        <a href="profile.php"  class="profile-btn">View Profile</a>
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

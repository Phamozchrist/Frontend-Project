<header class="rv-top-header">
    <div class="logo"></div>
    <form action="search.php" method="get" id="searchForm">
        <?php 
            if ($_SERVER['PHP_SELF'] == '/user/search.php'):
        ?>
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" placeholder="Search for items here" name="search" value="<?=$search?>" id="searchInput" autocomplete="off">
        <?php else:?>
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" placeholder="Search for items here" name="search" value="" id="searchInput" autocomplete="off">
        <?php endif;?>
    </form>
    <div class="cart-container">
        <div class="cart navbar-cart-icon">
            <a href="cart.php"><i class="fa-solid fa-shopping-cart"></i></a>
            <span class=".cart-count-badge"></span>
        </div>
        <div class="user-dp">
            <a href="profile.php"><img src="../admin/uploads/<?= $user['profile_pics'];?>" alt="Dp"></a>
        </div>
    </div>

</header>

<nav>
    <ul class="menu content">
        <li class="menu-item"><a href="<?= url('#home_page') ?>">خانه</a></li>
        <li class="menu-item"><a href="<?= url('#nature') ?>">جاذبه های طبیعی</a></li>
        <li class="menu-item"><a href="<?= url('#culture') ?>">جاذبه های فرهنگی</a></li>
        <li class="menu-item"><a href="<?= url('#tourleader_title') ?>">راهنماها</a></li>
        <li class="menu-item"><a onclick="darkMode()"><img class="icon" src="<?= url('assets/img/icon/moon-over-sun.svg') ?>"></a></li>
        <?php if (session()->has('user_id')) { ?>
            <li class="menu-item"><a href="<?= url('profile') ?>"><img class="icon" src="<?= url('assets/img/icon/user.svg') ?>"></a></li>
            <li class="menu-item"><a href="<?= url('logout') ?>"><img class="icon" src="<?= url('assets/img/icon/door-open.svg') ?>"></a></li>
        <?php } else { ?>
            <li class="menu-item"><a href="<?= url('login') ?>"><img class="icon" src="<?= url('assets/img/icon/user.svg') ?>"></a></li>
        <?php } ?>
    </ul>
</nav>
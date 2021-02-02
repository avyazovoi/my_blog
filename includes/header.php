<?php

$categories_q = mysqli_query($db, "SELECT * FROM `articles_categories`");
$categories = array();
while ($cat = mysqli_fetch_assoc($categories_q)) {
    $categories[] = $cat;
}
// $users_q = mysqli_query($db, "SELECT * FROM `users`");
// $user = [];
// while($users = mysqli_fetch_assoc($users_q)){
// 	$user[] = $user;
// }
?>
<header class="header">
    <div class="container">
        <div class="header__row">
            <div class="header__title title">
                <h1><?= $config['title']; ?></h1>
            </div>
            <ul class="header__menu">
                <li><a href="/" class="header__menu_link">Главная</a></li>
                <li><a href="/?about_site" class="header__menu_link">Разработчикам</a></li>
                <li><a href="<?php echo $config['fb']; ?>" target="_blank" class="header__menu_link">Мой FB</a></li>
                <li><?php account($db); ?></li>
            </ul>
        </div>
    </div>
    <nav class="menu">
        <div class="container">
            <ul class="menu__list">
                <?php
                foreach ($categories as $cat) {
                    ?>
                    <li><a href="/?id_cat=<?= $cat['id'] ?>" class="menu__link"><?php echo $cat['title']; ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</header>

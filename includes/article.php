<?php
function content($db, $categories)
{
    $articles = mysqli_query($db, "SELECT * FROM `articles` WHERE `id` =" . $_GET['id_art']);
    $art = mysqli_fetch_assoc($articles);
    ?>
    <div class="article">
        <div class="article__top">
            <div class="article__title">
                <?= $art['title'] ?>
            </div>
            <div class="article__views">
                <?php get_views($db, $art['views']); ?>
            </div>
        </div>
        <div class="article__img">
            <img src="image/articles/<?= $art['image'] ?>" alt="">
        </div>
        <div class="article__text">
            <p><?= $art['text'] ?></p>
        </div>
    </div>
    <?php
    include "comments.php";
    include "add_comments.php";
}

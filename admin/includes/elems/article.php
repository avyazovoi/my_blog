<?php
if (isset($_GET['edit_article'])) {
    $articles = mysqli_query($db, "SELECT * FROM `articles` WHERE `id` =" . $_GET['edit_article']);
    $art = mysqli_fetch_assoc($articles);
    ?>
    <div class="article">
        <div class="article__top">
            <div class="article__title">
                <?php
                echo $message;
                echo $art['title'];
                ?>
                <div class="article__title_edit">
                    <?php include "form_edit_title.php"; ?>
                </div>
            </div>
        </div>
        <div class="article__img">
            <img src="../image/articles/<?= $art['image'] ?>" alt="">
            <div class="article__img_edit">
                <?php include "form_edit_img.php"; ?>
            </div>
        </div>
        <div class="article__text">
            <p><?= $art['text'] ?></p>
        </div>
        <div class="article__text_edit">
            <?php include "form_edit_text.php" ?>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="article">
        <?= $message ?>
        <div class="article__add">
            <?php include "form_add_article.php" ?>
        </div>
    </div>
    <?php
}
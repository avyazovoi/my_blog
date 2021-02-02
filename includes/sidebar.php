<?php
if (isset($_SESSION['auth'])) {
    ?>
    <div class="sidebar">
        <div class="sidebar__top">
            <div class="sidebar__item">
                <p>Вы вошли как:</p>
            </div>
            <div class="sidebar__item">
                <div class="user__data">
                    <?php account($db); ?>
                </div>
            </div>
            <div class="dash__gorizont"></div>
            <div class="sidebar__item">
                <p class="user__name"><a href="../admin/?add_article">Добавить новую статью</a></p>
            </div>
            <div class="dash__gorizont"></div>
            <div class="sidebar__item">
                <p class="user__name"><a href="../admin/">Все мои статьи</a></p>
            </div>
            <div class="dash__gorizont"></div>
            <div class="sidebar__item">
                <p class="user__name"><a href="../admin/?my_comments">Все мои комментарии</a></p>
            </div>
            <div class="dash__gorizont"></div>
            <div class="sidebar__item">
                <p class="user__name"><a href="../admin/?edit_account">Редактировать аккаунт</a></p>
            </div>
        </div>
    </div>
    <?php
}
?>
    <div class="sidebar">
        <div class="sidebar__top">
            <div class="sidebar__title">
                Топ_читаемых
            </div>
        </div>
        <?php get_articles($categorie_id = '', 'views', $offset = 0, 3, $categories, $db); ?>
    </div>
<?php
include "comments.php";


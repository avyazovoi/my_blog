<div class="item__row">
    <div class="item__image">
        <img src="<?= $img_src ?>" alt="" class="img">
    </div>
    <div class="item__body">
        <div class="item__title">
            <a href="/?id_art=<?= $id_art ?>"><?= $title_art ?></a>
        </div>
        <div class="item__categorie">
            Категория: <a href="/?id_cat=<?= $id_cat ?>"><?= $title_cat ?></a>
        </div>
        <div class="item__text">
            <p><?= $text_substr ?></p>
        </div>
    </div>
    <div class="item__admin">
        <div class="item__edit edit"><a href="?edit_article=<?= $id_art ?>">Edit</a></div>
        <div class="item__delete edit"><a href="?delete_article=<?= $id_art ?>">Delete</a></div>
    </div>
</div>
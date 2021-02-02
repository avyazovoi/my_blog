<form action="" method="POST" enctype="multipart/form-data">
    <div class="form__row">
        <div class="form__title">
            <p>Categorie:</p>
        </div>
        <div class="form__item">
            <select class="form__control" name="categorie" required>
                <option value="all_categories">Выбор категории</option>
                <?php
                foreach ($categories as $cat) {
                    ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form__row">
        <div class="form__title">
            <p>Title:</p>
        </div>
        <div class="form__item">
            <input class="form__control" type="text" name="title" placeholder="Input a new title">
        </div>
    </div>
    <div class="form__row">
        <div class="form__title">
            <p>Image:</p>
        </div>
        <div class="form__item">
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000">
            <input type="file" name="file">
        </div>
    </div>
    <div class="form__row">
        <div class="form__title">
            <p>Text:</p>
        </div>
        <div class="form__item">
            <textarea class="form__textarea form__control" name="text" rows="10"
                      placeholder="Input a new text"></textarea>
        </div>
    </div>
    <div class="form__button">
        <div class="form__item_button">
            <input class="button" type="submit" name="add_article" value="Создать">
        </div>
    </div>
</form>
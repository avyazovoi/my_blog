<div class="article">
    <?= $message ?>
    <div class="article__top">
        <div class="article__title">
            Добавить комментарий
        </div>
    </div>
    <form method="POST" class="form">
        <div class="form__body_row">
            <div class="form__item">
                <input type="text" name="username" value="<?= $_POST['username'] ?>" placeholder="Ваше имя"
                       class="form__control" value="">
                <input type="email" name="email" value="<?= $_POST['email'] ?>" placeholder="Ваш email"
                       class="form__control" value="">
            </div>
            <div class="form__item">
                <textarea name="text" name="text" cols="30" rows="3" value="<?= $_POST['text'] ?>"
                          placeholder="Ваш комментарий" class="form__control form__textarea"></textarea>
            </div>
        </div>
        <div class="form__item_button">
            <input type="submit" name="comment" class="button" value="Отправить">
        </div>
    </form>
</div>
<div class="articles">
    <div class="articles__top">
        <div class="articles__title">
            Зарегистрироваться
        </div>
    </div>
    <?php echo $message; ?>
    <form method="POST" class="form">
        <div class="form__body_row">
            <div class="form__item">
                <input type="email" name="email" value="<?= $_POST['email'] ?>" placeholder="Ваше email"
                       class="form__control" value="">
            </div>
            <div class="form__item">
                <input type="text" name="login" value="<?= $_POST['login'] ?>" placeholder="Ваше login"
                       class="form__control" value="">
            </div>
            <div class="form__item">
                <input type="password" name="password" placeholder="Ваш пароль" class="form__control" value="">
            </div>
            <div class="form__item">
                <input type="password" name="password_compare" placeholder="Повторите Ваш пароль" class="form__control"
                       value="">
            </div>
            <div class="form__button">
                <input type="submit" name="registration" class="button" value="Зарегистрироваться">
            </div>
        </div>
    </form>
</div>

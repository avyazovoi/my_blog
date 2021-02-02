<div class="articles">
    <div class="articles__top">
        <div class="articles__title">
            Восстановление пароля
        </div>
    </div>
    <?= $message ?>
    <form method="POST" class="form">
        <div class="form__top">
            <div class="form__item">
                <input type="email" name="email" value="<?= $_POST['email'] ?>" placeholder="Ваше email"
                       class="form__control" value="">
            </div>
            <div class="form__button">
                <input type="submit" name="restore" class="button" value="Восстановить">
            </div>
        </div>
        <div class="article__body">
            <a class="link" href="../admin/?login">Войти в аккаунт</a>
        </div>
        <div class="article__body">
            <a class="link" href="../admin/?registration">Зарегистрироваться</a>
        </div>
    </form>
</div>
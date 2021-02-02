<?php
function content($db, $categories)
{
    include "../includes/message.php";
    ?>
    <div class="column__left">
        <div class="form__add-comments" id="form__add-comments">
            <div class="form__title">
                Зарегистрироваться
            </div>
            <?php echo $message; ?>
            <form method="POST" class="form">
                <div class="form__top">
                    <div class="form__item">
                        <input type="email" name="email" value="<?= $_POST['email'] ?>" placeholder="Ваше email"
                               class="form__control" value="">
                    </div>
                    <div class="form__item">
                        <input type="text" name="login" value="<?= $_POST['login'] ?>" placeholder="Ваше login"
                               class="form__control" value="">
                    </div>
                    <div class="form__item">
                        <input type="password" name="password" value="<?= $_POST['password'] ?>"
                               placeholder="Ваш пароль" class="form__control" value="">
                    </div>
                    <div class="form__botton">
                        <input type="submit" name="sign_on" class="button" value="Registration">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
}
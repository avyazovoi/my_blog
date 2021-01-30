<div class="articles">
	<div class="articles__top">
		<div class="articles__title">
			Войти в аккаунт
		</div>
	</div>
	<?php echo $message; ?>
	<form  method="POST" class="form">
		<div class="form__top">
			<div class="form__item">
				<input type="email" name="email" value="<?= $_POST['email'] ?>" placeholder="Ваше email" class="form__control" value="">
			</div>
			<div class="form__item">
				<input type="password" name="password" value="<?= $_POST['password'] ?>" placeholder="Ваш пароль" class="form__control" value="">
			</div>
			<div class="form__button">
				<input type="submit" name="sign_in" class="button" value="Войти">
			</div>
		</div>
		<div class="article__body">
			<a class="link" href="../admin/?restore">Восстановить пароль</a>
		</div>
		<div class="article__body">
			<a class="link" href="../admin/?registration">Зарегистрироваться</a>
		</div>
	</form>
</div>

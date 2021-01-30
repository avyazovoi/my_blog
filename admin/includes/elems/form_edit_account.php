<div class="article">
	<div class="article__top">
		<div class="article__title">
			<div class="user__row">
				<div class="user__avatar">
					<img class="img" src="<?= avatar($db, $_SESSION['user']['email']) ?>">
				</div>
				<div class="user__body">
					<div class="user__item">
						<div class="user__name">
							<p>Login: </p>
						</div>
						<div class="user__data">
							 <?= $_SESSION['user']['name'] ?>
						</div>
					</div>
					<div class="user__item">
						<div class="user__name">
							<p>Email: </p>
						</div>
						<div class="user__data">
							<?= $_SESSION['user']['email'] ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="article">
	<?= $message ?>
	<div class="article__top">
		<div class="article__title">
			<p>Редактировать мои данные:</p>
		</div>
	</div>
	<div class="article__body">

		<form action="../admin/?edit_account" method="POST">
			<div class="form__row">
				<div class="form__title">
						Ваш login:
				</div>
				<div class="form__item">
						<input type="text" name="login" value="" class="form__control" placeholder="Редактировать login">
				</div>
				<div class="form__button">
						<input class="button" type="submit" name="edit_login" value="Редактировать">
				</div>
			</div>
		</form>

		<div class="dash__gorizont"></div>

		<form action="../admin/?edit_account" method="POST">
			<div class="form__row">
				<div class="form__title">
						Ваш email:
				</div>
				<div class="form__item">
						<input type="email" name="email" value="" class="form__control" placeholder="Редактировать email">
				</div>
				<div class="form__button">
						<input class="button" type="submit" name="edit_email" value="Редактировать">
				</div>
			</div>
		</form>

		<div class="dash__gorizont"></div>
<?php avatar($db, 'avyazovoi@gmail.com'); ?>
		<form action="../admin/?edit_account" method="POST" enctype="multipart/form-data">
			<div class="form__row">
				<div class="form__title">
						Ваш avatar:
				</div>
				<div class="form__item">
						<input class="form__file" type="hidden" name="MAX_FILE_SIZE" value="3000000">
						<input type="file" name="avatar">
				</div>
				<div class="form__button">
						<input class="button" type="submit" name="edit_avatar" value="Редактировать">
				</div>
			</div>
		</form>

		<div class="dash__gorizont"></div>

		<form action="../admin/?edit_account" method="POST">
			<div class="form__row">
				<div class="form__title">
						Ваш password:
				</div>
					<div class="form__item">
						<div class="form__item">
							<input type="password"  name="password" value="" class="form__control" placeholder="Введите старый пароль password">
						</div>
						<div class="form__item">
							<input type="password" name="new_password" value="" class="form__control" placeholder="Введите новый пароль">
						</div>
						<div class="form__item">
							<input type="password" name="new_password_compare" value="" class="form__control" placeholder="Повторите новый пароль">
						</div>
					</div>
				<div class="form__button">
					<input class="button" type="submit" name="edit_password" value="Редактировать">
				</div>
			</div>
		</form>

	</div>
</div>
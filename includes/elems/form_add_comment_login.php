<div class="article">
	<?= $message ?>
	<div class="article__top">
		<div class="article__title user__name">
			Ваш комментарий: <a href="/admin/"><?= $_SESSION['user']['name'] ?></a>
		</div>
	</div>
	<form method="POST" class="form">
		<div class="form__row">
			<div class="form__title">
				<div class="user__row">
					<div class="user__avatar">
						<img class="img" src="<?= avatar($db, $_SESSION['user']['email']) ?>" alt="">
					</div>
				</div>
			</div>
			<div class="form__item">
				<textarea name="text" name="text" cols="30" rows="3" value="<?= $_POST['text'] ?>" placeholder="Ваш комментарий" class="form__control form__textarea"></textarea>
			</div>
		</div>
		<div class="form__button">
			<input type="submit" name="comment" class="button" value="Отправить">
		</div>
	</form>
</div>
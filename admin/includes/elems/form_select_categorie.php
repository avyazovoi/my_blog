<form id="select" method="POST">
	<div class="form__row">
	<select class="form__control" form="select" name="categorie" required>
			<option value="all_categories">Все категории</option>
			<?php 
				foreach ($categories as $cat) {
			?>
			<option value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
			<?php
				}
			?>
	</select>
			<input type="submit" form="select" name="select" class="button" value="Выбрать категорию">
			</div>
</form>
</div>

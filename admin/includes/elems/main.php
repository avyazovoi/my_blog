<?php
$query = mysqli_query($db, "SELECT * FROM `articles` WHERE `user_id` =" . $_SESSION['user']['id']);
if(mysqli_num_rows($query) == 0){
	?>
<div class="article">
	<div class="article__text">
		<a class="edit" href="/admin/?add_article">Добавить новую статью</a>
		<br>
		<h4>У вас пока нет ни одной статьи:(</h4>
	</div>
</div>
<?php
}else{
	?>
<div class="articles">
		<?= $message; ?>
	<div class="articles__top">

		<div class="articles__title">
			<?php $categorie_id = get_title_categorie($categories); ?>
		</div>
		<div class="articles__all">
			<?php include "form_select_categorie.php"; ?>
		</div>
		<div>
			<a class="edit" href="/admin/?add_article">Добавить новую статью</a>
		</div>
	<?php
		$limit = 6;
		include "../includes/pagination.php";
	?>
	<div class="articles__body">
		<div class="body__row">
		<?php
			admin_get_articles($categorie_id, 'id', $offset, $limit, $db, $categories);
		?>
		</div>
	</div>
	<?php
			include "../includes/pagination.php";
	?>
</div>
<?php 
}
?>

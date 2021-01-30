<?php
function content($db, $categories){
?>
<div class="articles">
	<div class="articles__top">
		<div class="articles__title">
			Новейшее_в_блоге
		</div>
		<div class="articles__all">
			<a href="#" class="articles__link">Все записи</a>
		</div>
	</div>
	<?php
		$limit = 4;
		$categorie_id = $_GET['id_cat'];
		include "pagination.php";
	?>
	<div class="articles__body">
		<div class="body__row">
			<?php
				get_articles($categorie_id, 'id', $offset, $limit, $categories, $db);
			?>
		</div>
	</div>
	<?php include "pagination.php"; ?>
</div>
<?php
}
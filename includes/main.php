<?php
	function content($db, $categories)
	{
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
			$limit = 6; //.<--------------------- limit of displayed articles-------------------------<
			$categorie_id = '';
			include "pagination.php";
			?>
			<div class="articles__body">
				<div class="body__row">
					<?php get_articles($categorie_id, 'id', $offset, $limit, $categories, $db); ?>
				</div>
			</div>
				<?php include "pagination.php"; ?>
		</div>
		<div class="articles">
			<div class="articles__top">
				<div class="articles__title">
					Программирование [Новейшее]
				</div>
				<div class="articles__all">
					<a href="#" class="articles__link">Все записи</a>
				</div>
			</div>
			<div class="articles__body">
				<div class="body__row">
					<?php get_articles(1, 'id', $offset = 0, 4, $categories, $db) ?>
				</div>
			</div>
		</div>
		<div class="articles">
			<div class="articles__top">
				<div class="articles__title">
					Спорт [Новейшее]
				</div>
				<div class="articles__all">
					<a href="#" class="articles__link">Все записи</a>
				</div>
			</div>
			<div class="articles__body">
				<div class="body__row">
					<?php get_articles(2, 'id', $offset = 0, 6, $categories, $db); ?>
				</div>
			</div>
		</div>
<?php
	}
?>
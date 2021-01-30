<div class="sidebar">
	<div class="sidebar__top">
		<div class="sidebar__title">
			<?php
				if(empty($art['id'])){
					$comments = mysqli_query($db, "SELECT * FROM `comments` ORDER BY `id` DESC LIMIT 3");
					echo 'Последние комментарии блога';
				}else{
					$comments = mysqli_query($db, "SELECT * FROM `comments` WHERE `article_id` = ".$art['id']." ORDER BY `pubdate` DESC LIMIT 3");
					echo 'Комментарии';
				}
				while( $com = mysqli_fetch_assoc($comments) ){
			?>
				<div class="item__row item__border">
					<div class="item__image">
						<img src="<?= avatar($db, $com['email']) ?>" alt="">
					</div>
					<div class="item__body">
						<div class="item__title">
							<?= $com['author'] ?>
						</div>
						<div class="item__categorie">
							Добавлено: <?php $date = date('d.m.Y', strtotime($com['pubdate'])); echo $date; ?>
						</div>
						<div class="item__text">
							<p><?= $com['text'] ?></p>
						</div>
					</div> 
				</div>
				<div class="dash__gorizont"></div>
			<?php
				}
			?>
		</div>
	</div>
</div>

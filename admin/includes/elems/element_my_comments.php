<?php
$query = mysqli_query($db, "SELECT * FROM `comments` WHERE `email` = '".$_SESSION['user']['email']."'");
if(mysqli_num_rows($query) == 0){
	?>
<div class="article">
	<div class="article__text">
		<h4>У вас пока нет ни одного комментария</h4>
	</div>
</div>
<?php
}else{
	?>
<div class="sidebar">
	<?= $message ?>
	<div class="sidebar__top">
		<div class="sidebar__title">
			<?php
				$comments_query = mysqli_query($db, "SELECT `comments`.`id` as `comments_id`, `comments`.`email`, `comments`.`pubdate`, `comments`.`text`, `articles`.`title`, `articles`.`id` FROM `comments` LEFT JOIN `users` ON `users`.`email` = `comments`.`email` LEFT JOIN `articles` ON `articles`.`id` = `comments`.`article_id` WHERE `users`.`id` = '".$_SESSION['user']['id']."'");
					while($comments = mysqli_fetch_assoc($comments_query)){
				?>
					<div class="item__row ">
						<div class="item__image">
							<img src="<?php echo avatar($db, $comments['email']); ?>" alt="">
						</div>
						<div class="item__body">
							<div class="item__title">
								<p>Комментарий к статье: 
								<a href="../?id_art=<?= $comments['id'] ?>"><?php echo $comments['title']; ?></a>
								</p>
							</div>
							<div class="item__categorie">
								Добавлено: <?php $date = date('d.m.Y', strtotime($comments['pubdate'])); echo $date; ?>
							</div>
							<div class="item__text">
								<p><?= $comments['text'] ?></p>
							</div>
						</div> 
						<div class="item__admin">
							<div class="item__delete edit"><a href="/admin/?delete_comment=<?= $comments['comments_id'] ?>">Delete</a></div>
						</div>
					</div>
					<div class="dash__gorizont"></div>
				<?php
					}
				?>
		</div>
	</div>
</div>
<?php
}
?>

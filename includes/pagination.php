<?php 
	pagination($db, $limit, $categorie_id);
	$offset = pagination($db, $limit, $categorie_id)['offset'];
	$limit = pagination($db, $limit, $categorie_id)['limit'];
	$page = pagination($db, $limit, $categorie_id)['page'];
	$total_pages = pagination($db, $limit, $categorie_id)['total_pages'];
	$categorie_id = pagination($db, $limit, $categorie_id)['categorie_id'];
?>
<div class="paginator">
	<div class="paginator__row">
		<div class="paginator__back">
			<?php
				if($page > 1){
			?>
					<form action="" method="POST">
						<input type="hidden" name="val_back" value="<?= ($page - 1) ?>">
						<input class="button" type="submit" name="back" value="<<< back">
					</form>
			<?php
				}else{
			?>
					<input class="button__disabled" type="submit" value="<<< back">
			<?php
				}
			?>
		</div>
		<div class="paginator__beetwen">
			<p>pages: <?= $page ?></p>
		</div>
		<div class="paginator__forward">
			<?php
				if($page < $total_pages){
			?>
					<form action="" method="POST">
						<input type="hidden" name="val_forward" value="<?= ($page + 1) ?>">
						<input class="button" type="submit" name="forward" value="next >>>">
					</form>
			<?php
				}else{
			?>
					<input class="button__disabled" type="submit" value="next >>>">
			<?php
				}
			?>
		</div>
	</div>
</div>
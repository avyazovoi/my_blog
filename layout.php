<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css" />
	<title><?= $config['title']; ?></title>
</head>
<body>
	<div class="wrapper">
		<?php include "includes/header.php"; ?>
		<div class="content">
			<div class="container">
				<div class="content__row">
					<div class="column__left">
						<?php content($db, $categories); ?>
					</div>
					<div class="column__right">
						<?php include "includes/sidebar.php"; ?>
					</div>
				</div>
			</div>
		</div>
		<?php include "includes/footer.php"; ?>
	</div>
</body>
</html>
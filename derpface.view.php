<!DOCTYPE html>
<html>
	<head>
		<title>DerpFace</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/flat-ui.css">
		<?= $this->header; ?>
	</head>
	<body>
		<div class="container">
			<h1>Derpface</h1>
			<div class="row">
				<?php foreach ($this->plugins as $plugin) { ?>
					<div class="plugin plugin-<?= $plugin["name"]; ?>">
						<div class="span4">
							<div class="tile">
								<img class="tile-image big-illustration" alt="" src="images/logos/<?= $plugin["name"]; ?>.png">
								<h2 class="tile-title"><?= $plugin["name"]; ?></h3>
								<div><?= $plugin["content"]; ?></div>
								<a class="btn btn-primary btn-large btn-block" href="http://cosm.com/feeds/<?= $plugin["cosm_feed"]; ?>">View statistics</a>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</body>
</html>

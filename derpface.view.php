<!DOCTYPE html>
<html>
	<head>
		<title>DerpFace</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/flat-ui.css">
		<meta charset='utf-8'> 
		<?= $this->header; ?>
	</head>
	<body>
		<div class="container">
			<h1>Derpface</h1>
			<div class="row">
				<?php foreach ($this->plugins as $plugin) { ?>
					<div class="plugin plugin-<?= $plugin["name"]; ?>">
						<div class="span4">
							<div class="tile" style="min-height: 320px;">
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

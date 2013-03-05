<html>
	<head>
		<title>DerpFace</title>
		<?= $this->header; ?>
	</head>
	<body>
		<h1>Derpface</h1>
		<?php foreach ($this->plugins as $plugin) { ?>
			<div class="plugin plugin-<?= $plugin["name"]; ?>">
				<h2><?= $plugin["name"]; ?></h2>
				<a href="http://cosm.com/feeds/<?= $plugin["cosm_feed"]; ?>">Cosm feed</a>
				<div><?= $plugin["content"]; ?></div>
			</div>
		<?php } ?>
	</body>
</html>

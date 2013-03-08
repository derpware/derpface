<div id="map" style="height:180px; width:270px;"></div>

<p>Last location: <?= $this->venue; ?><br>(<i><?= $this->timestamp; ?>)</i></p>

<script>
	// create a map in the "map" div, set the view to a given place and zoom
	var map = L.map('map').setView([<?= $this->latitude; ?>, <?= $this->longitude; ?>], 13);

	// add an OpenStreetMap tile layer
	L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	// add a marker in the given location, attach some popup content to it and open the popup
	L.marker([<?= $this->latitude; ?>, <?= $this->longitude; ?>]).addTo(map)
		.bindPopup('<?= $this->venue; ?>')
		.openPopup();
</script>

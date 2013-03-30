<html>
<head>
	<title>trakt</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/flat-ui.css">
</head>
<body>
<?php

$m = new MongoClient();
$d = $m->derptracker;
$col = $d->trakt->raw;

$keys = array("watched" => 1);
$initial = array("items" => array());
$reduce = "function (obj, prev) {}";

$g = $col->group($keys, $initial, $reduce);
$episodes = $g['retval'];

$episodes = array_reverse($episodes);
?>
<table class="table table-striped">
<?
foreach ($episodes as $episode) {
	if($lastShow != $episode["watched"]["show"]["title"]){
		echo "<tr>";
		echo '<td colspan="2" style="font-weight: bold;">'.$episode["watched"]["show"]["title"].'</td>';
		echo "</tr>";
	}
	echo "<tr>";
	echo "<td>S".$episode["watched"]["episode"]["season"]."E".$episode["watched"]["episode"]["number"]."</td>";
	echo '<td><a href="'.$episode["watched"]["episode"]["url"].'">'.$episode["watched"]["episode"]["title"]."</a></td>";
	echo "</tr>";
	$lastShow = $episode["watched"]["show"]["title"];
}
?>
</table>

</body>
</html>
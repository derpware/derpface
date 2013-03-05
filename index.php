<?php
define("BASE_PATH", dirname(__FILE__));

require_once BASE_PATH.'/config.php';
require_once BASE_PATH.'/Plugin.class.php';
require_once BASE_PATH.'/Template.class.php';

include(BASE_PATH.'/plugins/foursquare.php');

$header = "";

function addToHeader($html) {
	global $header;
	$header .= $html;
}

$plugins = array_filter(get_declared_classes(), function($className) {
	return in_array('Plugin', class_parents($className));
});

$plugin_data = array();
foreach ($plugins as $plugin_class) {
	$plugin = new $plugin_class();
	if ($plugin->isActive()) {
		$plugin_data[] = array(
			"name" =>$plugin->getName(),
			"content" => $plugin->renderToString(),
			"cosm_feed" => $cosm["feeds"][$plugin->getName()]
		);
	}
}

$template = new Template("derpface.view.php", array(
		"header" => $header,
		"plugins" => $plugin_data
	));
$template->render();

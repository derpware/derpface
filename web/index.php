<?php
define("BASE_PATH", dirname(__FILE__));

// SILEX
require_once __DIR__.'/../vendor/autoload.php';
$app = new Silex\Application();

// Configuration
require_once BASE_PATH.'/ConfigProvider.interface.php';
require_once BASE_PATH.'/PHPFileConfig.class.php';
ConfigProvider::create("PHPFileConfig");

// Basic requirements
require_once BASE_PATH.'/Plugin.class.php';
require_once BASE_PATH.'/Template.class.php';

// Plugins
include(BASE_PATH.'/plugins/foursquare.php');
include(BASE_PATH.'/plugins/trakt.php');

$header = "";

function addToHeader($html) {
	global $header;
	$header .= $html;
}

$app->get('/', function() use ($header, $cosm) {
	
	// Get alll plugins into an array
	$plugins = array_filter(get_declared_classes(), function($className) {
		return in_array('Plugin', class_parents($className));
	});

	// Run each plugin
	$plugin_data = array();
	foreach ($plugins as $plugin_class) {
		// Instanciate the plugin
		$plugin = new $plugin_class();
		if ($plugin->isActive()) {
			
			// Render out the plugin's data
			$plugin_data[] = array(
				"name" =>$plugin->getName(),
				"content" => $plugin->renderToString(),
				"cosm_feed" => $cosm["feeds"][$plugin->getName()]
			);
		}
	}

	// Render the complete site
	$template = new Template("derpface.view.php", array(
			"header" => $header,
			"plugins" => $plugin_data
		));
	return $template->renderToString();
});

$app->get('/{plugin_name}/{subpage}', function($plugin_name, $subpage) {
	$plugin = new $plugin_name(); // TODO!!!
	return $plugin->getPage($subpage);
});

$app->run();

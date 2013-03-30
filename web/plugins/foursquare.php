<?php
require_once BASE_PATH.'/../lib/foursquare/EpiCurl.php';
require_once BASE_PATH.'/../lib/foursquare/EpiFoursquare.php';

// Each plugin extends the abstract class "Plugin"
class FoursquarePlugin extends Plugin {
	protected $name = "foursquare";
	
	// Called by the constructor
	function init() {
		// Add our js requirements to the header
		addToHeader('<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.css" />
			<!--[if lte IE 8]>
				<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.ie.css" />
			<![endif]-->
			<script src="http://cdn.leafletjs.com/leaflet-0.5/leaflet.js"></script>'
		);
	}
	
	// Get the data from this plugin
	function getData() {
		$foursquareapi = new EpiFoursquare($this->config["clientID"], $this->config["clientSecret"], $this->config["accesstoken"]);
		
		$checkin = $foursquareapi->get('/users/self');
		$user = json_decode($checkin->responseText)->response->user;
		
		return array(
			"timestamp" => date("F j, Y, g:i a", $user->checkins->items[0]->createdAt),
			"venue" => htmlentities($user->checkins->items[0]->venue->name, ENT_QUOTES),
			"latitude" => $user->checkins->items[0]->venue->location->lat,
			"longitude" => $user->checkins->items[0]->venue->location->lng,
			);
	}
}

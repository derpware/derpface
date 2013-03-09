<?php
require_once BASE_PATH . '/lib/trakt/trakt.php';

class TraktPlugin extends Plugin {
	protected $name = "trakt";
	
	function init() {
		
	}
	
	function getData() {
		$traktapi = new Trakt($this->config["apikey"]);
		$traktapi->setAuth($this->config["username"], $this->config["password"]);

		$profile = $traktapi->userProfile($this->config["username"]);
		if($profile["watching"]){
			switch ($profile["watching"]["type"]) {
				case 'episode':
					$watched = $profile["watching"]["show"]["title"];
					$season = $profile["watching"]["episode"]["season"];
					$episode = $profile["watching"]["episode"]["number"];
					$title = $profile["watching"]["episode"]["title"];
					$poster = $profile["watching"]["show"]["images"]["poster"];
					$watching = TRUE;
					break;
			}
		}
		if($profile["watched"][0]["type"] == "episode" && !$watched){
			$watched = $profile["watched"][0]["show"]["title"];
			$season = $profile["watched"][0]["episode"]["season"];
			$episode = $profile["watched"][0]["episode"]["number"];
			$title = $profile["watched"][0]["episode"]["title"];
			$poster = $profile["watched"][0]["show"]["images"]["poster"];
		}
		
		return array(
				"watched" => $watched,
				"season" => $season,
				"episode" => $episode,
				"title" => $title,
				"poster" => $poster,
				"watching" => $watching
			);
	}
}

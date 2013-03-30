<?php
abstract class Plugin {
	protected $config;
	protected $name = "unknown";
	protected $cache_duration = 300;
	
	abstract protected function init();
	abstract protected function getData();
	
	public function __construct() {
		$this->config = ConfigProvider::getInstance()->get($this->name);
		$this->init();
	}
	
	public function getName() {
		return $this->name;
	}
		
	public function isActive() {
		return $this->config["active"];
	}
	
	public function renderToString() {
		$data = $this->load_cache($this->name, $this->cache_duration);
		if ($data === false) {
			$data = $this->getData();
			$this->save_cache($this->name, $data);
		}
		$template = new Template("plugins/{$this->name}.view.php", $data);
		return $template->renderToString();
	}
	
	
	/* *******************************
	 * Caching functions
	 * Adapted from http://staticfloat.com/php-programmieren/simplen-cache-mit-php-erstellen/
	 * and http://www.theukwebdesigncompany.com/articles/php-caching.php
	 * ******************************* */
	private function save_cache($key, $data) {
		$key = md5($key);
		$data = serialize($data);
		$path = BASE_PATH.'/cache/'.$key;
		file_put_contents($path, $data);	
	}
	
	private function load_cache($key, $expire) {
		$key = md5($key);
		$path = BASE_PATH.'/cache/'.$key;
		if (file_exists($path)) {
			if (time() < (filemtime($path) + $expire)) {
				return unserialize(file_get_contents($path));
			}
			unlink($path);
		}
		return false;
	}
}

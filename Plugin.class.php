<?php
abstract class Plugin {
	protected $config;
	protected $name = "unknown";
	
	abstract protected function init();
	abstract protected function getData();
	
	function __construct() {
		$this->config = ConfigProvider::getInstance()->get($this->name);
		$this->init();
	}
	
	function getName() {
		return $this->name;
	}
		
	function isActive() {
		return $this->config["active"];
	}
	
	public function renderToString() {
		$data = $this->getData();
		$template = new Template("plugins/{$this->name}.view.php", $data);
		return $template->renderToString();
	}
}

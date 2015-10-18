<?php
defined('is_running') or die('Not an entry point...');

class Renderer {
	
	var $config = array();
	var $parseDownPath;

	function __construct($conf, $parseDownPath) {
		//should be an array
		$this->config = $conf; 
		$this->parseDownPath = $parseDownPath;
	}
	

	public function render($inputString) {

		require_once $this->parseDownPath."/Parsedown.php";
		require_once $this->parseDownPath."/ParsedownExtra.php";
		
		$parseDown = new ParseDownExtra();

		$parseDown->setMarkupEscaped($this->getBoolean($this->config['markupEscaped']));
		$parseDown->setBreaksEnabled($this->getBoolean($this->config['breaksEnabled']));
		$parseDown->setUrlsLinked($this->getBoolean($this->config['urlsLinked']));
		
		return $parseDown->text($inputString);
	}



    private function getBoolean($x) {
		return (isset($x)?($x==null?false:$x):false);
	}
	
}
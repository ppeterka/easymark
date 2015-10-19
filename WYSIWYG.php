<?php
defined('is_running') or die('Not an entry point...');

// ?gpreq=flush&rp= This needs to be added to the url to get clean output...

class EasyMarkWysiwyg
{
	

	public static function getStuff() {
		$config = self::getConfig();
		if(common::LoggedIn()) {
		  if($config['wysiwygEnabled']) {
		
			global $addonPathCode, $page; 
			require_once $addonPathCode."/Renderer.php";
			
			print (new Renderer($config, $addonPathCode."/lib/parsedown"))->render($_REQUEST['content']);
		
			//haha, very secure. NOT!
			$nonce_str = 'EasyMark4Life!';
		
			//TODO: sanitize $config stuff
			//"stuff" is defined in edit.js
			print "<script>";
				print "var nonceStr = '".$nonce_str."';";
				print "var postNonce = '".common::new_nonce('post',true)."';";
				print "setTimeout(stuff, ".htmlspecialchars($config['wysiwygDelay'])."*1000);";
			print "</script>";
			
			// cleanup old page object
			unset($page); 
		  }
		}
		else {
			print "Have to be logged in to use this feature";
		}
	}
	
	//TODO: get all config stuff in one class
	private static function getConfig() {
		global $addonPathData; 
		$config = array();
		$conf = $addonPathData.'/config.php';
		if(file_exists($conf) ){
			include($conf);
			$config = $settings;
		}
		return $config;
	}
}




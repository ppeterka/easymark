<?php
defined('is_running') or die('Not an entry point...');

// ?gpreq=flush&rp= This needs to be added to the url to get clean output...

class EasyMarkWysiwyg
{
	public static function getStuff() {
		if(common::LoggedIn()) {
		  if($config['wysiwygEnabled']) {
		
			global $addonPathCode, $page; 
			require_once $addonPathCode."/Renderer.php";
			
			print (new Renderer($config, $addonPathCode."/lib/parsedown").render($_REQUEST['content']));
			print "<script>setTimeout(stuff, ".$config['wysiwygDelay'].");</script>";
			// cleanup old page object
			unset($page); 
		  }
		}
		else {
			print "Have to be logged in to use this feature";
		}
	}
}




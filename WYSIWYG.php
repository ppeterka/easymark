<?php
defined('is_running') or die('Not an entry point...');

// ?gpreq=flush&rp= This needs to be added to the url to get clean output...

class EasyMarkWysiwyg
{
	public static function getStuff() {
		if(common::LoggedIn()) {
		
			global $addonPathCode, $page; 
	
			require_once $addonPathCode."/lib/parsedown/Parsedown.php";
			require_once $addonPathCode."/lib/parsedown/ParsedownExtra.php";
			
			print( (new ParseDownExtra())->text(htmlspecialchars($_REQUEST['content'])) );

			// cleanup old page object
			unset($page); 
			
		}
		else {
			print "Have to be logged in to use this feature";
		}
	}
}




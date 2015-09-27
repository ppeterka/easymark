<?php

// ?gpreq=flush&rp= This needs to be added to the url to get clean output...

class EasyMarkWysiwyg
{

	public static getStuff() {
		if(common::LoggedIn()) {
			global $addonPathCode;
		
			require_once $addonPathCode."/lib/parsedown/Parsedown.php";
			require_once $addonPathCode."/lib/parsedown/ParsedownExtra.php";
			
			echo (new ParseDownExtra())->text(htmlspecialchars($_REQUEST['content']));
		}
		else {
			echo "Have to be logged in to use this feature";
		}
	}


}




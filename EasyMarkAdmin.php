<?php
defined('is_running') or die('Not an entry point...');

class EasyMarkAdmin {
	
	var $conf;
	var $settings = array();

	//  defaults
	var $defaults = array(
		'wysiwygDelay' => '2',
		'wysiwygEnabled' => 'true',
		'markupEscaped' => true,
		'breaksEnabled' => false,
		'urlsLinked' => false
	);
	
	function admin() {
		// include globals
		global $addonPathData;
		$this->conf = $addonPathData.'/config.php';
		$this->getSettings();
		
		if(common::LoggedIn()) {
			$cmd = common::GetCommand();
			switch($cmd) {
				//intentionally no break!
				case 'saveSettings':
					$this->saveSettings();
				
				default:
					$this->showSettings();
				break;
				
			    case 'renderContent':
					$this->renderContent();
				break;
		    }
		}
	}
		
	private function getSettings() {
		if(file_exists($this->conf) ){
			include($this->conf);
			$this->settings = $settings;
		}
		else {
			$this->settings = $this->defaults;
		}
	}
	
	private function updateBooleanSetting($settingName) {
		$this->settings[$settingName] = isset($_POST[$settingName]);
	}
	
	private function updateSetting($settingName) {
		$this->settings[$settingName] = (isset($_POST[$settingName])) ? $_POST[$settingName] :	$this->defaults[$settingName];
	}
	
	private function saveSettings() {
		global $langmessage;
		$this->updateSetting('wysiwygDelay');
		$this->updateBooleanSetting('wysiwygEnabled');
		$this->updateBooleanSetting('markupEscaped');
		$this->updateBooleanSetting('breaksEnabled');
		$this->updateBooleanSetting('urlsLinked');

		if( gpFiles::SaveArray($this->conf,'settings',$this->settings) ){
			message($langmessage['SAVED']);
			return;
		}
		
		message($langmessage['OOPS']);
		$this->settings=$_POST;
	}
	
	private function putField($type, $name, $label, $valueString, $checked = false) {
		echo '<label><input type="'.$type.'" name="'.$name.'" value="'.$valueString.'"'.($checked?'checked':'').'>'.$label.'</label><br>';
	}
	
	private function showSettings() {
		global $langmessage;
		echo '<h2>Settings</h2>';
		echo '<form action="'.common::GetUrl('Admin_EasyMark').'" method="post">'; 
		
		$this->putField('checkbox','wysiwygEnabled','WYSIWYG feature enabled','true', $this->settings['wysiwygEnabled']);
		
		$this->putField('text','wysiwygDelay','WYSIWYG feature refresh delay in seconds',(isset($this->settings['wysiwygDelay'])?$this->settings['wysiwygDelay']:$this->defaults['wysiwygDelay']) );
		
		$this->putField('checkbox', 'markupEscaped','Parsedown: markup escaped','true', $this->settings['markupEscaped']);
		$this->putField('checkbox', 'breaksEnabled','Parsedown: breaks enabled','true', $this->settings['breaksEnabled']);
		$this->putField('checkbox', 'urlsLinked','Parsedown: URLs linked','true', $this->settings['urlsLinked']);
		
		echo '<input type="hidden" name="cmd" value="saveSettings" />';
		echo '<input type="submit" name="cmd" value="'.$langmessage['cancel'].'" />';
		echo '<input type="submit" name="" value="'.$langmessage['save'].'" />';
		
		echo '</form>';

		echo '<div><h2>Acknowledgements</h2><p>Heartful thanks for making this small thing posssible:<ul>';
		echo '<li><strong><a href="https://github.com/oyejorge">Josh Schmidt</a></strong>: for GpEasy/Typesetter, and fixing my first issue</li>';
		echo '<li><strong><a href="https://github.com/erusev">Emanuil Rusev</a></strong>: for ParseDown and ParseDown Extra</li>';
		echo '<li><strong><a href="https://github.com/juek">Jürgen Krausz</a></strong>: for spotting and fixing incompatibility with PHP 5.3</li>';
		echo '</ul></p></div>';

	}

	private function renderContent() {
		if(common::LoggedIn()) {
		  if($this->settings['wysiwygEnabled']) {
		
			global $addonPathCode, $page; 
			require_once $addonPathCode."/Renderer.php";
			
			$renderer = new Renderer($this->settings, $addonPathCode."/lib/parsedown");
			print $renderer->render($_REQUEST['content']);
		
			//haha, very secure. NOT!
			$nonce_str = 'EasyMark4Life!';
		
			//TODO: sanitize $config stuff
			//"getPostResponseEasyMark" is defined in edit.js
			print "<script>";
				print "var postNonce = '".common::new_nonce('post',true)."';";
				print "setTimeout(gp_editor.getPostResponseEasyMark, ".htmlspecialchars($this->settings['wysiwygDelay'])."*1000);";
			print "</script>";
			
			// cleanup old page object
			unset($page); 
		  }
		}
		else {
			print "Have to be logged in to use this feature";
		}
	}
	
} 
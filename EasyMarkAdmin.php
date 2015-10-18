<?php
defined('is_running') or die('Not an entry point...');

class EasyMarkAdmin {
	
	var $conf;
	var $settings = array();

	//  defaults
	var $defaults = array(
		'wysiwygDelay' => '5',
		'wysiwygEnabled' => 'true',
		'markupEscaped' => true,
		'breaksEnabled' => false,
		'urlsLinked' => false
	);
	
	function admin() {
		// include globals
		global $page,$langmessage,$dataDir,$addonPathData,$addonRelativeCode;
		$this->conf = $addonPathData.'/config.php';
		$this->getSettings();
		
		if(common::LoggedIn()) {
			$cmd = common::GetCommand();
			if($cmd == 'saveSettings') { 
				$this->saveSettings();
			}
			$this->showSettings();
		}
	}
		
	private function getSettings() {
		if(file_exists($this->conf) ){
			include($this->conf);
			$this->settings = $settings;
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
		//print_r($this->settings);
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
	}

	
} 
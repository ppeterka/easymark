<?php
defined('is_running') or die('Not an entry point...');


class EasyMark
{
	public static $sectionType = 'easymark_section';

	function SectionTypes( $section_types) {
		$section_types[self::$sectionType] = array();
		$section_types[self::$sectionType]['label'] = 'EasyMark';
		return $section_types;
	}

	function SectionToContent($section_data) {
		global $addonPathCode;
		
		if( $section_data['type'] == self::$sectionType ) {
			require_once $addonPathCode."/lib/parsedown/Parsedown.php";
			require_once $addonPathCode."/lib/parsedown/ParsedownExtra.php";

			$section_data['content']=(new ParseDownExtra())->text(htmlspecialchars($section_data['content']));
		}
		
		return $section_data;
	}
	
	function DefaultContent($default_content,$type) {
		if( $type == self::$sectionType ) {
			$section = array();
			$section['content'] = "Hello **MarkDown** _world_!!!";
			$section['uniqid'] = "em-" . crc32(uniqid("",true));
			return $section;
		}
		return $default_content;
	}

	
	function SaveSection($return,$section,$type) {
		if( $type != self::$sectionType ) {
		  return $return;
		}
		global $page;
		$content =& $_POST['gpcontent'];
		$page->file_sections[$section]['content'] = $content;
		return true;
	}
	
	function GenerateContent_Admin() {
		global $addonFolderName, $page;
		static $done = false;
		if ($done || !common::LoggedIn()) { return; }
		$done = true;
	}
	
	function InlineEdit_Scripts($scripts,$type) {
		global $addonPathCode;
		
		if( $type == self::$sectionType ) {
			$scripts[] = $addonPathCode.'/js/edit.js';
		}
		return $scripts; 
	}
}



<?php
defined('is_running') or die('Not an entry point...');

include $addonPathCode."lib/parsedown/Parsedown.php";

class EasyMark
{
	public static $sectionType = 'easymark_section';

	function SectionTypes( $section_types) {
		$section_types[self::$sectionType] = array();
		$section_types[self::$sectionType]['label'] = 'EasyMark';
		return $section_types;
	}

	function SectionToContent($section_data) {
		if( $section_data['type'] != self::$sectionType ) {
			return $section_data;
		}
		
		$section_data['content']=(new ParseDown())->text(htmlspecialchars($section_data['content']));
		return $section_data;
	}
	
	function DefaultContent($default_content,$type) {
		if( $type != self::$sectionType ) {
			return $default_content;
		}

		$section = array();
		$section['content'] = "Hello **MarkDown** _world_!!!";
		$section['uniqid'] = "em-" . crc32(uniqid("",true));
		return $section;
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
		
		if( $type != self::$sectionType ) {
		  return $scripts;
		}
		
		$scripts[] = $addonPathCode.'/js/edit.js';
		return $scripts; 
	}
}


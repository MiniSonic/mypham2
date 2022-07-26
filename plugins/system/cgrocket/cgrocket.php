<?php
/*---------------------------------------------------------------
# Package - Joomla Template based on CGrocket Framework   
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 Cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com - http://www.leweb2.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

jimport( 'joomla.event.plugin' );
jimport( 'joomla.filesystem.file' );
jimport( 'joomla.filesystem.folder' );

class  plgSystemcgrocket extends JPlugin
{
	function onContentPrepareForm($form, $data)
	{
		if ($form->getName()=='com_menus.item')//Add cgrocket menu params to the menu item
		{
			JHtml::_('behavior.framework', true);
			$doc = JFactory::getDocument();
			JForm::addFormPath(JPATH_PLUGINS.DS.'system'.DS.'cgrocket'.DS.'elements');
			$form->loadFile('params', false);
			
			//Load js
			$plg_path = JURI::root(true).'/plugins/system/cgrocket/elements/menuscript.js';
			$doc->addScript($plg_path, "text/javascript");
		}
		
		if ($form->getName()=='com_modules.module') {//Add Module positions :)
			JHtml::_('behavior.framework', true);
			$doc = JFactory::getDocument();
			echo $this->getPositions();
			$plg_path = JURI::root(true).'/plugins/system/cgrocket/elements/positions.js';
			$doc->addScript($plg_path, "text/javascript");
		}
	}	
	
	function getPositions () {//Get all templates position
		$templates = $this->getTemplates();
		$output = '<select id="cg_pos" style="min-width:160px;display:none;">';
		foreach ($templates as $tmpl) {
			$output .= $this->genPos($tmpl);
		}
		$output .= '</select>';
		return $output; 
	}
	
	function genPos ($tmpl) {//Get all positions if an individual template
		$file = JPATH_ROOT.DS.'templates'.DS.$tmpl.DS.'templateDetails.xml';
		$output='';
		$xml = JFactory::getXMLParser('Simple');
		$xml->loadFile($file);
		$positions = $xml->document->positions[0]->children();		
		foreach ($positions as $position) {
			$output .= '<option value="' . $position->data() . '">' . $position->data() . '</option>';
		}		
		return $output;
	}
	
	
	function getTemplates () {//Get the list of templates
		$lists = array(); 
		$path		= JPATH_ROOT.DS.'templates';
		$folders	= JFolder::folders($path);
		foreach ($folders as $folder) {
			if ($folder != 'system' && JFile::exists(JPATH_ROOT.DS.'templates'.DS.$folder.DS.'templateDetails.xml')) {//bypass system template name
				$lists[] = $folder;	
			}
		}		
		return $lists; 		
	}

}
?>
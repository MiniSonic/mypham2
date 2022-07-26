<?php
/*---------------------------------------------------------------
# Package - Module CGrocket Tab by CGrocket.com 
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 Cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com - http://www.leweb2.com
-----------------------------------------------------------------*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.form.formfield');

class JFormFieldAsset extends JFormField
{
	protected	$type = 'Asset';
	
	protected function getInput() {
		$doc = JFactory::getDocument();	
		$doc->addScript(JURI::root(true).'/modules/mod_cgrocket_tab/elements/js/jquery.js');
		$doc->addScript(JURI::root(true).'/modules/mod_cgrocket_tab/elements/js/script.js');
		$doc->addScript(JURI::root(true).'/modules/mod_cgrocket_tab/elements/js/colorpicker.js');
		$doc->addStylesheet(JURI::root(true).'/modules/mod_cgrocket_tab/elements/css/style.css');
		$doc->addStylesheet(JURI::root(true).'/modules/mod_cgrocket_tab/elements/css/colorpicker.css');
		return null;
	}
} 
?>
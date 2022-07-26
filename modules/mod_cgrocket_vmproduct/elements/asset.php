<?php
/*------------------------------------------------------------------------
# CGrocket Virtuemart Product Show Module
# ------------------------------------------------------------------------
# Author    CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 CGrocket.com. All Rights Reserved.
# @license - GNU/GPL V2 for PHP files. CSS / JS are Copyrighted Commercial
# Websites: http://www.cgrocket.com
-------------------------------------------------------------------------*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.form.formfield');

class JFormFieldAsset extends JFormField
{
	protected	$type = 'Asset';
	
	protected function getInput() {
		$doc = JFactory::getDocument();	
		$doc->addScript(JURI::root(true).'/modules/mod_cgrocket_vmproduct/elements/js/jquery.js');
		$doc->addScript(JURI::root(true).'/modules/mod_cgrocket_vmproduct/elements/js/jquery.uniform.min.js');
		$doc->addScript(JURI::root(true).'/modules/mod_cgrocket_vmproduct/elements/js/script.js');
		$doc->addStylesheet(JURI::root(true).'/modules/mod_cgrocket_vmproduct/elements/css/style.css');
		return null;
	}
} 
?>
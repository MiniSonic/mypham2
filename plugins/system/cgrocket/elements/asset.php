<?php
/*---------------------------------------------------------------
# Package - Joomla Template based on CGrocket Framework   
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 Cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com - http://www.leweb2.com
-----------------------------------------------------------------*/

defined('JPATH_BASE') or die;
jimport('joomla.form.formfield');

class JFormFieldAsset extends JFormField
{
	protected	$type = 'Asset';
	
	protected function getInput() {
		$doc = & JFactory::getDocument();
		$plg_path = JURI::root().'/plugins/system/cgrocket/elements/';	
		if($this->element['assettype'] == 'js') {
			return $doc->addScript($plg_path . $this->element['filename']);
		} else {
			return $doc->addStyleSheet($plg_path . $this->element['filename']);   
		}	
	}
} 
?>
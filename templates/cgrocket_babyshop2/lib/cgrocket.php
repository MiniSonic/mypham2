<?php
/*---------------------------------------------------------------
# Package - Joomla Template based on CGrocket Framework    
# ---------------------------------------------------------------
# Author - cgrocket http://www.cgrocket.com
# Copyright (C) 2012 cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

$docs = JFactory::getDocument();
$cgrocket_path = JPATH_PLUGINS.DS.'system'.DS.'cgrocket'.DS.'core'.DS.'class.helper.php';
if (file_exists($cgrocket_path)) {
    require_once($cgrocket_path);
	$cgrocket = new cgrocketHelper($docs);
}
else {
    echo JText::_('CGrocket Framework  not found.');
    die;
}

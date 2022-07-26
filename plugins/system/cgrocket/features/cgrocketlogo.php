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
?>

<?php
	if ($this->getParam('show_cgrocket_logo')) {
	$cgrocket_url='http://www.cgrocket.com';
	$cgrocket_title='CGrocket Framework';
	$cgrocket_logo=$this->getParam('cgrocket_logo');
?>
<div id="powered-by" class="cgrocket-logo cgrocket-logo-<?php echo $cgrocket_logo ?>">
	<a target="_blank" title="<?php echo $cgrocket_title ?>" href="<?php echo $cgrocket_url ?>"><?php echo $cgrocket_title ?></a>
</div> 
<?php } ?>
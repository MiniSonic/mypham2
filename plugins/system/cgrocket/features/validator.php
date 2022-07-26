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

<?php if($this->getParam('validator')) { ?>
	<?php echo JText::_('Valid') ?> <a target="_blank" href="http://validator.w3.org/check/referer">XHTML</a> <?php echo JText::_('and') ?> <a target="_blank" href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">CSS</a>
<?php } ?>
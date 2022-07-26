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

<?php if ($this->getParam('logo_type')=='image') { ?>
	<a id="logo" style="width:<?php echo $this->getParam('logo_width') ?>px;height:<?php echo $this->getParam('logo_height') ?>px" href="<?php echo $this->baseUrl?>" title="<?php echo $this->getSitename() ?>"></a>
<?php } else { ?>
	<div id="logo-text" style="width:<?php echo $this->getParam('logo_width') ?>px;height:<?php echo $this->getParam('logo_height') ?>px">
		<h1><a title="<?php echo $this->getSitename() ?>" href="<?php echo $this->baseUrl ?>"><span><?php echo $this->getParam('logo_text') ?></span></a></h1>
		<p class="site-slogan"><?php echo $this->getParam('logo_slogan') ?></p>
	</div>
<?php } ?>
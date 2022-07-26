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
?>

<?php
	if ($this->isIE(7) || $this->isIE(8)) $this->API->addStylesheet($this->themeUrl.'/css/iecss3.css.php?url='. JURI::base().'templates/'.$this->API->template);
	if ($this->isIE(7)) $this->addCSS('IE7_only.css');
	if (($this->getDirection() == 'rtl') && $this->isIE(7)) $this->addCSS('IE7_rtl.css');
?>
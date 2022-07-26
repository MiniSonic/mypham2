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

if ($this->countModules ( 'left or left1 or left2 or left-mid or left3 or left4 or left-bottom' )) {
	define('_LEFT', 1);
	?>
	<div id="cg-leftcol" class="clearfix">
		<?php 
			$this->addModules('left','cg_xhtml');//position left
			$this->addModules('left1,left2','cg_xhtml','cg-left-gridtop');//position left1 and left2
			$this->addModules('left-mid','cg_xhtml');//position left-mid
			$this->addModules('left3,left4','cg_xhtml','cg-left-gridbottom');//position left3 and left4	
			$this->addModules('left-bottom','cg_xhtml');//position left-bottom 			
		?>
	</div>
	<?php
}
?>
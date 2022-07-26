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

if ($this->countModules ( 'right or right1 or right2 or right-mid or right3 or right4 or right-bottom' )) {
	define('_RIGHT', 1);
	
	?>
	<div id="cg-rightcol">
			<?php 
				$this->addModules('right','cg_xhtml');//position right
				$this->addModules('right1,right2','cg_xhtml','cg-right-gridtop');//position right1 and right2
				$this->addModules('right-mid','cg_xhtml');//position right-mid
				$this->addModules('right3,right4','cg_xhtml','cg-right-gridbottom');//position right3 and right4	
				$this->addModules('right-bottom','cg_xhtml');//position right-bottom 				
			?>
	</div>
	<?php
}
?>
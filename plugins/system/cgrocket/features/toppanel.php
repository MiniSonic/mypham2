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

<?php if /*--- Module Position panel1 to panel6 ---*/ ($mods= $this->getModules('panel1,panel2,panel3,panel4,panel5,panel6')) { ?>
<!--Start Top Panel-->
<div class="cg-toppanel-wrap clearfix">
	<div id="cg-toppanel" class="clearfix">
		<div class="cg-wrap clearfix">
			<div id="cg-top" class="cg-inner clearfix">
				<?php $this->renderModules($mods,'cg_flat');?>
			</div>
			<div id="toppanel-handler">
				<div class="handler-left">
					<div class="handler-right">
						<div class="handler-mid">
							<?php echo JText::_('TOP_PANEL') ?>
						</div>	
					</div>	
				</div>	
			</div>
		</div>
	</div>
</div>
<?php $this->addCSS('toppanel.css') ?>
<?php $this->addJS('toppanel.js') ?>
<!--End Top Panel-->
<?php } ?>
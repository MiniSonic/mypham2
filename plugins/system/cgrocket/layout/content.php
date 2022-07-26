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
<div id="cg-maincol" class="clearfix">
	<?php
		$this->addModules('slide1'); //slide1
		$this->addModules('user-top', 'cg_xhtml'); //user-top 
		$this->addModules('content1, content2, content3, content4', 'cg_xhtml', 'cg-content-grid-top'); //content1-content4
	?>
	<div class="clr"></div>
	<?php $this->addModules('inset1', 'cg_xhtml'); //inset1 ?>
	<div id="inner_content" class="clearfix"> <!--Component Area-->
		<?php 
			$this->addModules('feature-top', 'cg_xhtml'); //feature-top	
			$this->addModules('feature1,feature2,feature3,feature4', 'cg_xhtml', 'cg-feature-grid-top'); //feature1-feature4
			$this->addModules('feature-mid', 'cg_xhtml'); //feature-mid
			$this->addModules('feature5,feature6,feature7,feature8', 'cg_xhtml', 'cg-feature-grid-bottom'); //feature5-feature8	
			$this->addModules('feature-bottom', 'cg_xhtml'); //feature-bottom
		?>		
		<?php if (!$this->hideItem()): ?>
			<div class="cg-inner clearfix">
				<?php $this->addModules('pathway'); //pathway position ?>
				<jdoc:include type="message" />
				<jdoc:include type="component" />
			</div>
		<?php endif; ?>
		<?php
			$this->addModules('utility-top', 'cg_xhtml'); //utility-top 
			$this->addModules('utility1,utility2,utility3,utility4', 'cg_xhtml', 'cg-utility'); //utility1-utility4
			$this->addModules('utility-bottom', 'cg_xhtml'); //utility-bottom 
		?>
	</div>
	<?php 
		$this->addModules('inset2', 'cg_xhtml'); //inset2
	?>
	<div class="clr"></div>
	<?php 
		$this->addModules('content5,content6,content7,content4', 'cg_xhtml', 'cg-content-grid-bottom'); //content5-content8	
		$this->addModules('user-bottom', 'cg_xhtml'); //user-bottom 
	?>
</div>
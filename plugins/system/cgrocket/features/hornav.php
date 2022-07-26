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
	if (($menu = $this->loadMenu())) 
	echo '<div class="clr"></div><div id="hornav" class="clearfix">';
		$menu->showMenu ();						
	echo '</div>';

	if (($this->getMenu()=='split') && $menu->hasSub() || $this->getMenu()=='drop') {	
		echo '<div class="clr"></div><div id="sublevel" class="clearfix">';
			$menu->showMenu (1);
		echo '</div>';			
	}

	if (($this->getMenu()=='split' && $menu->hasSub()) || $this->getMenu()=='drop') {
		$sublevel=1;
	} else {
		$sublevel=0;
	}	

	$this->addCSS('menu.css');
	if ($this->getMenu()=='drop') {
		$this->addInlineCSS('#sublevel ul.level-1 {display:none}');
		$this->addJS('dropline.js');
	}
	$this->addJS('menu.js');
?>
<script type="text/javascript">
//<![CDATA[
	window.addEvent('domready',function(){
		<?php
			if ($this->getParam('wrapper_limit','body')=='body') {
				$limit = "$(document.body)";
			} else {
				$limit	= "document.getElement('.cg-wrap')";
			}
		?>
		var	limits = <?php echo $limit ?>;
		items_v = [], items_h = [];

		$$('div.submenu').each(function (el) {
			if (el.getParent().getParent().hasClass('level-<?php echo $sublevel ?>')) {
				items_v.push(el);
			} else {
				items_h.push(el);
			}
		});

		new CGMenu(items_v, {
			direction: '<?php echo strtoupper($this->getDirection()) ?>',
			bound: limits,
			fxOptions: {
				transition: Fx.Transitions.<?php echo $this->getParam('menu_transition','Sine.easeOut') ?>,
				duration: <?php echo $this->getParam('menu_duration',400) ?>
			},
			animation: '<?php echo $this->getParam('menu_animation','slide') ?>',
			mode: 'vertical',
			offset:{x:<?php echo $this->getParam('init_x',0) ?>, y: <?php echo $this->getParam('init_y',0) ?>}
		});

		new CGMenu(items_h, {
			direction: '<?php echo strtoupper($this->getDirection()) ?>',
			bound: limits,
			fxOptions: {
				transition: Fx.Transitions.<?php echo $this->getParam('menu_transition','Sine.easeOut') ?>,
				duration: <?php echo $this->getParam('menu_duration',400) ?>
			},
			animation: '<?php echo $this->getParam('menu_animation','slide') ?>',
			mode: 'horizontal',
			offset: {x: <?php echo $this->getParam('sub_x',0) ?>, y: <?php echo $this->getParam('sub_y',0) ?>}
		});
	});
//]]>
</script>
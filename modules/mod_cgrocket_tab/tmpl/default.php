<?php 
/*---------------------------------------------------------------
# Package - Module CGrocket Tab by CGrocket.com 
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 Cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com - http://www.leweb2.com
-----------------------------------------------------------------*/
// no direct access

defined('_JEXEC') or die('Restricted access'); ?>
<script type="text/javascript">
window.addEvent('domready',function(){
var cgrocket_tab<?php echo $uniqid ?> = new cgrocket_tabs($('cgrocket_tab<?php echo $uniqid ?>'), {
	animation : <?php echo "'" . $animation . "'" ?>,
	btnPos: <?php echo "'" . $btnPos . "'" ?>,
	activator: <?php echo "'" . $activator . "'" ?>,
	transition: <?php echo 'Fx.Transitions.' . $transition ?>,
	fxduration: <?php echo $fxspeed ?>,
	autoHeight : <?php echo $body_height ?>,
	fixedHeight: <?php echo $fixed_height ?>
	});
});
</script>
<div class="<?php echo $color ?>" id="cgrocket_tab<?php echo $uniqid ?>">
<?php foreach ($list as $item) : ?>
	<div style="display:none">
		<div class="tab-padding">
			<h2 style="display:none" class="title"><?php echo $item->title; ?></h2>
			<?php echo $item->content; ?>
			<div style="clear:both"></div>
		</div>
	</div>
<?php endforeach; ?>
</div>
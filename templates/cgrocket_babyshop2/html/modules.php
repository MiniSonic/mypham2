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
function modChrome_cg_xhtml($module, $params, $attribs)
{ ?>
	<div class="module<?php echo $params->get('moduleclass_sfx'); ?>">	
		<div class="mod-wrapper clearfix">		
		<?php if ($module->showtitle != 0) { ?>
				<h3 class="header">			
				<?php 
					$title=explode(' ',$module->title);
					$title[0] = '<span>'.$title[0].'</span>';
					$title= join(' ', $title);
					echo $title; 
				?>
				</h3>
				<?php
					$modsfx=$params->get('moduleclass_sfx');
					if ($modsfx !='') echo '<span class="badge' . $modsfx . '"></span>';
				?>
			<?php } ?>
			<div class="mod-content clearfix">	
				<div class="mod-inner clearfix">
					<?php echo $module->content; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="gap"></div>
	<?php
}

function modChrome_cg_flat($module, $params, $attribs)
{ ?>
	<div class="module<?php echo $params->get('moduleclass_sfx'); ?>">	
		<div class="mod-wrapper-flat clearfix">		
		<?php if ($module->showtitle != 0) { ?>
				<h3 class="header">			
				<?php 
					$title=explode(' ',$module->title);
					$title[0] = '<span>'.$title[0].'</span>';
					$title= join(' ', $title);
					echo $title; 
				?>
				</h3>
				<?php
					$modsfx=$params->get('moduleclass_sfx');
					if ($modsfx !='') echo '<span class="badge' . $modsfx . '"></span>';
				?>
			<?php } ?>
			<?php echo $module->content; ?>
		</div>
	</div>
	<div class="gap"></div>
	<?php
}

function modChrome_cg_raw($module, $params, $attribs)
{ 
	echo $module->content; 
}

function modChrome_cg_menu($module, $params, $attribs)
{ ?>
	<div class="module<?php echo $params->get('moduleclass_sfx'); ?>">	
		<div class="mod-wrapper-menu clearfix">		
		<?php if ($module->showtitle != 0) { ?>
				<h3 class="header">			
				<?php 
					$title=explode(' ',$module->title);
					$title[0] = '<span>'.$title[0].'</span>';
					$title= join(' ', $title);
					echo $title; 
				?>
				</h3>
				<?php
					$modsfx=$params->get('moduleclass_sfx');
					if ($modsfx !='') echo '<span class="badge' . $modsfx . '"></span>';
				?>
			<?php } ?>
			<?php echo $module->content; ?>
		</div>
	</div>
	<?php
}

?>
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
require_once(dirname(__FILE__).DS.'lib'.DS.'cgrocket.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language;?>" >
<head>
	<?php
		$cgrocket->loadHead();
		$cgrocket->addCSS('template.css,joomla.css,custom.css,modules.css,typography.css,css3.css,acymailing.css,jcomment.css,virtuemart.css,vmcategories.css');
		if ($cgrocket->getDirection() == 'rtl') $cgrocket->addCSS('template_rtl.css');
		$cgrocket->getStyle();
	?>
</head>
<?php $cgrocket->addFeature('ie6warn'); ?>
<body class="bg clearfix">
	<div class="cg-wrap clearfix">
		<?php $cgrocket->addFeature('toppanel'); ?>
		<?php if($cgrocket->countModules('topmenu')) { /*--- topmenu module ---*/?>	
			<div id="topmenu" class="topmenu">
				<jdoc:include type="modules" name="topmenu" />			
			</div>				
		<?php } ?>	
	
		<div id="header" class="cg-inner clearfix">
			<?php $cgrocket->addFeature('logo') /*--- Add logo ---*/?>	
			<?php if ($cgrocket->countModules('search')) { /*--- Search Module ---*/?>
				<div id="search">
					<jdoc:include type="modules" name="search" />
				</div>
			<?php } ?>	
		</div>		
		<div class="cg-inner clearfix">
			<?php $cgrocket->addFeature('hornav') /*-- main navigation--*/?>	
		</div>

		<?php if($cgrocket->countModules('slides')) { /*--- Slideshow module ---*/?>	
			<div id="slides" class="cg-inner clearfix">
				<jdoc:include type="modules" name="slides" />			
			</div>				
		<?php } ?>	
	
		<?php if($mods= $cgrocket->getModules('user1,user2,user3,user4,user5,user6')) { /*-- Module Position user1 to user6 --*/ ?>
			<div id="cg-userpos" class="clearfix">
				<div class="cg-inner">
					<?php $cgrocket->renderModules($mods,'cg_xhtml');?>
				</div>
			</div>
		<?php } ?>
		<?php if($mods= $cgrocket->getModules('user1a,user2a,user3a,user4a,user5a,user6a')) { /*-- Module Position user1 to user6 --*/ ?>
			<div id="cg-userpos" class="clearfix">
				<div class="cg-inner">
					<?php $cgrocket->renderModules($mods,'cg_xhtml');?>
				</div>
			</div>
		<?php } ?>
		
		<div class="clearfix">
			<?php $cgrocket->loadLayout(); /*--mainbody layout--*/?>
		</div>

	<div class="clearfix">	
	<?php if($mods= $cgrocket->getModules('bottom1,bottom2,bottom3,bottom4,bottom5,bottom6')) { /*--Module Position bottom1 to bottom6--*/?>
		<div class="mainbody clearfix">
			<?php $cgrocket->addModules('mid1,mid2,mid3,mid4','cg_flat','cg-mid','31,31,38'); //mid-mid3 position ?>
			<?php $cgrocket->loadLayout(); //main layout ?>
		</div>

	<div id="cg-bottom" class="clearfix">
			<?php $cgrocket->renderModules($mods,'cg_flat','equal');?>
		</div>
		<?php $cgrocket->fixHeight('equal') /*Equal height for 'equal' class*/?>
	<?php } ?>
	
	<?php if($cgrocket->countModules('bottom-banner')) { /*--- position 'bottom-banner' ---*/?>	
		<div id="bottom-banner" class="clearfix">
			<jdoc:include type="modules" name="bottom-banner" />			
		</div>				
	<?php } ?>																																																																																
				<div id="cg-footer" class="clearfix">
					<?php $cgrocket->addFeatures('totop'); /*--- Go to top ---*/ ?>		
		<?php if ($cgrocket->countModules('footer-nav')) /*--- Module position footer-nav ---*/{ ?>
			<div id="footer-nav">
				<jdoc:include type="modules" name="footer-nav" />
			</div>
		<?php } ?>
		<div class="cp">																																																																																				<?php $cgrocket->addFeatures('copyright,brand,jcredit,validator')  ?>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<?php $cgrocket->addFeature('analytics'); /*--- Google analytics tracking code ---*/?>
	<?php $cgrocket->addFeature('jquery'); /*--- Load jQuery library ---*/?>
	<?php $cgrocket->addFeature('ieonly'); /*--- IE only Feature ---*/?>
	<?php $cgrocket->compress(); /* --- Compress CSS and JS files --- */ ?>	
	<?php $cgrocket->getFonts() /*--- Standard and Google Fonts ---*/?>	
	<jdoc:include type="modules" name="debug" />
	<jdoc:include type="modules" name="magiczoom" />
</body>
</html>

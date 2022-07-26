<?php
/*---------------------------------------------------------------
# Package - VM Categorie Module by CGrocket.com  
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# license - CSS  - JS - IMAGE files  are Copyrighted material 
# Websites: http://www.cgrocket.com - http://www.leweb2.com
-----------------------------------------------------------------*/
?>
 
 <div class="lofmenu_virtuemart">
	<?php echo $categories; ?>
</div>
<script language="javascript">
	if(jQuery('.lofmenu_virtuemart .lofmenu .lofitem1') ){
		jQuery('.lofmenu_virtuemart .lofmenu .lofitem1').find('ul').css({'visibility':'hidden'});
	}
	jQuery(document).ready(function(){
		jQuery('.lofmenu_virtuemart .lofmenu .lofitem1 ul').each(function(){
			jQuery(this).find('li:first').addClass('loffirst');
		})
		jQuery('.lofmenu_virtuemart .lofmenu li').each(function(){
			jQuery(this).mouseenter(function(){
				jQuery(this).addClass('lofactive');
				jQuery(this).find('ul').css({'visibility':'visible'});
				jQuery(this).find('ul li ul').css({'visibility':'hidden'});
			});
			jQuery(this).mouseleave(function(){
				jQuery(this).removeClass('lofactive');
				jQuery(this).find('ul').css({'visibility':'hidden'});
			});
		});
	});
</script>
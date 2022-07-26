/*---------------------------------------------------------------
# Package - Module CGrocket Tab by CGrocket.com 
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 Cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com - http://www.leweb2.com
-----------------------------------------------------------------*/

jQuery.noConflict();

jQuery(document).ready(function(){
	showhide();	

	jQuery('#jform_params_style, #jform_params_body_height').change(function() {showhide()});
	jQuery('#jform_params_style, #jform_params_body_height').blur(function() {showhide()});
	
	function showhide(){
		if (jQuery("#jform_params_style").val()=="raw" || jQuery("#jform_params_style").val()=="custom") {
			jQuery("#jform_params_color").parent().css("display", "none");
		} else {
			jQuery("#jform_params_color").parent().css("display", "block");		
		}	
		if (jQuery("#jform_params_style").val()=="raw" || jQuery("#jform_params_style").val()!="custom") {
			jQuery('.cg-input').parent().css("display", "none");
		} else {
			jQuery('.cg-input').parent().css("display", "block");		
		}
		if (jQuery("#jform_params_body_height").val()=="1") {
			jQuery("#jform_params_fixed_height").parent().css("display", "none");
		} else {
			jQuery("#jform_params_fixed_height").parent().css("display", "block");		
		}		
		
		jQuery('.pane-slider').css("height", "auto");
	}
	
	var empty =jQuery('#jform_params___field1-lbl');
	if (empty) empty.parent().remove();
});
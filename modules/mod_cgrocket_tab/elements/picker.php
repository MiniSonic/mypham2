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
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.form.formfield');

class JFormFieldPicker extends JFormField
{
	protected	$type = 'Picker';
	
	protected function getInput() {
		$doc = JFactory::getDocument();
		
		$doc->addScriptDeclaration ('jQuery(document).ready(function(){
		jQuery("#' . $this->id . '_picker").ColorPicker({
		color: "' . $this->value . '",
		onShow: function (colpkr) {
			jQuery(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			jQuery(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			jQuery("#' . $this->id . '_picker div").css("backgroundColor", "#" + hex);
			jQuery("#' . $this->id . '_picker").prev().val("#" + hex);
		}
	}); 
	});'
	);
	return '<input type="text" name="' . $this->name . '" id="' . $this->id . '" class="cg-input" value="' . $this->value . '" size="10" /><span id="' . $this->id . '_picker" class="picker-box"><div style="background-color: ' . $this->value . '"></div></span>';
	}
} 
?>
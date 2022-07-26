/*---------------------------------------------------------------
# Package - Joomla Template based on CGrocket Framework   
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 Cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com - http://www.leweb2.com
-----------------------------------------------------------------*/
window.addEvent("domready",function(){
	var posID=document.id('jform_position');
	var cg_pos = document.id('cg_pos');
	
	//Inject Template and Position dropdown list
	cg_pos.injectAfter(posID.getParent()).style.display=null;
	
	//Change module position
	cg_pos.addEvents({
		change: function(){
			posID.value=cg_pos.value;
		},
		keyup: function(){
			posID.value=cg_pos.value;
		}
	});
	
});
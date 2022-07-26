/*---------------------------------------------------------------
# Package - Joomla Template based on CGrocket Framework   
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 Cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com - http://www.leweb2.com
-----------------------------------------------------------------*/
window.addEvent("domready",function(){
	var cgToppanel = {
		initialize: function () {	
			this.open = false;
			this.wrapper =document.getElement('.cg-toppanel-wrap').setStyle('display', 'block');			
			this.container =document.id('cg-toppanel');
			this.box = this.container.inject(new Element('div', {'id': 'toppanel_container'}).inject(this.container.getParent()));
			this.handle = document.id('toppanel-handler');
			this.box = new Fx.Slide(this.box,{transition: Fx.Transitions.Expo.easeOut});
			this.box.hide();			
			this.handle.addEvent('click', this.toggle.bind(this));
		},

		show: function () {
			this.box.slideIn();
			this.open = true;
		},

		hide: function () {
			this.box.slideOut();
			this.open = false;
		},

		toggle: function () {
			if (this.open) {
				this.hide();
			} else {
				this.show();
			}
		}
	};
cgToppanel.initialize();
})
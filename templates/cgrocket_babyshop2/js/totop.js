/*---------------------------------------------------------------
# Package - CGrocket Framework  
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 CGrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com -  http://www.leweb2.com
-----------------------------------------------------------------*/
window.addEvent("domready",function(){	
	new SmoothScroll({ duration: 500, transition: Fx.Transitions.linear}, window);	
	/* go to top */
	var gototop = $('topofpage');
	gototop.set('opacity','0').setStyle('display','block');
	window.addEvent('scroll',function(e) {
		if(Browser.Engine.trident4) {
			gototop.setStyles({
				'position': 'absolute',
				'bottom': window.getPosition().y + 10,
				'width': 100
			});
		}
		gototop.fade((window.getScroll().y > 300) ? 'in' : 'out')
	});	

	var a = $$('#topofpage');//Goto to Top 
	if (a) {
		var b = new Fx.Scroll(window);
		a.addEvent('click', function (e) {
			new Event(e).stop();
			b.toTop()
		})
	}			
});
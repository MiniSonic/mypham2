/*---------------------------------------------------------------
# Package - Joomla Template based on CGrocket Framework   
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 Cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com - http://www.leweb2.com
-----------------------------------------------------------------*/
window.addEvent("domready",function(){
	var tabs = [];
	var options = [];
	var opt_iterator = -1;
	var div_gen,div;
	var cur_version ='1.0';
	var update_url = 'http://www.cgrocket.com/updates/help-update-j16.raw';
	var base_table = $$('.fltlft')[0];
	
	//Info area
	var cgrocket_details = new Element('div',{"class":"cgrocket-details clearfix"});
	cgrocket_details.injectInside(base_table.getParent());

	//Tab button area
	var cgrocket_title_area = new Element('div',{"class":"cgrocket-title-area"});
	cgrocket_title_area.injectInside(base_table.getParent());
	var cgrocket_tabs = new Element('ul',{"class":"cgrocket-tabs"});
	cgrocket_tabs.injectInside(cgrocket_title_area);
	
	//Tab item area
	var cgrocket_panel = new Element('div',{"class":"cgrocket-panel"});
	cgrocket_panel.injectInside(base_table.getParent());
	var cgrocket_inner = new Element ('div',{"class":"cgrocket-inner"});
	cgrocket_inner.innerHTML='<div class="cgrocket-params-area clearfix"></div>';
	cgrocket_inner.injectInside(cgrocket_panel);


	document.getElements('.panel h3.title').each(function(el){
		div_gen = new Element('li',{"class":"tabs-title","id":'cg-'+ el.get('text').replace(/\s+/g,"-").toLowerCase()});//Set title as id in lower case			
		div_gen.innerHTML = '<span class="tab-l"><span class="tab-r"><span class="tab-text">'+el.get('text')+'</span></span></span>';			
		div_gen.injectInside(cgrocket_tabs);
	})

	document.getElements('.panel .content').each(function(el){
		div = new Element('div',{"class":"tabs-item"});
		div.innerHTML = el.innerHTML;			
		div.injectInside(document.getElement('.cgrocket-params-area'));
	})
	
	//Menu Assignment Tab
	var assign_tab = new Element('li',{"class":"tabs-title","id":"cg-menu-assign"});
	assign_tab.innerHTML = '<span class="tab-l"><span class="tab-r"><span class="tab-text">Menu Assignment</span></span></span>';
	assign_tab.injectBefore($$('li.tabs-title').getLast());

	var assign_item = new Element('div',{"class":"tabs-item"});
	$$('.adminform legend')[1].dispose();//remove legend
	assign_item.innerHTML = $$('.adminform')[1].innerHTML;
	assign_item.injectBefore($$('.tabs-item').getLast());

	//Help and Update Tab
	var update_tab = new Element('li',{"class":"tabs-title","id":"cg-help-update"});
	update_tab.innerHTML = '<span class="tab-l"><span class="tab-r"><span class="tab-text">Help &amp; Update</span></span></span>';
	update_tab.injectAfter($$('li.tabs-title').getLast());
	
	var update_item = new Element('div',{"class":"tabs-item"});
	update_item.innerHTML = '<div id="cg_update_div"><fieldset class="panelform"><ul class="adminformlist"><li><label>Updates : </label><fieldset style="text-align:center"><span id="cg_spinner">&nbsp;</span>Loading update data...</fieldset></li></ul></fieldset></div>';
	update_item.injectAfter($$('.tabs-item').getLast());

	document.id('cg-help-update').addEvent("click", function(){//update function
		new Asset.javascript(update_url,{
	   		onload: function(){
				if (cur_version<cgrocket_version) {
					document.id('cg_update_div').empty().innerHTML = '<fieldset class="panelform"><ul class="adminformlist"><li><label>Updates : </label><fieldset><p>cgrocket version ' + cgrocket_version + ' is available. <a target="_blank" href="' + cgrocket_link + '">Click here</a> to download.</p></fieldset></li><li><label>Live Help : </label><fieldset><p>' + help_text + '</p></fieldset></li></ul></fieldset>';
				} else {
					document.id('cg_update_div').empty().innerHTML = '<fieldset class="panelform"><ul class="adminformlist"><li><label>Updates : </label><fieldset><p>You are using latest version of cgrocket Framework.</p></fieldset></li><li><label>Live Help : </label><fieldset><p>' + help_text + '</p></fieldset></li></ul></fieldset>';				
				}	
	   		}
		});		
	});	
	
	document.getElement('.pane-sliders').getParent().dispose();//remove slider-pan
	
	//Template Description area
	var desc = new Element('div',{"class":"cgrocket-desc"});
	desc.innerHTML = document.getElement('.cg-template-desc').innerHTML;
	desc.injectInside(cgrocket_inner);
	
	var clear = new Element('div',{"class":"clr"});
	clear.injectAfter(document.getElement('.cgrocket-desc'));	
	
	//remove all parent tables
	var admin_details=document.getElement('.adminformlist');
	admin_details.getParent().getParent().removeClass('width-60 fltlft').addClass('cgrocket-details');
	
	document.getElement('.cg-template-desc').dispose();
	$$('.adminform')[1].getParent().dispose();
	
	//since 1.9.1
	var empty1 = document.id('jform_params___field10-lbl');
	var empty2 = document.id('jform_params___field11-lbl');
	if (empty1) empty1.getParent().dispose();
	if (empty2) empty2.getParent().dispose();
	
});


var cgrocketTab = new Class({//Based on jTabs
	getOptions: function(){
		return {

			display: 0,
			
			onActive: function(title, description){
				description.fade('in');
				description.setStyle('display', 'block');
				title.addClass('open').removeClass('closed');
			},

			onBackground: function(title, description){
				description.fade('out');
				description.setStyle('display', 'none');
				title.addClass('closed').removeClass('open');
			}

		};
	},

	initialize: function(options){
		this.setOptions(this.getOptions(), options);
		this.titles = document.getElements('ul.cgrocket-tabs li.tabs-title');//
		this.descriptions = document.getElements('.cgrocket-panel .tabs-item');//
		
		for (var i = 0, l = this.titles.length; i < l; i++){
			var title = this.titles[i];
			var description = this.descriptions[i];
			title.setStyle('cursor', 'pointer');
			title.addEvent('click', this.display.bind(this, i));
		}

		if ($chk(this.options.display)) this.display(this.options.display);

		if (this.options.initialize) this.options.initialize.call(this);
	},

	hideAllBut: function(but){
		for (var i = 0, l = this.titles.length; i < l; i++){
			if (i != but) this.fireEvent('onBackground', [this.titles[i], this.descriptions[i]])
		}
	},

	display: function(i){
		this.hideAllBut(i);
		this.fireEvent('onActive', [this.titles[i], this.descriptions[i]])
	}
});

cgrocketTab.implement(new Events);
cgrocketTab.implement(new Options);

window.addEvent("domready",function(){ 
	new cgrocketTab(); 
});
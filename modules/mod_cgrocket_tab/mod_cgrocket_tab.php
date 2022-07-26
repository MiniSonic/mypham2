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

JHtml::_('behavior.framework', true);
$uniqid				= $module->id;
$body_height    	= $params->get('body_height','1') ? 'true' : 'false';
$fixed_height		= $params->get('fixed_height','300');
$fxspeed			= $params->get('fx_speed','400');
$activator			= $params->get('activator','click');
$btnPos				= $params->get('nav_pos','top');
$body_padding		= $params->get('body_padding','10px');
$animation			= $params->get('animation','scroll:horizontal');
$transition			= $params->get('transition','linear');
$height				= $params->get('nav_height',30);
$style				= $params->get('style','style1');
$color				= $params->get('color','cgrocket_tab_blue');

//Custom Style
$header_bg 			= $params->get('header_bg');
$nav_bg 			= $params->get('nav_bg');
$nav_text 			= $params->get('nav_text');
$nav_hover			= $params->get('nav_hover');
$nav_hover_text		= $params->get('nav_hover_text');
$nav_active			= $params->get('nav_active');
$nav_active_text	= $params->get('nav_active_text');
$nav_border_color	= $params->get('nav_border_color');
$nav_border_pos		= $params->get('nav_border_pos');
$nav_wborder		= $params->get('nav_wborder');
$nav_margin			= $params->get('nav_margin');
$nav_margin_val		= $params->get('nav_margin_val');
$body_bg			= $params->get('body_bg');
$body_text			= $params->get('body_text');
$border_color		= $params->get('border_color');
$body_wborder		= $params->get('body_wborder');

$document = JFactory::getDocument();
$document->addScript(JURI::base(true) . '/modules/mod_cgrocket_tab/assets/js/cgrocket_tab.js');//Load javascript
$document->addStylesheet(JURI::base(true) . '/modules/mod_cgrocket_tab/assets/css/' . $style . '.css.php?id=' .$uniqid);//Load css

$css = '';
$css 		.= '#cgrocket_tab' . $uniqid . ' .tabs_mask, #cgrocket_tab' . $uniqid . ' ul.tabs_container li span {height:' . $height . 'px;line-height:' . $height . 'px;}';
$css 	 	.= '#cgrocket_tab' . $uniqid . ' .tab-padding {padding:' . $body_padding . '}';

if ($style=='custom') {
	$css 	.= '#cgrocket_tab' . $uniqid . ' .tabs_mask {background-color:' . $header_bg . '}';
	$css	.= '#cgrocket_tab' . $uniqid . ' ul.tabs_container li.tab {background-color:' . $nav_bg . '; color:' . $nav_text . '; margin-' . $nav_margin . ':' . $nav_margin_val . 'px; border-' . $nav_border_pos . ':' . $nav_wborder . 'px solid ' . $nav_border_color . ';}';
	$css 	.= '#cgrocket_tab' . $uniqid . ' ul.tabs_container li.tab.tab_over {background-color:' . $nav_hover . '; color:' . $nav_hover_text . '}';
	$css 	.= '#cgrocket_tab' . $uniqid . ' ul.tabs_container li.tab.active {background-color:' . $nav_active . '; color:' . $nav_active_text . '}';
	$css 	.= '#cgrocket_tab' . $uniqid . ' {background-color:' . $body_bg . '; color:' . $body_text . '; border:' . $body_wborder . 'px solid ' . $border_color . '}';
}

$document->addStyleDeclaration($css);

require_once (dirname(__FILE__).DS.'helper.php');
$list = modcgrocket_tabHelper::getTabs($params);
require(JModuleHelper::getLayoutPath('mod_cgrocket_tab'));
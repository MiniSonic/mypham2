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

    defined('_JEXEC') or die('Restricted access');
    error_reporting(E_ALL & ~E_NOTICE);    
    if( !defined('PhpThumbFactoryLoaded') ) {
	require_once dirname(__FILE__).DS.'libs'.DS.'phpthumb'.DS.'ThumbLib.inc.php';
		define('PhpThumbFactoryLoaded',1);
	}
    if (!file_exists(JPATH_SITE.DS.'components'.DS.'com_virtuemart'.DS.'virtuemart.php')){
        JError::raiseError(500,"Please install component \"virtuemart\"");
    }
	if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'config.php');
	$config= VmConfig::loadConfig();
	if (!class_exists( 'VirtueMartModelVendor' )) require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'vendor.php');
	if(!class_exists('TableMedias')) require(JPATH_VM_ADMINISTRATOR.DS.'tables'.DS.'medias.php');
	if(!class_exists('TableCategories')) require(JPATH_VM_ADMINISTRATOR.DS.'tables'.DS.'categories.php');
	if (!class_exists( 'VirtueMartModelCategory' )) require(JPATH_VM_ADMINISTRATOR.DS.'models'.DS.'category.php');
    require_once (dirname(__FILE__).DS.'helper.php');

    $mainframe = &JFactory::getApplication();
	$document =& JFactory::getDocument();
	$tPath = JPATH_BASE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.$module->module.DS.'assets'.DS.'style.css';
	if( file_exists($tPath) ){
		JHTML::stylesheet( 'templates/'.$mainframe->getTemplate().'/html/'.$module->module.'/assets/style.css');
	}else{
		$document->addStyleSheet(JURI::base().'modules/mod_vmcategoriespro/assets/style.css');
	}

    $lang = &JFactory::getLanguage();
    
    JTable::addIncludePath(JPATH_VM_ADMINISTRATOR.DS.'tables');
    
    $field_sort = $params->get('sort', 'id');
    $ordering 	= $params->get('ordering', 'asc');
    $show_image = $params->get('show_image',0);
    $categories = vmCategoryHelper::getHtml($field_sort, $ordering,1, $params);
    require(JModuleHelper::getLayoutPath('mod_vmcategoriespro'));
?>
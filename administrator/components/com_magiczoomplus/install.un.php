<?php

/*------------------------------------------------------------------------
# mod_virtuemart_magiczoomplus - Magic Zoom Plus for Joomla with VirtueMart
# ------------------------------------------------------------------------
# Magic Toolbox
# Copyright 2011 MagicToolbox.com. All Rights Reserved.
# @license - http://www.opensource.org/licenses/artistic-license-2.0  Artistic License 2.0 (GPL compatible)
# Website: http://www.magictoolbox.com/magiczoomplus/modules/virtuemart/
# Technical Support: http://www.magictoolbox.com/contact/
/*-------------------------------------------------------------------------*/

if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

include_once 'init.php';

isset($INSTALLMODE) or $INSTALLMODE = '';

$msg = array();

//Import joomla libraries
mz_jimport('joomla.filesystem.file');
mz_jimport('joomla.filesystem.folder');
mz_jimport('joomla.filesystem.archive');

if(class_exists('joomlaVersion')) {
    //old joomla, 1.0.x
    $versionObj = new joomlaVersion();
} elseif(class_exists('JVersion')) {
    $versionObj = new JVersion();
}
if(version_compare($versionObj->getShortVersion(), '1.6.0', '<')) {
    $jm17 = false;
} else {
    $jm17 = true;
}

$vm2 = false;
$vmVersionFile = dirname(__FILE__).DS.'..'.DS.'com_virtuemart'.DS.'version.php';
if(file_exists($vmVersionFile)) {
    include_once $vmVersionFile;
    $vmVersion = preg_replace('/^[a-zA-Z]+\s(\d(?:\.\d)*).*$/is', '$1', $shortversion);
    if(version_compare($vmVersion, '2.0.0', '>=')) {
        $vm2 = true;
    }
}

switch ($INSTALLMODE) {
    case 'install':

        $prepare_queries = array();
        $create_table_queries = array();
        $alter_table_queries = array();
        $sample_data_insert = array();
        $end_queries = array();

        //Magic Zoom Plus frontend module installation

        function mz_copyModuleFiles($from, $to) {
            JFolder::copy($from, $to);
            if(!defined('_JEXEC')) {
                // jm 1.0
                JFile::move($to . DS . 'mod_virtuemart_magiczoomplus.php', $to . DS.'..'.DS.'mod_virtuemart_magiczoomplus.php');
                JFile::move($to . DS . 'mod_virtuemart_magiczoomplus_10.xml', $to . DS.'..'.DS.'mod_virtuemart_magiczoomplus.xml');
                JFile::delete($to . DS . 'mod_virtuemart_magiczoomplus.xml');
                $url = $GLOBALS['mosConfig_live_site'] . '/modules/mod_virtuemart_magiczoomplus/core';
            } else {
                //JFile::delete($to . DS . 'mod_virtuemart_magiczoomplus_10.xml');
                //$url = JURI::base() . '/modules/mod_virtuemart_magiczoomplus/core';
                $url = JURI::base() . 'modules/mod_virtuemart_magiczoomplus/core';
            }

            $css = $to . DS . 'core' . DS . 'magiczoomplus.css';
            $c = file_get_contents($css);
            $url = preg_replace('/https?:\/\/[^\/]+\//is', '/', $url);
            $url = str_replace('administrator/', '', $url);
            $url = str_replace('//', '/', $url);
            $pattern = '/url\(\s*(?:\'|")?(?!'.preg_quote($url, '/').')\/?([^\)\s]+?)(?:\'|")?\s*\)/is';
            $replace = 'url(' . $url . '/$1)';
            $c = preg_replace($pattern, $replace, $c);
            file_put_contents($css, $c);

            return true;
        }


        $mz_modDstPath = join(DS,array(dirname(__FILE__),'..','..','..','modules','mod_virtuemart_magiczoomplus'));
        $mz_modFile = join(DS,array(dirname(__FILE__),'module'));

        $mz_clean = array($mz_modDstPath);

        if(!defined('_JEXEC')) {
            $mz_clean = array(
                    $mz_modDstPath,
                    $mz_modDstPath.DS.'..'.DS.'mod_virtuemart_magiczoomplus.php',
                    $mz_modDstPath.DS.'..'.DS.'mod_virtuemart_magiczoomplus.xml',
            );
        }

        //clean folders and file of previous installation
        foreach($mz_clean as $delFile) {
            if(file_exists($delFile)){
                if(is_file($delFile)){
                    JFile::delete($delFile);
                } else
                if(is_dir($delFile)){
                    JFolder::delete($delFile);
                }
            }
        }

        $prepare_queries[] = 'SET FOREIGN_KEY_CHECKS=0';
        $prepare_queries[] = 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"';

        $prepare_queries[] = 'DROP TABLE IF EXISTS `#__virtuemart_magiczoomplus_config`';
        $prepare_queries[] = 'DROP TABLE IF EXISTS `#__virtuemart_mz_product_files`';
        $prepare_queries[] = 'DROP TABLE IF EXISTS `#__virtuemart_mz_product_hotspots`';

        //if(JArchive::extract($mz_modFile,$mz_modDstPath)) {
        if(mz_copyModuleFiles($mz_modFile,$mz_modDstPath)) {
            $msg[]='Magic Zoom Plus v4.4.43 [v1.2.17:v4.0.25] frontend module installed successfuly';

            $prepare_queries[] = 'DELETE FROM `#__modules_menu` WHERE `moduleid` = (SELECT id FROM `#__modules` WHERE `module` = \'mod_virtuemart_magiczoomplus\')';
            $prepare_queries[] = 'DELETE FROM `#__modules` WHERE `module` = \'mod_virtuemart_magiczoomplus\'';

            $sample_data_insert[] = 'INSERT INTO `#__extensions` (`name`, `type`, `element`, `folder`, `enabled`, `protected`, `access`, `client_id`, `params`) VALUES
            (\'Magic Zoom Plus v4.4.43 [v1.2.17:v4.0.25] module for Joomla with VirtueMart\', \'module\', \'mod_virtuemart_magiczoomplus\', \'\', 1, 0, 0, 0, \'\')';

            $sample_data_insert[] = 'INSERT INTO `#__modules` (`title`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `published`, `module`, `access`, `showtitle`, `params`, `client_id`) VALUES
            (\'Magic Zoom Plus v4.4.43 [v1.2.17:v4.0.25] module for Joomla with VirtueMart\', \'\', 0, \'' . ( $jm17 ? 'position-3' : 'left') . '\', 0, NOW(), 1, \'mod_virtuemart_magiczoomplus\', 1, 0, \'\', 0)';

            $sample_data_insert[] = 'INSERT INTO `#__modules_menu` (`moduleid`, `menuid`) VALUES (LAST_INSERT_ID(),0)';

        } else {
            $msg[]="Error installing Magic Zoom Plus v4.4.43 [v1.2.17:v4.0.25] frontend module. Please try to install it manualy ($mz_modFile)";
        }

        //End of Magic Zoom Plus frontend module installation

        //End

        $prepare_queries[] = 'SET FOREIGN_KEY_CHECKS=0';
        $prepare_queries[] = 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"';

        $create_table_queries[] = 'CREATE TABLE IF NOT EXISTS `#__virtuemart_magiczoomplus_config` (
          `id` int(11) NOT NULL auto_increment COMMENT \'default profile should have id = 1\',
          `profile` varchar(32) character set utf8 NOT NULL,
          `config` text character set utf8 NOT NULL,
          PRIMARY KEY  (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0';

        $create_table_queries[] = 'CREATE TABLE IF NOT EXISTS `#__virtuemart_mz_product_files` (
          `file_id` int(11) NOT NULL,
          `is_alternate` tinyint(1) NOT NULL,
          `advanced_option` varchar(1023) NOT NULL,
          PRIMARY KEY  (`file_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8';

        $create_table_queries[] = 'CREATE TABLE IF NOT EXISTS `#__virtuemart_mz_product_hotspots` (
          `id` int(11) NOT NULL auto_increment,
          `product_id` int(11) NOT NULL,
          `file_id` int(19) default NULL,
          `linked_file_id` int(19) default NULL,
          `mode` varchar(32) character set utf8 NOT NULL,
          `x1` decimal(4,4) NOT NULL,
          `y1` decimal(4,4) NOT NULL,
          `x2` decimal(4,4) NOT NULL,
          `y2` decimal(4,4) NOT NULL,
          `option` varchar(256) character set utf8 default NULL,
          `active` tinyint(1) NOT NULL default 0,
          PRIMARY KEY  (`id`),
          KEY `file_id` (`file_id`),
          KEY `linked_file_id` (`linked_file_id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ';

        $alter_table_queries[] = 'ALTER TABLE `#__virtuemart_mz_product_hotspots`
          ADD CONSTRAINT `#__virtuemart_mz_product_hotspots_ibfk_2` FOREIGN KEY (`file_id`) REFERENCES `#__virtuemart_mz_product_files` (`file_id`) ON DELETE CASCADE ON UPDATE CASCADE,
          ADD CONSTRAINT `#__virtuemart_mz_product_hotspots_ibfk_1` FOREIGN KEY (`linked_file_id`) REFERENCES `#__virtuemart_mz_product_files` (`file_id`) ON DELETE CASCADE ON UPDATE CASCADE';

        $sample_data_insert[] = "INSERT IGNORE INTO `#__virtuemart_magiczoomplus_config` (`id`, `profile`, `config`) VALUES
        (1, 'default', ''),
        (2, 'browse', 'show-message:No;zoom-position:inner;click-to-activate:true;message:Click to zoom;multiple-images:No'),
        (3, 'details', 'enable-effect:Zoom & Expand;'),
        (4, 'latest', 'show-message:No;opacity-reverse:true;use-original-vm-thumbnails:Yes'),
        (5, 'featured', 'show-message:No;opacity-reverse:true;use-original-vm-thumbnails:Yes'),
        (6, 'random', 'show-message:No;opacity-reverse:true;use-original-vm-thumbnails:Yes'),
        (7, 'custom', '')";

        $end_queries[] = 'SET FOREIGN_KEY_CHECKS=1';

        $queries = array_merge($prepare_queries,$create_table_queries,$alter_table_queries,$sample_data_insert,$end_queries);

        $db = JFactory::getDBO();
        foreach($queries as $q) {
            $db->setQuery($q);
            $db->query();
        }

        JFile::move(__FILE__, dirname(__FILE__).DS.'install.un.php');
        if(defined('_JEXEC')) {
            JFile::move(dirname(__FILE__).DS.'magiczoomplus_10.xml', dirname(__FILE__).DS.'magiczoomplus_10_xml.back');
        }

        echo "<h2>Magic Zoom Plus component installed successfully.</h2>";
        echo '<p>'.join("</p><p>",$msg).'</p>';
        echo "<h2>Press F5 to refresh the page.</h2>";
        break;

    case 'uninstall';
        $tables = array('mz_product_hotspots','mz_product_files','magiczoomplus_config');
        //if VirtueMart is still installed using their DB class
        if(class_exists('ps_DB')) {
            $db = new ps_DB;
            $dbvmprefix = '#__virtuemart';
            $dbprefix = '#__';

        } else if(class_exists('JFactory')) {
            //if Joomla 1.5
            $db = JFactory::getDBO();
            $CONFIG = new JConfig();
            if($vm2) {
                $dbvmprefix = $CONFIG->dbprefix.'virtuemart';
            } else {
                $dbvmprefix = $CONFIG->dbprefix.'vm';
            }
            $dbprefix = $CONFIG->dbprefix;

        } else {
            //if Joomla 1.0.x
            global $database, $mosConfig_dbprefix;

            $db = $database;
            $dbvmprefix = $mosConfig_dbprefix.'vm';
            $dbprefix = $mosConfig_dbprefix;
        }

        foreach($tables as $t) {
            $db->setQuery( "DROP TABLE `{$dbvmprefix}_{$t}`;" );
            $db->query();
        }

        $db->setQuery("SELECT id FROM `{$dbprefix}modules` WHERE `module` = 'mod_virtuemart_magiczoomplus'");
        $db->query();

        $module_id = $db->loadResult();

        $db->setQuery("SELECT extension_id FROM `{$dbprefix}extensions` WHERE `element` = 'mod_virtuemart_magiczoomplus'");
        $db->query();

        $element_id = $db->loadResult();

        $mz_modDstPath = join(DS,array(dirname(__FILE__),'..','..','..','modules','mod_virtuemart_magiczoomplus'));
        if($module_id && JFolder::delete($mz_modDstPath)) {

            $db->setQuery("DELETE FROM `{$dbprefix}modules` WHERE `id` = $module_id");
            $db->query();
            $db->setQuery("DELETE FROM `{$dbprefix}extensions` WHERE `extension_id` = $element_id");
            $db->query();
            //$db->setQuery("SELECT id FROM `{$dbprefix}modules_menu` WHERE `moduleid` = $module_id");
            $db->setQuery("DELETE FROM `{$dbprefix}modules_menu` WHERE `moduleid` = $module_id");
            $db->query();

            echo "<h2>Magic Zoom Plus component uninstalled. Frontend module removed</h2>";
        } else {
            echo "<h2>Magic Zoom Plus component uninstalled, please uninstall 'Magic Zoom Plus' module manualy.</h2>";
        }

        break;
    default:
        echo "<h2>Installation mode is not set. Nothing done.</h2>";
        break;
}

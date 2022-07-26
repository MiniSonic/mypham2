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

$msg = 'Wrong data!';
if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
    $db = JFactory::getDBO();

    switch ($action) {
        case 'save':
            if(isset($_REQUEST['profileId']) && isset($_REQUEST['config'])){

                require_once dirname(__FILE__).'/../../../modules/mod_virtuemart_magiczoomplus/magiczoomplus.module.core.class.php';
                $magictoolClass = 'MagicZoomPlusModuleCoreClass';
                $tool = new $magictoolClass;

                $profileId = intval($_REQUEST['profileId']);

                if($profileId != 1) {
                    $profiles = JFactory::getDBO();
                    $profiles->setQuery("SELECT * FROM #__virtuemart_magiczoomplus_config WHERE id = 1");
                    $profiles->query();

                    $profiles = $profiles->loadObjectList();
                    for($i = 0; $i < count($profiles); $i++) {
                        $profile = $profiles[$i];
                        $tool->params->unserialize($profile->config, $profile->profile);
                    }
                }

                $config = array();
                foreach($_REQUEST['config'] as $k => $v) {
                    if(!$tool->params->check($k, $v)) {
                        $config[$k] = $v;
                    }
                }

                $config = $db->getEscaped(mz_serializeProfile($config));

                $query = "UPDATE #__virtuemart_magiczoomplus_config profile SET config = '$config' WHERE id = $profileId";

                $db->setQuery($query);
                $db->query();
                $msg = 'Changes saved!';
            }
            break;
    }
}

mz_redirect($_SERVER['HTTP_REFERER'],$msg);
?>

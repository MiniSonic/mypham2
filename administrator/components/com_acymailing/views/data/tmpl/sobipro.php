<?php
/**
 * @copyright	Copyright (C) 2009-2012 ACYBA SARL - All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php
	$db = JFactory::getDBO();
	$query = 'SELECT fid FROM #__sobipro_field WHERE nid LIKE "field_email"';
	$db->setQuery($query);
	$fid = $db->loadResult();
	$db->setQuery("SELECT  count(DISTINCT baseData) FROM `yix5a_sobipro_field_data` as a WHERE baseData LIKE '%@%' AND `fid` = ".$fid);
	$resultUsers = $db->loadResult();
	echo JText::sprintf('USERS_IN_COMP',$resultUsers,'Sobipro');
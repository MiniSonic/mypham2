<?php
/*---------------------------------------------------------------
# Package - Module CGrocket Tab by CGrocket.com 
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2011 - 2012 Cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com - http://www.leweb2.com
-----------------------------------------------------------------*/

header("Content-Type: text/css");
$uniqid = $_GET['id'];
?>
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container {list-style:none;margin: 0!important; padding: 0!important}
#cgrocket_tab<?php echo $uniqid ?> .tabs_buttons{overflow:hidden}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab{background-image:none;float:left;cursor:pointer;padding:0 10px;margin:0}
#cgrocket_tab<?php echo $uniqid ?> .items_mask {position:relative;overflow:hidden}
#cgrocket_tab<?php echo $uniqid ?> .tab-padding {padding:10px}
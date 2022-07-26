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
#cgrocket_tab<?php echo $uniqid ?> .tabs_buttons{background:#000 url(../images/style4/header_bg.gif) repeat-x 0 0;overflow:hidden}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab{background:none;color:#999;float:left;padding:0;margin:0;border:0!important;border-right:1px solid #333!important}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab span{display:inline-block;cursor:pointer;padding:0 10px;margin:0;font-weight:700}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab, #cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab span{font-size:12px}
#cgrocket_tab<?php echo $uniqid ?> .items_mask {position:relative;overflow:hidden;color:#fff}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab.active{color:#fff}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_red .items_mask{background:#a30d0b}
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_red ul.tabs_container li.tab.active span{background:#a30d0b url(../images/style4/tab-red-active.png) repeat-x 0 0}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_green .items_mask{background:#90a80a}
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_green ul.tabs_container li.tab.active span{background:#90a80a url(../images/style4/tab-green-active.png) repeat-x 0 0}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_blue .items_mask{background:#0EA5DE}
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_blue ul.tabs_container li.tab.active span{background:#0EA5DE url(../images/style4/tab-blue-active.png) repeat-x 0 0}
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
#cgrocket_tab<?php echo $uniqid ?> .tabs_mask {border-bottom:1px solid #ddd;padding:0 10px 5px 10px}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab{background:#ececec url(../images/style6/nav-bg.png) repeat-x 0 0;border-top:5px solid #ddd; border-left:1px solid #e0e0e0; border-right:1px solid #e0e0e0; border-bottom:1px solid #e0e0e0;color:#666;float:left;line-height:30px;cursor:pointer;padding:0 10px;margin:0 5px 0 0;font-weight:bold; -moz-border-radius:5px 5px 0 0; -webkit-border-radius:5px 5px 0 0; border-radius:5px 5px 0 0}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab.tab_over,#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab.active{background:#fff;color:#000; border-bottom:1px solid #fff}
#cgrocket_tab<?php echo $uniqid ?> .items_mask {position:relative;overflow:hidden}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_red ul.tabs_container li.tab.tab_over,
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_red ul.tabs_container li.tab.active{border-top:5px solid #ba0202}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_green ul.tabs_container li.tab.tab_over,
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_green ul.tabs_container li.tab.active{border-top:5px solid #91ba02;}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_blue ul.tabs_container li.tab.tab_over,
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_blue ul.tabs_container li.tab.active{border-top:5px solid #01b0e2;}
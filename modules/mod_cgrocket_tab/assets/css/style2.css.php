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
#cgrocket_tab<?php echo $uniqid ?> .tabs_buttons{background:#fff url(../images/style2/header_bg.gif) repeat-x 0 100%;padding:0 10px;overflow:hidden}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab{background:url(../images/style2/tab-l.png) no-repeat 0 100%;color:#666;float:left;padding:0 0 0 10px;margin:0;border:0!important;}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab span{background:url(../images/style2/tab-r.png) no-repeat 100% 100%;display:inline-block;cursor:pointer;padding:0 10px 0 0;margin:0 5px 0 0;font-weight:700;text-transform:uppercase}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab, #cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab span{font-size:12px}
#cgrocket_tab<?php echo $uniqid ?> .items_mask {position:relative;overflow:hidden}

#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab.active{background:url(../images/style2/tab-active-l.png) no-repeat 0 100%}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab.active span{background:url(../images/style2/tab-active-r.png) no-repeat 100% 100%}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_red ul.tabs_container li.tab.tab_over,
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_red ul.tabs_container li.tab.active{color:#ba0202}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_green ul.tabs_container li.tab.tab_over,
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_green ul.tabs_container li.tab.active{color:#91ba02}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_blue ul.tabs_container li.tab.tab_over,
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_blue ul.tabs_container li.tab.active{color:#01b0e2}
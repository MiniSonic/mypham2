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
#cgrocket_tab<?php echo $uniqid ?> .tabs_buttons{padding:0 10px;overflow:hidden}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab{background:url(../images/style3/tab-l.png) no-repeat 0 100%;color:#666;float:left;padding:0 0 0 5px;margin:0;border:0!important;}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab span{background:url(../images/style3/tab-r.png) no-repeat 100% 100%;display:inline-block;cursor:pointer;padding:0 10px 0 5px;margin:0 5px 0 0;font-weight:700}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab, #cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab span{font-size:12px}
#cgrocket_tab<?php echo $uniqid ?> .items_mask {position:relative;overflow:hidden}
#cgrocket_tab<?php echo $uniqid ?> ul.tabs_container li.tab.active{color:#fff}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_red .tabs_buttons{border-bottom:4px solid #a30d0b}
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_red ul.tabs_container li.tab.active{background:url(../images/style3/tab-red-active-l.png) no-repeat 0 100%}
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_red ul.tabs_container li.tab.active span{background:url(../images/style3/tab-red-active-r.png) no-repeat 100% 100%}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_green .tabs_buttons{border-bottom:4px solid #90a80a}
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_green ul.tabs_container li.tab.active{background:url(../images/style3/tab-green-active-l.png) no-repeat 0 100%}
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_green ul.tabs_container li.tab.active span{background:url(../images/style3/tab-green-active-r.png) no-repeat 100% 100%}

#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_blue .tabs_buttons{border-bottom:4px solid #0EA5DE}
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_blue ul.tabs_container li.tab.active{background:url(../images/style3/tab-blue-active-l.png) no-repeat 0 100%}
#cgrocket_tab<?php echo $uniqid ?>.cgrocket_tab_blue ul.tabs_container li.tab.active span{background:url(../images/style3/tab-blue-active-r.png) no-repeat 100% 100%}

<?php
/*---------------------------------------------------------------
# Package - Joomla Template based on CGrocket Framework    
# ---------------------------------------------------------------
# Author - CGrocket http://www.cgrocket.com
# Copyright (C) 2012 cgrocket.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# Websites: http://www.cgrocket.com
-----------------------------------------------------------------*/

// set document type as text/javascript	
header('Content-type: text/css; charset: UTF-8');
header('Cache-Control: must-revalidate');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
$url = $_REQUEST['url'].'/css/PIE/pie.php';
?>
.mod-wrapper,
.module_none .mod-wrapper .mod-content,
.mod-wrapper h3.header,
div.pagination ul li a,div.pagination p.counter,
.mod-wrapper .mod-content,.module_menu .mod-wrapper li:last-child,
#hornav ul.level-0 > li.menu-item:hover > a.menu-item,
.cg_news_higlighter,.cg-nh-item,.cg_date,
ul.userlinks,
a.readmore,
a.cg-slide-morein,
.adminform button,
#adminForm button,
.button,button[type=submit],
input[type=submit],
input[type=button]
{position:relative;behavior: url(<?php echo $url; ?>)}
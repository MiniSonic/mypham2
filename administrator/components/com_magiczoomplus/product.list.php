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

$vm202 = false;
$vmVersionFile = dirname(__FILE__).DS.'..'.DS.'com_virtuemart'.DS.'version.php';
//$vmVersionFile = JPATH_COMPONENT_ADMINISTRATOR.DS.'..'.DS.'com_virtuemart'.DS.'version.php';
if(file_exists($vmVersionFile)) {
    include_once $vmVersionFile;
    $vmVersion = preg_replace('/^[a-zA-Z]+\s(\d(?:\.\d)*).*$/is', '$1', $shortversion);
    if(version_compare($vmVersion, '2.0.2', '>=')) {
        $vm202 = true;
    }
}

echo mz_inlineCss();
?>
<h2>VirtueMart products</h2>
<?php

$cats = mz_categoryList(mz_get('category'),array('name'=>'category'));

$products = JFactory::getDbo();

$from = max(array(0,floor(mz_get('from')/MZ_PER_PAGE)*MZ_PER_PAGE));

$limit = ' LIMIT '.$from.','.MZ_PER_PAGE;

$q = array();

if($vm202) {
    $t = 'l';
} else {
    $t = 'p';
}

$what = "c.virtuemart_category_id,
         m.file_url_thumb as thumb,
         m.file_url as image,
         p.virtuemart_product_id as id,
         {$t}.product_name as name,
         {$t}.product_s_desc as description,
         t_temp.images_count as images_count";

$q[] = "SELECT -WHAT-";
$q[] = "FROM #__virtuemart_products AS p
    LEFT JOIN #__virtuemart_product_medias AS pm ON p.virtuemart_product_id = pm.virtuemart_product_id

    JOIN (SELECT p_temp.virtuemart_product_id, MIN(pm_temp.ordering) AS min_ordering, COUNT(pm_temp.virtuemart_media_id) AS images_count
    FROM #__virtuemart_products AS p_temp
    JOIN #__virtuemart_product_medias AS pm_temp ON p_temp.virtuemart_product_id = pm_temp.virtuemart_product_id
    GROUP BY p_temp.virtuemart_product_id) AS t_temp
    ON p.virtuemart_product_id = t_temp.virtuemart_product_id AND pm.ordering = t_temp.min_ordering

    LEFT JOIN #__virtuemart_medias AS m ON pm.virtuemart_media_id = m.virtuemart_media_id
    LEFT JOIN #__virtuemart_product_categories AS c ON p.virtuemart_product_id = c.virtuemart_product_id";

if($vm202) {
    if(!defined('VMLANG')) {
        $params = JComponentHelper::getParams('com_languages');
        $siteLang = $params->get('site', 'en-GB');//use default joomla
        $siteLang = strtolower(strtr($siteLang,'-','_'));
        define('VMLANG', $siteLang);
    }
    $q[] = "LEFT JOIN #__virtuemart_products_".VMLANG." AS l ON p.virtuemart_product_id = l.virtuemart_product_id";
}

$w = array();
$w[] = "p.product_parent_id = 0";
mz_get('what') && $w[] = "p.product_name LIKE '%".$products->getEscaped(mz_get('what'))."%'";
mz_get('category') && $w[] = "c.virtuemart_category_id = ".intval(mz_get('category'));
$q[] = "WHERE ".join(' AND ',$w);
$q[] = "GROUP BY p.virtuemart_product_id";
$q = join(' ',$q);

$products->setQuery(str_replace('-WHAT-', 'count(p.virtuemart_product_id)', $q));
$products->query();

$count = $products->getNumRows();

$products->setQuery(str_replace('-WHAT-', $what, $q . $limit));
$products->query();

?>
<div class="actions">
    <form name="search">
        <input type="hidden" name="option" value="com_magiczoomplus"/>
        <input type="hidden" name="page" value="product.list"/>

        <label for="what">Search (name): </label>
            <input name="what" value="<?php echo mz_get('what')?>"/>
        <label for="category">Category: </label>
            <?php echo $cats; ?>
        <input type="submit" value="Go"/>
    </form>
    <a title="Useful, when you delete images or products. This deletes unneeded information from Magic Zoom Plus tables. It's done automaticaly every 24h."
       style="float:right; display: block; line-height: 10px; margin-top: -10px; color: silver" href="?option=com_magiczoomplus&page=product.cleanup&manual=true">Make some clean up</a>
</div>
<table class="adminlist">
<tr>
    <th class="title">
        ID
    </th>
    <th class="title">
        Image
    </th>
    <th class="title">
        Additional
    </th>
    <th class="title">
        Name
    </th>
    <th class="title">
        Description
    </th>

</tr>
    <?php
    $products = $products->loadObjectList();
    for($i = 0; $i < count($products); $i++) {
        $product = $products[$i];
        if ($product->thumb != ''){
            $imageUrl = mz_resolveImageUrl($product->thumb);
        } else
        if ($product->image != ''){
            $imageUrl = mz_resolveImageUrl($product->image);
        } else {
            $imageUrl = false;
        }
    ?>
        <tr class="row<?php echo $i%2?>">
            <td><?php echo $product->id;?></td>
            <td>
                <?php if($imageUrl) {?>
                    <img height="24" src='<?php echo $imageUrl;?>' alt="product image"/>
                <?php } else {?>
                    <i>No image</i>
                <?php }?>
            </td>
            <td>
                <?php if($imageUrl === false){ ?>
                    <i>Upload images for this product first</i><br/>
                <?php } else if($product->images_count > 1) {
                    $link = "index.php?option=com_magiczoomplus&page=product.alternates&id={$product->id}";
                    $text = "Edit alternates/hotspots";
                ?>
                    <b>
                        <?php echo ($product->images_count-1).' additional image'.($product->images_count>1?'s':'')?>
                        <br/>
                        <?php echo mz_popup_link( $link, $text, 800, 540, '_blank', $text, 'screenX=100,screenY=100' );?>
                    </b>
                <br/>
                <?php } else {
//                    $link = "index3.php?option=com_magiczoomplus&page=product.hotspots&id={$product->id}";
//                    $text = 'Edit hotspots';
//                    echo vmPopupLink( $link, $text, 800, 540, '_blank', $text, 'screenX=100,screenY=100' );
                    ?>
                    <i>Upload more images first</i>
                <br/>
                <?php
                }
                //$link = "index3.php?page=product.file_list&product_id={$product->id}&no_menu=1&option=com_virtuemart";
                $link = 'index.php?view=media&virtuemart_product_id=' . $product->id . '&no_menu=1&option=com_virtuemart';
                echo mz_popup_link( $link, "Manage files", 800, 540, '_blank', 'Upload additional images', 'screenX=100,screenY=100' );
                ?>
            </td>
            <td><?php echo $product->name;?></td>
            <td><?php echo $product->description;?></td>
        </tr>
    <?php }?>
</table>
<div>
    <?php echo mz_getPagination($count,$from);?>
</div>

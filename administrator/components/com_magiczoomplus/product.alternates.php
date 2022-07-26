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

//global $page, $mosConfig_live_site, $vm_mainframe;

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

$productId = intval($_GET['id']);

if($vm202) {
    $t = 'l';
} else {
    $t = 'p';
}

$product = JFactory::getDBO();

$q[]= "SELECT
    m.file_url_thumb as image,
    p.virtuemart_product_id as id,
    {$t}.product_name as name,
    {$t}.product_s_desc as productdesc,
    m.file_title,
    mz.*, m.virtuemart_media_id";
$q[]= "FROM #__virtuemart_products AS p
    LEFT JOIN #__virtuemart_product_medias AS pm ON p.virtuemart_product_id = pm.virtuemart_product_id
    LEFT JOIN #__virtuemart_medias AS m ON pm.virtuemart_media_id = m.virtuemart_media_id
    LEFT JOIN #__virtuemart_mz_product_files as mz ON mz.file_id = m.virtuemart_media_id";

if($vm202) {
    if(!defined('VMLANG')) {
        $params = JComponentHelper::getParams('com_languages');
        $siteLang = $params->get('site', 'en-GB');//use default joomla
        $siteLang = strtolower(strtr($siteLang,'-','_'));
        define('VMLANG', $siteLang);
    }
    $q[] = "LEFT JOIN #__virtuemart_products_".VMLANG." AS l ON p.virtuemart_product_id = l.virtuemart_product_id";
}

if($vm202) {
    $q[]= "WHERE p.virtuemart_product_id = $productId
        ORDER BY pm.ordering";
} else {
    $q[]= "WHERE p.virtuemart_product_id = $productId
        AND m.file_is_product_image = 1
        ORDER BY pm.ordering";
}

$product->setQuery(join(' ',$q));
$product->query();

if(!$product->getNumRows()){
    die('Have no alternates');
//    mz_redirect("index.php?page=product.file_list&product_id=$productId&no_menu=1&option=com_virtuemart");
}

$product = $product->loadObjectList();

//check if new images exist in vm database and create links in our base
$toInsert = array();
for($i = 0; $i < count($product); $i++) {
    $p = $product[$i];
    if($p->is_alternate === null){
        $toInsert[] = '('.$p->virtuemart_media_id.',1)';
        $p->is_alternate = '1';
    }
}
//-------------------------

$mImage =& $product[0];
$aImages =& $product;

$mImageUrl = mz_resolveImageUrl($mImage->image);
$mImagePath = mz_resolveImagePath($mImage->image);


$maxWidth = 300;
$maxHeight = 300;

if(extension_loaded('gd')){
    $mDimentions = getimagesize($mImagePath);

    if($mDimentions[0]>$maxWidth){
        $coef = $maxWidth/$mDimentions[0];
        $mDimentions[0]*=$coef;
        $mDimentions[1]*=$coef;
    }
    if($mDimentions[1]>$maxHeight){
        $coef = $maxHeight/$mDimentions[1];
        $mDimentions[0]*=$coef;
        $mDimentions[1]*=$coef;
    }
    $mDimentions[3] = 'width="'.$mDimentions[0].'" height="'.$mDimentions[1].'"';
} else {
    $mDimentions = array($maxWidth,$maxWidth,2,'width="'.$maxWidth.'" height="'.$maxHeight.'"',24,'image/jpeg');
}

//vmCommonHTML::loadExtjs();
?>
<style>
    h2 {
        font-size: 120%;
        margin: 0 0 10px 0;
    }
    .stretch {
        width: 95%;
    }
</style>


<div style="margin: 20px">

    <div style="background: #F9F9F9; padding: 20px">
        <div style="overflow: hidden;">
            <div style="float: left;">
                <?php
                    $link = "index.php?option=com_magiczoomplus&page=product.hotspots&id={$productId}&target={$product[0]->virtuemart_media_id}";
                    $text = "<img
                            src=\"".$mImageUrl."\"
                            alt=\"product image\"
                            $mDimentions[3]
                        />"
                    ?>
                <?php echo mz_popup_link( $link, $text, 800, 540, '_blank', 'Edit hotspots', 'screenX=120,screenY=120' );?>
            </div>
            <div style="float: left; margin: 10px; padding: 10px;">
                <h2><?php echo $mImage->name?></h2>
                <?php echo $mImage->productdesc?>
            </div>
        </div>
        <form name="alternates">
            <div style="margin: 20px 0">

                <h2>Alternates</h2>
                Select images that are alternates to the main image
                <table class="adminlist">
                    <tr>
                        <th class="title">Image</th>
                        <th class="title">Is alternate</th>
                        <th class="title">Advanced Zoom Options</th>
                        <th class="title">
                            <input type="button" onclick="document.forms.alternates.elements.action.value = 'savealternates';document.forms.alternates.submit()" value="Save"/>
                        </th>
                    </tr>
                <?php
                for($i = 0; $i < count($aImages); $i++) {
                    $im = $aImages[$i];
                    $link = "index.php?option=com_magiczoomplus&page=product.hotspots&id={$productId}&target={$im->virtuemart_media_id}";
                    //$image = mz_isUrl($im->file_name)?$im->file_name:$mosConfig_live_site.preg_replace('/\/([\w]+)(\.[\w]{2,4})$/ui',"/resized/$1_{$im->file_image_thumb_height}x{$im->file_image_thumb_width}$2",$im->file_name);
                    $text = "<img
                            src=\"".mz_resolveImageUrl($im->image)."\"
                            alt=\"$im->file_title\"
                            title=\"$im->name\"
                            height=\"64\"
                        />";
                    ?>

                    <tr class="row<?php echo $i%2?>">
                        <td>
                            <?php echo mz_popup_link( $link, $text, 800, 540, '_blank', 'Edit hotspots', 'screenX=120,screenY=120' );?>
                        </td>
                        <td>
                            <input type="checkbox" name="alts[<?php echo $im->file_id?>][checked]" <?php if($im->is_alternate != '0') echo 'checked';?>/>
                        </td>
                        <td colspan="2">
                            <input class="stretch" name="alts[<?php echo $im->file_id?>][advanced]" value="<?php echo $im->advanced_option?>">
                        </td>
                    </tr>
                <?php } ?>
                </table>
            </div>
            

            <input type="hidden" name="productId" value="<?php echo intval($_GET['id'])?>"/>
            <input type="hidden" name="action"/>
            <input type="hidden" name="option" value="com_magiczoomplus"/>
            <input type="hidden" name="page" value="product.save"/>
        </form>
    </div>
    
</div>
<?php
if(count($toInsert)){
    $iProduct = JFactory::getDBO();
    $query = 'INSERT INTO #__virtuemart_mz_product_files(file_id,is_alternate) VALUES'.join(',',$toInsert);
    $iProduct->setQuery($query);
    $iProduct->query();
    unset($iProduct);
}

?>

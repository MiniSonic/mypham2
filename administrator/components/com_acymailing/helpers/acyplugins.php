<?php
/**
 * @copyright	Copyright (C) 2009-2012 ACYBA SARL - All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php
class acypluginsHelper{
	function getFormattedResult($elements,$parameter){
		$beforeAll = array('table' => '<table cellspacing="0" cellpadding="0" border="0" width="100%" class="elementstable">');
		$beforeBlock = array('table' => '<tr class="elementstable_tr">');
		$beforeOne = array('table' => '<td valign="top" width="{equalwidth}" class="elementstable_td" >');
		$afterOne =  array('table' => '</td>'."\n");
		$afterBlock =  array('table' => '</tr>'."\n");
		$afterAll =  array('table' => '</table>'."\n");
		$type = 'table';
		$cols = 1;
		if(!empty($parameter->displaytype)) $type = $parameter->displaytype;
		if(!empty($parameter->cols)) $cols = $parameter->cols;
		$string = $beforeAll[$type];
		$a = 0;
		foreach($elements as $oneElement){
			if($a == $cols){
				$string .= $afterBlock[$type];
				$a = 0;
			}
			if($a == 0) $string .= $beforeBlock[$type];
			$string .= $beforeOne[$type].$oneElement.$afterOne[$type];
			$a++;
		}
		while($cols > $a){
			$string .= $beforeOne[$type].$afterOne[$type];
			$a++;
		}
		$string .= $afterBlock[$type];
		$string .= $afterAll[$type];
		$equalwidth = intval(100/$cols).'%';
		$string = str_replace(array('{equalwidth}'),array($equalwidth),$string);
		return $string;
	}
	function formatString(&$replaceme,$mytag){
		if(!empty($mytag->part)){
			$parts = explode(' ',$replaceme);
			if($mytag->part == 'last'){
				$replaceme = count($parts)>1 ? end($parts) : '';
			}else{
				$replaceme = reset($parts);
			}
		}
		if(!empty($mytag->type)){
			if(empty($mytag->format)) $mytag->format = JText::_('DATE_FORMAT_LC3');
			if($mytag->type == 'date'){
				$replaceme = acymailing_getDate(acymailing_getTime($replaceme),$mytag->format);
			}elseif($mytag->type == 'time'){
				$replaceme = acymailing_getDate($replaceme,$mytag->format);
			}
		}
		if(!empty($mytag->lower)) $replaceme = strtolower($replaceme);
		if(!empty($mytag->ucwords)) $replaceme = ucwords($replaceme);
		if(!empty($mytag->ucfirst)) $replaceme = ucfirst($replaceme);
		if(!empty($mytag->urlencode)) $replaceme = urlencode($replaceme);
		if(!empty($mytag->maxheight) || !empty($mytag->maxwidth)){
			$pictureHelper = acymailing_get('helper.acypict');
			$pictureHelper->maxHeight = empty($mytag->maxheight) ? 999 : $mytag->maxheight;
			$pictureHelper->maxWidth = empty($mytag->maxwidth) ? 999 : $mytag->maxwidth;
			$replaceme = $pictureHelper->resizePictures($replaceme);
		}
	}
	function removeJS($text){
		$text = preg_replace("#(onmouseout|onmouseover|onclick|onfocus|onload|onblur) *= *\"(?:(?!\").)*\"#iU",'',$text);
		$text =  preg_replace("#< *script(?:(?!< */ *script *>).)*< */ *script *>#isU",'',$text);
		return $text;
	}
	function cleanHtml(&$html){
		$pregreplace = array();
		$pregreplace['#<tr([^>"]*>([^<]*<td[^>]*>[ \n\s]*<img[^>]*>[ \n\s]*</ *td[^>]*>[ \n\s]*)*</ *tr)#Uis'] = '<tr style="line-height: 0px;" $1';
		$pregreplace['#<td(((?!style|>).)*>[ \n\s]*(<a[^>]*>)?[ \n\s]*<img[^>]*>[ \n\s]*(</a[^>]*>)?[ \n\s]*</ *td)#Uis'] = '<td style="line-height: 0px;" $1';
		$pregreplace['#<xml>.*</xml>#Uis'] = '';
		$newbody = preg_replace(array_keys($pregreplace),$pregreplace,$html);
		if(!empty($newbody)) $html = $newbody;
		if(preg_match_all('#<img[^>]*src=("data:image/([^;]{1,5});base64[^"]*")([^>]*)>#Uis',$html,$resultspictures)){
			jimport('joomla.filesystem.file');
			$dest = ACYMAILING_MEDIA.'resized'.DS;
			acymailing_createDir($dest);
			foreach($resultspictures[2] as $i => $extension){
				$pictname =  md5($resultspictures[1][$i]).'.'.$extension;
				$picturl = ACYMAILING_LIVE.'media/'.ACYMAILING_COMPONENT.'/resized/'.$pictname;
				$pictPath = $dest.$pictname;
				$pictCode = trim($resultspictures[1][$i],'"');
				if(file_exists($pictPath)){
					$html = str_replace($pictCode,$picturl,$html);
					continue;
				}
				$getfunction = '';
				switch($extension){
					case 'gif':
						$getfunction = 'ImageCreateFromGIF';
						break;
					case 'jpg':
					case 'jpeg':
						$getfunction = 'ImageCreateFromJPEG';
						break;
					case 'png':
						$getfunction = 'ImageCreateFromPNG';
						break;
				}
				if(empty($getfunction) || !function_exists($getfunction)) continue;
				$img = $getfunction($pictCode);
				ob_start();
				switch($extension){
					case 'gif':
						$status = imagegif($img);
						break;
					case 'jpg':
					case 'jpeg':
						$status = imagejpeg($img,null,100);
						break;
					case 'png':
						$status = imagepng($img,null,0);
						break;
				}
				$imageContent = ob_get_clean();
				$status = $status && JFile::write($pictPath,$imageContent);
				if(!$status) continue;
				$html = str_replace($pictCode,$picturl,$html);
			}
		}
	}
}

<?php
/**
 * @package     mod_bm_articles_defines
 * @author      brainymore.com
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$arr_bool = array(1=>"true", 0=>'false');
$scrollButtons = $arr_bool[$params->get('scrollButtons',1)];
$theme = $params->get('theme','theme1');
$show_readmore = $params->get('show_readmore',1);
$show_title = $params->get('show_title',1);
$show_desc = $params->get('show_desc',1);
$show_date = $params->get('show_date',1);
$width = $params->get('width', 'auto');
$height = $params->get('height', 'auto');
$date_format = $params->get('date_format','d F Y');
$title_color = $params->get('title_color', '#08c');
$desc_color = $params->get('desc_color', '#333');
$background_color = $params->get('background_color', '#fff');
$cate_title_color = $params->get('cate_title_color', '#bbb');
$cate_header_bg = $params->get('cate_header_bg', '#fff');
$column_number = $params->get('column_number', '2');

$float_items = 'float:none';

$class_module_id = '#bm_mega_cate_'.$module->id;

$document = JFactory::getDocument();            
$style = '';
$style .= $class_module_id.' .bm_mega_cate .bm_m_c_header a{ color:'.$cate_title_color.';}';
$style .= $class_module_id.' .bm_mega_cate .bm_mega_content .bm_mega_main .bm_main_title a{ color:'.$title_color.';}';
$style .= $class_module_id.' .bm_mega_cate .bm_mega_content .bm_mega_right .bm_item_title a{ color:'.$title_color.';}';
$style .= $class_module_id.' .bm_mega_cate .bm_mega_content .bm_mega_right .bm_mega_item{ background:'.$background_color.';}';
$style .= $class_module_id.' .bm_mega_cate .bm_mega_right .bm_mega_item .bm_item_desc{ color:'.$desc_color.';}';
$style .= $class_module_id.' .bm_mega_cate .bm_m_c_header{ background:'.$cate_header_bg.';}';

$document->addStyleDeclaration($style);

?>
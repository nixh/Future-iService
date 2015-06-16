<?php
/**
 * @package     mod_bm_articles_mega_category
 * @author      brainymore.com
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$show_module = 1;
$input=Jfactory::getApplication()->input; 
$view = $input->getCmd('view');
$option = $input->getCmd('option');

$show_module_on_detail = $params->get('show_module_on_detail',1);
$show_module_on_category = $params->get('show_module_on_category',1);
if(!$show_module_on_detail && $option=="com_content" && $view=="article"){$show_module=0;}
if(!$show_module_on_category && $option=="com_content" && $view=="category"){$show_module=0;}

if($show_module)
{
	require dirname(__FILE__) . '/defines.php';
	require_once dirname(__FILE__) . '/helper.php';
	require_once dirname(__FILE__) . '/libs/image.php';

	$cache = $params->get('cache',1);

	$bm_articles_{$module->id} = new ModBMArticlesMegaCateHelper($params); 
	  
	if($cache)
	{   
		$cache = JFactory::getCache($module->module.'_'.$module->id,'callback');
		$cache->setCaching(1);
		$cache->setLifeTime($params->get( 'cache_time', 900));
		$list  = $cache->call( array( $bm_articles_{$module->id}, 'getList' ), $params, $module );
	}
	else
	{
		$list = $bm_articles_{$module->id}->getList($params, $module);
	}

	if(!empty($list))
	{
		$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
		require JModuleHelper::getLayoutPath($module->module, $params->get('layout', 'default'));
		require __DIR__ . '/js.php';
	}
}
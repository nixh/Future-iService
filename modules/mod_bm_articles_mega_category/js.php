<?php
/**
 * @package     mod_bm_js
 * @author      brainymore.com
 * @email       contact@brainymore.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
 
if(!defined('BM_MEGA_CATEGORY'))
{
	JHtml::stylesheet(Juri::base() . 'modules/'.$module->module.'/assets/css/styles.css');
	JHtml::stylesheet(Juri::base() . 'modules/'.$module->module.'/assets/css/font-awesome.min.css');
	define('BM_MEGA_CATEGORY', TRUE);
}
?>
<?php
/**
 * 4.9.1    $Id: defines.imageshow.php 16604 2012-10-02 07:44:24Z giangnd $
 * @package    JSN ImageShow
 * @author     JoomlaShine Team <support@joomlashine.com>
 * @copyright  Copyright (C) 2012 JoomlaShine.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.joomlashine.com
 * Technical Support:  Feedback - http://www.joomlashine.com/contact-us/get-support.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

if (is_file(JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_imageshow' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'jsn_is_factory.php'))
{
	include_once JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_imageshow' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'jsn_is_factory.php';
}
define('JSN_IMAGESHOW_ADMIN_PATH', JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_imageshow');
define('JSN_IMAGESHOW_PATH_JSN_PLUGIN', JPATH_PLUGINS . DIRECTORY_SEPARATOR . 'jsnimageshow');
@define('JSN_IMAGESHOW_AUTOUPDATE_URL', str_replace('&upgrade=yes', '', JSN_EXT_DOWNLOAD_UPDATE_URL));

$objJSNParameter			= JSNISFactory::getObj('classes.jsn_is_parameter');
$parameters 				= $objJSNParameter->getParameters();

if (is_null(@$parameters->enable_update_checking) || $parameters->enable_update_checking)
{
	@define('JSN_IMAGESHOW_INFO_URL', JSN_EXT_VERSION_CHECK_URL);
}
else
{
	define('JSN_IMAGESHOW_INFO_URL', '');
}

// Define some necessary links
define('JSN_IMAGESHOW_INFO_LINK', 'http://www.joomlashine.com/joomla-extensions/jsn-imageshow.html');
define('JSN_IMAGESHOW_DOC_LINK', 'http://www.joomlashine.com/joomla-extensions/jsn-imageshow-docs.zip');
define('JSN_IMAGESHOW_REVIEW_LINK', 'http://www.joomlashine.com/joomla-extensions/jsn-imageshow-on-jed.html');
define('JSN_IMAGESHOW_UPDATE_LINK', 'index.php?option=com_imageshow&view=update');
define('JSN_IMAGESHOW_UPGRADE_LINK', 'index.php?option=com_imageshow&view=upgrade');
define('JSN_IMAGESHOW_EDITION', 'FREE');
define('JSN_IMAGESHOW_VERSION', '4.9.1');
// IMAGESHOW GLOBAL PATH
define('JSN_IMAGESHOW_CATEGORY_EXTENSION', 'cat_extension');
define('JSN_IMAGESHOW_CATEGORY', 'cat_ext_imageshow');
define('JSN_IMAGESHOW_CATEGORY_IMAGESOURCES', 'jsnisimagesources');
define('JSN_IMAGESHOW_CATEGORY_THEMES', 'jsnisthemes');
define('JSN_IMAGESHOW_IDENTIFIED_NAME', 'ext_imageshow');

// LIST PLUGIN INSTALLED
$imageSource 			= array('picasa');
$theme 					= array('themeclassic');
$pluginInstalledList 	= array('imageSource' => $imageSource, 'theme' => $theme);
define('PluginInstalledList', json_encode($pluginInstalledList));

//LIST LANGUAGES SUPPORT
$languages[] = array ('code'  => 'en-GB', 'title' => 'English');
$languages[] = array ('code'  => 'de-DE', 'title' => 'German');
$languages[] = array ('code'  => 'fr-FR', 'title' => 'French');
$languages[] = array ('code'  => 'nl-NL', 'title' => 'Dutch');
$languages[] = array ('code'  => 'pl-PL', 'title' => 'Polish');
$languages[] = array ('code'  => 'pt-PT', 'title' => 'Portuguese (Portugal)');
$languages[] = array ('code'  => 'it-IT', 'title' => 'Italian');

define('JSN_IMAGESHOW_LIST_LANGUAGE_SUPPORTED', json_encode($languages));
define('JSN_IMAGESHOW_BUY_LINK', 'http://www.joomlashine.com/joomla-extensions/jsn-imageshow-buy-now.html');

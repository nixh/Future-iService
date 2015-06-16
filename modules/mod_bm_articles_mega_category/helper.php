<?php
/**
 * @package     mod_bm_articles_helper
 * @author      brainymore.com
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_SITE . '/components/com_content/helpers/route.php';
JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

require dirname(__FILE__) . '/core/bm_content.php';

jimport('joomla.image.image');
/**
 * Helper for mod_articles_latest
 *
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 */
if(!class_exists("ModBMArticlesMegaCateHelper")){
    class ModBMArticlesMegaCateHelper extends bm_content
    {
        var $select_img_from = '';
        public function ModBMArticlesMegaCateHelper($params)
        {
           parent::bm_content($params);
        }
                      
	    public function getList($params, $module)
	    {         
            
		    $access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		    $authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
			
		    $cates = $params->get('catid', array());
			$cate_ids = '';
			
			$arr_cates = array();
		
			foreach($cates as $cate_id)
			{
				//$arr_cates[$cate_id]['cate'] = array('id'=>$cate_id,'name'=>'');
				$cate_ids = $cate_id;
				if($params->get('get_items_subcate',1))
				{
					$cate_ids = $this->getSubCategories($cate_id);	
				}
				
				if($arr_cate_info = $this->getCategoryInfo($cate_ids))
				{
					$arr_sub_cates = array();
					foreach($arr_cate_info as $cate_info)
					{
						if($cate_info->id == $cate_id)
						{
							$arr_cates[$cate_id]['parent_cate'] = array('id'=>$cate_id,
																		'title'=>$cate_info->title,
																		'link'=>JRoute::_(ContentHelperRoute::getCategoryRoute($cate_id)));
							
						}
						else
						{
							$arr_sub_cates[] = array('id'=>$cate_info->id,
																		'title'=>$cate_info->title,
																		'link'=>JRoute::_(ContentHelperRoute::getCategoryRoute($cate_info->id)));
						}
					
					}
					$arr_cates[$cate_id]['sub_cate'] = $arr_sub_cates;
				}
				
				if($params->get('get_items_subcate',1))
				{					
					$items = $this->getItems($params, $cate_ids, 0);
				}
				else
				{
					$items = $this->getItems($params, $cate_id, 0);
				}
				
				if(!empty($items))
				{
					foreach ($items as $key=>&$item)
					{   
						$title_limit = $params->get('title_limit', 50); 	
						$item->title = JHTML::_('string.truncate', ( $item->title ), $title_limit);
						$this->getImage($item, $params, $module);
						if($item->image!='')
						{
							$item->slug = $item->id . ':' . $item->alias;
							$item->catslug = $item->catid . ':' . $item->category_alias;

							if ($access || in_array($item->access, $authorised))
							{
								// We know that user has the privilege to view the article
								$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug));
							}
							else
							{
								$item->link = JRoute::_('index.php?option=com_users&view=login');
							}
						}
						else
						{
						unset($items[$key]);
						}   
					}
					$arr_cates[$cate_id]['items'] = $items;
					
				}
				else
				{
					$arr_cates[$cate_id]['items'] = NULL;
				}		
			}
			return $arr_cates;	
	    }
        
        public function getImage($item, $params, $module){
                      
            $image_from = $params->get('image_from', 'full_article_image');
            $images = json_decode($item->images);
            $img_path = '';
            
            switch($image_from)
            {
                case 'full_article_image': 
                    if(isset($images->image_fulltext) && $images->image_fulltext!='')
                    {
                         $img_path = $images->image_fulltext;
                    }
                break;
                case 'intro_image': 
                    if(isset($images->image_intro) && $images->image_intro!='')
                    {
                         $img_path = $images->image_intro;
                    }
                break;
                case 'intro_text': 
                    $content = $item->introtext;

                    $pattern = '/src="([^"]*)"/';
                    preg_match_all($pattern, $content, $out);
                    if(isset($out[1][0]) && $out[1][0]!='')
                    {
                       $img_path = $out[1][0]; 
                    } 
                break;
            }                       
               
            if($img_path=='' || !file_exists($img_path))
            {     				                            
                $img_path = 'modules/'.$module->module.'/assets/images/no-image.png';
            }		
			
			if($img_path!='' && file_exists($img_path)){
				if($params->get('resize_type', 5)==6)
				{
					$item->image = $img_path;
					
					$thumb = new JoomlaImage($img_path);
					$thumbSizes = array($params->get('width_thumb', 150).'x'.$params->get('height_thumb', 80));
					$thumb = $thumb->createThumbs($thumbSizes,5);
					$item->thumb = $thumb[0]->getPath();
				}
				else
				{
					$img = new JoomlaImage($img_path);
					$thumbSizes = array($params->get('width_image', 800).'x'.$params->get('height_image', 300));
					$imge = $img->createThumbs($thumbSizes,$params->get('resize_type', 5));
					$item->image = $imge[0]->getPath();		
					
					$thumb = new JoomlaImage($img_path);
					$thumbSizes = array($params->get('width_thumb', 150).'x'.$params->get('height_thumb', 80));
					$thumb = $thumb->createThumbs($thumbSizes,$params->get('resize_type', 5));
					$item->thumb = $thumb[0]->getPath();								
				}
				
				
				
			}
        
        }
        
		public function getCategoryInfo($cate_ids='')
		{
			if($cate_ids!='')
			{
				$db = JFactory::getDbo();
				$query = $db->setQuery('SELECT id, title FROM #__categories WHERE id in ('.$cate_ids.')' );
				$arr_cates = array();
				if($result = $query->loadObjectList())
				{return $result;}
				else
				{return NULL;}
			}
			return NULL;			
		}
		
		public function getSubCategories($cate_id=''){
			if($cate_id!='')
			{
				$db = JFactory::getDbo();
				$query = $db->setQuery('SELECT id, title FROM #__categories WHERE parent_id = '.$cate_id );
				$arr_cates = array();
				if($result = $query->loadObjectList())
				{					
					foreach($result as $val){
						$arr_cates[] = $val->id;	
					}	
				}
				$ids = implode(',',$arr_cates);
				if($ids!=''){ return $cate_id.','.$ids;}
				else { return $cate_id;}
			}
			return $cate_id;
		}
		
    }
}
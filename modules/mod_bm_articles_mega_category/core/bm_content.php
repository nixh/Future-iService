<?php
/**
 * @package     mod_bm_articles_core
 * @class		bm_content
 * @desc		This class support get item from content component
 * @author      brainymore.com
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
if(!class_exists("bm_content")){
	class bm_content
	{
		var $limit = 10;
		var $order_by = '';
		var $page = 1;
		var $condition = '';
		
		protected function bm_content($params){
			$this->buildCondition($params);
		}	
		
		public function getItems($params, $cate_id='', $page=0)
		{
			// Create a new query object.
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$order = $params->get('ordering');
			$limit = $params->get('count', 5);
			
			$filter_fields = 'a.id, a.alias, c.alias as category_alias, a.access, a.catid, a.introtext, a.images, a.title, ua.name as author, c.title as category_title, a.created, a.hits, a.images';
	
			$query->select($filter_fields);
			$query->from('#__content AS a')
			->join('LEFT', '#__users AS ua ON ua.id = a.created_by')
			->join('LEFT', '#__categories AS c ON c.id = a.catid');		    
			// Set ordering
			$order_map = array(
				'm_dsc' => 'a.modified DESC, a.created',
				'mc_dsc' => 'CASE WHEN (a.modified = ' . $db->quote($db->getNullDate()) . ') THEN a.created ELSE a.modified END',
				'c_dsc' => 'a.created',
				'p_dsc' => 'a.publish_up',
			);
			$ordering = JArrayHelper::getValue($order_map, $order , 'a.publish_up');	
			$dir = 'DESC';
			$order_by = ' ORDER BY '.$ordering.' '.$dir;
			
			$start = $page * $limit;
			$str_limit = ' LIMIT ' . $start. ', '.$limit;
			$cate = '';
			$items_id = '';
			if($params->get('source','filter')=='filter')
			{
				if(is_array($cate_id))
				{
					$cate_ids = implode(",", $cate_id);	
					if($cate_ids!='')
					{
						$cate =  ' and a.catid in (' . $cate_ids . ')';
					}
				}
				else
				{
					$cate =  ' and a.catid in (' . $cate_id . ')';
				}
				
			}
			else
			{
				if($ids = $params->get('items_id',''))
				{
					$items_id = ' and a.id in (' . $ids . ')';
				}
			}
			$str_where = $cate . $items_id . $order_by . $str_limit;
			
			$condition = $this->condition;
			$query->where($condition.$str_where);
			$db->setQuery($query);
			$result = $db->loadObjectList();
			
			return $result;
		}
		
		public function buildCondition($params)
			{
				$condition = array();
				  
				// Get the dbo
				$db = JFactory::getDbo();
				
				// Get an instance of the generic articles model
				$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));
	
				// Set application parameters in model
				$app = JFactory::getApplication();
				$appParams = $app->getParams();
				$model->setState('params', $appParams);
	
				// Set the filters based on the module params
				$condition[] = 'a.state = 1';
				// Access filter
				$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
				$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
				$condition[] = 'a.access = '.$access;	
	
				// User filter
				$userId = JFactory::getUser()->get('id');
				$author_id_include = true;
				$authorId = '';
				switch ($params->get('user_id'))
				{
					case 'by_me':
						$authorId  = (int) $userId;
						
						break;
					case 'not_me':
						$authorId = $userId;
						$author_id_include = false;
						break;
	
					case '0':
						break;
	
					default:
						$authorId = (int) $params->get('user_id');
						break;
				}
	
				// Filter by author			
		
				if (is_numeric($authorId))
				{
					$type = $author_id_include ? '= ' : '<> ';
					$condition[] = 'a.created_by ' . $type . (int) $authorId;
				}
				elseif (is_array($authorId))
				{
					JArrayHelper::toInteger($authorId);
					$authorId = implode(',', $authorId);
		
					if ($authorId)
					{
						$type = $author_id_include ? 'IN' : 'NOT IN';
						$condition[] = 'a.created_by ' . $type . ' (' . $authorId . ')';
					}
				}
	
				// Filter by language
				if($app->getLanguageFilter())
				{
					$condition[] = 'a.language in ('. $db->quote(JFactory::getLanguage()->getTag()) . ',' . $db->quote('*') . ')';
				}
				
				
				//  Featured switch
				switch ($params->get('show_featured'))
				{
					case '1':
						$condition[] = ' a.featured = 1';
						break;
					case '0':
						 $condition[] = ' a.featured = 0';
						break;
					default:
						break;
				}
				$order = $params->get('ordering');
				$limit = $params->get('count', 5);
	
				$condition_str = implode(' and ', $condition);
				$this->condition = $condition_str;
			}
	
	}
}
?>
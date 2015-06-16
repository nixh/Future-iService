<?php
/**
 * @package     mod_bm_articles_mega_category
 * @author      brainymore.com
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<?php if ($params->get('pretext')) : ?>
    <div class="bm_pretext">
        <p><?php echo $params->get('pretext'); ?></p>
    </div>
<?php endif; ?>
<div id="bm_mega_cate_<?php echo $module->id;?>" >
<!-- content -->
<?php foreach($list as $cate):
	$sub_cates = $cate['sub_cate'];
	$items = $cate['items'];
	$main_item = array();
	if(!empty($items)){
		$main_item = $items[0];
		unset($items[0]);
	}
	$count_item = 0;
?>
<div class="bm_mega_cate">
	<div class="bm_m_c_header">
		<div class="bm_parent_cate">
			<a href="<?php echo $cate['parent_cate']['link'];?>"><?php echo $cate['parent_cate']['title'];?> <i class="fa fa-caret-right"></i></a>
		</div>
		<div class="bm_child_cates">
			<?php foreach($sub_cates as $sub_cate):?>
				<a class="bm_child" href="<?php echo $sub_cate['link'];?>"><?php echo $sub_cate['title'];?></a>
			<?php endforeach;?>
		</div>
	</div>
	<div class="bm_mega_content bm_mega_<?php echo $theme;?>">
		<?php if(!empty($main_item)):?>
		<div class="bm_mega_main">
			<?php if($show_date):?>
				<div class="bm_mega_cate_date"><?php echo JHtml::_('date', $main_item->created, $date_format); ?></div>
			<?php endif;?>
			<div class="bm_main_img">
				<a href="<?php echo $main_item->link;?>"><img src="<?php echo $main_item->image;?>" /></a>
				<?php if($show_title):?>
					<div class="bm_main_title">
						<a href="<?php echo $main_item->link;?>"> <?php echo $main_item->title;?> <i class="fa fa-chevron-right"></i></a>
					</div>
				<?php endif;?>
			</div>
			<?php if($show_desc):?>
				<div class="bm_main_desc">
					<?php 
						if( $params->get('readmore_limit',200) == -1 )
						{
							echo $main_item->introtext;
						}
						else
						{
							echo JHTML::_('string.truncate', ( $main_item->introtext ), $params->get('readmore_limit',200));
						}
					?>
				</div>
			<?php endif;?>
		</div>
		<?php endif;?>
		<?php if(!empty($items)):?>
		<div class="bm_mega_right">
			<?php foreach($items as $item): $count_item++;?>
			<div class="bm_mega_item bm_col_<?php echo $column_number;?>">
				<div class="bm_content_<?php echo $theme;?>">
					<div class="bm_item_title">
						<?php if($show_title):?>
							<?php if($params->get('h_tag_title','')):?><<?php echo $params->get('h_tag_title','');?>><?php endif; ?>
								<?php if($params->get('link_for_title','')):?><a href="<?php echo  $item->link;?>"><?php endif; ?>
									<?php echo $item->title;?>
								<?php if($params->get('link_for_title','')):?></a><?php endif; ?>
							<?php if($params->get('h_tag_title','')):?></<?php echo $params->get('h_tag_title','');?>><?php endif; ?>
						<?php endif;?>
					</div>
					
					<div class="bm_item_img">	
						<?php if($show_date):?>
							<div class="bm_mega_cate_date"><?php echo JHtml::_('date', $main_item->created, $date_format); ?></div>
						<?php endif;?>
						<a href="<?php echo  $item->link;?>"><img src="<?php echo $item->image;?>" title="<?php echo $item->title;?>" alt="<?php echo $item->title;?>"/></a>
						<a href="<?php echo  $item->link;?>" class="bm_mega_readmore"><i class="fa fa-link"></i></a>
					</div>
					<div class="bm_item_desc">
						
						<?php if(isset($item->introtext) && $show_desc):?>
						<div class="bm_desc">
							<?php if(!$params->get('keep_html',0)){ $item->introtext = strip_tags($item->introtext); }?>
							<?php 
								if( $params->get('readmore_limit','') == -1 )
								{
									echo $item->introtext;
								}
								else
								{
									echo JHTML::_('string.truncate', ( $item->introtext ), $params->get('readmore_limit',200));
								}
							 ?>
						</div>
						<?php endif;?> 
						<?php if($show_readmore): ?>
								<?php if(isset($item->link)):?>
									<a class="bm-btn-mega-cate" href="<?php echo  $item->link;?>"><?php echo JText::_($params->get('readmore_label','View Detail'));?></a>
								<?php endif;?>							
						<?php endif;?>
					</div>
				</div>
			</div>
				<?php if(($count_item%$column_number)==0):?>
					<div class="bm_row"></div>
				<?php endif;?>
			<?php endforeach;?>
			
		</div>
		<?php endif;?>
	</div>
</div>	
<?php endforeach;?>	
</div>	
<div class="bm_clear"></div>

<?php if ($params->get('posttext')) : ?>
    <div class="bm_posttext">
        <p><?php echo $params->get('posttext'); ?></p>
    </div>
<?php endif; ?>
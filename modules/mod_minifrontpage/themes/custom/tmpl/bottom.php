<?php 
// no direct access 
defined('_JEXEC') or die('Restricted access'); 

?>
<!-- MiniFrontPage Module - Another Quality Freebie from TemplatePlazza.com --> 
<div class="item_list">
    <div class="preview_option">
	<div class="option-table">
		<div></div>
		<div></div>
	</div>
	<table class="option-image">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
    </div>
    <div class="display-image">
        <ul>
        <?php
        #JFactory::getApplication()->enqueueMessage("<pre>".print_r($list[0], true)."</pre>");
        
        foreach($list as $item) {
            if(!empty($item)) {
                echo "<li>";
                echo "<div>";
                if ( ($thumbnail_position == 1) && ($thumb_embed == 1) ) {
					
                    if ( !empty($item->introimage) ) { ?>
                        <a href="<?php echo $item->link; ?>">
                        <div class="img-title">
                            <span><?php echo $item->imgtitle; ?><br/><?php echo $item->imgalt; ?></span>
                        </div>
                        <img class="mfp-img-<?php echo $thumb_align; ?>" 
                             src="<?php echo mfpResizeImageHelper::getResizedImage('/'.$item->introimage, $thumb_width, $thumb_height, 'crop'); ?>" 
                             style="height:<?php echo $thumb_height; ?>px;width:<?php echo $thumb_width ?>px;" />
    			</a>
                    <?php } elseif ( empty($item->introimage) && !empty($item->fulltextimage) ) { ?>
                        <a href="<?php echo $item->link; ?>">
                        <div class="img-title">
                            <span><?php echo $item->imgtitle; ?><br/><?php echo $item->imgalt; ?></span>
                        </div>
                        <img class="mfp-img-<?php echo $thumb_align; ?>" 
                             src="<?php echo mfpResizeImageHelper::getResizedImage('/'.$item->fulltextimage, $thumb_width, $thumb_height, 'crop'); ?>" 
                             style="height:<?php echo $thumb_height; ?>px;width:<?php echo $thumb_width ?>px;" />
                        </a>
                    <?php } else {
                        echo modMiniFrontPageHelper::showTagFP( $item->thumb, $item->link, (($thumbnail_position == 1) && ($thumb_embed == 1)), true, null, null );
                        }
                }
                echo "</div>";
                echo "</li>";
            }
        }
        ?>
        </ul>
    </div>
    <div class="display-table">
        <table class="large">
        <?php
            
            foreach($list as $item) {
                if(!empty($item->imgtitle)) {
                    ?>
                    <tr class="row">
                        <td class="column"><a href="<?php echo $item->link?>"><?php echo $item->imgtitle?></a></td>
                        <td class="column"><a href="<?php echo $item->link?>"><?php echo $item->imgalt?></a></td>
                        <td class="column"><a href="<?php echo $item->link?>"><?php echo json_decode($item->metadata)->rights?></a></td>
                    </tr>
                    <?php
                }    
            }
        ?>
        </table>
        <div class="small">
        <?php
$first = true;
foreach($list as $item) {
    if(!empty($item->imgtitle)) {
        if(!$first) {
            echo "<hr/>";
        }
        ?>
            <a href="<?php echo $item->link?>">
            <span><?php echo $item->imgtitle?></span>
            <span><?php echo $item->imgalt?></span>
            <span><?php echo json_decode($item->metadata)->rights?></span>
            </a>
        <?php

        $first = false;
    }
} 
        ?>
        </div>
    </div>
</div>

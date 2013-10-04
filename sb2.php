<?php
if(!isset($GLOBALS['id_home'][0])){
	$id=(is_page())?get_the_ID():0;
}else{
	$id=(is_page())?get_the_ID():$GLOBALS['id_home'][0];
}
//$layout_info=maybe_unserialize(get_option('themeshock_layout_options'));
$id=$GLOBALS['ts_id'];
$layout_info=$GLOBALS['layout_info'];
	if(isset($GLOBALS['new_sidebar']) && !is_page()){
		(count($GLOBALS['new_sidebar']) > 0)?$id=0:NULL;
		$new_sidebar = $GLOBALS['new_sidebar'];
		$layout_info[$id] = array_merge($layout_info[$id], $new_sidebar);
	}
if(!isset($GLOBALS['id_home'][0])){
	$id=(is_page())?get_the_ID():0;
}
if($layout_info[$id]['right_2']['active']===true){?>
	<div class="sidebar_right" data-pos="right_2">
		<?php widget_style('Right_2',$layout_info[$id]['right_2']['style']); ?>
	</div>
	<?php
}
if(!isset($GLOBALS['id_home'][0])){
	$id=(is_page())?get_the_ID():0;
}
if($layout_info[$id]['right_1']['active']===true){?>
	<div class="sidebar_right" data-pos="right_1">
		<?php widget_style('Right_1',$layout_info[$id]['right_1']['style']); ?>
	</div>
	<?php 
}?>
	<div class="clear"></div>
	</div ><!-- end wrap_content_middle -->
<?php
if($GLOBALS['sidebar_bottom']!==NULL){
	foreach ($GLOBALS['sidebar_bottom'] as $position =>$sidebar_properties){
		if($sidebar_properties['active']===true){?>
    	<div class="sidebar_down" data-pos="<?php echo $position; ?>">
			<?php widget_style($position,$sidebar_properties['style']); ?>
			</div>
    	<?php
		}
	}
}?>

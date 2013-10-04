<?php
	global $wp_query;
	$page_id     = $wp_query->get_queried_object_id();
if(!isset($GLOBALS['id_home'][0])){
	$id=(is_page())?$page_id:0;
}else{
	$id=(is_page())?$page_id:$GLOBALS['id_home'][0];
}
$layout_info=maybe_unserialize(get_option('themeshock_layout_options'));
$GLOBALS['layout_info']=$layout_info;
$GLOBALS['ts_id']=$id;	
	if(isset($GLOBALS['new_sidebar']) && !is_page()){
		(count($GLOBALS['new_sidebar']) > 0)?$id=0:NULL;
		$new_sidebar = $GLOBALS['new_sidebar'];
		$layout_info[$id] = array_merge($layout_info[$id], $new_sidebar);
	}
	$count_horizontal=0;
	if(isset($layout_info[$id])){
		foreach($layout_info[$id] as $layout_position => $value){
			if (is_array($value) && $value['active']===true){
				switch($layout_position){
					case 'left_1':
					case 'left_2':
					case 'right_1':
					case 'right_2':
					$count_horizontal++;
					break;
				}
			}
		}
	}
	switch($count_horizontal){
		case 0://full-width
			$width_sbr = 0;
			$width_blg = 960;
			$wpts_layout = "fullwidth";
		break;
		case 1://With one Sidebar
			if(get_option("themeshock_content_layout") === 'content_layout_small'){
				$width_sbr = 220;
				$width_blg = 720;
			}elseif(get_option("themeshock_content_layout") === 'content_layout_normal'){
				$width_sbr = 300;
				$width_blg = 640;
			}
			$wpts_layout = "sidebar_1";
		break;
		case 2://With two Sidebar
			$width_sbr = 220;
			$width_blg = 480;
			$wpts_layout = "sidebar_2";
		break;
	}

	if(isset($GLOBALS['posts_layout'])){
		$posts_layout = $GLOBALS['posts_layout'][0];
		$grid_post_size = $GLOBALS['posts_layout'][1];
	}else{
		$posts_layout = get_option("themeshock_grid_post");
		$grid_post_size = get_option("themeshock_grid_post_size");
	}
	
	if($posts_layout == "Grid" && !is_single() && !is_page()){
		if($wpts_layout == "sidebar_1" && $grid_post_size == "Small" ){
		echo '<style>
			.main_content{margin: 0; width: 720px; padding-bottom: 40px;}
			.sidebar_left, .sidebar_right {width: 220px; margin:0 10px;}
			.blog_boxes {width: 180px; margin: 0 8px; display: inline-block;}
			.navigation{position: absolute; bottom: 0; right: 0;}
			</style>';
		}elseif($wpts_layout == "sidebar_1" && $grid_post_size == "Normal"){
			echo '<style>
			.main_content{margin: 0; width: 640px; padding-bottom: 40px;}
			.sidebar_left, .sidebar_right {width: 300px; margin:0 10px;}
			.blog_boxes {width: 260px; margin: 0 8px; display: inline-block;}
			.navigation{position: absolute; bottom: 0; right: 0;}
			</style>';
		}
		if($wpts_layout == "sidebar_2" && $grid_post_size == "Small"){
		echo '<style>
			.main_content{margin: 0; width: 480px; padding-bottom: 40px;}
			.sidebar_left, .sidebar_right {width: 220px; margin:0 10px;}
			.blog_boxes {width: 180px; margin: 0 8px; display: inline-block;}
			.navigation{position: absolute; bottom: 0; right: 0;}
			</style>';
		}elseif($wpts_layout == "sidebar_2" && $grid_post_size == "Normal"){
			echo '<style>
			.main_content{margin: 0; width: 320px; padding-bottom: 40px;}
			.sidebar_left, .sidebar_right {width: 300px; margin:0 10px;}
			.blog_boxes {width: 260px; margin: 0 8px; display: inline-block;}
			.navigation{position: absolute; bottom: 0; right: 0;}
			</style>';
		}
		if($wpts_layout == "fullwidth" && $grid_post_size == "Small"){
		echo '<style>
			.main_content{margin: 0; width: 960px; padding-bottom: 40px;}
			.sidebar_left, .sidebar_right {width: 220px; margin:0 10px;}
			.blog_boxes {margin: 0 10px; width: 180px; margin: 0 8px; display: inline-block;}
			.navigation{position: absolute; bottom: 0; right: 0;}
			</style>';
		}elseif($wpts_layout == "fullwidth" && $grid_post_size == "Normal"){
			echo '<style>
			.main_content{margin: 0; width: 960px; padding-bottom: 40px;}
			.sidebar_left, .sidebar_right {width: 300px; margin:0 10px;}
			.blog_boxes {margin: 0 10px; width: 260px; margin: 0 8px; display: inline-block;}
			.navigation{position: absolute; bottom: 0; right: 0;}
			</style>';
		}
	}else{?>
		<style type="text/css" media="all">
      .sidebar_left, .sidebar_right {width:<?php echo $width_sbr;?>px; margin:0 10px;}
      .main_content, .content_blog{width:<?php echo $width_blg;?>px; margin:0; float:left;}
    </style>
    <?php 
	}
	$layout_top_info=$layout_info[$id];
	if ($layout_top_info!==NULL){		
		foreach ($layout_top_info  as $position =>$sidebar_properties ){
			switch ($position){
				case 'left_1':
				case 'left_2':
				case 'right_1':
					unset($layout_top_info[$position]);
					continue 2;	
				case 'right_2':
					unset($layout_top_info[$position]);										
				break 2;
			}
		if(isset($sidebar_properties['active']) && $sidebar_properties['active']===true){?>
			<div class="sidebar_top" data-pos="<?php echo $position; ?>">
				<?php widget_style($position,$sidebar_properties['style']); ?>
			</div>
    	<?php
		}
		unset($layout_top_info[$position]);	
		}
		$GLOBALS['sidebar_bottom']=$layout_top_info;?>
    
    <div class="wrap_content_middle">
  
    <?php
    if(!isset($GLOBALS['id_home'][0])){
		$id=(is_page())?get_the_ID():0;
	}
    if($layout_info[$id]['left_1']['active']===true){?>
      <div class="sidebar_left" data-pos="left_1">
        <?php widget_style('Left_1',$layout_info[$id]['left_1']['style']); ?>
      </div>
    	<?php
    }?>
    <?php
    if(!isset($GLOBALS['id_home'][0])){
		$id=(is_page())?get_the_ID():0;
	}
    if($layout_info[$id]['left_2']['active']===true){?>
      <div class="sidebar_left" data-pos="left_2">
        <?php widget_style('Left_2',$layout_info[$id]['left_2']['style']); ?>
      </div>
      <?php
    }
	}
?>
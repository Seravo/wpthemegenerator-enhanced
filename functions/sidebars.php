<?php //SIDE BARS?>
<?php
if ( function_exists('register_sidebar') )
	$the_sidebars = wp_get_sidebars_widgets();
	$count_wid = count($the_sidebars['sidebar-1'] );
	if($count_wid <= 1){$width_boxes = 'width_boxes_1';}
	if($count_wid == 2){$width_boxes = 'width_boxes_2';}
	if($count_wid == 3){$width_boxes = 'width_boxes_3';}
	if($count_wid >= 4){$width_boxes = 'width_boxes_4';}
	register_sidebar(array(
	  'name' => 'Footer Sidebar',
	  'description' => 'Widgets in this area will be shown on the footer.',
    'before_widget' => '<div class="container_fboxes '.$width_boxes.'"><div class="boxes">
    <div class="container_widgets_pieces">
      <div class="widget_corner widget_top_left"><div class="widget_token_left"></div></div>
      <div class="widget_topbottom widget_top_center"></div>
      <div class="widget_corner widget_top_right"><div class="widget_token_right"></div></div>
      <div class="widget_sides widget_middle_left"></div>
      <div class="widget_center widget_content">',
		'after_widget' => '</div>
 <div class="widget_sides widget_middle_right"></div>
      <div class="widget_corner widget_bottom_left"></div>
      <div class="widget_topbottom widget_bottom_center"></div>
      <div class="widget_corner widget_bottom_right"></div>
    </div><!-- end container_widgets_pieces -->
    <div class="widget_token_bottom"></div>
		</div><!-- end boxes --></div>',
	  'before_title' => '<h3>',
	  'after_title' => '</h3>'
	));

/////////////////Pages Layouts

add_action( 'widgets_init', 'sydeberz_register_sidebar' );
	function sydeberz_register_sidebar() {
		foreach ($GLOBALS['sidebar_info'] as $register_sidebar ){
		$register_sidebar['before_widget'] = '<div class="boxes">
    <div class="container_widgets_pieces">
      <div class="widget_corner widget_top_left"><div class="widget_token_left"></div></div>
      <div class="widget_topbottom widget_top_center"></div>
      <div class="widget_corner widget_top_right"><div class="widget_token_right"></div></div>
      <div class="widget_sides widget_middle_left"></div>
      <div class="widget_center widget_content">';
			register_sidebar($register_sidebar);
		}
	}

?>
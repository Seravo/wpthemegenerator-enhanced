<?php
	get_header();
	the_post();
	if($GLOBALS['layout_info'][get_the_ID()]['slider_page']){	
		get_template_part('slider');
	}
	rewind_posts();
?>
<?php wts_tool_panel('end-layout-3');	wts_tool_panel('layout-4');?>
<div class="wrapper_content">
    <div class="lay_base content_pattern"></div>
    <div class="bar_separate footer_separate"></div>
    <div class="lay_base content_shadow"></div>
    <div id="content" class="is_page">
    <?php get_template_part('sb1');?>
    	<div class="main_content">
    		<div class="blog_boxes <?php echo wts_main_boxes();?>">
		        <div class="container_posts_pieces">
		        	<div class="post_corner post_top_left"><div class="post_token_left"></div></div>
		        	<div class="post_topbottom post_top_center"></div>
		        	<div class="post_corner post_top_right"><div class="post_token_right"></div></div>
		        	<div class="post_sides post_middle_left"></div>
			        	<div class="post_center post_content">
				          	<br>
							<?php
								$pageWrapContent = get_post_meta($post->ID,'remove_box_content',true);
								$remove_title_page  = get_post_meta($post->ID,'remove_title_page',true);
								woocommerce_content();
							?>
		          		</div>  
		          	<div class="post_sides post_middle_right"></div>
		          	<div class="post_corner post_bottom_left"></div>
		          	<div class="post_topbottom post_bottom_center"></div>
		          	<div class="post_corner post_bottom_right"></div>
		        </div><!-- end container_posts_pieces -->
	        	<div class="post_token_bottom"></div>
      		</div><!-- end blog_boxes -->
      	</div><!-- end main content -->
    <?php get_template_part('sb2');?>
	</div><!-- content -->
</div><!-- end wrapper content -->
<?php get_footer();?>	
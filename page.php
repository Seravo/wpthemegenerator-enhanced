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


    <!-- if featured image exists, show it as header image -->
  	<?php if ( has_post_thumbnail()) { ?>
    <div class="sidebar_top" data-pos="top_2">
			<div class="boxes boxcss_8 boxcss width_boxes_1">
      <div class="container_widgets_pieces ">
        <div class="widget_corner widget_top_left "><div class="widget_token_left "></div></div>
        <div class="widget_topbottom widget_top_center "></div>
        <div class="widget_corner widget_top_right "><div class="widget_token_right "></div></div>
        <div class="widget_sides widget_middle_left "></div>
        <div class="widget_center widget_content ">
          <div class="textwidget">
          <?php the_post_thumbnail( 'featured-large' ); ?>
          </div>
    		</div>
	      <div class="widget_sides widget_middle_right "></div>
		    <div class="widget_corner widget_bottom_left "></div>
		    <div class="widget_topbottom widget_bottom_center "></div>
		    <div class="widget_corner widget_bottom_right "></div>
		  </div><!-- end container_widgets_pieces  -->
  		<div class="widget_token_bottom "></div>
	  </div><!-- end boxes -->			</div>
  	<?php } ?>

    <?php get_template_part('sb1');?>
    	<div class="main_content">
		<?php
		$pageWrapContent = get_post_meta($post->ID,'remove_box_content',true);
		$remove_title_page  = get_post_meta($post->ID,'remove_title_page',true);
		if (have_posts()): 
			while (have_posts()) : the_post();?>
      <?php if($pageWrapContent != 'on'){?>
				<div class="blog_boxes <?php echo wts_main_boxes();?>">
        <div class="container_posts_pieces">
          <div class="post_corner post_top_left"><div class="post_token_left"></div></div>
          <div class="post_topbottom post_top_center"></div>
          <div class="post_corner post_top_right"><div class="post_token_right"></div></div>
          <div class="post_sides post_middle_left"></div>
          <div class="post_center post_content">
			<?php }?>
            <div id="post-<?php the_ID();?>" <?php post_class('entry');?>>
              <div class="head_post pages_title<?php echo $remove_title_page;?>">
								<?php if($remove_title_page != 'on'){?>
                	<h2 class="post_title"><?php the_title();?></h2>
                <?php }?>
              </div><!-- head_post -->
              <div class="entry_post"><?php the_content('<span class="more-link_right"></span>Read More<span class="more-link_left"></span>');?></div><!-- end entry -->
              <?php comments_template();?>
            </div><!-- post_id -->
			<?php if($pageWrapContent != 'on'){?>
          </div>  
          <div class="post_sides post_middle_right"></div>
          <div class="post_corner post_bottom_left"></div>
          <div class="post_topbottom post_bottom_center"></div>
          <div class="post_corner post_bottom_right"></div>
        </div><!-- end container_posts_pieces -->
        <div class="post_token_bottom"></div>
      </div><!-- end blog_boxes -->
      <?php }?>
        <?php endwhile;	?>
    		<div class="navigation">
      	<?php posts_nav_link() ?>
    		</div>
				<?php else : ?>
					<h2 class="center"><?php echo __("Not Found",'tstranslate')?></h2>
					<p class="center"><?php echo __("Sorry, but you are looking for something that isn't here.",'tstranslate')?>.</p>
				<?php endif; ?>
      </div><!-- end main content -->
    <?php get_template_part('sb2');?>
	</div><!-- content -->
</div><!-- end wrapper content -->
<?php get_footer();?>	

<?php
	get_header();
	the_post();
	if($GLOBALS['layout_info'][0]['slider_single']){
		get_template_part('slider');
	}
	rewind_posts();
?>
<?php wts_tool_panel('end-layout-3');	wts_tool_panel('layout-4');?>
<div class="wrapper_content">
  <div class="lay_base content_pattern"></div>
  <div class="bar_separate footer_separate"></div>
  <div class="lay_base content_shadow"></div>
  <div id="content">
    <?php get_template_part('sb1');?>
    	<div class="main_content">
      	<?php
		if (have_posts()): 
			while (have_posts()) : the_post();?>
			<div class="blog_boxes <?php echo wts_main_boxes();?>">
        <div class="container_posts_pieces">
          <div class="post_corner post_top_left"><div class="post_token_left"></div></div>
          <div class="post_topbottom post_top_center"></div>
          <div class="post_corner post_top_right"><div class="post_token_right"></div></div>
          <div class="post_sides post_middle_left"></div>
          <div class="post_center post_content">
            <div id="post-<?php the_ID();?>" <?php post_class('entry');?>>
              <div class="head_post">
                <h2 class="post_title"><?php  the_title();?></h2>
                	<?php
									if(get_option('themeshock_iconPostAuthor') === 'true'){?>
                  	<span class="post_author post_icon"><?php echo __('By','tstranslate');?> <?php the_author();?></span><?php
									}
									if(get_option('themeshock_iconPostDate') === 'true'){?>
                  	<span class="post_date post_icon"><?php echo __('On ','tstranslate')?> <?php the_time("M j, Y ");?></span><?php
									}
									if(get_option('themeshock_iconPostCategory') === 'true'){?>
                  	<span class="post_categ post_icon"><?php the_category(' | ');?></span><?php
									}
									if(get_option('themeshock_iconPostComments2') === 'true'){
										if ( comments_open() ) {?>
                      <span class="comments_link <?php echo ($addclass_grid == "Grid")?'content_hidden':'';?>">
                        <?php comments_popup_link("0", "1", "%"); ?>
                      </span><?php
										}
									}
									if(get_option('themeshock_iconPostComments') === 'true'){?>
                  	<span class="post_commts post_icon"><?php comments_popup_link("No Comments", "1 Comment", "% Comments"); ?></span><?php
									}
									if(get_option('themeshock_iconPostTags') === 'true'){
										$tag = get_the_tags();
										if ($tag){?>
                    	<span class="post_tag post_icon"><?php the_tags(); ?></span><?php
										}
									}?>
              </div><!-- head_post -->
              <div class="entry_post"><?php the_content('<span class="more-link_right"></span>Read More<span class="more-link_left"></span>');?></div><!-- end entry -->
              <?php comments_template();?>
            </div><!-- post_id -->
          </div>  
          <div class="post_sides post_middle_right"></div>
          <div class="post_corner post_bottom_left"></div>
          <div class="post_topbottom post_bottom_center"></div>
          <div class="post_corner post_bottom_right"></div>
        </div><!-- end container_posts_pieces -->
        <div class="post_token_bottom"></div>
      </div><!-- end blog_boxes -->
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
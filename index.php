<?php
(!$_POST['home_page_id'])?include('functions/sidebar_callback.php'):$GLOBALS['id_home'][0] = $_POST['home_page_id'];
	if($GLOBALS['id_home'][0]){
		if($GLOBALS['layout_info'][$GLOBALS['id_home'][0]]['slider_page']){	
			 get_template_part('slider');
			
		}
	}else{
	 $slider_info=$GLOBALS['layout_info'][$GLOBALS['id_home'][0]?$GLOBALS['id_home'][0]:0];
	 if(($slider_info['slider_blog'] && is_home()) || ($slider_info['slider_search'] && is_search()) ||  (is_category() && is_archive()&& $slider_info['slider_category'])||(!is_category() && is_archive()&& $slider_info['slider_archive'])){
			 get_template_part('slider');
			
		}
	};
echo $_POST['home_page_id']?'<!-- split -->':NULL;
($_POST['home_page_id'])?$GLOBALS['id_home'][1] = $_POST['home_page_cat']:'';
?>
<?php wts_tool_panel('end-layout-3');	wts_tool_panel('layout-4');
?>
<div class="wrapper_content">
	<div class="lay_base content_pattern"></div>
  <div class="bar_separate footer_separate"></div>
  <div class="lay_base content_shadow"></div>
  <div id="content" class="content_posts">
    <?php get_template_part('sb1');?>
    	<div class="main_content">
      <?php
			(isset($GLOBALS['posts_layout']))?$addclass_grid = $GLOBALS['posts_layout'][0]:$addclass_grid = get_option("themeshock_grid_post");
			if(have_posts()):?>
			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<?php /* If this is a category archive */ if (is_category()){ ?>
      	<!--<h1 class="pagetitle"><?php //echo __('Our Category: ','tstranslate');?><?php single_cat_title(); ?></h1>-->
			<?php /* If this is a tag archive */ } elseif( is_tag() ){ ?>
          <h1 class="pagetitle"><?php echo __('Posts Tagged ','tstranslate');?>&#8216;<?php single_tag_title(); ?>&#8217;</h1>
      <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
          <h1 class="pagetitle"><?php echo __('Archive for ','tstranslate');?><?php echo get_the_time('F j, Y'); ?></h1>
      <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
          <h1 class="pagetitle"><?php echo __('Archive for ','tstranslate');?><?php echo get_the_time('F, Y'); ?></h1>
      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
          <h1 class="pagetitle"><?php echo __('Archive for ','tstranslate');?><?php echo get_the_time('Y'); ?></h1>
      <?php /* If this is an author archive */ } elseif (is_author()) { ?>
          <h1 class="pagetitle"><?php echo __('Author Archive','tstranslate');?></h1>
      <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
          <h1 class="pagetitle"><?php echo __('Blog Archives','tstranslate');?></h1>
			<?php }
			while(/*$wp_query->*/have_posts()): /*$wp_query->*/the_post();?>
			<div class="blog_boxes <?php echo wts_main_boxes();?>">
        <div class="container_posts_pieces">
          <div class="post_corner post_top_left"><div class="post_token_left"></div></div>
          <div class="post_topbottom post_top_center"></div>
          <div class="post_corner post_top_right"><div class="post_token_right"></div></div>
          <div class="post_sides post_middle_left"></div>
          <div class="post_center post_content">
            <div id="post-<?php the_ID();?>" <?php post_class('entry');?>>
              <div class="head_post <?php echo ($addclass_grid == "Grid")?'posts_grid':'';?>">
              	<h2 class="post_title <?php echo ($addclass_grid == "Grid")?'posts_grid':'';?>">
                  <?php
	                  $needleId=4864;//get_ID_by_post_title('Features');
                      $thisId=get_the_ID();
                      if($needleId==$thisId){
                        $redirectToPage=get_ID_by_page_name('fully-features');
                        ?>
                            <a href="<?php echo get_permalink($redirectToPage) ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php  the_title();?></a>
                        <?php
                      }else{
                        ?>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php  the_title();?></a>
                        <?php
                      } 
                  ?>
                	
                </h2>
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
              <div class="entry_post <?php echo ($addclass_grid == "Grid")?'content_hidden':'';?>">
              </div><!-- end entry_post -->
              <div class="excerpt_post <?php echo ($addclass_grid == "Grid")?'content_show':'';?>">
              	<a href="<?php the_permalink();?>" class="thumbnail-post"><?php the_post_thumbnail('medium');?></a>
								<?php the_excerpt();?>
                  
              </div><!-- end excerpt_post -->
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
            <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', '' ) . '</span>', 'after' => '</div>' ) ); ?>
    			</div>
				<?php else : ?>
					<h2 class="center"><?php echo __("Not Found",'tstranslate')?></h2>
					<p class="center"><?php echo __("Sorry, but you are looking for something that isn't here.",'tstranslate')?>.</p>
				<?php endif; ?>
        <div class="clear"></div>
      </div><!-- end main content -->
    <?php get_template_part('sb2');?>
	</div><!-- content -->
</div><!-- end wrapper content -->
<?php ($_POST['home_page_id'])?exit:get_footer();?>
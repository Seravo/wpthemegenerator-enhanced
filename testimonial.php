<?php 
	/* 
	*@package WordPress
	*Template name: Testimonials
	*/
	get_header();
?>
<?php wts_tool_panel('end-layout-3');	wts_tool_panel('layout-4');?>
<link href='http://fonts.googleapis.com/css?family=Miniver|Revalia|Eagle+Lake|Yesteryear|Passero+One|Courgette|Spirax|Qwigley|Ultra|IM+Fell+English' rel='stylesheet' type='text/css'>
<div class="wrapper_content">
  <div class="lay_base content_pattern"></div>
  <div class="bar_separate footer_separate"></div>
  <div class="lay_base content_shadow"></div>
  <?php $fontColorPostType = get_option('themeshock_fontColorPostType')?>
  <div id="content" <?php echo($fontColorPostType  != '')?'style="color: '.$fontColorPostType.'"':NULL?>>
  
    <div class="wrap_testimonial">
    <?php 
      get_template_part('sb1');
    ?>
      	<div class="main_content">
    		<div class="blog_boxes <?php echo wts_main_boxes();?>">
        <div class="container_posts_pieces">
          <div class="post_corner post_top_left"><div class="post_token_left"></div></div>
          <div class="post_topbottom post_top_center"></div>
          <div class="post_corner post_top_right"><div class="post_token_right"></div></div>
          <div class="post_sides post_middle_left"></div>
          <div class="post_center post_content">        
			<?php
      $remove_title_page  = get_post_meta($post->ID,'remove_title_page',true);?>
      <?php if($remove_title_page != 'on'){?>
        <h1 class="text-center"><?php echo __(the_title(),'tstranslate');?></h1>
      <?php }?>
      <?php if(have_posts()):while(have_posts()):the_post(); the_content();	endwhile; endif;?>
      <?php 
      $loop = new WP_Query(array('post_type' => 'wtstestimonial', 'posts_per_page' => 100));
      while ( $loop->have_posts() ): $loop->the_post();
      $custom = get_post_custom($post->ID);
      $testimonial = $custom["featured_item"][0];
      $testimonial_by = $custom["testimonial_by"][0];
			$quote_color = 'quote-color-'.get_option('themeshock_quote_color', 'gray');
			$quote_style = get_option('themeshock_quote_styles', 1)
      ?>
      <div class="taxonomy_testimonial boxcss_3">
        <h4><?php the_title(); ?></h4>
        <i class="quotes-testimonial"><span class="quote-style<?php echo $quote_style .' '. $quote_color;?>">“</span></i>
        <?php the_content();?>
        <b><?php echo __('By') .': '. $testimonial_by;?></b>
      </div><!-- End taxonomy_testimonial -->
      <?php endwhile;?>

    </div>
              <div class="post_sides post_middle_right"></div>
          <div class="post_corner post_bottom_left"></div>
          <div class="post_topbottom post_bottom_center"></div>
          <div class="post_corner post_bottom_right"></div>
        </div><!-- end container_posts_pieces -->
        <div class="post_token_bottom"></div>
      </div><!-- end blog_boxes -->
  </div><!--end main content-->    
  <?php
      get_template_part('sb2');
    ?>
        <div class="clear"></div>    
      </div><!-- end wrap_testimonial -->
        
	</div><!-- content -->
</div><!-- end wrapper content -->
<?php get_footer();?>
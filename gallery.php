<?php 
/*
 * @package WordPress
 * @subpackage ThemeGenerator
 * Template Name: Gallery
 */
 get_header();
  if(!isset($GLOBALS['id_home'][0])){
    $id=(is_page())?get_the_ID():0;
  }
  if($layout_info[$id]['slider_page']===true){
       get_template_part('slider');
       get_template_part('server/slider_selector');     
      
  }
 ?>
 <style>@import url(<?php echo get_template_directory_uri(); ?>/css/taxonomies-extended.css);</style>
<script>
jQuery(document).ready(function(){
	jQuery(".taxonomy_item a.popup").not('.taxonomy_item.isotope-hidden a.popup').colorbox();
});
</script>
<?php wts_tool_panel('end-layout-3');	wts_tool_panel('layout-4');?>
<div class="wrapper_content">
  <div class="lay_base content_pattern"></div>
  <div class="bar_separate footer_separate"></div>
  <div class="lay_base content_shadow"></div>
  <?php $fontColorPostType = get_option('themeshock_fontColorPostType')?>
  <div id="content" <?php echo($fontColorPostType  != '')?'style="color: '.$fontColorPostType.'"':NULL?>>
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
  <div class="post_type_info">
    <?php
    	/*obtain database result*/
    	$gls_unserial=$GLOBALS['gls_gallery'];
		extract($gls_unserial);
		/*obtain database results finish*/	
		$taxo = 'galleries';
		$results = get_terms($taxo);
		$remove_title_page  = get_post_meta($post->ID,'remove_title_page',true);?>
		<?php if($remove_title_page != 'on'){?>
			<h1 class="text-center"><?php echo __(the_title(),'tstranslate');?></h1>
		<?php }?>
		<?php if(have_posts()):while(have_posts()):the_post(); the_content();	endwhile; endif;?>
  </div><!-- end post_type_info -->
  <div id="options">
    <ul  id="filters" class="info_filters">
    	<?php	if(count($results) > 1){ ?>
      <li>
        <h4><a href="filter" data-filter="*" class="sel_item"><?php echo __('All','tstranslate');?></a></h4>
      </li>
      <?php 
        $results = get_terms($taxo, 'order=DESC');
        foreach ($results as $result){
          echo '<li><h4><a href="#filter" data-filter=".'.$result->slug.'">'.$result->name.'</a></h4></li>';
        }
      }
			?>
    </ul>
  </div>
  <div class="clear"></div>
  <div class="taxonomy_filter">
    <?php 
      $post_type = 'wtsgallery';
      $results = get_terms($taxo);
      if ($results) {
				query_posts(array( 'post_type'=>$post_type, $taxo, 'showposts' => 100));
        if (have_posts()): while ( have_posts() ): the_post();{
        	$term_slugs = wp_get_post_terms($post->ID, $taxo, array("fields" => "slugs"));
          $cats = implode(" ", $term_slugs);
		?>
    <div style="width:<?php echo $themeshock_gls_box_wdth; ?>;" class="taxonomy_item <?php echo $cats?>">
      <h2 class="contentTitle" style="font-family:<?php echo (isset($themeshock_gls_title_font_style))?$themeshock_gls_title_font_style:'Wire One'; ?> ;font-size: <?php echo $themeshock_gls_title_font_size; ?>;"><?php the_title();?></h2>
        <?php	postype_options($post->ID);?>
        <div class='container_img_gallery boxcss_<?php echo (isset($themeshock_gls_box_style))?$themeshock_gls_box_style:'11';//$GLOBALS['post_type_options']['frame_style']?>'>
          <div class='container_hover_shine'>
            <?php 
	            	if (has_post_thumbnail( $post->ID )){
	            		?>
	            		<a href="<?php echo $GLOBALS['post_type_options']['full']; ?>" class="popup" title="<?php echo $GLOBALS['post_type_options']['caption_img'];?>" rel="all_items">
		            		<?php
		            		if($_SERVER['HTTP_HOST']=='www.wpthemegenerator.com'){
		            			the_post_thumbnail();
		            		}else{
		            			the_post_thumbnail(array(($themeshock_gls_box_wdth-20),($themeshock_gls_box_wdth-20)));
		            		}
							?>
			                <div class="hover_shine"></div>
			            </a><!-- end middle center -->
						<?php
		            }else{
		            ?>
		            	<a href="<?php echo (isset($themeshock_gls_no_img) && !empty($themeshock_gls_no_img))?$themeshock_gls_no_img:get_template_directory_uri().'/img/logo/logo.png'; ?>" class="popup" title="" rel="all_items">
			            	<img width="100%" height="<?php echo $themeshock_gls_box_wdth-20;?>" src="<?php echo (isset($themeshock_gls_no_img) && !empty($themeshock_gls_no_img))?$themeshock_gls_no_img:get_template_directory_uri().'/img/logo/logo.png'; ?>" class="attachment-post-thumbnail wp-post-image">
			            	<div class="hover_shine"></div>
			            </a><!-- end middle center -->
		            <?php
					}
	            ?>
          </div>
        </div><!-- end container_img_gallery -->
      </div><!-- end taxonomy_item -->		
  <?php } endwhile;endif; }wp_reset_query();wp_reset_postdata();?> 
  </div><!-- End taxonomy_filter -->
		<script>
      jQuery('#filters a').click(function(){
        var selector = jQuery(this).attr('data-filter');
        jQuery('.taxonomy_filter').isotope({ filter: selector });
				jQuery('.taxonomy_item a.popup').attr('rel', 'all_items');
				jQuery('.taxonomy_item.isotope-hidden a.popup').attr('rel', '');
        return false;
      });
      jQuery('#options').find('.info_filters a').click(function(){
        var $this = jQuery(this);
        if ( !$this.hasClass('sel_item') ) {
          $this.parents('.info_filters').find('.sel_item').removeClass('sel_item');	
          $this.addClass('sel_item');
        }
      });
      jQuery(document).ready(function(e) {
        jQuery('.taxonomy_filter').isotope({
          itemSelector : '.taxonomy_item'
        });
        <?php
	      	if(!$themeshock_gls_masonry){
	    ?>
	    	jQuery('.taxonomy_filter').isotope({ layoutMode : 'fitRows' });
		<?php
			}
		?>
      });
    </script>
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
  
	</div><!-- content -->
</div><!-- end wrapper content -->
<?php get_footer();?>
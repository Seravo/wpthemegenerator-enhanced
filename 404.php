<?php
	get_header();
	the_post();
	if(get_option("TS_sliderdf_".get_the_ID(), 'true')==='true'){
		get_template_part('slider');
	}
	rewind_posts();
	wts_tool_panel('end-layout-3');	wts_tool_panel('layout-4');?>
<div class="wrapper_content">
	<div class="lay_base content_pattern"></div>
  <div class="bar_separate content_separate"></div>
  <div class="lay_base content_shadow"></div>
  <div id="content" class="page-404"><h1><?php echo __('404', 'tstranslate');?></h1>
    <p><?php echo __('Sorry, the page requested has not been found', 'tstranslate');?></p>
  </div><!-- content -->
</div><!-- end wrapper content -->
<?php get_footer();?>
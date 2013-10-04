<div class="wrapper_footer">
  <div class="lay_base footer_pattern"></div>
  <div class="lay_base footer_shadow"></div>
  <div id="footer">
    <?php if(get_option('themeshock_enable_logo_footer')== "true"){echo get_attr_logo();}?>
    <div class="footer_info">
      <?php if(get_option('themeshock_info') != ''){?>
      <p><?php echo stripcslashes( get_option('themeshock_info')); ?></p>
      <?php }?></div><!-- end footer_info -->
    <div class="clear"></div>
    <div class="footer_sidebar"><?php	get_template_part('sb_footer');?></div><!-- end footer sidebar -->
  </div><!-- end footer -->
    <!-- credits
    <div class="wrap_credit"><a class="wptg_credits" href="http://www.<?php echo $GLOBALS['wptg_credits'][0]?>"><?php echo $GLOBALS['wptg_credits'][1]?></a></div>
    credits -->
  </div><!-- end wrapper_footer -->
  
</div><!-- end body_theme-->
<div class="modal" id="myModal" style="display:none">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Modal header</h3>
  </div>
  
  <div class="modal-body">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </div>
</div>
<?php wts_tool_panel('show-tool-panel'); // If true! Show Tool Panel ?>
<?php get_template_part('server/header_cookie');?>
<?php	wts_tool_panel('end-layout-2'); wts_tool_panel('end-layout-5'); wts_tool_panel('end-layout-4'); wts_tool_panel('end-layout-6'); wts_tool_panel('end-layout-7');?>
<?php echo stripcslashes(get_option("themeshock_ga_code"));

if($GLOBALS['framework_tool']  === 'true' && is_user_logged_in()){

?>
  <script src="<?php echo get_template_directory_uri(); ?>/framework-tool/js/colorpicker.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/framework-tool/js/session.js"></script>
  <script async="async" src="<?php echo get_template_directory_uri(); ?>/framework-tool/js/jail.js"></script>
  <?php } ?>    
	<?php if($_GET['html']!=='true') { ?>  
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/isotope.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.nivo.slider.js?v=1.4" data-tgdelst="live"></script>
	<?php }?>
  	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.masonry.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/menu.js" data-tgdelst="live"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/accordion.js" data-tgdelst="live" ></script>
	<?php if($_GET['html']!=='true') { ?>      
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/colorbox.js?v=1.4.21" ></script>
  	<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.js" data-tgdelst="live" ></script>
  	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.smartgallery.js" data-tgdelst="live" ></script>
  	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.refineslide.js" data-tgdelst="live"></script>
  	<script src="<?php echo get_template_directory_uri(); ?>/js/wpts_slider_multiple.js?v=<?php echo $_SERVER['REQUEST_TIME'] ?>" data-tgdelst="live" ></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/scheduler.js?v=1"></script>
  	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery_autoscroll.js" data-tgdelst="live" ></script>
	<?php }?>          
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/carousel.js" data-tgdelst="live"></script>
	<?php if($_GET['html']!=='true') { ?>      
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/featured_thumbnail.js" ></script>
	<?php }?> 
  <script type="text/javascript" data-tgdelst="live" >
	jQuery(function() {
		jQuery(".container_menu ul:first").menuslide({
			fx: "linear", //backout 
			speed: 300,
			click: function(event, menuItem) {
					return true;
			}
		});
		jQuery('.boxes .widget_content img').each(function(i, e) {
			$width = jQuery(e).width();
			($width >= 155)?jQuery(e).addClass('responsive_fullwidth'):'';
		})
			<?php if($_GET['html']!=='true') { ?>			
		if(typeof(sessvars) != 'undefined'){
			if(sessvars['.container_menu ul li.back .left']?sessvars['.container_menu ul li.back .left']:'null' != 'null' || sessvars['.container_menu ul li.back']?sessvars['.container_menu ul li.back']:'null' != 'null'){
				$left_back_manu = jQuery('.container_menu ul li.back').css('left');
				jQuery('.container_menu ul li.back .left').attr('style', sessvars['.container_menu ul li.back .left']);
				jQuery('.container_menu ul li.back').attr('style', sessvars['.container_menu ul li.back']).css('left', $left_back_manu);
			}
		}
	<?php }	?>
	});
	</script>

<?php //}
if(get_option("themeshock_grid_post") == "Grid"){
	if($GLOBALS['framework_tool']  === 'false' && is_user_logged_in() || $GLOBALS['framework_tool']  === 'true' && !is_user_logged_in() || $GLOBALS['framework_tool']  === 'false' && !is_user_logged_in()){?>
		<script type="text/javascript" data-tgdelst="live">
			jQuery(window).load(function(){
				jQuery('.content_posts .main_content').masonry({
					itemSelector: '.blog_boxes'
				});
			});
		</script>
		<?php
	}
}
?>
<script>url_theme = '<?php echo get_template_directory_uri();?>';</script>
<script type='text/javascript' data-tgdelst="live" src='<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js?ver=v2.3.3'></script>
<script type='text/javascript' data-tgdelst="live" src='<?php echo get_template_directory_uri(); ?>/js/auto_tooltip_popover.js?ver=2.0.1'></script>
<?php 
	if($GLOBALS['tg_shp_cart']==='true'){
		get_template_part('functions/shopping_cart');
	}
	
?>
<script type="text/javascript" src="http://www.jqueryslidershock.com/wp-content/plugins/tsslider/js/box_slider.jquery.js?v=1.0" data-tgdelst="live" ></script>
<?php 
	wp_footer();
?>
</body>
</html>
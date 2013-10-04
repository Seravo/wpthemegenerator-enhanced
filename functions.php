<?php
$themename = "Theme Generator";
$shortname = "themeshock";
get_template_part('functions/variables_load');//cargas las varriables relacionados con el themegenerator
include('functions/slider_images.php');///callback para la subida de imagenes (debe usarse include) por efecto del script
if(file_exists(get_template_directory().'/framework-tool/current_layout/vars_layout.php'))include('framework-tool/current_layout/vars_layout.php');
get_template_part('functions/layout_callback');// callback para la seleccion de layouts
get_template_part('functions/create-pages');
add_theme_support('woocommerce');

function wts_reset_get_option($var_get_option, $new_val){
	if(get_option($var_get_option)){
		update_option($var_get_option , $new_val);
	}else{
		return false;
	}
}
/*
function tg_notification_plugin(){
	$get_plugins=get_plugins();
	$gridlayout=$jqueryslider=false;
	foreach ($get_plugins as $plugin_file => $plugin_data){
		switch (basename($plugin_file)){
			case 'wpts_matrix.php':
				$gridlayout=true;
			break;
			case 'wpts_slider.php'://plugin file name for jqueryslidershock
				$jqueryslider=true;
			break;
		}
	}
	if ($gridlayout===false || $jqueryslider===false ):
	?>
		<style>
			ul.re_plug li{
				max-width:400px;
				display:inline-block;
				padding-right:10px;
			}
		</style>
		<h3>Please check shocks recommended plugins</h3>
		<ul class="re_plug">
			<?php 
				if ($gridlayout===false):
			?>
			<li>
				<a href="http://www.gridlayoutshock.com/"><img src="<?php echo get_template_directory_uri();?>/img/notification/gridlayoutshock.jpg" /></a>
				<p>
					Create any kind of grid layout (pinterest-like) using your post, taxonomies or custom post types, and external sources
					<a href="http://www.gridlayoutshock.com/">Download</a>
				</p>
			</li>
			<?php 
				endif;
				if($jqueryslider===false):
			?>
			<li>
				<a href="http://www.jqueryslidershock.com/"><img src="<?php echo get_template_directory_uri();?>/img/notification/jqueryslidershock.jpg" /></a>
				<p>
					Create any kind if slider from your (or external) data, with tons of options and features, the most complete slider ever
					<a href="http://www.jqueryslidershock.com/">Download</a>        
				</p>
			</li>
			<?php 
				endif;
			?>
		</ul>
	<?php 
	endif;//detecting plugins
}
add_action('admin_notices', 'tg_notification_plugin');//mostra notification de plugins
*/

if(is_admin() && $pagenow == 'themes.php' && isset($_GET['activated']) && $_GET['activated'] == 'true'){
	wts_reset_get_option($shortname.'_default_post_boxes', 'true');
	$GLOBALS['layout_info']['themeshock_default_widget_boxes'] = true;
	(isset($GLOBALS['display_elements']) && $GLOBALS['display_elements'][0] == 'show')?wts_reset_get_option($shortname.'_show_main_menu', 'true'):wts_reset_get_option($shortname.'_show_main_menu', 'false');
	if(isset($GLOBALS['display_elements']) && $GLOBALS['display_elements'][1] == 'show'){
		$active_socials = array('themeshock_face_follow_option', 'themeshock_tweet_follow_option', 'themeshock_mail_option', 'themeshock_rss_feed_option');
		foreach($active_socials as $active_social){
			wts_reset_get_option($active_social, 'true');
		}
	}else{
		foreach($GLOBALS['social_network'] as $social_network => $option ){
			wts_reset_get_option('themeshock'.$option.'_option', 'false');
		}	
	};
	(isset($GLOBALS['display_elements']) && $GLOBALS['display_elements'][2] == 'show')?wts_reset_get_option($shortname.'_show_search_box', 'true'):wts_reset_get_option($shortname.'_show_search_box', 'false');
	update_option('themeshock_layout_options', maybe_serialize($layout_info));
}

function wts_main_boxes(){
	if(get_option('themeshock_default_post_boxes') == 'true'){
		if(isset($GLOBALS['boxes_css']) && $GLOBALS['boxes_css'][1] != 'boxcss_default'){
			return 'reset_boxcss '.$GLOBALS['boxes_css'][1];
		}else{
			return $GLOBALS['boxes_css'][1];
		}
	}else if(get_option('themeshock_postsbox_style') != 'boxcss_default'){
		return 'reset_boxcss '.get_option('themeshock_postsbox_style');
	}else{
		return get_option('themeshock_postsbox_style');
	}
}

$font_style_pack = array(
	"Yanone Kaffeesatz", "Wire One", "Ubuntu", "Rokkitt", "Righteous", "Raleway", "Quattrocento Sans", "PT Sans", "Open Sans","Nixie One", "News Cycle", "Acme","Coustard",
	"Alfa Slab One", "Abel", "Brawler", "Droid Sans", "Crushed","Cabin Condensed", "Federo", "Arimo", "Contrail One", "Anton", "Days One","Droid Serif", "Abril Fatface", "Allan","Amatic SC",
	"Anonymous Pro", "Bangers","Baumans", "Boogaloo", "Bree Serif","Buda", "Cuprum", "Damion","Dorsa", "Francois One", "Just Another Hand","Gruppo", "Jockey One", "Maiden Orange", "Josefin Slab",
	"Lobster", "Lobster Two", "Marvel", "Andika", "Arial","Verdana", "Tahoma", "Trebuchet MS"
);

/* Spanish Translations*/
load_theme_textdomain( 'tstranslate', TEMPLATEPATH.'/functions/languages' );

$locale = get_locale();
$locale_file = get_template_directory_uri()."/functions/languages/$locale.php";
if ( is_readable($locale_file) ){
	require_once($locale_file);
}

add_action( 'admin_enqueue_scripts', 'light_box' );
add_action( 'admin_enqueue_scripts', 'add_slider' );


if ( ! isset( $content_width ) ) $content_width = 960;

/*Header and Background styles*/
/*
add_custom_background();
define('HEADER_TEXTCOLOR', 'ffffff');
define('HEADER_IMAGE', '%s/img/header_bkg.jpg'); // %s is the template dir uri
function header_style() { ?>
	<!--<style type="text/css"> #header { background: url(<?php //header_image(); ?>); } </style>-->
<?php }
function admin_header_style(){?>
	<style type="text/css"> #headimg { width: 250px; height: 250px; background: no-repeat; } </style><?php
}
add_custom_image_header('header_style', 'admin_header_style');*/

function add_slider(){?>
<script type='text/javascript'>
	var upload_slider_text='<?php echo __('Upload a slider file','tstranslate') ?>';
	var upload_logo_text='<?php echo __('Upload a logo file','tstranslate') ?>';
</script>
<?php
	
	wp_enqueue_script("h5validate", get_template_directory_uri().'/functions/jquery.h5validate.js', false, $_SERVER['REQUEST_TIME'],true);
	wp_enqueue_script("fileuploader", get_template_directory_uri().'/functions/fileuploader.js', false, $_SERVER['REQUEST_TIME'],true);	//para upload de archivos	
	wp_enqueue_script("ajax_validation", get_template_directory_uri().'/functions/ajax_validation.js', false, $_SERVER['REQUEST_TIME'],true);	
	//add_action('init', 'ilc_farbtastic_script');
	
	wp_enqueue_script('postbox');
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
}

function light_box(){
	wp_enqueue_script("colorbox", get_template_directory_uri().'/js/colorbox.js', false, "1.0");
	//wp_enqueue_style( 'farbtastic' );//use for de colorpicker styles
	//wp_enqueue_script( 'farbtastic' );//use for the colo picker funcitonally
}

/*Menu register*/
add_action('init', 'register_shock_menu');
function register_shock_menu() {
	register_nav_menus(array('shock_menu'=> 'Shock Menu: place the menu you want as primary navigation.', 'optional_topbar' => 'Top bar Menu'));
} 

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
   $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category");

function themeshock_add_admin() {
	global $themename, $shortname,  $wpdb;
	if ( isset($_GET['page']) == basename(__FILE__) ) {
		if ( 'save' == isset($_REQUEST['action']) ) {
			foreach ($_POST as $option_name  => $newvalue) {
				switch($option_name){///parta evitar datos basura del layout generator
					case 'top_1_style':
					case 'top_2_style':
					case 'left_1_style':
					case 'left_2_style':					
					case 'right_1_style':					
					case 'right_2_style':
					case 'bottom_1_style':
					case 'bottom_2_style':
					case 'slider_blog':
					case 'slider_single':
					case 'slider_search':
					case 'slider_archive':
					case 'slider_category':
					case 'footer_widget_style':
					case 'themeshock_featured':
					case 'ft_size':					
					break;
					default:
						update_option( $option_name, $newvalue );
						if($option_name=='ts_shopping_cart_woo'){
							$result124=getThemeGenShoppingCart(true);
						}
					break;
				}
			}
		}
	}
	if($result124){
		@header('location: '.admin_url('admin.php?page=functions.php'));
		// exit;
	}
	add_object_page($themename, $themename, 'administrator', basename(__FILE__), 'themeshock_admin');
}

function themeshock_add_init() {
	$file_dir = get_template_directory_uri();
	wp_enqueue_style("functions", $file_dir."/functions/functions.css", true, "1.0", "all");
	//wp_enqueue_style("colorbox", $file_dir."/css/colorbox.css", true, "1.0", "all");
	wp_enqueue_script('comment-reply');
	add_editor_style();
}

/*********************/
/* Setup font style */
/*******************/

function get_wptg_font_style(){
	global $themename, $shortname, $font_style_pack;
	$headings = array('H1', 'H2', 'H3', 'H4', 'H5', 'H6');
	?>
	<div>
		<b>Body (paragraphs)</b>
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname;?>_fontFamilyTagP"><?php echo __('Font Family','tstranslate')?></label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select name="<?php echo $shortname;?>_fontFamilyTagP" id="<?php echo $shortname;?>_fontFamilyTagP">
				<option value="inherit"> Inherit </option>
				<?php
					$get_font_style = get_option($shortname.'_fontFamilyTagP');
					foreach($font_style_pack as $font_styles){?>
						<option <?php echo ($get_font_style === $font_styles)?'selected="selected"':''; ?>  ><?php echo $font_styles;?></option><?php
					}
				?>
			</select>
		</div>
	</div>
	<div>
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_fontSizeTagP"><?php echo __('Font Size','tstranslate')?></label>
			<br />
			<label for="<?php echo $shortname.'_fontColorTagP';?>">Color</label>
		</div>
		<div class="display-table-cell table-cell-2 fontStyle_inputs">
			<select name="themeshock_fontSizeTagP" id="<?php echo $shortname;?>_fontSizeTagP">
				<option value="inherit"> Inherit </option>
				<?php
					$get_fontSizeTagP = get_option($shortname.'_fontSizeTagP');
					$get_fontColorTagP = get_option($shortname.'_fontColorTagP', 'Inherit');
					foreach(range(10, 30) as $size){?>
						<option <?php echo ($get_fontSizeTagP == $size)?'selected="selected"':''; ?> value="<?php echo $size?>"><?php echo $size;?>px</option><?php
					}?>
			</select>
			<input type="text" value="<?php echo($get_fontColorTagP != 'Inherit')?$get_fontColorTagP:"Inherit"?>" placeholder="Use hex, rgb, hsl or color name" title="Please Use hex, rgb, hsl or color name eg(#333,  rgb(200, 200, 200), hsl(0, 0%, 20%) or blue)" pattern="(blue|red|orange|aqua|green|white|black|lime|purple|yellow|maroon|fuschia|navy|silver|gray|olive|teal|inherit|Inherit|^(hsl|rgb|#)[a-fA-F0-9\,\(\)%]+)" name="<?php echo $shortname.'_fontColorTagP';?>" id="<?php echo $shortname.'_fontColorTagP';?>"/>
		</div>
	</div>
	<div class="description-full"></div>
  
	<div>
		<b>Headings (Titles)</b>
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_fontFamilyTagHeading"><?php echo __('Font Family','tstranslate')?></label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select name="themeshock_fontFamilyTagHeading" id="<?php echo $shortname;?>_fontFamilyTagHeading">
			<option value="inherit"> Inherit </option>
			<?php
				$get_fontFamilyTagHeading = get_option($shortname.'_fontFamilyTagHeading');
				foreach($font_style_pack as $font_styles){?>
					<option <?php echo ($get_fontFamilyTagHeading === $font_styles)?'selected="selected"':''; ?> ><?php echo $font_styles;?></option><?php
				}
			?>
			</select>
		</div>
	</div>
  
	<?php 
		foreach($headings as $heading){?>
		<div>
			<div class="display-table-cell table-cell-first">
				<label for="<?php echo $shortname.'_fontSizeTag'.$heading;?>"><?php echo $heading?></label>
				<br />
				<label for="<?php echo $shortname.'_fontColorTag'.$heading;?>">Color</label>
			</div>
			<div class="display-table-cell table-cell-2 fontStyle_inputs">
				<input type="text" name="<?php echo $shortname.'_fontSizeTag'.$heading;?>" class="fontSizeTagHeadings" title="Please enter digits (0-9) between 10 - 999 or Ihnerit Value" id="<?php echo $shortname.'_fontSizeTag'.$heading;?>" pattern="(inherit|Inherit|[0-9]{2,3})" placeholder="Digits (0-9) between 10 - 999 or Ihnerit Value" value="<?php echo get_option($shortname.'_fontSizeTag'.$heading, 'Inherit')?>"/>
				<!--<option value="inherit"> Inherit </option> 
				<?php
				$get_fontSizeTag = get_option($shortname.'_fontSizeTag'.$heading, 'Inherit');
				$get_fontColorTag = get_option($shortname.'_fontColorTag'.$heading, 'Inherit');
				foreach(range(16, 250) as $size){?>
					<option <?php echo ($get_fontSizeTag == $size)?'selected="selected"':'';?> value="<?php echo $size?>" ><?php echo $size;?>px</option><?php
				}?>
				</select>-->
				<input type="text" value="<?php echo($get_fontColorTag != 'Inherit')?$get_fontColorTag:"Inherit"?>"
				name="<?php echo $shortname.'_fontColorTag'.$heading;?>" maxlength="16" class="fontColorTagHeadings" placeholder="Use hex, rgb, hsl or color name" title="Please Use hex, rgb, hsl or color name eg(#333,  rgb(200, 200, 200), hsl(0, 0%, 20%) or blue)" pattern="(blue|red|orange|aqua|green|white|black|lime|purple|yellow|maroon|fuschia|navy|silver|gray|olive|teal|inherit|Inherit|^(hsl|rgb|#)[a-fA-F0-9\,\(\)%]+)" id="<?php echo $shortname.'_fontColorTag'.$heading;?>" />
			</div>
		</div>
	<?php }	?>
	<div class="inside-row">
		<span><b>(Inherit)</b> Inherit from downloaded theme</span>
		<div class="clear"></div>
		<span><b>(Color)</b> Use hex, rgb, hsl or color name eg(#333,  rgb(200, 200, 200), hsl(0, 0%, 20%) or blue)</span>
	</div>
	<div class="clear"></div>
	<small><?php echo __('Select the font scheme for the header tags','tstranslate')?></small>
<?php }
/***************/
/* Setup Logo */
/*************/
function get_wptg_logo(){
	global $themename, $shortname, $font_style_pack;
	$get_enable_logo_footer= get_option($shortname.'_enable_logo_footer');
	$get_logo_type = get_option($shortname.'_logo_type');
	?>
	<img src="<?php echo get_template_directory_uri();?>/img/frame_gallery/loading.gif" style="display:none;" class="aviso_text" align="center"/>
	<span class="title_type_logo">Image based Logo</span>
	<div class="setup-logo-area setup-image-logo" <?php echo(isset($GLOBALS['error_folder']))?'style="display:none"':''; ?>>
		<div class="header-logo-setup">
			<label for="logo_type_image">Click here for use an image as logo for your site.</label>
			<input type="radio" id="logo_type_image" name="<?php echo $shortname;?>_logo_type" value="image" <?php echo ($get_logo_type === "image")?'checked="checked""':''; ?>/>
		</div><!-- end choose_logo_type -->
		<div class="area_options_logo">
			<label for="logo_type_image">
				<div class="logo-currenty-disabled" data-type="image">
					<label style="line-height: 152px;">Currently disabled in your website</label>
				</div>
			</label>
			<div id="TS_logo_uploader">
				<noscript><p>Please enable JavaScript to use file uploader.</p></noscript>
			</div>
			<ol id="logo_stored">
				<li><img src="<?php echo $GLOBALS['logo_info']['url'];?>" id="logo_url"/></li>
			</ol>
			<div class="clear"></div>
		</div>
		<div class="footer-logo-setup">
			<span class="text_info"><?php echo __('Choose your logo to upload','tstranslate')?></span>
		</div>
	</div>
	<span class="title_type_logo">CSS based logo</span>
	<div class="setup-logo-area setup-text-logo" <?php echo  (isset($GLOBALS['error_folder']))?'style="display:none"':''; ?>>
		<div class="header-logo-setup">
			<label for="logo_type_text">Click here for use a text as logo for your site.</label>
			<input type="radio" id="logo_type_text" name="<?php echo $shortname;?>_logo_type" value="text" <?php echo ($get_logo_type === "text")?'checked="checked""':''; ?> />
		</div><!-- end choose_logo_type -->
		<div class="area_options_logo">
			<label for="logo_type_text">
				<div class="logo-currenty-disabled" data-type="text">
					<label style="line-height: 152px;">Currently disabled in your website</label>
				</div>
			</label>
			<div>
				<label for="<?php echo $shortname; ?>_text_logo"><?php echo __('Text Logo','tstranslate')?></label>
				<input name="themeshock_text_logo" id="<?php echo $shortname; ?>_text_logo" type="text" value="<?php echo stripslashes(get_option($shortname.'_text_logo', 'My Company')); ?>" />
			</div>
			<div>
				<label for="<?php echo $shortname; ?>_font_size_logo"><?php echo __('Font Size(e.g. 50px)','tstranslate')?></label>
				<input name="themeshock_font_size_logo" id="<?php echo $shortname; ?>_font_size_logo" type="text" value="<?php echo get_option($shortname.'_font_size_logo', '50px'); ?>" />
			</div>
			<div>
				<label for="<?php echo $shortname; ?>_text_logo_effect"><?php echo __('Effect','tstranslate')?></label>
				<select name="themeshock_text_logo_effect" id="<?php echo $shortname; ?>_text_logo_effect">
					<?php 
						$effects_logo_text = array("Normal", "Alpha", "Embossed", "Shadow", "3D", "Neon", "Anaglyphs", "Retro");
						$get_effect_logo_text = get_option($shortname.'_text_logo_effect', 'Normal');
						foreach($effects_logo_text as $effect_logo_text ){ ?>
						  <option <?php echo ($get_effect_logo_text === $effect_logo_text)?'selected="selected"':''; ?>  ><?php echo $effect_logo_text; ?></option><?php
						}
					?>
				</select>
			</div>
			<div>
				<label for="<?php echo $shortname; ?>_logo_font_family"><?php echo __('Font Family','tstranslate')?></label>
				<select name="themeshock_logo_font_family" id="<?php echo $shortname; ?>_logo_font_family">
					<option>Default</option>
					<?php
						$get_logo_font_family = get_option($shortname.'_logo_font_family');
						foreach($font_style_pack as $font_styles ){?>
							<option <?php echo ($get_logo_font_family === $font_styles)?'selected="selected"':''; ?>><?php echo $font_styles; ?></option><?php
						}
					?>
				</select>
			</div>
			<div class="clear"></div>
		</div>
		<div class="footer-logo-setup">
			<span class="text_info"><?php echo __('Your text logo settings','tstranslate')?></span>
		</div>
	</div>
	<div class="logo-footer-area">
		<label for="<?php echo $shortname; ?>_enable_logo_footer"><?php echo __('Logo footer','tstranslate')?></label>
		<input name="themeshock_enable_logo_footer" id="<?php echo $shortname; ?>_enable_logo_footer" type="checkbox" <?php echo($get_enable_logo_footer == 'true')?'checked="checked"':''?> value="true"/>			
		<small><?php echo __('Show logo in footer area','tstranslate')?></small>
	</div><!-- end inside-cols -->
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
	<script>
		jQuery(function(){
			jQuery('#wptg-logo input[name="themeshock_logo_type"]').click(function(e){
				$themeshockLogoType = jQuery('#wptg-logo input[name="themeshock_logo_type"]:checked').val();
				jQuery('.logo-currenty-disabled').hide();
				($themeshockLogoType == 'image')?jQuery('.setup-text-logo .logo-currenty-disabled').show():jQuery('.setup-image-logo .logo-currenty-disabled').show();
			});
			jQuery('#wptg-logo input[name="themeshock_logo_type"]:checked').trigger('click');
		});
	</script>
<?php }

/*****************/
/* Setup Search */
/* Setup Menu **/
/**************/

function getThemeGenHeaderElements(){
	global $themename, $shortname, $wpdb, $screen_layout_columns;?>
	<div class="inside-row">
		<label for=""><?php echo __('Menu Customization','tstranslate')?></label>
		<a href="nav-menus.php" target="_blank"><?php echo __('Main Menu','tstranslate')?></a>
		<small><?php echo __('Use this link to customize the items of your main menu.','tstranslate')?></small>
	</div>
	<label for="<?php echo $shortname; ?>_show_main_menu"><?php echo __('Show Main Menu','tstranslate')?></label>
	<?php $show_main_menu= get_option($shortname.'_show_main_menu', 'true')?>
	<input name="themeshock_show_main_menu" id="<?php echo $shortname; ?>_show_main_menu" type="checkbox" <?php echo ($show_main_menu == 'true')?'checked="checked"':''?> value="true"/>
	<small><?php echo __('Show main menu in header area','tstranslate')?></small>
	<div class="clear"></div>
	<label for="<?php echo $shortname; ?>_show_search_box"><?php echo __('Show the search box','tstranslate')?></label>
	<?php $show_search_box= get_option($shortname.'_show_search_box', 'true')?>
	<input name="themeshock_show_search_box" id="<?php echo $shortname; ?>_show_search_box" type="checkbox" <?php echo ($show_search_box == 'true')?'checked="checked"':''?> value="true"/>
	<small><?php echo __('Check the options you would like to display on your site','tstranslate')?></small>
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/*********************/
/* Setup Icon Posts */
/*******************/

function getThemeGenIconPost(){
	global $themename, $shortname;
	$icons = array('Author', 'Date', 'Category', 'Tags', 'Comments', 'Comments2');
	$i = 0;
	?> 
	<small class="description-full2"><?php echo __('Active or deactive Icon views on your Post.','tstranslate')?></small>
	<div class="iconPost" style="margin:5px auto;width:90%;">
	<?php
	foreach($icons as $icon){
		$i++;
		$iconPost = get_option($shortname.'_iconPost'.$icon, 'true')?>
		<input class="iconchk" type="checkbox" id="<?php echo $shortname.'_iconPost'.$icon;?>" name="<?php echo $shortname.'_iconPost'.$icon;?>" value="true" <?php echo ($iconPost == 'true')?'checked="checked"':''?>/>
		<label class="button" for="<?php echo $shortname.'_iconPost'.$icon;?>"><?php echo __($icon, 'tstranslate')?></label>
	<?php } ?>
	</div>
	<small class="description-full2"><?php echo __('Show and hide the properties you want to post.','tstranslate')?></small>
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/*********************/
/* Setup shortcodes */
/*******************/

function getThemeGenShortcodes(){
	global $themename, $shortname, $wpdb, $post;?>

	<div class="inside-row">
		<label class="display-block"><?php echo __('Create custom galleries, portfolios or services pages.','tstranslate')?>
			<span class="question_tooltip">?
				<div class="question_tooltip-description">
					<img src="<?php echo get_template_directory_uri()?>/img/multi_bkg/shortcodeeg.jpg" width="139" height="128"/>
					<p>
						Using the Shortcode, You can repost all your products, services and galleries in any page.
						Only you need copy the shortcode and paste in every page you want the galleries, products or services appear.
					</p>
				</div>
			</span>
		</label>
	</div>
	<div class="inside-row">
		<?php $wptg_cpt = array('gallery'=>'galleries','portfolio'=>'portfolios', 'services'=>'brochures');?>
		<div class="feats wptg-cpt-area">
			<label>Post Type<br />
				<select id="<?php echo $shortname; ?>_wptg_ctp_post_type" >
					<?php foreach($wptg_cpt as $value => $postType){?>
						<option value="<?php echo $value; ?>" data-wptg_ctp="<?php echo $postType;?>"><?php echo $value;?></option>
					<?php }?>
				</select>
			</label>
			<label>Taxonomy<br />
				<select id="<?php echo $shortname; ?>_wptg_ctp_taxonomy" >
					<option value="" class="wptg-group-allitems" selected="selected">All items</option>
					<?php
					foreach($wptg_cpt as $value => $postType){
						$get_terms_wptg_cpt = get_terms($postType, 'order=DESC');
						foreach($get_terms_wptg_cpt as $terms_wptg_cpt){
							echo '<option value="'.$terms_wptg_cpt->slug.'" class="wptg-group-'.$value.'" >'.$terms_wptg_cpt->name.'</option>';
						}
					}?>
				</select>
			</label>
			<label>Frame Style<br />
				<select id="<?php echo $shortname; ?>_wptg_ctp_style" >
					<?php foreach(range(0,14) as $number){?>
						<option value="<?php echo $number;?>"><?php echo $number;?></option>
					<?php }?>
				</select>
			</label>
		</div>
	</div><!-- end row -->
	<div class="inside-row">
		<label for="shortcode_custom_pgs">Your shortcode </label>
		<input type="text" name="wptg_ctg_shortcode" id="shortcode_custom_pgs" class="wptg_ctg_shortcode" value='[wptg-cpt wptg_post_type="gallery" taxonomy="" style="0"]' onclick="copyit(this)"/>
	</div><!-- end row -->
	<small class="description-full2"><?php echo __('Just create the shortcode and paste it in a new page.','tstranslate')?></small>

<?php }

/**************************/
/* Setup MetaTags Favicon*/
/************************/

function getThemeGenMetaTagsFavicon(){
	global $themename, $shortname;?>
	<div class="bottom-saver">
		<span id="wptg-bnr">Theme Generator &copy; <?php echo date('Y');?></span>
		<span class="update_text" style="display:none;"> <b><i>Updating...</i></b></span>
		<span class="updated_text" style="display:none;color:#2a95c5;"> <b><i>Saved!</i></b></span>
	</div>
	<div class="setup-meta-favicon">
		<?php $metaDescrip = stripcslashes(get_option($shortname.'_metaDescription'));?>
		<?php $metaKeywords = stripcslashes(get_option($shortname.'_metaKeywords'));?>
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_favicon"><?php echo __('Custom Favicon','tstranslate')?></label>
		</div>
		<div class="display-table-cell table-cell-2">
			<input name="<?php echo $shortname; ?>_favicon" id="<?php echo $shortname; ?>_favicon" title="Please use a valid format e.g. http://wpthemegenerator.com" type="text" value="<?php echo home_url();?>/favicon.ico" />
		</div>
		<div class="description-full">
			<small><?php echo __('A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image.','tstranslate')?></small>
		</div>
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_metaDescription"><?php echo __('Meta Description','tstranslate')?></label>
		</div>
		<div class="display-table-cell table-cell-2">
			<textarea name="themeshock_metaDescription" id="<?php echo $shortname; ?>_metaDescription" type="textarea" cols="" rows="" style="height:100px;"><?php echo($metaDescrip != '')?$metaDescrip:'';?></textarea>
		</div>
		<div class="description-full">
			<small><?php echo __('How you want your site appears described in search engines.','tstranslate')?></small>
		</div>
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_metaKeywords"><?php echo __('Meta Keywords','tstranslate')?></label>
		</div>
		<div class="display-table-cell table-cell-2">
			<textarea name="themeshock_metaKeywords" id="<?php echo $shortname; ?>_metaKeywords" type="textarea" cols="" rows="" style="height:100px;"><?php echo($metaKeywords != '')?$metaKeywords:'';?></textarea>
		</div>
		<div>
			<small><?php echo __("Used for SEO Positioning and robots. Doesn't function with Panda Algorithm by Google.","tstranslate")?></small>
		</div>
	</div><!-- end setup-meta-favicon -->  
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/****************/
/* Setup Posts */
/**************/

function getThemeGenPosts(){
	global $themename, $shortname?>
	<div class="setup-posts-area">     
		<label for="<?php echo $shortname; ?>_grid_post">View posts as</label>
		<select name="themeshock_grid_post" id="<?php echo $shortname; ?>_grid_post">
		<?php
			$grid_posts = array("List", "Grid");
			$get_grid_posts = get_option($shortname.'_grid_post');
			foreach($grid_posts as $grid_post ){ ?>
				<option <?php echo ($get_grid_posts === $grid_post)?'selected="selected"':''; ?> ><?php echo $grid_post; ?></option><?php
			}
		?>
		</select>
		<div class="clear"></div>
		<div class="grid_size">
			<label>Grid Size</label>
			<select name="themeshock_grid_post_size" id="<?php echo $shortname; ?>_grid_post_size">
				<?php
					$grid_posts_sizes = array("Small", "Normal");
					$get_grid_posts_size = get_option($shortname.'_grid_post_size');
					foreach($grid_posts_sizes as $grid_posts_size ){?>
						<option <?php echo ($get_grid_posts_size === $grid_posts_size)?'selected="selected"':''; ?> ><?php echo $grid_posts_size; ?></option><?php
					}
				?>
			</select>
		</div><!-- end grid_size -->
		<label for="<?php echo $shortname; ?>_postsbox_style">Posts Box Design Style</label>
		<?php
			(isset($GLOBALS['boxes_css']) && $GLOBALS['boxes_css'][1] != 'boxcss_default')?
			$postbox_style = $GLOBALS['boxes_css'][1]:
			$postbox_style = get_option($shortname.'_postsbox_style', 'boxcss_default');
			$default_post_boxes = get_option($shortname.'_default_post_boxes', 'true')?>
			<select name="themeshock_postsbox_style" id="<?php echo $shortname; ?>_postsbox_style" class="postsbox_style" <?php echo ($default_post_boxes == 'true')?'disabled="disabled"':'';?> >
				<option value="boxcss_default">Default Box </option>
				<?php foreach (range(0, 14) as $widget_number){?>
					<option value="<?php echo 'boxcss_'.$widget_number;?>" <?php echo ($postbox_style == 'boxcss_'.$widget_number)?'selected="selected"':'';?>>
				<?php echo ($widget_number != 0)?'Box Style'.$widget_number:'No Box';?>
				</option>
				<?php 
			  } 
		?>
		</select>
		<div class="clear"></div>
		<label>Use post box design as in your downloaded theme</label>
		<input name="themeshock_default_post_boxes" id="<?php echo $shortname; ?>_default_post_boxes" class="default_post_boxes" type="checkbox" <?php echo ($default_post_boxes == 'true')?'checked="checked"':''?> value="true"/>
		<div class="clear"></div>
		<small><?php echo __('select the way you view your posts.','tstranslate')?></small>
		<script>
			jQuery(function(){
				jQuery('.default_post_boxes').change(function(){
					if(jQuery(this).attr('checked')){
						jQuery('.postsbox_style').attr('disabled', true);
					}else{
						jQuery('.postsbox_style').removeAttr('disabled');
					};
				});
				jQuery('#themeshock_grid_post').change(function(){
					(jQuery(this).val() == 'List')?jQuery('.grid_size').hide():jQuery('.grid_size').show();
				}).change();
				
				jQuery('.default_widget_boxes').change(function(){
					if(jQuery(this).attr('checked')){
						jQuery('.selected .widget_style, #footer_widget_style .widget_style').attr('disabled', true);
					}else{
						jQuery('.selected .widget_style, #footer_widget_style .widget_style').removeAttr('disabled');
					};
				}).change();
			});
		</script>
	</div><!-- end setup-posts-area -->
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/***************************/
/* Setup Socials Networks */
/*************************/

function getThemeGenSocialNetworks(){
	global $themename, $shortname, $wpdb, $post;?>  
	<div class="tg_social_network">
	  <?php foreach($GLOBALS['social_network'] as $social_network =>$option_save){?>
	  <div class="display-table-row">
		<div class="display-table-cell">
		  <label for="<?php echo $shortname.$option_save; ?>"><?php echo ucfirst(str_replace('_', ' ', $social_network));?></label>
		</div>
		<div class="display-table-cell table-cell-2">
		  <input name="<?php echo $shortname.$option_save; ?>" id="<?php echo $shortname.$option_save;?>" class="themeshock-mailer" title="Please use a valid format e.g. http://wpthemegenerator.com" type="text" value="<?php echo get_option($shortname.$option_save,'');?>" placeholder="Resource Url"/>
		  <input name="<?php echo $shortname.$option_save; ?>_option" type="checkbox" id="<?php echo $social_network; ?>" value="true" <?php echo (get_option($shortname.$option_save.'_option')==='true')?'checked="checked"':'';?>  />
		</div>
	  </div><!-- end display-table-row -->
	  <?php }?>
	</div>
	<small><?php echo __('Enter the links of your social networks','tstranslate')?></small>
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/***********************/
/* Setup Contact Form */
/*********************/

function getThemeGenContactForm(){
	global $themename, $shortname, $wpdb, $post;?>
	<label for="<?php echo $shortname; ?>_contact_mail"><?php echo __('Contact email','tstranslate')?></label>
	<?php $contact_email=(!get_option($shortname.'_contact_mail'))?'email@email.com':get_option($shortname.'_contact_mail');?>
	<input name="<?php echo $shortname; ?>_contact_mail" id="<?php echo $shortname; ?>_contact_mail" title="Please use a valid format e.g. name@domain.com" placeholder="your@domain.com" pattern="([a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})" type="text" value="<?php echo $contact_email;?>" />
	<small><?php echo __('Enter the e-mail where you want to receive incoming messages.','tstranslate')?></small><div class="clearfix"></div>
	<label for="mainAddr">Your Office or Home Main Address.</label>
	<input type="text" name="<?php echo $shortname; ?>_main_address" id="<?php echo $shortname; ?>_main_address" placeholder="76 Ninth Ave New York" value="<?php echo (!get_option($shortname.'_main_address'))?'':get_option($shortname.'_main_address');?>">
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/****************************/
/* Setup Custom Post Types */
/**************************/

function getThemeGenCustomPostTypes(){
	global $themename, $shortname;
	$CustomPostTypes = array('Gallery', 'Portfolio', 'Products', 'Services', 'Testimonials');
	$fontColorPostType = get_option($shortname.'_fontColorPostType');
	$colors=array("white"=>"","blue"=>"btn-primary","cyan"=>"btn-info","green"=>"btn-success","yellow"=>"btn-warning","red"=>"btn-danger","black"=>"btn-inverse");;
	$fonts=array("Arial"=>"Arial","Verdana"=>"Verdana","Trebuchet"=>"Trebuchet MS","Wire One"=>"Wire One","Tahoma"=>"Tahoma","Calibri"=>"Calibri","Helvetica"=>"Helvetica","Lucida Console"=>"Lucida Console");
	asort($fonts);
	?>
	<span class="title_option_tg_full">Disable/enable custom post type (Gallery, Portfolio, Products, Services, Testimonials)</span>
	<div class="options" style="margin-top:4px;">
		<div style="margin:auto;width:80%;" class="cpUI">
			<?php	foreach($CustomPostTypes as $CustomPostType){?>
			<?php $enableCustomPostType = get_option($shortname.'_enablePostType'.$CustomPostType, 'true'); ?>
			<input name="<?php echo $shortname.'_enablePostType'.$CustomPostType;?>" id="<?php echo $shortname.'_enablePostType'.$CustomPostType;?>" type="checkbox" 
			<?php echo($enableCustomPostType == 'true')?'checked="checked"':'';?> value="true" class="themeshock_custom_post_types"/>
			<label class="button" for="<?php echo $shortname;?>_enablePostType<?php echo $CustomPostType?>"><?php echo __($CustomPostType,'tstranslate')?></label>
			<?php }	?>
		</div>
	</div>
	<div class="clear"></div>
	<br>
	<small class="description_full"><?php echo __('Disable/enable custom post type (Gallery, Portfolio, Products, Services, Testimonials) This option will hide these menus in the slider of wp dashboard interface.','tstranslate')?></small>
	<span class="title_option_tg_full">Font Color custom post type (Gallery, Portfolio, Products, Services, Testimonials)</span>
	<label for="<?php echo $shortname;?>_fontColorPostType"><?php echo __('Font Color','tstranslate')?></label>
	<input name="<?php echo $shortname.'_fontColorPostType';?>" placeholder="Use hex, rgb, hsl or color name" title="Please Use hex, rgb, hsl or color name eg(#333,  rgb(200, 200, 200), hsl(0, 0%, 20%) or blue)" pattern="(blue|red|orange|aqua|green|white|black|lime|purple|yellow|maroon|fuschia|navy|silver|gray|olive|teal|inherit|Inherit|^(hsl|rgb|#)[a-fA-F0-9\,\(\)%]+)" id="<?php echo $shortname.'_fontColorPostType';?>" type="text" value="<?php echo $fontColorPostType;?>" />
	<br>
	<span><b>(Font Color)</b> Use hex, rgb, hsl or color name eg(#333,  rgb(200, 200, 200), hsl(0, 0%, 20%) or blue)</span>
	<?php
	/************************/
	/* GLS Engine ThemeGen */
	/**********************/
	?>
	<!--begin gls implementation-->
	<h4>Pluginterest <i>(Use the 'Grid Layout Shock' power in your website theme).</i></h4>
	<?php
		/*this function draw the post type Id's*/
		/*function get_ID_by_page_name($page_name) {
		   global $wpdb;
		   $page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."' AND post_type = 'page'");
		   return $page_name_id;
		}
		wp_reset_query();
		wp_reset_postdata();*/
		$postypes=array('Gallery-wts','Portfolio-wts','Product-wts','Service-wts');
		$title_postypes=array('Gallery-wts','Portfolio-wts','Product-wts','Service-wts');
		$content_postypes=array('Product-wts','Testimonials-wts');
		$url_img_no_exists_postypes=array('Gallery-wts','Portfolio-wts','Product-wts','Service-wts');
		$readmore_postypes=array('Portfolio-wts','Product-wts');
		$js_postypes=array('Gallery-wts','Portfolio-wts','Product-wts','Service-wts');
		/*if(get_option('themeshock_layout_options')){
			$gls=json_decode(get_option('themeshock_gls_custom_post_type8'));
			var_export($gls);
		}*/
	?>
   
	<div id="showdatatool"></div>
	<div class="display-table-row"> 
		<div class="display-table-cell">
		  <label for="<?php echo $shortname; ?>_gls_custom_post_type">Select custom post type:</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select name="themeshock_gls_custom_post_type" id="<?php echo $shortname; ?>_gls_custom_post_type">
				<option value="">Select One</option>
				<?php
					foreach($postypes as $postype_name){?>
						<option value="<?php echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name);?>" id="<?php echo str_replace('-wts', '',$postype_name);?>"><?php echo str_replace('-wts', '',$postype_name);?></option>
					<?php 
					}
				?>
			</select>
		</div>
	</div>
	<script type="text/javascript" charset="utf-8">
		jQuery('#<?php echo $shortname; ?>_gls_custom_post_type').live('change',function(){
			postypeId=jQuery(this).val();
			return postypeId;
		}).get();
	</script>
	<!--glsimgslctr-->
	<div class="display-table-row <?php echo $shortname;?>_gls_box_width <?php foreach($postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell">
			<label for="<?php echo $shortname;?>_gls_box_width">Box width:</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<input type="text" name="<?php echo $shortname; ?>_gls_box_width" pattern="(inherit|Inherit|[0-9]{2,3})" placeholder="Digits (0-9) between 10 - 999 or Ihnerit Value" id="<?php echo $shortname; ?>_gls_box_width" maxlength="3" form="glsoptions"/>       
		</div>
	</div>
	<div class="display-table-row <?php echo $shortname;?>_gls_box_style <?php foreach($postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell">
			<label for="<?php echo $shortname;?>_gls_box_style">Box Style:</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select id="<?php echo $shortname;?>_gls_box_style" name="<?php echo $shortname;?>_gls_box_style" value="<?php echo $themeshock_gls_box_style; ?>" form="glsoptions">
				<?php for($i=1;$i<=23;$i++): ?>
				<option value="<?php echo $i ?>"><?php echo $i ?></option>
				<?php endfor; ?>
			</select>       
		</div>
	</div>
		<br>
	<div class="display-table-row <?php echo $shortname;?>_gls_box_style <?php foreach($postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell">
			<label for="<?php echo $shortname;?>_gls_box_style">&nbsp;</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<span id="screen_pre" class="screen1">&nbsp;</span>
		</div>
	</div>
	<br>
	<!--rdmrbtnclr-->
	<div class="display-table-row <?php echo $shortname;?>_gls_btn_clr <?php foreach($readmore_postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell">
			<label for="<?php echo $shortname;?>_gls_btn_clr">Button Color</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select name="<?php echo $shortname;?>_gls_btn_clr" id="<?php echo $shortname;?>_gls_btn_clr" form="glsoptions">
				<option value="nobutton" selected="selected">No Button</option>
				<?php
					foreach($colors as $color => $btcolor){
						?>
							<option value="<?php echo $btcolor; ?>"><?php echo $color;?></option>
						<?php
					}
				?>
			</select>
		</div>
	</div>
	<div class="display-table-row <?php echo $shortname;?>_gls_btn_fnt_stl <?php foreach($readmore_postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell">
			<label for="<?php echo $shortname;?>_gls_btn_fnt_stl">Button Font</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select name="<?php echo $shortname;?>_gls_btn_fnt_stl" id="<?php echo $shortname;?>_gls_btn_fnt_stl" form="glsoptions">
				<option selected value="Open Sans"><?php echo __("Theme Default",'usefulmatrixint'); ?></option>
				<?php foreach($fonts as $value=>$name): ?>
					<option value="<?php echo $value ?>"><?php echo $name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="display-table-row <?php echo $shortname; ?>_gls_btn_txt <?php foreach($readmore_postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_gls_btn_txt">Button Text</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<input type="text" name="themeshock_gls_btn_txt" id="<?php echo $shortname; ?>_gls_btn_txt" form="glsoptions"/>
		</div>
	</div>
	<div class="display-table-row <?php echo $shortname;?>_gls_btn_fnt_sz <?php foreach($readmore_postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname;?>_gls_btn_fnt_sz">Button Font Size</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<input type="text" name="<?php echo $shortname;?>_gls_btn_fnt_sz" id="<?php echo $shortname;?>_gls_btn_fnt_sz"  pattern="(inherit|Inherit|[0-9]{2,3})" placeholder="Digits (0-9) between 10 - 999 or Ihnerit Value" id="<?php echo $shortname; ?>_gls_box_width" maxlength="3" form="glsoptions" />
		</div>
	</div>
	<div class="display-table-row <?php echo $shortname;?>_gls_title_font_size <?php foreach($title_postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname;?>_gls_title_font_size">Title Font Size</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<input type="text" name="<?php echo $shortname;?>_gls_title_font_size" id="<?php echo $shortname;?>_gls_title_font_size" pattern="(inherit|Inherit|[0-9]{2,3})" placeholder="Digits (0-9) between 10 - 999 or Ihnerit Value" id="<?php echo $shortname; ?>_gls_box_width" maxlength="3" form="glsoptions" />
		</div>
	</div>
	<div class="display-table-row <?php echo $shortname;?>_gls_title_font_style <?php foreach($title_postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname;?>_gls_title_font_style">Title Font Style</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select id="<?php echo $shortname;?>_gls_title_font_style" name="<?php echo $shortname;?>_gls_title_font_style" form="glsoptions">
				<option selected value="Arial"><?php echo __("Theme Default",'usefulmatrixint'); ?></option>
				<?php foreach($fonts as $value=>$name): ?>
					<option value="<?php echo $value ?>"><?php echo $name; ?></option>
				<?php endforeach; ?>
			</select>  
			<!--<input type="text" name="<?php echo $shortname;?>_gls_title_font_style" id="<?php echo $shortname;?>_gls_title_font_style" />-->
		</div>
	</div>
	<div class="display-table-row <?php echo $shortname;?>_gls_content_font_style <?php foreach($content_postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname;?>_gls_content_font_style">Content Font Style</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select id="<?php echo $shortname;?>_gls_content_font_style" name="<?php echo $shortname;?>_gls_content_font_style" form="glsoptions">
				<option selected value="Arial"><?php echo __("Theme Default",'usefulmatrixint'); ?></option>
				<?php foreach($fonts as $value=>$name): ?>
					<option value="<?php echo $value ?>"><?php echo $name; ?></option>
				<?php endforeach; ?>
			</select> 
			<!--<input type="text" name="<?php echo $shortname;?>_gls_content_font_style" id="<?php echo $shortname;?>_gls_content_font_style" />-->
		</div>
	</div>
	<div class="display-table-row <?php echo $shortname;?>_gls_no_img <?php foreach($url_img_no_exists_postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname;?>_gls_no_img">Url to Image when no images exists</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<input type="text" placeholder="http://" name="<?php echo $shortname;?>_gls_no_img" id="<?php echo $shortname;?>_gls_no_img"  form="glsoptions"/>
		</div>
	</div>
	<br />
	<div class="display-table-row <?php echo $shortname;?>_gls_masonry <?php foreach($js_postypes as $postype_name){ echo $shortname.'_gls_custom_post_type'.get_ID_by_page_name($postype_name),' ';} ?>">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname;?>_gls_masonry">Enable Masonry JS</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<input type="checkbox" value="1" id="<?php echo $shortname;?>_gls_masonry" name="<?php echo $shortname;?>_gls_masonry" form="glsoptions"/>
			let this unchecked for use responsive by css method, or checked for Magical layouts.
		</div>
	</div>
	<br />
	<div class="<?php echo $shortname;?>_gls_save_options">
		  <a href="" class="btn button-primary save-gls">Save this configuration</a>
	</div>
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save-->
  <!--end gls implementation-->
<?php }

/*********************/
/* Setup Responsive */
/*******************/

function getThemeGenResponsive(){
	global $themename, $shortname;?>
	<label for="<?php echo $shortname;?>_enableResponsive"><?php echo __('Enable/Disable Responsive','tstranslate')?></label>
	<?php $enableResponsive = get_option($shortname.'_enableResponsive', 'true');?>
	<input name="<?php echo $shortname;?>_enableResponsive" id="<?php echo $shortname;?>_enableResponsive" type="checkbox" 
	<?php echo($enableResponsive == 'true')?'checked="checked"':'';?> value="true"/>
	<div class="clearfix"></div>
	<small><?php echo __('Use Responsive Design in your WordPress Theme','tstranslate')?></small>
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/**********************/
/* Setup Footer Info */
/********************/

function getThemeGenFooterInfo(){
	global $themename, $shortname;?>
	<div class="display-table-cell table-cell-first">
		<label for="<?php echo $shortname; ?>_info"><?php echo __('Footer Information','tstranslate')?></label>
	</div>
	<div class="display-table-cell table-cell-2">
		<textarea name="themeshock_info" id="<?php echo $shortname; ?>_info" type="textarea" cols="" rows=""><?php echo (!get_option($shortname.'_info'))?'':stripcslashes(get_option($shortname.'_info'));?></textarea>
	</div>
	<small><?php echo __('You can write your company information in this area. This will be automatically added to the footer. Use &lt;br /&gt; to break lines','tstranslate')?></small>
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/***************************/
/* Setup Google Analytics */
/*************************/

function getThemeGenGoogleAnalytics(){
	global $themename, $shortname;?>
	<div class="display-table-cell table-cell-first">
		<label for="<?php echo $shortname; ?>_ga_code"><?php echo __('Google Analytics Code','tstranslate')?></label>
	</div>
	<div class="display-table-cell table-cell-2">
		<textarea name="themeshock_ga_code" id="<?php echo $shortname; ?>_ga_code" type="textarea" cols="" rows="" ><?php echo (!get_option($shortname.'_ga_code'))?'':stripcslashes(get_option($shortname.'_ga_code'));?></textarea>
	</div>
	<small><?php echo __('You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.','tstranslate')?></small>
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/************************/
/* Setup Shopping Cart */
/**********************/

function getThemeGenShoppingCart($callback=false){
	global $themename, $shortname;
	$page_product=array('Products','All pages');
	$GLOBALS['tg_shp_show']=get_option('themeshock_shp_cart_show');
	$shoppinCartUrl = (!get_option($shortname.'_shopping_cart_url'))?'http://www.yourmerchant.com/ ':get_option($shortname.'_shopping_cart_url'); 
	if(get_option('ts_shopping_cart_woo')==='true'){
		$get_plugins=get_plugins();
		$woocommerce=false;
		foreach ($get_plugins as $plugin_file => $plugin_data){
			switch (basename($plugin_file)){
				case 'woocommerce.php':
					$woocommerce=true;
				break;
			}
		}
		if ($woocommerce===true){
			if (is_plugin_active('woocommerce/woocommerce.php')) {
				//the plugin is active
				if(get_page_by_title('Checkout')){
					$notice=' Woocommerce is active and running!!!.';
				}else{
					$notice=' Woocommerce is active and running. click on "Install Woocommerce pages" on top navigation bar.';
				}
				
				$status='<span style="color:#00aa00">Running</span>';	
				?>
				<script type="text/javascript" charset="utf-8">
					jQuery(document).ready(function(){
						jQuery('#uninstall_woo').hide();
						//jQuery('#uninstall_woo').hide();
						jQuery('#themeshock_features').on('click',function(){
							if(jQuery('#themeshock_features_woo').is(':checked')){
								jQuery('#themeshock_features_woo').removeAttr('checked');
							}else{
								jQuery('#themeshock_features_woo').attr('checked','checked');
							}
						});
						jQuery('#themeshock_features_woo').on('click',function(){
							if(jQuery('#themeshock_features').is(':checked')){
								jQuery('#themeshock_features').removeAttr('checked');
							}else{
								jQuery('#themeshock_features').attr('checked','checked');
							}
						});
					});
				</script>
				<?php
			}else{
				$notice='WooCommerce plugin is installed but not active';
				$status='Inactive';	
				/*$plugins = get_option('active_plugins'); // obtenemos los plugins ya activados
				$active_woocommerce='woocommerce/woocommerce.php';
				if ( ! in_array( $active_woocommerce,$plugins ) ) {
					array_push( $plugins,$active_woocommerce );
					update_option( 'active_plugins', $plugins );
				}*/
				activate_plugin('woocommerce/woocommerce.php');
				update_option('themeshock_enablePostTypeProducts','false');
			}
		}else{
			$notice='Pls, Download and Install Woocommerce Plugin';
			$status='Uninstalled';	
		}
		?>
		<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function(){
				jQuery('#uninstall_woo').hide();
			});
		</script>
		<?php
		// update_option('ts_shopping_cart_uninstall_woo','false'); do it
	}else{
		$plugins = get_option('active_plugins'); // obtenemos los plugins ya activados
		$deactive_woocommerce='woocommerce/woocommerce.php';
		deactivate_plugins($deactive_woocommerce);
		//uninstall_plugin($deactive_woocommerce);
		// update_option('themeshock_enablePostTypeProducts','true');
		if(!file_exists('../wp-content/plugins/woocommerce/woocommerce.php')){
			$notice='Pls, Download and Install the latest version of <a href="http://www.woothemes.com/woocommerce/" target="_blank">Woocommerce</a> Plugin into plugins folder of your site';
			$status='<span style="color:#aa0000">Uninstalled</span>';	
			?>
			<script type="text/javascript" charset="utf-8">
				jQuery(document).ready(function(){
					jQuery('#show_enable_woo').hide();
					jQuery('#uninstall_woo').hide();
					jQuery('#show_cart,#show_price,#show_price,#show_currency,#show_tax,#show_tax_auto').show();
				});
			</script>
			<?php
		}else{
			$notice='Are you a merchant?.Want to Begin to sell right now. Check Enable woocommerce  option and save changes for start now!.';
			$status='<span style="color:#aa0000">Inactive</span>';	
			if(get_option('ts_shopping_cart_uninstall_woo')==='true'){
				deactivate_plugins($deactive_woocommerce);
				uninstall_plugin($deactive_woocommerce);
				?>
				<script type="text/javascript" charset="utf-8">
					jQuery(document).ready(function(){
						jQuery('#themeshock_features_woo').on('click',function(){
							if(jQuery('#themeshock_features').is(':checked')){
								jQuery('#themeshock_features').removeAttr('checked');
								jQuery('#uninstall_woo').hide();
							}else{
								jQuery('#themeshock_features').attr('checked','checked');
							}
						});
						jQuery('#themeshock_features').on('click',function(){
							if(jQuery('#themeshock_features_woo').is(':checked')){
								jQuery('#themeshock_features_woo').removeAttr('checked');
							}else{
								jQuery('#themeshock_features_woo').attr('checked','checked');
								jQuery('#uninstall_woo').hide();
							}
						});
					});
				</script>
				<?php
			}
			?>
				<script type="text/javascript" charset="utf-8">
					jQuery(document).ready(function(){
						jQuery('#show_cart,#show_price,#show_price,#show_currency,#show_tax,#show_tax_auto').show();
						jQuery('#themeshock_features').on('click',function(){
							if(jQuery('#themeshock_features_woo').is(':checked')){
								jQuery('#themeshock_features_woo').removeAttr('checked');
								jQuery('#show_cart,#show_price,#show_price,#show_currency,#show_tax,#show_tax_auto').show();
								jQuery('#uninstall_woo').show();
							}else{
								jQuery('#themeshock_features_woo').attr('checked','checked');
								jQuery('#show_cart,#show_price,#show_price,#show_currency,#show_tax,#show_tax_auto').hide();
							}
						});
					});
				</script>
				<?php
				
		}
		?>
				<script type="text/javascript" charset="utf-8">
					jQuery(document).ready(function(){
						jQuery('#uninstall_woo').show();
						jQuery('#themeshock_features_woo').on('click',function(){
							if(jQuery('#themeshock_features').is(':checked')){
								jQuery('#themeshock_features').removeAttr('checked');
								jQuery('#show_cart,#show_price,#show_price,#show_currency,#show_tax,#show_tax_auto').hide();
							}else{
								jQuery('#show_enable').show();
								jQuery('#uninstall_woo').show();
								jQuery('#themeshock_features').attr('checked','checked');
								jQuery('#show_cart,#show_price,#show_price,#show_currency,#show_tax,#show_tax_auto').show();
							}
						});
					});
				</script>
				<?php
	}
	if($callback==true){
		return true;
		//exit; 
	}
	
?>

	themegenerator now integrates with WooCommerce. We now offer the ability to create your own e-commerce site with no coding skills. Transform your WordPress website into a thorough-bred eCommerce store for free. <br /><br />
	<div class="display-block" id="show_enable">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_features">Enable themeshock shop</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<input type="checkbox" name="ts_shopping_cart" id="<?php echo $shortname; ?>_features" value="true" <?php  echo  (get_option('ts_shopping_cart')==='true')?'checked="checked"':''; ?>  />
			<!--<span class="question_tooltip">?
				<div class="question_tooltip-description">
					<img src="<?php echo get_template_directory_uri()?>/img/multi_bkg/shopping_cart.jpg" width="139" height="128"/>
					 <p>
						If you check this option, You can active the shopping cart for sell your products and/or services in your WordPress Site. Please
						remember that you need to have an E-shop and a credit card agent. 
					 </p>
				</div>
			</span>--> <span>You are use default e-shop from theme</span>
		</div>
	</div>
	<!--Used for woocommerce-->
	<div class="display-block" id="show_enable_woo">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_features_woo">Enable woocommerce (Recommended)</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<input type="checkbox" name="ts_shopping_cart_woo" id="<?php echo $shortname; ?>_features_woo" value="true" <?php  echo  (get_option('ts_shopping_cart_woo')==='true')?'checked="checked"':''; ?>  />
			<!--<span class="question_tooltip">?
			<div class="question_tooltip-description">
				<img src="<?php echo get_template_directory_uri()?>/img/multi_bkg/shopping_cart.jpg" width="139" height="128"/>
				<p>
					If you check this option, You can active the shopping cart for sell your products and/or services in your WordPress Site. Please
					remember that you need to have an E-shop and a credit card agent. 
				</p>
			</div>
			</span>--> <span>Active / Deactive Woocommerce plugin</span>
		</div>
	</div>
	<!--end woo-->
	<?php
		if(get_page_by_title('Checkout')){
			?>
			<div class="display-block" id="uninstall_woo" style="display:none;">
				<div class="display-table-cell table-cell-first">
					<label for="<?php echo $shortname; ?>_uninstall_woo">Uninstall</label>
				</div>
				<div class="display-table-cell table-cell-2">
					<input type="checkbox" name="ts_shopping_cart_uninstall_woo" id="<?php echo $shortname; ?>_uninstall_woo" value="true" <?php  echo  (get_option('ts_shopping_cart_uninstall_woo')==='true')?'checked="checked"':''; ?>  />
				  <span>Delete all files created by Woocommerce</span>
				</div>
			</div>
			<?php
		}
	?>
	<div class="display-block">
		<div class="display-table-cell table-cell-first">
			<label for="">status</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<span><?php echo $status;?> <br /> <?php echo $notice;?> </span>
		</div>
	</div>
	<div class="display-block" id="show_cart" style="display:none;">
		<h4>themeshock options</h4>
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_shopping_cart_options">Show shopping cart in </label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select name="themeshock_shp_cart_show[]" multiple="multiple" id="<?php echo $shortname; ?>_shopping_cart_options">
				<?php
					foreach ($page_product as $value){
						if (is_array($GLOBALS['tg_shp_show'])){
						$tg_shp_sl='';
							foreach ($GLOBALS['tg_shp_show'] as $page_verify){
								if ($page_verify===$value){
									$tg_shp_sl='selected="selected"';
								}
							}
						}else{
							$tg_shp_sl='';
						}?>
						<option value="<?php echo $value; ?>" <?php echo $tg_shp_sl; ?>><?php echo $value; ?></option><?php
					}
				?>
			</select>
		</div>
	</div>
	<div class="display-block" id="show_price" style="display:none;">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_shopping_cart_url" style="vertical-align: middle;">Price url**</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<textarea name="themeshock_shopping_cart_url" id="<?php echo $shortname; ?>_shopping_cart_url" type="textarea"><?php echo $shoppinCartUrl;?></textarea>
		</div>
	</div>
	<div class="display-block" id="show_currency" style="display:none;">
		<div class="display-table-cell table-cell-first" style="vertical-align: middle;">
			<label for="<?php echo $shortname; ?>_shopping_cart_currency">Currency</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select name="themeshock_shopping_cart_currency" id="<?php echo $shortname; ?>_shopping_cart_currency">
				<?php
					$shoppingcart_currency_pack=array("USD", "BRL", "CAD", "CNY", "COP", "EUR", "GBP","MXN","JPY" );
					$get_shopping_cart=get_option($shortname.'_shopping_cart_currency');
					foreach($shoppingcart_currency_pack as $shoping_cart_item ){?>
						<option <?php echo ($shoping_cart_item===$get_shopping_cart)?'selected="selected"':''; ?>  ><?php echo $shoping_cart_item; ?></option><?php
					}
				?>   			
			</select>
		</div>
	</div>
	<div class="display-block" id="show_tax" style="display:none;">
		<div class="display-table-cell table-cell-first" style="vertical-align: middle;">
			<label for="<?php echo $shortname; ?>_shopping_cart_tax">Applied Tax</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<input type="text" name="themeshock_shopping_cart_tax" pattern="([0-9]{1,2})" maxlength="2" placeholder="1 - 99" id="<?php echo $shortname; ?>_shopping_cart_tax" value="<?php echo (!get_option($shortname.'_shopping_cart_tax')?'0':get_option($shortname.'_shopping_cart_tax')) ?>" />
		</div>
	</div>
	<div class="display-block" id="show_tax_auto" style="display:none;">
		<div class="display-table-cell table-cell-first" style="vertical-align: middle;">
			<label for="<?php echo $shortname; ?>_shopping_cart_tax_auto">Add tax value to products</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<input type="checkbox" name="themeshock_shopping_cart_tax_auto" id="<?php echo $shortname; ?>_shopping_cart_tax_auto" value="true" <?php  echo  (get_option($shortname.'_shopping_cart_tax_auto')==='true')?'checked="checked"':''; ?>/>
		</div>
	</div>
	<!--<div class="display-block" style="padding: 0 0 3px 0;">
	<div class="display-table-cell table-cell-first" style="vertical-align: middle;">
		<label for="<?php echo $shortname; ?>_shopping_cart_tax">shipping free after</label>
	</div>
	<div class="display-table-cell table-cell-2">
	  <input type="text" name="themeshock_shopping_cart_shipping_free" placeholder="0 - 99" id="<?php echo $shortname; ?>_shopping_cart_shipping_free" value="<?php echo (!get_option($shortname.'_shopping_cart_shipping_free')?'0':get_option($shortname.'_shopping_cart_shipping_free')) ?>" />
	</div>
	</div>-->
	<!--<small>
		** URL where you will receive payment parameters: The parameters should be passed by POST method:<br /><br />
		<i>$_POST['tg_shp_cart'][idproduct]['title']</i>=Receive the Product Name <br /><br />
		<i>$_POST['tg_shp_cart'][idproduct]['quantity']</i>=Products quantity <br /><br />
		<i>$_POST['tg_shp_cart'][idproduct]['price']</i>=Prints the total price for the quantity of such product according to the price defined in Edit product item. <br /><br />
		<i>$_POST['tg_shp_cart'][price_total]</i>=Total Price for items <br /><br />
		<i>$_POST['tg_shp_cart'][total_items]</i>=Items totality sold<br /><br />
		<i>$_POST['tg_shp_cart'][currency]</i>=Prints the currency selected at Options for Theme Generator
	</small>
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/************************/
/* Setup Tool ThemeGen */
/**********************/

function getThemeGenToolWptg(){
	global $themename, $shortname;
	$get_activate_framework_tool= get_option($shortname.'_activate_framework_tool', 'false');
	$framework_tool_ckecked = ($get_activate_framework_tool == 'true')?'checked="checked"':'';?>
	<label for="<?php echo $shortname; ?>_activate_framework_tool"><?php echo __('Show the personalize menu','tstranslate')?></label>
		<input name="themeshock_activate_framework_tool" id="<?php echo $shortname; ?>_activate_framework_tool" type="checkbox" <?php echo $framework_tool_ckecked?> value="true"/>
	<div class="clear"></div>
	<small><?php echo __('Great Tool to customize your theme. show on the frontpage when active, so that you can change aspect of your theme in real time. (colors, patterns, etc)','tstranslate')?></small>
  <!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/*****************************/
/* Setup testimonial quotes */
/***************************/

function getThemeGenTestimonialQuotes(){
	global $themename, $shortname;?>
	<div class="inside-row">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_quote_styles"><?php echo __('Style type','tstranslate')?></label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select name="themeshock_quote_styles" id="<?php echo $shortname; ?>_quote_styles">
				<?php
					$get_testimonial_quote_pack = get_option($shortname.'_quote_styles', 1);
					foreach(range(1, 6) as $testimonial_quote_styles ){ ?>
						<option <?php echo ($get_testimonial_quote_pack == $testimonial_quote_styles)?'selected="selected"':''; ?> ><?php echo $testimonial_quote_styles; ?></option><?php
					}
				?>
			</select>
		</div>
	</div>
	<div class="inside-row">
	<div class="display-table-cell table-cell-first">
		<label for="<?php echo $shortname; ?>_quote_color"><?php echo __('Colors','tstranslate')?></label>
	</div>
	<div class="display-table-cell table-cell-2">
		<select name="themeshock_quote_color" id="<?php echo $shortname; ?>_quote_color">
			<?php
				$testimonial_color_pack = array("gray", "blue", "black", "craft", "white");
				$get_testimonial_color_pack = get_option($shortname.'_quote_color', 'gray');
				foreach($testimonial_color_pack as $testimonial_color_styles ){ ?>
					<option <?php echo ($get_testimonial_color_pack == $testimonial_color_styles)?'selected="selected"':''; ?> ><?php echo $testimonial_color_styles?></option><?php
				}
			?>
		</select>
	</div>
	</div>
	<small><?php echo __('Select the quotes styles you want to use on your Testimonials page.','tstranslate')?></small>
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

/*****************/
/* Setup slider */
/***************/

function getThemeGenSlider(){
	global $themename, $shortname;?>
	<!-- if SliderShock Plugin is Active use this -->
	<?php
		$actplugin=is_plugin_active('slidershock/wpts_slider.php');
		if($actplugin){
			?>
				<div class="slidershockStatus inside-row" style="margin-top:4px;">
					<strong>The Following Effects And Styles Are Enabled:</strong>
					<code>
						Big Slider, Multiple Effects -
						Full Big Slider, Top Position -
						Big Poster -
						Poster - 
						Scale Slider - 
						Horizontal Cube Slider - 
						Vertical Cube Slider -
						Horizontal Slice Slider.
					</code>
					<script type="text/javascript">
					/*	jQuery(function(){
							jQuery('#themeshock_slider_type').change(function(){
								var sliderVal = jQuery(this).val();
								switch(sliderVal){
									case 'random-top':
										jQuery('#themeshock_feat_width_slider').val('100%');
									break;
								}
							});
						});*/
					</script>
				</div>
			<?php
		}else{
			?>
				<div class="suggestPlugin">
					<h4>Active Or Download Slidershock Plugin And Enjoy Exclusive And Preconfigured Sliders For The Themegenerator's Main Slider Area.</h4>
					<script type="text/javascript">
						jQuery(function(){
							/*jQuery('select[name="themeshock_slider_type"] option[value="random-top"],select[name="themeshock_slider_type"] option[value="random"],select[name="themeshock_slider_type"] option[value="kaleidoscope"],select[name="themeshock_slider_type"] option[value="featured-poster"],select[name="themeshock_slider_type"] option[value="cubeV"],select[name="themeshock_slider_type"] option[value="cubeH"],select[name="themeshock_slider_type"] option[value="scale"],select[name="themeshock_slider_type"] option[value="sliceH"]').hide();*/
						});
					</script>
				</div>
			<?php
		}
	?><!-- end -->
	<div class="inside-row">
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_slider_type"><?php echo __('Slider type','tstranslate')?></label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select name="<?php echo $shortname;?>_slider_type" id="<?php echo $shortname;?>_slider_type">
			<?php
				$get_slider_type = get_option($shortname.'_slider_type');
				foreach ($GLOBALS['tgsliderpack'] as $value => $name_slider):
					switch($value){
						case "random-top":
						case "random":
						case "random-relative":
						case "random-medium":
						case "kaleidoscope":
						case "featured-poster":
						case "cubeV":
						case "cubeH":
						case "scale":
						case "sliceH":
							if(!$actplugin){
								continue 2 ;
							}
						break;
						/*default:
							$id='slider_type_'.$value;
						break;*/
					}
					$sldpack=(is_array($name_slider))?$name_slider['sldpack']:'none';
					$name=(is_array($name_slider))?$name_slider['name']:$name_slider;
				?>
					<option value="<?php echo $value; ?>" data-pack="<?php echo $sldpack; ?>" <?php echo ($get_slider_type === $value)?'selected="selected"':''; ?>  ><?php echo empty($name)?$value:$name;  ?></option>
				<?php
					endforeach;
				?>
			</select>
		</div>
		<small><?php echo __('Select the slider you want to use on your site.','tstranslate')?></small>
	</div>
	<script>
		jQuery(function(){
			jQuery('#themeshock_slider_type').change(function(){
				$this_val = jQuery(this).val();
				jQuery('.slider-area-options').hide();
				jQuery('.slider-area-'+$this_val).show();
				($this_val == 'Featured-Slider')?jQuery('#wptg-slider .uploader').hide():jQuery('#wptg-slider .uploader').show();
			}).change();
		});
	</script>                
	<div id="slider_type">
		<?php
			$get_slider_effect = get_option($shortname.'_slider_fx');
			$slider_effect_pack = array('random', 'sliceDownRight','sliceDownLeft','sliceUpRight','sliceUpLeft','sliceUpDown','sliceUpDownLeft','fold','fade','boxRandom',
			'boxRain','boxRainReverse','boxRainGrow','boxRainGrowReverse');
			$slider_autoplay_pack = array('no','yes');
			$tweentype_pack = array('linear', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad','easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart','easeOutQuart',
			'easeInOutQuart', 'easeInQuint', 'easeOutQuint','easeInOutQuint', 'easeInSine', 'easeOutSine', 'easeInOutSine','easeInExpo', 'easeOutExpo', 'easeInOutExpo', 'easeInCirc', 
			'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic','easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack','easeInBounce', 'easeOutBounce', 'easeInOutBounce');
			$get_tweentype = get_option($shortname.'_pm_tweenType');
			$get_ea_autoplay = get_option($shortname.'_ea_autoplay');
			$ea_autoplay_pack = array('no','yes');
			$slider_type = get_option($shortname."_slider_type");
			$slider_fonts=array(
				'Arial',
				'Verdana',
				'Trebuchet MS',
				'Tahoma',
				'Calibri',
				'Default',
				'Helvetica',
				'Lucida Console',
				'Alfa Slab One',
				'Alice',
				'Allan',
				'Amaranth',
				'Anonymous Pro',
				'Baumans',
				'Boogaloo',
				'Buda',
				'Coustard',
				'Crushed',
				'Cuprum',
				'Damion',
				'Federo',
				'Gruppo',
				'Josefin Slab',
				'Just Another Hand',
				'Lobster Two',
				'Maiden Orange',
				'Nobile',
				'Philosopher',
				'Raleway',
				'Wire One'
			);
			//sort($slider_fonts);
		?>
		<div class="slider-area-options slider-area-Nivo-Slider">
			<div class="inside-row">
				<div class="display-table-cell table-cell-first">
				  <label for="<?php echo $shortname; ?>_anim_speed"><?php echo __('Animation speed','tstranslate')?></label>
				</div>
				<div class="display-table-cell table-cell-2">
					<input name="themeshock_anim_speed" id="<?php echo $shortname; ?>_anim_speed" type="text" value="<?php echo get_option($shortname.'_anim_speed'); ?>" />
				</div>
			</div><!-- end inside-row -->
			<div class="inside-row">
				<div class="display-table-cell table-cell-first">
					<label for="<?php echo $shortname; ?>_slider_fx"><?php echo __('Slider Effect','tstranslate');?></label>
				</div>
				<div class="display-table-cell table-cell-2">
					<select name="themeshock_slider_fx" id="<?php echo $shortname; ?>_slider_fx">
						<?php foreach($slider_effect_pack as $slider_effect ){ ?>
							<option <?php echo ($get_slider_effect === $slider_effect)?'selected="selected"':''; ?> ><?php echo $slider_effect; ?></option>
						<?php } ?>
					</select>
				</div>
			</div><!-- end inside-row -->
		</div><!-- end slider-area-nivo -->
		<div class="slider-area-options slider-area-Piecemaker">
			<div class="inside-row">
				<div class="display-table-cell table-cell-first">
					<label for="<?php echo $shortname; ?>_pm_tweenType">TweenType</label>
				</div>
				<div class="display-table-cell table-cell-2">
					<select name="themeshock_pm_tweenType" id="<?php echo $shortname; ?>_pm_tweenType">
						<?php foreach($tweentype_pack as $tweentype ){ ?>
							<option <?php echo ($get_tweentype === $tweentype)?'selected="selected"':''; ?>><?php echo $tweentype; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="display-table-cell table-cell-first">
				<label for="<?php echo $shortname; ?>_pm_autoplay"><?php echo __('Delay in seconds','tstranslate')?></label>
			</div>
			<div class="display-table-cell table-cell-2">
				<input name="themeshock_pm_autoplay" id="<?php echo $shortname; ?>_pm_autoplay" type="text" value="<?php echo get_option($shortname.'_pm_autoplay'); ?>" />
			</div>
		</div><!-- end slider-area-piecemaker -->
		<div class="slider-area-options slider-area-Featured-Slider">
			<!-- slider effect -->
			<div class="inside-row">
				<div class="display-table-cell table-cell-first">
					<label for="<?php echo $shortname; ?>_slider_effect"><?php echo __('Slider Effect','tstranslate')?></label>
				</div>
				<div class="display-table-cell table-cell-2">
					<select name="<?php echo $shortname;?>_feat_effect_slider" id="<?php echo $shortname;?>_feat_effect_slider">
						<?php	    
							$slidr_effect=array("default","cubeH","cubeV","fade");
							foreach($slidr_effect as $feat_effect){?>
								<option <?php echo (get_option('themeshock_feat_effect_slider') === $feat_effect)?'selected="selected"':''; ?>  ><?php echo $feat_effect;?></option><?php
							}
						?>
					</select>
				</div>
			</div><!-- end slider effect -->
		</div><!-- end animation speed -->
		<!-- muestra para uso tecnico y pruebas  -->
		<!--use for <?php echo $type; ?> animation implemnetation-->
		<?php
			$doEffects=array("fade","sliceV","slideV","blindH","blindV","blockScale");
			$customEffects=array("fade","sliceV","slideV","slideH","blockScale","blindH","blindV","cubeV","cubeH","fan","kaleidoscope","featured-poster","scale","random-top","random-relative","random-medium","random","slideH","sliceH");
		?>
		<!-- autoplay <?php echo $type; ?>-->
		<div class="slider-area-options <?php foreach ($doEffects as $availableEffect){ echo 'slider-area-'.$availableEffect.' '; } ?> slider-area-Featured-Slider">
			<div class="display-table-cell table-cell-first">
				<label for="<?php echo $shortname; ?>_feat_slidr_autoplay"><?php echo __('Delay in miliseconds','tstranslate')?></label>
			</div>
			<div class="display-table-cell table-cell-2">
				<input name="themeshock_feat_slidr_autoplay" id="<?php echo $shortname; ?>_feat_slidr_autoplay" type="text" value="<?php echo get_option('themeshock_feat_slidr_autoplay'); ?>" />
			</div>
		</div>
		<!-- fin muestra para uso tecnico y pruebas -->
		<!--Responsiveness-->
		<div class="slider-area-options slider-area-Featured-Slider size_feat_tool" style="margin-top:4px;">
			<div class="display-table-cell table-cell-first">
				<label for="<?php echo $shortname; ?>_feat_responsiveness_slider"><?php echo __('Do Responsive:','tstranslate')?></label>
			</div>
			<?php get_option($shortname.'_feat_responsiveness_slider','no'); ?>
			<div class="display-table-cell table-cell-2 responsive_options">
				<input type="radio" name="themeshock_feat_responsiveness_slider" class="<?php echo $shortname; ?>_feat_responsiveness_slider" id="responsive-feat-yes" value="yes" checked="checked" <?php echo (get_option($shortname.'_feat_responsiveness_slider')=='yes')?'checked="checked"':''; ?> ><label for="responsive-feat-yes" class="button" style="border-radius:4px 0 0 4px;margin-left:4px;">Yes</label>
				<input type="radio" name="themeshock_feat_responsiveness_slider" class="<?php echo $shortname; ?>_feat_responsiveness_slider" id="responsive-feat-no" value="no" <?php echo (get_option($shortname.'_feat_responsiveness_slider')=='no')?'checked="checked"':''; ?> ><label for="responsive-feat-no" class="button">no</label>
			</div>
		</div>
		<!--Responsiveness to fixed-->
		<div class="slider-area-options slider-area-Featured-Slider width_options size_feat_tool themeshock_feat_size_slider" style="margin-top:4px;">
			<div class="display-table-cell table-cell-first fixed_options">
				<label for="<?php echo $shortname; ?>_feat_width_slider"><?php echo __('Slider Width:','tstranslate')?></label>
			</div>
			<script>
				jQuery('#themeshock_feat_width_slider').live('change',function(){
					var sw=jQuery(this).val();
					if(sw!=900){
						jQuery('#fDefault').hide();
					}else{
						jQuery('#fDefault').show();
					}
				});
			</script>
			<div class="display-table-cell table-cell-2 width_options">
				<input name="themeshock_feat_width_slider" id="<?php echo $shortname; ?>_feat_width_slider" type="text" value="<?php echo get_option($shortname.'_feat_width_slider','900'); ?>" placeholder="Enter value using 'px' or '%' suffix" pattern="([0-9(px|%)]{2,5})" maxlength="5"/>
			</div>
		</div>
		<!--fixed height-->
		<div class="slider-area-options slider-area-Featured-Slider size_feat_tool">
			<div class="display-table-cell table-cell-first">
				<label for="<?php echo $shortname; ?>_feat_height_slider"><?php echo __('Slider Height:','tstranslate')?></label>
			</div>
			<div class="display-table-cell table-cell-2">
				<input name="themeshock_feat_height_slider" id="<?php echo $shortname; ?>_feat_height_slider" type="text" value="<?php echo get_option($shortname.'_feat_height_slider','366'); ?>" placeholder="Enter value" pattern="([0-9(px|%)]{2,5})" maxlength="5"/>
			</div>
		</div>
		<!--Captions fields-->
		<div class="slider-area-options slider-area-Featured-Slider" style="margin-top:4px;">
			<div class="display-table-cell table-cell-first">
				<label for="<?php echo $shortname; ?>_feat_caption_fields_slider"><?php echo __('Captions Fields:','tstranslate')?></label>
			</div>
			<div class="display-table-cell table-cell-2 fields_options">
				<input type="checkbox" name="themeshock_feat_caption_field_title_slider" <?php echo (get_option($shortname.'_feat_caption_field_title_slider'))?'checked="checked"':'checked="checked"' ; ?> class="<?php echo $shortname; ?>_feat_caption_field_slider" id="field_title" value="yes"><label for="field_title" class="button" style="border-radius:4px 0 0 4px;margin-left:4px;">Title</label>
				<input type="checkbox" name="themeshock_feat_caption_field_date_slider" <?php echo (get_option($shortname.'_feat_caption_field_date_slider')=='true')?'checked="checked"':'' ; ?> class="<?php echo $shortname; ?>_feat_caption_field_slider" id="field_date" value="true"><label for="field_date" class="button" style="width:55px;">Date</label>
				<input type="checkbox" name="themeshock_feat_caption_field_text_slider" <?php echo (get_option($shortname.'_feat_caption_field_text_slider')=='true')?'checked="checked"':'' ; ?> class="<?php echo $shortname; ?>_feat_caption_field_slider" id="field_text" value="true"><label for="field_text" class="button" style="width:55px;">Text</label>
				<input type="checkbox" name="themeshock_feat_caption_field_author_slider" <?php echo (get_option($shortname.'_feat_caption_field_author_slider') == 'true')?'checked="checked"':'';?> class="<?php echo $shortname; ?>_feat_caption_field_slider" id="field_author" value="true"><label for="field_author" class="button" style="width:55px;">Author</label>
			</div>
		</div>
		<!--thumbs positions-->
		<div class="slider-area-options slider-area-Featured-Slider <?php foreach ($doEffects as $availableEffect){ echo 'slider-area-'.$availableEffect.' '; } ?>" style="margin-top:4px;">
			<div class="display-table-cell table-cell-first">
				<label for="<?php echo $shortname; ?>_feat_caption_fields_slider"><?php echo __('Thumbs Position:','tstranslate')?></label>
			</div>
			<div class="display-table-cell table-cell-2 thumbs_options">
				<input type="radio" name="themeshock_feat_thumb_position_slider" class="<?php echo $shortname; ?>_feat_thumb_slider" id="thumb_none" value="none" checked="checked" <?php echo (get_option($shortname.'_feat_thumb_position_slider')=='none')?'checked="checked"':''; ?> ><label for="thumb_none" class="button" style="border-radius:4px 0 0 4px;margin-left:4px;">none</label>
				<input type="radio" name="themeshock_feat_thumb_position_slider" class="<?php echo $shortname; ?>_feat_thumb_slider" id="thumb_left" value="left" <?php echo (get_option($shortname.'_feat_thumb_position_slider')=='left')?'checked="checked"':''; ?> ><label for="thumb_left" class="button">left</label>
				<input type="radio" name="themeshock_feat_thumb_position_slider" class="<?php echo $shortname; ?>_feat_thumb_slider" id="thumb_right" value="right" <?php echo (get_option($shortname.'_feat_thumb_position_slider')=='right')?'checked="checked"':''; ?> ><label for="thumb_right" class="button">right</label>
				<input type="radio" name="themeshock_feat_thumb_position_slider" class="<?php echo $shortname; ?>_feat_thumb_slider" id="thumb_top" value="top" <?php echo (get_option($shortname.'_feat_thumb_position_slider')=='top')?'checked="checked"':''; ?> ><label for="thumb_top" class="button">top</label>
				<input type="radio" name="themeshock_feat_thumb_position_slider" class="<?php echo $shortname; ?>_feat_thumb_slider" id="thumb_bottom" value="bottom" <?php echo (get_option($shortname.'_feat_thumb_position_slider')=='bottom')?'checked="checked"':''; ?> ><label for="thumb_bottom" class="button">bottom</label>
			</div>
		</div>
		<!--slider style-->
		<div class="slider-area-options slider-area-Featured-Slider <?php foreach ($customEffects as $availableEffect){ echo 'slider-area-'.$availableEffect.' '; } ?>" style="margin-top:4px;">
			<div class="display-table-cell table-cell-first">
				<label for="<?php echo $shortname; ?>_feat_style_slider"><?php echo __('Slider Style:','tstranslate')?></label>
			</div>
			<div class="display-table-cell table-cell-2">
				<select name="themeshock_feat_style_slider" id="<?php echo $shortname; ?>_feat_style_slider">
					<?php $frmcur=(int)str_replace('tg-border-','',get_option('themeshock_feat_style_slider','default')); 
						for($i=0;$i<=40;$i++): 
							$value=($i==0)?'default':$i;
					?>
					<option value="tg-border-<?php echo $value ?>" <?php echo ($i===$frmcur)?'selected="selected"':''; ?>><?php echo $value ?></option>
					<?php 
						endfor;
					?>
				</select>
			</div>
		</div>
		<!--scrreen preview-->
		<div class="slider-area-options slider-area-Featured-Slider <?php foreach ($customEffects as $availableEffect){ echo 'slider-area-'.$availableEffect.' '; } ?>" style="margin-top:4px;">
			<div class="display-table-cell table-cell-first">
				<label for="<?php echo $shortname;?>_gls_box_style">&nbsp;</label>
			</div>
			<div class="display-table-cell table-cell-2">
				<span id="slider_screen_pre" class="slider_screen<?php echo get_option('themeshock_style_slider','5'); ?>">&nbsp;</span>
			</div>
		</div>
		<!--More comments-->
		<div class="slider-area-options slider-area-Featured-Slider" style="margin-top:4px;">
			<!--end slider-theme implement-->
			<small><?php echo __('This slider will take data directly from the posts, please go to each post\'s edit page and check the "Featured slider post" option.','tstranslate')?></small><div class="clearfix"></div>
		</div><!-- end slider-area-featured -->
	
	</div><!-- end slider_type-->
	<br>
	<!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
  
	<div class="uploader" <?php echo  (isset($GLOBALS['error_folder']))?'style="display:none"':''; ?>>
		<span class="uploader-title">Uploader images</span>
		<div id="TS_uploader">
			<noscript>
				<p>Please enable JavaScript to use file uploader.</p>
				<!-- or put a simple form for upload here -->
			</noscript>
		</div>
		<img src="<?php echo get_template_directory_uri();?>/img/frame_gallery/loading.gif" class="loading_sld" />
		<ol id="file_stored">
			<?php 
			$last_item=count($GLOBALS['slider_img_info'])-1;
			if ($GLOBALS['slider_img_info']){
				foreach($GLOBALS['slider_img_info'] as $index => $slider_info){?>
					<li>
						<div class="display-table-cell table-cell-first">
							<span class="number"><?php echo $index+1; ?></span>
								<img class="thumb" src="<?php echo $slider_info['thumbnail']?>" />
						</div>
						<div class="display-table-cell table-cell-2">
							<input type="text" class="link_slider_path" data-id="<?php echo $index; ?>" id="link_<?php echo $index;?>" name="link_<?php echo $index;?>" value="<?php echo $slider_info['link'];?>" title="Please use a valid format e.g. http://wpthemegenerator.com" pattern="(#|^(http|https|ftp|sip)\://([a-zA-Z0-9\.\-]+(\:[a-zA-Z0-9\.&amp;%\$\-]+)*@)*((25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])|localhost|([a-zA-Z0-9\-]+\.)*[a-zA-Z0-9\-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$)" placeholder="http://domain.com"/>
							<div class="slider-images-controls">
								<!--<input type="button"  value="save link" data-id="<?php echo $index; ?>" />-->
								<?php if ($index!==0){ ?>
									<input type="button" value="&#x25B2;" data-value="up" data-id="<?php echo $index; ?>" />
								<?php }?>
								<?php if($last_item!==$index){?>
									<input type="button" data-value="down" value="&#x25BC;" data-id="<?php echo $index; ?>" />
								<?php }?>
								<img class="close" src="<?php echo get_template_directory_uri(); ?>/img/close.png" data-id="<?php echo $index; ?>" />
								<input type="checkbox" class="validator-chkbox" value="true"  data-value="sld_image" <?php echo ($slider_info['active'])?'checked="checked"':'';?> data-id="<?php echo $index; ?>" />
							</div>
						</div>
					</li>
					<?php
				}
			}?>
		</ol>
	</div>
<?php }

/**********************/
/* Setup page layout */
/********************/

function getThemeGenPageLayout(){
	global $themename, $shortname;
	ob_start();?>
	<select name="footer_widget_style" class="widget_style content">
		<option value="boxcss_default">Default Box </option>
		<?php foreach (range(0, 14) as $widget_number){?>
		<option value="<?php echo 'boxcss_'.$widget_number;?>"><?php echo ($widget_number != 0)?'Box Style'.$widget_number:'No Box';?></option>
		<?php } ?>
	</select>
	<?php $widget_style_option=ob_get_clean();
	$name_base='name="footer_widget_style"';
	$select_position=array();
	foreach($GLOBALS['layout_info'][0] as $style_widget_name  => $value ){
		if (is_array($value)){
			$disable=($value["active"]===true)?'style="z-index:2;"':' disabled="disabled" ';
			if($GLOBALS['layout_info']['themeshock_default_widget_boxes'] == true && $disable != ' disabled="disabled" '){
				$default_widgets_boxes = ' disabled="disabled" ';
			}
			$value_assigned=$value["style"];
			$array_search=array($name_base,'value="'.$value_assigned.'"');
			$array_replace=array('name="'.$style_widget_name.'_style"'.$disable.$default_widgets_boxes,'value="'.$value_assigned.'" selected="selected"');
			$select_position[$style_widget_name]=str_replace($array_search,$array_replace,$widget_style_option);
		}
		if ($style_widget_name==='footer_widget_style'){
		  $select_position[$style_widget_name]=str_replace('value="'.$value.'"','value="'.$value.'" selected="selected"',$widget_style_option);
		}
	}
	?>
	<ul class="layout_base_info display-block">
		<li class="lay_disabled"><span></span>Disabled</li>
		<li class="lay_enabled"><span></span>Enabled</li>
		<li class="loading_layout"> <img src="<?php echo get_template_directory_uri();?>/img/frame_gallery/loading.gif" class="loading_layout" /></li>
	</ul>
	<div>
		<div class="display-table-cell table-cell-first">
			<label for="<?php echo $shortname; ?>_layout_type">Select the page you want to setup</label>
		</div>
		<div class="display-table-cell table-cell-2">
			<select id="<?php echo $shortname; ?>_layout_type" >
			  <?php foreach($GLOBALS['pages'] as $index => $page){?>
				<option <?php echo ($index===0)?'selected="selected"':''; ?>   value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
			  <?php }?>
			</select>
		</div>
	</div>
	<script>
		jQuery(function(){ 
			// creamos nuestra regla con expresiones regulares.
			var filterEmail = /([a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})/;
			var filterUrl = /^(sip|ftp[s]|http[s]?:\/\/){0,1}(www\.){0,1}localhost|[a-zA-Z0-9\.\-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2,5}\/[\.]{0,1})/;
			var filterSize = /[0-9]{2}|[0-9]{3}/;
			var filterColor = /(blue|red|orange|aqua|green|white|black|lime|purple|yellow|maroon|fuschia|navy|silver|gray|olive|teal|inherit|Inherit|^(hsl|rgb|#)[a-fA-F0-9\,\(\)%]+)/;
			// utilizamos test para comprobar si el parametro valor cumple la regla
			function validate_field(filter,valor)
			{
				if(filter.test(valor))
					return true;
				else
					return false;
			}
			// verificamos el match en el momento de levantar la tecla
			jQuery(".fontSizeTagHeadings").keyup(function()
			{
				if(jQuery(this).val() == '' || jQuery(this).val() == 'inherit' || jQuery(this).val() == 'Inherit')
				{
					jQuery(this).css("border","1px solid #dddddd");
					//jQuery(this).val('#');
					jQuery(this).removeAttr("maxlength");
					jQuery('#button-primary-btn').val("Save Changes");
				}else if(validate_field(filterSize,jQuery(this).val()) && jQuery(this).val() != 'inherit')
				{
					jQuery(this).attr("maxlength",3);
					jQuery('#button-primary-btn').val("Save Changes");
				}else
				{
					jQuery(this).css("border","1px solid #aa0000 !important");
					jQuery('#button-primary-btn').val('Save Pls Chk Size format :(');
				}
			});
			// verificamos el match en el momento de levantar la tecla
			jQuery("#themeshock_favicon").keyup(function()
			{
				if(jQuery(this).val() == '')
				{
					//jQuery(this).val('#');
					jQuery('#button-primary-btn').val("Save Changes");
					jQuery(this).css("border","1px solid #dddddd");
				}else if(validate_field(filterUrl,jQuery(this).val()))
				{
					jQuery(this).css("border","1px solid #dddddd");
					jQuery('#button-primary-btn').val("Save Changes");
				}else
				{
					jQuery(this).css("border","1px solid #aa0000 !important");
					jQuery('#button-primary-btn').val('Save Pls Chk Url format :(');
				}
			});
			// jQuery(".themeshock-mailer").keyup(function()
			// {
			//     if(jQuery(this).val() == '' || jQuery(this).val() == '#')
			//     {
			//     	jQuery(this).css("border","1px solid #dddddd");
			//         jQuery('#button-primary-btn').val("Save Changes");
			//     }else if(validate_field(filterUrl,jQuery(this).val())){
			//     	jQuery(this).css("border","1px solid #dddddd");
			//     	jQuery('#button-primary-btn').val("Save Changes");
			//     }else
			//     {
			//     	jQuery(this).css("border","1px solid #aa0000 !important");
			//     	//jQuery(".update_text").show().html("Pls chk The correct format: <span style='#2a95c5;'>http://domain.com</span>").css("color","#ea4444");
			//         jQuery('#button-primary-btn').val('Save Pls Chk Url format :(');
			//     }
			// });
			jQuery("#themeshock_contact_mail").keyup(function()
			{
				if(jQuery(this).val() == '')
				{
					//jQuery(this).val('#');
					jQuery(this).css("border","1px solid #dddddd");
					jQuery('#button-primary-btn').val("Save Changes");
				}else if(validate_field(filterEmail,jQuery(this).val()))
				{
					jQuery('#button-primary-btn').val("Save Changes");
					jQuery(this).css("border","1px solid #dddddd");
				}else
				{
					jQuery(this).css("border","1px solid #aa0000 !important");
					jQuery('#button-primary-btn').val('Save Pls Chk Email format :(');
				}
			});
			jQuery('.controls-new-sidebar-show').click(function(e){
				e.preventDefault();
				jQuery(this).hide();
				jQuery('input[name="add_sidebar"], .setup-new-sidebar').show();
			})
		})
	</script>
	<div class="option_content_layout">
		<?php $content_layout = get_option($shortname."_content_layout");?>
		<label for="content_layout_small">Main Content 700px, Sidebar 220px</label>
		<input type="radio" value="content_layout_small" id="content_layout_small" name="themeshock_content_layout" <?php echo($content_layout == 'content_layout_small')?'checked="checked"':'';?> />
		<div class="clear"></div>
		<label for="content_layout_normal">Main Content 620px, Sidebar 300px</label>
		<input type="radio" value="content_layout_normal" id="content_layout_normal" name="themeshock_content_layout" <?php echo($content_layout == 'content_layout_normal')?'checked="checked"':'';?> />
	</div>
	<div class="container-controls-new-sidebar">
		<input type="button" value="New Sidebar" class="controls-new-sidebar controls-new-sidebar-show" />
		<input type="button" value="Add Sidebar" name="add_sidebar" class="controls-new-sidebar"/>
	</div>
	<div class="setup-new-sidebar">
		<div class="inside-row">
			<div class="display-table-cell table-cell-first">
				<label>Side</label>
			</div>
			<div class="display-table-cell table-cell-2">
				<input type="radio" name="sidebar_add" value="Top" checked="checked" />Top
				<input type="radio" name="sidebar_add" value="Bottom" />Bottom
			</div>
		</div>
		<div class="inside-row">
			<div class="display-table-cell table-cell-first">
			<label>Name Sidebar</label>
			</div>
			<div class="display-table-cell table-cell-2">
				<input type="text" value="" name="name_sidebar" />
			</div>
		</div>    
	</div>

	<ul id="lay_gen" class="noslider">
		<li id="slider_page" class="notshow">
			<h4>Slider</h4>
			<div></div>
		</li>
		<?php $positions=$GLOBALS['layout_info'][0];
			foreach ($positions as $position  => $value){
			switch ($position){
				case 'left_1':
				case 'left_2':
				case 'right_1':
				  unset($positions[$position]);
				continue 2;
				case 'right_2':
				  unset($positions[$position]);
				break 2;
			}
			if (is_array($value)){?>
				<li id="<?php echo $position ?>" data-pos="Top" class="<?php echo ($value["active"]===true)?'selected':''; ?>">
					<img class="sd_close" src="<?php echo get_template_directory_uri(); ?>/img/close.png" data-delete="<?php echo $position;  ?>" />
					<?php echo $select_position[$position];?>
					<div></div>
					<h4>sidebar	<?php echo $position;?></h4>
				</li><?php
				} unset($positions[$position]);
			}
			?>
		<li class="nothover">
			<ul class="horinzontal">
				<li id="left_1" class="<?php echo ($GLOBALS['layout_info'][0]['left_1']["active"]===true)?'selected':''; ?>">
					<?php echo $select_position['left_1'];?>
					<div></div>
					<h4>sidebar left 1</h4>
				</li>
				<li id="left_2" class="<?php echo ($GLOBALS['layout_info'][0]['left_2']["active"]===true)?'selected':''; ?>">
					<?php echo $select_position['left_2'];?>
					<div></div>
					<h4>sidebar left 2</h4>
				</li>
				<li class="content"><h4>content area</h4></li>
				<li id="right_1" class="<?php echo ($GLOBALS['layout_info'][0]['right_1']["active"]===true)?'selected':''; ?>">
					<?php echo $select_position['right_1'];?>
					<div></div>
					<h4>sidebar right 1</h4>
				</li>
				<li id="right_2" class="last_hor <?php echo ($GLOBALS['layout_info'][0]['right_2']["active"]===true)?'selected':''; ?>">
				<?php echo $select_position['right_2'];?>
				<div></div>
				<h4>sidebar right 2</h4>
				</li>
			</ul>
		</li>
		<?php 
			foreach ($positions as $position  => $value){ 
				if (is_array($value)){
		?>
			<li id="<?php echo $position ?>" data-pos="Bottom" class="<?php echo ($value["active"]===true)?'selected':''; ?>">
				<img class="sd_close" src="<?php echo get_template_directory_uri(); ?>/img/close.png" data-delete="<?php echo $position;  ?>" />
				<?php echo $select_position[$position];?>
				<div></div>
				<h4>sidebar	<?php echo $position;?></h4>
			</li><?php
		  }
		}?>
	</ul>
	<ul class="slider_opt">
		<li id="slider_title">
			<b>Select where you want top slider to be activated.</b>
		</li>
		<?php
		foreach($GLOBALS['layout_info'][0] as $slider_page_type  => $value ){
			if (is_array($value)){break;}
			if ($slider_page_type==='footer_widget_style'){?>
				<li id="<?php echo $slider_page_type;?>">
					<label for="footer_widget_style_selection"><b>Footer widget box style &nbsp;</b></label>
					<?php echo $select_position['footer_widget_style'];?>
				</li>
				<li id="default_widget_boxes">
					<?php $default_widget_boxes = $GLOBALS['layout_info']['themeshock_default_widget_boxes']?>
					<label for="<?php echo $shortname; ?>_default_widget_boxes" style="width:auto; padding: 0 5px 0 0;">Use widget box designs as in your downloaded theme:</label>
					<input name="themeshock_default_widget_boxes" id="<?php echo $shortname; ?>_default_widget_boxes" class="default_widget_boxes" type="checkbox" <?php echo ($default_widget_boxes == true)?'checked="checked"':''?> value="true"/>
					<span class="question_tooltip">?
						<div class="question_tooltip-description">
							<img src="<?php echo get_template_directory_uri()?>/img/multi_bkg/preview_options_boxescss.jpg"/>
							<p>By checking this option your theme will have the content boxes
						 with the design you selected when download your theme from www.wpthemegenerator.com Otherwise it will take
						 one of the designs from the dropdown menu in the layout creator (una imagen mostrando el dropdown).</p>
						</div>
					</span>
				</li><?php 
			}else{?>
				<li id="<?php echo $slider_page_type; ?>"><label for="opt_<?php echo $slider_page_type; ?>">Activate in <?php echo substr($slider_page_type,strpos($slider_page_type,'_')+1); ?></label>
					<input type="checkbox" id="opt_<?php echo $slider_page_type; ?>" name="<?php echo $slider_page_type; ?>"  value="true" <?php echo ($value===true)?'checked="checked"':''; ?>   />
				</li><?php
			}
		}?>
	</ul>


<?php }

/**********************/
/* Setup getThemeGen */
/********************/

function getThemeGen(){
	global $themename, $shortname;?>
  ...
  <!--<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" class="button-primary"/></div><!-- end area-save -->
<?php }

function themeshock_admin() {
	global $themename, $shortname, $wpdb, $screen_layout_columns;
	
	if ( isset($_POST['save'] )) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( isset($_POST['reset'] )) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
	
	add_meta_box('wptg-font-style', 'Font Style', 'get_wptg_font_style', 'toplevel_page_functions', 'wptg_font_style', 'core');
	add_meta_box('wptg-logo', 'Logo', 'get_wptg_logo', 'toplevel_page_functions', 'wptg_logo', 'core');
	add_meta_box('wptg-header_elements', 'Menu and Search', 'getThemeGenHeaderElements', 'toplevel_page_functions', 'wptg_header_elements', 'core');
	add_meta_box('wptg-shortcodes', 'Custom Post Type Shortcodes', 'getThemeGenShortcodes', 'toplevel_page_functions', 'wptg_shortcodes', 'core');
	add_meta_box('wptg-metatags-favicon', 'Meta Tags and Favicon', 'getThemeGenMetaTagsFavicon', 'toplevel_page_functions', 'wptg_metatags_favicon', 'core');
	add_meta_box('wptg-posts', 'Posts Display Options', 'getThemeGenPosts', 'toplevel_page_functions', 'wptg_posts', 'core');
	add_meta_box('wptg-icon-posts', 'Icon Post', 'getThemeGenIconPost', 'toplevel_page_functions', 'wptg_icon_posts', 'core');
	add_meta_box('wptg-socials-networks', 'Social Networks', 'getThemeGenSocialNetworks', 'toplevel_page_functions', 'wptg_social_networks', 'core');
	add_meta_box('wptg-contact-form', 'Contact Form', 'getThemeGenContactForm', 'toplevel_page_functions', 'wptg_contact_form', 'core');
	add_meta_box('wptg-custom-post-types', 'Options Custom Post Types', 'getThemeGenCustomPostTypes', 'toplevel_page_functions', 'wptg_custom_post_types', 'core');
	add_meta_box('wptg-responsive', 'Responsive', 'getThemeGenResponsive', 'toplevel_page_functions', 'wptg_responsive', 'core');
	add_meta_box('wptg-footer-info', 'Footer Info', 'getThemeGenFooterInfo', 'toplevel_page_functions', 'wptg_footer_info', 'core');
	add_meta_box('wptg-google-analytics', 'Google Analytics', 'getThemeGenGoogleAnalytics', 'toplevel_page_functions', 'wptg_google_analytics', 'core');
	add_meta_box('wptg-shopping-cart', 'Shopping Cart', 'getThemeGenShoppingCart', 'toplevel_page_functions', 'wptg_shopping_cart', 'core');
	add_meta_box('wptg-tool-wptg', 'Personalize Menu', 'getThemeGenToolWptg', 'toplevel_page_functions', 'wptg_tool_wptg', 'core');
	add_meta_box('wptg-testimonial-quotes', 'Testimonial Quotes', 'getThemeGenTestimonialQuotes', 'toplevel_page_functions', 'wptg_testimonial_quotes', 'core');
	add_meta_box('wptg-slider', 'Slider', 'getThemeGenSlider', 'toplevel_page_functions', 'wptg_slider', 'core');
	add_meta_box('wptg-page-layout', 'Layout Creator', 'getThemeGenPageLayout', 'toplevel_page_functions', 'wptg_page_layout', 'core');
?>
<script type="text/javascript">
	jQuery(document).ready( function($) {
		jQuery('.if-js-closed').removeClass('if-js-closed').addClass('closed');
		postboxes.add_postbox_toggles('toplevel_page_functions');
	});
</script>

<?php if (isset($GLOBALS['error_folder'])){?>
	<h2 style="color:#FF0000; font-size:20px;"><?php  echo $GLOBALS['error_folder'];?></h2>
<?php }?>

	<!-- new layout options wpthemegenerator -->
	<div class="wrap" id="wrapper-options-wpthemegenerator">
		<div class="bottom-saver">
			<span id="wptg-bnr">Theme Generator &copy; <?php echo date('Y');?></span>
			<span class="update_text" style="display:none;"> <b><i>Updating...</i></b></span>
			<span class="updated_text" style="display:none;color:#2a95c5;"> <b><i>Saved!</i></b></span>
		</div>
		<form method="post" enctype="multipart/form-data" onsubmit="verify_chk_box();" id="wptg-form">
			<?php
				wp_nonce_field('wrapper-options-wpthemegenerator');
				wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false );
				wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false );
			
				$metaBoxCols1 = array( 'wptg_font_style', 'wptg_social_networks',  'wptg_metatags_favicon','wptg_posts', 'wptg_responsive', 'wptg_icon_posts');
				/* delete_comments mini
				$metaBoxCols2 = array('wptg_logo', 'wptg_shopping_cart', 'wptg_google_analytics', 'wptg_contact_form', 'wptg_shortcodes','wptg_custom_post_types',);
				end delete_comments mini */
				/* delete_lines mini */
				$metaBoxCols2 = array('wptg_logo', 'wptg_shopping_cart', 'wptg_google_analytics', 'wptg_contact_form', 'wptg_shortcodes','wptg_tool_wptg', 'wptg_custom_post_types', );
				/* end delete_lines mini */
				$metaBoxCols3 = array('wptg_slider', 'wptg_testimonial_quotes','wptg_page_layout', 'wptg_footer_info','wptg_header_elements');
			?>
			<div class="icon32" id="icon-wpthemegenerator"></div>
			<h2><?php echo __('Options for','tstranslate')?> <?php echo $themename; ?></h2>
			<div class="wptg-cols wptg-col1">
				<?php foreach($metaBoxCols1 as $wptgMetabox){
					do_meta_boxes('toplevel_page_functions', $wptgMetabox, '');
				}?>
			</div><!-- end wptg-cols -->
			<div class="wptg-cols wptg-col2">
				<?php foreach($metaBoxCols2 as $wptgMetabox){
					do_meta_boxes('toplevel_page_functions', $wptgMetabox, '');
				}?>
			</div><!-- end wptg-cols -->
			<div class="wptg-cols wptg-col3">
				<?php foreach($metaBoxCols3 as $wptgMetabox){
					do_meta_boxes('toplevel_page_functions', $wptgMetabox, '');
				}?>
			</div><!-- end wptg-cols -->
			<div class="area-save-btn"><input name="save" type="submit" value="Save Changes" id="button-primary-btn" class="button-primary"/></div><!-- end area-save -->
			<input type="hidden" name="action" value="save" />
		</form>
	</div><!-- end wrap -->

	<form method="post" enctype="multipart/form-data">
		<p class="submit">
			<input name="reset" type="submit" value="Reset" />
			<input type="hidden" name="action" value="reset" />
		</p>
	</form>
	<div style="font-size:9px; margin-bottom:10px;">
		Icons: <?php $icons = 'http://www.iconshock.com'?>
		<a href="<?php echo $icons;?>">Iconshock</a>
	</div>

<?php
}

add_action('admin_init', 'themeshock_add_init');
add_action('admin_menu', 'themeshock_add_admin');

//Comments
function wts_comment($comment, $args, $depth){
$GLOBALS['comment'] = $comment; ?>
<div class="clear"></div>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div class="separate_comments">
		<div class="commentLeft">	
			<div class="comment-author vcard">
				<?php echo get_avatar($comment,$size='40'); ?>
			</div>
		</div>
		<div class="commentRight">
		<div class="autorAndDate">
			<?php printf('<cite class="fn">%s - </cite>', get_comment_author_link()) ?>
			<a class="commentInfo" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf('%1$s', get_comment_date('F j, Y'),NULL) ?></a>
		</div>
		<div class="commentTexts">
			<?php comment_text() ?>	                
		</div>
		<?php edit_comment_link(__('(Edit)','tstranslate'),'  ','') ?>
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</div>    
	</div>
</div><!-- separate comments-->
<?php
}

/**/
add_action('admin_init', 'add_post_feat');
add_action('save_post', 'update_feat_post');

function add_post_feat(){
	add_meta_box("post_details", __("More post options",'tstranslate'), "post_options", "post", "normal", "low");
}

function post_options(){
	global $post;
	$custom = get_post_custom($post->ID);
	$feat_post = $custom["feat_post"][0];

?>
	<div id="posts-options">
		<label><?php echo __('Featured Post:','tstranslate');?></label>
		<input type="checkbox" name="feat_post" id="feat_post" <?php if($feat_post == 'on'){?> checked="checked" <?php }?> />
	</div>
<?php
}

function update_feat_post(){
	global $post;
	if (isset($_POST["feat_post"])){
		update_post_meta($post->ID, "feat_post", $_POST["feat_post"]);
	}else{
		update_post_meta($post->ID, "feat_post", 'off');
	}
}

/**********************/
/* Remove Title Page */
/********************/

add_action('admin_init', 'remove_title_page');
add_action('save_post', 'update_remove_title_page');

function remove_title_page(){
	add_meta_box("page_details", __("More page options",'tstranslate'), "page_options", "page", "side", "default");
}

function page_options(){
	global $post;
	$custom = get_post_custom($post->ID);
	$remove_title = $custom["remove_title_page"][0];
	$removeBoxContent = $custom["remove_box_content"][0];
	?>
	<div id="posts-options">
	<label><?php echo __('Remove Title:','tstranslate');?></label>
	<input type="checkbox" name="remove_title_page" id="remove_title_page" <?php echo ($remove_title == 'on')?'checked="checked"':''?> />
	<div class="clearfix"></div>
	<label><?php echo __('Remove Box Content:','tstranslate');?></label>
	<input type="checkbox" name="remove_box_content" id="remove_box_content" <?php echo ($removeBoxContent == 'on')?'checked="checked"':''?> />
	</div><?php
}

function update_remove_title_page(){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )return;
	if (isset($_POST["remove_title_page"]) || isset($_POST["remove_box_content"])){
		update_post_meta($post->ID, "remove_title_page", $_POST["remove_title_page"]);
		update_post_meta($post->ID, "remove_box_content", $_POST["remove_box_content"]);
	}else{
		update_post_meta($post->ID, "remove_title_page", 'off');
		update_post_meta($post->ID, "remove_box_content", 'off');
	}
}

function layout_update(){
	foreach ($GLOBALS['pages'] as $page){
		if (!isset($GLOBALS['layout_info'][$page->ID])){
			$GLOBALS['layout_info'][$page->ID]['slider_page']=true;/// asigna slider dependiendo el  id del pageel blog o  home el caso es el 0
			$GLOBALS['layout_info'][$page->ID]['footer_widget_style']=$GLOBALS['style_widgets_default'];//asignar estilos al footer			
			foreach($GLOBALS['sidebar_info'] as $position_widgets => $description ){//asignar estilos y posiciones en el layout
				$GLOBALS['layout_info'][$page->ID][$position_widgets]['active']=($position_widgets==='right_1')?true:false;//define layout habilitado por default en este caso es right_1
				$GLOBALS['layout_info'][$page->ID][$position_widgets]['style']=$GLOBALS['style_widgets_default'];
			}
		}
	}
	update_option('themeshock_layout_options',maybe_serialize($GLOBALS['layout_info']));	
}
layout_update();///actualiza los pages en los layouts automaticamente 

/* Esta funcion es para el volver los widgets liquidos segun cuantos estes activos en un sidebar */
function widget_style($position,$id){// es la funcion que modifica los estilos de los widgets
	global $wp_registered_sidebars;
	$default_boxes_widgets = $GLOBALS['layout_info']['themeshock_default_widget_boxes'];
	if($default_boxes_widgets == true){
		$idw= $idw= $GLOBALS['boxes_css'][0];
	}else{
		if($id != 'boxcss_default'){ //$id = ID style box 
		$idw= $idw=($id===NULL)?'boxcss_0':$id;
		}else{
			(isset($GLOBALS['boxes_css']) && $GLOBALS['boxes_css'][0] != 'boxcss_0')?$idw=$GLOBALS['boxes_css'][0]:$idw=($id===NULL)?'boxcss_0':$id;
		}
	}
	$idw .= ' boxcss';
	//$widget_boxescss = (isset($GLOBALS['boxes_css']) && $GLOBALS['boxes_css'][0] != '0')?$GLOBALS['boxes_css'][0]:'noneee';
	
	////////////////////////////////////////////////////////////////////
	// $GLOBALS['style_widgets_default'] Borarr importante!!!!
	////////////////////////////////////////////////////////////////////	
	
	$the_sidebars = wp_get_sidebars_widgets();
	//echo 'widgets_ss'.$id;
	foreach ($wp_registered_sidebars as $all_sidebars){
		$sidebar_id = $all_sidebars['id'];
		if($all_sidebars['name'] == $position)break;
	}
	$reset_boxes = '';
	($default_boxes_widgets != true && $id != "boxcss_default")?$reset_boxes = 'reset_boxes':'';
	$count_wid = count($the_sidebars[$sidebar_id]);
	($count_wid >= 4)?$count_wid = 4:NULL;
	
	$class_originals=array('<div class="boxes">',
	'container_widgets_pieces',
	'widget_corner widget_top_left',
	'widget_token_left',
	'widget_topbottom widget_top_center',
	'widget_corner widget_top_right',
	'widget_token_right',
	'widget_sides widget_middle_left',
	'widget_center widget_content',
	'widget_sides widget_middle_right',
	'widget_corner widget_bottom_left',
	'widget_topbottom widget_bottom_center',
	'widget_corner widget_bottom_right',
	'widget_token_bottom'
	);
	$new_classes=array('<div class="boxes '.$idw.' width_boxes_'.$count_wid.'">',
	'container_widgets_pieces '.$reset_boxes,
	'widget_corner widget_top_left '.$reset_boxes,
	'widget_token_left '.$reset_boxes,
	'widget_topbottom widget_top_center '.$reset_boxes,
	'widget_corner widget_top_right '.$reset_boxes,
	'widget_token_right '.$reset_boxes,
	'widget_sides widget_middle_left '.$reset_boxes,	
	'widget_center widget_content '.$reset_boxes, 
	'widget_sides widget_middle_right '.$reset_boxes,
	'widget_corner widget_bottom_left '.$reset_boxes,
	'widget_topbottom widget_bottom_center '.$reset_boxes,
	'widget_corner widget_bottom_right '.$reset_boxes, 
	'widget_token_bottom '.$reset_boxes
	);			
	ob_start();
	dynamic_sidebar($position);
	$sidebar_contents = ob_get_clean();
	echo str_replace($class_originals,$new_classes,$sidebar_contents);
}

function update_layout(){
	$layout_pack=array();		
	foreach($GLOBALS['pages'] as $index => $page){//$GLOBALS['pages'] ver en functions/variables_load.php
		if ($page->ID===0){// asignar slider para el single post,search,archive y category
			$layout_pack[$page->ID]['slider_blog']=true;
			$layout_pack[$page->ID]['slider_single']=true;
			$layout_pack[$page->ID]['slider_search']=false;	
			$layout_pack[$page->ID]['slider_archive']=false;
			$layout_pack[$page->ID]['slider_category']=false;
			$layout_pack['themeshock_default_widget_boxes'] = true;
		}
		else{
			$layout_pack[$page->ID]['slider_page']=true;/// asigna slider dependiendo el  id del pageel blog o  home el caso es el 0
		}
		$layout_pack[$page->ID]['footer_widget_style']=$GLOBALS['style_widgets_default'];//asignar estilos al footer
		
		foreach($GLOBALS['sidebar_info'] as $position_widgets=> $description ){//asignar estilos y posiciones en el layout
			$layout_pack[$page->ID][$position_widgets]['active']=($position_widgets==='right_1')?true:false;//define layout habilitado por default en este caso es right_1
			$layout_pack[$page->ID][$position_widgets]['style']=$GLOBALS['style_widgets_default'];
		}
	}
	update_option('themeshock_layout_options',maybe_serialize($layout_pack));//regitrar  layout en los didebar
	return $layout_pack;//carga todas las posiciones de los layouts;		

}
function update_sidebar(){
	$sidebars=array();	
	foreach($GLOBALS['position_lay_widgets'] as $position_widgets ){
		$sidebars[$position_widgets]=$GLOBALS['register_sidebar'];
		$sidebars[$position_widgets]['name']=$position_widgets;			
	}
	update_option('themeshock_sidebar',maybe_serialize($sidebars));//registra un sidebar en las posisciones
	return $sidebars;
}
function update_slider_info(){
	$upload_dir=wp_upload_dir();
	if (isset($upload_dir["error"]) && $upload_dir["error"]!==false ){
		$GLOBALS['error_folder']= 'The option to change logo and slider is disabled, please create the following folder: /wp-content/uploads/ and allow writing by setting its permissions to 0777';
		return false;		
	}
	$directory_slider=$upload_dir['basedir']."/slider/";
	mkdir($directory_slider,0777,true);
	$directory_slider_base=get_template_directory()."/img/slider/{*.jpg,*.png,*.gif,*.bmp}";
	$img_directory_pack=glob($directory_slider_base,GLOB_BRACE);
	$slider_info= array();
		foreach($img_directory_pack as $index => $img_slider_info){
			$get_info_img=getimagesize($img_slider_info);
			$slider_info[$index]['active']=true;
			$slider_info[$index]['link']='#';
			$slider_info[$index]['url']=$upload_dir['baseurl'].'/slider/'.basename($img_slider_info);
			$slider_info[$index]['path']=$upload_dir['basedir'].'/slider/'.basename($img_slider_info);
			//file_put_contents($slider_info[$index]['path'],file_get_contents($img_slider_info));
	  check_filesystem($slider_info[$index]['path'], '',  $img_slider_info, 'active-theme');
			@chmod($slider_info[$index]['path'],0777);
			$slider_info[$index]['thumbnail']=$upload_dir['baseurl'].'/slider/'.basename(image_resize($slider_info[$index]['path'],200,200));
			@chmod($slider_info[$index]['thumbnail'],0777);
		}
	update_option('themeshock_slider_dimensions',maybe_serialize($get_info_img));/// guarda las dimenssiones de  la imagen
	update_option('themeshock_slider_images',maybe_serialize($slider_info));	
	$GLOBALS['slider_img_info']=$slider_info;
	return $slider_info;
}
function update_logo_info(){
	$upload_dir=wp_upload_dir();
	if (isset($upload_dir["error"]) && $upload_dir["error"]!==false ){
		$GLOBALS['error_folder']= 'The option to change logo and slider is disabled, please create the following folder: /wp-content/uploads/ and allow writing by setting its permissions to 0777';
		return false;		
	}	
	$directory_logo=$upload_dir['basedir'].'/logo/';
	$get_img_logo=get_template_directory_uri().'/img/logo/logo.png';
	$get_dimmensions=getimagesize($get_img_logo);
	$logo_info['path']=$upload_dir['basedir'].'/logo/logo.png';
	$logo_info['url']=$upload_dir['baseurl'].'/logo/logo.png';
	$logo_info['size']=$get_dimmensions;
	@mkdir($directory_logo,0777,true);
  check_filesystem($logo_info['path'], '',  $get_img_logo, 'active-theme');
	//file_put_contents($logo_info['path'],file_get_contents($get_img_logo));
	chmod($logo_info['path'],0777); 
	update_option('themeshock_logo',maybe_serialize($logo_info));
	return $logo_info;
}

/*
Esta funcion es exlusiva para el servidor, es para mostrar y ocultar elementos y recibe el parametro del elemento que se
va afectar 
*/ 
function display_elements($element_block){
	if(isset($GLOBALS['display_elements']) && $_SERVER['SERVER_NAME'] == 'www.wpthemegenerator.com'){
		switch($GLOBALS['display_elements'][$element_block]){
			case 'show':
				return 'show_element';
			break;
			case 'hide':
				return 'hide_element';
			break;
		}
	}
}

/* funcion para traer los atributos del logo actual y aplicarlos */
function get_attr_logo(){
	$eff_logo = $style_logo = $img_logo = NULL;
	if($GLOBALS['logo_type'] == 'text'){
		$eff_logo = 'logo_effect_'.strtolower($GLOBALS['logo_text_options']['logo_effect']);
		$style_logo = 'font-size: '.$GLOBALS['logo_text_options']['logo_text_font_size'].'; display:block;';
		if($GLOBALS['logo_text_options']['logo_font_family'] != 'Default'){
			$style_logo .= 'font-family: "'.$GLOBALS['logo_text_options']['logo_font_family'].'", sans-serif;';
		}
	}	

	$style_attr = ($style_logo != "")?"style='".$style_logo."'":"";
	$src_logo = ($GLOBALS['logo_info'])?$GLOBALS['logo_info']['url']:get_template_directory_uri();
	if($GLOBALS['arg_text_logo'] && $GLOBALS['arg_text_logo'][4] == "text"){
		$img_logo = '<img src="'.$src_logo.'" style="display: none;"><span class="logotext" style="font-size: '.$GLOBALS['arg_text_logo'][1].'; display:block; "><i></i><p class="'.$GLOBALS['arg_text_logo'][2].'" style="font-family: '.$GLOBALS['arg_text_logo'][3].'">'.$GLOBALS['arg_text_logo'][0].'</p></span>';
	}else{
		if($GLOBALS['logo_type'] == 'image'){
			$img_logo = '<img src="'.trim($src_logo).'"><span class="logotext"><i></i><p></p></span>';
		}else{
			$img_logo = '<span class="logotext" style="display:block;"><i></i><p>'.$GLOBALS['logo_text_options']['logo_text'].'</p></span>';
		}
	}
 
	return '<a href="'.home_url().'" class="logo '.$eff_logo.'" '.$style_attr.'>'.$img_logo.'</a>';
}

/* funciton para quitar los puntos suspensivos del excerpt */
function trim_excerpt($text) {
 return str_replace(" [...]", '...', $text);
}
add_filter('get_the_excerpt', 'trim_excerpt');

function trim_the_content( $the_contents, $read_more_tag = ' READ MORE...', $perma_link_to = '', $all_words = 45 ) {
	$allowed_tags = array( 'a', 'abbr', 'b', 'blockquote', 'b', 'cite', 'code', 'div', 'em', 'fon', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'hr', 'i', 'label', 'i', 'p', 'pre', 'span', 'strong', 'title', 'ul', 'ol', 'li', 'object', 'embed', 'input' );
	if( $the_contents != '' ) {
		$allowed_tags = '<' . implode( '><', $allowed_tags ) . '>';
		$the_contents = str_replace( ']]>', ']]&gt;', $the_contents );
		$the_contents = strip_tags( $the_contents, $allowed_tags );
		if( $all_words > count( preg_split( '/[\s]+/', strip_tags( $the_contents ), -1 ) ) ) return $the_contents;
		$all_chunks = preg_split( '/([\s]+)/', $the_contents, -1, PREG_SPLIT_DELIM_CAPTURE );
		$the_contents = '';
		$count_words = 0;
		$enclosed_by_tag = false;
		foreach( $all_chunks as $chunk ) {
			if( 0 < preg_match( '/<[^>]*$/s', $chunk ) ) $enclosed_by_tag = true;
			elseif( 0 < preg_match( '/>[^<]*$/s', $chunk ) ) $enclosed_by_tag = false;
			if( !$enclosed_by_tag && '' != trim( $chunk ) && substr( $chunk, -1, 1 ) != '>' ) $count_words ++;
			$the_contents .= $chunk;
			if( $count_words >= $all_words && !$enclosed_by_tag ) break;
		}
		$the_contents = $the_contents . '<a class="more-link" href="' . $perma_link_to . '">' . $read_more_tag . '</a>';
		$the_contents = force_balance_tags( $the_contents );
	}
	return $the_contents;
}
/* funcion para actualizar el estado de los post type 
recibe dos parametros el post name, y el estado nuevo */
function statusCustomPostType($wtsPostName, $wtsStatus){
	global $wpdb, $post;
	
	(isset($_POST['themeshock_enablePostTypeGallery']) || isset($_POST['themeshock_enablePostTypePortfolio']) || isset($_POST['themeshock_enablePostTypeServices']) || isset($_POST['themeshock_enablePostTypeProducts']) ||
	 isset($_POST['themeshock_enablePostTypeTestimonials']))?$redirect_warr = 'true':$redirect_warr = 'false';
	
	if (is_user_logged_in()){
		$wpdb->query("
			UPDATE $wpdb->posts 
			SET post_status = '".$wtsStatus."'
			WHERE post_name = '".$wtsPostName."';"
		);
	
		$menu_current = get_theme_mod('nav_menu_locations');
		if($menu_current['shock_menu'] != 0){
			$term_shock_menu = get_term_by('term_id', $menu_current['shock_menu'], 'nav_menu');
			$idsPostNameWts = $wpdb->get_results("SELECT ID FROM wp_posts w where post_name like '%wts%' and post_status = 'trash'");
			$resultMenuItems = $wpdb->get_results($wpdb->prepare("SElECT post_id, meta_value FROM wp_term_relationships rs, wp_postmeta pm where rs.term_taxonomy_id = %s and rs.object_id = pm.post_id and meta_key = '_menu_item_object_id';", $term_shock_menu->term_taxonomy_id));
			foreach($idsPostNameWts as $idPostName){
				foreach($resultMenuItems as $resultMenuItem){
					if($resultMenuItem->meta_value === $idPostName->ID){
						$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->term_relationships WHERE object_id = %s;", $resultMenuItem->post_id));
						$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->posts WHERE id = %s;", $resultMenuItem->post_id));
						$wpdb->query($wpdb->prepare("DELETE FROM $wpdb->postmeta WHERE post_id = %s;", $resultMenuItem->post_id));
					}
				}
			}
			($redirect_warr === 'true')?header('Location: '.$_SERVER['REQUEST_URI']):'';
		}	
	}
}
/* funcion para habilitar o desabilitar las taxonomias (portfolio, services, products.. etc)en el dashboard */
function activeCustomPostType($CustomPostType, $wtsPostType, $wtsPostName){
	global $wpdb;
	if(get_option('themeshock_enablePostType'.$CustomPostType) === 'true'):
		statusCustomPostType($wtsPostName, 'publish');
		add_action('init', $wtsPostType);
	else:
		statusCustomPostType($wtsPostName, 'trash');
		remove_action('init', $wtsPostType);
	endif;
}

/* funcion que verifica si el dominio es wpthemegenerator */
function is_wpthemegenerator(){
	if($_SERVER['HTTP_HOST'] == 'www.wpthemegenerator.com'){
		return true;
	}else{
		return false;
	}
}

/*
Esta funcion es la forma correcta para el upload de las imagenes del logo y la de los sliders, adicionalemnte 
es la que sube las imagenes por primera vez del logo y el slider.
Los parametos que soportan son 4 (el directorio del archivo, el nombre, los atributos del archivo y uno opcional que es para especificar si se va usar
para crear las imagenes por primera vez o en cada subida de la imagen ya sea logo o slider)
*/
function check_filesystem($directory_file, $file_name, $file_info, $trigger = 'qq-uploader') {
  define('FS_METHOD', 'direct');
  require_once(ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php');
  global $wp_filesystem;
  //check_admin_referer();
  $method = 'direct';
	
  if ( ! $method ) return false;
  if ( ! class_exists("WP_Filesystem_$method") ) {
	$abstraction_file = apply_filters('filesystem_method_file', ABSPATH . 'wp-admin/includes/class-wp-filesystem-' . $method . '.php', $method);
	if ( ! file_exists($abstraction_file) ) return;
	require_once($abstraction_file);
  }
  if ( !defined('FS_CHMOD_DIR') ) define('FS_CHMOD_DIR', 0755 );
  if ( !defined('FS_CHMOD_FILE') ) define('FS_CHMOD_FILE', 0644 );

  $method = "WP_Filesystem_$method";
  $wp_filesystem = new $method($args);
  switch($trigger){
	case 'qq-uploader':
	  $filename = trailingslashit($directory_file).$file_name;
	  $wp_filesystem->put_contents($filename, $file_info, 0777);
	break;
	case 'active-theme':
	  $wp_filesystem->put_contents($directory_file, $wp_filesystem->get_contents($file_info), 0777);
	break;
  }
  return true;
}

/*function for captcha reload*/
function captcha_reload(){
	switch ($_REQUEST['session']) {
		case 'reload':
			get_template_part('captcha/newsession');
		break;
		case 'generate':
			get_template_part('captcha/image_req');
		break;
	}
	exit;
}
if ( ! function_exists('tg_script_contact_execute') ){  
   function tg_script_contact_execute(){
	   ?>
		<script src="<?php echo get_template_directory_uri(); ?>/functions/jquery.h5validate.js"></script>
		<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
		<script>
			/*Use for captcha*/
			jQuery(function(){
				jQuery('.captcha_reload').live('click',function(){
					jQuery('.captcha_reload').css({
						webkitTransform:'rotate(-360deg)',
						webkitTransition:'all 1s ease-in-out'
					});
					jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>','action=tg_captcha&session=reload');//<?php echo get_template_directory_uri(); ?>/captcha/newsession.php
					jQuery("#captchaimage").load('<?php echo admin_url('admin-ajax.php'); ?>?action=tg_captcha&session=generate');//<?php echo get_template_directory_uri(); ?>/captcha/image_req.php
					return false;
				});
				/*contactform validation*/
				jQuery('#contactForm').h5Validate({
					errorClass:'errorFormat'
				});
				/*Use for inputs*/
				var cfw=jQuery('.contact_form').width();
				switch(cfw){
					case 380:
						jQuery('.contact_form .emailInput').css({'width':'47%'});
						jQuery('.contact_form .textInput').css({'width':'98%'});
						jQuery('.contact_form #map_canvas').css({'width':'100%'});
					break;
					case 532:
						jQuery('.contact_form .emailInput').css({'width':'48%'});
						jQuery('.contact_form .textInput').css({'width':'98%'});
						jQuery('.contact_form #map_canvas').css({'width':'100%'});
					break;
				}
				jQuery(window).resize(function(){
					if(jQuery(this).width()<960){
						jQuery('.contact_form .emailInput').css({'width':'98%'});
					}else{
						switch(cfw){
							case 380:
								jQuery('.contact_form .emailInput').css({'width':'47%'});
								jQuery('.contact_form .textInput').css({'width':'98%'});
								jQuery('.contact_form #map_canvas').css({'width':'100%'});
							break;
							case 532:
								jQuery('.contact_form .emailInput').css({'width':'48%'});
								jQuery('.contact_form .textInput').css({'width':'98%'});
								jQuery('.contact_form #map_canvas').css({'width':'100%'});
							break;
							case 836:
								jQuery('.contact_form .emailInput').css({'width':''});
								jQuery('.contact_form .textInput').css({'width':''});
								jQuery('.contact_form #map_canvas').css({'width':''});
							break;
						}
					}
				});
			});
			/*Maps Implementation*/
			function initialize(address) {
			  // I create a new google maps object to handle the request and we pass the address to it
			  var geoCoder = new google.maps.Geocoder(address)
				  // a new object for the request I called "request" , you can put there other parameters to specify a better search (check google api doc for details) ,
				  // on this example im going to add just the address
			  var request = {address:address};
			 
				  // I make the request
			  geoCoder.geocode(request, function(result, status){
						  // as a result i get two parameters , result and status.
						  // results is an  array tha contenis objects with the results founds for the search made it.
						  // to simplify the example i take only the first result "result[0]" but you can use more that one if you want
			 
						  // So , using the first result I need to create a  latlng object to be pass later to the map
						  var latlng = new google.maps.LatLng(result[0].geometry.location.lat(), result[0].geometry.location.lng());  
			 
				  // some initial values to the map
				  var myOptions = {
					zoom: 15,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				  };
			 
					   // the map is created with all the information
						 var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
			 
					   // an extra step is need it to add the mark pointing to the place selected.
					  var marker = new google.maps.Marker({position:latlng,map:map,title:'<?php bloginfo("name"); ?>'});
			 
			  });
			}
			<?php if ( $_SERVER['HTTP_HOST']==='www.wpthemegenerator.com'){
				?>
					initialize('76 Ninth Ave New York, NY 10011 (212) 565-0000');
				<?php
				}else{
				?>
					initialize('<?php echo get_option("themeshock_main_address") ;?>');
				<?php
				}
			?>
		</script>
	   <?php
	   /*end maps*/
   }
}


add_action('wp_ajax_tg_captcha', 'captcha_reload');
add_action('wp_ajax_nopriv_tg_captcha', 'captcha_reload');
/*end captcha reload*/
include 'functions/framework-tool-panel.php';
include 'functions/tgscripts.php';
include 'functions/featured_post.php';
get_template_part('functions/sidebars');
get_template_part('functions/taxonomies');
get_template_part('functions/shortcodes');
get_template_part('functions/widgets');
/* delete_lines mini */
get_template_part('functions/prepare-file-system');
/* end delete_lines mini */

add_image_size( 'featured-large', 900, 474, true ); // Large Featured Image
?>

<?php
function list_files_tool($path,$extension){
	$folders = array();
	if (is_dir($path)){
		$punt = opendir($path);
		while ($folder = readdir($punt)) {
			if ($folder[0] == '.'){ continue; }
			if (is_file($path.$folder) and preg_match('/\.'.$extension.'$/', $folder, $gatto)){
				$folders[] = $folder;
			}
		}
	}
	closedir($punt);
	natsort($folders);
	return $folders;	
}

function file_exists_tool($token_file){
	if (@file_exists($token_file)){
		return 'true';
	}else{
		return 'none'; 
	}
	}
            
function file_exists_tool_size($token_file){
	if (@file_exists($token_file)){
		return getimagesize($token_file);
	}else{
		return NULL; 
	}
}

function wtg_file_get_contents($wptg_file) {
  define('FS_METHOD', 'direct');
  require_once(ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php');
  global $wp_filesystem;
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


  $get_contents = $wp_filesystem->get_contents($wptg_file);

  return $get_contents;
}

/* Esta validacion es para parsear el css y enviar por json a theme_generator.js */
if(isset($_GET["create_sessvar_ini"])){
	//$file = file_get_contents(get_template_directory().'/framework-tool/current_layout/last_change.css', true);
	$file = wtg_file_get_contents(get_template_directory().'/framework-tool/current_layout/last_change.css');
	$file = str_replace('@charset "utf-8";'.PHP_EOL, NULL, $file);
	$val_class = explode("}", $file);
	foreach($val_class as $key){
		$class_css = explode("{", $key);
		$arr[] = trim(str_replace("\n", NULL, $class_css[0]), ' ');
		$arr2[] = str_replace("\r\n", '', $class_css[1]);
		$result = array_combine($arr, $arr2);
	}
	echo json_encode($result);
	exit;
}

/* esta validacion es para hacer las opciones de personalize local */
if($GLOBALS['framework_tool']  === 'true' && is_user_logged_in()){
	function wts_tool_panel($arg_framework_tool) {
		include get_template_directory().'/framework-tool/current_layout/vars_layout.php';
		switch ($arg_framework_tool){
			case 'show-tool-panel':?>
      <div class="alert_select"><div class="controls_alert"><a href="#" class="alert_select_close">Ok</a><div class="append_get_content"></div></div></div>
			<div id="main_settings">
				<h3>Personalize</h3>
        <div class="panel_middle">
          <ul class="items_layout">
            <li><a href="#" rel="option_global" onclick="return open_rel(this,'rel');" id="option_global">Global</a></li>
						<li><a href="#" rel="set_lay_page" onclick="return open_rel(this,'rel');">Layout</a></li>
            <li><a href="#" rel="option_fonts" onclick="return open_rel(this,'rel');">Fonts</a></li>
						<li><a href="#" rel="area_save_local"  onclick="return open_rel(this,'rel');">Save</a></li> 
          </ul>
        </div>
				<div class="panel_footer"></div>
				
				</div><!-- end main_settings-->
        
        <div class="set_panel area_save_local">
        	<span>Save current layout in your site.</span>
          <a id="save_local" class="btn">Save Layout</a>
          <small>Remember to clean cache in order to see your changes.</small>
        </div><!-- set_lay_page-->
        
	      <div class="too_image_preloader"><img src="<?php bloginfo('template_url')?>/framework-tool/img/thumbs_preloader.gif" /></div>
        
                <!-- option_fonts -->
				<div class="sub_panel option_fonts">
					<ul>
            <li><a href="#" rel="set_font_heading" onclick="return open_set(this,'rel');">Font Titles</a></li>
            <li><a href="#" rel="set_font_body" onclick="return open_set(this,'rel');" >Font Body</a></li>
					</ul>
				</div><!-- end option_fonts -->
        
	  
     <div class="set_panel set_gral_patterns">
     	<div class="lay_patterns">
	      <div class="container_fixed">
      	<h2>Patterns</h2>
				<select id="block_area_pattern">
        	<option disabled="disabled" class="disable_option">Choose Area</option>
					<option value="header" class="disable_to_layout_2 disable_to_layout_4 disable_to_layout_5 disable_to_layout_6 disable_to_layout_7">Header</option>
          <option value="slider" class="disable_to_layout_2 disable_to_layout_3 disable_to_layout_4 disable_to_layout_5 disable_to_layout_6 disable_to_layout_7">Slider</option>
					<option value="content" class="disable_to_layout_2 disable_to_layout_4 disable_to_layout_5 disable_to_layout_6 disable_to_layout_7">Content</option>
					<option value="footer" class="disable_to_layout_2 disable_to_layout_4 disable_to_layout_5 disable_to_layout_6 disable_to_layout_7">Footer</option>
          <option value="body" disabled="disabled" class="disable_to_layout_1 disable_to_layout_3">Body</option>
          <option value="wrapper" disabled="disabled" class="disable_to_layout_1 disable_to_layout_3 disable_to_layout_7">Wrapper</option>
				</select>
				<label for="block_area_pattern">Choose Area</label>
				</div>
			</div><!-- end lay_patterns -->
      <ul class="get_thumb_list">
        <li><a href="#" rel="" onclick="return jQuery(this).pattern(this);" class="no_item"><img src="<?php echo get_template_directory_uri();?>/framework-tool/img/thumb_none.png" /></a></li>
        <?php $loading_prevew = get_bloginfo('template_url').'/img/multi_bkg/loading_thumbs.gif';
				$path_preview =  get_template_directory().'/graphic_elements/pattern/';
        $path_preview_url =  get_bloginfo('template_url').'/graphic_elements/pattern/';
        foreach(preg_grep("/thumb/", list_files_tool($path_preview, 'png|jpg')) as $img_files){
          echo "<li><a href=\"#\" rel=\"\" onclick=\"return jQuery(this).pattern(this);\" ><img class=\"lazy\" data-href=\"".$path_preview_url.$img_files."\" src=\"$loading_prevew\"/></a></li>";
        } 
				/* elements for clients */
				if ($GLOBALS['get_user_info']!==false){//users premium and register
					$path_user_base='/user_elements/register/tmp_'.$GLOBALS['get_user_info']['tg_user_id'].'/pattern/';
					$path_usr_preview=$_SERVER['DOCUMENT_ROOT'].$path_user_base;
					if (is_dir($path_usr_preview)){						
						$path_usr_url="http://".$_SERVER['HTTP_HOST'].$path_user_base;
						foreach(preg_grep("/thumb/",list_files_tool($path_usr_preview, 'png|jpg')) as $img_files){
							echo "<li><a href=\"#\" rel=\"\" onclick=\"return jQuery(this).pattern(this);\" ><img class=\"lazy\" data-href=\"".$path_usr_url.$img_files."\" src=\"$loading_prevew\"/></a></li>";
						} 
					}
				}
				if (isset($_COOKIE['path_free_wtg']) && $GLOBALS['get_user_info']===false){//users free
					$path_user_base='/user_elements'.$_COOKIE['path_free_wtg'].'/pattern/';
					$path_usr_preview=$_SERVER['DOCUMENT_ROOT'].$path_user_base;	
					if (is_dir($path_usr_preview)){
						$path_usr_url="http://".$_SERVER['HTTP_HOST'].$path_user_base;
						foreach(preg_grep("/thumb/",list_files_tool($path_usr_preview, 'png|jpg')) as $img_files){
							echo "<li><a href=\"#\" rel=\"\" onclick=\"return jQuery(this).pattern(this);\" ><img class=\"lazy\" data-href=\"".$path_usr_url.$img_files."\" src=\"$loading_prevew\"/></a></li>";
						} 
					}
				}
				?>
      </ul>
      </div>
			<!-- option_header-->
			      
			<!-- option_content-->

			<!-- option_globaln -->
				<div class="sub_panel option_global">
					<ul>
 						<li><a href="#" rel="set_palettes"  onclick="return open_set(this,'rel');">Colors</a></li>
						<li><a href="#" rel="set_shadows"  onclick="return open_set(this,'rel');" >Shadows</a></li>
						<li><a href="#" rel="set_gral_patterns"  onclick="return open_set(this,'rel');" class="get_pattern_body">Patterns</a></li>
					</ul>
				</div>
			<div class="set_panel set_lay_page">
					<div class="lay_page">
					<h2>Layout Pages</h2>
						<ul>
            	<?php
								$layout_number=(int)substr($GLOBALS['layout'],-(strlen($GLOBALS['layout'])-strpos($GLOBALS['layout'],'_'))+1);//get number layout
								foreach (range(1,7) as $num_lay ){
              ?>
							<li>
                <label for="page_layout1">Layout <?php echo $num_lay;?></label>
                <input type="radio" id="page_layout<?php echo $num_lay;?>" class="page_layout" name="page_layout" value="lay_<?php echo $num_lay;?>" <?php echo ($layout_number==$num_lay)?'checked="checked"':'';?>/>
							</li>
              <?php
								}?>
						</ul>
					</div><!-- end lay_menu_bar -->
			</div>
			
			
			<div class="set_panel set_shadows">
				<div class="lay_shadows">
        	<div class="container_fixed">
          <h2>Shadows</h2>
          <select id="page_area">
            <option disabled="disabled" class="disable_option">Choose Area</option>
            <option value="header">Header</option>
            <option value="slider" class="disable_to_layout_2 disable_to_layout_3 disable_to_layout_4 disable_to_layout_5 disable_to_layout_6 disable_to_layout_7">Slider</option>
            <option value="content" class="disable_to_layout_2 disable_to_layout_4 disable_to_layout_5 disable_to_layout_6 disable_to_layout_7">Content</option>
            <option value="footer" class="disable_to_layout_2 disable_to_layout_4 disable_to_layout_5 disable_to_layout_6 disable_to_layout_7">Footer</option>
          </select>
          <label for="page_area">Choose Area</label>
          </div><!-- end container_fixed -->
        </div><!-- end lay_shadows -->
				<ul class="block_shadow get_thumb_list">
	        <li><a href="#" rel="" onclick="return jQuery(this).shadows(this);" class="no_item"><img src="<?php echo get_template_directory_uri();?>/framework-tool/img/thumb_none.png" /></a></li>
					<?php $path_preview =  get_template_directory().'/graphic_elements/shadows/';
          $path_preview_url =  get_bloginfo('template_url').'/graphic_elements/shadows/';
          foreach(preg_grep("/thumb/", list_files_tool($path_preview, 'png|jpg')) as $img_files){
						$repeat_shadow = explode('-', $img_files);
						$repeat_shadow = $repeat_shadow[1]?'repeat-x':'no-repeat';
            $replace_x = array('_thumb', '-repeat');
            $new_x = array('');
            $real_img_menu_bar = str_replace($replace_x, $new_x, $img_files);
            $size = getimagesize($path_preview.$real_img_menu_bar);
            echo "<li><a href=\"#\" rel=\"\" onclick=\"return jQuery(this).shadows(this);\"  data-shadow-block-height=\"$size[1]\" data-menu-bar-width=\"$size[0]\" data-repeat=\"$repeat_shadow\"><img class=\"lazy\" data-href=\"".$path_preview_url.$img_files."\" src=\"$loading_prevew\"/></a></li>";
          }
				/* elements for clients */
					if ($GLOBALS['get_user_info']!==false){//users premium and register
						$path_user_base='/user_elements/register/tmp_'.$GLOBALS['get_user_info']['tg_user_id'].'/shadows/';
						$path_usr_preview=$_SERVER['DOCUMENT_ROOT'].$path_user_base;
						$path_usr_url="http://".$_SERVER['HTTP_HOST'].$path_user_base;
						if (is_dir($path_usr_preview)){
							foreach(preg_grep("/thumb/",list_files_tool($path_usr_preview, 'png|jpg')) as $img_files){
								$repeat_shadow = explode('-', $img_files);
								$repeat_shadow = $repeat_shadow[1]?'repeat-x':'no-repeat';							
								$replace_x = array('_thumb', '-repeat');
								$real_img_menu_bar = str_replace($replace_x, '', $img_files);
								$size = getimagesize($path_usr_preview.$real_img_menu_bar);
								echo "<li><a href=\"#\" rel=\"\" onclick=\"return jQuery(this).shadows(this);\"  data-shadow-block-height=\"$size[1]\" data-menu-bar-width=\"$size[0]\" data-repeat=\"$repeat_shadow\"><img class=\"lazy\" data-href=\"".$path_usr_url.$img_files."\" src=\"$loading_prevew\"/></a></li>";							
							}
						}
					}
					if (isset($_COOKIE['path_free_wtg']) && $GLOBALS['get_user_info']===false){//users free
						$path_user_base='/user_elements'.$_COOKIE['path_free_wtg'].'/shadows/';
						$path_usr_preview=$_SERVER['DOCUMENT_ROOT'].$path_user_base;						
						$path_usr_url="http://".$_SERVER['HTTP_HOST'].$path_user_base;
						if (is_dir($path_usr_preview)){						
							foreach(preg_grep("/thumb/",list_files_tool($path_usr_preview, 'png|jpg')) as $img_files){
								$repeat_shadow = explode('-', $img_files);
								$repeat_shadow = $repeat_shadow[1]?'repeat-x':'no-repeat';							
								$replace_x = array('_thumb', '-repeat');							
								$real_img_menu_bar = str_replace($replace_x, '', $img_files);
								$size = getimagesize($path_usr_preview.$real_img_menu_bar);							
								echo "<li><a href=\"#\" rel=\"\" onclick=\"return jQuery(this).shadows(this);\"  data-shadow-block-height=\"$size[1]\" data-menu-bar-width=\"$size[0]\" data-repeat=\"$repeat_shadow\"><img class=\"lazy\" data-href=\"".$path_usr_url.$img_files."\" src=\"$loading_prevew\"/></a></li>";							
							} 
						}
					}					
					?>
      	</ul>
      </div>
			
  
      </div>
      
			<div class="set_panel set_palettes">
				<span class="title_palette_colors container_hide container_hide_layout_2 container_hide_layout_3 container_hide_layout_4 container_hide_layout_5 container_hide_layout_6 container_hide_layout_7">Color Combination</span>
				<ul class="set_palettes_bichrome get_thumb_list container_hide container_hide_layout_2 container_hide_layout_3 container_hide_layout_4 container_hide_layout_5 container_hide_layout_6 container_hide_layout_7">
					<li><a href="#" style="background: #322e2b;"><b style="background: #202020;"></b></a></li>
					<li><a href="#" style="background: #974949;"><b style="background: #202020;"></b></a></li>
					<li><a href="#" style="background: #7b8d90;"><b style="background: #202020;"></b></a></li>
					<li><a href="#" style="background: #00576a;"><b style="background: #202020;"></b></a></li>
					<li><a href="#" style="background: #b5c37c;"><b style="background: #202020;"></b></a></li>
					<li><a href="#" style="background: #a53b1b;"><b style="background: #222729;"></b></a></li>
					<li><a href="#" style="background: #2d7063;"><b style="background: #222729;"></b></a></li>
					<li><a href="#" style="background: #c0bfaf;"><b style="background: #322e2b;"></b></a></li>
					<li><a href="#" style="background: #2f2e2c;"><b style="background: #901b27;"></b></a></li>
					<li><a href="#" style="background: #33312f;"><b style="background: #ee4236;"></b></a></li>
					<li><a href="#" style="background: #2f7a93;"><b style="background: #404040;"></b></a></li>
          <li><a href="#" style="background: #202020;"><b style="background: #f36f37;"></b></a></li>
          <li><a href="#" style="background: #4a5a5a;"><b style="background: #ffb52e;"></b></a></li>
          <li><a href="#" style="background: #1f1002;"><b style="background: #ffb52e;"></b></a></li>
          <li><a href="#" style="background: #222729;"><b style="background: #ffb52e;"></b></a></li>
          <li><a href="#" style="background: #202020;"><b style="background: #5f5d4a;"></b></a></li>
          <li><a href="#" style="background: #2d7063;"><b style="background: #5f5d4a;"></b></a></li>
          <li><a href="#" style="background: #202020;"><b style="background: #a2b953;"></b></a></li>
          <li><a href="#" style="background: #373024;"><b style="background: #a2b953;"></b></a></li>
          <li><a href="#" style="background: #4a5a5a;"><b style="background: #a2b953;"></b></a></li>
          <li><a href="#" style="background: #322e2b;"><b style="background: #669e77;"></b></a></li>
          <li><a href="#" style="background: #5f5d4a;"><b style="background: #669e77;"></b></a></li>
          <li><a href="#" style="background: #2f2e2c;"><b style="background: #d1dc90;"></b></a></li>
          <li><a href="#" style="background: #00576a;"><b style="background: #d1dc90;"></b></a></li>
          <li><a href="#" style="background: #07789a;"><b style="background: #4a5a5a;"></b></a></li>
          <li><a href="#" style="background: #c0bfaf;"><b style="background: #4a5a5a;"></b></a></li>
          <li><a href="#" style="background: #2f2e2c;"><b style="background: #408c86;"></b></a></li>
          <li><a href="#" style="background: #c0bfaf;"><b style="background: #00576a;"></b></a></li>
          <li><a href="#" style="background: #2f2e2c;"><b style="background: #2f7a93;"></b></a></li>
          <li><a href="#" style="background: #322e2b;"><b style="background: #8dc9bc;"></b></a></li>
          <li><a href="#" style="background: #222729;"><b style="background: #01c2df;"></b></a></li>
          <li><a href="#" style="background: #4a5a5a;"><b style="background: #01c2df;"></b></a></li>
          <li><a href="#" style="background: #4a5a5a;"><b style="background: #7b8d90;"></b></a></li>
          <li><a href="#" style="background: #00576a;"><b style="background: #7b8d90;"></b></a></li>
          <li><a href="#" style="background: #2c2e31;"><b style="background: #3e3d5c;"></b></a></li>
          <li><a href="#" style="background: #303344;"><b style="background: #3e3d5c;"></b></a></li>
          <li><a href="#" style="background: #00576a;"><b style="background: #303344;"></b></a></li>
          <li><a href="#" style="background: #cbcac7;"><b style="background: #c13840;"></b></a></li>
          <li><a href="#" style="background: #4a5a5a;"><b style="background: #c13840;"></b></a></li>
          <li><a href="#" style="background: #4a5a5a;"><b style="background: #c13840;"></b></a></li>
          <li><a href="#" style="background: #33312f;"><b style="background: #c13840;"></b></a></li>
          <li><a href="#" style="background: #2c2e31;"><b style="background: #565656;"></b></a></li>
          <li><a href="#" style="background: #c0bfaf;"><b style="background: #4a5a5a;"></b></a></li>
          <li><a href="#" style="background: #ee4236;"><b style="background: #565656;"></b></a></li>
          <li><a href="#" style="background: #222729;"><b style="background: #565656;"></b></a></li>
          <li><a href="#" style="background: #202020;"><b style="background: #c0bfaf;"></b></a></li>
          <li><a href="#" style="background: #2d7063;"><b style="background: #c0bfaf;"></b></a></li>
          <li><a href="#" style="background: #4a5a5a;"><b style="background: #c0bfaf;"></b></a></li>
          <li><a href="#" style="background: #00576a;"><b style="background: #c0bfaf;"></b></a></li>
					<li><div class="color_picker1"></div><div class="color_picker2"></div></li>
				</ul>
				<div class="lay_palette">
        <div class="container_fixed">
        <span class="title_palette_colors">Invidual Color</span>
          <select id="block_area_palette">
            <option disabled="disabled" class="disable_option">Choose Area</option>
            <option disabled="disabled" value="header" class="disable_to_layout_1 disable_to_layout_3">Body</option>
            <option disabled="disabled" value="header" class="disable_to_layout_1 disable_to_layout_3 disable_to_layout_7">Wrapper</option>
            <option value="content" class="disable_to_layout_2 disable_to_layout_4 disable_to_layout_5 disable_to_layout_6 disable_to_layout_7">Content</option>
            <option value="slider" class="disable_to_layout_2 disable_to_layout_3 disable_to_layout_4 disable_to_layout_5 disable_to_layout_6 disable_to_layout_7">Slider</option>
            <option value="footer" class="disable_to_layout_2 disable_to_layout_4 disable_to_layout_5 disable_to_layout_6 disable_to_layout_7">Header and footer</option>
          </select>
          <label for="block_area_palette">&lsaquo; Choose Area</label>
        </div><!-- end title_palette_colors -->
        </div><!-- end container_fixed -->
				<ul class="set_palettes_single get_thumb_list">
          <li><a href="#" style="background:#202020;"></a></li>
          <li><a href="#" style="background:#111224;"></a></li>
          <li><a href="#" style="background:#222729;"></a></li>
          <li><a href="#" style="background:#322e2b;"></a></li>
          <li><a href="#" style="background:#1f1002;"></a></li>
          <li><a href="#" style="background:#2f2e2c;"></a></li>
          <li><a href="#" style="background:#373024;"></a></li>
          <li><a href="#" style="background:#2c2e31;"></a></li>
          <li><a href="#" style="background:#974949;"></a></li>
          <li><a href="#" style="background:#901b27;"></a></li>
          <li><a href="#" style="background:#7e4141;"></a></li>
          <li><a href="#" style="background:#a32b4c;"></a></li>
          <li><a href="#" style="background:#ed1b24;"></a></li>
          <li><a href="#" style="background:#ee4236;"></a></li>
          <li><a href="#" style="background:#c71d22;"></a></li>
          <li><a href="#" style="background:#c5624e;"></a></li>
          <li><a href="#" style="background:#e56340;"></a></li>
          <li><a href="#" style="background:#f36f37;"></a></li>
          <li><a href="#" style="background:#591f11;"></a></li>
          <li><a href="#" style="background:#432f18;"></a></li>
          <li><a href="#" style="background:#a53b1b;"></a></li>
          <li><a href="#" style="background:#86380e;"></a></li>
          <li><a href="#" style="background:#b65a2b;"></a></li>
          <li><a href="#" style="background:#ffb52e;"></a></li>
          <li><a href="#" style="background:#e49500;"></a></li>
          <li><a href="#" style="background:#e59940;"></a></li>
          <li><a href="#" style="background:#f7ca6f;"></a></li>
          <li><a href="#" style="background:#fffac8;"></a></li>
          <li><a href="#" style="background:#5f5d4a;"></a></li>
          <li><a href="#" style="background:#e2cfa0;"></a></li>
          <li><a href="#" style="background:#a2b953;"></a></li>
          <li><a href="#" style="background:#b5c37c;"></a></li>
          <li><a href="#" style="background:#669e77;"></a></li>
          <li><a href="#" style="background:#2d7063;"></a></li>
          <li><a href="#" style="background:#d1dc90;"></a></li>
          <li><a href="#" style="background:#4a5a5a;"></a></li>
          <li><a href="#" style="background:#28483d;"></a></li>
          <li><a href="#" style="background:#408c86;"></a></li>
          <li><a href="#" style="background:#00576a;"></a></li>
          <li><a href="#" style="background:#25617b;"></a></li>
          <li><a href="#" style="background:#2f7a93;"></a></li>
          <li><a href="#" style="background:#07789a;"></a></li>
          <li><a href="#" style="background:#8dc9bc;"></a></li>
          <li><a href="#" style="background:#74bfa8;"></a></li>
          <li><a href="#" style="background:#01c2df;"></a></li>
          <li><a href="#" style="background:#7b8d90;"></a></li>
          <li><a href="#" style="background:#3e3d5c;"></a></li>
          <li><a href="#" style="background:#303344;"></a></li>
          <li><a href="#" style="background:#c13840;"></a></li>
          <li><a href="#" style="background:#a83657;"></a></li>
          <li><a href="#" style="background:#c25768;"></a></li>
          <li><a href="#" style="background:#565656;"></a></li>
          <li><a href="#" style="background:#cbcac7;"></a></li>
          <li><a href="#" style="background:#fff;"></a></li>
          <li><a href="#" style="background:#c0bfaf;"></a></li>
					<li><div class="color_picker_single"><img src="<?php bloginfo('template_url')?>/framework-tool/img/colorpicker/select_single.png"/></div></li>
				</ul>
			</div>
			
			<div class="set_panel set_font_heading">
				<div class="set_font_heading_content">
					<h2>Heading</h2>
						<ul class="set_font_firts_child choose_font_family">
							<span class="title_font_heading">Font Family</span>
              <li>              
                <select>
                  <option value="'Yanone Kaffeesatz', sans-serif">Yanone Kaffeesatz</option>
                  <option value="'Wire One', sans-serif">Wire One</option>
                  <option value="'Ubuntu', sans-serif">Ubuntu</option>
                  <option value="'Rokkitt', serif">Rokkitt</option>
                  <option value="'Righteous', cursive">Righteous</option>
                  <option value="'Raleway', cursive">Raleway</option>
                  <option value="'Quattrocento Sans', sans-serif">Quattrocento Sans</option>
                  <option value="'PT Sans', sans-serif">PT Sans</option>
                  <option value="'Open Sans', sans-serif">Open Sans</option>
                  <option value="'Nixie One', cursive">Nixie One</option>
                  <option value="'News Cycle', sans-serif" selected="selected">News Cycle</option>
                  <option value="'Acme', sans-serif">Acme</option>
                  <option value="'Coustard', serif">Coustard</option>
                  <option value="'Alfa Slab One', cursive">Alfa Slab One</option>
                  <option value="'Abel', sans-serif">Abel</option>
                  <option value="'Brawler', serif">Brawler</option>
                  <option value="'Droid Sans', sans-serif">Droid Sans</option>
                  <option value="'Crushed', cursive">Crushed</option>
                  <option value="'Cabin Condensed', sans-serif">Cabin Condensed</option>
                  <option value="'Federo', sans-serif">Federo</option>
                  <option value="'Arimo', sans-serif">Arimo</option>
                  <option value="'Contrail One', cursive">Contrail One</option>
                  <option value="'Anton', sans-serif">Anton</option>
                  <option value="'Days One', sans-serif">Days One</option>
                  <option value="'Droid Serif', serif">Droid Serif</option>
                  <option value="'Abril Fatface', cursive">Abril Fatface</option>
                  <option value="'Allan', cursive">Allan</option>
                  <option value="'Amatic SC', cursive">Amatic SC</option>
                  <option value="'Anonymous Pro', sans-serif">Anonymous Pro</option>
                  <option value="'Bangers', cursive">Bangers</option>
                  <option value="'Baumans', cursive">Baumans</option>
                  <option value="'Boogaloo', cursive">Boogaloo</option>
                  <option value="'Bree Serif', serif">Bree Serif</option>
                  <option value="'Buda', cursive">Buda</option>
                  <option value="'Cuprum', sans-serif">Cuprum</option>
                  <option value="'Damion', cursive">Damion</option>
                  <option value="'Dorsa', sans-serif">Dorsa</option>
                  <option value="'Francois One', sans-serif">Francois One</option>
                  <option value="'Gruppo', cursive">Gruppo</option>
                  <option value="'Just Another Hand', cursive">Just Another Hand</option>
                  <option value="'Jockey One', sans-serif">Jockey One</option>
                  <option value="'Maiden Orange', cursive">Maiden Orange</option>
                  <option value="'Lobster', cursive">Lobster</option>
                  <option value="'Josefin Slab', serif">Josefin Slab</option>
                  <option value="'Lobster Two', cursive">Lobster Two</option>
                  <option value="'Marvel', sans-serif">Marvel</option>
                  <option value="'Andika', sans-serif">Andika</option>
                  <option value="Arial, Helvetica, sans-serif">Arial</option>
                  <option value="Verdana, Geneva, sans-serif">Verdana</option>
                  <option value="Tahoma, Geneva, sans-serif">Tahoma</option>
                  <option value="'Trebuchet MS', Arial, Helvetica, sans-serif">Trebuchet MS</option>
                </select>
              </li>
						</ul>
						<ul class="set_font_firts_child choose_font_size">
							<span class="title_font_heading">font Size</span>
							<li>
								<label for="font_zize_small">Small</label>
								<input type="radio" id="font_zize_small" class="font_zize" name="font_zize_heading" value="small" checked="checked"/>
							</li>
							<li>
								<label for="font_zize_medium">Medium</label>
								<input type="radio" id="font_zize_medium" class="font_zize" name="font_zize_heading" value="medium" />
							</li>
								<li>
									<label for="font_zize_big">Big</label>
									<input type="radio" id="font_zize_big" class="font_zize" name="font_zize_heading" value="big" />
								</li>
							</ul>
							<ul class="set_font_firts_child choose_font_color">
								<span class="title_font_heading">font color</span>
                <li><a href="#" style="background-color:#f4f4f4"></a></li>
                <li><a href="#" style="background-color:#e0e0e0"></a></li>
                <li><a href="#" style="background-color:#aaa"></a></li>
                <li><a href="#" style="background-color:#ccc"></a></li>
								<li><a href="#" style="background-color:#999"></a></li>
                <li><a href="#" style="background-color:#888"></a></li>
                <li><a href="#" style="background-color:#777"></a></li>
                <li><a href="#" style="background-color:#666"></a></li>
                <li><a href="#" style="background-color:#555"></a></li>
                <li><a href="#" style="background-color:#444"></a></li>
                <li><a href="#" style="background-color:#333"></a></li>
                <li><a href="#" style="background-color:#222"></a></li>
                <li><a href="#" style="background-color:#111"></a></li>
							</ul>
					</div><!-- end lay_menu_bar -->
			</div>
			
			<div class="set_panel set_font_body">
					<div class="set_font_body_content">
					<h2>Font Body</h2>
						<ul>
							<ul class="set_font_firts_child choose_font_family">
								<span>Font Family</span>
								<li class="preview_font_body">
									<select>
                  <option value="'Yanone Kaffeesatz', sans-serif">Yanone Kaffeesatz</option>
                  <option value="'Wire One', sans-serif">Wire One</option>
                  <option value="'Ubuntu', sans-serif">Ubuntu</option>
                  <option value="'Rokkitt', serif">Rokkitt</option>
                  <option value="'Righteous', cursive">Righteous</option>
                  <option value="'Raleway', cursive">Raleway</option>
                  <option value="'Quattrocento Sans', sans-serif">Quattrocento Sans</option>
                  <option value="'PT Sans', sans-serif">PT Sans</option>
                  <option value="'Open Sans', sans-serif">Open Sans</option>
                  <option value="'Nixie One', cursive">Nixie One</option>
                  <option value="'News Cycle', sans-serif">News Cycle</option>
                  <option value="'Acme', sans-serif">Acme</option>
                  <option value="'Coustard', serif">Coustard</option>
                  <option value="'Alfa Slab One', cursive">Alfa Slab One</option>
                  <option value="'Abel', sans-serif">Abel</option>
                  <option value="'Brawler', serif">Brawler</option>
                  <option value="'Droid Sans', sans-serif">Droid Sans</option>
                  <option value="'Crushed', cursive">Crushed</option>
                  <option value="'Cabin Condensed', sans-serif">Cabin Condensed</option>
                  <option value="'Federo', sans-serif">Federo</option>
                  <option value="'Arimo', sans-serif">Arimo</option>
                  <option value="'Contrail One', cursive">Contrail One</option>
                  <option value="'Anton', sans-serif">Anton</option>
                  <option value="'Days One', sans-serif">Days One</option>
                  <option value="'Droid Serif', serif">Droid Serif</option>
                  <option value="'Abril Fatface', cursive">Abril Fatface</option>
                  <option value="'Allan', cursive">Allan</option>
                  <option value="'Amatic SC', cursive">Amatic SC</option>
                  <option value="'Anonymous Pro', sans-serif">Anonymous Pro</option>
                  <option value="'Bangers', cursive">Bangers</option>
                  <option value="'Baumans', cursive">Baumans</option>
                  <option value="'Boogaloo', cursive">Boogaloo</option>
                  <option value="'Bree Serif', serif">Bree Serif</option>
                  <option value="'Buda', cursive">Buda</option>
                  <option value="'Cuprum', sans-serif">Cuprum</option>
                  <option value="'Damion', cursive">Damion</option>
                  <option value="'Dorsa', sans-serif">Dorsa</option>
                  <option value="'Francois One', sans-serif">Francois One</option>
                  <option value="'Gruppo', cursive">Gruppo</option>
                  <option value="'Just Another Hand', cursive">Just Another Hand</option>
                  <option value="'Jockey One', sans-serif">Jockey One</option>
                  <option value="'Maiden Orange', cursive">Maiden Orange</option>
                  <option value="'Lobster', cursive">Lobster</option>
                  <option value="'Josefin Slab', serif">Josefin Slab</option>
                  <option value="'Lobster Two', cursive">Lobster Two</option>
                  <option value="'Marvel', sans-serif">Marvel</option>
                  <option value="'Andika', sans-serif">Andika</option>
                  <option value="Arial, Helvetica, sans-serif">Arial</option>
                  <option value="Verdana, Geneva, sans-serif">Verdana</option>
                  <option value="Tahoma, Geneva, sans-serif">Tahoma</option>
                  <option value="'Trebuchet MS', Arial, Helvetica, sans-serif">Trebuchet MS</option>
									</select>
								</li>
							</ul>
							<ul class="set_font_firts_child choose_font_size">
								<span>font Size</span>
								<li>
									<label for="page_layout1">11px</label>
									<input type="radio" id="font_zize_11" class="font_zize" name="font_zize" value="11px" />
								</li>
								<li>
									<label for="page_layout1">12px</label>
									<input type="radio" id="font_zize_12" class="font_zize" name="font_zize" value="12px" checked="checked"/>
								</li>
								<li>
									<label for="page_layout1">13px</label>
									<input type="radio" id="font_zize_13" class="font_zize" name="font_zize" value="13px" />
								</li>
								<li>
									<label for="page_layout1">14px</label>
									<input type="radio" id="font_zize_14" class="font_zize" name="font_zize" value="14px" />
								</li>
                								<li>
									<label for="page_layout1">15px</label>
									<input type="radio" id="font_zize_15" class="font_zize" name="font_zize" value="15px" />
								</li>
							</ul>
							<ul class="set_font_firts_child choose_font_color">
								<span>font color</span>
                <li><a href="#" style="background-color:#fff"></a></li>
                <li><a href="#" style="background-color:#fafafa"></a></li>
                <li><a href="#" style="background-color:#ccc"></a></li>
								<li><a href="#" style="background-color:#999"></a></li>
                <li><a href="#" style="background-color:#888"></a></li>
                <li><a href="#" style="background-color:#777"></a></li>
                <li><a href="#" style="background-color:#666"></a></li>
                <li><a href="#" style="background-color:#555"></a></li>
                <li><a href="#" style="background-color:#444"></a></li>
                <li><a href="#" style="background-color:#333"></a></li>
                <li><a href="#" style="background-color:#222"></a></li>
                <li><a href="#" style="background-color:#111"></a></li>
							</ul>
						</ul>
					</div><!-- end lay_menu_bar -->
			</div>

			<div class="alert_save_local">
				<a href="#" class="close">x</a>
				<a href="<?php echo home_url()?>/wp-admin/admin.php?page=filesystem_wptg" target="_blank">
					<img src="<?php echo get_template_directory_uri()?>/framework-tool/img/set_local_saving.jpg" width="187" height="101">
				</a>
				<p>Changes can´t be saved, To save locally you have to prepare the permissions first, please change it <a href="<?php echo home_url()?>/wp-admin/admin.php?page=filesystem_wptg" target="_blank">here</a> (you need to know your ftp credentials).</p>
			</div>

             <!-- upload section no funcionara la session bars si quita este codigo	 <div class="sub_panel upload">
        <form  method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >
             <p id="f1_upload_process">Loading...<br/><img src="<?php //echo get_template_directory_uri();?>/img/loader.gif" /><br/></p>
             <p id="f1_upload_form" align="center"><br/>
                 <label>File:  
                      <input name="upload_element" type="file" size="10" />
                 </label>
                 <label>
					<br />
                     <input type="submit" name="submitBtn" class="sbtn" value="Upload" />
                 </label>
             </p><br />
             <p id="result_img"></p>
             <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
         </form>     
     </div>     -->
  		 <script>var current_layout_ini = "<?php echo $current_layout;?>";</script>
      <?php 
				break;
				case 'mainmenu-header':
				if(get_option('themeshock_activate_framework_tool') === 'true'){
					if($GLOBALS['main_menu'] == 'true'){?>
					<div class="container_menu"><?php if( empty($get_menu)){
                                               wp_nav_menu(array('theme_location' => 'shock_menu','menu_class' => 'sf-fifty'));                                                
                                       }else{
                                               wp_nav_menu(array('theme_location' => 'shock_menu','container_class' => '','container_id' => 'wp_main_nav_bar','menu_class' => 'sf-menu', 'menu_id' => ''));                                        
                                       } ?><!-- end container menu--></div>
          
					<div class="navbar">
            <div class="navbar-inner">
              <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">Main Menu</a>
                <div class="nav-collapse">
                 <?php wp_nav_menu(array("theme_location" => "shock_menu", "menu_class" => "nav")); ?>
                </div><!-- /.nav-collapse -->
              </div>
            </div><!-- /navbar-inner -->
          </div>
          
			<?php } }
				break;
				case 'clipart-header':
				if(get_option('themeshock_activate_framework_tool') === 'true' && $current_layout === 'layout_1'){
					print '<div class="clipart"><div class="lay_base header_shine"></div></div><!-- clipart-->';
				}
				break;
				case 'clipart-top':
				if($current_layout === 'layout_2' || $current_layout === 'layout_4' || $current_layout === 'layout_5' || $current_layout === 'layout_6' || $current_layout === 'layout_7'){
					print '<div class="clipart"><div class="lay_base header_shine"></div></div><!-- clipart-->';
				}
				break;
				case 'layout-2':
				if($current_layout === 'layout_2'){
					print '<div class="wrap_lay2">';
				}
				break;
				case 'end-layout-2':
				if($current_layout === 'layout_2'){
					print '</div><!-- end wrap_lay2 -->';
				}
				break;
				/*case 'mainmenu-lay2':
				if($current_layout === 'layout_2'){?>
				<div class="container_menu"><?php wp_nav_menu(array("theme_location" => "shock_menu")); ?><!-- end container menu--></div>
        <?php }
				break;*/
				case 'mainmenu-header':
				if($current_layout != 'layout_2'){ 
				if($GLOBALS['main_menu'] == 'true'){?>
					<div class="container_menu"><?php if( empty($get_menu)){
                                               wp_nav_menu(array('theme_location' => 'shock_menu','menu_class' => 'sf-fifty'));                                                
                                       }else{
                                               wp_nav_menu(array('theme_location' => 'shock_menu','container_class' => '','container_id' => 'wp_main_nav_bar','menu_class' => 'sf-menu', 'menu_id' => ''));                                        
                                       } ?><!-- end container menu--></div>
          
					<div class="navbar">
            <div class="navbar-inner">
              <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">Main Menu</a>
                <div class="nav-collapse">
                 <?php wp_nav_menu(array("theme_location" => "shock_menu", "menu_class" => "nav")); ?>
                </div><!-- /.nav-collapse -->
              </div>
            </div><!-- /navbar-inner -->
          </div>
          
				<?php } }
				break;
				case 'layout-3':
				if($current_layout === 'layout_3'){
					print '<div class="wrap_lay3"><div class="clipart"><div class="lay_base header_shine"></div></div><!-- clipart-->';
				}
				break;
				case 'end-layout-3':
				if($current_layout === 'layout_3'){
					print '</div><!-- end wrap_lay3 -->';
				}
				break;
				case 'layout-4':
				if($current_layout === 'layout_4'){
					print '<div class="wrap_lay4">';
				}
				break;
				case 'end-layout-4':
				if($current_layout === 'layout_4'){
					print '</div><!-- end wrap_lay4 -->';
				}
				break;
				case 'layout-5':
				if($current_layout === 'layout_5'){
					print '<div class="wrap_lay5">';
				}
				break;
				case 'end-layout-5':
				if($current_layout === 'layout_5'){
					print '</div><!-- end wrap_lay5 -->';
				}
				break;
				case 'layout-6':
				if($current_layout === 'layout_6'){
					print '<div class="wrap_lay6">';
				}
				break;
				case 'end-layout-6':
				if($current_layout === 'layout_6'){
					print '</div><!-- end wrap_lay6 -->';
				}
				break;
				case 'layout-7':
				if($current_layout === 'layout_7'){
					print '<div class="wrap_lay7">';
				}
				break;
				case 'end-layout-7':
				if($current_layout === 'layout_7'){
					print '</div><!-- end wrap_lay7 -->';
				}
				break;
			}
		}
	}else{
		function wts_tool_panel($arg_framework_tool) {
			include get_template_directory().'/framework-tool/current_layout/vars_layout.php';
			/*?><script>var current_layout_ini = "<?php echo $current_layout;?>";</script><?php*/
			//$current_layout = get_option('themeshock_current_layout');
			switch($arg_framework_tool){
				case 'clipart-top':
				if($current_layout === 'layout_2' || $current_layout === 'layout_4' || $current_layout === 'layout_5' || $current_layout === 'layout_6' || $current_layout === 'layout_7'){
					print '<div class="clipart"><div class="lay_base header_shine"></div></div><!-- clipart-->';
				}
				break;
				case 'clipart-header':
				if($current_layout === 'layout_1'){
					print '<div class="clipart"><div class="lay_base header_shine"></div></div><!-- clipart-->';
				}
				break;
				case 'layout-2':
				if($current_layout === 'layout_2'){
					print '<div class="wrap_lay2">';
				}
				break;
				case 'end-layout-2':
				if($current_layout === 'layout_2'){
					print '</div><!-- end wrap_lay2 -->';
				}
				break;
				case 'mainmenu-lay2':
				if($current_layout === 'layout_2'){
					if($GLOBALS['main_menu'] == 'true'){?>
				<div class="container_menu"><?php if( empty($get_menu)){
                                               wp_nav_menu(array('theme_location' => 'shock_menu','menu_class' => 'sf-fifty'));                                                
                                       }else{
                                               wp_nav_menu(array('theme_location' => 'shock_menu','container_class' => '','container_id' => 'wp_main_nav_bar','menu_class' => 'sf-menu', 'menu_id' => ''));                                        
                                       } ?><!-- end container menu--></div>
        
					<div class="navbar">
            <div class="navbar-inner">
              <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">Main Menu</a>
                <div class="nav-collapse">
                 <?php wp_nav_menu(array("theme_location" => "shock_menu", "menu_class" => "nav")); ?>
                </div><!-- /.nav-collapse -->
              </div>
            </div><!-- /navbar-inner -->
          </div>
        
        <?php } }
				break;
				case 'mainmenu-header':
				if($current_layout != 'layout_2'){
					if($GLOBALS['main_menu'] == 'true'){?>
					<div class="container_menu"><?php if( empty($get_menu)){
                                               wp_nav_menu(array('theme_location' => 'shock_menu','menu_class' => 'sf-fifty'));                                                
                                       }else{
                                               wp_nav_menu(array('theme_location' => 'shock_menu','container_class' => '','container_id' => 'wp_main_nav_bar','menu_class' => 'sf-menu', 'menu_id' => ''));                                        
                                       } ?><!-- end container menu--></div>
          
					<div class="navbar">
            <div class="navbar-inner">
              <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">Main Menu</a>
                <div class="nav-collapse">
                 <?php wp_nav_menu(array("theme_location" => "shock_menu", "menu_class" => "nav")); ?>
                </div><!-- /.nav-collapse -->
              </div>
            </div><!-- /navbar-inner -->
          </div>
          
				<?php } }
				break;
				case 'layout-3':
				if($current_layout === 'layout_3'){
					print '<div class="wrap_lay3"><div class="clipart"><div class="lay_base header_shine"></div></div><!-- clipart-->';
				}
				break;
				case 'end-layout-3':
				if($current_layout === 'layout_3'){
					print '</div><!-- end wrap_lay3 -->';
				}
				break;
				case 'layout-4':
				if($current_layout === 'layout_4'){
					print '<div class="wrap_lay4">';
				}
				break;
				case 'end-layout-4':
				if($current_layout === 'layout_4'){
					print '</div><!-- end wrap_lay4 -->';
				}
				break;
				case 'layout-5':
				if($current_layout === 'layout_5'){
					print '<div class="wrap_lay5">';
				}
				break;
				case 'end-layout-5':
				if($current_layout === 'layout_5'){
					print '</div><!-- end wrap_lay5 -->';
				}
				break;
				case 'layout-6':
				if($current_layout === 'layout_6'){
					print '<div class="wrap_lay6">';
				}
				break;
				case 'end-layout-6':
				if($current_layout === 'layout_6'){
					print '</div><!-- end wrap_lay6 -->';
				}
				break;
				case 'layout-7':
				if($current_layout === 'layout_7'){
					print '<div class="wrap_lay7">';
				}
				break;
				case 'end-layout-7':
				if($current_layout === 'layout_7'){
					print '</div><!-- end wrap_lay7 -->';
				}
				break;
			}
		}
	}
?>

<?php
	if ((isset($_POST['action'])&&$_POST['action']==='reset')){
		delete_option('themeshock_layout_options');
	}
	/*background fixed*/
	$GLOBALS['cli_bk'] = get_option('themeshock_clipart_bk', false);
	/*shopping cart*/
	$GLOBALS['tg_shp_cart']=get_option('ts_shopping_cart');//habilita shopping cart
	$GLOBALS['tg_shp_currency']=get_option('themeshock_shopping_cart_currency');//		
	$GLOBALS['tg_shp_url']=get_option('themeshock_shopping_cart_url');//url shoping cart
	$GLOBALS['tg_shp_show']=get_option('themeshock_shp_cart_show');	//habilita shopping cart en paginas especificas
	
	$GLOBALS['style_widgets_default'] = 'boxcss_default';//* estilos de widgets por default*/
	$GLOBALS['position_lay_widgets'] = array('top_1','top_2','left_1','left_2','right_1','right_2','bottom_1','bottom_2');/// position de los layouts en el indice y la descripticion en el valor
	$GLOBALS['register_sidebar']= array(
		'name' => '',
	  	'description' => 'Widgets in this area will be shown Pages Selected',
		'before_widget' => '<div class="boxes">
		<div class="container_widgets_pieces">
	  	<div class="widget_corner widget_top_left"><div class="widget_token_left"></div></div>
	  	<div class="widget_topbottom widget_top_center"></div>
	  	<div class="widget_corner widget_top_right"><div class="widget_token_right"></div></div>
	  	<div class="widget_sides widget_middle_left"></div>
	  	<div class="widget_center widget_content">',
		'after_widget' => '</div>
 		<div class="widget_sides widget_middle_right"></div>
	  	<div class="widget_corner widget_bottom_left"></div>
	  	<div class="widget_topbottom widget_bottom_center"></div>
	  	<div class="widget_corner widget_bottom_right"></div>
		</div><!-- end container_widgets_pieces -->
		<div class="widget_token_bottom"></div>
  		</div><!-- end boxes -->',
	  	'before_title' => '<h3>',
	  	'after_title' => '</h3>'
	);
	$wts_find = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_name LIKE '%-wts'", 0);
	$wts_page = implode(',',$wts_find);
	$blog_layout[] = (object) array('ID' => 0, 'post_title' => 'blog and single');
	$wtsp = array('exclude' => $wts_page);
	$pages = get_pages();
	function get_ID_by_page_name($page_name) {
	   global $wpdb;
	   $page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."' AND post_type = 'page'");
	   return $page_name_id;
	}
	function get_ID_by_post_title($post_title) {
	   global $wpdb;
	   $post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '".$post_title."' AND post_type = 'post'");
	   return $post_id;
	}
	$GLOBALS['pages'] = array_merge($blog_layout,$pages);//variable para carga los post de tipo pages applicable para layout		
	$GLOBALS['layout_p']=array('active'=>false,"style"=>$GLOBALS['style_widgets_default']);//insersion de array por default
	$layout_info=get_option('themeshock_layout_options');
	$slider_img_info=get_option('themeshock_slider_images');
	$get_logo_info=get_option('themeshock_logo');
	$sidebar_info=get_option('themeshock_sidebar');
	$GLOBALS['responsive_mode'] = (isset($_GET['responsive']) || get_option('themeshock_enableResponsive') == 'true')?'true':'false';
	$GLOBALS['logo_type']= get_option('themeshock_logo_type');
	$GLOBALS['logo_text_options']= array(
		'logo_text'=>stripslashes(get_option('themeshock_text_logo')),
		'logo_text_font_size'=>get_option('themeshock_font_size_logo'),
		'logo_effect'=>get_option('themeshock_text_logo_effect'),
		'logo_font_family'=>get_option('themeshock_logo_font_family')
	);
	//$GLOBALS['posts_layout']= get_option("themeshock_grid_post");
	$GLOBALS['search_box'] = get_option('themeshock_show_search_box');
	$GLOBALS['main_menu'] = get_option('themeshock_show_main_menu');
	$GLOBALS['logo_info']=($get_logo_info)?maybe_unserialize($get_logo_info):update_logo_info();
	$GLOBALS['slider_img_info']=($slider_img_info)?maybe_unserialize($slider_img_info):update_slider_info();
	$GLOBALS['sidebar_info']=($sidebar_info)?maybe_unserialize($sidebar_info):update_sidebar();
	$GLOBALS['layout_info']=($layout_info)?maybe_unserialize($layout_info):update_layout();//carga todas las posiciones de los layouts en caso que no cargue porblemente carga la primera vez;	
	$GLOBALS['social_network']=	array('facebook'=>'_face_follow','twitter'=>'_tweet_follow','rss'=>'_rss_feed','mail'=>'_mail','rss_mail'=>'_rss_mail','google'=>'_follow_google','linkedin'=>'_follow_linkedin','skype'=>'_skype');// social netowrk para el header;
	$GLOBALS['slider_type']=(isset($_GET['slider_type']))?$_GET['slider_type']:get_option('themeshock_slider_type');// tipo de slider
	$GLOBALS['layout']=(isset($_GET['layout']))?$_GET['layout']:'layout_1';
	$GLOBALS['framework_tool']=(isset($_GET['framework_tool']))?$_GET['framework_tool']:get_option('themeshock_activate_framework_tool');
	$GLOBALS['validate_sidebar_uri'] = ($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] == 'www.wpthemegenerator.com/' || $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] == 'www.wpthemegenerator.com/posts/' || substr_count($_SERVER['REQUEST_URI'],'wtgs=')==1)?'true':'false';
	$GLOBALS['themeshock_imgpack']= get_option('themeshock_imgpack')?get_option('themeshock_imgpack'):1;
	/*area del opciones del featured-slider*/
	/*
		Si hay thumbs colocarlo en forma multidimensional como esta en el ejemplo debajo
	*/
	$GLOBALS['tgsliderpack']=array(
		'No-Slider'=>'No Slider',
		'Nivo-Slider'=>'Effects slider',
		'Easy-Accordion'=>'Accordion Slider',
		'Piecemaker'=>'3D slider',
		'Featured-Slider'=>'Featured Posts Slider',	
		'fade'=> 'Fading Transition', 
		'sliceV'=> 'Vertical Slice Slider', 
		'slideV'=> 'Vertical Slide Slider', 
		'blockScale'=> 'Scale Blocks Slider',
		'blindH'=> 'Horizontal Blind Slider',
		'blindV'=> 'Vertical Blind Slider',
		'fan'=> array('name'=>'Little Slider','sldpack'=>'{"w":"500","h":"300","delay":"2000","tPosition":"","p":"20px 20px 0","onBackground":"","inTop":"","frm":"tg-border-28"}'),
		/*'kaleidoscope'=> array('name'=>'Poster','sldpack'=>'{"w":"800","h":"1200","delay":"3000","p":"20px 20px 0","onBackground":"","inTop":"","frm":"tg-border-28"}'),*/
		// 'featured-poster' => array('name'=>'Big Poster','sldpack'=>'{"w":"700","h":"1200","delay":"2000","p":"20px 20px 0","onBackground":"","inTop":"","frm":"tg-border-15"}'),
		'cubeH'=> array('name'=>'Horizontal Cube Slider','sldpack'=>'{"w":"800","h":"300","delay":"2000","p":"20px 20px 0","onBackground":"","inTop":"","frm":"tg-border-28"}'), 
		'cubeV'=> array('name'=>'Cube Slider','sldpack'=>'{"w":"500","h":"500","delay":"1500","p":"20px 20px 0","onBackground":"","inTop":"","frm":"tg-border-28"}'), 
		'scale'=>  array('name'=>'Small Bottom Thumbs','sldpack'=>'{"w":"400","h":"500","delay":"2000","tPosition":"bottom","p":"20px 20px 0","onBackground":"","inTop":"","frm":"tg-border-28"}'), 
		'random-top' => array('name'=>'Full Background Slider','sldpack'=>'{"w":"100%","h":"100%","delay":"3000","p":"0","onBackground":true,"inTop":true,"frm":"tg-border-28"}'),
		'random-relative'=> array('name'=>'Big Slider','sldpack'=>'{"w":"100%","h":"600","delay":"3000","p":"0","onBackground":true,"inTop":false,"frm":"tg-border-28"}'), 
		'random-medium'=> array('name'=>'Medium Slider','sldpack'=>'{"w":"100%","h":"350","delay":"3000","p":"0","onBackground":true,"inTop":false,"frm":"tg-border-28"}'), 
		'random'=> array('name'=>'Full Big Slider','sldpack'=>'{"w":"100%","h":"600","delay":"3000","p":"0","onBackground":true,"inTop":false,"frm":"tg-border-28"}'), 
		'slideH'=> array('name'=>'Medium Top Thumbs','sldpack'=>'{"w":"800","h":"400","delay":"3000","tPosition":"top","p":"20px 20px 0","onBackground":"","inTop":"","frm":"tg-border-28"}'),
		'sliceH'=> array('name'=>'Sld, Right Thumbs','sldpack'=>'{"w":"700","h":"300","delay":"3000","tPosition":"right","p":"20px 20px 0","onBackground":"","inTop":"","frm":"tg-border-28"}')
	);
	// $GLOBALS['feat_speed']=get_option('themeshock_feat_speed',3000);
	$GLOBALS['feat_delay']=get_option('themeshock_feat_slidr_autoplay',3000);
	$GLOBALS['feat_effect']=get_option('themeshock_feat_effect_slider','default');
	$GLOBALS['feat_style']=get_option('themeshock_feat_style_slider','default');
	$GLOBALS['thumbpos']=get_option('themeshock_feat_thumb_position_slider','none');
	$GLOBALS['is_res_sldr']=get_option('themeshock_feat_responsiveness_slider','no');
	$GLOBALS['width_slider']=get_option('themeshock_feat_width_slider','900');		
	$GLOBALS['height_slider']=get_option('themeshock_feat_height_slider','366');
	$GLOBALS['feat_title']=get_option('themeshock_feat_caption_field_title_slider','yes');
	$GLOBALS['feat_date']=get_option('themeshock_feat_caption_field_date_slider','yes');
	$GLOBALS['feat_text']=get_option('themeshock_feat_caption_field_text_slider','yes');
	$GLOBALS['feat_author'] = get_option('themeshock_feat_caption_field_author_slider','yes');
	$sliderc=$GLOBALS['tgsliderpack'][$GLOBALS['slider_type']];
	if (is_array($sliderc)){
		$opt=json_decode($sliderc['sldpack'],true);
		$opt['effect']=$GLOBALS['slider_type'];
		$opt['frm']=($GLOBALS['feat_style']==='tg-border-default')?$opt['frm']:$GLOBALS['feat_style'];
	}
	switch ($GLOBALS['slider_type']){
		case 'Featured-Slider':
			$opt['h']=$GLOBALS['height_slider'];
			$opt['w']=$GLOBALS['width_slider'];
			$opt['tPosition']=$GLOBALS['thumbpos'];
			$opt['delay']=$GLOBALS['feat_delay'];
			$opt['effect']=$GLOBALS['feat_effect'];
			$opt['bge'] = true;
		break;
		case 'fade':
		case 'sliceV':
		case 'slideV':
		case 'blockScale':
		case 'blindH':
		case 'blindV':
			$opt['w']=$GLOBALS['width_slider'];
			$opt['h']=$GLOBALS['height_slider'];
			$opt['tPosition']=$GLOBALS['thumbpos'];
			$opt['delay']=$GLOBALS['delay'];
			$opt['effect']=$GLOBALS['slider_type'];
		break;
	}
	
	if (!empty($opt)){
		if ($GLOBALS['is_res_sldr']==='yes'){
			$opt['w']=$opt['h']+($opt['h']/0.7);
		}
		$GLOBALS['slider_pack']=$opt;
	}
	
	// $GLOBALS['res_height_slider']=get_option('themeshock_feat_responsive_height_slider','366');	
	
	/*end slider_area*/
	/*/*glsoptions*/
	/*Area de gls taxaomies opciones globales y definicion por default*/
	 $gls_gallery_def='{"themeshock_gls_box_style":"11","themeshock_gls_box_wdth":"270px","themeshock_gls_btn_clr":"nobutton","themeshock_gls_btn_txt":"","themeshock_gls_btn_fnt_stl":"Open Sans","themeshock_gls_btn_fnt_sz":"12px","themeshock_gls_title_font_size":"48px","themeshock_gls_content_font_size":"inherit","themeshock_gls_content_font_style":"Arial","themeshock_gls_title_font_style":"Wire One","themeshock_gls_no_img":"","themeshock_gls_masonry":"checked"}';
	 $gls_portfolio_def='{"themeshock_gls_box_style":"11","themeshock_gls_box_wdth":"270px","themeshock_gls_btn_clr":"","themeshock_gls_btn_txt":"View Site","themeshock_gls_btn_fnt_stl":"Open Sans","themeshock_gls_btn_fnt_sz":"12px","themeshock_gls_title_font_size":"48px","themeshock_gls_content_font_size":"inherit","themeshock_gls_content_font_style":"Arial","themeshock_gls_title_font_style":"Wire One","themeshock_gls_no_img":"","themeshock_gls_masonry":"checked"}';
	 $gls_products_def='{"themeshock_gls_box_style":"11","themeshock_gls_box_wdth":"270px","themeshock_gls_btn_clr":"","themeshock_gls_btn_txt":"Buy Now","themeshock_gls_btn_fnt_stl":"Open Sans","themeshock_gls_btn_fnt_sz":"12px","themeshock_gls_title_font_size":"48px","themeshock_gls_content_font_size":"inherit","themeshock_gls_content_font_style":"Arial","themeshock_gls_title_font_style":"Wire One","themeshock_gls_no_img":"","themeshock_gls_masonry":"checked"}';
	 $gls_service_def='{"themeshock_gls_box_style":"11","themeshock_gls_box_wdth":"270px","themeshock_gls_btn_clr":"","themeshock_gls_btn_txt":"Buy Now","themeshock_gls_btn_fnt_stl":"Open Sans","themeshock_gls_btn_fnt_sz":"12px","themeshock_gls_title_font_size":"48px","themeshock_gls_content_font_size":"inherit","themeshock_gls_content_font_style":"Arial","themeshock_gls_title_font_style":"Wire One","themeshock_gls_no_img":"","themeshock_gls_masonry":"checked"}';
	 $GLOBALS['gls_gallery']=json_decode(get_option('themeshock_gls_custom_post_type'.get_ID_by_page_name('Gallery-wts'),$gls_gallery_def),true);
	 $GLOBALS['gls_portfolio']=json_decode(get_option('themeshock_gls_custom_post_type'.get_ID_by_page_name('Portfolio-wts'),$gls_portfolio_def),true);
	 $GLOBALS['gls_service']=json_decode(get_option('themeshock_gls_custom_post_type'.get_ID_by_page_name('Service-wts'),$gls_service_def),true);
	 $GLOBALS['gls_products']=json_decode(get_option('themeshock_gls_custom_post_type'.get_ID_by_page_name('Product-wts'),$gls_products_def),true);
	/*end glsoptions*/
	function postype_options($postypeid){
		$custom = get_post_custom($postypeid);
		$website_url = $custom["website_url"][0];
		$frame_style = $custom["frame_style"][0]?$custom["frame_style"][0]:'shadow';
		$caption_img = $custom["caption_img"][0];
		$item_value = $custom["item_value"][0];
	  	$currency_val = $custom["currency_val"][0];
		$full_img = get_the_post_thumbnail($postypeid,'full');
		$find_ini = 'src="';
		$find_end = '"';
		$pos_1 = strpos($full_img, $find_ini)+5;
		$part_1 = substr($full_img, $pos_1);
		$pos_2 = strpos($part_1, $find_end);
		$full = substr($part_1, 0, $pos_2);
		$GLOBALS['post_type_options'] = array('website_url'=>$website_url, 'frame_style'=>$frame_style, 'caption_img'=>$caption_img, 'full'=>$full, 'item_value'=>$item_value, 'currency_val'=> $currency_val);
		return $GLOBALS['post_type_options'];
	}
	//$link_cred = array('wp theme by wpthemegenerator', 'wordpress theme by wp theme generator','created with wp theme generator', 'theme created wp theme generator','wp theme by wp theme generator','created with wpthemegenerator','built with wp theme generator','created with wordpress theme generator','by wordpress theme generator','theme by wordpress theme generator','wp theme created with wp theme generator');
	
		//$GLOBALS['wptg_credits'] = $link_cred[rand(0, 10)];
	
		$link_credict_compl = array('wp theme by', 'wordpress theme by', 'created with', 'theme created', 'built with', 'by', 'theme by', 'wp theme created with');
		$link_credict_name = array(
			array('wpthemegenerator', 'theme generator', 'theme generator', 'wp theme generator', 'wp theme generator', 'wordpress theme generator'), 
			array('wordpressthemeshock', 'wpthemeshock', 'themeshock', 'wordpress theme shock', 'wp theme shock', 'theme shock'));
		
		$rand_domain_shock = rand(0, 1);
		$GLOBALS['wptg_credits'] = ($rand_domain_shock == 0)?
		array('wpthemegenerator.com', $link_credict_compl[rand(0, 7)].' '.$link_credict_name[$rand_domain_shock][rand(0, 5)]):
		array('wordpressthemeshock.com ', $link_credict_compl[rand(0, 7)].' '.$link_credict_name[$rand_domain_shock][rand(0, 5)]);
	

//	var_dump(substr_count($_SERVER['REQUEST_URI'],'wtgs='));
/*	var_dump($_SERVER);
	exit;*/
?>
<?php 
global $wpdb;

// Create home object
	$ins_portfolio = array(
		'post_title' => 'Home',
		'post_name' => 'home-wts',
		'post_status' => 'publish',
		'post_type' => 'page',
		'comment_status' => 'closed',
		'ping_status' => 'closed'
	);
  
  
  	$resultp = $wpdb->query("SELECT wpost.post_name FROM $wpdb->posts wpost WHERE wpost.post_name = 'home-wts'");
  
	if($resultp<1){// Insert the post into the database
		$page_id = wp_insert_post( $ins_portfolio );
		add_post_meta($page_id,'_wp_page_template','homemain.php');
		add_option('TS_sliderdf_'.$page_id,'false');
	}


// Create portfolio object
	$ins_portfolio = array(
		'post_title' => 'Portfolio',
		'post_name' => 'portfolio-wts',
		'post_status' => 'publish',
		'post_type' => 'page',
		'comment_status' => 'closed',
		'ping_status' => 'closed'
	);
  
  
  	$resultp = $wpdb->query("SELECT wpost.post_name FROM $wpdb->posts wpost WHERE wpost.post_name = 'portfolio-wts'");
  
	if($resultp<1){// Insert the post into the database
		$page_id = wp_insert_post( $ins_portfolio );
		add_post_meta($page_id,'_wp_page_template','portfolio.php');
		add_option('TS_sliderdf_'.$page_id,'false');
	}

// Create gallery object
	$ins_gallery = array(
		'post_title' => 'Gallery',
		'post_name' => 'gallery-wts',
		'post_status' => 'publish',
		'post_type' => 'page',
		'comment_status' => 'closed',
		'ping_status' => 'closed'
	);
	
	$resultg = $wpdb->query("SELECT wpost.post_name FROM $wpdb->posts wpost WHERE wpost.post_name = 'gallery-wts'");

	if($resultg<1){// Insert the post into the database
		$page_id = wp_insert_post( $ins_gallery );
		add_post_meta($page_id,'_wp_page_template','gallery.php');
		add_option('TS_sliderdf_'.$page_id,'false');
	}
	
// Create product object
	$ins_product = array(
		'post_title' => 'Products',
		'post_name' => 'product-wts',
		'post_status' => 'publish',
		'post_type' => 'page',
		'comment_status' => 'closed',
		'ping_status' => 'closed'
	);
	
	$resultg = $wpdb->query("SELECT wpost.post_name FROM $wpdb->posts wpost WHERE wpost.post_name = 'product-wts'");

	if($resultg<1){// Insert the post into the database
		$page_id = wp_insert_post( $ins_product );
		add_post_meta($page_id,'_wp_page_template','product.php');
		add_option('TS_sliderdf_'.$page_id,'false');
	}

// Create service object
	$ins_service = array(
		'post_title' => 'Services',
		'post_name' => 'service-wts',
		'post_status' => 'publish',
		'post_type' => 'page',
		'comment_status' => 'closed',
		'ping_status' => 'closed'
	);
	
	$resultg = $wpdb->query("SELECT wpost.post_name FROM $wpdb->posts wpost WHERE wpost.post_name = 'service-wts'");

	if($resultg<1){// Insert the post into the database
		$page_id = wp_insert_post( $ins_service );
		add_post_meta($page_id,'_wp_page_template','service.php');
		add_option('TS_sliderdf_'.$page_id,'false');
	}
	
// Create contact object
	$ins_contact = array(
		'post_title' => 'Contact',
		'post_name' => 'contact-form-wts',
		'post_status' => 'publish',
		'post_type' => 'page',
		'comment_status' => 'closed',
		'ping_status' => 'closed'
	);
	
	$resultc = $wpdb->query("SELECT wpost.post_name FROM $wpdb->posts wpost WHERE wpost.post_name = 'contact-form-wts'");

	if($resultc<1){// Insert the post into the database
		$page_id = wp_insert_post( $ins_contact );
		add_post_meta($page_id,'_wp_page_template','contact.php');
		add_option('TS_sliderdf_'.$page_id,'false');	
	}
	
// Create testimonial object
	$ins_testimonial = array(
		'post_title' => 'Testimonials',
		'post_name' => 'testimonials-wts',
		'post_status' => 'publish',
		'post_type' => 'page',
		'comment_status' => 'closed',
		'ping_status' => 'closed'
	);
	
	$resultt = $wpdb->query("SELECT wpost.post_name FROM $wpdb->posts wpost WHERE wpost.post_name = 'testimonials-wts'");

	if($resultt<1){// Insert the post into the database
		$page_id = wp_insert_post( $ins_testimonial );
		add_post_meta($page_id,'_wp_page_template','testimonial.php');
		add_option('TS_sliderdf_'.$page_id,'false');	
	}

// Write into DB de default setting of the template 
	$themename = "RetroName Settings";  
 	$shortname = "themeshock";
	$default_settings[$shortname."_template_actually"]='App theme generator';/// template actually
	$default_settings['active_slider']='false';// slider default for  mainpage blog
	$default_settings[$shortname."_font_style"]=((isset($_GET["themedemo"])&&$_GET["themedemo"] == 'App theme generator') || get_option('themeshock_font_style')=='Oswald' )?'Oswald':get_option($shortname."_font_style");// default font selector, se cambio la 	validacion debido al plugin
	$default_settings[$shortname."_color_style"]='blue';// default color
	$random_slider=array("Nivo-Slider","Easy-Accordion","Piecemaker");
	$default_settings[$shortname."_slider_type"]=(isset($_GET["themedemo"]) )?get_option($shortname."_slider_type"):$random_slider[rand(0,2)];// default slider randomly change for the plugin
	$default_settings[$shortname."_slider_fx"]='random'; ///slider fx default
	$default_settings[$shortname."_slider_autoplay"]='yes'; ///slider autoplay
	$default_settings[$shortname."_anim_speed"]='500';//anim speed default
	$default_settings[$shortname."_slice_num"]='15';/// slice num default;
	$default_settings[$shortname.'_feat_speed']='3000';/// slice num default;
	if(isset($GLOBALS['display_elements']) && $GLOBALS['display_elements'][0] == 'show'){
	$default_settings[$shortname.'_face_follow']='#';/// facebook url
	$default_settings[$shortname.'_face_follow_option']='true';/// facebook display
	$default_settings[$shortname.'_tweet_follow']='#';/// twitter url
	$default_settings[$shortname.'_tweet_follow_option']='true';/// twitter display
	$default_settings[$shortname.'_rss_feed']='#';/// rss feed url
	$default_settings[$shortname.'_rss_feed_option']='true';/// rss feed display
	$default_settings[$shortname.'_mail']='#';/// mail url		
	$default_settings[$shortname.'_mail_option']='true';/// mail display
	}
	$default_settings[$shortname.'_ga_code']='';
	$default_settings[$shortname.'_info']='';
	$default_settings[$shortname.'_shp_cart_show']=array('Products');
	$default_settings['ts_shopping_cart']='http://www.yourmerchant.com/?';
	$default_settings[$shortname.'_default_post_boxes']='true';
	(isset($GLOBALS['display_elements']) && $GLOBALS['display_elements'][0] == 'show')?$default_settings[$shortname.'_show_main_menu']='true':$default_settings[$shortname.'_show_main_menu']='false';
	(isset($GLOBALS['display_elements']) && $GLOBALS['display_elements'][2] == 'show')?$default_settings[$shortname.'_show_search_box']='true':$default_settings[$shortname.'_show_search_box']='false';
	$default_settings[$shortname.'_logo_type']="image";
	$default_settings[$shortname.'_text_logo_effect']="normal";
	$default_settings[$shortname.'_text_logo']="My Company";
	$default_settings[$shortname.'_font_size_logo']="0px";
	$default_settings[$shortname.'_logo_font_family']="News Cycle";
	$default_settings[$shortname.'_enablePostTypeGallery']='true';
	$default_settings[$shortname.'_enablePostTypePortfolio']='true';
	$default_settings[$shortname.'_enablePostTypeServices']='true';
	$default_settings[$shortname.'_enablePostTypeProducts']='true';
	$default_settings[$shortname.'_enablePostTypeTestimonials']='true';
	$default_settings[$shortname.'_enableResponsive']='true';
	$default_settings[$shortname.'_content_layout']='content_layout_normal';
	
	$default_settings[$shortname.'_iconPostAuthor']='true';
	$default_settings[$shortname.'_iconPostDate']='true';
	$default_settings[$shortname.'_iconPostCategory']='true';
	$default_settings[$shortname.'_iconPostTags']='true';
	$default_settings[$shortname.'_iconPostComments']='true';
	$default_settings[$shortname.'_iconPostComments2']='true';
	

	/// piecemaker settings default
	$default_settings[$shortname."_pm_tweenType"]='linear';
	$default_settings[$shortname."_pm_autoplay"]='10';
	$reset_default = false;
	
	if (get_option($shortname."_template_actually")!==$default_settings[$shortname."_template_actually"]){
		$reset_default=true;
		update_option($shortname."_template_actually",$default_settings[$shortname."_template_actually"]);
		//get_template_part('functions/init_layout');
	}
	
	foreach($default_settings as $option_name => $option_value){
		if(!get_option($option_name)){
				add_option($option_name,$option_value);
		}
		if ((isset($_POST['action'])&&$_POST['action']==='reset') || $reset_default===true){
			 update_option($option_name,$option_value);
		}
	}
	
?>
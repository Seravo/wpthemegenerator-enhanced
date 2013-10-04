<?php
/*************** 
File: Taxonomies
***************/

// Taxonomy Gallery

//add_action('init', 'wtsgallery');
activeCustomPostType('Gallery', 'wtsgallery', 'gallery-wts');

	function wtsgallery(){
		$labelg = array(
			'name' => _x('Gallery Items','post type general name'),
			'singular_name' => _x('Gallery item', 'post type singular name'),
			'add_new' => _x('Add New', 'gallery'),
			'add_new_item' => __('Add new gallery item'),
			'edit_item' => __('Edit gallery item'),
			'new_item' => __('New gallery item'),
			'view item' => __('View gallery item'),
			'search_items' => __('Search gallery items'),
			'not_found' => __('No galley item found'),
			'not_found_in_trash' => __('No gallery item found in trash'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labelg,
			'public' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'_builtin' => false,
			'capability_type' => 'post',
			'hierarchical' => true,
			'rewrite' => array("slug" => "wtsgallery"),
			'supports' => array('title', 'editor', 'thumbnail','excerpt')
		);
		
		register_post_type('wtsgallery', $args);
	}
	
	add_action('admin_init', 'add_wtsgallery');
	function add_wtsgallery(){
		add_meta_box("gallery_details", "Gallery options", "gallery_options", "wtsgallery", "normal", "low");
	}
	
	add_action('init', 'create_gallery_taxonomy', 0);
	function create_gallery_taxonomy(){
		$labelt = array(
			'name' => _x('Galleries', 'taxonomy general name'),
			'singular_name' => _x('Gallery', 'taxonomy singular name'),
			'search_items' => __('Search Gallery'),
			'popular_items' => __('Popular Gallery'),
			'all_items' => __('All galleries'),
			'parent_item' => null,
			'parent-item_colon' => null,
			'edit_item' => __('Edit gallery'),
			'update_item' => __('Update gallery'),
			'add_new_item' => __('Add new gallery'),
			'new_item_name' => __('New gallery'),
			'separate_items_with_commas' => __('Separate galleries with commas'),
			'add_or_remove_items' => __('Add or remove galleries'),
			'choose_from_most_used' => __('Choose from the most used galleries'),
			'menu_name' => __('Gallery Names')
		);
		register_taxonomy('galleries', array('wtsgallery'), array(
			'public' => true,
			'hierarchical' => true,
			'labels' => $labelt,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array("slug" => "galleries")
		));
		flush_rewrite_rules();
	}
	
	function query_post_type($query) {
		global $post;
		$array_taxos = array('galleries', 'portfolios', 'brochures', 'catalogs');
		foreach($array_taxos as $taxo){
			$single_name = substr($taxo, 0, -1);
			$term_obj = wp_get_object_terms( $post->ID, $taxo);
			if(!$term_obj){
				$arr_tes = wp_insert_term(
					'No Category',
					$taxo,
					array('description'=> "Default Category.",	'slug' => "no-category-$single_name",'parent'=> 0)
				);
				wp_set_object_terms( $post->ID, array('slug' => "no-category-$single_name"), $taxo, true);
			}			
		}
	}
	
	add_filter('pre_get_posts', 'query_post_type');
	add_action('save_post', 'update_frame_style_gall');

	function gallery_options(){
		global $post;
		$custom = get_post_custom($post->ID);
		$frame_style = $custom["frame_style"][0];
		$featured_item = $custom["featured_item"][0];
		$caption_img = $custom["caption_img"][0];
?>
	<div id="gallery-options">
    	<label>Frame style:</label>
      <select name="frame_style">
        <?php 
				foreach(range(0, 14) as $frameStyle){
					$optionSelected = ($frame_style == $frameStyle)?'selected="selected"':'';
					($frameStyle == 0)?$frameStyle='shadow':'';
					echo "<option value=\"$frameStyle\" $optionSelected>Frame $frameStyle</option>";
				}
				?>
      </select>
      <label>Featured Gallery:</label>
      <input type="checkbox" name="featured_item" id="featured_item" <?php if($featured_item){?> checked="checked" <?php }?> />
      <label>Item Caption:</label>
      <input size="50" type="text" name="caption_img" id="caption_img" value="<?php echo $caption_img?>" />
    </div>
<?php	}
	
	function update_frame_style_gall(){
		global $post;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
		update_post_meta($post->ID, "frame_style", 	$_POST["frame_style"]);
	}
	
	add_filter("manage_edit-wtsgallery_columns","gallery_edit_columns");
	add_action("manage_wtsgallery_posts_custom_column", "gallery_columns_display");
	
	function gallery_edit_columns($gallery_columns){
		$gallery_columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Gallery item"),
			"galleries" => "Gallery Name",
			"author" => "Author",
			"date" => "Date"
		);
		return $gallery_columns;
	}
	
	function gallery_columns_display($gallery_cols){
		global $post;
		switch($gallery_cols){
			case "galleries": 
				echo get_the_term_list($post->ID, 'galleries', '', ', ', '');
			break;
		}
	}
	

/********************
// Taxonomy Portfolio
********************/

//add_action('init', 'wtsportfolio');
activeCustomPostType('Portfolio', 'wtsportfolio', 'portfolio-wts');
	function wtsportfolio(){
		$labelp = array(
			'name' => _x('Portfolio Items','post type general name'),
			'singular_name' => _x('Portfolio Item', 'post type singular name'),
			'add_new' => _x('Add New', 'portfolio'),
			'add_new_item' => __('Add new portfolio item'),
			'edit_item' => __('Edit portfolio item'),
			'new_item' => __('New portfolio item'),
			'view item' => __('View portfolio item'),
			'search_items' => __('Search portfolio items'),
			'not_found' => __('No portfolio item found'),
			'not_found_in_trash' => __('No portfolio item found in trash'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labelp,
			'public' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'_builtin' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "wtsportfolio"),
			'supports' => array('title', 'editor', 'thumbnail', 'comments','excerpt')
		);
		
		register_post_type('wtsportfolio', $args);
		flush_rewrite_rules();
	}
	
	add_action('init', 'create_portfolio_taxonomy', 0);
	function create_portfolio_taxonomy(){
		$labelt = array(
			'name' => _x('Portfolios', 'taxonomy general name'),
			'singular_name' => _x('Portfolio', 'taxonomy singular name'),
			'search_items' => __('Search Portfolio'),
			'popular_items' => __('Popular portfolio'),
			'all_items' => __('All portfolios'),
			'parent_item' => null,
			'parent-item_colon' => null,
			'edit_item' => __('Edit portfolio'),
			'update_item' => __('Update portfolio'),
			'add_new_item' => __('Add new portfolio'),
			'new_item_name' => __('New portfolio'),
			'separate_items_with_commas' => __('Separate portfolios with commas'),
			'add_or_remove_items' => __('Add or remove portfolios'),
			'choose_from_most_used' => __('Choose from the most used portfolios'),
			'menu_name' => __('Portfolios')
		);
		register_taxonomy('portfolios', array('wtsportfolio'), array(
			'public' => true,
			'hierarchical' => true,
			'labels' => $labelt,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array("slug" => "portfolios") 
		));
		flush_rewrite_rules();
	}
	
	add_action('admin_init', 'add_wtsportfolio');
	add_action('save_post', 'update_website_url');
	add_action('save_post', 'update_frame_style');
	
	function add_wtsportfolio(){
		add_meta_box("portfolio_details", "Portfolio Options", "portfolio_options", "wtsportfolio", "normal", "low");
	}
	function portfolio_options(){
		global $post;
		$custom = get_post_custom($post->ID);
		$website_url = $custom["website_url"][0];
		$frame_style = $custom["frame_style"][0];
		$featured_item = $custom["featured_item"][0];
?>
	<div id="gallery-options">
    	<label>Website URL:</label>
      <input type="text" name="website_url" size="70" id="website_url" value="<?php echo $website_url;?>" />
    	<label> Frame Style:</label>
      <select name="frame_style">
        <?php 
				foreach(range(0, 14) as $frameStyle){
					$optionSelected = ($frame_style == $frameStyle)?'selected="selected"':'';
					($frameStyle == 0)?$frameStyle='shadow':'';
					echo "<option value=\"$frameStyle\" $optionSelected>Frame $frameStyle</option>";
				}
				?>
      </select>
      <label>Featured Portfolio:</label>
			<input type="checkbox" name="featured_item" id="featured_item" <?php if($featured_item){?> checked="checked" <?php }?> />
	</div>
<?php }
	
	function update_website_url(){
		global $post;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
		update_post_meta($post->ID, "website_url", $_POST["website_url"]);
	}
	
	function update_frame_style(){
		global $post;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
		update_post_meta($post->ID, "frame_style", $_POST["frame_style"]);
	}
	
	add_filter("manage_edit-wtsportfolio_columns","portfolio_edit_columns");
	add_action("manage_posts_custom_column", "portfolio_columns_display");
	
	function portfolio_edit_columns($portfolio_columns){
		$portfolio_columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Portfolio item title",
			"date" => "Date",
			"portfolios" => "Portfolio",
			"author" => "Author"
		);
		return $portfolio_columns;
	}
	function portfolio_columns_display($portfolio_column){
		global $post;
		switch($portfolio_column){
			case "date":
				the_date();
			break;
			case "portfolios":
				echo get_the_term_list($post->ID, 'portfolios', '', ', ', '');
			break;
			case "author":
				the_author();
			break;
		}
	}

	add_action( 'after_setup_theme', 'themes_setup' );
	
	if ( ! function_exists( 'themes_setup' ) ):
	function themes_setup(){
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
		
		// The height and width of your custom header. You can hook into the theme's own filters to change these values.
		// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'image_width', 250 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'image_height', 250 ) );
	
		// We'll be using post thumbnails for custom header images on posts and pages.
		// We want them to be 940 pixels wide by 198 pixels tall.
		// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
	}
	endif;
	
	
/*******************/
// Taxonomy Products
/*******************/

//add_action('init', 'wtsproduct');
activeCustomPostType('Products', 'wtsproduct', 'product-wts');

	function wtsproduct(){
		$labelp = array(
			'name' => _x('Product Items','post type general name'),
			'singular_name' => _x('Product Item', 'post type singular name'),
			'add_new' => _x('Add New', 'product'),
			'add_new_item' => __('Add new product item'),
			'edit_item' => __('Edit product item'),
			'new_item' => __('New product item'),
			'view item' => __('View product item'),
			'search_items' => __('Search product items'),
			'not_found' => __('No product item found'),
			'not_found_in_trash' => __('No product item found in trash'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labelp,
			'public' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'_builtin' => false,
			'capability_type' => 'post',
			'hierarchical' => true,
			'rewrite' => array("slug" => "wtsproduct"),
			'supports' => array('title', 'editor', 'thumbnail', 'comments','excerpt')
		);
		register_post_type('wtsproduct', $args);
		flush_rewrite_rules();
	}
	
	add_action('init', 'create_product_taxonomy', 0);
	
	function create_product_taxonomy(){
		$labelt = array(
			'name' => _x('Catalogs', 'taxonomy general name'),
			'singular_name' => _x('Catalog', 'taxonomy singular name'),
			'search_items' => __('Search Catalog'),
			'popular_items' => __('Popular catalogs'),
			'all_items' => __('All catalogs'),
			'parent_item' => null,
			'parent-item_colon' => null,
			'edit_item' => __('Edit catalog'),
			'update_item' => __('Update catalog'),
			'add_new_item' => __('Add new catalog'),
			'new_item_name' => __('New catalog'),
			'separate_items_with_commas' => __('Separate catalogs with commas'),
			'add_or_remove_items' => __('Add or remove catalogs'),
			'choose_from_most_used' => __('Choose from the most used catalogs'),
			'menu_name' => __('Catalogs')
		);
		register_taxonomy('catalogs', array('wtsproduct'), array(
			'public' => true,
			'hierarchical' => true,
			'labels' => $labelt,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array("slug" => "catalogs")
		));
		flush_rewrite_rules();
	}
	
	add_action('admin_init', 'add_wtsproduct');
	add_action('save_post', 'update_website_url');
	add_action('save_post', 'update_frame_style');
	add_action('save_post', 'update_currency_val');
	add_action('save_post', 'update_item_value');
	
	function add_wtsproduct(){
		add_meta_box("product_details", "Product Options", "product_options", "wtsproduct", "normal", "low");
	}

	function product_options(){
		global $post;
		$custom = get_post_custom($post->ID);
		$website_url = $custom["website_url"][0];
		$frame_style = $custom["frame_style"][0];
		$featured_item = $custom["featured_item"][0];
		$item_value 	= $custom["item_value"][0];
		$currency_val	= $custom["currency_val"][0];
?>
	<div id="gallery-options">
		<label>Payment Link:</label><input type="text" id="website_url" name="website_url" value="<?php echo $website_url; ?>" />
    <label>Price:</label><input type="text" id="item_value" name="item_value" value="<?php echo $item_value; ?>" />
    <label>Currency:</label>
    <select name="currency_val" id="currency_val">
      <option value="<?php echo $currency_val; ?>"><?php echo $currency_val; ?></option>
      <option value="BRL">BRL</option>
      <option value="CAD">CAD</option>
      <option value="CNY">CNY</option>
      <option value="COP">COP</option>
      <option value="EUR">EUR</option>
      <option value="GBP">GBP</option>
      <option value="MXN">MXN</option>
      <option value="JPY">JPY</option>
      <option value="USD">USD</option>
    </select>
		<label> Frame Style:</label>
    <select name="frame_style">
      <?php 
      foreach(range(0, 14) as $frameStyle){
        $optionSelected = ($frame_style == $frameStyle)?'selected="selected"':'';
        ($frameStyle == 0)?$frameStyle='shadow':'';
        echo "<option value=\"$frameStyle\" $optionSelected>Frame $frameStyle</option>";
      }
      ?>
    </select>
    <label>Featured Product:</label>
    <input type="checkbox" name="featured_item" id="featured_item" <?php if($featured_item){?> checked="checked" <?php }?> />
	</div>
<?php	}
	
	function update_currency_val(){
		global $post;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
		update_post_meta($post->ID, "currency_val", $_POST["currency_val"]);
	}
	
	function update_item_value(){
		global $post;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
		update_post_meta($post->ID, "item_value", $_POST["item_value"]);
	}
	
	add_filter("manage_edit-wtsproduct_columns","product_edit_columns");
	add_action("manage_posts_custom_column", "product_columns_display");
	
	function product_edit_columns($product_columns){
		$product_columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Product name",
			"date" => "Date",
			"catalogs" => "",
			"author" => "Author"
		);
		return $product_columns;
	}
	
	function product_columns_display($product_column){
		global $post;
		switch($product_column){
			case "date":
				the_date();
			break;
			case "catalogs":
				echo get_the_term_list($post->ID, 'catalogs', '', ', ', '');
			break;
			case "author":
				echo 'gato';
			break;
		}
	}
	
	/*shopping cart*/
	function tg_action_shp_cart($id,$action_type){
		$time=time()+(15552000);
		$price_total=0;
		$total_items=0;
		switch($_POST['action_type']){
			case 'tg_shp_add':/*añade un producto*/
				$quantity=(isset($_COOKIE['tg_shp_cart'][$id]))?(int)$_COOKIE['tg_shp_cart'][$id]+1:1;
				@setcookie("tg_shp_cart[$id]",$quantity,$time,'/');
				$price_total=(int)get_post_meta($id, 'item_value',true);
				$total_items=1;
				$total_single=1;
				$price_single=$price_total;
				if (!isset($_COOKIE['tg_shp_cart'][$id])){//primera vez
					$return[$id]['title']=get_the_title($id);
					$return[$id]['quantity']=1;
					$return[$id]['price']=$price_single;
				}
			break;
			case 'tg_shp_remove':/*elimina los items de un producto*/
				$quantity=(isset($_COOKIE['tg_shp_cart'][$id]))?(int)$_COOKIE['tg_shp_cart'][$id]-1:0;
				if ($quantity===0){
					@setcookie("tg_shp_cart[$id]",$quantity,time()-1,'/');
				}else{
					@setcookie("tg_shp_cart[$id]",$quantity,$time,'/');
				}
				$price_total=-1*(int)get_post_meta($id, 'item_value',true);
				$total_items=-1;
				$total_single=-1;
				$price_single=$price_total;
			break;
			case 'tg_shp_delete':/*borra un producto*/
				@setcookie("tg_shp_cart[$id]",$quantity,time()-1,'/');
				unset($_COOKIE['tg_shp_cart'][$id]);
				$return[$id]['quantity']=0;
				$return[$id]['price']=0;
			break;
			case 'get_all_items':
			break;
		}
		if (isset($_COOKIE['tg_shp_cart'])){
			foreach($_COOKIE['tg_shp_cart'] as $id_shp =>$quantity){
				$total_items=$total_items+(int)$quantity;
				$get_product_price=(int)get_post_meta($id_shp, 'item_value',true);
				$price_current=(int)bcmul($get_product_price,(int)$quantity);
				$price_total=bcadd($price_total,$price_current);
				$return[$id_shp]['title']=get_the_title($id_shp);
				$return[$id_shp]['quantity']=($id_shp==$id)?(int)$quantity+$total_single:(int)$quantity;
				$return[$id_shp]['price']=($id_shp==$id)?(int)$price_current+$price_single:(int)$price_current;
			}
		}
		$return['price_total']=$price_total;
		$return['total_items']=$total_items;
		$return['currrency']=$GLOBALS['tg_shp_currency'];
		if ($action_type!==false){
			return $return;
		}else{
			echo json_encode($return);
		}
	}
	function tg_shp_cart_ajax($action_type=false){
		$action_type=($action_type==='')?false:$action_type;
		if (isset ($_POST['action_type']) or $action_type!==false ){
			$_POST['action_type']=($action_type!==false )?$action_type:$_POST['action_type'];
			$id=$_POST['tg_id_product'];
			switch($_POST['action_type']){
				case 'tg_shp_add':/*añade un producto*/
				case 'tg_shp_remove':/*elimina los items de un producto*/
				case 'tg_shp_delete':/*borra un producto*/
					$return =tg_action_shp_cart($id,$action_type);
				break;
				case 'get_all_items':
					$return =tg_action_shp_cart('',$action_type);
				break;
			}
		}
		if ($action_type!==false){
			return $return;
		}else{
			exit;
		}
	}
	add_action('wp_ajax_tg_shp_cart', 'tg_shp_cart_ajax');
	add_action('wp_ajax_nopriv_tg_shp_cart', 'tg_shp_cart_ajax');	//acciones ajax para el shopping cart


/*******************/	
// Taxonomy services
/*******************/

//add_action('init', 'wtsservice');
activeCustomPostType('Services', 'wtsservice', 'service-wts');

	function wtsservice(){
		$labels = array(
			'name' => __('Services','tstranslate'),
			'singular_name' => __('Service','tstranslate'),
			'add_new' => __('Add New','tstranslate'),
			'add_new_item' => __('Add new service item','tstranslate'),
			'edit_item' => __('Edit service item','tstranslate'),
			'new_item' => __('New service item','tstranslate'),
			'view item' => __('View service item','tstranslate'),
			'search_items' => __('Search service items','tstranslate'),
			'not_found' => __('No service item found','tstranslate'),
			'not_found_in_trash' => __('No service item found in trash','tstranslate'),
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'_builtin' => false,
			'capability_type' => 'post',
			'hierarchical' => true,
			'rewrite' => array("slug" => "wtsservice"),
			'supports' => array('title', 'editor', 'thumbnail', 'comments','excerpt')
		);
		register_post_type('wtsservice', $args);
		flush_rewrite_rules();
	}
	
	add_action('init', 'create_brochure_taxonomy', 0);
	
	function create_brochure_taxonomy(){
		$labelts = array(
			'name' => __('Brochures','tstranslate'),
			'singular_name' => __('Brochure','tstranslate'),
			'search_items' => __('Search Brochure','tstranslate'),
			'popular_items' => __('Popular brochures','tstranslate'),
			'all_items' => __('All brochures','tstranslate'),
			'parent_item' => null,
			'parent-item_colon' => null,
			'edit_item' => __('Edit brochure','tstranslate'),
			'update_item' => __('Update brochure','tstranslate'),
			'add_new_item' => __('Add new brochure','tstranslate'),
			'new_item_name' => __('New brochure','tstranslate'),
			'separate_items_with_commas' => __('Separate brochures with commas','tstranslate'),
			'add_or_remove_items' => __('Add or remove brochures','tstranslate'),
			'choose_from_most_used' => __('Choose from the most used brochures','tstranslate'),
			'menu_name' => __('Brochures','tstranslate')
		);
		register_taxonomy('brochures', array('wtsservice'), array(
			'public' => true,
			'hierarchical' => true,
			'labels' => $labelts,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array("slug" => "brochures")
		));
		flush_rewrite_rules();
	}
	
	add_action('admin_init', 'add_wtsservice');
	
	function add_wtsservice(){
		add_meta_box("service_details", __("Service Options",'tstranslate'), "service_options", "wtsservice", "normal", "low");
	}

	function service_options(){
		global $post;
		$custom = get_post_custom($post->ID);
		$frame_style = $custom["frame_style"][0];
		$feat_serv_item = $custom["feat_serv_item"][0];
?>
	<div id="gallery-options">
    <label><?php echo __('Frame style:','tstranslate');?></label>
      <select name="frame_style">
        <?php 
				foreach(range(0, 14) as $frameStyle){
					$optionSelected = ($frame_style == $frameStyle)?'selected="selected"':'';
					($frameStyle == 0)?$frameStyle='shadow':'';
					echo "<option value=\"$frameStyle\" $optionSelected>Frame $frameStyle</option>";
				}
				?>
      </select>
    <label><?php echo __('Featured Service:','tstranslate');?></label>
    <input type="checkbox" name="feat_serv_item" id="feat_serv_item" <?php if($feat_serv_item){?> checked="checked" <?php }?> />
	</div>
<?php }
	
	add_action('save_post', 'update_feat_serv_item');
	
	function update_feat_serv_item(){
		global $post;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
		update_post_meta($post->ID, "feat_serv_item", $_POST["feat_serv_item"]);
	}
	
	add_filter("manage_edit-wtsservice_columns","service_edit_columns");
	add_action("manage_wtsservice_posts_custom_column", "service_columns_display");
	
	function service_edit_columns($service_columns){
		$service_columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Service name",'tstranslate'),
			"brochures" => "Brochure",
			"author" => __("Author",'tstranslate'),
			"date" => __("Date",'tstranslate')
		);
		return $service_columns;
	}
	
	function service_columns_display($service_cols){
		global $post;
		switch($service_cols){
			case "brochures": echo get_the_term_list($post->ID, 'brochures', '', ', ', '');
			break;
		}
	}

/*************/
// Testimonial
/*************/

//add_action('init', 'wtstestimonial');
activeCustomPostType('testimonials', 'wtstestimonial', 'testimonials-wts');

function wtstestimonial(){
	$labelg = array(
		'name' => _x('Testimonials','post type general name'),
		'singular_name' => _x('Testimonial', 'post type singular name'),
		'add_new' => _x('Add New', 'testimonial'),
		'add_new_item' => __('Add new testimonial'),
		'edit_item' => __('Edit testimonial'),
		'new_item' => __('New testimonial'),
		'view item' => __('View testimonial'),
		'search_items' => __('Search testimonial'),
		'not_found' => __('No testimonial found'),
		'not_found_in_trash' => __('No testimonial found in trash'),
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labelg,
		'public' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'_builtin' => false,
		'capability_type' => 'post',
		'hierarchical' => true,
		'rewrite' => array("slug" => "wtstestimonial"),
		'supports' => array('title', 'editor')
	);
	register_post_type('wtstestimonial', $args);
}

add_action('admin_init', 'add_wtstestimonial');
add_action('save_post', 'update_featured_item');

function add_wtstestimonial(){
	add_meta_box("testimonial_details", "Testimonial Options", "testimonial_options", "wtstestimonial", "normal", "low");
}

function testimonial_options(){
	global $post;
	$custom = get_post_custom($post->ID);
	$featured_item = $custom["featured_item"][0];
	$testimonial_by = $custom["testimonial_by"][0];
?>
	<div id="gallery-options">
  	<label>Featured Testimonial:</label>
    <input type="checkbox" name="featured_item" id="featured_item" <?php if($featured_item){?> checked="checked" <?php }?> />
    <label>Testimonial by:</label>
    <input type="text" name="testimonial_by" id="testimonial_by" size="50"  value="<?php echo $testimonial_by;?>" />
  </div>
<?php }

function update_featured_item(){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	return;
	update_post_meta($post->ID, "featured_item", $_POST["featured_item"]);
	update_post_meta($post->ID, "testimonial_by", $_POST["testimonial_by"]);
}	
?>
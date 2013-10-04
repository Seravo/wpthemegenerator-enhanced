<?php 
global $post, $wpdb, $wp_query, $query_string;

// POSTS
function featured_posts($atts, $content = null) {
	global $post, $wpdb, $wp_query, $query_string;
	extract( shortcode_atts( array(
	'number' => '5',
	'style' => '1'
	), $atts ) );

	$multitask = '
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#carousel_1").carouFredSel({
			items: {visible: '.$number.',	minimum: 1},
			scroll: { items: 1, pauseOnHover: true},
			auto: false,
			prev : { button: "#prev_1"},
			next : { button  : "#next_1"},
		});
		
	});
	</script>';
	$multitask.=
	'<div class="featured_items_slider_2">
		<div class="featured_container_2 feat_box_'.$style.'" >
  		<ul id="carousel_1">';
			$featp = new WP_Query('post_type=post&post_status=publish&category_name=featured');
			if ($featp->have_posts()) : while ($featp->have_posts()) : $featp->the_post();
    	$multitask.= '<li class="container_hover_shine">
				<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_post_thumbnail($id,'thumbnail').'<div class="hover_shine"></div></a></li>';
			endwhile;endif; wp_reset_query();
	$multitask.='</ul>
            <a class="prev" id="prev_1" href="#"><span>prev</span></a>
			<a class="next" id="next_1" href="#"><span>next</span></a>
		</div>
    </div>';
	return $multitask;
}
add_shortcode('featured-posts', 'featured_posts');

/////////////////GALLERIES
function featured_galleries($atts, $content = null) {
	global $post, $wpdb, $wp_query, $query_string;
	extract( shortcode_atts( array(
	'number' => '5',
	'style' => '1'
	), $atts ) );

	$multitask = '
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#carousel_2").carouFredSel({
			items: {visible: '.$number.',	minimum: 1},
			scroll: { items: 1, pauseOnHover: true},
			auto: false,
			prev : { button: "#prev_2"},
			next : { button  : "#next_2"},
		});
		
		jQuery("a[rel=\'lightbox\']").colorbox();
		jQuery("#click").click(function(){ 
		return false;
	});
	});
	</script>';
	$multitask.=
	'<div class="featured_items_slider_2">
		<div class="featured_container_2 feat_box_'.$style.'" >
    		<ul id="carousel_2">';
				$results = get_terms('galleries');
				if ($results) {
					$featg = new WP_Query(array('post_type' => 'wtsgallery', 'posts_per_page' => 100));
					if ($featg->have_posts()) : while ($featg->have_posts()) : $featg->the_post();
					//
						$full_img = get_the_post_thumbnail($post->ID,'full');
						$find_ini = 'src="';
						$find_end = '"';
						$pos_1 = strpos($full_img, $find_ini)+5;
						$part_1 = substr($full_img, $pos_1);
						$pos_2 = strpos($part_1, $find_end);
						$full = substr($part_1, 0, $pos_2);
						//
          				$custom = get_post_custom($post->ID);
						$caption_img = $custom["caption_img"][0];
						$featured_item = $custom["featured_item"][0];
						if($featured_item=='on'){
	$multitask.= '<li class="container_hover_shine"><a href="'.$full.'" class="popup" title="'.$caption_img.'" rel="lightbox">'.get_the_post_thumbnail($id, array(150,150)).'<div class="hover_shine"></div></a></li>';
						}
					endwhile;endif;
				}
				wp_reset_query();
	$multitask.='</ul>
            <a class="prev" id="prev_2" href="#"><span>prev</span></a>
			<a class="next" id="next_2" href="#"><span>next</span></a>
		</div>
    </div>';
	return $multitask;
}
add_shortcode('featured-galleries', 'featured_galleries');

//PORTFOLIOS
function featured_portfolios($atts, $content = null) {
	global $post, $wpdb, $wp_query, $query_string;
	extract( shortcode_atts( array(
	'number' => '5',
	'style' => '1'
	), $atts ) );

	$multitask = '
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#carousel_3").carouFredSel({
			items: {visible: '.$number.',	minimum: 1},
			scroll: { items: 1, pauseOnHover: true},
			auto: false,
			prev : { button: "#prev_3"},
			next : { button  : "#next_3"},
		});
	});
	</script>';
	$multitask.=
	'<div class="featured_items_slider_2">
		<div class="featured_container_2 feat_box_'.$style.'">
    		<ul id="carousel_3">';
				$resultp = get_terms('portfolios');
				if ($resultp) {
					$featl = new WP_Query(array('post_type' => 'wtsportfolio', 'posts_per_page' => 100));
					if ($featl->have_posts()) : while ($featl->have_posts()) : $featl->the_post();
						$custom = get_post_custom($post->ID);
						$featured_item = $custom["featured_item"][0];
						if($featured_item=='on'){
	$multitask.= '<li class="container_hover_shine"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_post_thumbnail($id, array(150,150)).'<div class="hover_shine"></div></a></li>';
						}
					endwhile;endif;
				}
				wp_reset_query();
	$multitask.='</ul>
            	<a class="prev" id="prev_3" href="#"><span>prev</span></a>
				<a class="next" id="next_3" href="#"><span>next</span></a>
		</div>
    </div>';
	return $multitask;
}
add_shortcode('featured-portfolios', 'featured_portfolios');

//PRODUCTS
function featured_products($atts, $content = null) {
	global $post, $wpdb, $wp_query, $query_string;
	extract( shortcode_atts( array(
	'number' => '5',
	'style' => '1'
	), $atts ) );

	$multitask = '
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#carousel_4").carouFredSel({
			items: {visible: '.$number.',	minimum: 1},
			scroll: { items: 1, pauseOnHover: true},
			auto: false,
			prev : { button: "#prev_4"},
			next : { button  : "#next_4"},
		});
	});
	</script>';
	$multitask.=
	'<div class="featured_items_slider_2">
		<div class="featured_container_2 feat_box_'.$style.'">
    		<ul id="carousel_4">';
				$resultf = get_terms('catalogs');
				if ($resultf) {
   					$featr = new WP_Query(array('post_type' => 'wtsproduct', 'posts_per_page' => 100));
					if ($featr->have_posts()) : while ($featr->have_posts()) : $featr->the_post();
						$custom = get_post_custom($post->ID);
						$featured_item = $custom["featured_item"][0];
						if($featured_item=='on'){
	$multitask.= '<li class="container_hover_shine"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_post_thumbnail($id, array(150,150)).'<div class="hover_shine"></div></a></li>';
						}
					endwhile;endif;
				}
				wp_reset_query();
	$multitask.='</ul>
            	<a class="prev" id="prev_4" href="#"><span>prev</span></a>
				<a class="next" id="next_4" href="#"><span>next</span></a>
		</div>
    </div>';
	return $multitask;
}
add_shortcode('featured-products', 'featured_products');


//SERVICES
function featured_services($atts, $content = null) {
	global $post, $wpdb, $wp_query, $query_string;
	extract( shortcode_atts( array(
	'number' => '5',
	'style' => '1'
	), $atts ) );

	$multitask = '
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#carousel_5").carouFredSel({
			items: {visible: '.$number.',	minimum: 1},
			scroll: { items: 1, pauseOnHover: true},
			auto: false,
			prev : { button: "#prev_5"},
			next : { button  : "#next_5"},
		});
	});
	</script>';
	$multitask.=
	'<div class="featured_items_slider_2">
		<div class="featured_container_2 feat_box_'.$style.'">
    		<ul id="carousel_5">';
				$results = get_terms('brochures');
				if ($results) {
					$feats = new WP_Query(array('post_type' => 'wtsservice', 'posts_per_page' => 100));
					if ($feats->have_posts()) : while ($feats->have_posts()) : $feats->the_post();
						$custom = get_post_custom($post->ID);
						$featured_item = $custom["featured_item"][0];
						if($featured_item=='on'){
	$multitask.= '<li class="container_hover_shine"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_post_thumbnail($id, array(150,150)).'<div class="hover_shine"></div></a></li>';
						}
					endwhile;endif;
				}
				wp_reset_query();
	$multitask.='</ul>
            	<a class="prev" id="prev_5" href="#"><span>prev</span></a>
			<a class="next" id="next_5" href="#"><span>next</span></a>
		</div>
    </div>';
	return $multitask;
}
add_shortcode('featured-services', 'featured_services');

//Testimonials
function testimonials($atts, $content = null) {
	global $post, $wpdb, $wp_query, $query_string;
	extract( shortcode_atts( array(
	'number' => '3',
	'stylebox' => '1',
	'stylequote' => '1',
	'quotecolor' => 'gray'
	), $atts ) );

	$multitask = '
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#carousel_6").carouFredSel({
			items: {visible: '.$number.',	minimum: 1},
			scroll: { items: 1, pauseOnHover: true},
			auto: false,
			prev : { button: "#prev_6"},
			next : { button  : "#next_6"},
		});
	});
	</script>';
	$multitask.=
	'<div class="featured_items_slider_2">
		<div class="featured_container_2 feat_box_'.$stylebox.'">
    		<ul class="testimonial" id="carousel_6">';
				$featt = new WP_Query('post_type=wtstestimonial');
				if ($featt->have_posts()) : while ($featt->have_posts()) : $featt->the_post();
					$content = get_the_content();
					$content = apply_filters( 'the_content', $content );
					$content = str_replace( ']]>', ']]&gt;', $content );
					$portal=trim_the_content($content,'',null,18);
					$custom = get_post_custom($post->ID);
					$featured_item = $custom["featured_item"][0];
					$testimonial_by = $custom["testimonial_by"][0];
					if($featured_item=='on'){
    $multitask.= '	<li id="testimonials">
						<img src="'.get_bloginfo('template_url').'/img/quotes/quote_'.$quotecolor.'_'.$stylequote.'.png" align="left"/>
						<h3>'.$portal.'</h3>
						<span><h3>By '.$testimonial_by.'</h3></span>
					</li>';
					}endwhile;endif; wp_reset_query();
	$multitask.='</ul>
            	<a class="prev" id="prev_6" href="#"><span>prev</span></a>
				<a class="next" id="next_6" href="#"><span>next</span></a>
		</div>
    </div>';
	return $multitask;
}
add_shortcode('testimonials', 'testimonials');

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function featured_wtg( $atts, $content = null ){
	global $wpdb,$post;
    extract( shortcode_atts( array(
      'type' => 'product',
	  'columns'=>"3",
	  'excerpt'=>"true",
	  'fontsize'=>"12"
      ), $atts ) );
	$options['post_type']='wts'.$type;
	$options['posts_per_page']=-1;
//	$options['numberposts']=999;
//	$get_posts = new WP_Query($options);
//	var_dump($get_posts);
	$html='<ul class="thumbnails" data-columns="'.$columns.'" data-ftsize="'.$fontsize.'">';	
	$get_posts = new WP_Query($options);
	if ($get_posts->have_posts()) : while ($get_posts->have_posts()) : $get_posts->the_post();
			$textinfo=($excerpt==='true')?get_the_excerpt():get_the_content;
			switch ($type){
			case 'gallery':
			case 'portfolio':
			case 'product':
			case 'service':
			$html.='	<li class="span3"><div class="thumbnail">'.get_the_post_thumbnail($post->ID).'<div class="caption"><h5>'.get_the_title().'</h5><p>'.$textinfo.'</p><a class="btn" href="'.get_permalink().'">Info</a></div></div></li>';			
			break;
			case 'testimonial':
			$html.='	<li class="span3"><div class="thumbnail"><h5>'.get_the_title().'</h5><p>'.$textinfo.'</p><a class="btn" href="'.get_permalink().'">Info</a></div></li>';			
			break;
		}

	endwhile;endif; wp_reset_query();	
	$html.='</ul>';
	return $html;
}
add_shortcode('featured', 'featured_wtg');

/*******************************/
/* Custom Post Type - Gallery */
/*****************************/
function getPostTypeGallery($atts, $content = null) {
	global $post, $wpdb;
	 extract( shortcode_atts( array(
		'taxonomy' => '',
		'wptg_post_type' => 'gallery',
	  'style'=>"shadow"
    ), $atts ) );

	$multitask = '<style>@import url('.get_template_directory_uri().'/css/taxonomies-extended.css);</style>';
	if($wptg_post_type=='gallery'){
	$multitask .= '<script>
		jQuery(document).ready(function(){
			jQuery(".taxonomy_item a.popup").colorbox();
		});
		</script>
		';
	}

	if($taxonomy == ''){
		$multitask .= '<script>
		jQuery(document).ready(function(){
      jQuery(\'#filters a\').click(function(){
        var selector = jQuery(this).attr(\'data-filter\');
        jQuery(\'.taxonomy_filter\').isotope({ filter: selector });
				jQuery(\'.taxonomy_item a.popup\').attr(\'rel\', \'all_items\');
				jQuery(\'.taxonomy_item.isotope-hidden a.popup\').attr(\'rel\', \'\');
        return false;
      });
      jQuery(\'#options\').find(\'.info_filters a\').click(function(){
        var $this = jQuery(this);
        if ( !$this.hasClass(\'sel_item\') ) {
          $this.parents(\'.info_filters\').find(\'.sel_item\').removeClass(\'sel_item\');	
          $this.addClass(\'sel_item\');
        }
      });
      jQuery(document).ready(function(e) {
        jQuery(\'.taxonomy_filter\').isotope({
          itemSelector : \'.taxonomy_item\'
        });
      });
		});
    </script>';
	}
	
	switch($wptg_post_type){
		case 'gallery':
			$taxo = 'galleries'; $post_type = 'wtsgallery';
		break;
		case 'services':
			$taxo = 'brochures'; $post_type = 'wtsservice';
		break;
		case 'portfolio':
			$taxo = 'portfolios';	$post_type = 'wtsportfolio';
		break;
	}
	
	$results = get_terms($taxo);
	ob_start();
	if($taxonomy == ''){?>
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
  <?php }?>
  <div class="taxonomy_filter">
	<?php
   if ($results) {

		query_posts(array('post_type'=>$post_type, $taxo=>$taxonomy, 'showposts' => -1));
    if (have_posts()): while ( have_posts() ): the_post();{
		$term_slugs = wp_get_post_terms($post->ID, $taxo, array("fields" => "slugs"));
		$cats = implode(" ", $term_slugs);
		
		switch($wptg_post_type){
			case 'gallery':
				$linkAttr = array('href'=> 'global', 'class'=> 'class="popup"', 'rel'=>'rel="all_items"');
			break;
			case 'services':
			case 'portfolio':
				$linkAttr = array('href'=> get_permalink( $id ), 'class'=> '', 'rel'=>'');
			break;
		}?>
    <div class="taxonomy_item <?php echo $cats?>">
      <h2><?php the_title();?></h2>
        <?php	postype_options($post->ID);?>
        <div class='container_img_gallery boxcss_<?php echo ($style==0)?'shadow':$style;?>'>
          <div class='container_hover_shine'>
            <a href="<?php echo($linkAttr['href']!=='global')?$linkAttr['href']:$GLOBALS['post_type_options']['full'];?>" <?php echo $linkAttr['class']?> title="<?php echo $GLOBALS['post_type_options']['caption_img'];?>" <?php echo $linkAttr['rel']?>><?php the_post_thumbnail();?>
            	<div class="hover_shine"></div>
            </a><!-- end middle center -->
          </div><!-- end middle center -->
        </div><!-- end container_img_gallery -->
      </div><!-- end taxonomy_item -->
      
		<?php } endwhile; endif; wp_reset_query();}
		$multitask .= '<div class="getPostTypeGallery">'.ob_get_clean();
		$multitask .= '</div><!-- end taxonomy_filter -->';
		$multitask .= '<div class="clear"></div></div><!-- end getPostTypeGallery container -->';
	return $multitask;
}
add_shortcode('wptg-cpt', 'getPostTypeGallery');


add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');


/**
 * Copyright (c) 2011 Host Like Toast <helpdesk@hostliketoast.com>
 * All rights reserved.
 * 
 * "Wordpress Bootstrap CSS" is distributed under the GNU General Public License, Version 2,
 * June 1991. Copyright (C) 1989, 1991 Free Software Foundation, Inc., 51 Franklin
 * St, Fifth Floor, Boston, MA 02110, USA
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */


class HLT_BootstrapShortcodes {
	
protected $sTwitterBootstrapVersion;

	public function __construct( $sVersion = '2' ) {
		$aMethods = get_class_methods( $this );
		$aExclude = array( 'idHtml', 'def', 'noEmptyHtml' );
		foreach ( $aMethods as $sMethod ) {
			if ( !in_array( $sMethod, $aExclude ) ) {
				add_shortcode( 'TBS_'.strtoupper( $sMethod ), array( $this, $sMethod ) );
			}
		}
		
		$this->sTwitterBootstrapVersion = $sVersion;

		add_filter( 'the_content', array( $this, 'filterTheContent' ), 10 );		
		add_filter( 'the_content', array( $this, 'filterTheContentToFixNamedAnchors' ), 99 );
		
		/**
		 * Move the wpautop until after the shortcodes have been run!
		 * remove_filter( 'the_content', 'wpautop' );
		 * add_filter( 'the_content', 'wpautop' , 99 );
		 * add_filter( 'the_content', 'shortcode_unautop', 100 );
		 */
		
		/**
		 * Disable wpautop globally!
		 * remove_filter( 'the_content',  'wpautop' );
		 * remove_filter( 'comment_text', 'wpautop' );
		 */
	}
	
	/**
	 * Prints the necessary HTML for Twitter Bootstrap Labels
	 * 
	 * Class may be one of: Default Primary Info Success Danger
	 * 
	 * @param $inaAtts
	 * @param $insContent
	 */
	public function button( $inaAtts = array(), $insContent = '' ) {
		
		$sElementType = 'a';  
		if ( !isset( $inaAtts['link'] ) ) {
			$sElementType = 'button';
		}

		$this->def( $inaAtts, 'id' );
		$this->def( $inaAtts, 'class', '' );
		$this->def( $inaAtts, 'style' );
		$this->def( $inaAtts, 'link_title' );
		$this->def( $inaAtts, 'value', '0' );
		
		if ( $this->sTwitterBootstrapVersion == '2' && !preg_match( '/^btn-/', $inaAtts['class'] ) ) {
			$inaAtts['class'] = 'btn-'.$inaAtts['class'];
		}

		$sReturn = '<'.$sElementType.' '.$this->noEmptyHtml( $inaAtts['style'], 'style' ).' class="btn '.$inaAtts['class']. '"'.$this->idHtml( $inaAtts['id'] );

		if ( $sElementType == 'a' ) {
			$sReturn .= ' href="'.$inaAtts['link'].'" title="' .$inaAtts['link_title']. '"';
		}
		else {
			$sReturn .= ' type="button" value="'.$inaAtts['value']. '"';
		}
		
		$sReturn .= '>'.$this->doShortcode( $insContent ).'</'.$sElementType.'>';
		
		return $sReturn;
	}


	
	/**
	 * Prints the necessary HTML for Twitter Bootstrap Labels
	 * 
	 * class may be one of: default, success, warning, important, notice
	 * 
	 * @param $inaAtts
	 * @param $insContent
	 */
	public function label( $inaAtts = array(), $insContent = '' ) {

		$this->def( $inaAtts, 'style' );
		$this->def( $inaAtts, 'id' );
		$this->def( $inaAtts, 'class' );
		
		if ( $this->sTwitterBootstrapVersion == '2' && !preg_match( '/^label-/', $inaAtts['class'] ) ) {
			$inaAtts['class'] = 'label-'.$inaAtts['class'];
		}

		$sReturn = '<span '.$this->noEmptyHtml( $inaAtts['style'], 'style' ).' class="label '.$inaAtts['class'].'"'.$this->idHtml( $inaAtts['id'] ).'>'.$this->doShortcode( $insContent ).'</span>';

		return $sReturn;
	}

	public function blockquote( $inaAtts = array(), $insContent = '' ) {

		$this->def( $inaAtts, 'style' );
		$this->def( $inaAtts, 'id' );
		$this->def( $inaAtts, 'class' );
		$this->def( $inaAtts, 'source' );
		
		if ($inaAtts['source'] != '') {
			$inaAtts['source'] = '<small>'.$inaAtts['source'].'</small>';
		}
	
		$sReturn = '<blockquote '.$this->noEmptyHtml( $inaAtts['style'], 'style' ).' '.$this->noEmptyHtml( $inaAtts['class'], 'class' ).' '.$this->idHtml( $inaAtts['id'] ).'><p>'.$this->doShortcode( $insContent ).'</p>'.$inaAtts['source'].'</blockquote>';
		
		return $sReturn;
	}

	/**
	 * class may be one of: error, warning, success, info
	 * 
	 * @param $inaAtts
	 * @param $insContent
	 */
	public function alert( $inaAtts = array(), $insContent = '' ) {

		$this->def( $inaAtts, 'style' );
		$this->def( $inaAtts, 'id' );
		$this->def( $inaAtts, 'class' );
		$this->def( $inaAtts, 'type', 'alert' );
		
		//Twitter 1.4.0 only supports this one variation
		if ( $this->sTwitterBootstrapVersion == '1' ) {
			$inaAtts['type'] ='alert-message';
		}
	
		if ( $this->sTwitterBootstrapVersion == '2' && !preg_match( '/^alert-/', $inaAtts['class'] ) ) {
			$inaAtts['class'] = 'alert-'.$inaAtts['class'];
		}
	
		$sReturn = '<div '.$this->noEmptyHtml( $inaAtts['style'], 'style' )
					.' class="'.$inaAtts['type'].' '.$inaAtts['class'].'" '
					.$this->noEmptyHtml( $inaAtts['id'], 'id' ).'>'.$this->doShortcode($insContent).'</div>';
		
		return  $sReturn ;
	}

	/**
	 * DEPRECATED: To BE EVENTUALLY REMOVED AS UNSUPPORTED IN Twitter Bootstrap 2+
	 * 
	 * Uses alert() function but just adds the class "block-message"
	 * 
	 * class may be one of: error, warning, success, info
	 * 
	 * @param $inaAtts
	 * @param $insContent
	 */
	public function block( $inaAtts = array(), $insContent = '' ) {

		$this->def( $inaAtts, 'style' );
		$this->def( $inaAtts, 'id' );
		$this->def( $inaAtts, 'class' );
		
		return $this->doShortcode( '[TBS_ALERT '.'class="block-message '
									.$inaAtts['class'].'" '
									.$this->noEmptyHtml( $inaAtts['id'], 'id' ).' '
									.$this->noEmptyHtml( $inaAtts['style'], 'style' ).']'.$insContent.'[/TBS_ALERT]' );
	}
	
	public function code( $inaAtts = array(), $insContent = '' ) {
		
		$this->def( $inaAtts, 'style' );
		$this->def( $inaAtts, 'id' );

		$sReturn = '<pre class="prettyprint linenums" '.$this->idHtml( $inaAtts['id'] ).' '.$this->noEmptyHtml( $inaAtts['style'], 'style' ).'>'.$insContent.'</pre>';

		return $sReturn;
	}

	/**
	 * DEPRECATED: To BE EVENTUALLY REMOVED AS UNSUPPORTED IN Twitter Bootstrap 2+
	 * 
	 * Options for 'placement' are above | below | left | right
	 * 
	 * @param $inaAtts
	 * @param $insContent
	 */
	public function twipsy( $inaAtts = array(), $insContent = '' ) {

		return $this->tooltip($inaAtts, $insContent);
	}

	/**
	 * Options for 'placement' are top | bottom | left | right
	 */
	public function tooltip( $inaAtts = array(), $insContent = '' ) {

		$this->def( $inaAtts, 'style' );
		$this->def( $inaAtts, 'id' );
		$this->def( $inaAtts, 'class' );
		$this->def( $inaAtts, 'placement', 'top' );
		$this->def( $inaAtts, 'title' );
		$this->def( $inaAtts, 'rel', 'tooltip' ); //could set to 'twipsy' for bootstrap 1.4.0
	
		//backward comnpatibility with Twitter Bootstrap v1.0
		if ( $this->sTwitterBootstrapVersion == '1' ) {
			$inaAtts['rel'] = 'twipsy';
			if ( $inaAtts['placement'] == 'top' ) {
				$inaAtts['placement'] = 'above';
			}
			if ( $inaAtts['placement'] == 'bottom' ) {
				$inaAtts['placement'] = 'below';
			}
		} else { //Twitter Bootstrap v2.0 changed position names
			if ( $inaAtts['placement'] == 'above' ) {
				$inaAtts['placement'] = 'top';
			}
			if ( $inaAtts['placement'] == 'below' ) {
				$inaAtts['placement'] = 'bottom';
			}
		}

		$sReturn = $insContent;
		if ( $inaAtts['title'] != '' ) {
			$sReturn = '<span'
					.' rel="'.$inaAtts['rel'].'" data-placement="'.$inaAtts['placement'].'" data-original-title="'.$inaAtts['title'].'"'
					.$this->noEmptyHtml( $inaAtts['id'], 'id' )
					.$this->noEmptyHtml( $inaAtts['class'], 'class' )
					.$this->noEmptyHtml( $inaAtts['style'], 'style' ).'>'.$this->doShortcode($insContent).'</span>';
		}
		
		return $sReturn;
	}

	/**
	 * Options for 'placement' are top | bottom | left | right
	 */
	public function popover( $inaAtts = array(), $insContent = '' ) {

		$this->def( $inaAtts, 'style' );
		$this->def( $inaAtts, 'id' );
		$this->def( $inaAtts, 'class' );
		$this->def( $inaAtts, 'placement', 'right' );
		$this->def( $inaAtts, 'title' );
		$this->def( $inaAtts, 'content' );

		$sReturn = '<span'
					.' rel="popover" data-placement="'.$inaAtts['placement'].'" title="'.$inaAtts['title'].'"'
					.' data-content="'.$inaAtts['content'].'"'
					.$this->noEmptyHtml( $inaAtts['id'], 'id' )
					.$this->noEmptyHtml( $inaAtts['class'], 'class' )
					.$this->noEmptyHtml( $inaAtts['style'], 'style' ).'>'.$this->doShortcode( $insContent ).'</span>';

		return $sReturn;
	}
	
	public function dropdown( $inaAtts = array(), $insContent = '' ) {
		$this->def( $inaAtts, 'name', 'Undefined' );
		
		$insContent = '
			<ul class="tabs">
				<li class="dropdown" data-dropdown="dropdown">
					<a class="dropdown-toggle" href="#">'.$inaAtts['name'].'</a>
					<ul class="dropdown-menu">
						'.$insContent.'
					</ul>
				</li>
			</ul>
		';

		return $this->doShortcode( $insContent );
	}
	
	/**
	 * This is used by both dropdown and tabgroup/tab
	 */
	public function dropdown_option( $inaAtts = array(), $insContent = '' ) {
		$this->def( $inaAtts, 'name', 'Undefined' );
		$this->def( $inaAtts, 'link', '#' );
		
		$insContent = '<li><a href="'.$inaAtts['link'].'">'.$inaAtts['name'].'</a></li>';
		
		return $this->doShortcode( $insContent );
	}

	public function tabgroup( $inaAtts = array(), $insContent ) {
		
		$aTabs = array();
		$aMatches = array();
		$nOffsetAdjustment = 0;
		$i = 0;
		
		/**
		 * Because there are 2 separate sections of HTML for the tabs to work, we need to
		 * look for the TBS_TAB shortcodes now, to create the buttons. The $insContent is
		 * passed onwards and will be used to create the tab content panes.
		 * 
		 * PREG_OFFSET_CAPTURE requires PHP 4.3.0
		 */
		if ( preg_match_all( '/\[TBS_TAB([^\]]*)\]/', $insContent, $aMatches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE ) ) {
			foreach ( $aMatches as $aMatch ) {
				//aMatch = Array ( [0] => Array ( [0] => [TBS_TAB page_id="53" name="test1"] [1] => 1 ) [1] => Array ( [0] => page_id="53" name="test1" [1] => 9 ) )
				 
				if ( !isset( $aMatch[1] ) ) {
					continue;
				}
				
				$sName = "Undefined";
				if ( preg_match( '/name\s*=\s*("|\')(.+)\g{-2}+/i', $aMatch[1][0], $aSubMatches ) ) {
					$sName = $aSubMatches[2];
				}
				
				$sType = "page";
				if ( preg_match( '/type\s*=\s*("|\')(page|dropdown)\g{-2}+/i', $aMatch[1][0], $aSubMatches ) ) {
					$sType = $aSubMatches[2];
				}
				
				if ( $sType == "page" ) {
					$aTabs[] = '<li class="'.($i == 0? 'active': '').'"><a href="#TbsTabId'.$i.'">'.$sName.'</a></li>';
				}
				else {
					/**
					 * Handle the dropdowns as the tab() shortcode handles the tab contents only
					 */
					$nOffsetTemp = $aMatch[0][1] + $nOffsetAdjustment;
					
					$sRemainder = substr( $insContent, $nOffsetTemp + strlen( $aMatch[0][0] ) );					
					$nPos = strpos( $sRemainder, '[/TBS_TAB]' );
					$sRemainder = substr( $sRemainder, 0, $nPos );
										
					// match all dropdowns until [/TBS_TAB]
					if ( !preg_match_all( '/\[TBS_DROPDOWN_OPTION([^\]]*)\]/', $sRemainder, $aSubMatches, PREG_SET_ORDER ) ) {
						continue;
					}
					
					$aOptions = array();
					foreach ( $aSubMatches as $aSubMatch ) {
						$sLink = '#';
						if ( preg_match( '/link\s*=\s*("|\')(.*)\g{-2}+/i', $aSubMatch[1][0], $aSubMatches ) ) {
							$sLink = $aSubMatches[2];
						}
						
						$sName = 'Undefined';
						if ( preg_match( '/name\s*=\s*("|\')(.*)\g{-2}+/i', $aSubMatch[1][0], $aSubMatches ) ) {
							$sName = $aSubMatches[2];
						}
						
						$aOptions[] = '<li><a href="'.$sLink.'">'.$sName.'</a></li>';
					}
					
					$aTabs[] = '
						<li class="dropdown" data-dropdown="dropdown">
							<a class="dropdown-toggle" href=" #">'.$sName.'</a>
							<ul class="dropdown-menu">
								'.implode( '', $aOptions ).'
							</ul>
						</li>
					';
				}
				
				$nOffset = $aMatch[0][1] + $nOffsetAdjustment;
				$nLength = strlen( $aMatch[0][0] );
				$sAddition = ' id="TbsTabId'.$i.'"';
				$insContent = substr_replace( $insContent, '[TBS_TAB'.($aMatch[1][0]).$sAddition.']', $nOffset, $nLength );
				
				$nOffsetAdjustment += strlen( $sAddition );
				
				$i++;
			}
		}
		
		$insContent = '
			<ul class="tabs" data-tabs="tabs">
				'.implode( "\n", $aTabs ).'
			</ul>
			<div id="my-tab-content" class="tab-content">
				'.$insContent.'
			</div>
		';
		
		return $this->doShortcode( $insContent );
	}
	
	/**
	 * Reference: http://codex.wordpress.org/Function_Reference/get_page
	 */
	public function tab( $inaAtts = array(), $insContent = '' ) {
		$this->def( $inaAtts, 'page_id', 0 );
		$this->def( $inaAtts, 'type', 'page' ); // can be either page or dropdown
		
		// If this value is never not set, then the tabgroup method didn't do it's job!
		$this->def( $inaAtts, 'id', 'TbsTabId_' );
		
		// Actually not used as the tab name is used by the TabGroup
		$this->def( $inaAtts, 'name', 'Undefined' );
		
		if ( $inaAtts['page_id'] > 0 ) {
			$oPage = get_page( $inaAtts['page_id'] );
			if ( !is_null( $oPage ) ) {
				$insContent = $oPage->post_content;
			}
		}
		
		$nIndex = intval( str_replace( 'TbsTabId', '', $inaAtts['id'] ) );
		
		$insContent = '<div id="'.$inaAtts['id'].'" class="tab-pane'.($nIndex == 0?' active':'').'">'.$insContent.'</div>';
		
		return $this->doShortcode( $insContent );
	}
	
	public function row( $inaAtts = array(), $insContent = '' ) {
	
		$sReturn = '<div class="container">	<div class="row">';
		$sReturn .= $this->doShortcode( $insContent );
		$sReturn .= '</div></div>';
		
		return $sReturn;
	}//row
	
	public function column( $inaAtts = array(), $insContent = '' ) {

		$this->def( $inaAtts, 'size', 1 );
		$this->def( $inaAtts, 'style' );
		$this->def( $inaAtts, 'id' );
		$this->def( $inaAtts, 'class' );
		
		$sReturn = '<div class="span'.$inaAtts['size'].' '.$inaAtts['class']. '"'
					.$this->noEmptyHtml( $inaAtts['id'], 'id' )
					.$this->noEmptyHtml( $inaAtts['style'], 'style' ).'>';
		$sReturn .= $this->doShortcode( $insContent );
		$sReturn .= '</div>';
		
		return $sReturn;
	}//row

	/**
	 * Public, but should never be directly accessed other than by the WP add_filter method. 
	 * @param $insContent
	 */
	public function filterTheContent( $insContent = "" ) {		
		// Remove <p>'s that get added to [TBS...] by wpautop.
		$insContent = preg_replace( '|(<p>\s*)?(\[/?TBS[^\]]+\])(\s*</p>)?|', "$2", $insContent );
		
		return $insContent;
	}
	
	public function filterTheContentToFixNamedAnchors( $insContent = "" ) {		
		$sPattern = '/(<a\s+href=")(.*)(#TbsTabId[0-9]+">(.*)<\/a>)/';
		$insContent = preg_replace( $sPattern, '$1$3', $insContent );
		
		return $insContent;
	}
	
	/**
	 * name collision on "default"
	 */
	protected function def( $aSrc, $insKey, $insValue = '' ) {
		if ( !isset( $aSrc[$insKey] ) ) {
			$aSrc[$insKey] = $insValue;
		}
	}

	protected function idHtml( $insId ) {
		return (($insId != '')? ' id="'.$insId.'" ' : '' );	
	}
	protected function noEmptyHtml( $insContent, $insAttr ) {
		return (($insContent != '')? ' '.$insAttr.'="'.$insContent.'" ' : '' );	
	}
	
	/**
	 * Only implemented for possible future customisation
	 * @param unknown_type $insContent
	 */
	protected function doShortcode( $insContent ) {
		return do_shortcode( $insContent );
	}
	
}

$oShortCodes = new HLT_BootstrapShortcodes('2');
//var_dump($oShortCodes);

?>
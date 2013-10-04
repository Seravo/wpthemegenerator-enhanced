<?php function get_slider_html($silder_name){//ison
	$ea_autostart=(get_option("themeshock_ea_autoplay")==='yes')? 'true' : 'false';// get variables for Easy accordion settings
	$ea_number = "false";
	$nivo_autoplay=	$nivo_autoplay=(get_option("themeshock_slider_autoplay")==='yes')? 'true' : 'false';// get variables for Nivo settings
/*	$upload_dir=wp_upload_dir();	
	$path_slider=$upload_dir['baseurl'].'/slider/'; //path for slider modo server*/
	$easy_acordion_base_img= 900;
	$img_slider_pack= $GLOBALS['slider_img_info'];// obtiene un array de las imagenes del slider
	$imgs_count=0; //obtiene la cantidad de imagenes del slider
	if( !function_exists( "bcdiv" ) ){
		function bcdiv( $first, $second, $scale = 0 ){
			 $res = $first / $second;
			 return round( $res, $scale );
		}
	}
	$li_distribution=@bcdiv($easy_acordion_base_img,$imgs_count)-1; // obtiene el area de presentacion del li  de cada slider
	
	foreach( $img_slider_pack as $image ){
		//$path_slider=dirname($image['url']).'/';
		//var_dump($path_slider);
		if ($image['active']){		
			$img_coinSlider.='<a href="'.$image['link'].'"><img src="'.$image['url'].'"  alt="" width="900" height="346" /></a>';// obtiene las imagenes del coinslider
			$img_bootstrap.='<div class="item '.($imgs_count == 1?"active":"").'"><a href="'.$image['link'].'"><img src="'.$image['url'].'"  alt="" width="100%"  /></a></div>';
			
			$img_Easy_Accordion.='<li><a href="'.$image['link'].'"><img src="'.$image['url'].'"  height="346"   alt="" /></a></li>';
			
			/*$img_Piecemaker.=' 
			<Image Filename="'.basename($image['url']).'">
				<Text>
					<headline>Description Text</headline>
					<break>?</break>
					<paragraph>Here you can add a description text for every single image.</paragraph>
					<break>?</break>
					<inline>This is HTML text loaded from the external XML file and formatted with an external CSS file. So its pretty simple to set this text. You can also easily add</inline>
					<a HREF="http://www.modularweb.net/piecemaker" TARGET="_blank">?hyperlinks</a>
					<paragraph>. This one leads you to the official Piecemaker website, by the way.</paragraph>
				</Text>
			</Image>
			';*/
			// obtiene las imagenes del piecemaker
			$imgs_count++;
		}
	}
	
	$li_distribution=@bcdiv($easy_acordion_base_img,$imgs_count)-1; // obtiene el area de presentacion del li  de cada slider
	$max_width_dist=$easy_acordion_base_img-($imgs_count*45); //obtiene el ancho del img area view
	
	//update_option('themeshock_img_slider',$img_Piecemaker);//guarda las configuraciones del piecemaker

	
	switch($silder_name){
		case 'Featured-Slider':
		case 'featured-poster':		
			$slid_mar= slidr_markup();
			return $slid_mar;
		break;
		case 'cubeH':
		case 'cubeV':
		case 'fade':
		case 'random':
		case 'random-top':
		case 'random-relative':
		case 'random-medium':
		case 'sliceH':
		case 'sliceV':
		case 'slideH':
		case 'slideV':
		case 'scale':
		case 'blockScale':
		case 'kaleidoscope':
		case 'fan': 
		case 'blindH':
		case 'blindV':
			$slid_mar=slidr_markup($GLOBALS['slider_img_info']);
			return $slid_mar;
		break;
	}
//	$html_bootstrap = '<div class="item '.($imgs_count == 1?"active":"").'">'.$html.'</div>';// obtiene las imagenes del coinslider
	function slider_bootstrap($content_slider){
		return '
		<div id="wptg_Carousel" class="carousel wtsCarousel slide">
			<!-- Carousel items -->
			<div class="carousel-inner">
				'.$content_slider.'
			</div><!-- Carousel nav -->
			<a class="carousel-control left rs-prev goto-slide ts-arrow-1 ts-arrow-1-left nivo-prevNav" href="#wptg_Carousel" data-rs="prev" data-slide="prev" id="prev"></a>
			<a class="carousel-control right rs-next goto-slide ts-arrow-1 ts-arrow-1-right nivo-nextNav" href="#wptg_Carousel" data-rs="next" data-slide="next" id="next"></a>
		</div>';
	}
	$slider_bootstrap = array('slider_boot');
	$slider_htmlpack = array('Featured-Slider'=>$html,
	"Nivo-Slider" =>
	'<script type="text/javascript" data-tgdelst="live">
	jQuery(document).ready(function() {
		jQuery(\'#slider\').nivoSlider({
			effect: \''.get_option('themeshock_slider_fx','random').'\',
			slices: 15,
			boxCols: 8,
			boxRows: 4,
			animSpeed: '.get_option('themeshock_anim_speed',500).',
			pauseTime: 3000,
			startSlide: 0,
			directionNav: true,
			directionNavHide: false,
			controlNav: false,
			controlNavThumbs: false,
			controlNavThumbsFromRel: false,
			controlNavThumbsSearch: \'.jpg\',
			controlNavThumbsReplace: \'_thumb.jpg\',
			keyboardNav: false,
			pauseOnHover: true,
			manualAdvance: true,
			captionOpacity: 0.8,
			prevText: \'\',
			nextText: \'\',
			randomStart: false,
			beforeChange: function(){},
			afterChange: function(){},
			slideshowEnd: function(){},
			lastSlide: function(){},
			afterLoad: function(){}
		});
		if(typeof(sessvars) != \'undefined\'){
	if(sessvars[\'.nivo-prevNav\']?sessvars[\'.nivo-prevNav\']:\'null\' != \'null\' || sessvars[\'.nivo-nextNav\']?sessvars[\'.nivo-nextNav\']:\'null\' != \'null\' || sessvars[\'.nivo-directionNav a\']?sessvars[\'.nivo-directionNav a\']:\'null\' != \'null\'){
			if(sessvars[\'.nivo-prevNav\'] == \'none\' || sessvars[\'.nivo-directionNav a\'] == \'none\'){
				//alert(\'other\');
				//jQuery(\'.nivo-directionNav a\').css({\'background-image\': sessvars[\'arrow_pos_abs_bkg\'], \'width\':sessvars[\'arrow_pos_abs_width\'], \'height\':sessvars[\'arrow_pos_abs_height\']});
				//jQuery(\'.nivo-directionNav a\').css(\'top\', sessvars[\'arrow_pos_abs_top\']);
				//jQuery(\'.nivo-nextNav\').css({\'right\': sessvars[\'arrow_pos_abs_sides\']});
				//jQuery(\'.nivo-prevNav\').css(\'left\', sessvars[\'arrow_pos_abs_sides\']);
				jQuery(\'.print, .nivo-directionNav a\').css(\'background-color\', \'red\');
			}else{
				//alert(\'none\');
				jQuery(\'.nivo-nextNav\').attr(\'style\', sessvars[\'.nivo-nextNav\']);
				jQuery(\'.nivo-prevNav\').attr(\'style\', sessvars[\'.nivo-prevNav\']);
				jQuery(\'.nivo-directionNav a\').attr(\'style\', sessvars[\'.nivo-directionNav a\']);
			}
		}
	}
	});
	
	</script>
    <div id="slider" class="nivoSlider">	
		'.$img_coinSlider.'
	</div>
	'.slider_bootstrap($img_bootstrap).'
	',
	/*Accordion slider/*/
	"Easy-Accordion"=>
	' <script type="text/javascript"  data-tgdelst="live">
			jQuery(document).ready(function() {
				jQuery("#accordion-slider").kwicks({
					max : '.$max_width_dist.',
					spacing : 1
				});
			});
	  </script>
	<style data-tgdelst="live">
		ul#accordion-slider li{
			width:'.$li_distribution.'px;
		}
	</style>
	<ul id="accordion-slider">
		'.$img_Easy_Accordion.'
	</ul>
	'.slider_bootstrap($img_bootstrap).'
	',
	/*Piecemaker slider/*/
	"Piecemaker"=>
	'<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/swfobject.js" data-tgdelst="live"></script>
	<div class="piecemaker">
		<div id="flashcontent">
			<p>You need to <a href="http://www.adobe.com/products/flashplayer/" target="_blank">upgrade your Flash Player</a> to version 10 or newer.</p>
		</div><!-- end flashcontent -->
		<script type="text/javascript" data-tgdelst="live">
			var flashvars = {};
			flashvars.xmlSource = "'.$GLOBALS['path_xml_pm'].'";
			flashvars.cssSource = "'.get_bloginfo('template_url').'/css/sliders.css";
			flashvars.imageSource = "'.$GLOBALS['path_slider'].'";
			var attributes = {};
			attributes.wmode = "transparent";
			swfobject.embedSWF("'.get_bloginfo('template_url').'/asset/swf/piecemakerNoShadow.swf","flashcontent", "1100", "510", "10", "'.get_bloginfo('template_url').'/js/expressInstall.swf", flashvars, attributes);
		</script>
	</div><!-- end piecemaker -->
	'.slider_bootstrap($img_bootstrap).'');

	foreach ($slider_htmlpack as $slider => $slider_final){
		if ($silder_name===$slider && $imgs_count>0){
			return $slider_final;
			break;
		}
	}
}
?>
<?php
function get_thumbs_slider($thimgs,$direction='none'){
	if ($direction=='none'){
		return '';
	}

	if (count($thimgs)>1):
$thumbs='<section class="thumbnails t-'.$direction.'" data-pos="'.$direction.'" >
		<ul class="controls">';
			foreach ($thimgs as $index =>$img):
					$posm=($index==0)?$index:$index;
			
			$thumbs.='<li class="mini_thumb" data-target="#tgcarousel_container" data-slideindex="'.$posm.'" data-to="'.$index.'" data-slide-to="'.$posm.'">
					'.$img.'
				</li>';
			endforeach;
		$thumbs.='</ul>
	</section>';
	return $thumbs;
	endif;
}
?>
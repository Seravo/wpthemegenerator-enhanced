<?php //include (TEMPLATEPATH.'/functions/sliders_selector.php');
if(($GLOBALS['slider_type']) != 'No-Slider'){?>
<div class="wrapper_slider">
<!-- layout slider -->
  	<div class="lay_base slider_pattern"></div>
  	<div class="lay_base slider_shadow"></div>
  	<div class="bar_separate content_separate"></div>
  	<style>
		<?php 
				if ($GLOBALS['slider_type']!='random-top'):	
		?>
			.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow{
				display:block;
			}

		<?php
			endif;	
			switch($GLOBALS['slider_type']){
				case 'Nivo-Slider':
				case 'Easy-Accordion':
				case 'Piecemaker':
				break;
				default:
					if($GLOBALS['feat_style']=='tg-border-default'){

					}else{
						/*height in responsive mode*/
						$height_slider = $GLOBALS['height_slider'];
						/*width for the slider*/
						$width_slider = $GLOBALS['width_slider'];
						//responsive slider
						$res_slider = $GLOBALS['is_res_sldr'];
					}
					
					/*wts slider show*/?>
					div.wtsCarousel {
						display: block;
					}
					<?php
					/*responsively actions*/
					if($res_slider=='yes'){?>
						.slider_area{
							height:<?php echo $height_slider;?>px ;
							width:<?php echo ($height_slider+($height_slider/0.7));?>px ;/* !important46.35%*/
						}
					<?php
					}else{ ?>
						.slider_area{
							height:<?php echo $height_slider; ?>px ;
							width: <?php echo $width_slider; ?> ;
							/*padding-bottom: 20px;*/
						}
					<?php 
					}	
				break;
			}
		?>
  	</style>
	<!-- end layout slider -->
	<?php 
	?>
	<div class="slider_area <?php echo $GLOBALS['feat_style']; ?>" <?php echo $sht; ?> >
	<?php	
		$option_js=is_array($GLOBALS['slider_pack'])?$GLOBALS['slider_pack']:json_decode(stripcslashes($GLOBALS['slider_pack']),true);

		include ( TEMPLATEPATH.'/functions/sliders_selector.php' );
		$img=($GLOBALS['slider_type']=='Featured-Slider')?'none':'img';
		$slidercontent="<div class='slider_content' slider='".$img."'>".get_slider_html($GLOBALS['slider_type'])."</div><!-- end slider content -->";//pinta markup del slider
//		var_dump(empty($option_js['tPosition']) , $GLOBALS['feat_style']=='default' , empty($GLOBALS['feat_style']));
		
		//var_dump($GLOBALS['slider_type']);
//		exit;
		switch ($GLOBALS['slider_type']){
			case 'Featured-Slider':
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
				global $footer_script;
				$thumbs=(empty($option_js['tPosition']) || $GLOBALS['feat_style']=='default' || empty($GLOBALS['feat_style']))?'':get_thumbs_slider($GLOBALS['thumbs_sld'],$option_js['tPosition']);//pinta el markup del los thumbs
				if ($GLOBALS['slider_type']=='random-top'){
					$option_js['w']='100%';
					$option_js['h']='100%';
				}
				
				/*var_dump($option_js);
				exit;*/
				/*if (!empty($optionjs)){
					$GLOBALS['slider_type']=(empty($optionjs['effect']))?$GLOBALS['slider_type']:$optionjs['effect'];
					$optionjs['effect']=$GLOBALS['slider_type'];
					$GLOBALS['thumbpos']=$optionjs['tPosition'];
					$GLOBALS['height_slider']=$optionjs['h'];
					$GLOBALS['width_slider']=$optionjs['w'];
					$GLOBALS['feat_style']=$optionjs['sliderFrame'];
				}*/				
				switch ($option_js['tPosition']){
					case 'left':
					case 'top':
						echo $thumbs;
						echo $slidercontent;
					break;
					case 'right':
					case 'bottom':
						echo $slidercontent;
						echo $thumbs;
					break;
					default:
						echo $slidercontent;
						if (empty($option_js))
							break 2;
					break;
				}
					//if ($optionjs['sliderExists']):
					ob_start();
						
						/*var_dump($optionjs);
						exit;*/
					?>
					<script>
						if(!sessionStorage.sliderInfo){
							jQuery(document).ready(function(){
								//func_slider('<?php echo $effect; ?>','<?php echo json_encode($GLOBALS['acss']['.slider_area']);?>','<?php echo $GLOBALS['acss']['.container_widgets_pieces']['background-image']; ?>',0,'<?php echo $GLOBALS['thumbpos']; ?>');
								//jQuery.fn.setslider(jQuery('.set_slider_type input[value="<?php echo $GLOBALS['slider_type']; ?>"]'));
								jQuery.fn.scheduler(<?php echo json_encode($option_js); ?>);						
							});
						}
					</script>
					<?php 
						
					$footer_script=ob_get_clean();
					add_action('wp_print_footer_scripts', 'tgft_print_script', 20);				
				//endif;//valida si existe el nuevo slider
			break;
			default:
				echo $slidercontent;
			break;
		}
?>
	</div><!-- end slider area -->
</div><!-- end wrapper slider -->
<?php }  ?>

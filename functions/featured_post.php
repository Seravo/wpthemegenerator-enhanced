<?php
	function slidr_markup($args=array()){
		ob_start();
		?>
			<script>
				jQuery(function(){
					jQuery('.wtsCarousel').carousel({
						interval: 5000
					});
				});
			</script>
			<?php
				$GLOBALS['height_slider']=($GLOBALS['height_slider']-20).'px';
			?>
			<style>
			.wtsCarousel{
				height:<?php echo $GLOBALS['height_slider']; ?>;
				width:<?php echo $GLOBALS['width_slider']; ?>;
			}
			.wrapper_slider .carousel-inner{
				-webkit-box-shadow: 0 0 3px rgba(0, 0, 0, .5);
				-moz-box-shadow: 0 0 3px rgba(0, 0, 0, .5);
				box-shadow: 0 0 3px rgba(0, 0, 0, .5);
			}
			</style>
			<div id="wptg_Carousel2" class="carousel wtsCarousel slide " >
				<?php //var_dump($GLOBALS['height_slider']); exit;?>
			  	<!-- Carousel items -->
			  	<div id="tgcarousel_container" class="carousel-inner">
					<?php 
					if (empty($args)):
			      		$featp = new WP_Query(array('post_type' => 'post', 'posts_per_page' => -1));
						$counter_post=0;
			      		if($featp->have_posts()) : while ($featp->have_posts()) : $featp->the_post();
			      		$feat_post = "";
			      		$custom = get_post_custom($post->ID);
			      		if(isset($custom["feat_post"][0])){
			      		 	$feat_post = $custom["feat_post"][0];
			      		}
			      		if($feat_post == 'on'){ $counter_post++;?>
				      		<div class="item <?php echo($counter_post == 1?"active":"");?>">
						        <div class="contentSlide">
					            <?php 
									the_post_thumbnail();
						            $needleId=get_ID_by_post_title('Fully Features');
						            $thisId=get_the_ID();
									$GLOBALS['thumbs_sld'][]=get_the_post_thumbnail($thisId,'thumbnail','style=width:100px;height:78px;');
						            if($needleId==$thisId){
						              	$redirectToPage=get_ID_by_page_name('fully-features');?>
						                <h1><a href="<?php echo get_permalink($redirectToPage);?>"><?php the_title();?></a></h1>
						                <div style="text-align:left;margin-left: -5px;">
						                <!--start to show more info-->
						                <?php 
						                    if($GLOBALS['feat_date']=='true'){
						                    	?>
						                  			<span class="post_date post_icon"><?php echo __('On ','tstranslate')?> <?php the_time("M j, Y ");?></span>
						                  		<?php
							                }
						                    if($GLOBALS['feat_author']=='true'){
						                    	?>
						                  			<span class="post_author post_icon"><?php echo __('By','tstranslate');?> <?php the_author();?></span>
						                  		<?php
							                }
						                ?>
						                <?php 
						                    if($GLOBALS['feat_text']=='true'){
						                    	the_excerpt();
							                }
						                ?>
						                </div>
						                
					            		<a class="more-link" href="<?php echo get_permalink($redirectToPage);?>"><span class="more-link_right"></span><?php echo __(' Read More','tstranslate');?><span class="more-link_left"></span></a>
				        		<?php 	}else{ ?>
						                <h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
						               	<div style="text-align:left;margin-left: -5px;">
						                <!--start to show more info-->
						                <?php 
						                    if($GLOBALS['feat_date']=='true'){
						                    	?>
						                  		<span class="post_date post_icon"><?php echo __('On ','tstranslate')?> <?php the_time("M j, Y ");?></span>
						                  		<?php
							                }
						                    if($GLOBALS['feat_author']=='true'){
						                    	?>
						                  		<span class="post_author post_icon"><?php echo __('By','tstranslate');?> <?php the_author();?></span>
						                  		<?php
							                }
						                    if($GLOBALS['feat_text']=='true'){
						                    	the_excerpt();
							                }
						                ?>
						                </div>
					            		<a class="more-link" href="<?php the_permalink();?>"><span class="more-link_right"></span><?php echo __(' Read More','tstranslate');?><span class="more-link_left"></span></a>
						            <?php 
						        		}
						        ?> 
					        </div>
				      	</div>
			      	<?php } endwhile; endif; 
			      	wp_reset_query();
					else: 
						foreach ($GLOBALS['slider_img_info'] as $index => $image) {
							if($image['active']){
								$GLOBALS['thumbs_sld'][]='<img src="'.$image['thumbnail'].'" style="width:100px;height:78px;">';
								?>
									<div class="item <?php echo($index == 0?"active":"");?>">
							      		<a href="<?php echo $image['link'];?>"><img src="<?php echo $image['url'];?>" width="<?php echo $GLOBALS['width_slider']; ?>" height="<?php echo $GLOBALS['height_slider']; ?>" ></a>
							      	</div>
								<?php
							}
						}
					endif;
					?>

			  	</div>
			  	  	<!-- Carousel nav -->
					<a class="carousel-control left rs-prev goto-slide ts-arrow-1 ts-arrow-1-left nivo-prevNav" href="#wptg_Carousel2" data-rs="prev" data-slide="prev" id="prev"></a>
					<a class="carousel-control right rs-next goto-slide ts-arrow-1 ts-arrow-1-right nivo-nextNav" href="#wptg_Carousel2" data-rs="next" data-slide="next" id="next"></a>
		  	</div>
		<?php
		$html_markup=ob_get_clean();
		return $html_markup;
	}
?>
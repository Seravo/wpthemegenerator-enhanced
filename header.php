<?php
	get_template_part('framework-tool/save_local_theme');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml"  >
<head>
  <link rel="shortcut icon" href="<?php echo get_option("themeshock_favicon");?>"  />
  <title><?php echo((is_home() || is_front_page()) && is_wpthemegenerator() != true && get_bloginfo('description') != '')?get_bloginfo('description').' &laquo ':'';?><?php wp_title("&laquo;", true, "right"); ?> <?php bloginfo("name"); ?></title>
  <?php echo ($GLOBALS['responsive_mode'] == "true")?'<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">':'';?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( "charset" ); ?>" />
	<?php echo(get_option('themeshock_metaDescription') != '')?'<meta name="description" content="'.get_option('themeshock_metaDescription').'" />':'';
	echo(get_option('themeshock_metaKeywords') != '')?'<meta name="keywords" content="'.get_option('themeshock_metaKeywords').'" />':'';
	?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo("name"); wp_title();?>" href="<?php echo get_option("themeshock_feed_burn"); ?>" />
	<!--[if IE]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.ie.css"><![endif]-->
	<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css"><![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome-logo.css"  />
  	<link rel="stylesheet" <?php echo ($GLOBALS['responsive_mode'] === "false")?'':'media="(min-width: 960px)"';?> href="<?php echo get_template_directory_uri()?>/css/mainmenu.css?asdjksahdjkas=<?php echo $_SERVER['REQUEST_TIME']; ?>" data-media="all"  />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo("stylesheet_url");?>?v=<?php echo $_SERVER['REQUEST_TIME']; ?>" />
	<link rel='stylesheet' href='<?php echo get_template_directory_uri()?>/css/refineslide.css?v=<?php echo $_SERVER['REQUEST_TIME']; ?>' />
   <style type="text/css">
	<?php echo ($GLOBALS['framework_tool']=='true')?'@import url('.get_template_directory_uri().'/framework-tool/tool_style.css?v=1.3);'."\n":'';?>
	<?php echo($_GET['html']!=='true')?$GLOBALS['css']:'';?>
	.container_menu ul ul{
		display:none;
	}
	.wrapper_content{
		background: transparent;
	}
	@import url(<?php echo get_template_directory_uri(); ?>/framework-tool/current_layout/last_change.css);
  </style>
  <?php load_theme_textdomain( "tstranslate"); ?>
  <style type="text/css">
  		.navbar{
  			display: none;
  		}
		<?php
			$fontFamilyTagP = get_option("themeshock_fontFamilyTagP");
			$fontSizeTagP = get_option("themeshock_fontSizeTagP");
			$fontColorTagP = get_option("themeshock_fontColorTagP");
			$fontFamilyTagHeading = get_option("themeshock_fontFamilyTagHeading");
			if($fontFamilyTagP != 'inherit' || $fontSizeTagP != 'inherit' || $fontColorTagP != 'Inherit'){?>
				body .body_theme{<?php
					echo ($fontFamilyTagP != 'inherit')?'font-family: "'.$fontFamilyTagP.'", Arial, Helvetica, serif;':'';
					echo ($fontSizeTagP != 'inherit')?'font-size: '.$fontSizeTagP.'px;':'';
					echo ($fontColorTagP != 'Inherit')?'color: '.$fontColorTagP.';':'';?>
				}<?php
			}
			if($fontFamilyTagHeading != 'inherit'){?>
				body .body_theme h1, body .body_theme h2, body .body_theme h3, body .body_theme h4, body .body_theme h5, body .body_theme h6{
					font-family: "<?php echo $fontFamilyTagHeading;?>", Arial, Helvetica, serif;
				}<?php
			}
			foreach(range(1, 6) as $heading){
				$fontSizeTagH = get_option("themeshock_fontSizeTagH".$heading);
				$fontColorTagH = get_option("themeshock_fontColorTagH".$heading);
				echo ($fontSizeTagH != 'inherit')?'body .body_theme h'.$heading.'{font-size: '.$fontSizeTagH.'px;}':'';
				echo ($fontColorTagH != 'Inherit')?'body .body_theme h'.$heading.'{color: '.$fontColorTagH.';}':'';
			}?>
	</style>
  <?php if($GLOBALS['responsive_mode'] == "true"){?>
  <link rel="stylesheet" media="screen and (min-width: 600px) and (max-width: 960px), screen and (min-device-width: 600px) and (max-device-width: 760px) and (orientation:landscape)" href="<?php echo get_template_directory_uri();?>/css/responsive-medium.css?v=<?php echo $_SERVER['REQUEST_TIME']; ?>" data-simple="out" />
  <link rel="stylesheet" media="screen and (min-width: 120px) and (max-width: 599px), screen and (min-device-width: 120px) and (max-device-width: 599px)" href="<?php echo get_template_directory_uri();?>/css/responsive-small.css?v=<?php echo $_SERVER['REQUEST_TIME']; ?>" data-simple="out" />
	<?php }?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"  data-tgdelst="live" ></script>
	<!--<script src="<?php echo get_template_directory_uri(); ?>/js/menuscript.min.js"></script>-->
<?php  if($GLOBALS['framework_tool']  === 'true' && is_user_logged_in()){?><script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/framework-tool/js/theme_generator.js?v=<?php echo $_SERVER['REQUEST_TIME']; ?>"></script>  
<?php 	
?>  
<?php  }?>
  <?php add_theme_support("automatic-feed-links"); ?>
  <?php wp_head();?>
</head> 

<body <?php body_class();?>>
<?php if($GLOBALS['framework_tool']  === 'true' && is_user_logged_in()){?>
<script>
	jQuery(window).load(function(){
		jQuery('img.lazy').asynchImageLoader({callback : function(){
			jQuery('ul.get_thumb_list li a img').each(function(){
				jQuery(this).load(function(){
					jQuery(this).parent('a').css('background-image', 'none')
				})
			})			
		}});
	});
</script>
<?php }?>

<div class="body_theme" id="body_theme">
	<a href="#"><span class="hide_tool"></span></a>
	<?php
		if($GLOBALS['cli_bk'] == true){
			wts_tool_panel('clipart-header'); // print container clipart to layout_1
		}
	?>
	<div class="fullheader_menu_bar">
    <div class="header_menu_bar">
	    <?php wp_nav_menu(array("theme_location" => "optional_topbar")); ?>
    </div><!-- header_menu_bar -->
  </div><!-- end fullheader_menu_bar -->
  <?php wts_tool_panel('layout-3'); //Print container to Layout_3 if is the Current?>
  <?php wts_tool_panel('layout-7'); //Print container to Layout_3 if is the Current?>
  <?php wts_tool_panel('clipart-top'); // print container clipart to layout_2 and layout_4?>
  <?php wts_tool_panel('layout-6'); //Print container to Layout_6 if is the Current?>
  <div class="wrapper_header">
  	<?php
		if($GLOBALS['cli_bk'] == false){
			wts_tool_panel('clipart-header'); // print container clipart to layout_1
		}
	?>
    <!-- layout header layers --> 
    <div class="lay_base header_pattern"></div>
    <div class="lay_base header_shadow"></div>
    <!-- end layout header layers -->
  	<div id="header">
    	<div class="container_LogoSearch">
        <?php echo get_attr_logo();?>
        <?php if($GLOBALS['search_box'] == 'true'){ ?><div class="search_area <?php echo display_elements(2);?>"><?php get_search_form();?></div><?php }?>
					<ul class="icon_socials <?php echo display_elements(1);?>">
       		<?php
					foreach($GLOBALS['social_network'] as $social_network => $option ){
						$link_social_nt=get_option('themeshock'.$option);
						if(get_option('themeshock'.$option.'_option') ==='true'){					
							switch($social_network){
								case'facebook':
							?>
							<li class="ic_facebook"><a rel="" href="<?php echo $link_social_nt; ?>" title="Visit us on Facebook" target="_blank"></a></li>
							<?php
								break;
								case'twitter':
							?>
							<li class="ic_twitter"><a rel="" href="<?php echo $link_social_nt; ?>" title="Follow us on Twitter" target="_blank"></a></li>
							<?php
								break;
								case'rss':
							?>
							<li class="ic_rss"><a rel="" href="<?php echo $link_social_nt; ?>" title="RSS Feed" target="_blank"></a></li>
							<?php
								break;
								case'mail':
							?>            
							<li class="ic_mail"><a rel="" href="<?php echo $link_social_nt; ?>" title="Mail" target="_blank"></a></li>
							<?php
								break;
								case'google':
							?>            
							<li class="ic_plus"><a rel="" href="<?php echo $link_social_nt; ?>" title="Google Plus" target="_blank"></a></li>
							<?php
								break;
								case'linkedin':
							?>            
							<li class="ic_linkedin"><a rel="" href="<?php echo $link_social_nt; ?>" title="LinkedIn" target="_blank"></a></li>
							<?php
								break;
								case'rss_mail':
							?>            
							<li class="ic_rssmail"><a rel="" href="<?php echo $link_social_nt; ?>" title="RSS Mail" target="_blank"></a></li>
							<?php
								break;
								case'skype':
							?>            
							<li class="ic_skype"><a rel="" href="<?php echo $link_social_nt; ?>" title="Skype" target="_blank"></a></li><br />
							<?php	break;
								}
							}
						}
					?>              
        </ul>        
      </div><!-- end container_LogoSearch -->

<div id="HEADERTEKSTI">...luo rakkaistasi taidetta.</div>

      <?php wts_tool_panel('mainmenu-header'); //Print main menu to the layout_1, layout_3 or layout_4?>

    </div>



<!-- end header -->
    <div class="bar_separate header_separate"></div>
  </div><!-- wrapper_header -->
 	<!--end layout header -->
  <?php wts_tool_panel('layout-2'); wts_tool_panel('layout-5'); wts_tool_panel('mainmenu-lay2'); //Print main menu to the layout_2?>
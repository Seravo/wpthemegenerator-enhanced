jQuery(document).ready(function(){
	if(document.URL == 'http://wpthemegenerator.com' || document.URL == 'http://www.wpthemegenerator.com/' ){
		sessionStorage.slidrProvWidth = jQuery('.slider_area').width();
		sessionStorage.slidrProvHeight = jQuery('.slider_area').height();
		sessionStorage.slidrProvPadding = jQuery('.slider_area').css('padding');
	}else{
			sessionStorage.slidrProvWidth = 900;
			sessionStorage.slidrProvHeight = 366;
			sessionStorage.slidrProvPadding = '10px 10px 0';
	}
	
	/*Simula los eventos en caso de IE*/
	jQuery('.faker-left,.faker-right').live( 'click', function(e){
		switch(e.target.className){
			case 'faker-right':
				jQuery('#next').trigger('click');
			break;
			case 'faker-left':
				jQuery('#prev').trigger('click');
			break;
		}
	});

	function fakes(h,pos,t){
		jQuery('.faker-right,.faker-left').remove();
		jQuery('.wrapper_content').append('<div class="faker-left"></div>').append('<div class="faker-right"></div>');
		jQuery('.faker-left').css({'left':0,'width':100,'height':h,'z-index':4,'position':pos,'background':'transparent','margin-top':t,'cursor':'pointer'});
		jQuery('.faker-right').css({'right':0,'width':100,'height':h,'z-index':4,'position':pos,'background':'transparent','margin-top':t,'cursor':'pointer'});
	}
	
	/**
     * scheduler
     * modifica el tamaño y posicion de los thumbs al igual que el tamaño del slider de acuerdo a parametros recibidos 
     * por metodo POST a traves de Ajax
     * @param  {[obj]} slidr [Pasa los parametros necesarios para el redimensionamiento del slider]
     */
	jQuery.fn.scheduler = function (slidr){
		var wrapperPosition;
		if(!slidr.tPosition){
			slidr.tPosition = "none";
		}
		if (!slidr.delay){
			slidr.delay = 5000;
		}
		if (!slidr.h){
			slidr.h = sessionStorage.slidrProvHeight ;
		}
		if (!slidr.w){
			slidr.w = sessionStorage.slidrProvWidth ;
		}
		if (!slidr.p){
			if(!sessionStorage.slidrPadding){
				slidr.p = '20px 20px 0';
				sessionStorage.slidrPadding = slidr.p;
			}else{
				slidr.p = sessionStorage.slidrPadding;
			}
		}
		switch (slidr.effect){
			case 'random-top':
				wrapperPosition = 'fixed';
				slidr.h=jQuery(window).height();
				slidr.w=jQuery(window).width();
				sessionStorage.slidrWidth = slidr.w;
				sessionStorage.slidrHeight = slidr.h;
				sessionStorage.slidrPadding = slidr.p;
				if (jQuery.browser.msie && jQuery.browser.version < 11 ){
					fakes('100%','fixed',0);
				}
				jQuery('#prev').attr('style','').removeClass('nivo-prevNav').addClass('special-prev');
				jQuery('#next').attr('style','').removeClass('nivo-nextNav').addClass('special-next');
				jQuery('.wrapper_slider').css({padding:'20px 0'});
				jQuery('a[rel="set_slider_bkg_img"]').parent().hide();
				jQuery('.sldtrm').hide();
				jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').css('display','none');
			break;
			case 'random':
				wrapperPosition = 'absolute';
				slidr.h = 600;
				slidr.w=jQuery(window).width();
				sessionStorage.slidrWidth = slidr.w;
				sessionStorage.slidrHeight = slidr.h;
				sessionStorage.slidrPadding = slidr.p;
				jQuery('.wrapper_slider').css({position:'relative'});
				// console.log(jQuery('.wrapper_slider').position().top+20,jQuery('.wrapper_slider').position(),jQuery('.wrapper_slider').height());
				if (jQuery.browser.msie && jQuery.browser.version < 11 ){
					fakes(600,'absolute',0);
				}
				jQuery('#prev').attr('style','').removeClass('nivo-prevNav').addClass('special-prev');
				jQuery('#next').attr('style','').removeClass('nivo-nextNav').addClass('special-next');
				jQuery('.wrapper_slider').css({padding:0});
				jQuery('a[rel="set_slider_bkg_img"]').parent().hide();
				jQuery('.sldtrm').show();
				jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').css('display','block');
			break;
			case 'random-relative':
				wrapperPosition = 'relative';
				slidr.h = 600;
				slidr.w=jQuery(window).width();
				sessionStorage.slidrWidth = slidr.w;
				sessionStorage.slidrHeight = slidr.h;
				sessionStorage.slidrPadding = slidr.p;
				jQuery('.wrapper_slider').css({position:'relative'});
				// console.log(jQuery('.wrapper_slider').position().top+20,jQuery('.wrapper_slider').position(),jQuery('.wrapper_slider').height());
				if (jQuery.browser.msie && jQuery.browser.version < 11 ){
					fakes(600,'absolute',0);
				}
				jQuery('#prev').attr('style','').removeClass('nivo-prevNav').addClass('special-prev');
				jQuery('#next').attr('style','').removeClass('nivo-nextNav').addClass('special-next');
				jQuery('.wrapper_slider').css({padding:0});
				jQuery('a[rel="set_slider_bkg_img"]').parent().hide();
				jQuery('.sldtrm').show();
				jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').css('display','block');
			break;
			case 'random-medium':
				wrapperPosition = 'relative';
				slidr.h = 350;
				slidr.w=jQuery(window).width();
				sessionStorage.slidrWidth = slidr.w;
				sessionStorage.slidrHeight = slidr.h;
				sessionStorage.slidrPadding = slidr.p;
				jQuery('.wrapper_slider').css({position:'relative'});
				// console.log(jQuery('.wrapper_slider').position().top+20,jQuery('.wrapper_slider').position(),jQuery('.wrapper_slider').height());
				if (jQuery.browser.msie && jQuery.browser.version < 11 ){
					fakes(350,'absolute',0);
				}
				jQuery('#prev').attr('style','').removeClass('nivo-prevNav').addClass('special-prev');
				jQuery('#next').attr('style','').removeClass('nivo-nextNav').addClass('special-next');
				jQuery('.wrapper_slider').css({padding:0});
				jQuery('a[rel="set_slider_bkg_img"]').parent().hide();
				jQuery('.sldtrm').show();
				jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').css('display','block');
			break;
			default:
				jQuery('.wrapper_slider').css({padding:'20px 0'});
				jQuery('.sldtrm').show();
				switch(sessvars.current_lay){
					case 'layout_1':
						jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').css('display','block');
					break;
					case 'layout_3':
						setTimeout(function(){
							jQuery('.slider_pattern, .header_separate, .header_shadow, .slider_shadow').hide();
						},400);
					break;
					case 'layout_2':
						setTimeout(function(){
							jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').hide();
						},400);
					case 'layout_4':
					case 'layout_5':
					case 'layout_6':
					case 'layout_7':
						setTimeout(function(){
							jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').hide();
						},400);
					break;
					default:
					break;
				}
			break;
		}
		//sess_create('.slider_pattern', '.content_pattern', '.footer_pattern', '.header_pattern', '.header_separate', '.content_separate', '.footer_separate', '.header_shadow', '.slider_shadow', '.content_shadow', '.footer_shadow');		
		if(!slidr.frm){
			//slidr.frm="tg-border-15";
		}
		jQuery('.slider_area').width(slidr.w).height(slidr.h);
		jQuery('.slider_area').css({'padding':slidr.p});
		if(slidr.frm){			
			if(!sessionStorage.slider_area_css_class){
				sessionStorage.slider_area_css_class = slidr.frm;
				sessionStorage.slidrClass = slidr.frm;
				jQuery('.slider_area').addClass(slidr.frm);
			}else{
				jQuery('.slider_area').removeClass(sessionStorage.slidrClass);
				jQuery('.slider_area').addClass(slidr.frm);
			}
			sessvars['sldfrm']=slidr.frm;
		}
		switch(slidr.tPosition){
			case 'top':
				if(jQuery('.thumbnails.t-'+slidr.tPosition).length > 1){jQuery('.thumbnails.t-'+slidr.tPosition).eq(1).remove()}
				jQuery('.thumbnails.t-'+slidr.tPosition).insertBefore('.slider_content').css({'width':jQuery('.slider_area').width(),'height':'70px'});
				jQuery('.t-bottom,.t-left,.t-right,.t-none').remove();
			break;
			case 'left':
				if(jQuery('.thumbnails.t-'+slidr.tPosition).length > 1){jQuery('.thumbnails.t-'+slidr.tPosition).eq(1).remove()}
				jQuery('.thumbnails.t-'+slidr.tPosition).insertBefore('.slider_content').css({'width':'100px','height':jQuery('.slider_area').height()-20});
				jQuery('.t-top,.t-bottom,.t-right,.t-none').remove();
			break;
			case 'right':
				if(jQuery('.thumbnails.t-'+slidr.tPosition).length > 1){jQuery('.thumbnails.t-'+slidr.tPosition).eq(1).remove()}
				jQuery('.thumbnails.t-'+slidr.tPosition).insertAfter('.slider_content').css({'width':'100px','height':jQuery('.slider_area').height()-20});
				jQuery('.t-top,.t-bottom,.t-left,.t-none').remove();
			break;
			case 'bottom':
				if(jQuery('.thumbnails.t-'+slidr.tPosition).length > 1){jQuery('.thumbnails.t-'+slidr.tPosition).eq(1).remove()}
				jQuery('.thumbnails.t-'+slidr.tPosition).insertAfter('.slider_content').css({'width':jQuery('.slider_area').width(),'height':'70px'});
				jQuery('.t-top,.t-left,.t-right,.t-none').remove();
			break;
			case 'none':
				jQuery('.t-top,.t-bottom,.t-left,.t-right,.t-none').remove();
			break;
		}
		var optionslider={width:slidr.w,height:slidr.h,imgMarginTop: 0,imgMarginLeft:0}
		if(slidr.onBackground){
			if(slidr.inTop){
				jQuery('.wrapper_slider').css({'position':'fixed','left':'0','top':0,'width':'100%'});
				optionslider.fixed=true;
			}else{
				jQuery('.wrapper_slider').css({'position':wrapperPosition,'top':'','width':'100%'});
			}
			jQuery('.wrapper_content').css({'pointer-events':'none','z-index':'1','background':'transparent'});
			jQuery('.wrapper_header').css({'pointer-events':'none'});
			jQuery('#content,#header').css({'pointer-events':'all'});
		}else{
			jQuery('.wrapper_slider').css({'position':'relative','top':'','width':''});
			jQuery('.wrapper_content').css({'pointer-events':'','z-index':''});
			jQuery('.wrapper_header').css({'pointer-events':'none'});
		}
		jQuery('#content,#header').css({'pointer-events':'all'});
        if(slidr.bge){
            func_slider(slidr.effect,JSON.stringify(optionslider),jQuery('.carousel-inner').css('background-image'),slidr.delay,slidr.tPosition);
        }else{
            func_slider(slidr.effect,JSON.stringify(optionslider),'transparent',slidr.delay,slidr.tPosition);
        }
		jQuery('.slider_content').css({'visibility':'inherit'});
	}
	/*end scheduler function*/
});
// JavaScript Document
//themegenerator v1.4
var tg_upload=false;
var sld_html='';
	function open_rel(r_tag, r_rel){

	/*	jQuery(r_tag).on('click',function(e){
			e.stopPropagation();
			e.preventDefault();*/

			jQuery('.items_layout > li > a').removeClass('current_option');
			jQuery(r_tag).addClass('current_option');
			var this_parents = jQuery(r_tag).parent('li');
			var sub_pack = '.'+jQuery(r_tag).attr(r_rel);
			jQuery('.sub_panel').hide();
			jQuery('div.save_flt,div.login_tmp, .set_lay_page, .area_save_local,.upload_wtg').hide();
//			console.log(jQuery('.set_lay_page').hide());
			
			if(sub_pack!="."){
				jQuery(sub_pack).appendTo(this_parents).show();
			}
//		});
		return false;
	}
	function open_set(r_tag2, r_rel){
		//jQuery($r_tag2).on('click',function(e){
			/*e.preventDefault();
			e.stopPropagation();*/
		jQuery('.sub_panel > ul > li > a').removeClass('current_option');
			jQuery(r_tag2).addClass('current_option');
			jQuery('.set_panel').hide();
			var this_parents = jQuery(r_tag2).parent('li');
			var sub_pack = '.'+jQuery(r_tag2).attr(r_rel);
			switch (jQuery.trim(sub_pack)){
				case '.set_header_bar':
				case '.set_logo':
				case '.set_general_divisors':
				case '.set_shadows':
				case '.set_gral_patterns':
				case '.set_header_bkgimage':
				case '.set_header_shines':
				case '.set_header_search':
				case '.set_header_socials':
				case '.set_header_menu':
				case '.set_slider_bkg_img':
				case '.set_widgets_boxes':
				case '.set_blog_boxes':
				case '.set_blog_commts':
				case '.set_read_more':
				case '.set_widgets_boxes_css':
					preloadimages(sub_pack+' img.lazy');
				break;
			}
			jQuery(sub_pack).appendTo(this_parents).show();
	//	})
		return false;
	}	
	function preloadimages(element){
		jQuery(element).each(function(index, element) {
				var src=jQuery(this).attr("data-href");
				if (!src){
					return false;
				}
	      jQuery('<img/>')[0].src =src;
				jQuery(this).removeAttr("data-href");
				jQuery(this).attr('src',src);
    });
	}
	
	// Open Items set
//	open_set('.sub_panel a', 'rel');	
jQuery(document).ready(function(){

	var count=5;
	function timer(){
		count=count-1;
		if (count <= 0){
		//	 clearInterval(counter);
			 window.location = "http://www.wpthemegenerator.com/"		 
			 //counter ended, do something here
			 return;
		}
		document.getElementById("timer").innerHTML=count;
		//Do code for showing the number of seconds here
	}
	

	// Open Subpanel Relationship


	//open_set('.sub_panel a[rel*="set_"]', 'rel');	

	
	jQuery('.open_link').click(function(e){
		e.stopImmediatePropagation()
	})
	
	function ajust_width(){
		$css_r = jQuery(this).css('display');
		if($css_r == 'compact'){return 'block';}else{return 'compact';}
	}
	
	function val_select($selector){
		var $this_str = '';
		jQuery($selector +' option:selected').stop(true,true).change(function(e){
				$this_str = jQuery(this).text();
		}).change();
		return $this_str;
	}
	
	// Remove background image 
	function no_item($this, $block_container){
		$no_item = jQuery($this).attr('class');
		if($no_item == 'no_item'){
			jQuery($block_container).css({'background-image': 'none'});
			sess_create($block_container);
			return true;
		}
	}
	
	// Remove block element
	function no_element($this, $element){
		$no_item = jQuery($this).attr('class');
		if($no_item == 'no_item'){
			jQuery($element).removeClass("show_element");
			jQuery($element).addClass("hide_element");
			sessvars['elem_'+$element]= 'hide';
			sessvars.elem_test2= 'hide';
			return true; 
		}else{
			jQuery($element).removeClass("hide_element");
			sessvars.elem_test2= 'hide';
			sessvars['elem_'+$element] = 'show';
		}
	}
	
	function no_item_box($this, $in_box){
		$widget_boxes_arr = ['.container_widgets_pieces', '.widget_top_left', '.widget_top_center', '.widget_top_right', '.widget_middle_left', '.widget_content', '.widget_middle_right', '.widget_bottom_left', '.widget_bottom_center', '.widget_bottom_right', '.widget_token_bottom', '.widget_token_right', '.widget_token_left'];
		$post_boxes_arr = ['.container_posts_pieces', '.post_top_left', '.post_top_center', '.post_top_right', '.post_middle_left', '.post_content', '.post_middle_right', '.post_bottom_left', '.post_bottom_center', '.post_bottom_right', '.post_token_bottom', '.post_token_right', '.post_token_left'];
		
		$widget_boxes = jQuery.map($widget_boxes_arr, function(val, i){return val;});
		$post_boxes = jQuery.map($post_boxes_arr, function(val, i){return val;});
		$widget_boxes.join(', ');
		$post_boxes.join(', ');
		$no_item = jQuery($this).attr('class');
		if($no_item == 'no_item'){
			jQuery(""+window['$'+$in_box]+"").css({'background-image': 'none'});
			if($in_box == 'widget_boxes'){
				jQuery('.boxes').css({'padding': '0 20px', 'margin-bottom': 0});
				sess_create('.boxes');
			}
			jQuery.each(window["$"+$in_box+"_arr"], function(i, val){
				sess_create(val);
			});
			return true;
		}
	}

	function no_item_boxcss($in_box){
		$widget_boxes_arr = ['.container_widgets_pieces', '.widget_top_left', '.widget_top_center', '.widget_top_right', '.widget_middle_left', '.widget_content', '.widget_middle_right', '.widget_bottom_left', '.widget_bottom_center', '.widget_bottom_right', '.widget_token_bottom', '.widget_token_right', '.widget_token_left'];
		$post_boxes_arr = ['.container_posts_pieces', '.post_top_left', '.post_top_center', '.post_top_right', '.post_middle_left', '.post_content', '.post_middle_right', '.post_bottom_left', '.post_bottom_center', '.post_bottom_right', '.post_token_bottom', '.post_token_right', '.post_token_left'];
		
		$widget_boxes = jQuery.map($widget_boxes_arr, function(val, i){return val;});
		$post_boxes = jQuery.map($post_boxes_arr, function(val, i){return val;});
		$widget_boxes.join(', ');
		$post_boxes.join(', ');
		$no_item = jQuery($this).attr('class');
			jQuery(""+window['$'+$in_box]+"").css({'background-image': 'none'});
			return true;
	}

	function alert_select_open($get_select, $sel_page_area){
		jQuery('.alert_select, .append_get_content').show();
		jQuery('.alert_select_close').addClass($sel_page_area);
		$select_tmp = jQuery($get_select).clone();
		jQuery('.append_get_content').show().append($select_tmp);
	};
	
	function alert_select_close($post_select){
		var post_select = '';
		post_select = $post_select;
		jQuery('.alert_select_close').one('click', function(e){
			e.stopImmediatePropagation();
			$val_append_select = val_select('.append_get_content');
			jQuery('.append_get_content').empty();
			jQuery('.alert_select').hide();
			jQuery('.set_panel '+post_select+' option:contains("'+$val_append_select+'")').attr('selected', true);
		})
	}
	
	function alert_not($label_for){
		jQuery('label[for="'+$label_for+'"]').stop(true, true).css('background-color', 'red').animate({'opacity': 0},1000,function(){
			jQuery(this).css({
				'opacity': 1, 'background': 'transparent'
			})
		})
	}

	function current_lay(){return jQuery.trim(sessvars.current_lay?sessvars.current_lay:'layout_1');}
	function too_image_preloader($appl_bkg){
		if(jQuery('.bar_menu_loading img.fifty').attr('src')==$appl_bkg){
			return false;
		}
		jQuery('.bar_menu_loading').show();
		jQuery('.bar_menu_loading img.fifty').attr('src', $appl_bkg).load(function(){
			jQuery('.bar_menu_loading').fadeOut('fast');
		});
	//jQuery('.bar_menu_loading').hide();
	}

	// No borrar el siguiente codigo comentado.

	
	if(!sessvars.current_lay){
		sessvars.current_lay = current_layout_ini;
	}
	
	// Shadow separate
	
	jQuery.fn.shadows = function(element) {
		$shadow_parent = val_select('#page_area');
		$check_enable = jQuery('#page_area option:selected').attr('disabled')?true:false;
		if($shadow_parent == 'Choose Area' || $check_enable  == true){
			alert_not('page_area');
			return false;
		}
		if(no_item(element, '.'+$shadow_parent.toLowerCase()+'_shadow') == true){return;};
		$this_src = jQuery('img', element).attr('src');
		if ($this_src.length===0){
			$this_src=jQuery('img', this).attr('data-href');
		}		
		if($this_src.indexOf('repeat')){}
		$shadow_bkg = $this_src.replace(/\_thumb(.*?)png/g, ".png");
		$shadow_height = jQuery(element).attr('data-header-divisors-height');
		$data_repeat = jQuery(element).attr('data-repeat');
		jQuery('.print').text($shadow_bkg +' '+ $this_src +' '+ $shadow_height);
		jQuery('body .'+$shadow_parent.toLowerCase()+'_shadow').css({'display': 'block', 'background-image': ' url('+$shadow_bkg+')', 'height': $shadow_height, 'bottom': $shadow_height, 'background-repeat': $data_repeat});
		sess_create('.'+$shadow_parent.toLowerCase()+'_shadow');
		too_image_preloader($shadow_bkg);
		return false;
	}	
	
/*	open_rel('.items_layout a', 'rel');
	open_set('.sub_panel a', 'rel');*/
	
	// logo //
	// logo //
	jQuery.fn.tg_logo = function(){
		$this_logo_src = jQuery('img', this).attr('src');
		if ($this_logo_src.length===0){
			$this_logo_src=jQuery('img', this).attr('data-href');
		}		
		$this_logo_src = $this_logo_src.replace('_thumb', '');
		jQuery('a.logo img').attr('src', $this_logo_src).show();
		jQuery('a.logo span').hide();
//		jQuery('.text_logo').hide('fast')
		sessvars.logo = $this_logo_src;//url relative;
		sessvars.type_current_logo = 'image';
		too_image_preloader($this_logo_src);
		if(get_current_slider()==='random'){
			if (sessionStorage.sliderInfo && sessionStorage.sldhtml){
				var o = JSON.parse(sessionStorage.sliderInfo);
//						o['html']=sessionStorage.sldhtml;
				jQuery.fn.scheduler(o);
			}else{
				jQuery.fn.setslider(jQuery('.set_slider_type input[name="slider_type"]:checked'));
			}
		}		
		return false;
	}	
	switch(sessvars.type_current_logo){
		case 'text':
			logo_info(true);
		break;
		default:
			sessvars.logo?jQuery('a.logo img').attr('src', sessvars.logo):null;
		break;
	}
	/*open_colorPicker_single('#logo_color','logo');//open colorpicker
	open_colorPicker_single('#logo_color2','logo2');//open colorpicker	*/
	jQuery('a[rel="text_logo"]').click(function(e){
		e.preventDefault(); e.stopImmediatePropagation();
		$text_logo = jQuery('#themeshock_text_logo').val();
		$text_logo_effect = jQuery('#themeshock_text_logo_effect').val();
		$font_size_text_logo = jQuery('#themeshock_font_size_logo').val()+'px';
		$text_logo_ffamily = jQuery('#themeshock_text_logo_ffamily').val();
		sessvars.type_current_logo = 'text';
		sessvars.text_logo = $text_logo;
		sessvars.text_logo_font_size = $font_size_text_logo;
		sessvars.text_logo_effect = 'logo_effect_'+$text_logo_effect.toLowerCase();
		sessvars.text_logo_ffamily = ""+$text_logo_ffamily+"";
		logo_info(false);
	});
	function logo_info(info){
		if (info==true){
			jQuery('#themeshock_text_logo').val(sessvars.text_logo);
			jQuery('#themeshock_text_logo_effect').val(sessvars.text_logo_effect.replace("logo_effect_",''));
			jQuery('#themeshock_font_size_logo').val(sessvars.text_logo_font_size);
			jQuery('#themeshock_text_logo_ffamily').val(sessvars.text_logo_ffamily);
		}
//		jQuery('.text_logo').insertBefore('.set_logo li:first').toggle('fast');
		jQuery('a.logo img').hide();
		jQuery('a.logo span p').show().text(sessvars.text_logo);
		jQuery('a.logo span p').attr("class", 'logo logo_effect_'+sessvars.text_logo_effect.replace("logo_effect_",'').toLowerCase()).css('color',sessvars.text_logo_color);
		jQuery('a.logo span').css({'font-size': sessvars.text_logo_font_size,'display':'inline'});		
	}

	jQuery('#themeshock_text_logo').keyup(function(){
		jQuery('a[rel="text_logo"]').trigger('click');	
		jQuery('a.logo span p').text(jQuery(this).val());
		sessvars.text_logo = jQuery(this).val();

	});

	jQuery('#themeshock_font_size_logo').bind('keyup mouseup keydown mousedown change blur',function(){
		jQuery('a.logo span').css('font-size', jQuery(this).val()+'px');
		sessvars.text_logo_font_size = jQuery(this).val()+'px';
		jQuery('a[rel="text_logo"]').trigger('click');
	});
	jQuery('#themeshock_text_logo').click(function(){
		jQuery('a[rel="text_logo"]').trigger('click');		
	});
	jQuery('#themeshock_text_logo_effect').change(function(){
		$text_logo_effect = jQuery(this).val();
		var color1=sessvars.text_logo_color;
		var color2=sessvars.text_logo_color2;
		curr_val_select='a.logo span p';
		jQuery('a.logo span p').attr("class", 'logo logo_effect_'+$text_logo_effect.toLowerCase());
		jQuery('a[rel="text_logo"]').trigger('click');		

		sessvars.text_logo_effect = 'logo_effect_'+$text_logo_effect.toLowerCase();
	});
	jQuery('#themeshock_text_logo_ffamily').change(function(){
		jQuery('a[rel="text_logo"]').trigger('click');	
		$text_logo_ffamily = jQuery(this).val();
		jQuery('a.logo span p').css("font-family", ""+$text_logo_ffamily+"");
		sessvars.text_logo_ffamily = ""+$text_logo_ffamily+"";
	});
	
	// Divisor //
	jQuery.fn.divisors = function(element) {
		$separate_parent = val_select('#block_area_divisor');
		$check_enable = jQuery('#block_area_divisor option:selected').attr('disabled')?true:false;
		if($separate_parent == 'Choose Area' || $check_enable  == true){
			alert_not('block_area_divisor');
			return false;
		}
		if(no_item(element, '.'+$separate_parent.toLowerCase()+'_separate') == true){return;};
		$divisor_image = jQuery('img', element).attr('src');
		if ($divisor_image.length===0){
			$divisor_image=jQuery('img', this).attr('data-href');
		}		
		$divisor_image = $divisor_image.replace('_thumb', '');
		$divisor_height = jQuery(element).attr('data-header-divisors-height');
		jQuery('body .'+$separate_parent.toLowerCase()+'_separate').css({'display':'block', 'background': ' url('+$divisor_image+')', 'height': $divisor_height, 'bottom': -($divisor_height/2).toFixed(0)});
		sess_create('.'+$separate_parent.toLowerCase()+'_separate');
		return false;
	}	
	// Patterns //
	jQuery.fn.pattern = function(element) {
		$element_parent = val_select('#block_area_pattern');
		$check_enable = jQuery('#block_area_pattern option:selected').attr('disabled')?true:false;
		if($element_parent == 'Choose Area' || $check_enable  == true){
			alert_not('block_area_pattern');
			return false;
		}
		$current_lay = sessvars.current_lay?jQuery.trim(sessvars.current_lay):jQuery.trim(current_layout_ini);
		
		$this_parents_div = jQuery('.'+$element_parent.toLowerCase()+'_pattern').parent('div').attr('class');
		$path_pattern = jQuery('img', element).attr('src');
		if ($path_pattern.length===0){
			$path_pattern=jQuery('img', this).attr('data-href');
		}		///image preoloader validation	
		$path_pattern = $path_pattern.replace('_thumb', '');

		if($current_lay == 'layout_1'){
			if(no_item(element, '.'+$element_parent.toLowerCase()+'_pattern') == true){return;};
			jQuery('body .'+$element_parent.toLowerCase()+'_pattern').css({'display':'block', 'background': ' url('+$path_pattern+')'});
			if($element_parent == 'Content'){
				sessvars.wrap_content_pattern = 'url('+$path_pattern+')';//$path_pattern;
			}
			if($element_parent == 'Header'){
				sessvars.pattern_body_lay = $path_pattern;
			}
		}
		if($current_lay != 'layout_1' && $current_lay != 'layout_3' && $current_lay != 'layout_7'){
			if($element_parent == 'Body'){
				if(no_item(element, 'body') == true){sessvars.pattern_body_lay = "none"; return;};
				jQuery('body').css({'display':'block', 'background-image': ' url('+$path_pattern+')'});
				sessvars.pattern_body_lay = $path_pattern;
			}
			if($element_parent == 'Wrapper'){
				if(no_item(element, '.global_wrapper') == true){sessvars.wrap_content_pattern = "none"; return ;};
				jQuery('.global_wrapper').css({'display': 'block', 'background-image': ' url('+$path_pattern+')'});
				sessvars.wrap_content_pattern = 'url('+$path_pattern+')';//$path_pattern;
			}
		}
		if($current_lay == 'layout_3'){
			if($element_parent == 'Header'){
				if(no_item(element, '.wrap_lay3') == true){sessvars.pattern_body_lay = "none"; return;};
				jQuery('.wrap_lay3').css({'display': 'block', 'background-image': ' url('+$path_pattern+')'});
				sessvars.pattern_body_lay = $path_pattern;
			}else{
				if(no_item(element, '.'+$element_parent.toLowerCase()+'_pattern') == true){return;};
				jQuery('body .'+$element_parent.toLowerCase()+'_pattern').css({'display':'block', 'background': ' url('+$path_pattern+')'});
				if($element_parent == 'Content'){
					sessvars.wrap_content_pattern = 'url('+$path_pattern+')';//$path_pattern;
				}
			}
		}
		if($current_lay == 'layout_7'){
			if(no_item(element, '.wrap_lay7') == true){sessvars.wrap_content_pattern = "none"; return;};
			jQuery('.wrap_lay7').css({'display':'block', 'background-image': ' url('+$path_pattern+')'});
			sessvars.wrap_content_pattern = 'url('+$path_pattern+')';//$path_pattern;
		}
		sess_create('.'+$element_parent.toLowerCase()+'_pattern');
		too_image_preloader($path_pattern);
		return false;			 
	};
	
	// Search Box background-image
	jQuery('.set_header_search ul li a').click(function(){
		if(no_element(jQuery(this), '.search_area') == true){return;}
		$search_width = jQuery(this).attr('data-header-search-width');
		$search_height = jQuery(this).attr('data-header-search-height');
		$search_margin = 40-$search_height+($search_height/2);
		$this_src = jQuery('img', this).attr('src');
		if ($this_src.length===0){
			$this_src=jQuery('img', this).attr('data-href');
		}		///image preoloader validation		
		$flip = null;
		$split_this_src = $this_src.split('-');
		jQuery.each($split_this_src, function(i, e){
			if(e.indexOf('wtext_') > -1){$input_text_width = e.replace('wtext_', '')};
			if(e.indexOf('wsubm_') > -1){$input_subm_width = e.replace('wsubm_', '')};
			if(e.indexOf('color_') > -1){$input_text_color = e.replace('color_', '#')};
			if(e.indexOf('padd_') > -1){$search_padding = e.replace('padd_', '').replace('.png', '')};
			if(e.indexOf('flip') > -1){$flip = e?'flip':null;};
		});
		$this_src_ct = $this_src.replace(/\_thumb(.*?)png/g, ".png");
		$split_search_padding = $search_padding.split('_');
		var $p = []
		jQuery.each($split_search_padding, function(i,e){$p.push(e);});
		$p[3] = $p[3].replace('.png', '');
		jQuery('.search_area').css({'background-image': ' url('+$this_src_ct+')', 'height': $search_height-$p[0]-$p[2], 'width': $search_width-$p[1]-$p[3],
		'padding-top': $p[0]+'px', 'padding-right': $p[1]+'px', 'padding-bottom': $p[2]+'px', 'padding-left': $p[3]+'px', 'margin': ''+$search_margin+'px 0 0'});
		switch($flip){
			case 'flip':
			jQuery('.search_area input').css({'height': $search_height-$p[0]-$p[2], 'float': 'right'});
			break;
			case null:
			jQuery('.search_area input').css({'height': $search_height-$p[0]-$p[2], 'float': 'left'});
			break;
		};
		jQuery('.search_area input[type="text"]').css({'width': $input_text_width, 'color': $input_text_color});
		jQuery('.search_area input[type="submit"]').css({'width': $input_subm_width});
		sess_create('.search_area', '.search_area');
		sess_create('.search_area input[type="text"]', '.search_area input[type="text"]');
		sess_create('.search_area input[type="text"]', '.search_area input[type="text"]');
		sess_create('.search_area input[type="submit"]', '.search_area input[type="submit"]');
		too_image_preloader($this_src_ct);
	});
	
	// Menu
	jQuery.fn.menu = function(element) {
		if(no_element(jQuery(this), '.container_menu,.navbar') == true){return;}
		$menu_width = jQuery(element).attr('data-header-menu-width');
		$menu_middle_width = ($menu_width/2);
		$menu_height = jQuery(element).attr('data-header-menu-height');
		$font_color = jQuery(element).attr('data-font_color');
		$line_height = jQuery(element).attr('data-line_height');
		$font_size = jQuery(element).attr('data-font_size');
		$current_margin = jQuery(element).attr('data-current_margin');
		$current_top = jQuery(element).attr('data-current_top');
		$current_height = jQuery(element).attr('data-current_height');
		$font_family = jQuery(element).attr('data-font_family');
		$hover_menu = jQuery(element).attr('data-hover_menu');
		$menu_bkg = jQuery('img', element).attr('src');
		if ($menu_bkg.length===0){
			$menu_bkg=jQuery('img', this).attr('data-href');
		}		///image preoloader validation			
		$menu_bkg_ct = $menu_bkg.replace(/\_thumb(.*?)png/g, ".png");
		if($hover_menu == 'true'){
			$menu_bkg_current = $menu_bkg_ct.replace('.png', '_current.png');
			$menu_bkg_current =  'url('+$menu_bkg_current+')';
		}else{
			$menu_bkg_current = 'none';
		}
		jQuery('.container_menu').css({'background-image': 'url('+$menu_bkg_ct+')', 'height': $menu_height});
		jQuery('.container_menu ul ul').css('top', ($line_height/2)+20)
		jQuery('.container_menu ul li a').css({'line-height': ''+$line_height+'px', 'color': $font_color, 'font-size': parseInt($font_size), 'font-family': $font_family});
		jQuery('.container_menu ul li.back').css({'top': parseInt($current_top)});
		jQuery('.container_menu ul li.back .left').add('.container_menu ul li.back').css({'background-image': $menu_bkg_current, 'height': parseInt($current_height/2)});
		jQuery('.container_menu ul li.back .left').css({'margin-right': parseInt($current_margin)});
		$arr = ['.container_menu', '.container_menu ul li a', '.container_menu ul li.back .left', '.container_menu ul li.back']
		sessvars.menu_back = "'top': "+parseInt($current_top)+", 'background-image': '"+$menu_bkg_current+"', 'height': "+parseInt($current_height/2)+""
		jQuery.each($arr, function(i){
			sess_create($arr[i]);
		});
		too_image_preloader($menu_bkg_ct);
	}

	//submenu
	jQuery.fn.tgsubmenu= function(element){
		wptg_sub_menus(this);
	}

	/*function wptg_sub_menus tgsubmenu relationed*/
	function wptg_sub_menus(element){
		//console.log(jQuery(element));
		$submenu_bg=jQuery(element).data('subbg');
		jQuery('.container_menu ul ul').css({'background' : $submenu_bg});
		jQuery('.sf-menu li:hover,.sf-menu li.sfHover').css({'background' : 'rgba(10,10,10,0.1)'});
		$array=['.container_menu ul ul','.sf-menu li:hover','.sf-menu li.sfHover'];
		jQuery.each($array, function(i){
			sess_create($array[i]);
		});
		return false;
	}

	
	//Optional Menu
	$display_topbar = jQuery('.fullheader_menu_bar').css('display');
	if($display_topbar == 'block'){jQuery('.set_header_bar #menu_bar_show').attr('checked', 'checked')}
	jQuery('.lay_menu_bar input').click(function(){
		$this_val = jQuery(this).val();
		jQuery('.print').text($this_val);
		if($this_val == 'show'){
			jQuery('.fullheader_menu_bar').show();
			sess_create('.fullheader_menu_bar');
			sess_create('.header_menu_bar');
		}else{
			jQuery('.fullheader_menu_bar').hide();
			sess_create('.fullheader_menu_bar');
			sess_create('.header_menu_bar');
		}
	});
	jQuery('.set_header_bar ul li a').click(function(e){
		e.preventDefault();
		jQuery('.set_header_bar #menu_bar_show').trigger('click');
		$menu_bar_width = jQuery(this).attr('data-menu-bar-width');
		$menu_bar_height = jQuery(this).attr('data-menu-bar-height');
		$menu_bar_bkg = jQuery('img', this).attr('src');
	//	alert($menu_bar_bkg);
		if ($menu_bar_bkg.length===0){
			$menu_bar_bkg=jQuery('img', this).attr('data-href');
		}
		$menu_bar_bkg = $menu_bar_bkg.replace('_thumb', '');
		jQuery('.print').text($menu_bar_width +' '+ $menu_bar_height +' '+ $menu_bar_bkg);
		jQuery('.fullheader_menu_bar').css({'height': $menu_bar_height-4});
		jQuery('.header_menu_bar').css({'background': 'url('+$menu_bar_bkg+')', 'height': $menu_bar_height});
		sess_create('.fullheader_menu_bar');
		sess_create('.header_menu_bar');

		too_image_preloader($menu_bar_bkg);		
	});
	
	// Socials
	jQuery('.set_header_socials ul li a').click(function(){
       if(no_element(jQuery(this), 'ul.icon_socials') == true){return;}
       $header_social_width = jQuery(this).attr('data-header-social-width');
       $header_social_height = jQuery(this).attr('data-header-social-height');
       $header_social_bkg = jQuery('img', this).attr('src');
       if ($header_social_bkg.length===0){
               $header_social_bkg=jQuery('img', this).attr('data-href');
       }                ///image preoloader validation                
       $header_social_bkg = $header_social_bkg.replace('_thumb' ,'');
       $header_social_margin = 40-$header_social_height+($header_social_height/2);
       jQuery('ul.icon_socials').css('margin', ''+$header_social_margin+'px 10px 0');
       jQuery('div.container_element_hide ul.icon_socials li').each(function(e){
               $item_each = ($header_social_width/8);
               $item_bkg_pos = ($item_each*e);
               $this_class = jQuery('div.container_element_hide .icon_socials li:eq('+e+')').attr('class');                        
               jQuery('ul.icon_socials.show_element li.'+$this_class+', div.container_element_hide .icon_socials li.'+$this_class).css({
                       'background-image': 'url('+$header_social_bkg+')',
                       'background-position': -$item_bkg_pos+ 0,
                       'height': $header_social_height,
                       'width': $item_each
               });

//                        console.log(e,$this_class);                        
               sess_create('.icon_socials li.'+$this_class+'');
       });
       sess_create('ul.icon_socials');
       too_image_preloader($header_social_bkg);
	});
 
	// Set Shines //
	jQuery('.set_header_shines ul li a').click(function(){
		if(no_item(this, '.header_shine') == true){return;};
		$header_shine = jQuery('img', this).attr('src');
		if ($header_shine.length===0){
			$header_shine=jQuery('img', this).attr('data-href');
		}		///image preoloader validation
		$header_shine_bkg = $header_shine.replace(/\_thumb(.*?)png/g, ".png");
		jQuery('body .header_shine').css({'background-image': ' url('+$header_shine_bkg+')'});
		too_image_preloader($header_shine_bkg);
		sess_create('.header_shine');
	});

	/**
	 * [elem_origin_change Traslada elementos a traves del DOM cuando es necesario]
	 * @param  {[string]} applyTo [elemento contenedor: eleemnto al cual se va a hacer el traslado]
	 * @param  {[string]} el      [elemento a reubicar: Elemento a trasladar]
	 */
	function elem_origin_change(applyTo,el){  
	  	var element = jQuery(el);
	  	var elementStl = element.attr('style');
	  	var elementHtml = element.html();
	  	// console.log(clipartHtml,clipartStl);
	  	// console.log(clipart.length);
  		element.remove();
  		switch(el){
  			case '.clipart':
  				var template = '<div class="clipart" style="'+elementStl+'">'+elementHtml+'</div>';
  			break;
  			case '.wrapper_slider':
  				var template = '<div class="wrapper_slider" style="'+elementStl+'">'+elementHtml+'</div>';
  			break;
  		}
  		jQuery(applyTo).prepend(template);
	}
	// Set clipart bkg //
	jQuery("#bk_fix").click(function(){
		if (jQuery(this).attr("checked") == "checked"){
			jQuery('.clipart').css({'position':'fixed','background-position':'center 0'});
		  	sessvars['bkfixed']='true';
		  	elem_origin_change('.body_theme','.clipart');
		  	jQuery('.wrapper_content').css({'background-color':'transparent'});
		} else {
		 	$top_ini_clipart = jQuery.trim(sessvars.current_lay);
		 	$bkg_position=bkgposition($top_ini_clipart?$top_ini_clipart:'null');
		 	elem_origin_change('.wrapper_header','.clipart');
		 	jQuery('.clipart').css({'position':'absolute','background-position':$bkg_position});
		 	sessvars['bkfixed']='false';
		}
		sess_create('.clipart');
	});
	jQuery('.nivo-directionNav a, span.arrow a,.carousel-control,.nivo-prevNav,.nivo-nextNav').css({'top':(jQuery('.slider_content').height()/2)-jQuery('.nivo-prevNav').height()/2}); //ison
	jQuery.fn.clipart = function(element) {
		if(no_item(element, '.clipart') == true){return;};
		$header_bkgimage = jQuery('img', element).attr('src');
		if ($header_bkgimage.length===0){
			$header_bkgimage=jQuery('img', element).attr('data-href');
		}		///image preoloader validation		
		jQuery('img[src*="top"]', element).addClass('pos_bkgtop');
		$position_bkg = jQuery('img', element).hasClass("pos_bkgtop");
		$top_ini_clipart = jQuery.trim(sessvars.current_lay);
		$bkg_position=(sessvars.bkfixed==='true')?'center 0':bkgposition($top_ini_clipart?$top_ini_clipart:'null');
		$header_bkgimage_real = $header_bkgimage.replace(/\_thumb(.*?)png/g, ".png").replace(/\_thumb(.*?)jpg/g, ".jpg");
		jQuery('.print').text($header_bkgimage +' '+$header_bkgimage_real);
		jQuery('.clipart').css({'background-image': ' url('+$header_bkgimage_real+')', 'background-position': $bkg_position});
		sess_create('.clipart');
		too_image_preloader($header_bkgimage_real);
		return false;
	}

	function bkgposition(layout){
			var bkg_position = 'center bottom';
			switch(layout){
			case 'null':
				bkg_position = 'center bottom';
			break;
			case 'layout_1':
				bkg_position = 'center bottom';
			break;
			case 'layout_2':
				bkg_position = 'center top';
			break;
			case 'layout_3':
				bkg_position = 'center bottom';
			break;
			case 'layout_4':
				bkg_position = 'center top';
			break;
			case 'layout_5':
				bkg_position = 'center top';
			break;
			case 'layout_6':
				bkg_position = 'center top';
			break;
			case 'layout_7':
				bkg_position = 'center top';
			break;
		}
		return bkg_position;
	}
	

	var current_slider=jQuery('.set_slider_type input[name="slider_type"]:checked').val();	//get_slider current
	function get_current_slider(){
		return jQuery('.set_slider_type input[name="slider_type"]:checked').val();
	}
	jQuery.fn.setslider = function (element){
		$val = jQuery(element).val();
		sessionStorage.slider_area_type = $val;
		switch($val){
			case 'random':
			case 'random-top':
			case 'random-medium':
			case 'random-relative':
				jQuery('.page_layout').attr('disabled','disabled');
				jQuery('.page_layout + label').attr('title','Please, Select Another Slider Type to Change the Layout.');
			break;
			case 'j1':
			case 'j2':
			case 'j3':
			case 'j4':
			case 'j5':
			case 'j6':
			case 'j7':
			case 'j8':
				jQuery('.page_layout').attr('disabled','disabled');
				jQuery('.page_layout + label').attr('title','Please, Select Another Slider Type to Change the Layout.');
			break;
			default:
				jQuery('.page_layout').removeAttr('disabled');
				jQuery('.page_layout + label').removeAttr('title');
			break;
		}
		// if($val != 'random-top' && $val != 'random' && $val != 'random-relative' && $val != 'random-medium'){
		// 	jQuery('.page_layout').removeAttr('disabled');
		// 	jQuery('.page_layout + label').removeAttr('title');
		// }else{
		// 	jQuery('.page_layout').attr('disabled','disabled');
		// 	jQuery('.page_layout + label').attr('title','Please, Select Another Slider Type to Change the Layout.');
		// }
		/*if ($val='random-top'){
			$val='random';
		}*/
		$pack = jQuery(element).data('pack');
		dataty=($pack.shortcode)?'json':'html';
		//	console.log($pack);	
		$pack = JSON.stringify($pack);
		if($val=="No-Slider"){
			jQuery('#no_slider').attr('checked','checked');
			jQuery('.wrapper_slider').hide();
			sessvars.no_slider = 'true';
			//return false;// ultimo cambio para testinmonials,pages petenecientes a wts
			/*solucionar problema dl checked*/
		}else{
			jQuery('.wrapper_slider').show();
			sessvars.no_slider = 'false';
		}
		jQuery('.print').text($val);
		current_slider=$val;//assign new name for slider
		jQuery('.bar_menu_loading').show();
		jQuery.ajax({
			type: "POST",
			data: "slider_type="+$val+"&sldpack="+$pack+"&tg_idsession="+id_session,
			dataType:dataty
		}).done(function(data){
			//console.log(data);

			switch(dataty){
				case 'json':
					jQuery.fn.applyslider({'effect':$val,'sldpack':$pack,'html':data.html});
					jQuery('#fts').html(data.script);//aplica el script en el slider area
					sessionStorage.sldscript=data.script;
			//		console.log(data.html);
					jQuery('.ts-slider-area').css('visibility','inherit');
				break;
				default:
					jQuery.fn.applyslider({'effect':$val,'sldpack':$pack,'html':data});
				break;
			}
			jQuery('.bar_menu_loading').hide();
			/*console.log(data);
			return;*/
//			console.log(sessvars.current_lay.toString());
		}).error(	 function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR, textStatus, errorThrown);
		});
	}
	jQuery.fn.applyslider=function(opt){
		jQuery('.faker-right,.faker-left').remove();
		$val=opt.effect;
		$pack=opt.tPosition;
		data=opt.html;
		sessionStorage.sldhtml=data;
		delete opt.html;
		$struc_html_slider = '<div class="wrapper_slider">\
			<!-- layout slider -->\
			<div class="lay_base slider_pattern"></div>\
			<div class="lay_base slider_shadow"></div>\
			<div class="bar_separate content_separate" ></div>\
			<!-- end layout slider -->\
			<div class="slider_area" >\
				<div class="slider_content"></div><!-- end slider content -->\
			</div><!-- end slider area -->\
		</div>';
		$has_slider = jQuery('body').has('.wrapper_slider').length?'true':'false';
		if($has_slider == 'false'){
			if(jQuery.trim(sessvars.current_lay) == 'layout_2'){
				jQuery(".container_menu").after($struc_html_slider);
				jQuery('.wrapper_slider').show();
			}else{
				jQuery(".wrapper_header").after($struc_html_slider);
				jQuery('.wrapper_slider').show();
			}
		}

		jQuery(".slider_content").empty().append(data);
		//console.log(opt.sldpack);
		//		
		if(opt.sldpack && opt.sldpack!='"none"'){
			var sldpar = JSON.parse(opt.sldpack);
			sldpar.effect=$val;
		}
		jQuery('.slider_area').removeAttr
 
		if ( jQuery('.slider_area').attr( "data-sht" )=='1' ) {
		  jQuery('.slider_area,.slider_content').removeAttr( "data-sht"  );
		}		
		switch ($val){
			case 'No-Slider':
			case 'Piecemaker':
			case 'Nivo-Slider':
			case 'Easy-Accordion':
			case 'Featured-Slider':
			case 'fade':
			case 'sliceV':
			case 'slideV':
			case 'blockScale':
			case 'blindH':
			case 'blindV':
			case 'j1':
			case 'j2':
			case 'j3':
			case 'j4':
			case 'j5':
			case 'j6':
			case 'j7':
			case 'j8':		
				switch(sessvars.current_lay){
					case 'layout_1':
						jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').css('display','block');
					break;
					case 'layout_3':
						setTimeout(function(){
							jQuery('.slider_pattern, .header_separate, .header_shadow, .slider_shadow').hide();
						},400);
					break;
					case 'layout_2':
						setTimeout(function(){
							jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').hide();
						},400);
					case 'layout_4':
					case 'layout_5':
					case 'layout_6':
					case 'layout_7':
						setTimeout(function(){
							jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').hide();
						},400);
					break;
					default:
					break;
				}
				//jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').css('display','block');
				jQuery('.hideoncustomfull').css({'display':'inline-block'});
				jQuery('a[rel="set_slider_bkg_img"]').parent().show();
				jQuery('.wrapper_slider').css({padding:'20px 0'});
				$swf = jQuery('.swf_dummy .piecemaker');
				if(sessionStorage.slider_area_css_class){
					if(sessionStorage.slidrProvWidth){
						opt.w = sessionStorage.slidrProvWidth;
						opt.h = sessionStorage.slidrProvHeight;
					}else{
						opt.w = 900;
						opt.h = 366;
					}
					if(sessionStorage.slidrPadding == '0'){
						if(sessionStorage.slidrProvPadding)
							opt.p = sessionStorage.slidrProvPadding; 
						else
							opt.p = '20px 20px 0';
					}else{
						opt.p = sessionStorage.slidrProvPadding;
					}
					if(sessionStorage.slider_area_bg_img != 'none'){

						jQuery('.slider_area').addClass(sessionStorage.slidrClass).removeClass('tg-border-28');
//						jQuery('.slider_area').attr('style',sessvars['.slider_area_tmp']);
					}
				}else{
					opt.p =  sessionStorage.slidrProvPadding;
				}
				sessionStorage.slidrWidth = opt.w;
				sessionStorage.slidrHeight = opt.h;
				//console.log(sessionStorage.sliderType);
				jQuery('.wrapper_slider').css({'position':'relative','top':''});
				jQuery('.slider_area,.slider_content').width(opt.w).height(opt.h);
				jQuery('.slider_area').css({'padding':opt.p}).css({'padding-bottom':0});
				switch ($val){
					case 'j2':
						if(sessionStorage.slidrClass){
							jQuery('.slider_area').removeClass(sessionStorage.slidrClass);
						}
						jQuery('#ts_scrol_1 ul').css({'max-width':100});
						setTimeout(function(){
							jQuery('#ts_scrol_1').autoscroll();
						},400);
					case 'j7':
						if(sessionStorage.slidrClass){
							jQuery('.slider_area').removeClass(sessionStorage.slidrClass);
						}
						jQuery('#ts_scrol_1 ul').css({'max-width':'100%'});
						setTimeout(function(){
							jQuery('#ts_scrol_1').autoscroll();
						},400);
					case 'j1':
					case 'j3':
					case 'j4':
					case 'j5':
					case 'j6':
					case 'j8':
						if(sessionStorage.slidrClass){
							jQuery('.slider_area').removeClass(sessionStorage.slidrClass);
						}
						switch(sessvars.current_lay){
							case 'layout_3':
								setTimeout(function(){
									jQuery('.slider_pattern, .header_separate, .header_shadow, .slider_shadow').hide();
								},400);
							break;
							case 'layout_2':
								setTimeout(function(){
									jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').hide();
								},400);
							case 'layout_4':
							case 'layout_5':
							case 'layout_6':
							case 'layout_7':
								setTimeout(function(){
									jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').hide();
								},400);
							break;
							default:
							break;
						}
						if (!sessvars['.slider_area_tmp']){
							sesstmp_create('.slider_area_tmp','.slider_area');
						}
						jQuery('.slider_area,.slider_content').attr('data-sht','1');
						jQuery('a[rel="set_slider_bkg_img"]').parent().hide();
					break;
					case 'fade':
					case 'sliceV':
					case 'slideV':
					case 'blockScale':
					case 'blindH':
					case 'blindV':
						delete sessionStorage.slider_area_css_class;					
						jQuery.fn.scheduler(opt);
					break;
					case 'Featured-Slider':
						jQuery('.wrapper_slider .carousel-inner').attr('style',sessvars['.wrapper_slider .carousel-inner']);
						delete sessionStorage.slider_area_css_class;
					break;
					default:
						jQuery('.wtsCarousel,#wptg_Carousel').hide();
						delete sessionStorage.slider_area_css_class;
					break;
				}
				jQuery('.nivo-prevNav').attr('style',sessvars['.nivo-prevNav']);
				jQuery('.nivo-nextNav').attr('style',sessvars['.nivo-nextNav']);				
				jQuery('.t-top,.t-bottom,.t-left,.t-right,.t-none').remove();

			break;
			// case 'featured-poster':
			// 	$val = 'Featured-Slider'
			// 	sldpar.effect='Featured-Slider';
			// 	//jQuery.fn.scheduler($val,700,1200,2000,$pack,'20px 20px 0');
			// 	jQuery.fn.scheduler(sldpar);
			// 	jQuery('body .contentSlide').addClass('poster-feat');
			// 	// jQuery('body .contentSlide img').css({'float':'none','width':'80%'});
			// 	// jQuery('body .contentSlide h1').css({'font-size':120});
			// 	// jQuery('body .contentSlide p').css({'font-family':'Open Sans','font-size':40,'line-height':'40px','width':'100%'});
			// break;
			default:
				jQuery('a[rel="set_slider_bkg_img"]').parent().show();
				jQuery('.hideoncustom').hide();
				jQuery('.wrapper_slider').css({padding:'20px 0'});
				jQuery('.slider_content').attr('slider','img');
				sess_create('.slider_area');
				sess_create('.wrapper_content');
				sess_create('.wrapper_slider');
				sess_create('.slider_content');
				sess_create('.t-'+opt.tPosition);
				switch ($val){
					case 'random':
					case 'random-top':
					case 'random-relative':
					case 'random-medium':
						if (!sessvars['.slider_area_tmp']){
							sesstmp_create('.slider_area_tmp','.slider_area');
						}
					/*	sesstmp_create('.nivo-prevNav','.special-prev');
						sesstmp_create('.nivo-nextNav','.special-next');*/
					break;
					default:
						sesstmp_create('.slider_area_tmp','.slider_area');
					break;
				}
				/*para responsive tool*/
				sessionStorage.slidrWidth = opt.w;
				sessionStorage.slidrHeight =opt.h;
				sessionStorage.slidrPadding = opt.p;
				if (!sldpar){
					jQuery.fn.scheduler(opt);/*pasa aqui*/
				}else{
					jQuery.fn.scheduler(sldpar);
				}
				sess_create('.wrapper_slider');//para conservar los cambios el wrapper slider
				// jQuery('.t-top,.t-bottomm,.t-left,.t-right,.t-none').remove();
				// var optionslider={width:jQuery('.slider_area').width(),height:jQuery('.slider_area').height(),imgMarginTop: 0,imgMarginLeft:0}
				// func_slider($val,JSON.stringify(optionslider),'none','30000');
				// jQuery('.slider_content').css('visibility','inherit');
			break;
		}
		var s='.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow';
		var n=s.split(",");
		for (a in n){
			//	sess_create(n[a]);
		}		
		if(opt.sldpack && opt.sldpack!='"none"'){
			sessionStorage.sliderInfo = JSON.stringify(sldpar);	
		}else{
			sessionStorage.sliderInfo = JSON.stringify(opt);
		}
		sld_html=data;
	}
	jQuery('.set_slider_type input[type="radio"]').click(function(){
		jQuery.fn.setslider(this);
	});	
	/*Aplicando frames al slider*/
	jQuery('.set_slider_bkg_img ul li a').click(function(e){
		e.preventDefault();
		var tg_border;	
		if(jQuery(this).data('type')=='css'){
			jQuery('.slider_area').css('background-image','none');
			sessionStorage.slider_area_bg_img = 'none';
			var tg_border=jQuery(this).data('tg_border');
			if(sessionStorage.slidrClass){
				//console.log(sessionStorage.getItem('slider_area_css_class'));
				jQuery('.slider_area').removeClass(sessionStorage.slidrClass);
				sessionStorage.slider_area_css_class = tg_border;
				sessionStorage.slidrClass = tg_border;
			}else{
				sessionStorage.slidrClass = tg_border;
			}
			jQuery('.slider_area').addClass(tg_border);
			sessvars['sldfrm']=tg_border;
			jQuery('.thumbnails').show();
			jQuery('.nivo-directionNav a, span.arrow a,.carousel-control,.nivo-prevNav,.nivo-nextNav').css({'top':(jQuery('.slider_content').height()/2)-jQuery('.nivo-prevNav').height()/2}); //ison
		}else{
			jQuery('.thumbnails').hide();
			jQuery('.wrapper_slider').css({'position':'','z-index':''});
			jQuery('.slider_content').css({'padding':''});
			jQuery('#prev').removeClass('special-prev').addClass('nivo-prevNav');
			jQuery('#next').removeClass('special-next').addClass('nivo-nextNav');
			if(sessionStorage.slidrClass){
				jQuery('.slider_area').removeClass(sessionStorage.slidrClass);
				// delete sessionStorage.slidrClass;
			}
			// jQuery('.slider_area').width(900).height(366).css({'padding':20});
			// jQuery('.slider_content').width(900);
			// jQuery('.slider_content').height(366);
			$slider_frame = jQuery('img', this).attr('src');
			if ($slider_frame.length===0){
				$slider_frame=jQuery('img', this).attr('data-href');
			}		///image preoloader validation				
			$slider_frame_bkg = $slider_frame.replace(/\_thumb(.*?)png/g, "_frm.png");
			$slider_arr_bkg = $slider_frame.replace(/\_thumb(.*?)png/g, "_arr.png");
			$slider_frame_width = jQuery(this).attr('data-slider-frame-width');
			$slider_frame_height = jQuery(this).attr('data-slider-frame-height');
			$slider_arrows_width = jQuery(this).attr('data-slider_arrows_width');
			$slider_arrows_height = jQuery(this).attr('data-slider_arrows_height');
			$slider_arrows_top = jQuery(this).attr('data-slider_arrows_top');
			$slider_arrows_leftright = jQuery(this).attr('data-slider_arrows_leftright');
			$slider_imgsize = $slider_frame.split('-');
			jQuery.each($slider_imgsize,function(i, e){
				if(e.indexOf('padd_') > -1){$slider_padd = e.replace('padd_', '').replace('.png', '')}
			});
			$padding = $slider_padd.split('_');
			jQuery.each($padding,function(i){});
			jQuery(".nivo-directionNav a, span.arrow a,.carousel-control").css({'background-image': 'url('+$slider_arr_bkg+')', 'width': $slider_arrows_width/2, 'height': $slider_arrows_height});
			jQuery(".nivo-directionNav a, div.anythingSlider .arrow,.carousel-control").css({'top': $slider_arrows_top+'px'});
			jQuery(".nivo-prevNav, div.anythingSlider .back").css({'left': $slider_arrows_leftright+'px'});
			jQuery(".nivo-nextNav, div.anythingSlider .forward").css({'right': $slider_arrows_leftright+'px'});
			sld_w=$slider_frame_width-(parseInt($padding[1]*2));
			sld_h=$slider_frame_height-parseInt($padding[0]);	
			$paddingstr = parseInt($padding[0])+'px '+parseInt($padding[1])+'px 0';
			sessionStorage.slidrHeight = sld_h;
			sessionStorage.slidrWidth = sld_w;
			sessionStorage.slidrPadding = $paddingstr;
			sessionStorage.slidrProvPadding=$paddingstr;
			jQuery('.slider_area').css({'background-image': ' url('+$slider_frame_bkg+')', 'width':sld_w,
			'height': sld_h, 'padding': $paddingstr});
			$arrow_width = $slider_arrows_width/2;
			$arrow_height = $slider_arrows_height;
			$arrow_pos_abs_sides = $slider_arrows_leftright+'px';
			$arrow_pos_abs_top = $slider_arrows_top+'px';
			$arrow_pos_abs_width = $arrow_width+'px';
			$arrow_pos_abs_height = $arrow_height+'px';
			$arrow_pos_abs_bkg = 'url('+$slider_arr_bkg+')';
			sessvars['.nivo-prevNav'] = 'background-image: '+$arrow_pos_abs_bkg+'; width: '+$arrow_pos_abs_width+'; height: '+$arrow_pos_abs_height+'; top: '+$arrow_pos_abs_top+'; left: '+$arrow_pos_abs_sides+';';
			sessvars['.nivo-nextNav'] = 'background-image: '+$arrow_pos_abs_bkg+'; width: '+$arrow_pos_abs_width+'; height: '+$arrow_pos_abs_height+'; top: '+$arrow_pos_abs_top+'; right: '+$arrow_pos_abs_sides+';';
			sessvars['div.anythingSlider .back'] = 'top: '+$arrow_pos_abs_top+'; left: '+$arrow_pos_abs_sides+';';
			sessvars['div.anythingSlider .forward'] = 'top: '+$arrow_pos_abs_top+'; right: '+$arrow_pos_abs_sides+';';
			sessvars['.anythingSlider span.arrow a'] = 'background-image: '+$arrow_pos_abs_bkg+'; width: '+$arrow_pos_abs_width+'; height: '+$arrow_pos_abs_height+';';
			$arr = [".slider_area"];
			jQuery.each($arr, function(i, e){sess_create(e);})
			//jQuery.fn.scheduler('fade',900,366,1500,'none');
			cur_sld=get_current_slider();
			switch (cur_sld){
				case 'random':
				case 'random-top':
				case 'random-relative':
				case 'random-medium':
					cur_sld='fade';
				break;
				default:
					sesstmp_create('.slider_area_tmp','.slider_area');			
				break;
			}
			jQuery.fn.applyslider({'effect':cur_sld,'w':sld_w,'h':sld_h,'p':$paddingstr,'tPosition':'none','html':jQuery(".slider_content").html()});
			if(sessionStorage.slidrClass){
				jQuery('.slider_area').removeClass(sessionStorage.slidrClass);
			}
			sessionStorage.slidrProvPadding = jQuery('.slider_area').css('padding');
			sessionStorage.slidrProvWidth = sld_w;
			sessionStorage.slidrProvHeight = sld_h;
			too_image_preloader($slider_frame_bkg);
			if (sessvars['sldfrm']){
				delete sessvars['sldfrm'];
			}
		}
		sess_create('.slider_area');// guuarda las session del slider	
	});
	
	/*** content ***/
	
	jQuery('.set_content_bkg ul li a').click(function(e){
		e.preventDefault();
		$full_content_bkg = jQuery('img', this).attr('src');
		if ($full_content_bkg.length===0){
			$full_content_bkg=jQuery('img', this).attr('data-href');
		}		///image preoloader validation	
		jQuery('#preview_theme .wrapper_content').css({'background-image': ' url('+$full_content_bkg+')'});
	});
	// Widgets
	function widget_box(element){
		if(no_item_box(element, 'widget_boxes'))return;
		$data_token_right = jQuery(element).attr('data-token_right');
		$data_token_left = jQuery(element).attr('data-token_left');
		$data_token_bottom_widget = jQuery(element).attr('data-token_bottom_widget');
		$data_size_height = jQuery(element).attr('data-size_height');
		$widget_thumb = jQuery('img', element).attr('src');
		if ($widget_thumb.length===0){
			$widget_thumb=jQuery('img', element).attr('data-href');
		}		///image preoloader validation						
		$boxes_corner_bkg = $widget_thumb.replace('_thumb', '_cr');
		$boxes_sides_bkg = $widget_thumb.replace('_thumb', '_ss');
		$boxes_topbottom_bkg = $widget_thumb.replace('_thumb', '_tb');
		$boxes_center_bkg = $widget_thumb.replace('_thumb', '_ct');
		$boxes_token_right_bkg = $widget_thumb.replace('_thumb', '_token_right');
		if($data_token_right == 'true'){$data_token_right = 'url('+$widget_thumb.replace('_thumb', '_token_right')+')';}
		if($data_token_left == 'true'){$data_token_left = 'url('+$widget_thumb.replace('_thumb', '_token_left')+')';}
		if($data_token_bottom_widget == 'true'){$data_token_bottom_widget = 'url('+$widget_thumb.replace('_thumb', '_token_bottom-bwidget')+')';}
		jQuery('.boxes').removeClass(sessvars.current_boxcss_widget).removeClass('boxcss');
		sessvars.current_boxcss_widget = 'boxcss_default';
		jQuery('.widget_corner').css({'background-image': 'url('+$boxes_corner_bkg+')'})
		jQuery('.boxes').css({'margin-bottom': $data_size_height?$data_size_height+'px':0, 'padding': '20px'})
		jQuery('.widget_token_left').css({'background-image': $data_token_left});
		jQuery('.widget_token_right').css({'background-image': $data_token_right});
		jQuery('.widget_token_bottom').css({'background-image': $data_token_bottom_widget, 'height': $data_size_height?$data_size_height:0});
		jQuery('.widget_sides').css({'background-image': 'url('+$boxes_sides_bkg+')'});
		jQuery('.widget_topbottom').css({'background-image': 'url('+$boxes_topbottom_bkg+')'});
		jQuery('.container_widgets_pieces').css({'background-image': 'url('+$boxes_center_bkg+')'});
		jQuery('.wrapper_slider .carousel-inner').css({'background-image': 'url('+$boxes_center_bkg+')'});
		sessvars['.wrapper_slider .carousel-inner']='background-image:url('+$boxes_center_bkg+')';
		$arr = ['.boxes', '.container_widgets_pieces', '.widget_top_left', '.widget_top_center', '.widget_top_right', '.widget_middle_left', '.widget_content', '.widget_middle_right', '.widget_bottom_left',
		'.widget_bottom_center', '.widget_bottom_right', '.widget_token_right', '.widget_token_left',  '.widget_token_bottom'];
		jQuery.each($arr ,function(i){
			sess_create($arr[i]);
		});
		too_image_preloader($boxes_corner_bkg);
	}
	 function blog_boxes(element){
		if(no_item_box(element, 'post_boxes'))return;
		$data_token_right = jQuery(element).attr('data-token_right');
		$data_token_left = jQuery(element).attr('data-token_left');
		$data_token_bottom_post = jQuery(element).attr('data-token_bottom_post');
		$data_size_height = jQuery(element).attr('data-size_height');
		$post_thumb = jQuery('img', element).attr('src');
		if ($post_thumb.length===0){
			$post_thumb=jQuery('img', element).attr('data-href');
		}		///image preoloader validation					
		$boxes_corner_bkg = $post_thumb.replace('_thumb', '_cr');
		$boxes_sides_bkg = $post_thumb.replace('_thumb', '_ss');
		$boxes_topbottom_bkg = $post_thumb.replace('_thumb', '_tb');
		$boxes_center_bkg = $post_thumb.replace('_thumb', '_ct');
		$boxes_token_right_bkg = $post_thumb.replace('_thumb', '_token_right');
		if($data_token_right == 'true'){$data_token_right = 'url('+$post_thumb.replace('_thumb', '_token_right')+')';}
		if($data_token_left == 'true'){$data_token_left = 'url('+$post_thumb.replace('_thumb', '_token_left')+')';}
		jQuery('.blog_boxes').removeClass(sessvars.current_boxcss_post);
		jQuery('.blog_boxes').removeClass('reset_boxcss').removeClass('boxcss');
		sessvars.current_boxcss_post = 'boxcss_default';
		if($data_token_bottom_post == 'true'){$data_token_bottom_post = 'url('+$post_thumb.replace('_thumb', '_token_bottom-bpost')+')';}
		jQuery('.blog_boxes').css({'margin-bottom': $data_size_height?$data_size_height+'px':0});
		jQuery('.post_corner').css({'background-image': 'url('+$boxes_corner_bkg+')'});
		jQuery('.post_token_left').css({'background-image': $data_token_left});
		jQuery('.post_token_right').css({'background-image': $data_token_right});
		jQuery('.post_token_bottom').css({'background-image': $data_token_bottom_post, 'height': $data_size_height?$data_size_height:0});
		jQuery('.post_sides').css({'background-image': 'url('+$boxes_sides_bkg+')'});
		jQuery('.post_topbottom').css({'background-image': 'url('+$boxes_topbottom_bkg+')'});
		jQuery('.container_posts_pieces').css({'background-image': 'url('+$boxes_center_bkg+')'});
		$arr = ['.blog_boxes', '.container_posts_pieces', '.post_token_right', '.post_token_left', '.post_top_left', '.post_top_center', '.post_top_right', '.post_middle_left',
		'.post_content', '.post_middle_right', '.post_bottom_left', '.post_bottom_center', '.post_bottom_right', '.post_token_bottom'];
		jQuery.each($arr ,function(i){
			sess_create($arr[i]);
		});
		too_image_preloader($boxes_corner_bkg);				 
	}
	// |-> Blog 
	//Blog Box	
	jQuery('.set_blog_boxes ul.list_blog_boxes li a').click(function(e){
		e.preventDefault();
		if(jQuery(this).data('mode')=='css'){
			css_box(this);
		}else{
			box_render(this,jQuery('select[name="boxescss_choose"]').val());
		}
		return false;
	});
	/*Use for hide and show title post functionally*/
	if(jQuery('.selectBox').val()=='widgets'){
		jQuery('.selectBox_title').hide();
	}
	jQuery('.selectBox').live('change',function(){
		if(jQuery('.selectBox').val()=='widgets'){
			jQuery('.selectBox_title').hide();
		}else{
			jQuery('.selectBox_title').show();
		}
	});
	/*end hide and show title post functionally*/
	function box_render(element,mode){
		
		switch (mode){
			case 'widgets':
				widget_box(element);
			break;
			case 'posts':
				blog_boxes(element);
			break;
		}
	}
	
	// Demo Grid or List
	function lay_sidebar(){
		var new_lay_sidebar = {};
		$sidebar = jQuery('.sidebar_right, .sidebar_left, .sidebar_top, .sidebar_down').attr("data-pos", function(i, val){
			new_lay_sidebar[val] = {active: true};
		})
		var json_text = JSON.stringify(new_lay_sidebar, null, 2);
		return json_text;
	}

	function arg_text_logo(){

		$logo_type = jQuery('.logo img').css('display');
//		console.log($logo_type);
		if($logo_type == "none"){
			$logo_type = 'text';
		}else{
			$logo_type = 'image'
		}
		$text_logo = sessvars.text_logo?sessvars.text_logo:jQuery('#themeshock_text_logo').val();
		$text_logo_font_size = sessvars.text_logo_font_size?sessvars.text_logo_font_size:jQuery('#themeshock_font_size_logo').val();
		$text_logo_effect = sessvars.text_logo_effect?sessvars.text_logo_effect:jQuery('#themeshock_text_logo_effect').val();
		$text_logo_ffamily = sessvars.text_logo_ffamily?sessvars.text_logo_ffamily:jQuery('#themeshock_text_logo_ffamily').val();


		$arr = [$text_logo, $text_logo_font_size, $text_logo_effect, $text_logo_ffamily, $logo_type];
//		console.log(JSON.stringify($arr, null, 2));
		return JSON.stringify($arr, null, 2);
	}
		
	function posts_layouts(){
		$posts_layouts = jQuery('#post_grid').val();
		$grid_sizes = jQuery('.grid_sizebox:checked').val();
		$arr = [$posts_layouts, $grid_sizes];
		return JSON.stringify($arr, null, 2)
	}

		jQuery('#post_grid').change(function(){
			$this = jQuery(this).val();
			$coun_sidebar = jQuery('.sidebar_right, .sidebar_left').length;
			if($this == 'Grid'){
				jQuery('.opt_sizes_grid').show();
				jQuery('.head_post, .head_post .post_title').addClass('posts_grid');
				jQuery('.entry .entry_post, .comments_link').hide();
				jQuery('.entry .excerpt_post, .post_commts').css('display', 'block');
				$val_box_size = jQuery('.grid_sizebox:checked').val();
				if($val_box_size == 'Normal'){
					jQuery('.main_content, .main_content .blog_boxes, .sidebar_left, .sidebar_right').removeAttr('style');
					switch($coun_sidebar){
						case 0:
						jQuery('.main_content').css({'margin': 0, 'width': 960});
						jQuery('.main_content .blog_boxes').removeClass('blog_boxes_auto blog_boxes_260 blog_boxes_180');
						jQuery('.main_content .blog_boxes').addClass('blog_boxes_260');
						jQuery('.sidebar_left, .sidebar_right').css({'width': 300, 'margin': '0 10px'});
						break;
						case 1:
						jQuery('.main_content').css({'margin': 0, 'width': 640});
						jQuery('.main_content .blog_boxes').removeClass('blog_boxes_auto blog_boxes_260 blog_boxes_180');
						jQuery('.main_content .blog_boxes').addClass('blog_boxes_260');
						jQuery('.sidebar_left, .sidebar_right').css({'width': 300, 'margin': '0 10px'});
						break
						case 2:
						jQuery('.main_content').css({'margin': 0, 'width': 320});
						jQuery('.main_content .blog_boxes').removeClass('blog_boxes_auto blog_boxes_260 blog_boxes_180');
						jQuery('.main_content .blog_boxes').addClass('blog_boxes_260');
						jQuery('.sidebar_left, .sidebar_right').css({'width': 300, 'margin': '0 10px'});
						break;
					};
				}else if($val_box_size == 'Small'){
					jQuery('.main_content, .main_content .blog_boxes, .sidebar_left, .sidebar_right').removeAttr('style');
					switch($coun_sidebar){
						case 0:
						jQuery('.main_content').css({'margin': 0, 'width': 960});
						jQuery('.main_content .blog_boxes').removeClass('blog_boxes_auto blog_boxes_260 blog_boxes_180');
						jQuery('.main_content .blog_boxes').addClass('blog_boxes_180');
						jQuery('.sidebar_left, .sidebar_right').css({'width': 220, 'margin': '0 10px'});
						break;
						case 1:
						jQuery('.main_content').css({'margin': 0, 'width': 720});
						jQuery('.main_content .blog_boxes').removeClass('blog_boxes_auto blog_boxes_260 blog_boxes_180');
						jQuery('.main_content .blog_boxes').addClass('blog_boxes_180');
						jQuery('.sidebar_left, .sidebar_right').css({'width': 220, 'margin': '0 10px'});
						break
						case 2:
						jQuery('.main_content').css({'margin': 0, 'width': 480});
						jQuery('.main_content .blog_boxes').removeClass('blog_boxes_auto blog_boxes_260 blog_boxes_180');
						jQuery('.main_content .blog_boxes').addClass('blog_boxes_180');
						jQuery('.sidebar_left, .sidebar_right').css({'width': 220, 'margin': '0 10px'});
						break;
					};
				}
			}else if($this == 'List'){
				jQuery('.head_post, .head_post .post_title').removeClass('posts_grid');
				jQuery('.entry .entry_post, .comments_link').css('display', 'block');
				jQuery('.opt_sizes_grid, .entry .excerpt_post, .post_commts').hide();
					switch($coun_sidebar){
						case 0:
						jQuery('.main_content').css({'margin': 0, 'width': 960});
						jQuery('.main_content .blog_boxes').removeClass('blog_boxes_auto blog_boxes_260 blog_boxes_180');
						jQuery('.main_content .blog_boxes').addClass('blog_boxes_auto');
						jQuery('.sidebar_left, .sidebar_right').css({'width': 300, 'margin': '0 10px'});
						break;
						case 1:
						jQuery('.main_content').css({'margin': 0, 'width': 640});
						jQuery('.main_content .blog_boxes').removeClass('blog_boxes_auto blog_boxes_260 blog_boxes_180');
						jQuery('.main_content .blog_boxes').addClass('blog_boxes_auto');
						jQuery('.sidebar_left, .sidebar_right').css({'width': 300, 'margin': '0 10px'});
						break
						case 2:
						jQuery('.main_content').css({'margin': 0, 'width': 480});
						jQuery('.main_content .blog_boxes').removeClass('blog_boxes_auto blog_boxes_260 blog_boxes_180');
						jQuery('.main_content .blog_boxes').addClass('blog_boxes_auto');
						jQuery('.sidebar_left, .sidebar_right').css({'width': 220, 'margin': '0 10px'});
						break;
					};
			}
		}).change();
		jQuery('.opt_sizes_grid input').click(function(){
			jQuery('#post_grid').trigger('change');
		})
	//}
	
	jQuery('.set_view_post ul li a').click(function(e){
		e.preventDefault();
	});
	
	// Boxes css 
	sessvars.current_boxcss_widget = sessvars.current_boxcss_widget?sessvars.current_boxcss_widget:'boxcss_default';
	sessvars.current_boxcss_post = sessvars.current_boxcss_post?sessvars.current_boxcss_post:'boxcss_default';
	jQuery('.set_widgets_boxes_css ul li a').click(function(e){
		e.preventDefault();
		css_box(this);
	});
	function css_box(e){
		$boxescss_to = jQuery('select[name="boxescss_choose"]').val();
		if($boxescss_to == 'widgets'){
			$boxcss_widget = jQuery(e).attr('data-box_css');
			no_item_boxcss('widget_boxes');
			jQuery('.boxes').removeClass(sessvars.current_boxcss_widget);
			jQuery('.boxes').addClass($boxcss_widget);
			sessvars.current_boxcss_widget = $boxcss_widget;
			var bkg_css_sld='background:'+jQuery('.'+$boxcss_widget).css('background');
			sessvars['.wrapper_slider .carousel-inner']=bkg_css_sld;
			jQuery('.wrapper_slider .carousel-inner').attr('style',bkg_css_sld);
			$arr = ['.boxes', '.container_widgets_pieces', '.widget_top_left', '.widget_top_center', '.widget_top_right', '.widget_middle_left', '.widget_content', '.widget_middle_right', '.widget_bottom_left', '.widget_bottom_center', '.widget_bottom_right', '.widget_token_right', '.widget_token_left',  '.widget_token_bottom'];
			jQuery.each($arr ,function(i){
				sess_create($arr[i]);
			});
		}else if($boxescss_to == 'posts'){
			$boxcss_post = jQuery(e).attr('data-box_css');
			no_item_boxcss('post_boxes');
			jQuery('.blog_boxes').removeClass(sessvars.current_boxcss_post);
			jQuery('.blog_boxes').addClass($boxcss_post);
			sessvars.current_boxcss_post = $boxcss_post;
			$arr = ['.blog_boxes', '.container_posts_pieces', '.post_token_right', '.post_token_left', '.post_top_left', '.post_top_center', '.post_top_right', '.post_middle_left',
			'.post_content', '.post_middle_right', '.post_bottom_left', '.post_bottom_center', '.post_bottom_right', '.post_token_bottom'];
			jQuery.each($arr ,function(i){
				sess_create($arr[i]);
			});
		}	
	}
	
	// Comments
	jQuery('.set_blog_commts ul li a').click(function(e){
		e.preventDefault()
		$no_item = jQuery(this).attr('class');
		if($no_item == 'no_item'){
			jQuery('.comments_link').hide().removeClass('current_comments');
			jQuery('.post_commts').show().addClass('current_comments');
			jQuery('.head_post').css({'padding': '0 0 20px', 'display': ajust_width});
			sess_create('.comments_link');
			sess_create('.head_post');
			sess_create('.post_commts');
			return true;
		}
		$blog_commts_width = jQuery(this).attr('data-blog-commts-width');
		$blog_commts_height = jQuery(this).attr('data-blog-commts-height');
		$font_color = jQuery(this).attr('data-blog-commts_color');
		$line_height = jQuery(this).attr('data-line_height');
		$font_size = jQuery(this).attr('data-font_size');
		$blog_commts_bkg = jQuery('img', this).attr('src');
		if ($blog_commts_bkg.length===0){
			$blog_commts_bkg=jQuery('img', this).attr('data-href');
		}		///image preoloader validation			
		$blog_commts_bkg_ct = $blog_commts_bkg.replace(/\_thumb(.*?)png/g, ".png");
		$arr_blog_commts_bkg = $blog_commts_bkg.split('-');
		jQuery.each($arr_blog_commts_bkg, function(i){});
		jQuery('img[src*="flip"]').addClass('add_flip');
		$has_flipclass = jQuery('img', this).hasClass('add_flip');
		if($has_flipclass == true){
			$blog_commts_width = ($blog_commts_width/2)
		}
		$padding_title =  parseInt($blog_commts_width);
		$padding_title = ($padding_title+10);
		jQuery('.print').text($blog_commts_width +' '+ $blog_commts_height +' '+ $blog_commts_bkg +' '+ $padding_title);
		jQuery('.post_commts').hide().removeClass('current_comments');;
		jQuery('.comments_link').show().css({'font-size': parseInt($font_size), 'color': $font_color, 'background-image': 'url('+$blog_commts_bkg_ct+')', 'width': $blog_commts_width, 
		'height': $blog_commts_height, 'line-height': ''+$line_height+'px'}).addClass('current_comments');
		post_comments($padding_title);
		sess_create('.comments_link');
		sess_create('.post_commts');
		too_image_preloader($blog_commts_bkg_ct);
	});
	
	// Comments Position
	jQuery('.comments_position input').click(post_comments);
	function post_comments($padding_title){
		$blog_commts_width = jQuery('.comments_link').width();
		$padding_title = ($blog_commts_width+10);
		jQuery('.print').text($blog_commts_width  +' '+ $padding_title);
		var $this_value_position = '';
		jQuery('.comments_position input:checked').each(function(){
			$this_value_position = jQuery(this).val();
			switch($this_value_position){
				case 'left':
					jQuery('.head_post').css({'padding': '0 0 20px '+$padding_title+'px', 'display': ajust_width});
					jQuery('.comments_link').css({'left': '0', 'background-position': 'left top'});
				break; 
				case 'right': 
					jQuery('.head_post').css({'padding': '0 '+$padding_title+'px 20px 0', 'display': ajust_width});
					jQuery('.comments_link').css({'left': 'auto', 'background-position': 'right top'});
				break;
			}
			sess_create('.comments_link');
			sess_create('.head_post');
		}).trigger('each');
	}
	
	//Title
	jQuery('.text_align_position input').click(function(){
		$this_value = jQuery(this).val();
		if($this_value == 'left'){
			jQuery('.head_post').css({'text-align': 'left'})
		}else{
			jQuery('.head_post').css({'text-align': 'right'})
		}
		sess_create('.head_post');
	});
	
	//Author, Date, Categories
	function show_hiden_post($input_radio, $change_post_dac){
//		console.log($input_radio);
		jQuery('.show_hide_date_author input'+$input_radio+'').click(function(e){
			$this_val = jQuery(this).val();
			if($this_val == 'hide'){
				jQuery($change_post_dac).hide();
			}else{
				jQuery($change_post_dac).show().css('display', 'inline-block');
			}
			$arr = ['.post_date', '.post_author', '.post_categ', '.post_commts', '.post_tag'];
			jQuery.each($arr, function(i, e){
				sess_create(e);
			})
		});	
	}
	show_hiden_post('.post_date_sh', '.post_date');
	show_hiden_post('.post_author_sh', '.post_author');
	show_hiden_post('.post_cat_sh', '.post_categ');
	show_hiden_post('.post_cmm_sh', '.post_commts');
	show_hiden_post('.post_tag_sh', '.post_tag');
	
	//Background Author, Date, Categories, tag, commets
	jQuery('#select_icon_post').change(function(){
		var $this_val = '';
				$this_val = jQuery(this).val();
				jQuery('.group_iconpost').hide();
				jQuery('.show_'+$this_val).show();
	}).change();
	
	jQuery('.get_post_icons li a').click(function(e){
		e.preventDefault();
		$this_src = jQuery('img', this).attr('src');
		if ($this_src.length===0){
			$this_src=jQuery('img', this).attr('data-href');
		}		///image preoloader validation			
		$this_src = $this_src.replace('_thumb', '');
		$post_icons_width = jQuery(this).attr('data-post-icons-width');
		$post_icons_height = jQuery(this).attr('data-post-icons-height');
		$each_post_icon = ($post_icons_height/5);
		jQuery('.print').text($this_src +' '+ $post_icons_width +' '+ $post_icons_height +' '+ $each_post_icon);
		$each_post_icon = ($post_icons_height/5);
		jQuery('.post_icon').css({'background-image': 'url('+$this_src+')', 'height': $each_post_icon, 'line-height': ''+$each_post_icon+'px'});
		$arr = ['.post_author', '.post_date', '.post_categ', '.post_commts', '.post_tag'];
		jQuery.each($arr, function(i){
			jQuery($arr[i]).css({'background-position': '0 -'+($each_post_icon*i)+'px'});
			sess_create($arr[i]);
		});
		too_image_preloader($this_src);
	});
	// Post Image
	jQuery('.set_blog_image input').click(function(){
		$this_val = jQuery(this).val();
		switch($this_val){
			case 'left': jQuery('.featured_image').css({'float': 'left', 'margin': '0 10px 5px 0'});
			break;
			case 'right': jQuery('.featured_image').css({'float': 'right', 'margin': '0 0 5px 10px'});
			break;
		};
		sess_create('.featured_image');
	});
	
	//Read More
	jQuery('.set_read_more ul li a').click(function(e){
		e.preventDefault();
		$no_item = jQuery(this).attr('class');
		if($no_item == 'no_item'){
			jQuery('.more-link').css({
				'background': 'none', 
				'margin': 0,
				'padding': 0,
				'height': 'auto',
				'line-height': 'normal',
				'text-decoration': 'underline'
			});
			jQuery('.more-link_right, .more-link_left').hide();
			$arr = ['.more-link', '.more-link_left', '.more-link_right'];
			jQuery.each($arr, function(i){
				sess_create($arr[i]);
			});	
			return true;
		}
		$readmore_width = jQuery(this).attr('data-read_more-width');
		$readmore_middle_width = ($readmore_width/2);
		$readmore_height = jQuery(this).attr('data-read_more-height');
		$rm_color = jQuery(this).attr('data-rm_color');
		$line_height = jQuery(this).attr('data-line_height');
		$font_size = jQuery(this).attr('data-font_size');
		$readmore_bkg = jQuery('img', this).attr('src');
		if ($readmore_bkg.length===0){
			$readmore_bkg=jQuery('img', this).attr('data-href');
		}		///image preoloader validation				
		$readmore_ct_bkg = $readmore_bkg.replace(/\_thumb(.*?)png/g, "_ct.png");
		$readmore_ss_bkg = $readmore_ct_bkg.replace('ct', 'ss')
		jQuery('.more-link').css({
			'font-size': parseInt($font_size),
			'text-decoration': 'none', 'padding': '0 15px',
			'line-height': ''+$line_height+'px',
			'height': $readmore_height,
			'background-image': 'url('+$readmore_ct_bkg+')',
			'margin': '20px '+$readmore_middle_width+'px 0', 'color': $rm_color
		});
		jQuery('.more-link_left, .more-link_right').show().css({'background-image': 'url('+$readmore_ss_bkg+')', 'width': $readmore_middle_width});
		jQuery('.more-link_left').css({'left': -$readmore_middle_width});
		jQuery('.more-link_right').css({'right': -$readmore_middle_width});
		$arr = ['.more-link', '.more-link_left', '.more-link_right'];
		jQuery.each($arr, function(i){
			sess_create($arr[i]);
		});
		too_image_preloader($readmore_ss_bkg);	
	});
	jQuery('.set_read_more input').click(function(){
		$this_value = jQuery(this).val();
		if($this_value == 'left'){
			jQuery('.more-link').css({'float': 'left'})
		}else{
			jQuery('.more-link').css({'float': 'right'})
		}
		sess_create('.more-link');
	});
	
	// Footer 
	jQuery('.set_footer_bkg ul li a').click(function(e){
		e.preventDefault();
		$full_footer_bkg = jQuery('img', this).attr('src');
		if ($full_footer_bkg.length===0){
			$full_footer_bkg=jQuery('img', this).attr('data-href');
		}		///image preoloader validation						
		jQuery('#preview_theme .wrapper_footer').css({'background-image': ' url('+$full_footer_bkg+')'});
	});	

	// Footer info
	jQuery('.set_footer_info textarea').each(function(){
		jQuery(this).blur(function(){
			$str = jQuery(this).val();
			jQuery(".footer_info p").text($str);
			var $info_footer_val = jQuery(this).val();
		})
  	}).trigger('blur');
	
	////////////////// Global 
	function themeheading($base, $increment){
		$headings = ['h6', 'h5', 'h4', 'h3', 'h2', 'h1'];
		jQuery.each($headings, function(i, e){
			jQuery('.body_theme '+e+', .preview_font '+e+'').css({'font-size': ($base+$increment)});
			$increment = $increment+4;
		});
	}

	//////////Fonts 
	//Heading Size
	jQuery('.set_font_heading .choose_font_size input[type="radio"]').click(function(){
		$this_val = jQuery(this).val();
		switch($this_val){
			case 'small':
			themeheading(18, 0);
			break;
			case 'medium':
			themeheading(24, 0);
			break;
			case 'big':
			themeheading(32, 0);
			break;
		};
		$arr = ['.body_theme h1', '.body_theme h2', '.body_theme h3', '.body_theme h4', '.body_theme h5', '.body_theme h6'];
		jQuery.each($arr, function(i, e){
			sess_create(e);
		})
	});
	

	//Heading Font Family
	jQuery('.set_font_heading .choose_font_family select').change(function(){
		$this_val = jQuery(this).val();
		jQuery('.body_theme h1, .body_theme h2, .body_theme h3, .body_theme h4, .body_theme h5, .body_theme h6').css({'font-family': $this_val});
		$arr = ['.body_theme h1', '.body_theme h2', '.body_theme h3', '.body_theme h4', '.body_theme h5', '.body_theme h6'];
		jQuery.each($arr, function(i, e){
			sess_create(e);
		})
	})//.change();
	//Heading Font Colors
	jQuery('.set_font_heading .choose_font_color li a').click(function(e){
		e.preventDefault();
		$this_val = jQuery(this).css('background-color');
		jQuery('.body_theme h1, .body_theme h2, .body_theme h3, .body_theme h4, .body_theme h5, .body_theme h6').css({'color': $this_val});
		$arr = ['.body_theme h1', '.body_theme h2', '.body_theme h3', '.body_theme h4', '.body_theme h5', '.body_theme h6'];
		jQuery.each($arr, function(i, e){
			sess_create(e);
		})
	});

	//Heading Font Colors
	jQuery('.set_font_body .choose_font_size input[type="radio"]').click(function(){
		$this_val = jQuery(this).val();
		jQuery('.body_theme, .preview_font').css({'font-size': $this_val});
		sess_create('.body_theme');
	});	
	jQuery('.set_font_body .choose_font_family select').change(function(){
		$this_val = jQuery(this).val();
		jQuery('.body_theme, .preview_font').not(".container_menu ul li a").css({'font-family': $this_val});
		sess_create('.body_theme');
	});
	jQuery('.set_font_body .choose_font_color a').click(function(e){
		e.preventDefault();
		$this_val = jQuery(this).css('background-color');
		jQuery('.body_theme, .preview_font p').css({'color': $this_val});
		sess_create('.body_theme');
	});
	
	
	// Palettes Content
		jQuery('.alert_select').click(function(e){
			e.stopPropagation();
		})
	
	//Palette color position select
	jQuery('div.set_palettes').scroll(function(e){
		$pos_scroll= jQuery('div.set_palettes').scrollTop();
		jQuery('.print').text($pos_scroll +' '+current_lay());
		if(current_lay() == 'layout_1'){
			if($pos_scroll <= 850){
				jQuery('.lay_palette').css({'position': 'relative'});
				jQuery('.lay_palette .container_fixed').css({'position': 'relative'});
			}
			if($pos_scroll >= 851){
				jQuery('.lay_palette').css({'position': 'absolute'});
				jQuery('.lay_palette .container_fixed').css({'position': 'fixed'});
			}
		}
	});
	
	jQuery('a[rel="set_palettes"]').click(function(){
		if(current_lay() == 'layout_1'){
			jQuery('.lay_palette').css({'position': 'relative'});
			jQuery('.lay_palette .container_fixed').css({'position': 'relative'});
			jQuery('.set_palettes').css('padding', '0');
		}else{
			jQuery('.lay_palette').css({'position': 'absolute'});
			jQuery('.lay_palette .container_fixed').css({'position': 'fixed'});
			jQuery('.set_palettes').css('padding', '70px 0 0')
		}
	});

	// Single	
	jQuery('.set_palettes ul.set_palettes_single li a').click(function(e){
		e.preventDefault();
		$palette_parent = val_select('#block_area_palette');
		$check_enable = jQuery('#block_area_palette option:selected').attr('disabled')?true:false;
		if($palette_parent == 'Choose Area' || $check_enable  == true){
			alert_not('block_area_palette');
			return false;
		}
		$palette_parent = val_select('#block_area_palette');
		$palette_color = jQuery(this).css('background-color');
		jQuery('.print').text($palette_color);
		$current_lay = sessvars.current_lay?jQuery.trim(sessvars.current_lay):current_layout_ini;
		if($palette_parent == 'Slider'){
			jQuery('.wrapper_slider').css({'background-color': $palette_color});
			sessvars.slider_bkcolor = $palette_color;
		}
		if($palette_parent == 'Content'){
			jQuery('.wrapper_content').css({'background-color': $palette_color});
			sessvars.wrap_bk_color = $palette_color;
		}
		if($palette_parent == 'Header and footer'){
			jQuery('body').css({'background-color': $palette_color});
		}
		if($palette_parent == 'Wrapper'){
			jQuery('.global_wrapper').css({'background-color': $palette_color});
			sessvars.wrap_bk_color = $palette_color;
		}
		if($palette_parent == 'Body'){
			if($current_lay == 'layout_7'){
				jQuery('.wrap_lay7').css({'background-color': $palette_color});
				sessvars.wrap_bk_color = $palette_color;
			}else{
				
				jQuery('body').css({'background-color': $palette_color});
			}
		}
		$arr = ['.wrapper_header', '.wrapper_content', '.wrapper_slider', '.wrapper_footer', 'body', '.global_wrapper'];
		jQuery.each($arr, function(i){
			sess_create($arr[i]);	
		});
	});

	// Bichome
	jQuery('.set_palettes ul.set_palettes_bichrome li a').click(function(e){
		e.preventDefault();
		$palette_color = jQuery(this).css('background-color');
		$second_color = jQuery("b", this).css('background-color');
		jQuery('.print').text($palette_color);
		jQuery('body').css({'background-color': $palette_color});
		jQuery('.wrapper_slider').css({'background-color': $second_color});	
		sessvars.slider_bkcolor = $second_color;
		$arr = ['.wrapper_content', '.wrapper_slider', 'body'];
		jQuery.each($arr, function(i){
			sess_create($arr[i]);	
		});
	});	
	function open_colorPicker($current_click, $app_colorpicker){
		jQuery($current_click).ColorPicker({
			color: '#8f8f8f',
			onShow: function (colpkr){
				jQuery(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				jQuery(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb){
				jQuery($current_click).add($app_colorpicker).css('backgroundColor', '#' + hex);
				$arr = ['.wrapper_content', '.wrapper_slider', 'body'];
				sess_create('.container_menu ul ul');
				jQuery.each($arr, function(i){
					sess_create($arr[i]);	
				});
				jQuery('.print').text($app_colorpicker);
			}		
		});		
	}

	function open_colorPicker_submenu($current_click, $app_colorpicker){
		jQuery($current_click).ColorPicker({
			color: '#8f8f8f',
			handlerDiv: '#header_pckr',
			onShow: function (colpkr){
				jQuery('.container_menu ul ul:first').show('slow');
				jQuery(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				jQuery(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb){
				jQuery($current_click).add($app_colorpicker).css('backgroundColor', '#' + hex);
				sess_create('.container_menu ul ul');
				jQuery('.print').text($app_colorpicker);
			}	
		});		
	}
	
	function open_colorPicker_single($current_click, $app_colorpicker){
		jQuery($current_click).ColorPicker({
			color: '#8f8f8f',
			onShow: function (colpkr) {
				$val_select = val_select('#block_area_palette');
				jQuery('.print').text($val_select);
				$check_enable = jQuery('#block_area_palette option:selected').attr('disabled');
				$current_lay = sessvars.current_lay?sessvars.current_lay:current_layout_ini;
				if($val_select == 'Choose Area' || $check_enable  == true){
					alert_not('block_area_palette');
					return false;
				}else{
					switch ($val_select){
						case 'Content':
						curr_val_select = '.wrapper_content';
						break;
						case 'Slider':
						curr_val_select = '.wrapper_slider';
						break;
						case 'Header and footer':
						curr_val_select = 'body';
						break;
						case 'Body':
						if($current_lay == 'layout_7'){
							curr_val_select = '.wrap_lay7';
						}else{
							curr_val_select = 'body';
						}
						break;
						case 'Wrapper':
						curr_val_select = '.global_wrapper';
						break;

					}
					jQuery(colpkr).fadeIn(500);
				}
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				jQuery(curr_val_select).css('backgroundColor', '#' + hex);
				$hex = '#' + hex;
			},
			onHide: function (colpkr) {
				jQuery(colpkr).fadeOut(500);
				switch ($val_select){
					case 'Content':
					sessvars.wrap_bk_color = $hex;
					break;
					case 'Slider':
					sessvars.slider_bkcolor = $hex;
					break;
					case 'Body':
					if($current_lay == 'layout_7'){
						sessvars.wrap_bk_color = $hex;
					}
					break;
					case 'Wrapper':
					sessvars.wrap_bk_color = $hex;
					break;
				}
				$arr = ['.wrapper_header', '.wrapper_content', '.wrapper_slider', '.wrapper_footer', '.global_wrapper', 'body'];
				jQuery.each($arr, function(i){
					sess_create($arr[i]);
				});
				return false;
			}
		});
	}

	open_colorPicker_single('.color_picker_single', 'body');
	open_colorPicker('.color_picker1', 'body');
	open_colorPicker('.color_picker2', '.wrapper_slider');
	open_colorPicker_submenu('.tgsbmn', '.container_menu ul ul');
	

	// Close Panel
	jQuery('body').click(function(e){
	var container = jQuery("#main_settings");
	//console.log(container.has(e.target).length );
		 if (container.has(e.target).length === 0) {
				jQuery('.sub_panel, .set_lay_page, .area_save_local,.upload_wtg,.save_flt').hide();
		}
		if (!jQuery(e.target).closest('.upload_wtg').length) {
			switch (e.target.name){
				case 'pattern':
				case 'logo':
				case 'divisors':
				case 'clipart':
				case 'menu':
				case 'shadows':
					jQuery('.upload_wtg').show();
				break;
			}
		}
	})
	// Open Panel
	jQuery('.sub_panel').click(function(e){
		e.stopPropagation();
	})
	/* sess_create
	* Crea un objeto con las propiedades css de un elemento
	* @param $container(string)
	*/
	function sess_create($container){
		$style = jQuery($container).attr('style');
		sessvars[$container] = new Object();
		sessvars[$container] = $style?$style:'none';
	}
	/* Improve! */
	/* sesstmp_create
	* Crea un objeto con las propiedades css de un elemento para añadirlos en el reload del page
	* @param $container(string)
	* @param $selector(string)
	*/
	function sesstmp_create($container, $selector){
		$style = jQuery($selector).attr('style');
		sessvars[$container] = new Object();
		sessvars[$container] = $style?$style:'none';
	}
	// Function get all sessions 
	/* get_sess
	* Obtiene todas las variables de session del los parametros del css para el theme
	* @param $container(string)
	*/
	function get_sess($container){
		if(sessvars[$container]?sessvars[$container]:'null' != 'null'){
			//console.log($container);
			jQuery($container).attr('style', sessvars[$container]);
			switch($container){
				case '.container_menu ul ul':
					jQuery($container).hide();
				break;
				case '.clipart':
					var position = jQuery($container).css('position'); 
					if(position=='fixed'){
						jQuery('#bk_fix').attr('checked','checked');
					}
				break;
			}
		}
	}	// Get all sessions 
	
	/*NOTA IMPORTANTE: On Window Recharge pls include the element class or id */
	$get_sess_arr = ['.search_area', '.search_area input[type="submit"]', '.search_area input[type="text"]', '.search_area input[type="text"]', '.clipart','.slider_content','.wrapper_slider', '#header', '.header_shine', '.container_menu', '.container_menu ul li a', '.container_menu ul li.back .left', '.container_menu ul li.back', '.icon_socials li.ic_facebook', 'ul.icon_socials',  '.icon_socials li.ic_twitter', '.icon_socials li.ic_rss', '.icon_socials li.ic_mail', '.icon_socials li.ic_plus', '.icon_socials li.ic_linkedin', '.icon_socials li.ic_rssmail', '.icon_socials li.ic_skype', '.slider_pattern', '.content_pattern', '.footer_pattern', '.wrapper_header', '.global_wrapper', '.header_pattern', '.header_separate', '.content_separate', '.footer_separate', '.nivo-directionNav a', '.anythingSlider span.arrow a', '.nivo-prevNav', 'div.anythingSlider .back', '.nivo-nextNav', 'div.anythingSlider .forward', '.slider_area', '#accordion-slider', '#piecemaker', '#slider', '.header_shadow', '.slider_shadow', '.content_shadow', '.footer_shadow', '.blog_boxes', '.container_posts_pieces', '.post_top_left', '.post_top_center', '.post_top_right', '.post_middle_left', '.post_content', '.post_middle_right', '.post_bottom_left', '.post_bottom_center', '.post_bottom_right', '.post_token_bottom', '.post_token_right', '.post_token_left', '.boxes', '.container_widgets_pieces', '.widget_top_left', '.widget_top_center', '.widget_top_right', '.widget_middle_left', '.widget_content', '.widget_middle_right', '.widget_bottom_left', '.widget_bottom_center', '.widget_bottom_right', '.widget_token_bottom', '.widget_token_right', '.widget_token_left', '.fullheader_menu_bar', '.header_menu_bar', '.wrapper_content', '.wrapper_slider', '.wrapper_footer', 'body', '.comments_link', '.post_author', '.post_date', '.post_categ', '.post_commts', '.more-link', '.more-link_left', '.more-link_right', '.head_post', '.head_post h2', '.body_theme', '.body_theme h1', '.body_theme h2', '.body_theme h3', '.body_theme h4', '.body_theme h5', '.body_theme h6','.container_menu ul ul']; 
	jQuery.each($get_sess_arr, function(i){
		switch($get_sess_arr[i]){
			/*case '.container_menu ul li.back':
			case '.container_menu ul li.back .left':
			case '.container_menu ul li a':
				console.log($get_sess_arr[i]);			
			break;	*/
			default:
					get_sess($get_sess_arr[i]);
			break;
		}
	});


	/************************* TESTER *******************************/

	/************************* END AREA TESTER *******************************/

	var obj_sess_tmp = {
		'body_lay_tmp': 'body',
		'.clipart_lay_tmp': '.clipart',
		'.wrapper_header_lay_tmp':'.wrapper_header',
		'#header_lay_tmp':'#header',
		'.wrap_lay2_lay_tmp':'.wrap_lay2',
		'.wrap_lay3_lay_tmp':'.wrap_lay3',
		'.wrap_lay4_lay_tmp':'.wrap_lay4',
		'.wrap_lay5_lay_tmp':'.wrap_lay5',
		'.wrap_lay6_lay_tmp':'.wrap_lay6',
		'.wrap_lay7_lay_tmp':'.wrap_lay7',
		'.global_wrapper':'.global_wrapper',
		'.slider_shadow_lay_tmp': '.slider_shadow',
		'.footer_shadow_lay_tmp':'.footer_shadow',
		'.footer_pattern_lay_tmp':'.footer_pattern',
		'.header_pattern_lay_tmp': '.header_pattern',
		'.header_separate_lay_tmp': '.header_separate',
		'.slider_separate_lay_tmp': '.slider_separate',
		'.content_shadow_lay_tmp': '.content_shadow',
		'.content_separate_lay_tmp': '.content_separate',
		'.wrapper_slider_lay_tmp': '.wrapper_slider',
		'.slider_pattern_lay_tmp': '.slider_pattern',
		'.wrapper_content_lay_tmp': '.wrapper_content',
		'.content_pattern_lay_tmp': '.content_pattern'
	};


	jQuery.each(sessvars, function(k, e){
		if(e == 'none' || k == ''){delete sessvars[k]}
	});
	jQuery.each($get_sess_arr, function(i, e){
		delete sessvars[e+'_tmp']
		
	});
	if(sessvars.loader){check_layout_current()}
	/* check_layout_current
	 * Realiza un check sobre el tema actual y verifica los parametros css de cada elemento de acuerdo al layout(1-7)
	 */
	function check_layout_current(){
		sessvars.current_lay = jQuery.trim(sessvars.current_lay?sessvars.current_lay:current_layout_ini);
		if(sessvars.current_lay=='layout_1'){
			build_layout('.set_lay_page ul input[value="lay_1"]');
			jQuery('.set_lay_page ul input[value="lay_1"]').attr('checked',true);
			if(jQuery('#bk_fix').is(':checked')){
				elem_origin_change('.body_theme','.clipart');
			}
		}
		if(sessvars.current_lay=='layout_2'){
			build_layout('.set_lay_page ul input[value="lay_2"]');
			jQuery('.set_lay_page ul input[value="lay_2"]').attr('checked',true);
			// elem_origin_change('.body_theme','.wrapper_slider');
		}
		if(sessvars.current_lay=='layout_3'){
			build_layout('.set_lay_page ul input[value="lay_3"]');
			jQuery('.set_lay_page ul input[value="lay_3"]').attr('checked',true);
		}
		if(sessvars.current_lay=='layout_4'){
			build_layout('.set_lay_page ul input[value="lay_4"]');
			jQuery('.set_lay_page ul input[value="lay_4"]').attr('checked',true);
		}
		if(sessvars.current_lay=='layout_5'){
			build_layout('.set_lay_page ul input[value="lay_5"]');
			jQuery('.set_lay_page ul input[value="lay_5"]').attr('checked',true);
		}
		if(sessvars.current_lay=='layout_6'){
			build_layout('.set_lay_page ul input[value="lay_6"]');
			jQuery('.set_lay_page ul input[value="lay_6"]').attr('checked',true);
		}
		if(sessvars.current_lay=='layout_7'){
			build_layout('.set_lay_page ul input[value="lay_7"]');
			jQuery('.set_lay_page ul input[value="lay_7"]').attr('checked',true);
		}
	}

	/* element css
	* Asignar un un color o una imagen especifica en caso de que el bg-image o el bg-color se encuentren vacios
	*/
	function elements_css($elements){
		$bkg_color = 'background-color';
		$bkg_image = 'background-image';
		jQuery.each($elements, function(i, e){
			$this = jQuery(e);
			jQuery(e).css({
				$bkg_color: $this.css($bkg_color)?$this.css($bkg_color):'transparent',
				$bkg_image: $this.css($bkg_image)?$this.css($bkg_image):'none'
			})
		})
	}
	
	
	function vars_layouts($layout_2, $layout_3, $layout_4, $layout_5, $layout_6, $layout_7){
		if($layout_2 == 'true'){
			$header_pattern = sessvars.pattern_body_lay?'url('+sessvars.pattern_body_lay+')':jQuery('body').css('background-image');
			$wrapper_content_bgcolor = sessvars.wrap_bk_color?sessvars.wrap_bk_color:jQuery('.wrap_lay2').css('background-color');
			$content_bkg_pattern = sessvars.wrap_content_pattern?sessvars.wrap_content_pattern:jQuery('.wrap_lay2').css('background-image');
		}
		if($layout_3 == 'true'){	
			$header_pattern = sessvars.pattern_body_lay?'url('+sessvars.pattern_body_lay+')':jQuery('.wrap_lay3').css('background-image');
			$wrapper_content_bgcolor = sessvars.wrap_bk_color?sessvars.wrap_bk_color:jQuery('.wrapper_content').css('background-color');
			$content_bkg_pattern = sessvars.wrap_content_pattern?sessvars.wrap_content_pattern:jQuery('.content_pattern').css('background-image');
		}
		if($layout_4 == 'true'){
			$header_pattern = sessvars.pattern_body_lay?'url('+sessvars.pattern_body_lay+')':jQuery('body').css('background-image');
			$wrapper_content_bgcolor = sessvars.wrap_bk_color?sessvars.wrap_bk_color:jQuery('.wrap_lay4').css('background-color');
			$content_bkg_pattern = sessvars.wrap_content_pattern?sessvars.wrap_content_pattern:jQuery('.wrap_lay4').css('background-image');
		}
		if($layout_5 == 'true'){
			$header_pattern = sessvars.pattern_body_lay?'url('+sessvars.pattern_body_lay+')':jQuery('body').css('background-image');
			$wrapper_content_bgcolor = sessvars.wrap_bk_color?sessvars.wrap_bk_color:jQuery('.wrap_lay5').css('background-color');
			$content_bkg_pattern = sessvars.wrap_content_pattern?sessvars.wrap_content_pattern:jQuery('.wrap_lay5').css('background-image');
		}
		if($layout_6 == 'true'){
			$header_pattern = sessvars.pattern_body_lay?'url('+sessvars.pattern_body_lay+')':jQuery('body').css('background-image');
			$wrapper_content_bgcolor = sessvars.wrap_bk_color?sessvars.wrap_bk_color:jQuery('.wrap_lay6').css('background-color');
			$content_bkg_pattern = sessvars.wrap_content_pattern?sessvars.wrap_content_pattern:jQuery('.wrap_lay6').css('background-image');
		}
		if($layout_7 == 'true'){
			$header_pattern = sessvars.pattern_body_lay?'url('+sessvars.pattern_body_lay+')':jQuery('body').css('background-image');
			$wrapper_content_bgcolor = sessvars.wrap_bk_color?sessvars.wrap_bk_color:jQuery('.wrap_lay7').css('background-color');
			$content_bkg_pattern = sessvars.wrap_content_pattern?sessvars.wrap_content_pattern:jQuery('.wrap_lay7').css('background-image');
		}
		if($layout_2 == 'false' && $layout_3 == 'false' && $layout_4 == 'false' && $layout_5 == 'false' && $layout_6 == 'false' && $layout_7 == 'false'){
			$header_pattern = sessvars.pattern_body_lay?'url('+sessvars.pattern_body_lay+')':jQuery('.header_pattern').css('background-image');
			$wrapper_content_bgcolor = sessvars.wrap_bk_color?sessvars.wrap_bk_color:jQuery('.wrapper_content').css('background-color');
			$content_bkg_pattern = sessvars.wrap_content_pattern?sessvars.wrap_content_pattern:jQuery('.content_pattern').css('background-image');
			sessvars.slider_bkcolor = jQuery('.wrapper_slider').css('background-color')?jQuery('.wrapper_slider').css('background-color'):"";
		}
	}
	/************************ LAYOUT AREA ********************/
	jQuery('.set_lay_page').click(function(e){e.stopPropagation()});
	jQuery('.set_lay_page ul input[type="radio"]').click(function(e){e.stopPropagation();build_layout(this)});
	function build_layout($selector){
		var clipart_bkg_image = jQuery('.clipart').css('background-image');
		var body_bkg_color = jQuery('body').css('background-color');
		var slider_pattern = jQuery('.slider_pattern').css('background-image');
		/*availabilty for layouts*/
		jQuery($selector).each(function(e){
			$this_val = jQuery(this).val();
			var $get_layout = sessvars.current_lay;
			$bkg_position=(sessvars.bkfixed==='true')?'center 0':bkgposition($this_val);
			var $layout_2 = jQuery('body').has('.wrap_lay2').length?'true':'false';
			var $layout_3 = jQuery('body').has('.wrap_lay3').length?'true':'false';
			var $layout_4 = jQuery('body').has('.wrap_lay4').length?'true':'false';
			var $layout_5 = jQuery('body').has('.wrap_lay5').length?'true':'false';
			var $layout_6 = jQuery('body').has('.wrap_lay6').length?'true':'false';
			var $layout_7 = jQuery('body').has('.wrap_lay7').length?'true':'false';
			function reset_container(){
				jQuery(".wrap_lay2, .wrap_lay3, .wrap_lay4, .wrap_lay5, .wrap_lay6, .wrap_lay7").replaceWith(function(){
					return jQuery(this).contents();
				});
			}
			switch($this_val){
				case 'lay_1':
					$clipart_bkg = jQuery('.clipart').css('background-image');
					vars_layouts($layout_2, $layout_3, $layout_4, $layout_5, $layout_6, $layout_7);
					if($layout_2 == 'false' && $layout_3 == 'false' && $layout_4 == 'false' && $layout_5 == 'false' && $layout_6 == 'false' && $layout_7 == 'false'){
						$header_pattern =  sessvars.pattern_body_lay?'url('+sessvars.pattern_body_lay+')':jQuery('.header_pattern').css('background-image');
						$wrapper_content_bgcolor = sessvars.wrap_bk_color?sessvars.wrap_bk_color:jQuery('.wrapper_content').css('background-color');
						if(sessvars.theme_change){
							if(!sessvars[".content_pattern"]){
								$content_bkg_pattern = sessvars["content_pattern_wka"]?sessvars["content_pattern_wka"]:jQuery('.wrapper_content').css('background-image');
							}else{
								$content_bkg_pattern = sessvars[".content_pattern"]?sessvars[".content_pattern"]:sessvars[".content_pattern_wka"];
							}
						}else{
							$content_bkg_pattern = sessvars.wrap_content_pattern?sessvars.wrap_content_pattern:jQuery('.wrapper_content').css('background-image');
						}
					};
					reset_container();
					jQuery('#content').css('padding', '40px 0');
					jQuery('.wrapper_slider').css({'background-color': sessvars.slider_bkcolor});
					jQuery('.slider_pattern, .content_pattern, .footer_shadow').show();
					jQuery('.slider_pattern').css({'background-image': slider_pattern});
					jQuery('.wrapper_content').css({'background-color': $wrapper_content_bgcolor});
					jQuery('.header_pattern').css('background-image', $header_pattern);
					jQuery('body').css({'background-color': body_bkg_color, 'background-image': 'none'});
					jQuery('.header_separate, .header_pattern, .slider_separate, .content_separate, .footer_pattern, .slider_shadow, .content_shadow').show();
					$elem_arr = ['.header_separate', '.header_pattern', '.slider_separate', '.content_separate', '.footer_pattern', '.slider_shadow', '.content_shadow'];
					elements_css($elem_arr);
					jQuery('.content_pattern').css('background-image', $content_bkg_pattern);
					jQuery('.clipart').insertBefore('#header');
					jQuery('.clipart').css({'background-image': clipart_bkg_image, 'background-position': $bkg_position});
					if(jQuery('#bk_fix').is(':checked')){
						elem_origin_change('.body_theme','.clipart');
						jQuery('.wrapper_content').css({'background-color':'transparent'});
					}else{
						jQuery('.wrapper_content').css({'background-color':$wrapper_content_bgcolor});
					}
					jQuery('.container_menu').insertAfter('.container_LogoSearch');
					jQuery('.container_menu').css({'margin': '0px auto'});
					sess_create('#content');
					sessvars.current_lay = 'layout_1';
					sessvars.theme_change = 'true';
					sessvars.wrap_bk_color = jQuery('.wrapper_content').css('background-color');
					sessvars.wrap_content_pattern = jQuery('.content_pattern').css('background-image');
					jQuery.each(obj_sess_tmp, function(i, e){
						sesstmp_create(i, e);
					})
				break;
				case 'lay_2':
					$slider_pattern = jQuery('.slider_pattern').css('background-image');
					$slider_bkcolor = jQuery('.wrapper_slider').css('background-color');
					jQuery('.clipart').insertBefore('.wrapper_header');
					var $hasclass = jQuery("body").has(".wrap_lay2").length?"true":"false";
					vars_layouts($layout_2, $layout_3, $layout_4, $layout_5, $layout_6, $layout_7);
					reset_container();
					jQuery('.wrapper_slider, .wrapper_content, .wrapper_footer').wrapAll('<div class="global_wrapper wrap_lay2">');
					$has_slider = jQuery('body').has('.wrapper_slider').length?'true':'false';
					if($has_slider == 'true'){
						jQuery(".container_menu").insertBefore('.wrapper_slider');
					}else{
						jQuery(".container_menu").insertBefore('.wrapper_content');
					}
					jQuery('#content').css('padding', '0 0 20px');
					jQuery('.clipart').css({'background-image': clipart_bkg_image, 'background-position': $bkg_position, 'background-position-y': '0%'});
					jQuery('#header').css({'padding': '23px 0px'});
					jQuery('.header_pattern, .content_pattern, .content_separate, .footer_pattern, .slider_shadow, .footer_shadow, .header_separate, .slider_separate, .slider_pattern, .content_shadow').hide();
					$elem_arr = ['.header_pattern', '.content_pattern', '.content_separate', '.footer_pattern', '.slider_shadow', '.footer_shadow', '.header_separate', '.slider_separate', '.slider_pattern', '.content_shadow'];
					elements_css($elem_arr);
					jQuery('body').css({'background-color': body_bkg_color, 'background-image': $header_pattern});
					jQuery('.wrapper_header, .wrapper_slider, .wrapper_content').css('background-color','transparent');
					jQuery('.wrap_lay2').css({'background-color': $wrapper_content_bgcolor, 'background-image': $content_bkg_pattern.replace('\;','')});
					jQuery(".container_menu").css({'margin': '0 auto 20px'});
					sess_create('#content');
					sessvars.current_lay = 'layout_2';
					sessvars.theme_change = 'true';
					sessvars.wrap_bk_color = jQuery('.wrap_lay2').css('background-color');
					sessvars.wrap_content_pattern = jQuery('.wrap_lay2').css('background-image');
					jQuery.each(obj_sess_tmp, function(i, e){
						sesstmp_create(i, e);
					});
				break;
				case 'lay_3':
					$slider_pattern = jQuery('.slider_pattern').css('background-image');
					$slider_bkcolor = jQuery('.wrapper_slider').css('background-color');
					vars_layouts($layout_2, $layout_3, $layout_4, $layout_5, $layout_6, $layout_7);
					reset_container();
					jQuery('#content').css('padding', '40px 0');
					jQuery('.clipart').css({'background-image': clipart_bkg_image, 'background-position': $bkg_position});
					jQuery('.container_menu').insertAfter('.container_LogoSearch').add().css({'margin': '0px auto'});
					jQuery('body').css({'background-color': body_bkg_color, 'background-image': 'none'});
					jQuery('.header_pattern').css('background-image', 'none');
					jQuery('.wrapper_header, .wrapper_slider').wrapAll('<div class="wrap_lay3"></div>');
					jQuery('.wrapper_content').css({'background-color': $wrapper_content_bgcolor});
					jQuery('.clipart').insertBefore('.wrapper_header');
					jQuery('.wrap_lay3').css({'background-image': $header_pattern});
					jQuery('.content_pattern').css('background-image', $content_bkg_pattern)
					jQuery('.wrapper_slider').css('background-color', 'transparent');
					jQuery('.header_separate, .slider_pattern, .slider_shadow').hide();
					jQuery('.slider_separate, .content_pattern, .content_separate, .footer_pattern, .footer_shadow').show();
					$elem_arr = ['.slider_separate', '.content_pattern', '.content_separate', '.footer_pattern', '.footer_shadow', '.header_separate', '.slider_pattern', '.slider_shadow']
					elements_css($elem_arr);
					sess_create('#content');
					sessvars.current_lay = 'layout_3';
					sessvars.theme_change = 'true';
					sessvars.wrap_bk_color = jQuery('.wrapper_content').css('background-color');
					sessvars.wrap_content_pattern = jQuery('.content_pattern').css('background-image');
					jQuery.each(obj_sess_tmp, function(i, e){
						sesstmp_create(i, e);
					});
				break;
				case 'lay_4':
					$slider_pattern = jQuery('.slider_pattern').css('background-image');
					$slider_bkcolor = jQuery('.wrapper_slider').css('background-color');
					vars_layouts($layout_2, $layout_3, $layout_4, $layout_5, $layout_6, $layout_7);
					reset_container();
					jQuery('.clipart').insertBefore('.wrapper_header');
					var $hasclass = jQuery("body").has(".wrap_lay4").length?"true":"false";
					if($hasclass!='true'){
						jQuery('.wrapper_content, .wrapper_footer').wrapAll('<div class="global_wrapper wrap_lay4">');
					}
					jQuery('#content').css('padding', '0 0 20px');
					jQuery('.clipart').css({'background-image': clipart_bkg_image, 'background-position':$bkg_position});
					jQuery('#header').css({'padding': '23px 0px'})
					jQuery('.content_pattern, .header_pattern, .slider_pattern, .content_separate, .footer_pattern, .header_separate, .slider_separate, .slider_shadow, .footer_shadow, .content_shadow').hide();
					$elem_arr = ['.content_pattern', '.header_pattern', '.slider_pattern', '.content_separate', '.footer_pattern', '.header_separate', '.slider_separate', '.slider_shadow', '.footer_shadow', '.content_shadow']
					elements_css($elem_arr);
					jQuery('.wrapper_header').add('.wrapper_content').css('background-color', 'transparent');
					jQuery('body').css({'background-color': body_bkg_color, 'background-image': $header_pattern});
					jQuery('.wrap_lay4').css({'background-color': $wrapper_content_bgcolor, 'background-image': $content_bkg_pattern.replace('\;','')});
					jQuery('.wrapper_slider').css('background-color', 'transparent');
					jQuery(".container_menu").css({'margin': '0 auto'});
					jQuery('.container_menu').insertAfter('.container_LogoSearch');
					sess_create('#content');
					sessvars.current_lay = 'layout_4';
					sessvars.theme_change = 'true';	
					sessvars.wrap_bk_color = jQuery('.wrap_lay4').css('background-color');
					sessvars.wrap_content_pattern = jQuery('.wrap_lay4').css('background-image');
					jQuery.each(obj_sess_tmp, function(i, e){
						sesstmp_create(i, e);
					});
				break;
				case 'lay_5':
					$slider_pattern = jQuery('.slider_pattern').css('background-image');
					$slider_bkcolor = jQuery('.wrapper_slider').css('background-color');
					vars_layouts($layout_2, $layout_3, $layout_4, $layout_5, $layout_6, $layout_7);
					reset_container();
					jQuery('.clipart').insertBefore('.wrapper_header');
					jQuery('.container_menu').insertAfter('.container_LogoSearch');
					jQuery('.wrapper_slider, .wrapper_content, .wrapper_footer').wrapAll('<div class="global_wrapper wrap_lay5">');
					jQuery('.clipart').css({'background-image': clipart_bkg_image, 'background-position': $bkg_position});
					jQuery('#header').css({'padding': '23px 0px'})
					jQuery('.content_pattern, .header_pattern, .slider_pattern, .header_separate, .slider_separate, .content_separate, .footer_pattern, .slider_shadow, .footer_shadow, .content_shadow').hide();
					$elem_arr = ['.content_pattern', '.header_pattern', '.slider_pattern', '.header_separate', '.slider_separate', '.content_separate', '.footer_pattern', '.slider_shadow', '.footer_shadow', '.content_shadow']
					elements_css($elem_arr);
					jQuery('#content').css('padding', '0 0 20px');
					jQuery('.wrapper_header, .wrapper_content, .wrapper_slider').css('background-color', 'transparent');
					jQuery('body').css({'background-color': body_bkg_color, 'background-image': $header_pattern});
					jQuery('.wrap_lay5').css({'background-color': $wrapper_content_bgcolor, 'background-image': $content_bkg_pattern.replace('\;','')});
					jQuery(".container_menu").css({'margin': '0 auto'});
					// /*sessvars.current_lay ison*/ 
					// if(sessionStorage.slider_area_type == 'random-top'){
					// 	jQuery('.wrapper_slider').insertBefore('.wrap_lay5')
					// }
					sess_create('#content');
					sessvars.current_lay = 'layout_5';
					sessvars.theme_change = 'true';
					sessvars.wrap_bk_color = jQuery('.wrap_lay5').css('background-color');
					sessvars.wrap_content_pattern = jQuery('.wrap_lay5').css('background-image');
					jQuery.each(obj_sess_tmp, function(i, e){
						sesstmp_create(i, e);
					});
				break;
				case 'lay_6':
					$slider_pattern = jQuery('.slider_pattern').css('background-image');
					$slider_bkcolor = jQuery('.wrapper_slider').css('background-color');
					vars_layouts($layout_2, $layout_3, $layout_4, $layout_5, $layout_6, $layout_7);
					reset_container();
					jQuery('#content').css('padding', '0 0 20px');
					jQuery('.clipart').insertBefore('.wrapper_header');
					jQuery('.container_menu').insertAfter('.container_LogoSearch');
					jQuery('.wrapper_header, .wrapper_slider, .wrapper_content, .wrapper_footer').wrapAll('<div class="global_wrapper wrap_lay6">');
					jQuery('.clipart').css({'background-image': clipart_bkg_image, 'background-position': $bkg_position});
					jQuery('#header').css({'padding': '23px 0px'})
					jQuery('.content_pattern, .header_pattern, .slider_pattern, .header_separate, .slider_separate, .content_separate, .footer_pattern, .slider_shadow, .footer_shadow, .content_shadow').hide();
					$elem_arr = ['.content_pattern', '.header_pattern', '.slider_pattern', '.header_separate', '.slider_separate', '.content_separate', '.footer_pattern', '.slider_shadow', '.footer_shadow', '.content_shadow']
					elements_css($elem_arr);
					jQuery('.wrapper_header, .wrapper_content, .wrapper_slider').css('background-color', 'transparent');
					jQuery('body').css({'background-color': body_bkg_color, 'background-image': $header_pattern});
					jQuery('.wrap_lay6').css({'background-color': $wrapper_content_bgcolor, 'background-image': $content_bkg_pattern.replace('\;','')});
					jQuery(".container_menu").css({'margin': '0 auto'});
					sess_create('#content');
					sessvars.current_lay = 'layout_6';
					sessvars.theme_change = 'true';
					sessvars.wrap_bk_color = jQuery('.wrap_lay6').css('background-color');
					sessvars.wrap_content_pattern = jQuery('.wrap_lay6').css('background-image');
					jQuery.each(obj_sess_tmp, function(i, e){
						sesstmp_create(i, e);
					});
				break;
				case 'lay_7':
					$slider_pattern = jQuery('.slider_pattern').css('background-image');
					$slider_bkcolor = jQuery('.wrapper_slider').css('background-color');
					vars_layouts($layout_2, $layout_3, $layout_4, $layout_5, $layout_6, $layout_7);
					reset_container();
					jQuery('.container_menu').insertAfter('.container_LogoSearch');
					jQuery('.wrapper_header, .wrapper_slider, .wrapper_content, .wrapper_footer').wrapAll('<div class="global_wrapper wrap_lay7">');
					jQuery('.clipart').insertBefore('.wrapper_header');
					jQuery('#content').css('padding', '0 0 20px');
					jQuery('.clipart').css({'background-image': clipart_bkg_image, 'background-position': $bkg_position});
					jQuery('#header').css({'padding': '23px 0px'})
					jQuery('.content_pattern, .header_pattern, .slider_pattern, .header_separate, .slider_separate, .content_separate, .footer_pattern, .slider_shadow, .footer_shadow, .content_shadow').hide();
					$elem_arr = ['.content_pattern', '.header_pattern', '.slider_pattern', '.header_separate', '.slider_separate', '.content_separate', '.footer_pattern', '.slider_shadow', '.footer_shadow', '.content_shadow']
					elements_css($elem_arr);
					jQuery('.wrapper_header, .wrapper_content, .wrapper_slider').css('background-color', 'transparent');
					jQuery('body').css({'background-color': body_bkg_color, 'background-image': $header_pattern});
					jQuery('.wrap_lay7').css({'background-color': $wrapper_content_bgcolor, 'background-image': $content_bkg_pattern.replace('\;','')});
					jQuery('.container_menu').css({'margin': '0 auto'});
					sess_create('#content');
					sessvars.current_lay = 'layout_7';
					sessvars.theme_change = 'true';
					sessvars.wrap_bk_color = jQuery('.wrap_lay7').css('background-color');
					sessvars.wrap_content_pattern = jQuery('.wrap_lay7').css('background-image');
					jQuery.each(obj_sess_tmp, function(i, e){
						sesstmp_create(i, e);
					});
				break;
			};
			/*Validation for slider appears*/
			switch(sessvars.current_lay){
				case 'layout_2':
				case 'layout_5':
				case 'layout_6':
					jQuery('#slider_type_random,#slider_type_random-relative,#slider_type_random-medium').attr('disabled','disabled').parent().hide();
					jQuery('.container_menu ul li a[title="random"],.container_menu ul li a[title="random-relative"],.container_menu ul li a[title="random-medium"]').parent().hide();
				break;
				default:
					jQuery('#slider_type_random,#slider_type_random-relative,#slider_type_random-medium').removeAttr('disabled').parent().show();
					jQuery('.container_menu ul li a[title="random"],.container_menu ul li a[title="random-relative"],.container_menu ul li a[title="random-medium"]').parent().show();
				break;
			}
		});
		relationship_items();
		relationship_select('#page_area');
		relationship_select('#block_area_divisor');
		relationship_select('#block_area_pattern');
		relationship_select('#block_area_palette');		
		relationship_container();
	}


	jQuery('#down_tmp input[type="button"]').click(function(e){
		jQuery('.too_image_preloader').show();
		css=get_css_jsonst();//get current css
		lay=jQuery.trim(sessvars.current_lay);//current layout
		var generate_type=jQuery(this).attr('name');
		jQuery('.print').text('Generating Theme...');
		usr_p=datausr.get_usr();
		//console.log(usr_p);
		switch (generate_type){
			case 'xhtml':
				if(usr_p.user_premium){
					getinfo=tg_get_html_site(true);
					datap="generate_type=xhtmlr&nores=1&css="+css+'&ft_script='+getinfo['footer_script']+'&pmsld='+JSON.stringify(window.flashvars)+"&html="+encodeURIComponent(getinfo['html']);
				}else{
					datap= "css="+css+"&current_lay="+lay+"&gn_slider_type="+get_current_slider()+"&generate_type="+generate_type;
				}
				download_theme(datap, function(data){
					jQuery('.too_image_preloader').hide();
					if(data.status===false){
						alert (data.error);
					}else{
						window.location=data.download;
					}
					delete datap;
					delete usr_p;
					return false;
				});
			break;
			case 'xhtmlr':
			case 'wp_inter':
			case 'wp_full':
			case 'wp_simple':
				if(usr_p.user_premium){
					if (usr_p.notify){
						jQuery('div.notify').show();
						jQuery('.too_image_preloader').hide();
						return;
					}
					if (generate_type !='xhtmlr'){
						datap="css="+css+"&current_lay="+lay+"&gn_slider_type="+get_current_slider()+"&generate_type="+generate_type+"&logo="+sessvars.logo+'&id='+id_session+'&boxes_css='+get_boxes_css()+'&display_elements='+get_display_elements()+'&arg_text_logo='+arg_text_logo()+"&clipartbk="+sessvars['bkfixed'];
					}else{ /*xhtml mode responsive*/
						getinfo=tg_get_html_site();
						datap="generate_type="+generate_type+"&css="+css+'&ft_script='+getinfo['footer_script']+'&pmsld='+JSON.stringify(window.flashvars)+"&html="+encodeURIComponent(getinfo['html']);
					}
					download_theme(datap, function(data){
						delete datap;
						delete usr_p;
						jQuery('.too_image_preloader').hide();
						window.location=data.zip;
						return false;
					});
				}else{
					delete usr_p;
					window.location="http://www.wpthemegenerator.com/pricing-options/";
				}
			break;
		}
	});	
	
	// Relationship to layouts --> hide or show items 
	function relationship_items($current_layout){
		$current_lay = sessvars.current_lay?jQuery.trim(sessvars.current_lay):current_layout_ini;
		jQuery('.sub_panel ul li').show();
		jQuery('.to_'+$current_lay).parent().hide();
	}
	relationship_items();
	// Relationship to layouts --> Select Disable or Enable 
	
	function relationship_select($for_select){
		$current_lay = sessvars.current_lay?jQuery.trim(sessvars.current_lay):current_layout_ini;
		jQuery('select'+$for_select+' option').attr('disabled', false);
		jQuery('select'+$for_select+' option.disable_to_'+$current_lay+'').attr('disabled', true)//.empty();
		jQuery('select'+$for_select+' option.disable_option').attr('disabled', true).hide();
		jQuery('select'+$for_select+' option[disabled!="disabled"]:first').attr('selected', 'selected');
	}
	// Relationship to layouts --> hide or show options 2 level (set_panel container)
	function relationship_container($current_layout){
		$current_lay = sessvars.current_lay?jQuery.trim(sessvars.current_lay):current_layout_ini;
		jQuery('.set_panel .container_hide').show();
		jQuery('.container_hide_'+$current_lay).hide();
	}
	function get_css_sessvars (){
		var $get_html = jQuery('body').html();
		jQuery('.clone_content').html($get_html).find('*').removeAttr('style');
		jQuery('#piecemaker object').remove();
		$current_lay = sessvars.current_lay?sessvars.current_lay:current_layout_ini;
		$theme_change = sessvars.theme_change?sessvars.theme_change:'false';
		sessvars["content_pattern_wka"] = sessvars[".content_pattern"]?sessvars[".content_pattern"]:'';
		var create_file = function($create) {
			var arr = [];
			jQuery.each(sessvars, function(key, val) {
				if(key != '$'){
				jQuery.each(obj_sess_tmp, function(i, e){
					sesstmp_create(i, e);
				});
				if(val == 'none' || val == ''){delete sessvars[key];}
				
				if($theme_change == 'true'){
					jQuery.each(obj_sess_tmp, function(i, e){
						if(key == e){delete sessvars[key]}
						//if(key == e){key = key+'_tmp';}
						if(key == i){	key = key.replace('_lay_tmp', '');}
					});
				}
					switch($create){
						case 'css':
						val = val.replace(/\url\((.*?)graphic_elements/g, "url(graphic_elements").replace('("','(').replace('")',')');
						val=val.replace(url_theme+'/','');
						if (key==='logo' || key==='pattern_body_lay'){
							val=val.replace(url_theme+'/','');
						}
						var next = key + "{"+val;
						arr.push(next);
						break;
						case 'last_change':
						if(val){}else{val = val.replace(/\url\((.*?)graphic_elements/g, "url("+url_theme+"/graphic_elements").replace('("','(').replace('")',')');}
						var next = key + "{"+val;
						arr.push(next);
						break;
						case 'img':
						$curr_url = document.URL.replace(/\/#/g, '/');
						val = val.replace($curr_url, "").replace('("','(').replace('")',')');
						$split_x = val.split(' ')
						jQuery.each($split_x, function(i){
							if($split_x[i].indexOf('url') > -1){
								var next = $split_x[i];
								arr.push(next);
							}
						})
						break;
					}
				}
			});
			return arr.join("}\n")+"}";
		};
		var html_p=new Array();
		html_p['current_layout']=$current_lay;
		html_p['css']=create_file('css');
		html_p['last_change']=create_file('last_change');
		return html_p;
	}
	/* Download Notification Taxonomies */
	var counter;
	jQuery('a[rel="download"], a[rel="save_flt"]').click(function(){
		$curr_url = document.URL.replace(/\/#/g, '/');
		$url_post = $curr_url.split('/')
		if($url_post[3].indexOf('?responsive') != 0 && $url_post[3].indexOf('?wtgs') != 0 && $url_post[3] != 'posts' && $url_post[3] != '' && $url_post[3].indexOf('?new_options') != 0 && $url_post[3].indexOf('?debug_gato') != 0 && $url_post[3].indexOf('?tmp_activate') != 0){
			jQuery('.download, .save_flt').hide();
			jQuery('.alert_notification').show();/*.delay(5000).fadeOut('slow');*/
			counter=setInterval(timer, 1000); //1000 will  run it every 1 second
		}
	});
	jQuery('a.tg_cancel_time').click(function(e) {
        e.preventDefault();
		clearInterval(counter);
		count=5;
		document.getElementById("timer").innerHTML=count;
		jQuery('.alert_notification').hide();
    });
	jQuery('.alert_notification').hover(function(){
		jQuery(this).stop(true, true).show();
	},function(){
		jQuery(this).stop(true, true).delay(3000).fadeOut('slow');
		}
	)

	var var_id_homepage = sessvars.id_homepage?sessvars.id_homepage:0;
	var var_cat_homepage = sessvars.cat_homepage?sessvars.cat_homepage:0;
	jQuery('.set_lay_blog ul li a').click(function(e){
		e.preventDefault();
		jQuery('.too_image_preloader').show();
		jQuery('#post_grid option:contains("List")').attr('selected', true);
		jQuery('#post_grid').trigger('change');
		$this = jQuery(this);
		var_id_homepage = $this.attr('data-id_home_page');
		var_cat_homepage = $this.attr('data-cat_home_page');
		sessvars.id_homepage = var_id_homepage;
		sessvars.cat_homepage = var_cat_homepage;
		jQuery.ajax({
			type: "POST",
			data: {home_page_id : $this.attr('data-id_home_page'), home_page_cat: $this.attr('data-cat_home_page')}
		}).done(function(data){
			$has_ele = jQuery('body').has("div.wrapper_slider").length?'true':'false';
			$html_home_page = data.split('<!-- split -->');
			if($html_home_page[0] == ''){
				jQuery('.wrapper_slider').remove();
				jQuery('.slider_type_position ul li #no_slider').attr('checked', true);
			}else{
				jQuery('.slider_type_position ul li #slider_type_featured_slider').attr('checked', true);
				if($has_ele == 'true'){
					jQuery('.wrapper_slider').html($html_home_page[0]);
					jQuery('.wrapper_slider .wrapper_slider').unwrap();
				}else{
					jQuery('.wrapper_header').after($html_home_page[0]);
				}
			}
			jQuery('.wrapper_content').html($html_home_page[1]);
			jQuery('.wrapper_content .wrapper_content').unwrap();
			jQuery('.too_image_preloader').hide();
			jQuery.each($get_sess_arr, function(i){
				get_sess($get_sess_arr[i]);
			});
			check_layout_current();

			jQuery('#lay_gen li').removeClass('selected')			
			jQuery('.sidebar_right, .sidebar_left, .sidebar_top, .sidebar_down').attr("data-pos", function(i, val){
				jQuery('#lay_gen #'+val).addClass('selected')
				//new_lay_sidebar[val] = {active: true};
			})
	
			})
	});

	/* Save local theme */
	
	$url_theme = document.URL.replace(/\/#/g, '/');
	jQuery.getJSON($url_theme+'/?create_sessvar_ini',
		function(data){
			jQuery.each(data, function(i, e){
				if(i != "" || e != ""){
					sessvars[i] = new Object();
					sessvars[i] = e;
				}
				if(e == ""){delete sessvars[i]}
				//sessvars.$.debug()
			})
		}
	);

	jQuery(".area_save_local #save_local").click(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		get_html_p=get_css_sessvars();
		jQuery.ajax({
			type: "POST",
			data: "current_layout="+get_html_p['current_layout']+"&css="+get_html_p['last_change']+"",
			dataType:'json'
		}).done(function(msg){
				if (msg.error===true){
					jQuery(".alert_save_local").show();//(msg.msg);
				}else{
					alert("changes saved successfully.");
					sessvars.$.clearMem();
					window.location = document.URL.replace(/\/#/g, '/');
				}
		});	
	});

	jQuery(".alert_save_local .close_alert_save_local").click(function(e){
		e.preventDefault;
		jQuery(".alert_save_local").hide();
	});
	
		if(!sessvars.loader){
			relationship_select('#page_area');
			relationship_select('#block_area_divisor');
			relationship_select('#block_area_pattern');
			relationship_select('#block_area_palette');
			relationship_container();
		}
		sessvars.loader = 'true';
	
	
	/* Save local theme */
	
	
	//jQuery.fn.scheduler('random','100%',600,3000,'none',20	,1,1);
	/*Validation for slider appears*/
	switch(sessvars.current_lay){
		case 'layout_2':
		case 'layout_5':
		case 'layout_6':
			jQuery('#slider_type_random,#slider_type_random-relative,#slider_type_random-medium').attr('disabled','disabled').parent().hide();
			jQuery('.container_menu ul li a[title="random"],.container_menu ul li a[title="random-relative"],.container_menu ul li a[title="random-medium"]').parent().hide();
		break;
		default:
			jQuery('#slider_type_random,#slider_type_random-relative,#slider_type_random-medium').removeAttr('disabled').parent().show();
			jQuery('.container_menu ul li a[title="random"],.container_menu ul li a[title="random-relative"],.container_menu ul li a[title="random-medium"]').parent().show();
		break;
	}

	/*slider type selectioned*/
	jQuery('.set_slider_type input[name="slider_type"]:checked').parent().addClass('current_option');
	jQuery('.set_slider_type input[name="slider_type"]').live('change',function(){
		if(jQuery('.set_slider_type input[name="slider_type"]').is(':checked')){
			jQuery('.set_slider_type input[name="slider_type"]:checked').parent().addClass('current_option');
		}
		jQuery('.set_slider_type input[name="slider_type"]:not(":checked")').parent().removeClass('current_option');
	})
	/*page layout selectioned*/
	jQuery('.set_lay_page input[name="page_layout"]:checked').parent().addClass('current_option');
	jQuery('.set_lay_page input[name="page_layout"]').live('change',function(){
		if(jQuery('.set_lay_page input[name="page_layout"]').is(':checked')){
			jQuery('.set_lay_page input[name="page_layout"]:checked').parent().addClass('current_option');
		}
		jQuery('.set_lay_page input[name="page_layout"]:not(":checked")').parent().removeClass('current_option');
	});
	// jQuery('.set_slider_type').autoscroll();
	/*options for view the slider frames menu on main settings tool*/
	jQuery('a[title="wptg-slider-frames"]').live('click',function(){
	    jQuery('a[rel="option_slider"]').click();
	    jQuery('a[rel="set_slider_bkg_img"]').click();
	});
});
jQuery(document).ready(function(){
    /**
     * scheduler
     * modifica el tamaño y posicion de los thumbs al igual que el tamaño del slider de acuerdo a parametros recibidos 
     * por metodo POST a traves de Ajax
     * @param  {[obj]} slidr [Pasa los parametros necesarios para el redimensionamiento del slider]
     */
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
    jQuery.fn.scheduler = function (slidr){
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
                slidr.h=jQuery(window).height();
                slidr.w=jQuery(window).width();
                sessionStorage.slidrWidth = slidr.w;
                sessionStorage.slidrHeight = slidr.h;
                sessionStorage.slidrPadding = slidr.p;
                fakes('100%','fixed',0);
                jQuery('#prev').attr('style','').removeClass('nivo-prevNav').addClass('special-prev');
                jQuery('#next').attr('style','').removeClass('nivo-nextNav').addClass('special-next');
				jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').css('display','none');
            break;
            case 'random':
                slidr.h = 600;
                slidr.w=jQuery(window).width();
                sessionStorage.slidrWidth = slidr.w;
                sessionStorage.slidrHeight = slidr.h;
                sessionStorage.slidrPadding = slidr.p;
                jQuery('.wrapper_slider').css({position:'relative'});
                // console.log(jQuery('.wrapper_slider').position().top+20,jQuery('.wrapper_slider').position(),jQuery('.wrapper_slider').height());
                fakes(600,'absolute',20);
				jQuery('.wrapper_slider').css({padding:0});				
                jQuery('#prev').attr('style','').removeClass('nivo-prevNav').addClass('special-prev');
                jQuery('#next').attr('style','').removeClass('nivo-nextNav').addClass('special-next');
				jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').css('display','block');
			break;
			default:
				jQuery('.wrapper_slider').css({padding:'20px 0'});
				jQuery('.slider_pattern,.content_pattern,.footer_pattern, .header_pattern, .header_separate, .content_separate, .footer_separate, .header_shadow, .slider_shadow, .content_shadow, .footer_shadow').css('display','block');
			break;			
        }
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
                jQuery('.wrapper_slider').css({'position':'absolute','top':'','width':'100%'});
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
})
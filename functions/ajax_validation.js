/*function change_tags_html(strhtml) {
	   	document.getElementById("slider_type").innerHTML = strhtml;
}*/
var layout_selected= 1;
function change_tags_html(strhtml,id) {
	   	document.getElementById(id).innerHTML = strhtml;
}

function change_tags_html_p(strhtml,id) {
/* this section change the status layout to visible, when the layout page changes */

	var $link = jQuery.noConflict();				
	for(b in slider_layout){	

		if (b==strhtml){
			document.getElementById(id+init_layout).style.display='none';
			init_layout=b;
		 	document.getElementById(id+b).style.display='inline';
			var selected_lay='#'+id+b;
		}
		else{
				$link('#'+id+b).addClass('lay_disable');

		}
	}	

	var alink= $link('.layout_generator').attr('href');
	var get_link=alink.split('?');
	var new_link=get_link[0]+'?layout_items=';
	$link(selected_lay+' .group_widget input').each(function(index) {
					//layout_selected[index]=$link(this).attr('id');
					if ($link(this).is(':checked')===true){
						 layout_selected[index]=layout_selected[index]=$link(this).attr('name');
						 new_link+=layout_selected[index]=$link(this).attr('name')+';'+$link(this).attr('class')+';1,';
						
					}
					else
					{
						 new_link+=layout_selected[index]=$link(this).attr('name')+';'+$link(this).attr('class')+';0,';
					}
					
	  });

	  $link('.layout_generator').attr('href',new_link);
		$link('.layout_generator').click(
			function () { 
					var alink= $link('.layout_generator').attr('href');
					var get_link=alink.split('?');
					var new_link=get_link[0]+'?layout_items=';
						$link(selected_lay+' .group_widget input').each(function(index) {
					//layout_selected[index]=$link(this).attr('id');
							if ($link(this).is(':checked')===true){
								 layout_selected[index]=layout_selected[index]=$link(this).attr('name');
								 new_link+=layout_selected[index]=$link(this).attr('name')+';'+$link(this).attr('class')+';1,';
							}
							else
							{
								 new_link+=layout_selected[index]=$link(this).attr('name')+';'+$link(this).attr('class')+';0,';
							}						
					  });
				  $link('.layout_generator').attr('href',new_link);					  
			}
		)
}


function verify_chk_box(){

	/* this section verifies unchecked checkboxes  and send form with state false
	and verfify radio button onlu in status disabled and asign a hidden variable and keep the changes
	this  function only work when is subimmited the form*/
	var $chk = jQuery.noConflict();	
	// show the elements for all checkbox into form
	$chk("input[type=checkbox]").each(function(){
		if ($chk(this).is(':checked')===false){
			if ($chk(this).attr('value') ==='true'){
				var html = '<input type="checkbox" name="'+$chk(this).attr('name')+'" value="false" class="'+$chk(this).attr('class')+'" />'+'<input type="hidden" name="'+$chk(this).attr('name')+'" value="false" />';
				$chk(this).after(html).remove();
				$chk('.themeshock_feat_caption_field_slider + label.button').css({'max-width':'55px','display':'inline-block','margin-left':'-5px','border-radius':'0'});
				$chk('.themeshock_custom_post_types + label.button').css({'display':'inline-block','margin-left':'-5px','border-radius':'0'});
				$chk('.iconchk + label.button').css({'display':'inline-block','margin-left':'-5px','border-radius':'0'});
				$chk('.themeshock_feat_caption_field_slider + label.button:first').css({'margin-left':'4px','border-radius':'4px 0 0 4px'});
				$chk('.themeshock_feat_caption_field_slider + label.button:last').css({'border-radius':'0 4px 4px 0'});
			}
		}
	});
	// show the elements for all checkbox into form
	$chk("input[type=radio]").each(function(){
		if($chk(this).is(':disabled')&&$chk(this).is(':checked')){
			var html = '<input type="radio" checked="checked" disabled="disabled"  />'+'<input type="hidden" name="'+$chk(this).attr('name')+'" value="'+$chk(this).attr('value')+'" />';
			$chk(this).after(html).remove();						
		}
	});
}

function change_radio(checkbox_object,default_position,title_post){
	// when any checkboxes type vertical make onclck asign default radio selection 
	var $chk = jQuery.noConflict();	
	if (checkbox_object.checked===true){
		// show the elements for all checkbox into form
		$chk("input[name="+checkbox_object.id+"]").each(function(){
			var position=$chk(this).attr("id");
			if(position.replace(title_post,'')===default_position){
				$chk(this).attr("checked",'checked');
			}
		});					
	}else{
		// show the elements for all checkbox into form
		$chk("input[name="+checkbox_object.id+"]").each(function(){
			$chk(this).attr("checked",'');
		});
	}
}
//Asigna el estado al hacer click en un check box
var stateAsg;
var previo=null;
/*this variables are only for radio*/
function change_checkbox(radiobutton_object){
/* this section unchecked radio buttons*/
	if(previo &&previo!=radiobutton_object){previo.stateAsg=false;}
	if(radiobutton_object.checked==true && radiobutton_object.stateAsg==true){radiobutton_object.checked=false;}
	radiobutton_object.stateAsg=radiobutton_object.checked;
	previo=radiobutton_object;
	if (radiobutton_object.checked==false){
		document.getElementById(radiobutton_object.name).checked=false;/**/
	}
	if (radiobutton_object.checked==true){
		document.getElementById(radiobutton_object.name).checked=true;		
	}
}

function vertical_disable(full_width_obj,vertical_pack){
	// when full_width is chceked disabled the vertical checkboxes and radios
	var $chk = jQuery.noConflict();		
	for (r in vertical_pack){
		if(full_width_obj.checked===true){
			document.getElementById(vertical_pack[r]).disabled='disabled';
			// show the elements for all checkbox into form
			$chk("input[name="+vertical_pack[r]+"]").each(function(){
				$chk(this).attr("disabled",'disabled');
			});
		}else{
			document.getElementById(vertical_pack[r]).disabled='';
			// show the elements for all checkbox into form
			$chk("input[name="+vertical_pack[r]+"]").each(function(){
				$chk(this).attr("disabled",'');
			});
		}
	}
}
/* Layout generator */
function ajax_post(data){
	var html='';
	jQuery.ajax({
		type: "POST",
		url: "./",
		data: data,
		async:false,
		success: function(data) {
			html=data;
			//quitar imagen aqui;
		}
	});
	return html;	
}
function ajax_post_layout(data){// gestora de guardar la informacion de los layout en wordpres
	jQuery.post("./",data,
		 function(data) {
			jQuery('li.loading_layout').hide();			 
			//quitar imagen aqui;
		}
	);
}
function ajax_post_layout_json(data){// gestora de guardar la informacion de los layout en wordpres
	var result=null;
	jQuery.ajaxSetup({async:false});
	jQuery.post("./",data,
		 function(data) {
			jQuery('li.loading_layout').hide();			 
			result=data;
			//quitar imagen aqui;
		}
	,'json');
	jQuery.ajaxSetup({async:true});
	return result;
}
jQuery(document).ready(function(e) {
	//* Cambiando los pages en los layouts */	
	/*Sidebar area*/
	jQuery('input[name="add_sidebar"]').click(function(e) {
		jQuery('li.loading_layout').show();		
		var get_pos_hori=jQuery('input[name="sidebar_add"]:checked').val();
		var sidebar_name=jQuery.trim(jQuery('input[name="name_sidebar"]').val());
		counter=jQuery('li[data-pos*="'+get_pos_hori+'"]').length+1;		

		if (sidebar_name===""){
			counter=jQuery('li[data-pos*="'+get_pos_hori+'"]').length+1;
			sidebar_name=get_pos_hori+'_'+counter;
		}
		sidebar_name=sidebar_name.replace(/ /g,'_');
		var data='add_sidebar='+sidebar_name+'&sd_position='+get_pos_hori+'&sd_counter='+counter;
		var result=ajax_post_layout_json(data);
		if(result.updt===true){
			sidebar_name=result.sidebar;
		}
		var option=jQuery('select[name="footer_widget_style"]').clone().html();
		switch (get_pos_hori){
			case 'Top':
				jQuery('ul#lay_gen li:first').after('<li id="'+sidebar_name+'" data-pos="Top"><img class="sd_close" src="http://www.wpthemegenerator.com/wp-content/themes/wts-frw-tool2/img/close.png" data-delete="'+sidebar_name+'" /><select name="'+sidebar_name+'_style" disabled="disabled" class="widget_style content" >'+option+'</select><div></div><h4>sidebar '+sidebar_name+'</h4></li>');
			break;
			case 'Bottom':
				if (counter==1){
					jQuery('ul#lay_gen li.nothover').after('<li id="'+sidebar_name+'" data-pos="Bottom"><img class="sd_close" src="http://www.wpthemegenerator.com/wp-content/themes/wts-frw-tool2/img/close.png" data-delete="'+sidebar_name+'" /><select name="'+sidebar_name+'_style" disabled="disabled" class="widget_style content" >'+option+'</select><div></div><h4>sidebar '+sidebar_name+'</h4></li>');					
				}else{
					jQuery('ul#lay_gen li:last').after('<li id="'+sidebar_name+'" data-pos="Bottom"><img class="sd_close" src="http://www.wpthemegenerator.com/wp-content/themes/wts-frw-tool2/img/close.png" data-delete="'+sidebar_name+'" /><select name="'+sidebar_name+'_style" disabled="disabled" class="widget_style content" >'+option+'</select><div></div><h4>sidebar '+sidebar_name+'</h4></li>');					
				}

			break;
		}
    });
	jQuery('img.sd_close').live('click',function(){
		answer = confirm(" Are you sure? widgets inside will be cleaned too. This action can't be undone");
		if (answer){
			jQuery('li.loading_layout').show();
			var data='del_slider='+jQuery(this).attr('data-delete');
			ajax_post_layout(data);
			jQuery(this).parent('li').remove();
		}
	});
	/*form validation*/
	jQuery('#wptg-form').h5Validate({
		errorClass:'blackerror'
	});
	/*change theme for gls*/
	jQuery("#themeshock_gls_box_style").live('change',function(){
        jQuery("#screen_pre").removeClass();
        jQuery("#screen_pre").addClass("screen"+jQuery(this).val());
    });
	/*change theme for feature slider*/
	jQuery("#themeshock_feat_style_slider").live('change',function(){
        jQuery("#slider_screen_pre").removeClass();
        jQuery("#slider_screen_pre").addClass("slider_screen"+jQuery(this).val().replace('tg-border-',''));
    });
	/*verify state for responsiveness*/
	if(jQuery('#responsive-no').is(':checked')){					
		jQuery('#themeshock_feat_width_slider').removeAttr("disabled");
		jQuery('.responsive-mode').attr("disabled","disabled");
	}
	if(jQuery('#responsive-yes').is(':checked')){
		jQuery('#themeshock_feat_width_slider,#themeshock_feat_height_slider').attr("disabled","disabled");
		jQuery('.responsive-mode').removeAttr("disabled");
	}
	/*checking custom size*/
	if(jQuery('#themeshock_feat_style_slider').val()=='tg-border-default'){
		jQuery('.size_feat_tool').hide();
	}else{
		jQuery('.size_feat_tool').show();
	}
	jQuery('#themeshock_feat_style_slider').live('change',function(){
		if(jQuery(this).val()=='tg-border-default'){
			jQuery('.size_feat_tool').hide();
		}else{
			jQuery('.size_feat_tool').show();
		}
	});		
	
	switch(jQuery('#themeshock_slider_type').val()){
		case 'No-Slider':
		case 'Nivo-Slider':
		case 'Piecemaker':
		case 'Easy-Accordion':
		case 'random':
		case 'random-top':
		case 'random-relative':
		case 'random-medium':
		case 'cubeV':
		case 'cubeH':
		case 'sliceH':
		case 'scale':
		case 'featured-poster':
		case 'kaleidoscope':
		case 'fan':
		case 'slideH':
			jQuery('.size_feat_tool').hide();
			jQuery('#themeshock_feat_style_slider').live('change',function(){
				jQuery('.size_feat_tool').hide();
			});	
		break;
		default:
			jQuery('#themeshock_feat_style_slider').live('change',function(){
				if(jQuery(this).val()=='tg-border-default'){
					jQuery('.size_feat_tool').hide();
				}else{
					jQuery('.size_feat_tool').show();
				}
			});		
		break;
	}
	jQuery('#themeshock_slider_type').live('change',function(){
		if(jQuery('#themeshock_feat_style_slider').val()=='tg-border-default'){
			jQuery('.size_feat_tool').hide();
		}else{
			jQuery('.size_feat_tool').show();
		}
		switch(jQuery(this).val()){
			case 'No-Slider':
			case 'Nivo-Slider':
			case 'Piecemaker':
			case 'Easy-Accordion':
			case 'random':
			case 'random-top':
			case 'random-relative':
			case 'random-medium':
			case 'cubeV':
			case 'cubeH':
			case 'sliceH':
			case 'scale':
			case 'featured-poster':
			case 'kaleidoscope':
			case 'fan':
			case 'slideH':
				jQuery('.size_feat_tool').hide();
				jQuery('#themeshock_feat_style_slider').live('change',function(){
					jQuery('.size_feat_tool').hide();
				});		
			break;
			default:
				jQuery('#themeshock_feat_style_slider').live('change',function(){
					if(jQuery(this).val()=='tg-border-default'){
						jQuery('.size_feat_tool').hide();
					}else{
						jQuery('.size_feat_tool').show();
					}
				});		
			break;
		}
	});		
	/*responsiveness*/
	jQuery('#responsive-feat-no').live('click',function(){
		if(jQuery(this).is(':checked')){				
			jQuery('.themeshock_feat_size_slider').show();
		}
	});
	if(jQuery('#responsive-feat-yes').is(':checked')){
		jQuery('.themeshock_feat_size_slider').hide();
	}
	jQuery('#responsive-feat-yes').live('click',function(){
		if(jQuery(this).is(':checked')){
			jQuery('.themeshock_feat_size_slider').hide();
		}
	});
	jQuery('#themeshock_slider_type').live('change',function(){
		jQuery('#responsive-feat-no').live('click',function(){
			if(jQuery(this).is(':checked')){				
				jQuery('.themeshock_feat_size_slider').show();
			}
		});
		if(jQuery('#responsive-feat-yes').is(':checked')){
			jQuery('.themeshock_feat_size_slider').hide();
		}
		jQuery('#responsive-feat-yes').live('click',function(){
			if(jQuery(this).is(':checked')){
				jQuery('.themeshock_feat_size_slider').hide();
			}
		});
	});	
	jQuery('.themeshock_custom_post_types + label.button:first,.iconchk + label.button:first').css({'border-radius':'4px 0 0 4px'});
    /*data insertion for gls*/
   		var box_style='.themeshock_gls_box_style';
   		var box_width='.themeshock_gls_box_width';
     	var btncolor='.themeshock_gls_btn_clr';
     	var btntxt='.themeshock_gls_btn_txt';
     	var btnfntstl='.themeshock_gls_btn_fnt_stl';
     	var btnfntsz='.themeshock_gls_btn_fnt_sz';
     	var ttlfntsz='.themeshock_gls_title_font_size';
     	var cntntfntsz='.themeshock_gls_content_font_size';
     	var cntntfntstl='.themeshock_gls_content_font_style';
     	var ttlfntstl='.themeshock_gls_title_font_style';
     	var glsurl='.themeshock_gls_no_img';
     	var glsmasonry='.themeshock_gls_masonry';
     	jQuery('#themeshock_gls_custom_post_type').live('change',function(){
	 		if(jQuery(box_style).hasClass(jQuery(this).val())){
	    		jQuery(box_style).show();
	    	}else{
	    		jQuery(box_style).hide();
	    	}
	    	if(jQuery(box_width).hasClass(jQuery(this).val())){
	    		jQuery(box_width).show();
	    	}else{
	    		jQuery(box_width).hide();
	    	}
	    	if(jQuery(btncolor).hasClass(jQuery(this).val())){
	    		jQuery(btncolor).show();
	    	}else{
	    		jQuery(btncolor).hide();
	    	}
	    	if(jQuery(btntxt).hasClass(jQuery(this).val())){
	    		jQuery(btntxt).show();
	    	}else{
	    		jQuery(btntxt).hide();
	    	}
	    	if(jQuery(btnfntstl).hasClass(jQuery(this).val())){
	    		jQuery(btnfntstl).show();
	    	}else{
	    		jQuery(btnfntstl).hide();
	    	}
	    	if(jQuery(btnfntsz).hasClass(jQuery(this).val())){
	    		jQuery(btnfntsz).show();
	    	}else{
	    		jQuery(btnfntsz).hide();
	    	}
	    	if(jQuery(ttlfntsz).hasClass(jQuery(this).val())){
	    		jQuery(ttlfntsz).show();
	    	}else{
	    		jQuery(ttlfntsz).hide();
	    	}
	    	if(jQuery(cntntfntsz).hasClass(jQuery(this).val())){
	    		jQuery(cntntfntsz).show();
	    	}else{
	    		jQuery(cntntfntsz).hide();
	    	}
	    	if(jQuery(cntntfntstl).hasClass(jQuery(this).val())){
	    		jQuery(cntntfntstl).show();
	    	}else{
	    		jQuery(cntntfntstl).hide();
	    	}
	    	if(jQuery(ttlfntstl).hasClass(jQuery(this).val())){
	    		jQuery(ttlfntstl).show();
	    	}else{
	    		jQuery(ttlfntstl).hide();
	    	}
	    	if(jQuery(glsurl).hasClass(jQuery(this).val())){
	    		jQuery(glsurl).show();
	    	}else{
	    		jQuery(glsurl).hide();
	    	}
	    	if(jQuery(glsmasonry).hasClass(jQuery(this).val())){
	    		jQuery(glsmasonry).show();
	    	}else{
	    		jQuery(glsmasonry).hide();
	    	}
	 	});
   		 jQuery(".save-gls").live('click',function(e){
   		 	e.preventDefault();
	    	var tsidentifier=jQuery('#themeshock_gls_custom_post_type').val();
	    	//alert(tsidentifier)
		    glsdata={};
		    glsdata["themeshock_gls_box_style"]=jQuery(box_style).find('select').attr('value');
		    glsdata["themeshock_gls_box_wdth"]=(jQuery(box_width).find('input').attr('value')=='inherit')?'':jQuery(box_width).find('input').attr('value')+'px';
	    	glsdata["themeshock_gls_btn_clr"]=jQuery(btncolor).find('select').attr('value');
	    	glsdata["themeshock_gls_btn_txt"]=jQuery(btntxt).find('input').attr('value');
	    	glsdata["themeshock_gls_btn_fnt_stl"]=jQuery(btnfntstl).find('select').attr('value');
	    	glsdata["themeshock_gls_btn_fnt_sz"]=(jQuery(btnfntsz).find('input').attr('value')=='inherit')?jQuery(btnfntsz).find('input').attr('value'):jQuery(btnfntsz).find('input').attr('value')+'px';
	    	glsdata["themeshock_gls_title_font_size"]=(jQuery(ttlfntsz).find('input').attr('value')=='inherit')?jQuery(ttlfntsz).find('input').attr('value'):jQuery(ttlfntsz).find('input').attr('value')+'px';
	     	glsdata["themeshock_gls_content_font_size"]=(jQuery(cntntfntsz).find('input').attr('value')=='inherit')?jQuery(cntntfntsz).find('input').attr('value'):jQuery(cntntfntsz).find('input').attr('value')+'px';
	     	glsdata["themeshock_gls_content_font_style"]=jQuery(cntntfntstl).find('select').attr('value');
	     	glsdata["themeshock_gls_title_font_style"]=jQuery(ttlfntstl).find('select').attr('value');
	     	glsdata["themeshock_gls_no_img"]=jQuery(glsurl).find('input').attr('value');
	     	glsdata["themeshock_gls_masonry"]=jQuery(glsmasonry).find('input').attr('checked');
		    glsjson=JSON.stringify(glsdata);
		  	ajax_post('gls_custom_page_option='+tsidentifier+'&total_options='+glsjson);
	    })
	/*layouts area*/
	jQuery('select#themeshock_layout_type').live('change',function(){
		jQuery('li.loading_layout').show();		
		var id_page=this.value;
		jQuery.post(
			 "./",{id_layout:id_page},
			 function(info_layout) {
				for(b in info_layout){//b=dependiendo del conatdor pude ser las posciones de los layout  o sliders
					if(typeof(info_layout[b])==='object'){
						if (info_layout[b].active===true){
							jQuery('#'+b).addClass('selected');
							if(!jQuery('input.default_widget_boxes').attr('checked')){
								jQuery('select[name="'+b+'_style"]').attr('disabled',false).css('z-index',2);
							}
						}
						else{
							jQuery('#'+b).removeClass('selected');
							jQuery('select[name="'+b+'_style"]').attr('disabled',true).css('z-index',1);
						}
						jQuery('select[name="'+b+'_style"] option[selected="selected"]').removeAttr('selected');
						jQuery('select[name="'+b+'_style"] option[value="'+info_layout[b].style+'"]').attr('selected','selected');
					}
					else{
						switch(id_page){
							case '0':
								jQuery('#lay_gen').addClass('noslider');
								jQuery('#slider_page').hide();
								jQuery("ul.slider_opt li").each(function () {
									if(this.id!=='footer_widget_style'){
										jQuery(this).show();
									}
						      	});
							break;
							default:
							if(typeof(info_layout[b])!=='number'){
								jQuery("ul.slider_opt li").each(function () {
									if(this.id!=='footer_widget_style' && this.id!=='default_widget_boxes'){
										jQuery(this).hide();
									}
						      	});
								jQuery('#lay_gen').removeClass('noslider');
								if (b==='slider_page'){
									if (info_layout[b]===true){
										jQuery('#slider_page').addClass('selected').show();
									}
									else{
										jQuery('#slider_page').removeClass('selected').show();
									}
								}
							}
							break;
						}
						if(b==='footer_widget_style'){
							jQuery('select[name="footer_widget_style"] option[selected="selected"]').removeAttr('selected');
							jQuery('select[name="footer_widget_style"] option[value="'+info_layout[b]+'"]').attr('selected','selected');
						}
					}
				}
				jQuery('li.loading_layout').hide();
			},"json"
		);
	});
	//* Cambiando el selector (estado orendido o apagado) de los layouts */		
	jQuery('ul#lay_gen li:not(li.nothover) div,ul#lay_gen select').live('mouseup',function(){
		if (jQuery(this).hasClass('content')){
			return false;
		}
		jQuery('li.loading_layout').show();
		var li_status=jQuery(this).parent('li');
		var val_sides=li_status.parent('ul');//chqueanlo los lados left and right
		if (val_sides.hasClass('horinzontal')){
			count=0;
			jQuery('ul.horinzontal li').each(function(index, element) {
                if (jQuery(this).hasClass('selected')){
					count++;
				}
            });
			if (li_status.hasClass('selected')){
				count--;
			}
			if(count===2){
				alert('You can select up to 2 sides');
				jQuery('li.loading_layout').hide();			
				return false;
			}
		}
		id_li=li_status.attr('id')+'=';
		if (li_status.hasClass('selected')){
			li_status.removeClass('selected');
			jQuery(this).prev('select').attr('disabled',true).css('z-index',1);
			id_li+=false;
		}
		else{
			li_status.addClass('selected');
			if(!jQuery('input.default_widget_boxes').attr('checked')){
				jQuery(this).prev('select').attr('disabled',false).css('z-index',2);
			}
			id_li+=true;
		}
		var data='status=active&idc_layout='+jQuery('select#themeshock_layout_type').val()+'&'+id_li;
		ajax_post_layout(data);
		return false;
	});
	//* select de los widgets style */
	jQuery('ul#lay_gen select').live('change',function(){
		jQuery('li.loading_layout').show();
		var id_sty_wgt=this.value;//id estilo widget
		var li_status=jQuery(this).parent('li');
		var id_li=li_status.attr('id')+'='+id_sty_wgt;
		var data='status=style&idc_layout='+jQuery('select#themeshock_layout_type').val()+'&'+id_li;
		ajax_post_layout(data);
	});
	/* los chkbox de los slider solo aplica en blog and single */
	jQuery('ul.slider_opt input[type="checkbox"]').live('click',function(){
		jQuery('li.loading_layout').show();
		var chk_box_data=jQuery(this).attr('name')+'='+this.checked;
		var data='status=active&idc_layout='+jQuery('select#themeshock_layout_type').val()+'&'+chk_box_data;
		ajax_post_layout(data);		
	});
	/* aaplica os estilos eexlucisvamente en el footer*/
	jQuery('select[name="footer_widget_style"]').live('change',function(){
		jQuery('li.loading_layout').show();
		var data='status=style&idc_layout='+jQuery('select#themeshock_layout_type').val()+'&'+this.name+'='+this.value;
		ajax_post_layout(data);
	});
	jQuery('img.loading_sld').hide();/*corregir*/
/*UPLOADER remove slider*/	
	jQuery('img.close').live('click',function(e){
		var loading=jQuery('img.loading_sld').appendTo(jQuery(this).parent('div'));//queda pendiente el div para cambiarlo
		jQuery('img.loading_sld').show();
		ajax_post('img_delete='+jQuery(this).attr('data-id'));
		jQuery(this).parent('li').remove();
		jQuery('#file_ct').html(ajax_post('rfsimg='+jQuery(this).attr('data-id')));
	});
	jQuery('input[data-value="up"]').live('click',function(){
		var loading=jQuery('img.loading_sld').appendTo(jQuery(this).parent('li'));
		loading.show();		
		ajax_post('img_up='+jQuery(this).attr('data-id'));
		jQuery('#file_ct').html(ajax_post('rfsimg='+jQuery(this).attr('data-id')));		
		loading.hide();
	});		
	jQuery('input[data-value="down"]').live('click',function(){
		var loading=jQuery('img.loading_sld').appendTo(jQuery(this).parent('li'));
		loading.show();
		ajax_post('img_down='+jQuery(this).attr('data-id'));
		jQuery('#file_ct').html(ajax_post('rfsimg='+jQuery(this).attr('data-id')));
		loading.hide();
	});
	/***/
	jQuery('input[name="themeshock_logo_type"]').live('change','click',function(){
		var loading=jQuery('.aviso_text').prependTo(jQuery(this).parent('.header-logo-setup'));
		loading.fadeIn('slow').delay(1000).fadeOut('slow');
		jQuery('.update_text').fadeIn('slow').delay(500).fadeOut('slow');
		jQuery('.updated_text').delay(3000).fadeIn('slow').delay(1000).fadeOut('slow');
		ajax_post('logo_type='+jQuery(this).val());	
	});
	/***/
	jQuery('.link_slider_path').live('blur',function(){
		var loading=jQuery('.aviso_text').appendTo(jQuery(this).parent());
		loading.fadeIn('slow').delay(1000).fadeOut('slow');
		jQuery('.update_text').fadeIn('slow').delay(500).fadeOut('slow');
		jQuery('.updated_text').delay(3000).fadeIn('slow').delay(1000).fadeOut('slow');
		var id=jQuery(this).attr('data-id');
		ajax_post('url='+id+'&save_url='+jQuery('input[name="link_'+id+'"]').val());		
	});
	jQuery('input[data-value="sld_image"]').live('click',function(){
		var loading=jQuery('img.loading_sld').appendTo(jQuery(this).parent('li'));
		loading.show();
		ajax_post('active='+jQuery(this).attr('data-id')+'&status='+this.checked);
		loading.hide();
	});	
	/*shortcode fetured*/
	jQuery('#themeshock_featured,#themeshock_feat_col').change(function(e) {
		if(jQuery('input[name="excerpt"]').is(':checked')){
			var excerpt="true";
		}else{
			var excerpt="false";		
		}		
		var feat_val=jQuery('#themeshock_featured').val();
		var feat_col=jQuery('#themeshock_feat_col').val();
		var font_size=jQuery('input[name="ft_size"]').val();
		jQuery('input[name="shortcode"]').val('[featured type="'+feat_val+'" columns="'+feat_col+'" fontsize="'+font_size+'" excerpt="'+excerpt+'"]');
    });
	jQuery('input[name="ft_size"],input[name="excerpt"]').click(function(e) {
		if(jQuery('input[name="excerpt"]').is(':checked')){
			var excerpt="true";
		}else{
			var excerpt="false";		
		}
		var feat_val=jQuery('#themeshock_featured').val();
		var feat_col=jQuery('#themeshock_feat_col').val();
		var font_size=jQuery('input[name="ft_size"]').val();
		jQuery('input[name="shortcode"]').val('[featured type="'+feat_val+'" columns="'+feat_col+'" fontsize="'+font_size+'" excerpt="'+excerpt+'"]');
    });
		
	/*shortcode wptg custom post type (gallery, portfolio and services)*/
	jQuery('#themeshock_wptg_ctp_post_type,#themeshock_wptg_ctp_taxonomy, #themeshock_wptg_ctp_style').change(function(e){
		$wptg_ctp_post_type = jQuery('#themeshock_wptg_ctp_post_type').val();
		jQuery('#themeshock_wptg_ctp_taxonomy option').not('#themeshock_wptg_ctp_taxonomy option.wptg-group-allitems').hide();
		(jQuery(this).attr('id') == 'themeshock_wptg_ctp_post_type')?jQuery('#themeshock_wptg_ctp_taxonomy option.wptg-group-allitems').attr('selected', true):"";
		jQuery('#themeshock_wptg_ctp_taxonomy option.wptg-group-'+$wptg_ctp_post_type+'').show();
		$wptg_ctp_taxonomy = jQuery('#themeshock_wptg_ctp_taxonomy').val();
		$wptg_ctp_style = jQuery('#themeshock_wptg_ctp_style').val();
		jQuery('input.wptg_ctg_shortcode').val('[wptg-cpt wptg_post_type="'+$wptg_ctp_post_type+'" taxonomy="'+$wptg_ctp_taxonomy+'" style="'+$wptg_ctp_style+'"]');
	}).change();
		
});

function copyit(theField) {
	tempval=theField;
	tempval.focus()
	tempval.select()
}
/*UPLOADER*/
function createUploader(){            
	var uploader = new qq.FileUploader({
		element: document.getElementById('TS_uploader'),
        action: document.URL,		
	    params: {
    	    uploader: 'ok',
        }, 
		template: '<div class="qq-uploader">' + 
			'<div class="qq-upload-drop-area"><span>Drop files here to upload</span></div>' +
			'<div class="qq-upload-button">'+upload_slider_text+'</div>' +
			'<ol id="file_ct" class="qq-upload-list"></ol>' + 
			 '</div>'
		,     
		onSubmit: function(id, fileName){
			uploader.setParams({
				   uploader: 'ok',
				   id_sld:id
			});
		},
        onComplete: function(id, fileName, responseJSON){
			
			jQuery('#file_ct').html(ajax_post('rfsimg=now'));
			
		}
	});
	var uploader_logo = new qq.FileUploader({
		element: document.getElementById('TS_logo_uploader'),
        action: document.URL,
	    params: {
    	    uploaderlogo: 'ok',
        },
		template: '<div class="qq-uploader">' + 
			'<div class="qq-upload-drop-area"><span>Drop files here to upload</span></div>' +
			'<div class="qq-upload-button">'+upload_logo_text+'</div>' +
			'<ol id="ts_logo_file" class="qq-upload-list"></ol>' + 
			 '</div>'
		,
        onComplete: function(id, fileName, responseJSON){
			return false;
		}
	});
	
}
// in your app create uploader as soon as the DOM is ready
// don't wait for the window to load  
window.onload = createUploader;
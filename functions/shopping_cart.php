<?php $tg_get_all_items=tg_shp_cart_ajax('get_all_items');
$tg_status=0;
foreach ($GLOBALS['tg_shp_show'] as $shp_page_show){
	switch($shp_page_show){
		case 'All pages':
			$tg_status=1;
		break;
		case 'Products':
			if ($GLOBALS['tg_current_page']==='product-wts'){
				$tg_status=1;
			}else{
				$tg_status=0;
			}
		break;		
	}
}
if ($tg_status===1){
?>
<style>@import url(<?php echo get_template_directory_uri(); ?>/css/taxonomies-extended.css);</style>
<div class="tg_shooping_cart">
	<span class="tg_shp_loader"><img src="<?php bloginfo('template_url')?>/img/shoppingcart/loading.gif" /></span>
  <ul id="tg_shopping_cart" class="collapse in">
	  <li><h6>Shopping cart</h6></li>
    <li class="notitle"><span class="tg_shp_item"><?php echo $tg_get_all_items['total_items']; ?></span> items</li>
    <li class="notitle">Total: <span class="tg_shp_price_total"><?php echo $tg_get_all_items['price_total'].' '.$GLOBALS['tg_shp_currency']; ?></span></li>  
    <li class="notitle"><a href="#" class="btn tg_shp_dt">more info</a></li>    
  </ul>
  <a href="#tg_shopping_cart" data-toggle="collapse"  class="shp_text"><img class="arrows" src="<?php bloginfo('template_url')?>/img/shoppingcart/down.jpg" />Show Basket</a>
  <?php 
		global $wpdb;
	 	$get_product=$wpdb->get_row("SELECT wpost.ID FROM $wpdb->posts wpost WHERE wpost.post_name = 'product-wts' and wpost.post_type='page' ",ARRAY_A);
	?>  
  <a href="<?php echo	get_permalink($get_product['ID'] ); ?>" class="tg_all_products">Show all products</a>
</div>
<div class="tg_shooping_cart_dt">
  <div class="tg_shp_title">
    <h3>Shopping cart</h3>
    <span class="tg_shp_loader"><img src="<?php bloginfo('template_url')?>/img/shoppingcart/loading.gif" /></span>    
  </div>
  <ul class="tg_shp_info">
    <!--<li class="tg_shp_title"><h3>Shopping cart</h3></li>-->
    <li class="tg_shp_product tg_shp_border"><h6>Product</h6></li>
    <li class="tg_shp_tools tg_shp_border"><h6>quantity</h6></li>    
    <li class="tg_shp_price"><h6>price</h6></li>
  </ul>
  <div class="tg_shp_dt_footer">
    <a href="#" data-tgshpurl="<?php echo $GLOBALS['tg_shp_url']; ?>" class="btn tg_shp_buy"  >Buy now</a>
  </div>
</div>
<?php }?>
<script>
jQuery(document).ready(function(e) {
	parmeters_url=new Array();
	jQuery("#tg_shopping_cart").collapse();
	jQuery('#tg_shopping_cart').on('hidden', function () {
		jQuery('.shp_text').html('<img class="arrows" src="<?php bloginfo('template_url')?>/img/shoppingcart/down.jpg" /> Show Basket');
	});
	jQuery('#tg_shopping_cart').on('show', function () {
		jQuery('.shp_text').html('<img class="arrows" src="<?php bloginfo('template_url')?>/img/shoppingcart/up.jpg" /> Hide Basket');
	});
	jQuery('a.tg_shp_dt').click(function(e) {
		if(jQuery(this).hasClass('tg_shp_processing')){
			return;
		}
		jQuery('.tg_shp_dt').addClass('tg_shp_processing');		
		tg_shp_type='get_all_items';
		li_rows= new Array('tg_shp_product','tg_shp_tools','tg_shp_price');
		jQuery.ajax({
			url:'<?php echo get_bloginfo('wpurl');?>/wp-admin/admin-ajax.php',
			data:"action=tg_shp_cart&action_type="+tg_shp_type,
			type:'POST',
			dataType:'json',
			success:function(msg){
				if (msg.price_total>0){
					html_totals='';
					for(id in msg){
						if(msg[id].title){
							li_product='<li></li>';
							for(i in li_rows){
								html='';
								switch(li_rows[i]){
									case'tg_shp_product':
									 html=msg[id].title;
									break;
									case'tg_shp_tools':
									 html='<a href="#" class="shp_cart_button shp_dt" onclick="return false;" ondblclick="return false;" tg_shp_type="tg_shp_delete" tg_id_product="'+id+'"></a>'+
									 			'<a href="#" class="shp_cart_button shp_dt" onclick="return false;" ondblclick="return false;" tg_shp_type="tg_shp_add" tg_id_product="'+id+'"></a>'+
												'<a href="#" class="shp_cart_button shp_dt" onclick="return false;" ondblclick="return false;" tg_shp_type="tg_shp_remove" tg_id_product="'+id+'"></a>'+
												'<span tg_id_product="'+id+'" >'+msg[id].quantity;+'</span>';	
									break;
									case'tg_shp_price':
									 html=msg[id].price+' <?php echo $GLOBALS['tg_shp_currency'];?>';
									break;
								}
								jQuery('ul.tg_shp_info').append(jQuery(li_product).addClass(li_rows[i]).html(html).attr('tg_id_product',id));
							}
						}
					}
					jQuery('ul.tg_shp_info').append('<li class="tg_shp_product"><h6>Total</h6></li><li class="tg_shp_tools tg_shp_border tg_shp_totals"></li><li class="tg_shp_price tg_dt_total" tg_id_product="">'+msg.price_total+' <?php echo $GLOBALS['tg_shp_currency'];?>'+'</li>');
				}
				//jQuery('#tg_shp_buy').attr('href',msg.url);
				parmeters_url=msg;
				jQuery('.tg_shp_dt').removeClass('tg_shp_processing');				
				jQuery.colorbox({open:true,width:'421px',height:"350px",html:jQuery('div.tg_shooping_cart_dt').html()})	
			}
		});
		return false;
  });
	jQuery(document).bind('cbox_closed',function(){
		jQuery('ul.tg_shp_info li').each(function(index, element) {
			if (index>2){
				jQuery(this).remove();
			}
    });
	});
	/*Funcionallidad de añadir,eliminar y quitar productos*/
	jQuery('.shp_cart_button').live('click',function(e) {
		if(jQuery(this).hasClass('tg_shp_processing')){
			return;
		}
		jQuery('.shp_cart_button').addClass('tg_shp_processing');
		jQuery('.tg_shp_loader').show();
		dt=(jQuery(this).hasClass('shp_dt'))?true:false;
		id=jQuery(this).attr('tg_id_product');
		tg_shp_type=jQuery(this).attr('tg_shp_type');
		jQuery.ajax({
			url:'<?php echo get_bloginfo('wpurl');?>/wp-admin/admin-ajax.php',
			data:"action=tg_shp_cart&tg_id_product="+id+'&action_type='+tg_shp_type,
			type:'POST',
			dataType:'json',
			success:function(msg){
				parmeters_url=msg;				
				jQuery('.tg_shp_loader').hide();
				jQuery('#tg_shopping_cart span').each(function(index, element) {
					html='';
					switch(this.className){
						case 'tg_shp_item':
							html=msg.total_items;
						break;
						case 'tg_shp_price_total':
							html=msg.price_total+' <?php echo $GLOBALS['tg_shp_currency'];?>';
						break;						
					}
					jQuery(this).html(html);
        });
				if (dt===true){
					jQuery('.tg_shp_info li[tg_id_product="'+id+'"]').each(function(index, element) {
						if (msg[id].quantity===0){
							jQuery(this).remove();
						}else{
							switch(this.className){
								case 'tg_shp_tools':
									jQuery('span[tg_id_product="'+id+'"]').html(msg[id].quantity);
								break;
								case 'tg_shp_price':
									jQuery(this).html(msg[id].price+' <?php echo $GLOBALS['tg_shp_currency'];?>');
								break;
							}
						}
	        });
					jQuery('li.tg_dt_total').html(msg.price_total+' <?php echo $GLOBALS['tg_shp_currency'];?>');
					//jQuery('#tg_shp_buy').attr('href',msg.url);
				}
				jQuery('.shp_cart_button').removeClass('tg_shp_processing');
			}
		});			
    return false;
  });
	jQuery('.tg_shp_buy').live('click',function(e) {
		post_to_url_tg_shp(jQuery(this).attr('data-tgshpurl'),parmeters_url,'post');
    return false;
	});
	function post_to_url_tg_shp(path, params, method) {
			method = method || "post"; // Set method to post by default, if not specified.
			// The rest of this code assumes you are not using a library.
			// It can be made less wordy if you use one.
			var form = document.createElement("form");
			form.setAttribute("method", method);
			form.setAttribute("action", path);
			for(var key in params) {
					if(params.hasOwnProperty(key)) {
							if(params[key].title){
								for (type in params[key]){
									var hiddenField = document.createElement("input");
									hiddenField.setAttribute("type", "hidden");
									hiddenField.setAttribute("name", 'tg_shp_cart['+key+']['+type+']');
									hiddenField.setAttribute("value", params[key][type]);
									form.appendChild(hiddenField);
								}
							}else{
								var hiddenField = document.createElement("input");
								hiddenField.setAttribute("type", "hidden");
								hiddenField.setAttribute("name", 'tg_shp_cart['+key+']');
								hiddenField.setAttribute("value", params[key]);
								form.appendChild(hiddenField);								
							}
					 }
			}
			document.body.appendChild(form);
			form.submit();
	}	
});
</script>
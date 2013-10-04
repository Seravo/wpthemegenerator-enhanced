<?php 
/*cargando scripts ene el header*/
function tg_js_head() {
    echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" ></script>  ';
}
add_action('admin_head', 'tg_js_head');
add_action('wp_head', 'tg_js_head',9999);

/*Coloque aqui los scripts en el footer*/
if ( ! function_exists('tgft_print_script') ){	
	function tgft_print_script(){
		global $footer_script;
		echo $footer_script;
	}
}
?>
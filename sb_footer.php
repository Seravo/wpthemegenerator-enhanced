<?php 
	$id=(is_page())?get_the_ID():0;
	$layout_info=maybe_unserialize(get_option('themeshock_layout_options'));//carga todas las posiciones de los layouts y estados de los layouts;
	widget_style('Footer Sidebar',$layout_info[$id]['footer_widget_style']);
?>
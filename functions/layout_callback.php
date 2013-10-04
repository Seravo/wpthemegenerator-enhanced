<?php 
/*add sidebar*/
if (isset($_POST['add_sidebar'])){
	$return['updt']=false;
	if (array_key_exists($_POST['add_sidebar'], $GLOBALS['sidebar_info'])===true){
		///verifica nombre sidebar que extistan evitar repetidos
		$get_random_number=range(1,99);//verify numbers up to 99
		foreach ($get_random_number as $number){
			$sidebar_name=$_POST['add_sidebar'].'_'.$number;
			if(array_key_exists($sidebar_name, $GLOBALS['sidebar_info'])===true){
				continue;
			}else{
				break;
			}
		}
		$return['updt']=true;		
		$_POST['add_sidebar']=$return['sidebar']=$sidebar_name;
	}
	$new_sidebar[$_POST['add_sidebar']]=$GLOBALS['register_sidebar'];
	$new_sidebar[$_POST['add_sidebar']]['name']=$_POST['add_sidebar'];
	
	$get_widgets=get_option('sidebars_widgets');
	switch ($_POST['sd_position']){
		case 'Top':
			$GLOBALS['sidebar_info']=array_merge($new_sidebar,$GLOBALS['sidebar_info']);	
			foreach ($GLOBALS['layout_info'] as $id_page => $value){
				switch($id_page){
					case '0':
						$GLOBALS['layout_info'][$id_page]=array_put_to_position($GLOBALS['layout_info'][$id_page],$GLOBALS['layout_p'],6,$_POST['add_sidebar']);					
					break;
					case 'themeshock_default_widget_boxes':
					break;
					default:
						$GLOBALS['layout_info'][$id_page]=array_put_to_position($GLOBALS['layout_info'][$id_page],$GLOBALS['layout_p'],2,$_POST['add_sidebar']);										
					break;
				}
			}
			$get_widgets=array_put_to_position($get_widgets,array(),2,'sidebar-x');
		break;
		case 'Bottom':
			$GLOBALS['sidebar_info']=array_merge($GLOBALS['sidebar_info'],$new_sidebar);
			foreach ($GLOBALS['layout_info'] as $id_page => $value){
				if($id_page!=='themeshock_default_widget_boxes'){
					$new_layout[$_POST['add_sidebar']]=$GLOBALS['layout_p'];
					$GLOBALS['layout_info'][$id_page]=array_merge($value,$new_layout);
				}
			}
			$get_widgets=array_put_to_position($get_widgets,array(),count($get_widgets)-1,'sidebar-x');
		break;		
	}
	$new_widget=update_pos_widget($get_widgets);
	update_option('themeshock_layout_options',maybe_serialize($GLOBALS['layout_info']));//regitrar  layout en los didebar
	update_option('themeshock_sidebar',maybe_serialize($GLOBALS['sidebar_info']));//registra un sidebar en las posisciones
	update_option('sidebars_widgets',$new_widget);
	echo json_encode($return);	
	exit;
}
if (isset($_POST['del_slider'])){
	$layout_info=$GLOBALS['layout_info'];
	$sidebar_info=$GLOBALS['sidebar_info'];
	$get_widgets=get_option('sidebars_widgets');
	foreach ($GLOBALS['layout_info'] as $id_page =>$value){
		unset($layout_info[$id_page][$_POST['del_slider']]);
	}
	$count_sidebar=1;
	foreach ($GLOBALS['sidebar_info'] as $sidebar_name => $value){
		if ($sidebar_name===$_POST['del_slider']){
			unset($sidebar_info[$_POST['del_slider']]);
			$count_sidebar++;
			break;
		}
		$count_sidebar++;
	}
	$sidebar_delete='sidebar-'.$count_sidebar;
	unset($get_widgets[$sidebar_delete]);
	$new_widget=update_pos_widget($get_widgets);	
	update_option('themeshock_layout_options',maybe_serialize($layout_info));//regitrar  layout en los didebar
	update_option('themeshock_sidebar',maybe_serialize($sidebar_info));//registra un sidebar en las posisciones
	update_option('sidebars_widgets',$new_widget);
	exit;
}

if (isset($_POST['id_layout'])){///cargar configuracion del layout por id
	$layout_info=maybe_unserialize(get_option('themeshock_layout_options'));//carga todas las posiciones de los layouts;
	echo json_encode($layout_info[$_POST['id_layout']]);
	exit;
}
if (isset($_POST['idc_layout'])){///actualiza la configuracion por id
	$layout_info=maybe_unserialize(get_option('themeshock_layout_options'));//carga todas las posiciones de los layouts;
	$element='';
	$value_status;
	foreach ($_POST as $element_layout => $value){
		if($element_layout!=='idc_layout' && $element_layout!=='status'){
			$element=$element_layout;
			switch($value){
				case 'true':
					$value_status=true;
				break;
				case 'false':
					$value_status=false;
				break;
				default:
					$value_status=$value;
				break;
			}
		}
	}
	switch ($_POST['status']){
		case 'style':
			if ($element==='footer_widget_style'){
				$layout_info[$_POST['idc_layout']][$element]=$value_status;
			}
			else{
				$layout_info[$_POST['idc_layout']][$element][$_POST['status']]=$value_status;				
			}
		break;
		case 'active':
			if(isset($layout_info[$_POST['idc_layout']][$element][$_POST['status']])){
				$layout_info[$_POST['idc_layout']][$element][$_POST['status']]=$value_status;
			}
			else{
				$layout_info[$_POST['idc_layout']][$element]=$value_status;
			}
			if(isset($_POST['themeshock_default_widget_boxes'])){
				$layout_info['themeshock_default_widget_boxes'] = $value_status;
			}
		break;
	}
	update_option('themeshock_layout_options', maybe_serialize($layout_info));
	exit;
}
function GetArrKey( $findArr, $key_arr, $depth=0 ){
	if( count($key_arr) <= $depth || !array_key_exists($key_arr[$depth], $findArr) )
					return NULL;
	else if( count($key_arr) == $depth+1 )
					return $findArr[$key_arr[$depth]];
 
	return self::GetArrKey( $findArr[$key_arr[$depth]], $key_arr, $depth+1 );
}
function array_put_to_position(&$array, $object, $position, $name = null){
		$count = 0;
		$return = array();
		foreach ($array as $k => $v)
		{  
						// insert new object
						if ($count == $position)
						{  
										if (!$name) $name = $count;
										$return[$name] = $object;
										$inserted = true;
						}  
						// insert old object
						$return[$k] = $v;
						$count++;
		}  
		if (!$name) $name = $count;
		if (!$inserted) $return[$name];
		$array = $return;
		return $array;
}
function update_pos_widget($get_widgets){
	$counter=1;
	$new_widget=array();
	foreach ($get_widgets as $sidebar=> $value){
		if (substr_count($sidebar,'sidebar-')>0){
			$new_widget['sidebar-'.$counter]=$value;
			$counter++;
		
		}
		else{
			$new_widget[$sidebar]=$value;			
		}
	}
	return $new_widget;
}
?>
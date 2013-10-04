<?php 
	//delete  the img slider
	//session_start();
	$slider_info=maybe_unserialize(get_option('themeshock_slider_images'));//carga las imagenes
	if (isset($_POST['img_delete'])){
		unlink($slider_info[$_POST['img_delete']]['path']);
		unlink(dirname($slider_info[$_POST['img_delete']]['path']).'/'.basename($slider_info[$_POST['img_delete']]['thumbnail']));		
		unset($slider_info[$_POST['img_delete']]);
		$slider_info=array_values($slider_info);
		update_option('themeshock_slider_images',maybe_serialize($slider_info));
		exit;
	}
	/*poisciones del slider*/
	if (isset($_POST['img_up'])){
		$counter=(int)$_POST['img_up']-1;
		$slider_info_old=$slider_info[$counter];
		$slider_info[$counter]=$slider_info[$_POST['img_up']];
		$slider_info[$_POST['img_up']]=$slider_info_old;
		update_option('themeshock_slider_images',maybe_serialize($slider_info));		
		exit;
	}
	if (isset($_POST['img_down'])){
		$counter=(int)$_POST['img_down']+1;
		$slider_info_old=$slider_info[$counter];
		$slider_info[$counter]=$slider_info[$_POST['img_down']];
		$slider_info[$_POST['img_down']]=$slider_info_old;
		update_option('themeshock_slider_images',maybe_serialize($slider_info));
		exit;
	}
	if (isset($_POST['active'])){
		$status=($_POST['status']==='true')?true:false;
		$slider_info[$_POST['active']]['active']=$status;
		update_option('themeshock_slider_images',maybe_serialize($slider_info));
		exit;
	}	
	/*implementacion en ajax para el cambio de logo entre texto e imagen*/
	if ((isset($_POST['logo_type']))){
		update_option('themeshock_logo_type',$_POST['logo_type']);
		exit;
	}
	/*fin de la implementacion de imagen a texto y veceversa*/
	/*implementacion de envio de gls options*/
	if (isset($_POST['gls_custom_page_option'])&&(isset($_POST['total_options']))){
		$glsoptions=stripslashes($_POST['total_options']);
		update_option($_POST['gls_custom_page_option'],$glsoptions);
		exit;
	}
	/*save url*/
	if (isset($_POST['url'])&&(isset($_POST['save_url']))){
		$slider_info[$_POST['url']]['link']=$_POST['save_url'];
		update_option('themeshock_slider_images',maybe_serialize($slider_info));
		exit;
	}
	if (isset($_POST['rfsimg'])||isset($_GET['get_html'])){
		$last_item=count($GLOBALS['slider_img_info'])-1;
		foreach($GLOBALS['slider_img_info'] as $index => $slider_info){?>
			<li>
      <div class="display-table-cell table-cell-first">
				<span class="number"><?php echo $index+1; ?></span>
				<img class="thumb" src="<?php echo $slider_info['thumbnail']?>" />
      </div>
      <div class="display-table-cell table-cell-2">
      	<input type="text" name="link_<?php echo $index;?>" value="<?php echo $slider_info['link'];?>" />
        <div class="slider-images-controls">
        	<input type="button"  value="save link" data-id="<?php echo $index; ?>" />
					<?php if ($index!==0){ ?>
          <input type="button" value="&#x25B2;" data-value="up" data-id="<?php echo $index; ?>" />
					<?php }?>
					<?php if($last_item!==$index){?><input type="button" data-value="down" value="&#x25BC;" data-id="<?php echo $index; ?>"  />
					<?php }?>
					<img class="close" src="<?php echo get_template_directory_uri(); ?>/img/close.png" data-id="<?php echo $index; ?>" />
					<input type="checkbox" value="true" data-value="sld_image" <?php echo ($slider_info['active'])?'checked="checked"':'';?> data-id="<?php echo $index; ?>" />
        </div>
      </div>  
			
			</li>
			<?php 
		}
		exit;
	}

	$file_info=(isset($HTTP_RAW_POST_DATA))?$HTTP_RAW_POST_DATA:$_FILES;
	$upload_dir=wp_upload_dir();	
	$directory_slider=$upload_dir['basedir'].'/slider/';	
	$directory_logo=$upload_dir['basedir'].'/logo/';
	if ((isset($_GET['uploader'])&&$_GET['uploader']==='ok') || (isset($_GET['uploaderlogo'])&&$_GET['uploaderlogo']==='ok')){
		if (is_array($file_info)){
			$tmp_name=$file_info['qqfile']['tmp_name'];
			if (is_uploaded_file($tmp_name)){
				$filename=$file_info['qqfile']['name'];
				if ($_GET['uploaderlogo']==='ok'){
					@unlink($GLOBALS['logo_info']['path']);					
					move_uploaded_file($tmp_name, $directory_logo.$filename);
					logo_save($directory_logo.$filename,$upload_dir);
				}
				else{
					move_uploaded_file($tmp_name, $directory_slider.$filename);
					file_save($filename,$slider_info,$upload_dir,false);
				}
			}
		}
		else{
			if ($_GET['uploaderlogo']==='ok'){
				@unlink($GLOBALS['logo_info']['path']);
				check_filesystem($directory_logo, $_GET['qqfile'], $HTTP_RAW_POST_DATA);
				//file_put_contents($directory_logo.$_GET['qqfile'],$HTTP_RAW_POST_DATA);
				logo_save($directory_logo.$_GET['qqfile'],$upload_dir);
			}
			else{
				check_filesystem($directory_slider, $_GET['qqfile'], $HTTP_RAW_POST_DATA);
				//file_put_contents($directory_slider.$_GET['qqfile'],$HTTP_RAW_POST_DATA);
				$filename=$_GET['qqfile'];
				file_save($filename,$slider_info,$upload_dir,true);			
			}
		}
		exit;
	}
function logo_save($pathname,$upload_dir){
	$GLOBALS['logo_info']['url']=$upload_dir['baseurl'].'/logo/'.basename($pathname);
	$GLOBALS['logo_info']['path']=$upload_dir['basedir'].'/logo/'.basename($pathname);
	chmod($GLOBALS['logo_info']['path'],0777);					
	$width_logo=$GLOBALS['logo_info']['size'][0];
	$height_logo=$GLOBALS['logo_info']['size'][1];					
	//createthumb($GLOBALS['logo_info']['path'],$GLOBALS['logo_info']['path'],$width_logo,$height_logo); for size update
	update_option('themeshock_logo',maybe_serialize($GLOBALS['logo_info']));
	echo json_encode(array('success'=>true,'html'=>'logo','logo_url'=>$GLOBALS['logo_info']['url']));
}
function file_save($filename,$slider_info,$upload_dir,$return_html){
	$img_dimensions=maybe_unserialize(get_option('themeshock_slider_dimensions'));//carga las imagenes		
	ob_clean();
	session_start();
	//var_dump($_SESSION['sld_info']);
	$index=count($slider_info);
	$slider_info[$index]['active']=true;
	$slider_info[$index]['link']='#';
	$slider_info[$index]['url']=$upload_dir['baseurl'].'/slider/'.$filename;
	$slider_info[$index]['path']=$upload_dir['basedir'].'/slider/'.$filename;
	createthumb($slider_info[$index]['path'],$slider_info[$index]['path'],$img_dimensions[0],$img_dimensions[1]);
	$slider_info[$index]['thumbnail']=$upload_dir['baseurl'].'/slider/'.basename(image_resize($slider_info[$index]['path'],200,200));
	?>
	<span class="number"><?php echo $index+1; ?></span>
	<img class="thumb" src="<?php echo $slider_info[$index]['thumbnail']?>" />
	<input type="text" name="file_<?php echo $index; ?>" value="<?php echo $slider_info[$index]['link'];?>" />
	<input type="button"  value="save link" data-id="<?php echo $index; ?>" />    
	<input type="button" value="^" data-value="up" data-id="<?php echo $index; ?>" /><input type="button" data-value="down" value="v" data-id="<?php echo $index; ?>"  />
	<img class="close" src="<?php echo get_template_directory_uri(); ?>/img/close.png" data-id="<?php echo $index; ?>" />
	<input type="checkbox" value="true"  data-value="sld_image" <?php echo ($slider_info['active'])?'checked="checked"':'';?> data-id="<?php echo $index; ?>"  />
	<?php
	update_option('themeshock_slider_images',maybe_serialize($slider_info));
	$html=ob_get_clean();
	if ($return_html==true){
		echo json_encode(array('success'=>true/*,'html'=>$html*/));
	}
	else{
		echo json_encode(array('success'=>true));		
	}
}
function createthumb($name,$filename,$new_w,$new_h)
{
	$path_info=pathinfo($name);
	switch($path_info['extension']){
		case'gif':
			$src_img=imagecreatefromgif($name);
		break;
		case'jpg':
		case'jpeg':
			$src_img=imagecreatefromjpeg($name);
		break;
		case'png':
			$src_img=imagecreatefrompng($name);
		break;
	}
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	$thumb_w=$new_w;
	$thumb_h=$new_h;	
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	switch($path_info['extension']){
		case'gif':
		case'png':
		// integer representation of the color black (rgb: 0,0,0)
		// removing the black from the placeholder
		imagecolortransparent($dst_img, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
		// turning off alpha blending (to ensure alpha channel information 
		// is preserved, rather than removed (blending with the rest of the 
		// image in the form of black))
		imagealphablending($dst_img, false);
		// turning on alpha channel information saving (to ensure the full range 
		// of transparency dst_img preserved)
		imagesavealpha($dst_img, true);
		break;
	}
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
	switch($path_info['extension']){
		case'gif':
			imagegif($dst_img,$filename);
		break;
		case'jpg':
		case'jpeg':
			imagejpeg($dst_img,$filename);
		break;
		case'png':
			imagepng($dst_img,$filename); 
		break;
	}	
	imagedestroy($dst_img); 
	imagedestroy($src_img); 
}	
?>

<?php
function savelocal_filesystem($vars_layout_file, $current_lay, $create_css, $trigger = 'qq-uploader') {
	define('FS_METHOD', 'direct');
	require_once(ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php');
	global $wp_filesystem;
	//check_admin_referer();
	$method = 'direct';
		
	if ( ! $method ) return false;
	if ( ! class_exists("WP_Filesystem_$method") ) {
		$abstraction_file = apply_filters('filesystem_method_file', ABSPATH . 'wp-admin/includes/class-wp-filesystem-' . $method . '.php', $method);
		if ( ! file_exists($abstraction_file) ) return;
		require_once($abstraction_file);
	}
	if ( !defined('FS_CHMOD_DIR') ) define('FS_CHMOD_DIR', 0755 );
	if ( !defined('FS_CHMOD_FILE') ) define('FS_CHMOD_FILE', 0644 );

	$method = "WP_Filesystem_$method";
	$wp_filesystem = new $method($args);


	$get_tmp_dir = get_template_directory();
	$file_vars_layout = "vars_layout.php";
    $file_last_changes = "last_change.css";
	$folder_current_layout = $get_tmp_dir."/framework-tool/current_layout/";
	$target_dir_current_layout = $wp_filesystem->find_folder($folder_current_layout);
	$get_content_file_vars = $wp_filesystem->get_contents($target_dir_current_layout.$file_vars_layout);
	$new_file_vars = preg_replace("/(layout_)([0-9])/", $current_lay, $get_content_file_vars);
	if(!$wp_filesystem->put_contents($target_dir_current_layout.$file_vars_layout, $new_file_vars)){
		return false;
	};
	$wp_filesystem->put_contents($target_dir_current_layout.$file_last_changes, $create_css);
	
	return true;
}


if (isset($_POST['current_layout'])){
	$get_css = stripslashes ($_POST['css']);
	$current_lay = trim($_POST['current_layout'],' ');
	$get_tmp_dir=get_template_directory(); 
	$get_tmp_uri=get_template_directory_uri().'/';
	$create_css = '@charset "utf-8";'.PHP_EOL;
	$create_css.=$get_css.PHP_EOL;
	clearstatcache();
	/*$css_permisions=substr(sprintf('%o', fileperms($style_css)), -4);
	$layout_file_permissions=substr(sprintf('%o', fileperms($vars_layout_file)), -4);	
	if (!stristr(PHP_OS, 'WIN')){
		if (($css_permisions !='0777' && $layout_file_permissions!='0777')){
			echo json_encode(array('error'=>true,'msg'=>'Changes can´t be saved, please set filetype permissions for the following files: /css/last_change.css and /framework-tool/current_layout/vars_layout.php to 0777'));
			exit;
		}
	}*/
	if(!savelocal_filesystem($vars_layout_file, $current_lay, $create_css)){
		echo json_encode(array('error'=>true,'msg'=>''));
		exit;
	};
	echo json_encode(array('error'=>false));
	exit;
}
?>
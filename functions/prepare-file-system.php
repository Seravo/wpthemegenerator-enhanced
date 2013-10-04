<?php
/**
 * WpThemeGenerator Prepare file system 
 **/
add_action('admin_menu', 'filesystem_wptg_page');

function filesystem_wptg_page() {
    
    add_submenu_page( 'functions.php', 'Prepare Filesystem API', 'Setup Local Saving', 'upload_files', 'filesystem_wptg', 'filesystem_wptg_screen' );

}

function filesystem_wptg_screen() {

$form_url = "admin.php?page=filesystem_wptg";
$output = $error = '';


if(isset($_POST['wptg_prepate_fs_val'])){
    
    if(false === ($output = filesystem_file_text_write($form_url))){
        return;
    
    } elseif(is_wp_error($output)){
        $error = $output->get_error_message();
        $output = '';
    }
    
}elseif($output = file_exit_server()){
        retun;
}elseif(is_wp_error($output)) {
        $error = $output->get_error_message();
        $output = '';
};    


$output = esc_textarea($output);
$output_init = 'In order to setup local saving, you need to enter the FTP credentials.';

$message_save_local = 'Your local saving feature has been setup correctly. Now you can save changes in your personalize menu.';
$photo_save_local = '<br/><br/><img src="'.get_template_directory_uri().'/framework-tool/img/save_local_saving.jpg" style="border: 8px solid #444;">'

?>
    
<div class="wrap">
<div class="icon32" id="icon-wpthemegenerator"><br></div>
<h2>WpThemeGenerator Prepare Filesystem API </h2>
<?php if(!empty($error)): ?>
    <div class="error below-h2"><?php echo $error;?></div>
<?php endif; ?>

<form method="post" action="" style="margin-top: 20px">

<?php wp_nonce_field('filesystem_wptg_screen'); ?>

<fieldset class="form-table">
    <label for="wptg_prepate_fs_val" style="font-weight: bold;"><?php echo $output?$message_save_local.$photo_save_local:$output_init ; ?></label><br>
    <input type="hidden" id="wptg_prepate_fs_val" name="wptg_prepate_fs_val" value="WpThemeGenerator File System Working (:">

</fieldset>
    
   
<?php if($output != 'WpThemeGenerator File System Working (:'){
    submit_button('Click here to enter your credentials.', 'primary', 'wptg_prepate_fs_val_submit', true);
}?>

</form>
</div>
<?php
}


/**
 * Initialize Filesystem object
 *
 * @param str $form_url - URL of the page to display request form
 * @param str $method - connection method
 * @param str $context - destination folder
 * @param array $fields - fileds of $_POST array that should be preserved between screens
 * @return bool/str - false on failure, stored text on success
 **/
function filesystem_init($form_url, $method, $context, $fields = null) {
    global $wp_filesystem;
    
    
    /* first attempt to get credentials */
    if (false === ($creds = request_filesystem_credentials($form_url, $method, false, $context, $fields))) {
        return false;
    }
    
    /* now we got some credentials - try to use them*/        
    if (!WP_Filesystem($creds)) {
        
        /* incorrect connection data - ask for credentials again, now with error message */
        request_filesystem_credentials($form_url, $method, true, $context);
        return false;
    }
    
    return true; //filesystem object successfully initiated
}


/**
 * Perform writing into file
 *
 * @param str $form_url - URL of the page to display request form
 * @return bool/str - false on failure, stored text on success
 **/
function filesystem_file_text_write($form_url){
    global $wp_filesystem;
    
    check_admin_referer('filesystem_wptg_screen');
    
    $wptg_prepate_fs_val = sanitize_text_field($_POST['wptg_prepate_fs_val']);
    $form_fields = array('wptg_prepate_fs_val');
    $method = '';

    $get_temp_directory = get_template_directory();
    $dir_current_layout = $get_temp_directory."/framework-tool/current_layout/";

    $dir_tmp = $dir_current_layout."/tmp/";
            
    $form_url = wp_nonce_url($form_url, 'filesystem_wptg_screen');
    
    if(!filesystem_init($form_url, $method, $dir_current_layout, $form_fields))
        return false;
    
    $target_dir_current_layout = $wp_filesystem->find_folder($dir_current_layout);
    
    $target_tmp = $wp_filesystem->find_folder($dir_tmp);

    $target_file = trailingslashit($target_dir_current_layout).'file-system-run.txt';
    
    $wp_filesystem->chmod($target_dir_current_layout, 0777);
    $wp_filesystem->chmod($target_tmp, 0777);
    create_file_user_server();
    $wp_filesystem->chmod($target_dir_current_layout, 0755);
    $wp_filesystem->chmod($target_tmp, 0755);
    
    if(!$wp_filesystem->put_contents($target_file, $wptg_prepate_fs_val, FS_CHMOD_FILE)) 
        return new WP_Error('writing_error', 'Error when writing file'); //return error object
    
    return $wptg_prepate_fs_val;
}


/**
 * Read text from file
 *
 * @param str $form_url - URL of the page where request form will be displayed
 * @return bool/str - false on failure, stored text on success
 **/

function filesystem_demo_text_read($form_url){
    global $wp_filesystem;

    $wptg_prepate_fs_val = '';
    
    $form_url = wp_nonce_url($form_url, 'filesystem_wptg_screen');
    $method = '';
    $get_tmp_dir = get_template_directory();

    $folder_current_layout = $get_tmp_dir."/framework-tool/current_layout/";
    
    if(!filesystem_init($form_url, $method, $folder_current_layout))
        return false;
    
    $target_dir = $wp_filesystem->find_folder($folder_current_layout);
    
    $target_file = trailingslashit($target_dir).'file-system-run.txt';
    
    /* read the file */
    if($wp_filesystem->exists($target_file)){ //check for existence
        
        $wptg_prepate_fs_val = $wp_filesystem->get_contents($target_file);
        if(!$wptg_prepate_fs_val)
            return new WP_Error('reading_error', 'Error when reading file'); //return error object           
    }   
    
    return $wptg_prepate_fs_val;    
}


function file_exit_server(){
    define('FS_METHOD', 'direct');
    require_once(ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php');
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
    $file_system_run = 'file-system-run.txt';
    
    $folder_current_layout = $get_tmp_dir."/framework-tool/current_layout/";
        

    $target_dir_current_layout = $wp_filesystem->find_folder($folder_current_layout);
    $target_file = trailingslashit($target_dir_current_layout).$file_system_run;


    if($wp_filesystem->exists($target_file)){ //check for existence
        
        $wptg_prepate_fs_val = $wp_filesystem->get_contents($target_file);
        if(!$wptg_prepate_fs_val)
            return new WP_Error('reading_error', 'Error when reading file'); //return error object           
    } 

    return $wptg_prepate_fs_val;
}

function create_file_user_server(){
    define('FS_METHOD', 'direct');
    require_once(ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php');
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
    $file_old_var_layouts = "vars_layout-old.php";
    $file_old_last_changes = "last_change-old.css";
    

    $folder_framework_tool = $get_tmp_dir."/framework-tool/";
    $folder_current_layout = $get_tmp_dir."/framework-tool/current_layout/";
    $folder_tmp = $folder_current_layout."/tmp/";
    $folder_css = $get_tmp_dir."/css/";

    // target directories
    $target_dir_current_layout = $wp_filesystem->find_folder($folder_current_layout);
    $target_dir_css = $wp_filesystem->find_folder($folder_css);
    $target_dir_tmp = $wp_filesystem->find_folder($folder_tmp);
    $target_dir_framework_tool = $wp_filesystem->find_folder($folder_framework_tool);

    $get_content_vars_layout = $wp_filesystem->get_contents($target_dir_current_layout.$file_vars_layout);
    $get_content_last_changes = $wp_filesystem->get_contents($folder_current_layout.$file_last_changes);

    $wp_filesystem->move($target_dir_current_layout.$file_vars_layout, $target_dir_tmp.$file_old_var_layouts);
    $wp_filesystem->move($target_dir_current_layout.$file_last_changes, $target_dir_tmp.$file_old_last_changes);

    $wp_filesystem->delete($target_dir_current_layout.$file_vars_layout);
    $wp_filesystem->delete($target_dir_current_layout.$file_last_changes);

    $wp_filesystem->put_contents($target_dir_current_layout.$file_vars_layout, $get_content_vars_layout);
    $wp_filesystem->put_contents($target_dir_current_layout.$file_last_changes, $get_content_last_changes);
    //return true;
}

?>
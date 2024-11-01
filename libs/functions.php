<?php
require_once( WPFWS_SPIRAL_DIR . '/libs/class.php' );
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
###########################
##　管理画面編集
###########################
// Add management menu "SPIRAL2 WP FORM" and submenu "SPIRAL連携設定"
function wpfws_add_admin_menu(){// 管理メニュー表示用関数
	//move plugin menu to under pugin setting
	global $_wp_last_object_menu;
  	$_wp_last_object_menu++;

	if(current_user_can('administrator')){
	add_menu_page('SPIRAL Form','SPIRAL Form', 'manage_options','wpfws_admin', 'wpfws_output_admin_menu','dashicons-welcome-widgets-menus',$_wp_last_object_menu);
	add_submenu_page('wpfws_admin', 'SPIRAL連携設定', 'SPIRAL連携設定', 'manage_options', 'wpfws_admin', 'wpfws_output_admin_menu');
	}
}

function wpfws_output_admin_menu(){
	if(current_user_can('administrator')){
// WP Form with SPIRAL管理画面表示用関数
	wpfws_update_options();
	include( WPFWS_SPIRAL_DIR . '/views/admin.php' );
	}
}

// Function for displaying management menu
function wpfws_add_wpfws_form_lists(){
	if(current_user_can('administrator')){
	add_submenu_page('wpfws_admin','フォーム一覧','フォーム一覧', 'edit_pages','wpfws_form_lists', 'wpfws_output_form_lists');
	}
}

function wpfws_output_form_lists(){
	if(current_user_can('administrator')){
	include( WPFWS_SPIRAL_DIR . '/views/wpfws_form_lists.php' );
	}
}

// Add new page form
function wpfws_add_new_form(){
	if(current_user_can('administrator')){
	// Add submenu Add New
	add_submenu_page('wpfws_admin','フォーム新規作成','フォーム新規作成', 'edit_pages','wpfws_new', 'wpfws_output_new_form');

	if(isset($_POST['wpfws_save'])){
		wpfws_save_form_meta($_POST['wpfws_post_id']);
	}

	}
}

function wpfws_output_new_form(){
	if(current_user_can('administrator')){
		include( WPFWS_SPIRAL_DIR . '/views/form_meta.php' );
	}
}

#############################
## Record Form
#############################

function wpfws_add_data_record(){
	if(current_user_can('administrator')){
  	add_submenu_page( 'wpfws_admin','データ閲覧','データ閲覧', 'edit_pages','wpfws_record', 'wpfws_output_record_list');
  	}
}
function wpfws_output_record_list(){
	if(current_user_can('administrator')){
  	include( WPFWS_SPIRAL_DIR . '/views/data_record.php' );
  	}
}

################
#Global Variable
################
$base_url= "https://api.spiral-platform.com/v1/";
$soar = "O9qT%Xk9vjFee9IZNaNE8n?6eEZJiUBa";
$get_leksomngat = get_option('wpfws_lek_somngat');
$lek_somngat = wpfws_dos_soar($get_leksomngat, $soar);

function wpfws_update_options(){
	if(current_user_can('administrator')){
	global $soar;
	$lekjbol = wp_generate_password(32, true, true);
	if(isset($_POST['wpfws_lek_somngat'])){$lek_somngat = sanitize_text_field($_POST['wpfws_lek_somngat']);}
	if(isset($_POST['wpfws_lek_somngat'])){$dos_lek_somngat = wpfws_dos_soar($_POST['wpfws_lek_somngat'], $soar);}
	if(isset($_POST['wpfws_app_id'])){$appid = sanitize_text_field($_POST['wpfws_app_id']);}
	if(isset($_POST['SPIRAL_options'])){
		update_user_meta(1,'soarsomngat',$lekjbol);
	    $res = setting_verify($lek_somngat,$appid);
	    if($res){
		  update_setting($lek_somngat,$appid);
	   	}else{
	   		$res_dec = setting_verify($dos_lek_somngat,$appid);
	   		if($res_dec){
	   	  		update_setting($dos_lek_somngat,$appid);
	   		}else{	   		
	   			echo '<div class="notice notice-error" id="first_emsg">';
		    	echo '<p style="color:red;">';
		        print_r("エラーが発生しました"); echo'<br><br>';
		        print_r("エラー:入力内容に誤りがあります。" );echo '<br><br>';
		        print_r("メッセージ:API キーまたはアプリIDが存在しません。"); echo '<br>';
	        	echo '</p>';
	        	echo '</div>';
    		}
	   }
	}

	if(isset($_POST['saveleksomngat'])){
	    $res = setting_verify($lek_somngat,$appid);
	    if($res){
	      update_user_meta(1,'soarsomngat',$lekjbol);
		  update_setting($lek_somngat,$appid);
	   	}else{
	   		$res_dec = setting_verify($dos_lek_somngat,$appid);
	   		if($res_dec){
	   			update_user_meta(1,'soarsomngat',$lekjbol);
	   	  		update_setting($dos_lek_somngat,$appid);
	   		}else{	   		
	   			echo '<div class="notice notice-error" id="lek_errormes">';
		    	echo '<p style="color:red;">';
		        print_r("エラーが発生しました。"); echo'<br>';
		        print_r("入力したAPIキーが存在しないか、権限がありません。");echo '<br>';
		        print_r("SPIRALv2の設定を確認してください。"); echo '<br>';
	        	echo '</p>';
	        	echo '</div>';
    		}
	   	}
	}

	if(isset($_POST['saveapp'])){
	    $res = setting_verify($lek_somngat,$appid);
	    if($res){
		  update_setting($lek_somngat,$appid);
	   	}else{
	   		$res_dec = setting_verify($dos_lek_somngat,$appid);
	   		if($res_dec){
	   	  		update_setting($dos_lek_somngat,$appid);
	   		}else{	   		
	   			echo '<div class="notice notice-error" id="appid_error">';
		    	echo '<p style="color:red;">';
		        print_r("エラーが発生しました。"); echo'<br>';
		        print_r("入力したアプリIDが存在しないか、権限がありません。" );echo '<br>';
		        print_r("SPIRALv2の設定を確認してください。"); echo '<br>';
	        	echo '</h3>';
	        	echo '</div>';
    		}
	   }
	}
}
}

function update_setting($lek_somngat,$appid){
	if(current_user_can('administrator')){
	global $soar;
	add_option('wpfws_lek_somngat', wpfws_jak_soar($lek_somngat, $soar));
	update_option('wpfws_lek_somngat', wpfws_jak_soar($lek_somngat, $soar));

	add_option('wpfws_app_id', $appid);
	update_option('wpfws_app_id', $appid);
	}
}

function setting_verify($lek_somngat,$appid){
	if(current_user_can('administrator')){
		global $base_url;
		$url = $base_url."apps/".$appid;
		$lek_somngat_check = $lek_somngat;
		$args = array(
		    'headers' => array(
		        'Authorization' => 'Bearer ' . $lek_somngat_check,
		        'Content-Type' => 'application/json'
		    )
		);
		$response = json_decode( wp_remote_retrieve_body(wp_remote_get( $url,$args )), true);
		if($response['id'] == $appid && $appid != ''){
			return true;
		}else{
			return false;
		}
	}
}

//get Account check
function setting_get_acc($lek_somngat){
	$check_leksomngat_permission = check_permission($lek_somngat);
	if($check_leksomngat_permission){
		return true;
	}else{
		return false;
	}
}

function prevent_publish(){
	echo '<script type="text/javascript">
	var publish = document.getElementById("publish");
	if (publish !== null) publish.onclick = function(){
		window.scrollTo(500, 0);
	return false;
	};
	</script>';
}

//check api setting v.2
function check_setting() {
	global $lek_somngat;
	$appid = $_POST['wpfws_app_id'] ?: get_option('wpfws_app_id');
	if(strlen($_POST['wpfws_lek_somngat']) == 32){
		$lek_somngat = $_POST['wpfws_lek_somngat'];
	}
	$check_setting = setting_verify($lek_somngat,$appid);

	if(!$check_setting){
	add_action('admin_footer', 'prevent_publish');
	$check_leksomngat = setting_get_acc($lek_somngat);
	$setting_page = admin_url('admin.php?page=wpfws_admin');
		if($check_leksomngat){
		    ?>
		    	<div class="notice notice-warning">
		        	<p id="appid_warning"><?php _e( '使用可能なアプリIDを保存して下さい。<a href="' . esc_url($setting_page) . '">SPIRAL連携設定</a>'); ?></p>
		    	</div>
		    <?php
		}else{
			?>
		    	<div class="notice notice-warning">
		        	<p id="lek_warning"><?php _e( '使用可能なAPIkeyを保存して下さい。<a href="' . esc_url($setting_page) . '">SPIRAL連携設定</a>'); ?></p>
		    	</div>
		    <?php
		}
	}
	//check other error even leksomngat and appid corrected
	else{
		$check_leksomngat_access = check_permission($lek_somngat);
		if(!$check_leksomngat_access){
			?>
				<div class="notice notice-warning notice-warning-access">
					<p id="lek_warning_access"><?php _e('エラーが発生しました。<br/>SPIRALv2の設定を確認してください。'); ?></p>
				</div>
			<?php
		}
	}
	
}

//Check if the it is success or not when access to api /v1/apps
function check_permission($lek_somngat){
	if(current_user_can('administrator')){
		global $base_url;
		global $lek_somngat;
		$url = $base_url."/apps";
		$lek_somngat_check = $lek_somngat;

		$args = array(
		    'headers' => array(
		        'Authorization' => 'Bearer ' . $lek_somngat_check,
		        'Content-Type' => 'application/json'
		    )
		);
		$response = json_decode( wp_remote_retrieve_body(wp_remote_get( $url,$args )), true);
		$res = json_encode($response,true);
		if($response['totalCount']){
			return true;
		}
		else{
			return false;
		}
	}
}


//Check and Update for Version UP
function wpfws_version_up(){
  add_option('wpfws_spiral_form_version','2.0');
  $wpfws_form_list = get_pages();
  foreach ($wpfws_form_list as $value){
  	$wpfws_field_uese = get_post_meta($value->ID, 'wpfws_field_used', true);
  	$wpfws_db_name = get_post_meta($value->ID, 'wpfws_db_name', true);
  	$wpfws_form_name = get_post_meta($value->ID, 'wpfws_form_name', true);
  	$wpfws_display_array = get_post_meta($value->ID, 'wpfws_display', true);
  	$wpfws_form_use = get_post_meta($value->ID, 'wpfws_form_use', true);

    $field_used = array();
    $field_name = array();
    //Update field_used in form_meta
    if($wpfws_db_name && !$wpfws_field_uese && $wpfws_form_use){
      $field_no = count($wpfws_form_name);
  	  $display_no = count($wpfws_display_array);

      for($i=0; $i<$field_no; $i++){
        $field_used[] = '1';
      }

      for($j=0; $j<ceil($field_no/$display_no); $j++){
      	if($j==0){
      		$field_name[] = 'display';
      		$field_name[] = $wpfws_form_name[$j];
      	}else{
      		$field_name[] = $wpfws_form_name[$j];
      	}
      }

      update_post_meta($value->ID,'wpfws_field_used',$field_used);
      update_post_meta($value->ID,'wpfws_fields_name',$field_name);
    }elseif(!$wpfws_db_name && !$wpfws_field_uese && $wpfws_form_use){
    	$field_no = count($wpfws_form_name);
    	for($i=0; $i<$field_no; $i++){
        	$field_used[] = '1';
      	}
		update_post_meta($value->ID,'wpfws_field_used',$field_used);
    }  
  }
}
//checking version up
if(get_option('wpfws_spiral_form_version') != '2.0'){
	add_action( 'admin_notices', 'wpfws_version_up' );
}

function wpfws_output_form_meta(){
	if(current_user_can('administrator')){
	global $post;
	wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
	include( WPFWS_SPIRAL_DIR . '/views/form_meta.php' );
	}
}
###Global data array
	$data_array = array(
		'wpfws_form_required',
		'wpfws_field_used',
		'wpfws_form_type',
		'wpfws_form_label',
		'wpfws_form_name',
		'wpfws_form_placeholder',
		'wpfws_form_pretext',
		'wpfws_form_aftertext',
		'wpfws_form_options',
		'wpfws_start_year',
		'wpfws_end_year',
		'wpfws_year_order',
		'wpfws_date_format',
		'wpfws_date_dr_year',
		'wpfws_date_dr_month',
		'wpfws_date_dr_day',
		'wpfws_confirm_text',
		'wpfws_send_text',
		'wpfws_cancel_text',
		'wpfws_thanks_url',
		'wpfws_thanks_text',
		'wpfws_required_text',
		'wpfws_dropdown_text',
		'wpfws_free_text_footer',
		'wpfws_title',
		'wpfws_free_text_header',
		'wpfws_thankmail_active',
		'wpfws_thankmail_recipient',
		'wpfws_thankmail_recipient_name',
		'wpfws_thankmail_sender',
		'wpfws_thankmail_subject',
		'wpfws_thankmail_body',
		'wpfws_notimail_active',
		'wpfws_notimail_recipient',
		'wpfws_notimail_recipient_name',
		'wpfws_notimail_sender',
		'wpfws_notimail_subject',
		'wpfws_notimail_body',
		'wpfws_app_id_form',
	);
	$data_array_body = array(
		'wpfws_form_required',
		'wpfws_field_used',
		'wpfws_form_type',
		'wpfws_form_label',
		'wpfws_form_name',
		'wpfws_form_placeholder',
		'wpfws_form_pretext',
		'wpfws_form_aftertext',
		'wpfws_form_options',
		'wpfws_start_year',
		'wpfws_end_year',
		'wpfws_year_order',
		'wpfws_date_format',
		'wpfws_date_dr_year',
		'wpfws_date_dr_month',
		'wpfws_date_dr_day'
	);
	$data_array_footer = array(
		'wpfws_confirm_text',
		'wpfws_send_text',
		'wpfws_cancel_text',
		'wpfws_thanks_url',
		'wpfws_thanks_text',
		'wpfws_required_text',
		'wpfws_dropdown_text',
		'wpfws_free_text_footer',
		'wpfws_title',
		'wpfws_free_text_header',
		'wpfws_thankmail_active',
		'wpfws_notimail_active'
	);
	$data_array_thankmail = array(
		'wpfws_thankmail_recipient',
		'wpfws_thankmail_recipient_name',
		'wpfws_thankmail_sender',
		'wpfws_thankmail_subject',
		'wpfws_thankmail_body'
	);
	$data_array_notimail = array(
		'wpfws_notimail_recipient',
		'wpfws_notimail_recipient_name',
		'wpfws_notimail_sender',
		'wpfws_notimail_subject',
		'wpfws_notimail_body'
	);
###End Global data_array

//Save form meta
function wpfws_save_form_meta($post_id){
	if(current_user_can('administrator')){

	//Update form-list UpdatedAt
	$now = gmdate("Y-m-d\TH:i:s\Z");
	update_post_meta($post_id, 'wpfws_updatedAt', $now);

	//click on Update or Publish button
	global $data_array;
	global $data_array_body;

	
	$wpfws_db_name = get_post_meta($post_id,'wpfws_db_name',true);
	$wpfws_display_array = get_post_meta($post_id,'wpfws_display',true);
	$wpfws_label_array = get_post_meta($post_id,'wpfws_form_label',true);
	$wpfws_name_array = get_post_meta($post_id,'wpfws_form_name',true);
	$wpfws_fields_id_array = explode(',', $_POST['hidden_field_id']);

	$no_display = 0;
	if(! empty($wpfws_display_array)){
		foreach($wpfws_display_array as $j => $value){
			if(sanitize_text_field($_POST['display']) == $value){
				$no_display = $j;
			}
		}
	}

	if(isset($_POST['confirm_add'])){
		wpfws_add_new_display($post_id);
	}elseif(isset($_POST['deletedisplay'])){
		wpfws_delete_display($post_id);
	}elseif(isset($_POST['save_display'])){
   		wpfws_edit_form_meta($post_id);
	}elseif(isset($_POST['save_display_edit'])){
		wpfws_display_edit($post_id);
	}elseif(isset($_POST['wpfws_page']) && $_POST['wpfws_page'] == 'wpfws_new'){
		add_post_meta($post_id, 'wpfws_display', array("default") , true);
		add_post_meta($post_id, 'wpfws_form_use', 1 , true);
		add_post_meta($post_id, 'wpfws_used_thankmail', $_POST['wpfws_used_thankmail'], true);
		add_post_meta($post_id, 'wpfws_used_notimail', $_POST['wpfws_used_notimail'], true);
		foreach($data_array as $key){
			add_post_meta($post_id, $key, sanitize_array(array_values($_POST[$key])), true);
		}
		// Update post
	  	$my_post = array(
	      'ID'           => $post_id,
	      'post_status' => 'publish',
	      'post_title'	=> ''
	  	);

		// Update the post into the database
	  	wp_update_post( $my_post );

	  	$url = '?post='.$post_id.'&page=wpfws_form_lists&action=edit';
		wp_redirect($url);
	}elseif(isset($_POST['wpfws_save']) && $no_display == 0 && $wpfws_db_name != ''){
		$field_array = array();
		$field_array = array_values($_POST['wpfws_fields_id']);

		foreach ($field_array as $field_key => $value){
			if($value == 'new'){
				$new_field_key[] = strval($field_key);
			}
		}

		$key = array_keys(array_diff(array_slice($wpfws_fields_id_array,1), $field_array));
		$delete_field_key = array_map('strval', $key);

		foreach ($data_array_body as $bkey) {
			$index = ceil(count($wpfws_label_array)/count($wpfws_display_array));
			$iZero = array_values(sanitize_array($_POST[$bkey]));
			$field_del = get_post_meta($post_id,$bkey,true);

		if(!empty($delete_field_key)){
			foreach ($delete_field_key as $dkey){
				$pos = array_map('strval', array_keys($wpfws_name_array, $wpfws_name_array[($dkey)]));
				foreach ($pos as $dkey) {
					unset($field_del[$dkey]);
				}
			}
			$af_delete = array_values($field_del);
		}else{
			$af_delete = get_post_meta($post_id,$bkey,true);
		}

		$new_index = $index-count($delete_field_key);
		$oriData = array_splice($af_delete , $new_index);
		$data = wp_parse_args($oriData,$iZero);

		if(!empty($new_field_key)){
			$inserted = array();
			foreach ($new_field_key as $nkey){
				if($bkey == 'wpfws_field_used'){
					$inserted[] = '0';
				}else{
					$inserted[] = $iZero[$nkey];
				}
			}
			foreach ($wpfws_display_array as $dkey => $display) {
				if($dkey == 0){continue;}
				array_splice( $data, ($new_index*($dkey+1)+(count($new_field_key)*$dkey)), 0, $inserted );
			}
		}	
			update_post_meta($post_id, $bkey, $data);
		}

		update_post_meta($post_id, 'wpfws_db_name', sanitize_text_field($_POST['wpfws_title'][0]));
		wpfws_edit_form_meta_Fdisplay($post_id);

	}elseif($no_display > 0 && isset($_POST['wpfws_save'])){
		wpfws_edit_form_meta($post_id);
	}
	}
}

//click on Save button on Add new display popup
function wpfws_add_new_display($post_id){
	if(current_user_can('administrator')){
	global $data_array_body;
	global $data_array_footer;
	global $data_array_thankmail;
	global $data_array_notimail;
	$wpfws_label_array = get_post_meta($post_id,'wpfws_form_label',true);
	$wpfws_display_array = get_post_meta($post_id,'wpfws_display',true);
	$wpfws_display = sanitize_array( $_POST['wpfws_display'] );
	$wpfws_used_thankmail = get_post_meta($post_id,'wpfws_used_thankmail',true);
	$wpfws_used_notimail = get_post_meta($post_id,'wpfws_used_notimail',true);

	foreach($wpfws_label_array as $i => $wpfws_name);
	foreach($wpfws_display_array as $j => $valuedisplay);
	$oriData = array();

	foreach($data_array_body as $key){
		for($kkey = 0 ; $kkey<=ceil(($i+1)/($j+1)) ; $kkey++){
			$data_wpdb = get_post_meta($post_id, $key, true);
			$oriData = array_splice($data_wpdb, 0, $kkey);
		}
		$data = wp_parse_args($oriData, get_post_meta($post_id, $key, true));
		update_post_meta($post_id, $key, $data);
	}

	foreach($data_array_footer as $key){
		$data_wpdb = get_post_meta($post_id, $key, true);
		$oriData = array_splice($data_wpdb, 0, 1);

		$data = wp_parse_args($oriData, get_post_meta($post_id, $key, true));
		update_post_meta($post_id, $key, $data);
	}

	foreach ($data_array_thankmail as $key) {
			$data_wpdb = get_post_meta($post_id, $key, true);
			$oriData = array_splice($data_wpdb, 0, 1);

			$data = wp_parse_args($oriData, get_post_meta($post_id, $key, true));
			update_post_meta($post_id, $key, $data);
	}
	foreach ($data_array_notimail as $key) {
			$data_wpdb = get_post_meta($post_id, $key, true);
			$oriData = array_splice($data_wpdb, 0, 1);

			$data = wp_parse_args($oriData, get_post_meta($post_id, $key, true));
			update_post_meta($post_id, $key, $data);
	}

		$display = wp_parse_args($wpfws_display, get_post_meta($post_id, 'wpfws_display', true));
		update_post_meta($post_id, 'wpfws_display', $display);

		//redirect
		$display_input = implode("", $wpfws_display);
		$url = admin_url('/admin.php?page=wpfws_form_lists&action=edit&display='.$display_input.'&post='.$post_id.'');
		header('Location: ' .$url. '#sptop ');
		exit();
	}
}

//click on Save button the buttom of page
function wpfws_edit_form_meta($post_id){
	if(current_user_can('administrator')){
	global $data_array_body;
	global $data_array_footer;
	global $data_array_thankmail;
	global $data_array_notimail;
	//base on display select
	$wpfws_label_array = get_post_meta($post_id,'wpfws_form_label',true);
	$wpfws_display_array = get_post_meta($post_id,'wpfws_display',true);
	$wpfws_used_thankmail = get_post_meta($post_id,'wpfws_used_thankmail',true);
	$wpfws_used_notimail = get_post_meta($post_id,'wpfws_used_notimail',true);
	$dbid = get_post_meta($post_id,'wpfws_db_id',true);
	$response_db = wpfws_set_URL("dbs/".$dbid);
	if(get_post_meta($post_id,'wpfws_app_id_form',true)){
	update_post_meta($post_id,'wpfws_app_id_form',$response_db['app']['id']);
	}else{
		add_post_meta($post_id,'wpfws_app_id_form',$response_db['app']['id']);
	}
	foreach($wpfws_label_array as $i => $wpfws_name);
	foreach($wpfws_display_array as $j => $valuedisplay);

	if(isset($_POST['display'])){
		foreach ($wpfws_display_array as $x => $value){
			if($value == $_POST['display']){
				$ll=$x;
				break;
			}else
				$ll=0;
		}
	}else
		$ll=0;
	//save change the body array
	$start = ($ll*ceil(($i+1)/($j+1)));
	$end = ceil(($i+1)/($j+1))*($ll+1);
	foreach($data_array_body as $bkey){
		$record = get_post_meta($post_id, $bkey, true);
		$get_record_body = array_values(sanitize_array($_POST[$bkey]));
		for($kkey=$start ; $kkey<$end ; $kkey++){
			if(strcmp($record[$kkey], $get_record_body[($kkey-$start)])){
				$replace_data = array($kkey => $get_record_body[($kkey-$start)]); 
				$data_body_update = array_replace(get_post_meta($post_id, $bkey, true) , $replace_data);
				update_post_meta($post_id, $bkey, $data_body_update);
			}
		}
	}

	//save change the footer array
	foreach($data_array_footer as $fkey){
		$record = get_post_meta($post_id, $fkey, true);
		$get_record_footer = sanitize_array($_POST[$fkey]);
		//$ll is value for specific display
		if(strcmp($record[$ll], $get_record_footer[$ll])){
			$replace_data = array($ll => $get_record_footer[$ll]); 
			$data_footer_update = array_replace(get_post_meta($post_id, $fkey, true) , $replace_data);
			update_post_meta($post_id, $fkey, $data_footer_update);
		}
	}

	//save change the mail array
	foreach($data_array_thankmail as $fkey){
		$record = get_post_meta($post_id, $fkey, true);
		$get_record_footer = sanitize_array($_POST[$fkey]);
		//$ll is value for specific display
		if(strcmp($record[$ll], $get_record_footer[$ll])){
			$replace_data = array($ll => $get_record_footer[$ll]); 
			$data_footer_update = array_replace(get_post_meta($post_id, $fkey, true) , $replace_data);
			update_post_meta($post_id, $fkey, $data_footer_update);
		}
	}
	//Update thank mail content to all display
	if ( $_POST['wpfws_used_thankmail'] == 1 ) {
		update_post_meta($post_id, 'wpfws_used_thankmail', $_POST['wpfws_used_thankmail']);
		foreach ($data_array_thankmail as $key) {
			$data = array();
			foreach ($wpfws_display_array as $dkey => $display) {
				$data_wpdb = get_post_meta($post_id, $key, true);
				$oriData = array_splice($data_wpdb, $ll, 1);

				$data = array_merge($data, $oriData);
			}
			update_post_meta($post_id, $key, $data);
		}
	}

	//save change the mail array
	foreach($data_array_notimail as $fkey){
		$record = get_post_meta($post_id, $fkey, true);
		$get_record_footer = sanitize_array($_POST[$fkey]);
		//$ll is value for specific display
		if(strcmp($record[$ll], $get_record_footer[$ll])){
			$replace_data = array($ll => $get_record_footer[$ll]); 
			$data_footer_update = array_replace(get_post_meta($post_id, $fkey, true) , $replace_data);
			update_post_meta($post_id, $fkey, $data_footer_update);
		}
	}
	//Update noti mail content to all display
	if ( $_POST['wpfws_used_notimail'] == 1 ) {
		update_post_meta($post_id, 'wpfws_used_notimail', $_POST['wpfws_used_notimail']);
		foreach ($data_array_notimail as $key) {
			$data = array();
			foreach ($wpfws_display_array as $dkey => $display) {
				$data_wpdb = get_post_meta($post_id, $key, true);
				$oriData = array_splice($data_wpdb, $ll, 1);

				$data = array_merge($data, $oriData);
			}
			update_post_meta($post_id, $key, $data);
		}
	}

	//redirect base on display selected
	if(isset($_POST['display'])){
		$url = sanitize_text_field($_POST['select_display']);
		header('Location: ' .$url. '');
		exit();
	}
	}
}

function wpfws_edit_form_meta_Fdisplay($post_id){
	if(current_user_can('administrator')){
	global $data_array_footer;
	global $data_array_thankmail;
	global $data_array_notimail;
	//base on display select
	$wpfws_label_array = get_post_meta($post_id,'wpfws_form_label',true);
	$wpfws_display_array = get_post_meta($post_id,'wpfws_display',true);
	$wpfws_form_name_disable = array_values($_POST['wpfws_form_name_disable']);
	$index = ceil(count($wpfws_label_array)/count($wpfws_display_array));

	if(isset($_POST['display'])){
		foreach ($wpfws_display_array as $x => $value){
			if($value == $_POST['display']){
				$ll=$x;
				break;
			}else
				$ll=0;
		}
	}else
		$ll=0;

	//Update Form name when first display has changes
	$wpfws_name_array = get_post_meta($post_id,'wpfws_form_name',true);
	foreach ($wpfws_form_name_disable as $nkey => $value) {
		foreach ($wpfws_display_array as $lkey => $lang) {
			if ($lkey == 0) continue;
			for ($i=($index*$lkey); $i<($index*($lkey+1)); $i++) {
				if ($value == $wpfws_name_array[$i]) {
					$replace_data[] = array($i => $wpfws_name_array[$nkey]);
					break;
				}
			}
		}
	}
	foreach ($replace_data as $key => $value) {
		$data_body_update = array_replace(get_post_meta($post_id,'wpfws_form_name',true) , $value);
		update_post_meta($post_id, 'wpfws_form_name', $data_body_update);
	}

	//save change the footer array
	foreach($data_array_footer as $fkey){
		$record = get_post_meta($post_id, $fkey, true);
		$get_record_footer = sanitize_array($_POST[$fkey]);
		//$ll is value for specific display
		if(strcmp($record[$ll], $get_record_footer[$ll])){
			$replace_data = array($ll => $get_record_footer[$ll]); 
			$data_footer_update = array_replace(get_post_meta($post_id, $fkey, true) , $replace_data);
			update_post_meta($post_id, $fkey, $data_footer_update);
		}
	}
	
	//save change the mail array
	foreach($data_array_thankmail as $fkey){
		$record = get_post_meta($post_id, $fkey, true);
		$get_record_footer = sanitize_array($_POST[$fkey]);
		//$ll is value for specific display
		if(strcmp($record[$ll], $get_record_footer[$ll])){
			$replace_data = array($ll => $get_record_footer[$ll]); 
			$data_footer_update = array_replace(get_post_meta($post_id, $fkey, true) , $replace_data);
			update_post_meta($post_id, $fkey, $data_footer_update);
		}
	}

	//save change the mail array
	foreach($data_array_notimail as $fkey){
		$record = get_post_meta($post_id, $fkey, true);
		$get_record_footer = sanitize_array($_POST[$fkey]);
		//$ll is value for specific display
		if(strcmp($record[$ll], $get_record_footer[$ll])){
			$replace_data = array($ll => $get_record_footer[$ll]); 
			$data_footer_update = array_replace(get_post_meta($post_id, $fkey, true) , $replace_data);
			update_post_meta($post_id, $fkey, $data_footer_update);
		}
	}

	$wpfws_thankmail_recipient = get_post_meta($post_id,'wpfws_thankmail_recipient',true);
	$wpfws_thankmail_active = get_post_meta($post_id,'wpfws_thankmail_active',true);
	$wpfws_notimail_recipient = get_post_meta($post_id,'wpfws_notimail_recipient',true);
	$wpfws_notimail_active = get_post_meta($post_id,'wpfws_notimail_active',true);
	
	//Update thank mail content to all display
	if ( $_POST['wpfws_used_thankmail'] == 1 || (empty($wpfws_thankmail_recipient[1]) && $wpfws_thankmail_active[0]==1 )) {
		update_post_meta($post_id, 'wpfws_used_thankmail', $_POST['wpfws_used_thankmail']);
		foreach ($data_array_thankmail as $key) {
			$data = array();
			foreach ($wpfws_display_array as $dkey => $display) {
				$data_wpdb = get_post_meta($post_id, $key, true);
				$oriData = array_splice($data_wpdb, $ll, 1);

				$data = array_merge($data, $oriData);
			}
			update_post_meta($post_id, $key, $data);
		}
	} else {
		update_post_meta($post_id, 'wpfws_used_thankmail', $_POST['wpfws_used_thankmail']);
	}

	//Update  noti mail content to default
	if ( $_POST['wpfws_used_notimail'] == 1 || (empty($wpfws_notimail_recipient[1]) && $wpfws_notimail_active[0]==1 )) {
		update_post_meta($post_id, 'wpfws_used_notimail', $_POST['wpfws_used_notimail']);
		foreach ($data_array_notimail as $key) {
			foreach ($wpfws_display_array as $dkey => $display) {
				if ( $dkey == 0 ) continue;
				$data_wpdb = get_post_meta($post_id, $key, true);
				$oriData = array_splice($data_wpdb, 0, 1);

				$data = wp_parse_args($oriData, array_splice(get_post_meta($post_id, $key, true), 0, $dkey), true);
				update_post_meta($post_id, $key, $data);
			}
		}
	} else {
		update_post_meta($post_id, 'wpfws_used_notimail', $_POST['wpfws_used_notimail']);
	}

	//redirect base on display selected
	if ( isset($_POST['display']) ) {
		$url = sanitize_text_field($_POST['select_display']);
		header('Location: ' .$url. '');
		exit();
	}
	}
}

//display title edit
function wpfws_display_edit($post_id){
	if(current_user_can('administrator')){
	$wpfws_display_array = get_post_meta($post_id,'wpfws_display',true);
	$get_input_display = sanitize_array($_POST['wpfws_display_edit']);
	if($wpfws_display_array){
		foreach ($wpfws_display_array as $x => $value) {
			if($value == $_POST['display']){
				$ll=$x;
				break;
			}else 
				$ll = 0;
		}
	}
	if(strcmp($wpfws_display_array[$ll], $get_input_display[$ll])){
		$replace_data = array($ll => $get_input_display[$ll]); 
		$data_update = array_replace(get_post_meta($post_id, 'wpfws_display', true) , $replace_data);
		update_post_meta($post_id, 'wpfws_display', $data_update);
	}

	//redirect base on display selected
	if($get_input_display){
		$url = admin_url('/admin.php?page=wpfws_form_lists&action=edit&display='. $get_input_display[$ll] .'&post='.$post_id.'#sptop');
		header('Location: ' .$url. ' ');
		exit();
	}
	}
}

function wpfws_dos_soar($lek_somngat, $soar){
	$lekjbol = get_user_meta(1,'soarsomngat',true);
	$c = base64_decode($lek_somngat);
	$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
	$iv = substr($c, 0, $ivlen);
	$hmac = substr($c, $ivlen, $sha2len=32);
	$lek_kae_rouch_raw = substr($c, $ivlen+$sha2len);
	$original_lekderm = openssl_decrypt($lek_kae_rouch_raw, $cipher, $soar.$lekjbol, $options=OPENSSL_RAW_DATA, $iv);
	$calcmac = hash_hmac('sha256', $lek_kae_rouch_raw, $soar.$lekjbol, $as_binary=true);
	if($c){
	if (hash_equals($hmac, $calcmac))
	{
	    return $original_lekderm;
	}
	}
}

//click on Delete button the to delete specific display
function wpfws_delete_display($post_id){
	if(current_user_can('administrator')){
	global $data_array_body;
	global $data_array_footer;
	global $data_array_thankmail;
    global $data_array_notimail;
	$wpfws_label_array = get_post_meta($post_id,'wpfws_form_label',true);
	$wpfws_display_array = get_post_meta($post_id,'wpfws_display',true);
	foreach($wpfws_label_array as $i => $wpfws_name);
	if($wpfws_display_array){
		foreach ($wpfws_display_array as $x => $value) {
			if($value == $_POST['display']){
				$ll= $x;
				break;
			}
		}
	}

	//Delete the display
	$record_display = array();
	if($wpfws_display_array){
		foreach($wpfws_display_array as $j => $value_display){
			$record_display[] = $value_display;
		}
	}
	array_splice($record_display, $ll, 1);
	update_post_meta($post_id, 'wpfws_display', $record_display);

	//Delete the body array
	foreach($data_array_body as $bkey){
		$record_body = get_post_meta($post_id, $bkey, true);
		$record_body_array = array();

		foreach ($record_body as $value_body){
			$record_body_array[] = $value_body;
		}	
		$start = ($ll*ceil(($i+1)/($j+1)));
		$end = ceil(($i+1)/($j+1));
		array_splice($record_body_array, $start, $end);
		update_post_meta($post_id, $bkey, $record_body_array);
	}

	//Delete the footer array
	foreach($data_array_footer as $fkey){
		$record_footer = get_post_meta($post_id, $fkey, true);
		$record_footer_array = array();

		foreach ($record_footer as $value_footer){
			$record_footer_array[] = $value_footer;
		}
			array_splice($record_footer_array,$ll, 1);
			update_post_meta($post_id, $fkey, $record_footer_array);
	}

	//Delete mail array
    foreach($data_array_thankmail as $fkey){
        $record_thankmail = get_post_meta($post_id, $fkey, true);
        $record_thankmail_array = array();

        foreach ($record_thankmail as $value_footer){
            $record_thankmail_array[] = $value_footer;
        }
            array_splice($record_thankmail_array,$ll, 1);
            update_post_meta($post_id, $fkey, $record_thankmail_array);
    }

    foreach($data_array_notimail as $fkey){
        $record_notimail = get_post_meta($post_id, $fkey, true);
        $record_notimail_array = array();

        foreach ($record_notimail as $value_footer){
            $record_notimail_array[] = $value_footer;
        }
            array_splice($record_notimail_array,$ll, 1);
            update_post_meta($post_id, $fkey, $record_notimail_array);
    }

	//redirect base on display selected
		$url = admin_url('/admin.php?page=wpfws_form_lists&action=edit&&post='.$post_id);
		header('Location: ' .$url. ' ');
		exit();
	}
}

#############################
## Send mail php mailer
#############################
//Send Thank Mail
function wpfws_send_thank_mail_phpmailer($post_id,$display,$recipient){
	require_once(WPFWS_SPIRAL_DIR . '/vendor/autoload.php');
	$wpfws_recipient = $recipient;
    $wpfws_recipient_name = get_post_meta($post_id,'wpfws_thankmail_recipient_name',true);
    $wpfws_sender = get_post_meta($post_id,'wpfws_thankmail_sender',true);
    $wpfws_subject = get_post_meta($post_id,'wpfws_thankmail_subject',true);
    $wpfws_body = get_post_meta($post_id,'wpfws_thankmail_body',true);

	$mail = new PHPMailer; 
	$mail->CharSet = 'UTF-8';
	$mail->From = html_entity_decode($wpfws_sender[$display]);
	$mail->FromName = html_entity_decode($wpfws_recipient_name[$display]);
	$mail->addAddress($wpfws_recipient);

	$mail->Subject = html_entity_decode($wpfws_subject[$display]);
	$mail->Body = html_entity_decode($wpfws_body[$display]);
	if(!$mail->send()){
		if(!empty($wpfws_recipient)){
	    	echo $mail->ErrorInfo;
		}
	}
}

//Send Notification Mail
function wpfws_send_noti_mail_phpmailer($post_id,$display,$recipient){
	require_once(WPFWS_SPIRAL_DIR . '/vendor/autoload.php');
	$wpfws_recipient = $recipient;
    $wpfws_recipient_name = get_post_meta($post_id,'wpfws_notimail_recipient_name',true);
    $wpfws_sender = get_post_meta($post_id,'wpfws_notimail_sender',true);
    $wpfws_subject = get_post_meta($post_id,'wpfws_notimail_subject',true);
    $wpfws_body = get_post_meta($post_id,'wpfws_notimail_body',true);

	$mail = new PHPMailer; 
	$mail->CharSet = 'UTF-8';
	$mail->From = html_entity_decode($wpfws_sender[$display]);
	$mail->FromName = html_entity_decode($wpfws_recipient_name[$display]);
	$mail->addAddress($wpfws_recipient);

	$mail->Subject = html_entity_decode($wpfws_subject[$display]);
	$mail->Body = html_entity_decode($wpfws_body[$display]);

	if(!$mail->send()){
		if(!empty($wpfws_recipient)){
	    	echo $mail->ErrorInfo;
		}
	}
}

###########################
##　フォーム生成
###########################

function wpfws_form_output($post_id, $dkey){

	// Get the current phase
	$phase = isset($_GET['phase']) ? sanitize_text_field($_GET['phase']) : 'input';

	// Get the form name
	$wpfws_name_array = get_post_meta($post_id,'wpfws_form_name',true);

	// Create form element class from setting item
	$wpfws_form_element_array = new wpfws_form_element_array($post_id, $dkey);
	
	switch ($phase) {
		case 'confirm'://Process at confirmation screen
			$return = $wpfws_form_element_array->create_confirm();
			break;
		case 'send':
			if ( isset($_POST['wpfws_nonce']) ) {
				if ( wp_verify_nonce($_POST['wpfws_nonce'], 'wpfws-nonce') ) {
					$response = $wpfws_form_element_array->wpfws_insert_SPIRAL();

					//Data Insert To Spiral Successfully
		    		if ( $response['item'] ) {
		    			$wpfws_thanks_url_array = get_post_meta($post_id, 'wpfws_thanks_url',true);
		    			$wpfws_thankmail_active = get_post_meta($post_id,'wpfws_thankmail_active',true);
						$wpfws_notimail_active = get_post_meta($post_id,'wpfws_notimail_active',true);
						$wpfws_thankmail_recipient_array = get_post_meta($post_id,'wpfws_thankmail_recipient',true);
						$wpfws_notimail_recipient_array = get_post_meta($post_id,'wpfws_notimail_recipient',true);

							//Send an email function
							if ( $wpfws_thanks_url_array[$dkey] != '' ) {

								//Send an thank-email function
								if ( $wpfws_thankmail_active[0] == 1 ) {
									wpfws_send_thank_mail_phpmailer($post_id, $dkey, $_POST[$wpfws_thankmail_recipient_array[$dkey]]);
								}

								//Send an notification-email function 
								if ( $wpfws_notimail_active[0] == 1 ) {
								    wpfws_send_noti_mail_phpmailer($post_id, $dkey, $wpfws_notimail_recipient_array[$dkey]);
								}

								//Redirect to Thank URL
								$thanks_url = esc_url($wpfws_thanks_url_array[$dkey]);
								?>
									<script type='text/javascript'>
										window.location = '<?php echo $thanks_url; ?>';
									</script>
								<?php

							} else {

								//Send an thank-email function 
							    if ( $wpfws_thankmail_active[0] == 1) {
							    	wpfws_send_thank_mail_phpmailer($post_id, $dkey, $_POST[$wpfws_thankmail_recipient_array[$dkey]]);
							    }

							    //Send an notification-email function 
							    if ( $wpfws_notimail_active[0] == 1 ) {
							    	wpfws_send_noti_mail_phpmailer($post_id, $dkey, $wpfws_notimail_recipient_array[$dkey]);
							    }

							    //Redirect to Thank Page
							    $post_status = get_post_status( get_the_ID() );
								$thank_url = '';

								//Check the status of page
								//If post status is daft
								if ( $post_status == 'draft') {
									$permalink = get_permalink( get_the_ID() );
									$thank_url = $permalink.'&phase=thanks';
								} else {
									$thank_url = '?phase=thanks';
								}

								?>
									<script type='text/javascript'>
										window.location = "<?php echo $thank_url; ?>";
									</script>
								<?php
							}

					//Return show error can't insert to Spiral		
		    		} else {
		    			?>
				            <div style="margin:auto; max-width: 58rem; ">
				                <p style="color:red;">エラーが発生しました。</p>
				            </div>
			            <?php
		    		}

				} else {
					echo 'nonce verification failed';
					exit;
				}
			}
			break;
		case 'thanks':
			$wpfws_thanks_text = get_post_meta($post_id, 'wpfws_thanks_text', true);

		    if ( $wpfws_thanks_text ) {
		    	$return = '<div class="thank_text">'.esc_html($wpfws_thanks_text[$dkey]).'</div>' ;
		    } else {
		    	$return = '<div class="thank_text">お問い合わせありがとうございます。</div>';
		    }

			break;
		default:
			$return = $wpfws_form_element_array->create_input();
			break;
	}
	return $return;
}

//Shortcode [wpfws_form]
function sc_wpfws_form_output($atts){
	static $already_run = false;
    if ( $already_run !== true ) {
    	$already_run = true;
		// Attributes
		$atts = shortcode_atts(
			array(
				'id' => '',
				'display' => ''
			),
			$atts,
			'link-to-post'
		);

		$post_id_shortcode = $atts['id'];
		$display_shortcode = $atts['display'];

		//Get the current display
		$post_id = isset($_GET['post']) ? sanitize_text_field($_GET['post']) : $post_id_shortcode;
		$get_display = isset($_GET['display']) ? sanitize_text_field($_GET['display']) : '';

		$wpfws_display_array = get_post_meta($post_id, 'wpfws_display',true);
		if (is_array($wpfws_display_array)) $display_check = in_array($get_display, $wpfws_display_array) ? sanitize_text_field($_GET['display']) : $display_shortcode;

		// Return only if has ID attribute
		if (! empty($post_id) && ! empty($display_check)) {

			$display_num = wpfws_check_display_value($post_id, $display_check);
			return wpfws_form_output($post_id, $display_num);

		} else if (! empty($post_id) && empty($display_check)) {

			return wpfws_form_output($post_id, 0);

		} else if ( empty($post_id) && empty($display_check)) {

			return wpfws_form_output(get_the_ID(), 0);

		} else {

			$display_num = wpfws_check_display_value(get_the_ID(), $display_check);
			return wpfws_form_output(get_the_ID(), $display_num);

		}
    }
}

function wpfws_check_display_value($post_id, $display){
	$wpfws_display_array = get_post_meta($post_id, 'wpfws_display',true);
	if(! empty($wpfws_display_array)){
		foreach ($wpfws_display_array as $fkey => $value) {
			if($value == $display)
			{
				$dkey = $fkey;
				break;
			} else {
				$dkey = 0;
			}
		}
		return $dkey;
	}
}

function wpfws_set_URL($locat){
	if(current_user_can('administrator')){
		global $base_url;
		$url = $base_url.$locat;
		global $lek_somngat;
		$args = array(
		    'headers' => array(
		        'Authorization' => 'Bearer ' . $lek_somngat,
		        'Content-Type' => 'application/json'
		    )
		);
		$response = json_decode( wp_remote_retrieve_body(wp_remote_get( $url,$args )), true);
		return $response;
	}
}

###Convert Timezone
function convert_tz($source){
	if(current_user_can('administrator')){
	$userTimezone = new DateTimeZone('Asia/Tokyo');
	$utcTimezone = new DateTimeZone('UTC');
	$myDateTime = new DateTime($source, $utcTimezone);
	$offset = $userTimezone->getOffset($myDateTime);
	$myInterval=DateInterval::createFromDateString((string)$offset . 'seconds');
	$myDateTime->add($myInterval);
	$result = $myDateTime->format('Y-m-d H:i:s');
	return $result;
    }
}

function wpfws_jak_soar($lek_somngat, $soar){
	if(current_user_can('administrator')){
	$lekjbol = get_user_meta(1,'soarsomngat',true);
	$lekderm = $lek_somngat;
	$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
	$iv = openssl_random_pseudo_bytes($ivlen);
	$lek_kae_rouch_raw = openssl_encrypt($lekderm, $cipher, $soar.$lekjbol, $options=OPENSSL_RAW_DATA, $iv);
	$hmac = hash_hmac('sha256', $lek_kae_rouch_raw, $soar.$lekjbol, $as_binary=true);
	$lek_kae_rouch = base64_encode( $iv.$hmac.$lek_kae_rouch_raw );
	return $lek_kae_rouch;
	}
}

//sanitize Array
function sanitize_array ($data = array()) {
	if(current_user_can('administrator')){
	if (!is_array($data) || !count($data)) {
		return array();
	}
	foreach ($data as $k => $v) {
		if (!is_array($v) && !is_object($v)) {
			$data[$k] = htmlspecialchars(trim($v));
		}
		if (is_array($v)) {
			$data[$k] = sanitize_array($v);
		}
	}
	return $data;
	}
}

//Set to default shortcode "Preview"
function wpfws_set_to_default_shortcode(){
	$args = array(
	  'posts_per_page' => '-1',
	  'offset' => 0,
	  'post_type' => 'wpfws_page',
	  'post_status' => 'publish'
	); 
	$wpfws_forms = get_posts($args);

	if(isset($_GET['page']) && sanitize_text_field( $_GET['page'] ) == 'wpfws_form_lists'){
		if(! empty($wpfws_forms)){
		  foreach ($wpfws_forms as $form) {
		  		// Update post
				$my_post = array(
					'ID'           => $form->ID,
					'post_title'	=> '',
					'post_content' => '[wpfws_form id="'.$form->ID.'"]'
				);

				// Update the post into the database
				wp_update_post( $my_post );
		  }
		}
	}
}

/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function wpfws_pagetype_init() {
	$labels = array(
		'name'               => _x( 'wpfws_pages', 'post type general name', 'spiral-form' ),
		'singular_name'      => _x( 'wpfws_page', 'post type singular name', 'spiral-form' ),
		'menu_name'          => _x( 'wpfws_pages', 'admin menu', 'spiral-form' ),
		'name_admin_bar'     => _x( 'wpfws_page', 'add new on admin bar', 'spiral-form' ),
		'add_new'            => _x( 'Add New', 'wpfws_page', 'spiral-form' ),
		'add_new_item'       => __( 'Add New wpfws_page', 'spiral-form' ),
		'new_item'           => __( 'New wpfws_page', 'spiral-form' ),
		'edit_item'          => __( 'Edit wpfws_page', 'spiral-form' ),
		'view_item'          => __( 'View wpfws_page', 'spiral-form' ),
		'all_items'          => __( 'All wpfws_pages', 'spiral-form' ),
		'search_items'       => __( 'Search wpfws_pages', 'spiral-form' ),
		'parent_item_colon'  => __( 'Parent wpfws_pages:', 'spiral-form' ),
		'not_found'          => __( 'No wpfws_pages found.', 'spiral-form' ),
		'not_found_in_trash' => __( 'No wpfws_pages found in Trash.', 'spiral-form' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'spiral-form' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => false,
		'show_in_menu'       => false,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'wpfws_page', 'with_front' => FALSE),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'wpfws_page', $args );
}

function my_rewrite_flush() {
    wpfws_pagetype_init();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}

function myscript() {
if ( isset($_GET['action']) && sanitize_text_field( $_GET['action'] ) == 'preview' ) {
		?>
			<script type='text/javascript'>
				document.getElementById("input_sub_btn").disabled = true;
		    </script>
		<?php
	}
}
add_action( 'wp_footer', 'myscript' );
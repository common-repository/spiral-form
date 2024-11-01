<?php
/**
 * 固定ページ＞新規作成　のメタボックスの内容
 *
 * @package   Spiral_Form
 * @author    PIPED BITS Co.,Ltd.
 */
?>
<?php
$path = dirname(__dir__);
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

$id = $_POST['post_id'];
$App_ID = get_option('wpfws_app_id');
$dbid = get_post_meta($id,'wpfws_db_id',true);
$name_of_db = stripslashes($_POST['wpfws_db_name']);

//API
global $base_url;
$url = $base_url."dbs/".$dbid;
global $lek_somngat;

$wpfws_order_fields = stripslashes_deep($_POST['wpfws_order_fields']);
$wpfws_update_fields = stripslashes_deep($_POST['wpfws_update_fields']);
$wpfws_new_fields = stripslashes_deep($_POST['wpfws_new_fields']);
$wpfws_delete_fields = stripslashes_deep($_POST['wpfws_delete_fields']);

if(isset($_POST['type']) && $_POST['type'] == 'update_db'){
	$body = [
		"displayName" => $name_of_db,
		'addFields' => $wpfws_new_fields,
		'updateFields' => $wpfws_update_fields,
		'deleteFields' => $wpfws_delete_fields,
		'fieldOrder' => $wpfws_order_fields
	];
	$json_body = json_encode($body);
    $args = array(
    	'body' => $json_body,
    	'timeout' => '5',
	    'redirection' => '5',
	    'httpversion' => '1.0',
	    'blocking' => true,
	    'method' => 'PATCH',
	    'headers' => array(
	        'Authorization' => 'Bearer ' . $lek_somngat,
	        'Content-Type' => 'application/json'
	    )
	);
	
	$response = json_decode( wp_remote_retrieve_body(wp_remote_request( $url,$args )), true);
	if($response['id']){
		foreach ($response['fields'] as $key => $value){
			$fields_id[] = $value['id'];
			$fields_name[] = $response['fields'][$key]['name'];
		}
		update_post_meta($id, 'wpfws_fields_id', $fields_id);
		update_post_meta($id, 'wpfws_fields_name', $fields_name);
		if(get_post_meta($id,'wpfws_app_id_form',true)){

			update_post_meta($id, 'wpfws_app_id_form', $response['app']['id']);

		}else{
			
			add_post_meta($id, 'wpfws_app_id_form', $response['app']['id']);
		}
		
		echo 'success';
	}else if($response['errors'][0]['message'] == "displayName duplicated"){

		if(strpos($response['errors'][0]['location'],'Fields') != false ){

			echo 'error_field_dup';

		}else{

			echo 'error_DB_dup';
		}

	}else{
		
		echo 'error';
	}	
}
?>
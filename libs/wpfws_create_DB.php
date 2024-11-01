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

//API
global $base_url;
$url = $base_url."dbs";
global $lek_somngat;
$App_ID = get_option('wpfws_app_id');
$name_of_db = stripslashes($_POST['wpfws_db_name']);
$id = $_POST['post_id'];

$wpfws_type_array = stripslashes_deep($_POST['wpfws_form_type']);
$wpfws_name_array = stripslashes_deep($_POST['wpfws_form_name']);
$wpfws_label_array = stripslashes_deep($_POST['wpfws_form_label']);

if(isset($_POST['type']) && $_POST['type'] == 'create_db'){
	//Add display field to DB
	$field_list[] = array(
	    "name" => 'display', 
	   	"displayName" => '表示切替',   
	   	"type" => 'text'
	);

	foreach ($wpfws_type_array as $key => $type) {
	   	if($type == "email"){
	    	$type = "email";
	   	}elseif($type == "date"){
	    	$type = "date";    
	   	}elseif($type == "date_dropdown"){
	    	$type = "date";    
	   	}else{
	    	$type = "textarea";
	   	}
   
	  	$field_list[] = array(
	   		"name" => $wpfws_name_array[$key],
	   		"displayName" => $wpfws_label_array[$key],
	   		"type" => $type
	   	);
	}

 	$body = [
      "app" => $App_ID, 
      "displayName" => $name_of_db, 
      "fields" => $field_list
    ];

	$json_body = json_encode($body);
    $args = array(
    	'body' => $json_body,
    	'timeout' => '5',
	    'redirection' => '5',
	    'httpversion' => '1.0',
	    'blocking' => true,
	    'headers' => array(
	        'Authorization' => 'Bearer ' . $lek_somngat,
	        'Content-Type' => 'application/json'
	    )
	);
		
	$response = json_decode( wp_remote_retrieve_body(wp_remote_post( $url,$args )), true);		
	if($response['id']){
		foreach ($response['fields'] as $key => $value){
			$fields_id[] = $value['id'];
			$fields_name[] = $response['fields'][$key]['name'];
		}
		add_post_meta($id, 'wpfws_fields_id', $fields_id);
		add_post_meta($id, 'wpfws_fields_name', $fields_name);
		add_post_meta($id, 'wpfws_db_name', $response['displayName']);
		add_post_meta($id, 'wpfws_db_id', $response['id']);
		add_post_meta($id, 'wpfws_updatedAt', $response['updatedAt']);
		add_post_meta($id, 'wpfws_app_id_form', $response['app']['id']);

		echo 'success';

	}else if($response['errors'][0]['message'] == "displayName duplicated"){

		if(strpos($response['errors'][0]['location'],'fields') != false ){

			echo 'error_field_dup';

		}else{

			echo 'error_DB_dup';
		}

	}else{		
		echo 'error';
	}

	
}
?>
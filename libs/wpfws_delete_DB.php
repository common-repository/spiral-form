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

$db_id = get_post_meta(sanitize_text_field($_POST['form_id']),'wpfws_db_id',true);
global $base_url;
$url = $base_url."dbs/".$db_id;
global $lek_somngat;

if(isset($_POST['delete_db'])){
	$args = array(
    	'body' => $json_body,
    	'timeout' => '5',
	    'redirection' => '5',
	    'httpversion' => '1.0',
	    'blocking' => true,
	    'method' => 'DELETE',
	    'headers' => array(
	        'Authorization' => 'Bearer ' . $lek_somngat,
	        'Content-Type' => 'application/json'
	    )
	);

	// check if api key can be access or not 
	$response_access =  check_permission($lek_somngat);
	if(!$response_access){
		print_r("エラーが発生しました。<br/>SPIRALv2の設定を確認してください。");
	}
	else {
		$response = json_decode( wp_remote_retrieve_body(wp_remote_request( $url,$args )), true);

		//use wp_remote_get to get check the status of URL
		$response_url = wp_remote_get($url);
		//Check if url is not error
		if(!is_wp_error($response_url)){

			if(empty($response)){
					
				wp_delete_post($_POST['form_id'],true);
				print_r('SUCCESS');
			
			}else if($response['status'] == 404){
				print_r("DBを削除できませんでした。SPIRALv2の管理画面から削除を行っている場合、本メニューから削除することができません。");
			}else if($response['error'] == "invalid_token"){
				print_r("APIkeyが最新でないため、フォームと連携先SPIRAL側のDBを削除することができません。");
			}else{	
				wp_delete_post($_POST['form_id'],true);
				print_r('SUCCESS');
			} 
			
		}else{
			print_r("エラーが発生しました。<br/>SPIRALv2の設定を確認してください。");
		}
	}
}
?>
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

$app_id = get_option('wpfws_app_id');
$page = ($_POST['page']-1);
$db_id = $_POST['db_id'];
$limit = 200;
$offset = 0 + ($page*$limit);
$from_date = stripslashes($_POST['from_date']);
$to_date = stripslashes($_POST['to_date']);
$current_date = stripslashes($_POST['current_date']);

if ( !empty($_POST['type']) ) {
	if ( $_POST['type'] == 'list_data' ) {
		$response_db_record = wpfws_set_URL("dbs/$db_id/records?sort=_id:desc&limit=$limit&offset=$offset");
		print_r( json_encode( $response_db_record ) );
	}
	else if ( $_POST['type'] == 'filter' ) {
		//Date filter input
	    if ( $from_date != "" && $to_date == "" ) {
	      // From_Date !Null and To_date Null
	      $to_date = date('Y-m-d', strtotime("$current_date +1 day"));
	      $response_db_record = wpfws_set_URL("dbs/$db_id/records?sort=_id:desc&where=@_createdAt>='$from_date'and@_createdAt<='$to_date'&limit=$limit&offset=$offset");
	    } else if ( $from_date == "" && $to_date != "" ) {
	      // From_Date Null and To_date !Null
	      $to_date = date('Y-m-d', strtotime("$to_date +1 day"));
	      $response_db_record = wpfws_set_URL("dbs/$db_id/records?sort=_id:desc&where=@_createdAt<='$to_date'&limit=$limit&offset=$offset");
	    } else if ( $from_date == "" &&  $to_date == "" ) {
	      // From_Date Null and To_date Null
	      $to_date = date('Y-m-d', strtotime("$current_date +1 day"));
	      $response_db_record = wpfws_set_URL("dbs/$db_id/records?sort=_id:desc&where=@_createdAt<='$to_date'&limit=$limit&offset=$offset");
	    } else {
	    	// From_Date !Null and To_date !Null
	    	$to_date = date('Y-m-d', strtotime("$to_date +1 day"));
	        $response_db_record = wpfws_set_URL("dbs/$db_id/records?sort=_id:desc&where=@_createdAt>='$from_date'and@_createdAt<='$to_date'&limit=$limit&offset=$offset");
	    } 

	    print_r( json_encode( $response_db_record ) );
	} else if ( $_POST['type'] == 'list_header' ) {
		$response_db = wpfws_set_URL("dbs/$db_id");
		print_r( json_encode( $response_db ) );
	}
}

?>
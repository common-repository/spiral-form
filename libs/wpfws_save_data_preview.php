<?php
$path = dirname(__dir__);
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

$post_id = $_POST['post_id'];

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
	'wpfws_required_text',
	'wpfws_dropdown_text',
	'wpfws_free_text_footer',
	'wpfws_title',
	'wpfws_free_text_header'
);

//Preview ID
$preview_post = array(
    'post_title'    => '',
    'post_status'   => 'preview',
    'post_type'     => 'wpfws_preview',
    'post_parent'   => $post_id
);

// Create new preview post into the database
$preview_id = wp_insert_post( $preview_post );

// Update post
$my_post = array(
	'ID'           => $post_id,
	'post_title'    => '',
	'post_content' => '[wpfws_form id="'.$preview_id.'"]'
);

// Update the post into the database
wp_update_post( $my_post );

//Update post meta preview
update_post_meta($preview_id, 'wpfws_display', array("default"));
update_post_meta($preview_id, 'wpfws_form_use', 1);
foreach($data_array as $key){
	update_post_meta($preview_id, $key, $_POST[$key]);
}

//Delete preview form from WPDB
	$args = array(
	  'posts_per_page' => '-1',
	  'offset' => 0,
	  'post_type' => 'wpfws_preview',
	  'post_status' => 'preview'
	); 
	$wpfws_preview_form_lists = get_posts($args);

	if(! empty($wpfws_preview_form_lists)){
	  foreach ($wpfws_preview_form_lists as $preview_form) {
	  	if($preview_form->ID != $preview_id){
	  		wp_delete_post($preview_form->ID, true);
	  	}
	  }
	}
?>
<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
global $post;
$item=$post->post_name;
class WPFWS_Form_List_Table extends WP_List_Table {

	function __construct() {
		parent::__construct( array(
			'singular' => 'post',
			'plural' => 'posts',
			'ajax' => false,
		) );
	}

	public function prepare_items() {
		global $wpdb;
		$per_page = 100;

		$columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        //Get the column headers
        $this->_column_headers = array($columns, $hidden, $sortable);

        //Get the tabel data array
        $data = $this->table_data();

        //sorting data
        function usort_reorder( $a, $b ) {
			$orderby = ( ! empty( $_REQUEST['orderby'] ) ) ? $_REQUEST['orderby'] : 'date';
			$order = ( ! empty( $_REQUEST['order'] ) ) ? $_REQUEST['order'] : 'desc';
			$result = strcmp( $a[ $orderby ], $b[ $orderby ] );
			return ( 'asc' === $order ) ? $result : -$result;
		}
		usort( $data, 'usort_reorder' );

		/**
		 * Get current page calling get_pagenum method
		 */
		$current_page = $this->get_pagenum();
		$total_items = count($data);
		$data = array_slice($data,(($current_page-1)*$per_page),$per_page);
		$this->items = $data;

        /**
		 * Call to _set_pagination_args method for informations about
		 * total items, items for page, total pages and ordering
		 */
        $this->set_pagination_args(
        	array(
	            'total_items' => $total_items,
	            'per_page'    => $per_page,
	            'total_pages'	=> ceil( $total_items / $per_page ),
				'orderby'	    => ! empty( $_REQUEST['orderby'] ) && '' != $_REQUEST['orderby'] ? $_REQUEST['orderby'] : 'date',
				'order'		    => ! empty( $_REQUEST['order'] ) && '' != $_REQUEST['order'] ? $_REQUEST['order'] : 'desc'
        	)
        );

	}

	/**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
			'title' => __( 'フォーム名', 'spiral-form' ),
			'shortcode' => __( 'フォーム埋め込み用ショートコード', 'spiral-form' ),
			'date' => __( '最終更新', 'spiral-form' ),
        );
        return $columns;
    }

	function get_sortable_columns() {
		$columns = array(
			'title' => array( 'title', true ),
			'date' => array( 'date', false ),
		);

		return $columns;
	}

	function column_default( $item, $column_name ) {
		return '';
	}

	function column_title( $item ) {
		$paged = isset($_GET['paged']) ? $_GET['paged'] : 1;
		$admin_url = admin_url( 'admin.php?page=wpfws_form_lists&post=' . absint( $item['id'] ).'&paged='. $paged );

		$edit_link = add_query_arg( array( 'action' => 'edit' ), $admin_url );
		$view_link = add_query_arg( array( 'action' => 'preview' ), get_post_permalink($item['id']) );
		$activate_link = add_query_arg( array( 'action' => 'activate' ), $admin_url );
		$deactivate_link = add_query_arg( array( 'action' => 'deactivate' ), $admin_url );

		//Check is it Have DB or Not
		$no_db = '';
		$db_flag = 1; 
		if(empty($item['db_id'])){
			$no_db = '<span class="no_db">(DB未設定)</span>';
			$db_flag = 0;
		}

		//Title of the form
		$output = sprintf('<a id="form_name'.$item['id'].'" class="row-title" href="%1$s" title="%2$s">%3$s</a>'.$no_db.'', esc_url( $edit_link ),
			/* translators: %s: title of contact form */
			esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;', 'spiral-form' ),
				$item['title'] ) ),
			esc_html( $item['title'] )
		);
		$output = sprintf( '<strong>%s</strong>', $output );

		//Row-Action bellow the title
		if ( current_user_can( 'administrator', $item['id'] ) ) {
			if($item['form_use']){
				$actions = array(
		            'deactivate' => sprintf( '<a href="#" onclick="wpfws_deactivate_form('.$item['id'].', '.$paged.');">%2$s</a>', 
		            	esc_url( $deactivate_link ), 
		            	esc_html( __( '無効化', 'spiral-form' ) ) ),
		            'view' => sprintf( '<a id="wpfws_view'.$item['id'].'" link="%1$s" href="%1$s" target="wp-preview-'.$item['id'].'">%2$s</a>', 
		            	esc_url( $view_link ), 
		            	esc_html( __( 'プレビュー', 'spiral-form' ) ) )
	        	);

			}else{
				$actions = array(
		            'activate' => sprintf( '<a href="#" onclick="wpfws_activate_form('.$item['id'].', '.$paged.');">%2$s</a>', 
		            	esc_url( $activate_link ), 
		            	esc_html( __( '有効化', 'spiral-form' ) ) ),
		            'view' => sprintf( '<a id="wpfws_view'.$item['id'].'" link="%1$s" href="%1$s" target="wp-preview-'.$item['id'].'">%2$s</a>', 
		            	esc_url( $view_link ), 
		            	esc_html( __( 'プレビュー', 'spiral-form' ) ) ),
		            'delete' => sprintf( '<a href="#" onclick="wpfws_deletedb('.$item['id'].','.$db_flag.'); return false;">%1$s</a>', 
		            	esc_html( __( '削除', 'spiral-form' ) ) )
	        	);
			}
		}
		$output .= $this->row_actions( $actions, true );

		return $output;
	}

	function column_shortcode( $item ) {
		$shortcodes = array( $item['shortcode'] );

		$output = '';

		foreach ( $shortcodes as $shortcode ) {
			$output  = '<div id="sh-c1"><select id="select'.esc_attr( $item['id'] ).'" class="display_select" onchange="wpfws_change_display(this.id);">';
			if(!empty($item['display'])){
			foreach($item['display'] as $display){
			    $output .= '<option value="'.esc_attr( $display ).'">'.$display.'</option>';                          
			}
			}
			$output .= '</select></div>';
			$output .= '<div id="sh-c2"><input id="'.$item['id'].'" type="text" class="code" size="55" onfocus="this.select();" value="' . esc_attr( $shortcode ) . '" readonly/></div>';
			//Copy Button
			$output .= '<div class="copy-menu">';
			$output .= '<span class="btn-copy" title="Copy Shortcode" role="button" onclick="wpfws_copyToClipboard('.$item['id'].');">';
			$output .= '<span class="btn-copy-img"><img class="test" src="'.esc_url(WPFWS_SPIRAL_PLUGIN_DIR_URL).'img/copy-content.png" width="15px"></span></span>';
			$output .= '<div class="copy-info" id="copy_info_'.$item['id'].'">';
			$output .= '<span>Shortcode Copied</span>';
			$output .= '</div></div>';
		}

		return trim( $output );
	}

	function column_date( $item ) {
		$post = get_post( $item['id'] );
		$updated_date = $item['date'];

		if ( ! $post ) {
			return;
		}

		$t_time = mysql2date( __( 'Y/m/d g:i A', 'spiral-form' ), $updated_date , true );
		$m_time = $updated_date;
		$time = mysql2date( 'G', $updated_date ) - get_option( 'gmt_offset' ) * 3600;

		$time_diff = time() - $time;

		$h_time = mysql2date( __( 'Y/m/d g:i A', 'spiral-form' ), $m_time );

		return '<abbr title="' . $t_time . '">' . $h_time . '</abbr>';
	}

	
	/**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

	/**
     * Get the table data
     *
     * @return Array
     */
    private function table_data()
    {
    	$data = array();
    	$args = array(
		    'sort_order' => 'DESC',
		    'sort_column' => 'date',
		    'hierarchical' => 1,
		    'exclude' => '',
		    'include' => '',
		    'meta_key' => 'wpfws_form_use',
		    'authors' => '',
		    'child_of' => 0,
		    'parent' => -1,
		    'exclude_tree' => '',
		    'posts_per_page' => '-1',
		    'number' => '',
		    'offset' => 0,
		    'post_type' => array('page', 'wpfws_page'),
		    'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit')
		); 
    	$wpfws_form_lists = get_posts($args);

    	//Get offset
    	$gmt_offset = get_option('gmt_offset');
    	$offset_st = $gmt_offset >= 0 ? "+$gmt_offset" : $gmt_offset;

		foreach ($wpfws_form_lists as $post){
			$wpfws_title = get_post_meta($post->ID, 'wpfws_title',true);
			$wpfws_form_use = get_post_meta($post->ID, 'wpfws_form_use',true);
			$wpfws_display = get_post_meta($post->ID, 'wpfws_display',true);
			$wpfws_db_id = get_post_meta($post->ID, 'wpfws_db_id',true);
			$wpfws_updatedAt = get_post_meta($post->ID, 'wpfws_updatedAt', true);

			//Update Date
			if ( !empty($wpfws_updatedAt) ) {
				$updated_date = $wpfws_updatedAt;
			} else {
				$updated_date = $post->post_date;
			}

			$datetime = new DateTime($updated_date);
			$time_offset = new DateTimeZone($offset_st);
			$datetime->setTimezone($time_offset);
			$updated_date_covert_tz = $datetime->format('Y-m-d H:i:s');

            $data[] = array(
                    'id'          => $post->ID,
                    'title'       => $wpfws_title[0],
                    'form_use'    => $wpfws_form_use,
                    'db_id'       => $wpfws_db_id,
                    'display'    => $wpfws_display,
                    'shortcode'   => '[wpfws_form id="'.$post->ID.'" display="'.$wpfws_display[0].'"]',
                    'date'		  => $updated_date_covert_tz
                    );
        }
        return $data;
    }
}

?>
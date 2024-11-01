<?php
###########################
## フォーム生成
###########################
class wpfws_form_element_array{
	public $element_array = array();

	private $required_text = '';
	private $dropdown_text =''; 
	private $send_field = '';
	private $confirm_text = '';
	private $send_text = '';
	private $cancel_text = '';
	private $thanks_url = '';
	private $thanks_text = '';
	private $title= '';
	private $free_text_header= '';
	private $free_text_footer='';
	private $display_num = '';
	private $post_id = '';
	
	function __construct($post_id, $display){
		// Get setting items
		$wpfws_required_array = get_post_meta($post_id,'wpfws_form_required',true);
		$wpfws_field_used_array = get_post_meta($post_id,'wpfws_field_used',true);
		$wpfws_type_array = get_post_meta($post_id,'wpfws_form_type',true);
		$wpfws_label_array = get_post_meta($post_id,'wpfws_form_label',true);
		$wpfws_name_array = get_post_meta($post_id,'wpfws_form_name',true);
		$wpfws_placeholder_array = get_post_meta($post_id,'wpfws_form_placeholder',true);
		$wpfws_pretext_array = get_post_meta($post_id,'wpfws_form_pretext',true);
		$wpfws_aftertext_array = get_post_meta($post_id,'wpfws_form_aftertext',true);
		$wpfws_options_array = get_post_meta($post_id,'wpfws_form_options',true);
		$wpfws_display_array = get_post_meta($post_id,'wpfws_display',true);
		$wpfws_start_year_array = get_post_meta($post_id,'wpfws_start_year',true);
		$wpfws_end_year_array = get_post_meta($post_id,'wpfws_end_year',true);
		$wpfws_year_order_array = get_post_meta($post_id,'wpfws_year_order',true);
		$wpfws_date_format_array = get_post_meta($post_id,'wpfws_date_format',true);
		$wpfws_date_dr_year_array = get_post_meta($post_id,'wpfws_date_dr_year',true);
		$wpfws_date_dr_month_array = get_post_meta($post_id,'wpfws_date_dr_month',true);
		$wpfws_date_dr_day_array = get_post_meta($post_id,'wpfws_date_dr_day',true);
		$wpfws_fields_id_array= get_post_meta($post_id,'wpfws_fields_id',true);
        $wpfws_fields_name_array= get_post_meta($post_id,'wpfws_fields_name',true);

		$this->required_text=(get_post_meta($post_id,'wpfws_required_text',true)) ;
		$this->dropdown_text = get_post_meta($post_id,'wpfws_dropdown_text',true);
		$this->send_field = get_post_meta($post_id,'wpfws_send_field',true);
		$this->confirm_text = get_post_meta($post_id,'wpfws_confirm_text',true);
		$this->send_text = get_post_meta($post_id,'wpfws_send_text',true);
		$this->cancel_text = get_post_meta($post_id,'wpfws_cancel_text',true);
		$this->thanks_url = get_post_meta($post_id,'wpfws_thanks_url',true);
		$this->thanks_text = get_post_meta($post_id,'wpfws_thanks_text',true);
		$this->title= get_post_meta($post_id,'wpfws_title',true);
		$this->free_text_header= get_post_meta($post_id,'wpfws_free_text_header',true);
		$this->free_text_footer=get_post_meta($post_id,'wpfws_free_text_footer',true);
		$this->nonce= wp_create_nonce('wpfws-nonce');
		$this->display_num = $display;
		$this->post_id = $post_id;

        if(! empty($wpfws_display_array)){
			// Expand the setting item to form element class and store it in $element_array
	        $dkey = $this->display_num;
			$i = count($wpfws_label_array);
		    $j = count($wpfws_display_array);
		    $start = ($dkey*ceil($i/$j));
		    $end = ceil($i/$j)*($dkey+1);

			for($key=$start ; $key<$end ; $key++){
				if(empty($wpfws_fields_name_array)){
					$field_id = $key;
				}else{
					$field_id = array_search($wpfws_name_array[($key)], array_slice($wpfws_fields_name_array,1));
				}
				$param_array = array(
					'required' => $wpfws_required_array[$key],
					'field_used' => $wpfws_field_used_array[$key],
					'type' => $wpfws_type_array[$key],
					'label' => $wpfws_label_array[$key],
					'name' => $wpfws_name_array[$field_id],
					'placeholder' => $wpfws_placeholder_array[$key],
					'pretext' => $wpfws_pretext_array[$key],
					'aftertext' => $wpfws_aftertext_array[$key],
					'options' => $wpfws_options_array[$key],
					'start_year' => $wpfws_start_year_array[$key],
					'end_year' => $wpfws_end_year_array[$key],
					'yearOrder' => $wpfws_year_order_array[$key],
					'date_format' => $wpfws_date_format_array[$key],
					'yearText' => $wpfws_date_dr_year_array[$key],
					'monthText' => $wpfws_date_dr_month_array[$key],
					'dayText' => $wpfws_date_dr_day_array[$key],
					'post_id'	=> $post_id,
					'display'	=> $display,
					);
				$this->element_array[$wpfws_name_array[$key]] = new wpfws_form_element($param_array);
			}
		}
}

	// Create output of input screen
	function create_input(){
		$post_id = $this->post_id;
		$dkey = $this->display_num;
		$post_status = get_post_status( get_the_ID() );
		$action = sanitize_text_field($_GET['action']);
		$get_preview = sanitize_text_field($_GET['preview']);
		$confirm_url = '';

		$wpfws_form_used = get_post_meta($post_id, 'wpfws_form_use',true);
		$wpfws_display_array = get_post_meta($post_id, 'wpfws_display',true);

		$get_display = isset($_GET['display']) ? sanitize_text_field($_GET['display']) : '';
		if (is_array($wpfws_display_array)) $display_check = in_array($get_display, $wpfws_display_array) ? '&display='.$get_display : '';

		//Check the status of page
		//If post status is daft
		if ( $post_status == 'draft') {
			$permalink = get_permalink( get_the_ID() );
			$confirm_url = $permalink.'&phase=confirm'.$display_check;
		} else {
			$confirm_url = '?phase=confirm'.$display_check;
		}

		$form_html = <<<EOM
		<form action="$confirm_url" method="post" id="Spiral_form">
		<div class="form_title">
		<h2>
EOM;
		$form_html .= esc_html($this->title[$dkey]);
		$form_html .= <<<EOM
		</h2>
		</div>
		<div class="header_freetext">
EOM;
		$form_html .= html_entity_decode($this->free_text_header[$dkey]);
		$form_html .= <<<EOM
		</div>
		<table class="Spiral_table">
EOM;
		$form_html .= '<input type="hidden" name="wpfws_nonce" value="'.$this->nonce.'"/>';
		foreach ($this->element_array as $name => $element) {
			if($element->return_active_field() != 0){
				$form_html .= '<tr class="'.$element->return_required_label().'"><th class="form_label">'.$element->return_label().$element->create_js().'</th><td id="'.$name.'-form-data" class="form_data">'.$element->return_divclass().$this->pretext.$element->return_input().'</td></tr>';
			}
		}	
		$form_html .= <<<EOM
		</table>
		<div  class="footer_freetext">
EOM;
		$form_html .= html_entity_decode($this->free_text_footer[$dkey]);
		$form_html .= <<<EOM
		</div>
		<div class="tdsubmit">
EOM;
		$form_html .= '<input type="submit" id="input_sub_btn" class="form_button" value="'.esc_html($this->confirm_text[$dkey]).'" />';
		$form_html .= <<<EOM
		</div>
		</form>

EOM;

//Display Create Input	
if($wpfws_form_used || $action == 'preview'){
	return $form_html;
}else{
	return;
}
	
}
	
	// Create confirmation screen output
	function create_confirm(){
		//base on display
		$post_id = $this->post_id;
		$dkey = $this->display_num;
		$post_status = get_post_status( get_the_ID() );
		$send_url = '';

		$wpfws_display_array = get_post_meta($post_id, 'wpfws_display',true);

		$get_display = isset($_GET['display']) ? sanitize_text_field($_GET['display']) : '';
		if (is_array($wpfws_display_array)) $display_check = in_array($get_display, $wpfws_display_array) ? '&display='.$get_display : '';

		//Check the status of page
		//If post status is daft
		if ( $post_status == 'draft') {
			$permalink = get_permalink( get_the_ID() );
			$send_url = $permalink.'&phase=send'.$display_check;
		} else {
			$send_url = '?phase=send'.$display_check;
		}

		$form_html = <<<EOM
		<form action="$send_url" method="post" id="Spiral_form">
		<div class="form_title">
		<h2>
EOM;
		$form_html .= esc_html($this->title[$dkey]);
		$form_html .= <<<EOM
		</h2>
		</div>
		<table class="Spiral_table">
EOM;
		$form_html .= '<input type="hidden" name="wpfws_nonce" value="'.esc_attr($this->nonce).'"/>';
		$form_html .= '<input type="hidden" name="wpfws_post_id" value="'.esc_attr($post_id).'"/>';
		$form_html .= '<input type="hidden" name="wpfws_display_num" value="'.esc_attr($dkey).'"/>';
		foreach ($this->element_array as $name => $element) {
			if($element->return_active_field() != 0){
				$form_html .= '<tr class="'.$element->return_required_label().'"><th class="form_label">'.$element->return_label().'</th><td class="form_data">'.$element->return_confirm().'</td></tr>';
			}
		}
		$form_html .= $element->back();	
		$form_html .= <<<EOM
		</table>
		<div class="tdsubmit">
EOM;
		$form_html .= '<input type="button" onclick="back_click('."'$value'".')" id="back_btn" class="form_button" value="'.esc_attr($this->cancel_text[$dkey]).'"/>';
		$form_html .= '  <input id="submit_button" class="form_button" type="submit" value="'.esc_attr($this->send_text[$dkey]) . '" />';
		$form_html .= <<<EOM
		</div>
		</form>

EOM;

		return $form_html;
	}
//Processing when adding data to SpiralDB
function wpfws_insert_SPIRAL(){
   $id = $this->post_id;
   $dkey = $_POST['wpfws_display_num'];

   $wpfws_name_array = get_post_meta($id,'wpfws_form_name',true);
   $wpfws_type_array = get_post_meta($id,'wpfws_form_type',true);
   $wpfws_date_format_array = get_post_meta($id,'wpfws_date_format',true);
   $wpfws_display_array = get_post_meta($id,'wpfws_display',true);
   $db_id = get_post_meta($id,'wpfws_db_id',true);

   //Add data to display field
   $name['data'][] = 'display';
   $value['data'][] = isset($_GET['display']) ? sanitize_text_field($_GET['display']) : $wpfws_display_array[$dkey];

   foreach ($wpfws_name_array as $key => $wpfws_name){
       if($wpfws_type_array[$key] == 'date' || $wpfws_type_array[$key] == 'date_dropdown'){
           if($wpfws_date_format_array[$key] == 'DD-MM-YYYY' && !empty($_POST[$wpfws_name])){
               $date = DateTime::createFromFormat('d-m-Y', $_POST[$wpfws_name]);
               $data = $date->format('Y-m-d');
           }else if($wpfws_date_format_array[$key] == 'MM-DD-YYYY' && !empty($_POST[$wpfws_name])){
               $date = DateTime::createFromFormat('m-d-Y', $_POST[$wpfws_name]);
               $data = $date->format('Y-m-d');
           }else{
           	   $data = $_POST[$wpfws_name];
           }
       }else{
           $data = $_POST[$wpfws_name];
       }

       $name['data'][] = $wpfws_name;
       $value['data'][] = !empty($data) ? stripslashes_deep(esc_html($data)) : Null;
   }

   global $base_url;
   $url = $base_url."dbs/$db_id/records";
   global $lek_somngat;

   $array = array_combine($name['data'], $value['data']);

   $json_body = json_encode($array);
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
   return $response;

}
}
class wpfws_form_element{
	private $required;
	private $field_used;
	private $type;
	private $label;
	private $name;
	private $placeholder;
	private $pretext;
	private $aftertext;
	private $options;
	private $start_year;
	private $end_year;
	private $date_format;
	private $yearOrder;
	private $yearText;
	private $monthText;
	private $dayText;
	private $param;
	private $ansewer;
	private $post_id;
	private $display_num;
	function __construct($param_array){
		$this->required = $param_array['required'];
		$this->field_used = $param_array['field_used'];
		$this->type = $param_array['type'];
		$this->label = $param_array['label'];
		$this->name = $param_array['name'];
		$this->placeholder = $param_array['placeholder'];
		$this->pretext = $param_array['pretext'];
		$this->aftertext = $param_array['aftertext'];
		$this->options = $param_array['options'];
		$this->start_year = $param_array['start_year'];
		$this->end_year = $param_array['end_year'];
		$this->yearOrder = $param_array['yearOrder'];
		$this->date_format = $param_array['date_format'];
		$this->yearText = $param_array['yearText'];
		$this->monthText = $param_array['monthText'];
		$this->dayText = $param_array['dayText'];
		$this->display_num = $param_array['display'];
		$this->post_id =  $param_array['post_id'];

	}
	
	// Create element for input screen
	function return_input(){
		//base on display
		$post_id = $this->post_id;
		$dkey = $this->display_num;

		$wpfws_dropdown_text_array = get_post_meta($post_id,'wpfws_dropdown_text',true);
		$required = $this->required == 1 ? 'required' : '';
		switch ($this->type) {
			case 'textarea':
				return '<textarea id="'.esc_attr($this->name).'" placeholder="'.esc_attr($this->placeholder).'" name="'.esc_attr($this->name).'"'.$required.'>'.stripslashes(esc_html($_POST[$this->name])).'</textarea>';
				break;
			case 'radio':
			case 'checkbox':
				return $this->return_options();
				break;
			case 'select':
			 	return '<select id="'.esc_attr($this->name).'" name="'.$this->name.'"'.$required.'><option value="">'.esc_html($wpfws_dropdown_text_array[$dkey]).'</option>'.$this->return_options().'</select><input type="hidden" select-name="'.esc_attr($this->name).'" value="'.stripslashes(htmlentities($_POST[$this->name])).'" '.$required.'>'.esc_html($this->aftertext);
				break;
			case 'text':
				return ' ' .esc_html($this->pretext). '<input id="'.esc_attr($this->name).'" class="input" placeholder="'.esc_attr($this->placeholder).'" type="'.$this->type.'" name="'.esc_attr($this->name).'" value="'.stripcslashes(esc_attr($_POST[$this->name])).'" '.$required.'/>'.esc_html($this->aftertext).'';
				break;
			case 'email':
				return '<input id="'.esc_attr($this->name).'" class="input" maxlength="76" placeholder="'.esc_attr($this->placeholder).'" type="'.$this->type.'" name="'.esc_attr($this->name).'" value="'.esc_attr($_POST[$this->name]).'" pattern="[a-zA-Z0-9_.+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,4}$" '.$required.'/>';
					break;
			case 'date_dropdown':
    			return '<input id="'.esc_attr($this->name).'" class="input" type="text" name="'.esc_attr($this->name).'" value="'.esc_attr($_POST[$this->name]).'" style="position: relative; z-index: 100000;"/> '.$this->return_date_dropdown($required);
     			break;
			case 'date':
    			return '<input id="'.esc_attr($this->name).'" class="input readonly" type="text" name="'.esc_attr($this->name).'" value="'.esc_attr($_POST[$this->name]).'" '.$required.' style="position: relative; z-index: 100000;"/> '.$this->return_date();
     			break;			
			default:
				return '<input id="'.esc_attr($this->name).'" class="input" placeholder="'.esc_attr($this->placeholder).'" type="'.$this->type.'" name="'.esc_attr($this->name).'" value="'.esc_attr($_POST[$this->name]).'" '.$required.'/>';
				break;
		}

	}
	
	// Create element for confirmation screen
	function return_confirm(){
		//base on display
		$post_id = $this->post_id;
		$dkey = $this->display_num;

		if($_POST[$this->name]){	
			switch ($this->type){
				case 'checkbox':
					$this->ansewer = esc_attr(implode(" \n",$_POST[$this->name]));
					$this->ansewer_con = esc_attr(implode(" \n",$_POST[$this->name]));
					break;
				case 'date_dropdown':
					$this->ansewer = esc_attr($_POST[$this->name]);
					$this->ansewer_con = esc_attr($_POST[$this->name]);
					break;
				default:
					$this->ansewer = esc_attr($_POST[$this->name]);
					$this->ansewer_con = esc_attr($_POST[$this->name]);
					break;
			}
		}
		return  stripslashes($this->ansewer).'<input type="hidden" name="'.esc_attr($this->name).'" value="'.stripslashes($this->ansewer_con).'">';
	}
	// return label
	function return_label(){
		//base on display
		$post_id = $this->post_id;
		$dkey = $this->display_num;

		$wpfws_required_text_array = get_post_meta($post_id, 'wpfws_required_text',true);
		
		$required_icon = $this->required == 1? '<span class="required">'.esc_html($wpfws_required_text_array[$dkey]).'</span>' : '';
		return esc_html($this->label).$required_icon;
	}

	function return_required_label(){
		$wpfws_display_array = get_post_meta(get_the_ID(),'wpfws_display',true);
		if($this->required == 1){
			return $this->required_tr="required_tr";
		}else{
			return  $this->required_tr="";
		}
	}
	//Return value when field is used or not used
	function return_active_field(){
		if($this->field_used != 0){
			return $this->field_used = "1" ;
		}else{
			return $this->field_used = "0" ;
		}
	}
	// Set Required input class
	function return_divclass(){
		$required_check = ($this->required == 1 && $this->type == 'checkbox') ? '<div class="'.esc_attr($this->name).'">' : '<div>';
		return $required_check;
	}

	// select Option creation For radio and checkbox
	function return_options(){
		$required = $this->required == 1 ? ' required' : '';
		$options_array = array();
		$options_html ='';

    	$options_array = explode("\n", $this->options); // とりあえず行に分割
		$options_array = array_map('trim', $options_array); // 各行にtrim()をかける
		$options_array = array_filter($options_array, 'strlen'); // 文字数が0の行を取り除く
		
		foreach ($options_array as $key => $option){
			if(strstr($option, "=>")) {
				$option = explode("=>", $option);
				$option_value = $option[0];
				$option_label = $option[1];
			}else{
				$option_value = $option;
				$option_label = $option;
			}

			switch ($this->type){
				case 'radio':
					$options_html .= '<label><input type="'.$this->type.'" id="'.esc_attr($this->name).'_'.$key.'" name="'.esc_attr($this->name).'" value="'. esc_attr($option_value). '"'.$required.'>'. esc_html($option_label) .'</label><input type="hidden" radio-name="'.esc_attr($this->name).'" value="'.stripcslashes(htmlentities($_POST[$this->name])).'" '.$required.'>';
					break;
				case 'checkbox':					
					$options_html .= '<label><input type="'.$this->type.'" id="'.esc_attr($this->name).'_'.$key.'" name="'.esc_attr($this->name).'['.$key.']" value="'. stripslashes(esc_attr($option_value)). '" '.$required.'>'. esc_html($option_label).'</label><input type="hidden" checkbox-name="'.esc_html($this->name).'['.$key.']" value="'.stripslashes(esc_attr($_POST[$this->name])).'" '.$required.'>';	
					break;
				default:
					$options_html .= '<option type="'.$this->type.'" id="'.esc_attr($this->name).'_'.$key.'" name="'.esc_attr($this->name).'[]" value="'.stripcslashes(esc_attr($option_value)). '"> '.esc_html($option_label) .'</option>';
					break;
			}
		}
		return $options_html;
	}
	
	// JS tag generation
	function create_js(){
		$form_ｊｓ = <<<EOM
<script type="text/javascript">
jQuery(function(){
EOM
;
if($this->required == 1 && $this->type == 'checkbox'){
    $form_ｊｓ .= "var ".esc_js($this->name)." = jQuery('.".esc_js($this->name)." :checkbox[required]');";
	$form_ｊｓ .= esc_js($this->name).".change(function(){";
    $form_ｊｓ .= "if(".esc_js($this->name). ".is(':checked')){";
	$form_ｊｓ .= esc_js($this->name).".removeAttr('required');";
    $form_ｊｓ .= "}else{";
    $form_ｊｓ .= esc_js($this->name).".attr('required',true);";
    $form_ｊｓ .= "}";
    $form_ｊｓ .= "});";
if($form_html .= '<button onclick="back_click(this); return false ;">'.esc_js($this->cancel_text) . '</button>'){
    $form_ｊｓ .= "if(".esc_js($this->name). ".is(':checked')){";
	$form_ｊｓ .= esc_js($this->name).".removeAttr('required');";
    $form_ｊｓ .= "}else{";
    $form_ｊｓ .= "}";
}else{
	$form_ｊｓ .= esc_js($this->name).".attr('required',true);";
}
}
$form_ｊｓ .= <<<EOM
});
</script>
EOM;
	return $form_ｊｓ;
}

// JS for adding date_dropdown
function return_date_dropdown($req){
$start_year = ''.$this->start_year.'';
$end_year = ''.$this->end_year.'';
$yearOrder = ''.$this->yearOrder.'';
$date_format = ''.$this->date_format.'';
$date_template = ''.$this->date_template.'';
$yearText = ''.$this->yearText.'';
$monthText = ''.$this->monthText.'';
$dayText = ''.$this->dayText.'';
$calid = '#'.esc_js($this->name).'';
$date_js = <<<EOM
<script type="text/javascript">
jQuery(function(){
EOM;
$date_js .= "jQuery('".esc_js($calid)."').combodate({minYear:$start_year,maxYear:$end_year,yearDescending:$yearOrder,format:'$date_format',template:'$date_format',firstItem:'empty',smartDays:true}); ";
$date_js .= <<<EOM
});
jQuery(function(){
	if("$req" == "required"){
		jQuery("$calid-form-data .year,$calid-form-data .month,$calid-form-data .day").attr('required',true);
	}

	jQuery("$calid-form-data .year option").each(function(){
		if(jQuery(this).val() == ''){
			jQuery(this).text('$yearText');
			return false; 
		}
	});
	jQuery("$calid-form-data .month option").each(function(){
		if(jQuery(this).val() == ''){
			jQuery(this).text('$monthText');
			return false; 
		}
	});
	jQuery("$calid-form-data .day option").each(function(){
		if(jQuery(this).val() == ''){
			jQuery(this).text('$dayText');
			return false; 
		}
	});

	jQuery("$calid-form-data .year, .month").on('change', function(){
		setTimeout(firstitemchange, 20);
	});

	function firstitemchange() {
	  jQuery("$calid-form-data .day option").each(function(){
		if(jQuery(this).val() == ''){
			jQuery(this).text('$dayText');
			return false; 
		}
	  });
	}
});
</script>
EOM;
 return $date_js;
}

// JS for adding date_calendar
function return_date(){
$calid = '"#'.esc_js($this->name).'"';
$date_js = <<<EOM
<script type="text/javascript">
jQuery(function(){
EOM;
$date_js .= "jQuery(".$calid.").datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '1918:2118', showMonthAfterYear:true, showButtonPanel: true, closeText: '閉じる'});";
$date_js .= "jQuery(".$calid.").on('keydown focus', function (event) {";
$date_js .= "event.preventDefault(); jQuery(this).blur();})";

$date_js .= <<<EOM
});
</script>
EOM;
 return $date_js;
}

function back(){

$get_display = isset($_GET['display']) ? '&display='.$_GET['display'] : '';
$post_status = get_post_status( get_the_ID() );
$input_url = '';

//Check the status of page
//If post status is daft
if ( $post_status == 'draft') {
	$permalink = get_permalink( get_the_ID() );
	$input_url = $permalink.'&phase=input'.$get_display;
} else {
	$input_url = '?phase=input'.$get_display;
}

$back_js = <<<EOM
<script type="text/javascript">

EOM;
$back_js .= "function back_click(display){";
$back_js .= "jQuery('#Spiral_form').attr('action','".$input_url."');";
$back_js .= "jQuery('#Spiral_form').submit();";
$back_js .= "}";
$back_js .= <<<EOM

</script>
EOM;
return $back_js;
}

}
?>
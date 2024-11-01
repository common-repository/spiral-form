<?php
require_once( WPFWS_SPIRAL_DIR . '/libs/wpfws_get_forms.php' );

//Check DB Limited
$app_id = get_option('wpfws_app_id');
$response_db = wpfws_set_URL("dbs?apps=$app_id");
$current_db_count = ($response_db['totalCount'] != null) ? $response_db['totalCount'] : '0';
$db_limit = 20;

  //Go to update form page
  if ( isset($_GET['action']) && $_GET['action'] == 'edit' ) {
    $post_id = $_GET['post'];
    require_once WPFWS_SPIRAL_DIR . '/views/form_meta.php';
    return;
  }

  // Activate & Deactivate Form
  if (! empty($_REQUEST['action'])){
    if ( $_REQUEST['action'] == 'activate' ){
      update_post_meta( $_REQUEST['post'], 'wpfws_form_use', 1 );
    }else if ($_REQUEST['action'] == 'deactivate'){
      update_post_meta( $_REQUEST['post'], 'wpfws_form_use', 0 );
    }
  }

  if($current_db_count >= $db_limit){
    ?>
      <div id="max_db_notic_warning" class="notice notice-warning">
          <p id="appid_warning"><?php _e( '連携先SPIRALの同一アプリ内にデータベースが20個設定されているため、フォームを新規登録できません。<br> フォームを新規に追加したい場合は一覧画面で不要なフォームを削除するか、SPIRALにログインし、フォームと連動しない不要なDBを削除してください。'); ?></p>
      </div>
    <?php
  }

  $list_table = new WPFWS_Form_List_Table();
  $list_table->prepare_items();
?>

<div class="wrap">
<h1 class="wp-heading-inline"><?php echo esc_html( __( 'フォーム一覧', 'spiral-form' ) );?></h1>

<?php
  //Add new form button
  if ( current_user_can( 'administrator' ) ) {
    echo sprintf( '<a href="%1$s" id="wpfws_add_new_btn" class="button button-primary">%2$s</a>',
    esc_url( menu_page_url( 'wpfws_new', false ) ),
    esc_html( __( 'フォーム新規作成', 'spiral-form' ) ) );
  }
?>

<hr class="wp-header-end">
<h4 class="notice notice-error" id="error_msg" style="color: red; display: none; padding: 10px 15px; margin-left: 2px;"></h4>

<form method="get" action="">
  <input type="hidden" name="page" value="<?php echo esc_attr( $_REQUEST['page'] ); ?>" />
  <?php $list_table->display(); ?>
</form>
</div>

<!-- Delete DB Popup -->
<div id="popup_delete" class="popup">
    <div class="content">
      <div>
        <div>
            <h1 class="popup_header">以下の設定を削除しますか？</h1>
            <h3>フォーム名 : <span id="db_name"></span></h3>
        </div>
            <a class="close" style="cursor:pointer;" onclick=" cancel(); return false;">&times;</a>
      </div>
            <p id="message_deleteDB" style="color: #d9534f; text-align: left;"></p>
            <ul id="message_list" style="list-style-type : circle; padding-left: 5%; color: #d9534f; text-align: left;"></ul>  
            <p id="des_deleteDB" style="text-align: left;"></p>
            <label>
            <input type="checkbox" id="confirm_delete_checkbox"/>すべて削除する
            </label>
        <div style="margin-top: 2%;">
            <input type="button" class="btn btn-danger" id="deletedb_btn" value="削除" style="margin-top: 0%;" disabled="disabled">
            <button  style="cursor:pointer;background-color: #ced4da;border-color: #ced4da;color: #212529;" class="cancel btn btn-primary" onclick="cancel(); return false;">キャンセル</button>
        </div>
    </div>
</div>

<!-- Activat & Deactivate Popup -->
<div id="Ac_popup" class="popup">
    <div class="content">
      <div>
        <div>
            <h1 class="popup_header">以下のフォームを有効化しますか？</h1>
            <h3>フォーム名 : <span id="ac_form_name"></span></h3>
        </div>
            <a class="close" style="cursor:pointer;" onclick=" cancel(); return false;">&times;</a>
      </div>
            <p id="des_deleteDB" style="text-align: left;">有効化すると、固定ページ・投稿ページ内のショートコード部分にフォームが挿入されます。</p>
        <div style="margin-top: 2%;">
            <input type="button" class="btn btn-primary" id="ac_btn" value="OK" style="margin-top: 0%;">
            <button  style="cursor:pointer;background-color: #ced4da;border-color: #ced4da;color: #212529;" class="cancel btn btn-primary" onclick="cancel(); return false;">キャンセル</button>
        </div>
    </div>
</div>

<div id="Deac_popup" class="popup">
    <div class="content">
      <div>
        <div>
            <h1 class="popup_header">以下のフォームを無効化しますか？</h1>
            <h3>フォーム名 : <span id="deac_form_name"></span></h3>
        </div>
            <a class="close" style="cursor:pointer;" onclick=" cancel(); return false;">&times;</a>
      </div> 
            <p id="des_deleteDB" style="text-align: left;">無効化すると、ショートコードを記載しても、固定ページ・投稿ページ内にフォームが表示されなくなります。</p>
        <div style="margin-top: 2%;">
            <input type="button" class="btn btn-primary" id="deac_btn" value="OK" style="margin-top: 0%;">
            <button  style="cursor:pointer;background-color: #ced4da;border-color: #ced4da;color: #212529;" class="cancel btn btn-primary" onclick="cancel(); return false;">キャンセル</button>
        </div>
    </div>
</div>
<!-- End Activat & Deactivate Popup -->

<div class="cover"></div>

<script type="text/javascript">
//Hide pager on the top
jQuery('.top').css('display','none');
jQuery('.wp-heading-inline').css('margin-bottom','7px');
jQuery('.wp-heading-inline').css('margin-top','-9px');
//Copy link URL
function wpfws_copyToClipboard(element){
  var $temp = jQuery("<input>");

  jQuery("body").append($temp);
  $temp.val(jQuery('#'+element).attr('value')).select();
  document.execCommand("copy");
  $temp.remove();
  setTimeout(function(){jQuery('#copy_info_'+element).css("display","block");}, 200);
  setTimeout(function(){jQuery('#copy_info_'+element).css("display","none");}, 2000);
}

//Change select display
function wpfws_change_display(selected_id) {
  var display = jQuery("#"+selected_id).val();
  var page_id = selected_id.substr(6);
  var url = jQuery("#wpfws_view"+page_id).attr('link');

  jQuery('#'+page_id).val('[wpfws_form id="'+page_id+'" display="'+display+'"]' );
  jQuery("#wpfws_view"+page_id).attr('href', url+'&display='+encodeURIComponent(display));
}

//Activate form
function wpfws_activate_form(page_id, paged) {
  var form_name = jQuery('#form_name'+page_id).text();
  jQuery("#ac_form_name").html(form_name);

  //Activate link
  var deac_url = '<?php echo admin_url( 'admin.php?page=wpfws_form_lists') ?>';
  jQuery("#ac_btn").attr("onclick", "window.location.href='"+deac_url+"&post="+page_id+"&paged="+paged+"&action=activate'");

  jQuery(".cover").fadeIn();
  jQuery("#Ac_popup").fadeIn();
}

//Deactivat form
function wpfws_deactivate_form(page_id, paged) {
  var form_name = jQuery('#form_name'+page_id).text();
  jQuery("#deac_form_name").html(form_name);

  //Deactivate link
  var deac_url = '<?php echo admin_url( 'admin.php?page=wpfws_form_lists') ?>';
  jQuery("#deac_btn").attr("onclick", "window.location.href='"+deac_url+"&post="+page_id+"&paged="+paged+"&action=deactivate'");

  jQuery(".cover").fadeIn();
  jQuery("#Deac_popup").fadeIn();
}

//When get action delete DB
function wpfws_deletedb(page_id,has_db) {
  var form_name = jQuery('#form_name'+page_id).text();
  jQuery("#db_name").html(form_name);

  //Uncheck checkbox and disable delete_btn when call deletedb function
  jQuery('#confirm_delete_checkbox').attr('checked',false);
  jQuery('#deletedb_btn').attr('disabled',true);

  //Check if the form already have DB
  if(has_db){
      jQuery("#message_deleteDB").html('また、このフォームに紐づく以下の設定等も同時に削除されます。');
      jQuery("#message_list").html('<li>連携先SPIRALのデータベース</li><li>連携先SPIRALデータベース内の全データ</li>');
      jQuery("#des_deleteDB").html('固定ページや投稿ページでこのフォームが利用されている可能性があります。<br>削除すると、フォームが表示されなくなりますのでご注意ください。');
  }else{
      jQuery("#message_deleteDB, #message_list").html('');
      jQuery("#des_deleteDB").html('固定ページや投稿ページでこのフォームが利用されている可能性があります。<br>削除すると、フォームが表示されなくなりますのでご注意ください。');
  }
  jQuery(".cover").fadeIn();
  jQuery("#popup_delete").fadeIn();

  //Add onclick to delete button with specific Page_ID
  jQuery('#deletedb_btn').attr('onclick','wpfws_delete_form_item('+page_id+'); return false;');

  //When click checkbox change disable button
  var checkbox = jQuery('#confirm_delete_checkbox');
  var deletedb_btn = jQuery('#deletedb_btn');
  checkbox.on('change', function(){
    if(this.checked){
      deletedb_btn.attr('disabled', false);
    }else{
      deletedb_btn.attr('disabled', true);
    }
  });
  return false;
}

//delete row field function AJAX
function wpfws_delete_form_item(page_id) {
    cancel();
    var path = "<?php echo WPFWS_SPIRAL_PLUGIN_DIR_URL; ?>";
    var current_db_count = <?php if (! empty($current_db_count)) { echo $current_db_count; } else { echo '0'; } ?>;

    //Ajax request to delete DB libs/wpfws_delete_DB.php
    jQuery.ajax({
    url: path+'libs/wpfws_delete_DB.php',
    data: {
      delete_db : 'DELETE',
      form_id : page_id
    },
    type: 'post',
    success: function(output) {
      if (output == "SUCCESS") {

        var e = jQuery('#form_name'+page_id);
        var row = e.parent().parent().parent().hide();
        jQuery('#error_msg').hide();

        //Check DB limit and hide the warning 
        var db_count_update = current_db_count - 1;
        if (db_count_update < 20) {
          jQuery('#max_db_notic_warning').hide();
          jQuery('#wpfws_add_new_btn').show();
        }

      } else {
        jQuery('#error_msg').html(output);
        jQuery('#error_msg').show();
      }
    }
    });
}

//Cancel popup
function cancel() {
  jQuery(".cover").fadeOut();
  jQuery("#popup_delete, #Ac_popup, #Deac_popup, #dblimit_popup").fadeOut();
  return false;
}

jQuery(document).ready(function() {
  //redirect link back to original
  var windowURL = 'admin.php?page=wpfws_form_lists';
  window.history.pushState(null, null, windowURL);

  //Add blue bar to active form
  jQuery("#the-list tr").not(':has(".delete")').each(function() {
        var row = jQuery(this).children()[0];
        jQuery(row).addClass('form-active');
  });

  //Disable Add new button when reach or over 100 DB
  if(jQuery('#max_db_notic_warning').is(':visible')){
    jQuery('#wpfws_add_new_btn').hide();
  }

});
</script>
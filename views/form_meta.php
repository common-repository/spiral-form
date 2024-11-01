<?php
/**
 * 管理画面＞設定＞WP Form with SPIRALのアウトプット
 *
 * @package   Spiral_Form
 * @author    PIPED BITS Co.,Ltd.
 */
?>
<!-- Update page title base on form edit or create !-->
<script type="text/javascript">
jQuery('body').attr("onload"," is_wpfws_thankmail_use();is_wpfws_notimail_use();");
</script>
<div class="wrap">
<h1 class="wp-heading-inline" id="form_setting_head" style="font-size: 23px; font-weight: 400;"></h1>
<?php
if(isset($_GET['page']) && $_GET['page'] == 'wpfws_new'){
    $new_post = array(
    'post_title'    => 'Auto Draft',
    'post_status'   => 'draft',
    'post_type'     => 'wpfws_page'
    );
    $wpfws_post_id = wp_insert_post($new_post);
}else{
    $wpfws_post_id = sanitize_text_field($_GET['post']);
}
?>
    <form id="wpfws_form" method="POST" action="" >
        <input type="hidden" name="wpfws_save" value="">
        <input type="hidden" name="wpfws_page" value="<?php echo $_GET['page']; ?>">
        <input type="hidden" name="wpfws_post_id" value="<?php echo $wpfws_post_id; ?>">
    <!-- Declaration variables for every fields !-->
    <?php

        $wpfws_db_name = get_post_meta($wpfws_post_id,'wpfws_db_name',true);
        $wpfws_db_id = get_post_meta($wpfws_post_id,'wpfws_db_id',true);
        $wpfws_required_array = get_post_meta($wpfws_post_id,'wpfws_form_required',true);
        $wpfws_field_used_array = get_post_meta($wpfws_post_id,'wpfws_field_used',true);
        $wpfws_type_array = get_post_meta($wpfws_post_id,'wpfws_form_type',true);
        $wpfws_label_array = get_post_meta($wpfws_post_id,'wpfws_form_label',true);
        $wpfws_name_array = get_post_meta($wpfws_post_id,'wpfws_form_name',true);
        $wpfws_placeholder_array = get_post_meta($wpfws_post_id,'wpfws_form_placeholder',true);
        $wpfws_pretext_array = get_post_meta($wpfws_post_id,'wpfws_form_pretext',true);
        $wpfws_aftertext_array = get_post_meta($wpfws_post_id,'wpfws_form_aftertext',true);
        $wpfws_options_array = get_post_meta($wpfws_post_id,'wpfws_form_options',true);
        $wpfws_dropdown_text = get_post_meta($wpfws_post_id,'wpfws_dropdown_text',true);
        $wpfws_required_text = get_post_meta($wpfws_post_id,'wpfws_required_text',true);
        $wpfws_send_field = get_post_meta($wpfws_post_id,'wpfws_send_field',true);
        $wpfws_confirm_text = get_post_meta($wpfws_post_id,'wpfws_confirm_text',true);
        $wpfws_send_text = get_post_meta($wpfws_post_id,'wpfws_send_text',true);
        $wpfws_cancel_text = get_post_meta($wpfws_post_id,'wpfws_cancel_text',true);
        $wpfws_thanks_url = get_post_meta($wpfws_post_id,'wpfws_thanks_url',true);
        $wpfws_thanks_text= get_post_meta($wpfws_post_id,'wpfws_thanks_text',true);
        $wpfws_free_text_footer= get_post_meta($wpfws_post_id,'wpfws_free_text_footer',true);
        $wpfws_display_array = get_post_meta($wpfws_post_id,'wpfws_display',true);
        $wpfws_title = get_post_meta($wpfws_post_id,'wpfws_title',true);
        $wpfws_free_text_header= get_post_meta($wpfws_post_id,'wpfws_free_text_header',true);
        $wpfws_start_year= get_post_meta($wpfws_post_id,'wpfws_start_year',true);
        $wpfws_end_year= get_post_meta($wpfws_post_id,'wpfws_end_year',true);
        $wpfws_year_order= get_post_meta($wpfws_post_id,'wpfws_year_order',true);
        $wpfws_date_format= get_post_meta($wpfws_post_id,'wpfws_date_format',true);
        $wpfws_date_dr_year= get_post_meta($wpfws_post_id,'wpfws_date_dr_year',true);
        $wpfws_date_dr_month= get_post_meta($wpfws_post_id,'wpfws_date_dr_month',true);
        $wpfws_date_dr_day= get_post_meta($wpfws_post_id,'wpfws_date_dr_day',true);
        $wpfws_thankmail_active = get_post_meta($wpfws_post_id,'wpfws_thankmail_active',true);
        $wpfws_thankmail_recipient = get_post_meta($wpfws_post_id,'wpfws_thankmail_recipient',true);
        $wpfws_thankmail_recipient_name = get_post_meta($wpfws_post_id,'wpfws_thankmail_recipient_name',true);
        $wpfws_thankmail_sender = get_post_meta($wpfws_post_id,'wpfws_thankmail_sender',true);
        $wpfws_thankmail_subject = get_post_meta($wpfws_post_id,'wpfws_thankmail_subject',true);
        $wpfws_thankmail_body = get_post_meta($wpfws_post_id,'wpfws_thankmail_body',true);
        $wpfws_notimail_active = get_post_meta($wpfws_post_id,'wpfws_notimail_active',true);
        $wpfws_notimail_recipient = get_post_meta($wpfws_post_id,'wpfws_notimail_recipient',true);
        $wpfws_notimail_recipient_name = get_post_meta($wpfws_post_id,'wpfws_notimail_recipient_name',true);
        $wpfws_notimail_sender = get_post_meta($wpfws_post_id,'wpfws_notimail_sender',true);
        $wpfws_notimail_subject = get_post_meta($wpfws_post_id,'wpfws_notimail_subject',true);
        $wpfws_notimail_body = get_post_meta($wpfws_post_id,'wpfws_notimail_body',true);
        $wpfws_fields_id_array= get_post_meta($wpfws_post_id,'wpfws_fields_id',true);
        $wpfws_fields_name_array= get_post_meta($wpfws_post_id,'wpfws_fields_name',true);
        $wpfws_thankmail_setting = get_post_meta($wpfws_post_id,'wpfws_used_thankmail',true);
        $wpfws_notimail_setting = get_post_meta($wpfws_post_id,'wpfws_used_notimail',true);
        $wpfws_app_id_form = get_post_meta($wpfws_post_id,'wpfws_app_id_form',true);
    ?>
    <!-- Check which display is selected !-->
    <?php
    if($wpfws_display_array){
        foreach ($wpfws_display_array as $j => $value);
            foreach ($wpfws_display_array as $dkey => $value) {
                if(isset($_GET['display'])){
                  if($value == sanitize_text_field( wp_unslash($_GET['display'] ) )){
                    $fkey = $dkey;
                    break;
                  }
                }else
                  $fkey=0;
            }
    }else
        $fkey=0;
    ?>
<div id="wpfws_form_setting" style="border: 1px solid #e5e5e5;">
<div style="border-left: 4px solid #00a0d2; padding: 5px;">
    <b style="font-size: 1.4em;">フォーム設定</b>
    <p class="alignright" id="app_id_db_id" style="margin-top:0;">アプリID: <?php if($wpfws_app_id_form){echo  esc_html($wpfws_app_id_form);}else{ echo "-";} ?><span class="api_not_link"><?php if ($wpfws_app_id_form != get_option('wpfws_app_id') && $wpfws_app_id_form != ""){echo "(未連携)";};?></span>&nbsp;&nbsp;&nbsp;DBID: <?php echo  esc_html($wpfws_db_id); ?></p>
</div>
<div class="popup" id="display_warn">
    <div class="content">
        <div>
            <h1 class="popup_header">表示切替</h1>
        </div>
        <p class="desc_msg">表示切替とは、同一項目を持つフォームを複数設定し、パラメーターでフォーム上の表示内容を切り替える機能です。<br>同じ項目で複数の言語別のフォームを作成したい場合や、キャンペーンフォームのABテストでコンバージョン率の計測を行いたい場合等に活用できます。<br>表示切替を追加すると、同一の項目を持つフォームを最大20まで設定することができます。<br>それぞれのフォームから登録されたデータは、連携先SPIRALの同一DBに登録され「表示切替」というフィールドにフォーム毎に設定した表示切替名称が自動格納されます。</p>
        <p class="desc_msg"><b>例1）多言語フォームの利用(日本語・中国語の2フォームを作成したい場合)</b><br>&nbsp;&nbsp;1. フォーム設定設定後、「default」の横の「変更」ボタンで表示名を「Japanese」に変更<br>&nbsp;&nbsp;2.「追加」ボタンをクリックし表示名に「Chinese」と記入し保存<br>&nbsp;&nbsp;3. フォーム項目名等を中国語に変更し保存<br>&nbsp;&nbsp;この手順を行うことにより、多言語のフォームを作成することができます。</p>
        <p class="desc_msg"><b>例2）複数のキャンペーンフォーム利用(キャンペーンフォーム毎の流入数を測定したい場合)</b><br>&nbsp;&nbsp;表示切替を追加し、それぞれ表示名を「campaign1」「campaign2」「campaign3」と設定します。<br>&nbsp;&nbsp;フォーム登録データを確認する際、「表示切替」に各フォームの表示切替名が格納されるため、<br>&nbsp;&nbsp;どのフォームから何件応募があったか等、確認することできます。</p>
        <p class="desc_msg" style="color: red;">※同一の投稿ページや固定ページに、複数のフォーム埋め込みショートコードが設定されている場合、該当ページを表示すると、自動的に1つ目設定した表示切替の内容のフォームが表示されます。</p>
        <div class="option" style=" position: relative; ">
            <button  style="cursor:pointer;background-color: #349fbf;border-color: #ced4da;color: #ffffff; width: 90px;" class="cancel btn btn-primary">OK</button>
        </div>
    </div>
</div>

<!-- Check with DB Limited 20 -->
<?php
    $app_id = get_option('wpfws_app_id');
    $response_db = wpfws_set_URL("dbs?apps=$app_id");
    $current_db_count = ($response_db['totalCount'] != null) ? $response_db['totalCount'] : '0';
?>
<!-- DB Limit Error Popup -->
<div id="dblimit_popup" class="popup">
    <div class="content">
            <h1 class="popup_header">エラー</h1>
            <p style="text-align: left;">連携先SPIRALの同一アプリ内にデータベースが20個設定されているため、フォームを新規登録できません。<br>フォーム一覧画面で不要なフォームを削除するか、SPIRALにログインし、フォームと連動しない不要なDBを削除してください。</p>
        <div style="margin-top: 2%;">
            <button id="err_db_limit_btn" class="cancel btn btn-primary" return false;">OK</button>
        </div>
    </div>
</div>
<!-- End Check with DB Limited -->

<!-- Error canno t create DB -->
<div class="popup" id="popup_create_DB_error" >
    <div class="content">
        <div>
            <h1 class="popup_header">DB作成エラー</h1>
        </div>
        <br>
        <p id="create_db_error_p1" style="color: #d9534f;">データベース作成が完了していません。</p>
        <p id="create_db_error_p2">ページを更新しデータベースを作成してください。</p>
        <div class="option" style="position: inherit;">
            <button  style="cursor:pointer;background-color: #349fbf;border-color: #ced4da;color: #ffffff; margin-top: 15px; width: 15%;" class="cancel btn btn-primary">OK</button>
        </div>
    </div>
</div> 
<!-- Popup add new display -->
<div class="popup" id="popup_add" style="height: auto;">
    <div class="content" style="padding-top: 20px;">
        <div>
            <h1 class="popup_header">表示切替追加</h1>
        </div>
            <a class="close" style="cursor:pointer;">&times;</a>
            <input type="text" id="wpfws_display" name="wpfws_display[<?php echo esc_js( $key );?>]" class="displayinput" maxlength="50" onkeyup="validate_display_add_input(<?php echo esc_js( $key );?>)">
            <p class="emsg hidden" id="add_display_emsg"></p>
            <br><br><input type="submit" type="button" class="btn btn-primary" name="confirm_add" id="confirm_add" value="追加">
            <p style="text-align:left;">※フォーム設定を変更中の場合にはその設定は破棄されます。</p>
    </div>
</div>
<!--New display-->
<div class="popup" id="popup_edit" style="height: auto;">
    <div class="content" style="padding-top: 20px;">
        <div>
            <h1 class="popup_header">表示切替編集</h1>
        </div>
            <a class="close" style="cursor:pointer;">&times;</a>
            <input type="text" id="wpfws_display_edit" name="wpfws_display_edit[<?php echo esc_attr( $fkey ); ?>]" value="<?php if($wpfws_display_array[$fkey]){echo esc_attr( $wpfws_display_array[$fkey] );}else{echo "default";}?>" class="displayinput" maxlength="50"onkeyup="validate_display_edit_input(<?php echo esc_js( $key );?>)">
            <p class="emsg hidden" id="edit_display_emsg"></p>
           <br><br> <input type="submit" name="save_display_edit" id="save_display_edit" class="btn btn-primary" value="編集">
            <?php
                if($fkey != 0){
                    echo '<input type="submit" class="btn btn-danger" name="delete" id="delete" value="削除">';
                    echo '<p style="text-align:left;">※ショートコードを既に投稿ページ・固定ページに埋め込んでいる場合、<br>
                    変更後ショートコードを更新しないと、プルダウンの一番上の設定の値が表示されます。<br>
                    変更した場合は投稿ページ・固定ページのショートコードも更新してください。<br>※フォーム設定を変更中の場合にはその設定は破棄されます。</p>';
                }elseif($fkey == 0){
                    echo '<p style="text-align:left;">※表示切替で一番目に表示される項目は削除できません。<br>※フォーム設定を変更中の場合にはその設定は破棄されます。</p>';
                }
            ?>
    </div>
</div>
<!-- Popup confirm delete display -->
<div class="popup" id="popup_confirm_delete" style="width: 550px">
    <div class="content" style="padding-top: 20px;">
        <div>
            <h1 class="popup_header">以下の表示切替を削除しますか？</h1>
        </div>
            <a class="close" style="cursor:pointer;font-size: 30px;">&times;</a>
        <div>
            <h2 style="word-break: break-all; font-size: 18px;"><?php echo esc_html($wpfws_display_array[$fkey]); ?></h2>
        </div>
        <div>
            <p style="text-align: left;">※表示切替を削除すると、当該表示切替の設定内容も削除されます。<br>※固定ページや投稿ページで、削除された表示切替のフォームを利用している場合は、<br>その時点で表示切替の一番目に設定されている表示切替の設定で扱われます。
        </div>
        <div style="margin-bottom: 20px;">
            <label><input type="checkbox" id="confirm_delete_display_checkbox"/>上記表示切替を削除する</label>
        </div>
        <div class="option" style="position: inherit;">
            <input type="submit" type="button" class="btn btn-danger" name="deletedisplay" id="deletedisplay" value="削除" style="margin-top: 0px;" disabled="disabled">
            <button style="cursor:pointer;background-color: #ced4da;border-color: #ced4da;color: #212529;" class="cancel btn btn-primary">キャンセル</button>
        </div>
    </div>
</div>
<!-- Popup field setting except date dropdown -->
<div class="popup" id="popup_field_setting" style="width: 635px;">
    <form id="field_setting"> 
        <div class="content" style="padding-top: 20px;">
            <div style="padding: 5px 5px;">
                <h1 class="popup_header">詳細設定</h1>
            </div>
                <a class="close" style="cursor:pointer;font-size: 41px;margin-top: 1%;">&times;</a>
            <div class="option_setting" style="float: left; font-size: 1.5em;">
                    <table class="wp-list-table widefat fixed striped pages" style="margin-bottom: 15px;">
                    <tr id="field_type">
                        <th class="th_field">形式</th>
                        <td class="setting_input">
                            <span class="" id="select"></span>
                        </td>
                    </tr>
                    <tr id="field_label">
                        <th class="th_field">項目名</th>
                        <td  class="setting_input">
                            <span class="" id="form_label"></span>
                        </td>
                    </tr>
                    <tr id="name_field">
                        <th class="th_field">name値</th>
                        <td  class="setting_input">
                            <span class="" id="form_name"></span>
                            </td>
                    </tr>
                    <tr id="placeholder">
                        <th class="th_field">プレースホルダ</th>
                        <td>
                            <input class="setting_input" type="text" id="wpfws_form_placeholder" name="wpfws_form_placeholder" value="" maxlength="28">
                        </td>
                    </tr>
                    <tr id="pretext">
                        <th class="th_field">接頭語</th>
                        <td>
                            <input class="setting_input" id="wpfws_form_pretext" type="text" name="wpfws_form_pretext" value="" maxlength="28">
                        </td>
                    </tr>
                    <tr id="aftertext">
                        <th class="th_field">接尾語</th>
                        <td>
                            <input class="setting_input" id="wpfws_form_aftertext" type="text" name="wpfws_form_aftertext" value="" maxlength="28">
                        </td>
                    </tr>
                    <tr id="options" style="display: none;">
                        <th class="th_field">選択肢</th>
                        <td>
                    <textarea class="select_opt" id="wpfws_form_options" name="wpfws_form_options" onkeyup="check_select_options(this);"></textarea>
                            <p class="emsg hidden" id="select_options_emsg"></p>
                            <p style="text-align: left;">※改行区切り、最大128項目</p>
                        </td>
                    </tr>
                    </table>
            </div>
            <div class="btn-setting-dropdown">
                 <input type="button" class="btn btn-primary" name="save_setting" id="save_setting" value="一時保存">
                 <button style="cursor:pointer;background-color: #ced4da;border-color: #ced4da;color: #212529;" class="cancel btn btn-primary">キャンセル</button>
            </div>
            <div>
             <p style="font-size: 14px;text-align: left;">※一時保存した設定は、フォーム設定を新規作成または設定変更しないとフォームに反映されません。</p>   
            </div>
        </div>
    </form>
</div>
<!-- Popup date_dropdown -->
<div class="popup" id="popup_date_dropdown" style="text-align: left;">
    <form id="date_form"> 
        <div class="content" style="padding-bottom: 0px;">
            <div style="padding: 5px 5px;">
                <h1 class="popup_header">詳細設定</h1>
            </div>
                <a class="close" style="cursor:pointer;font-size: 41px;margin-top: 1%;">&times;</a>
            <div class="date_dropdown_setting" style="float: left; font-size: 1.5em;">
                    <table class="wp-list-table widefat fixed striped pages" style="margin-bottom: 15px;">
                        <tr id="field_type">
                            <th class="th_field">形式</th>
                           <td class="setting_input">日付 プルダウン</td>
                        </tr>
                        <tr id="field_label">
                            <th class="th_field">項目名</th>
                            <td  class="setting_input">
                            <span class="" id="form_label_date_dropdown"></span>
                        </td>
                        </tr>
                        <tr id="name_field">
                            <th class="th_field">name値</th>
                            <td  class="setting_input">
                            <span class="" id="form_name_date_dropdown"></span>
                        </td>
                        </tr>
                        <tr>
                        <th style="width: 30%;">開始/終了年</th>
                        <td>
                        <label for="wpfws_start_year" class="th_field">開始年 
                        <input type="text" class="setting_input" name="wpfws_start_year" id="wpfws_start_year" value="1918" required/></label>
                        <span class="emsg_date hidden" id="start_year_emsg"></span>
                        <label for="wpfws_end_year" class="th_field">終了年
                        <input type="text" class="setting_input" name="wpfws_end_year" id="wpfws_end_year" value="2028" required/></label>
                        <span class="emsg_date hidden" id="end_year_emsg"></span>
                        </td>
                        </tr>
                        <tr>
                            <th for="wpfws_year_order" class="th_field">日付順</th>
                            <td>
                                <select name="wpfws_year_order" id="wpfws_year_order" type="text" style="width: 25%;" />
                                <option value="false" class="setting_input">昇順</option>
                                <option value="true"  class="setting_input">降順</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="th_field">年月日表示</th>
                            <td>
                                <select name="wpfws_date_format" id="wpfws_date_format" type="text" style="white-space: nowrap;">
                                <option class="setting_input" value="YYYY-MM-DD">YYYY-MM-DD</option>
                                <option class="setting_input" value="DD-MM-YYYY">DD-MM-YYYY</option>
                                <option class="setting_input" value="MM-DD-YYYY">MM-DD-YYYY</option>
                                </select>
                            </td>
                        </tr>
                         <tr>
                        <th style="width: 30%;" class="th_field">プルダウン未選択時</th>
                        <td>
                        <label for="wpfws_date_dr_year" class="th_field">年 
                        <input type="text" class="setting_input" name="wpfws_date_dr_year" id="wpfws_date_dr_year" value="年" maxlength="20" required="required"/></label>
                       <span class="emsg_date hidden" id="year_text_emsg"></span>
                        <label for="wpfws_date_dr_month" class="th_field">月
                        <input type="text" class="setting_input" name="wpfws_date_dr_month" id="wpfws_date_dr_month" value="月" maxlength="20" required="required"/></label>
                        <span class="emsg_date hidden" id="month_text_emsg"></span>
                         <label for="wpfws_date_dr_day" class="th_field">日
                        <input type="text" class="setting_input" name="wpfws_date_dr_day" id="wpfws_date_dr_day" value="日" maxlength="20" required="required"/></label>
                        <span class="emsg_date hidden" id="day_text_emsg"></span>
                        </td>
                        </tr>
                    </table>
            </div>
            <div class="btn-date-dropdown" style="text-align: center;">
                <input type="button" class="btn btn-primary" name="save_date" id="save_date" value="一時保存">
                <button style="cursor:pointer;background-color: #ced4da;border-color: #ced4da;color: #212529;" class="cancel btn btn-primary">キャンセル</button>
            </div>
            <div>
             <p style="font-size: 14px;text-align: left;">※一時保存した設定は、フォーム設定を新規作成または設定変更しないとフォームに反映されません。</p>   
            </div>
        </div>
    </form>
</div>
<!-- Popup delete field -->
<div class="popup" id="popup_field_delete" style=" width:635px;">
    <div class="content" style="padding-top: 20px;" >
      <div>
            <h1 class="popup_header">以下のフォーム項目を削除しますか？</h1>
        </div>
            <a class="close" style="cursor:pointer;">&times;</a>
                <table class="wp-list-table widefat fixed striped ">
                <tr id="field_type">
                    <th class="th_field">形式</th>
                    <td class="setting_input">
                        <span class="" id="select_del"></span>
                    </td>
                </tr>
                <tr id="field_label">
                    <th class="th_field">項目名</th>
                    <td  class="setting_input">
                        <span class="" id="form_label_del"></span>
                    </td>
                </tr>
                <tr id="name_field">
                    <th class="th_field">name値</th>
                    <td  class="setting_input">
                        <span class="" id="form_name_del"></span>
                        </td>
                </tr>
                </table>

        <p style="color: #d9534f; text-align: left;">SPIRALデータベース内の該当フィールドに登録されたデータも同時に削除されます。</p>
        <p style="text-align: left;">※登録されたデータを残したまま、該当フォーム項目をフォーム上非表示にするには、
該当フォーム項目の「使用」のチェックを外してください。</p>
        <div style="margin-bottom: 20px;">
            <label>
            <input type="checkbox" id="confirm_delete_checkbox"/>フィールドを削除する
            </label>
        </div>
        <input type="button" class="btn btn-danger" name="deletedb" id="delfield_btn" value="削除"  disabled="disabled">
        <button  style="cursor:pointer;background-color: #ced4da;border-color: #ced4da;color: #212529;" class="cancel btn btn-primary">キャンセル</button>

        <p  id="error_del_field"style="color: #d9534f; display: none;">フィールドは少なくとも1つ以上設定する必要があります。</p>
        <div>
        <p id="message_delete_field" style="text-align: left;">※「設定変更」ボタンをクリックした際に、個別設定のコンテンツが完全に削除されます。</p>
        </div>
    </div>
</div>
<!-- Popup delete last field -->
<div class="popup" id="popup_field_delete_error" style="height: 195px" >
    <div class="content">
      <div>
        <div>
            <h1 class="popup_header">エラー</h1>
        </div>
      </div>
            <br>
            <p style="color: #d9534f;">フィールドは少なくとも1つ以上設定する必要があります。</p>
            <br>
        <div class="option">
            <button  style="cursor:pointer;background-color: #349fbf;border-color: #ced4da;color: #ffffff; margin-top: 15px; width: 15%;" class="cancel btn btn-primary">OK</button>
        </div>
    </div>
</div>
<!-- Popup Mail setting warning -->
<div class="popup" id="mail_setting_wmsg" style="width: 635px;">
    <div class="content" style="padding: 14px;padding-top: 0px;">
        <div style="padding-top: 10px;">※すべての表示切替に適用されます。</div>
        <div>
            <h2 class="popup_header">メール送信テストのお願い</h2>
        </div>
        <p class="desc_msg">サンキューメール・通知メールは、WordPressが動作しているサーバから送信します。サーバの設定により、メールが送信できない場合がありますので、メール設定を行った後、作成したフォームでテスト登録を行い、正しく送信されることを必ず確認してください。</p>
            <h2 class="popup_header">　テスト登録時にメールが受信できない場合</h2>
            <p class="desc_msg" >サーバ管理者にメール送信に関する設定を確認いただくようお問い合わせください。</p>
        <div class="option" style=" position: relative; ">
            <button  style="cursor:pointer;background-color: #349fbf;border-color: #ced4da;color: #ffffff; width: 90px;" class="cancel btn btn-primary">OK</button>
        </div>
    </div>
</div>
<!-- Popup mail setting uncheck use thankmail -->
<div class="popup" id="popup_unchecked_thankmailuse" style=" width:635px;">
    <div class="content">
      <div>
            <h1 id="header_notuse_mail_popup" class="popup_header" style="font-size: 1.6em;">サンキューメールの使用を解除しますか？</h1>
        </div>
            <a class="close" id="close_radio_change" style="cursor:pointer;">&times;</a>
        <p id="content_uncheckmail" style="text-align: left; white-space: pre-line;">サンキューメール設定はフォーム全体に適応されるため、他の表示切替でもサンキューメールを使用することができなくなります。</p>
        <div style="margin-bottom: 20px;">
            <label><input type="checkbox" id="confirm_UncheckThankMail"/>サンキューメールの使用を解除</label>
        </div>
        <input type="button" class="btn btn-primary" name="changeradio" id="check_use_thankmail_checkbox" value="変更"  disabled="disabled">
        <button id="cancel_btn"  style="cursor:pointer;background-color: #ced4da;border-color: #ced4da;color: #212529;" class="cancel btn btn-primary">キャンセル</button> 
         <p id="noted_msg_usemail" style="text-align: left;" >※フォームの新規登録／情報更新ボタンをクリックした際に変更が反映されます。</p>     
    </div>
</div>
<!-- Popup mail setting uncheck use notimail -->
<div class="popup" id="popup_unchecked_notimailuse" style=" width:635px;">
    <div class="content">
      <div>
            <h1 id="header_notiuse_mail_popup" class="popup_header" style="font-size: 1.6em;">通知メールの使用を解除しますか？</h1>
        </div>
            <a class="close" id="close_notuse_notimail" style="cursor:pointer;">&times;</a>
        <p id="content_uncheckmail" style="text-align: left; white-space: pre-line;">通知メール設定はフォーム全体に適応されるため、他の表示切替でも通知メールを使用することができなくなります。</p>
        <div style="margin-bottom: 20px;">
            <label><input type="checkbox" id="confirm_UncheckNotiMail"/>通知メールの使用を解除</label>
        </div>
        <input type="button" class="btn btn-primary" name="changeradio" id="check_use_notimail_checkbox" value="変更"  disabled="disabled">
        <button id="cancel_btn_notimail"  style="cursor:pointer;background-color: #ced4da;border-color: #ced4da;color: #212529;" class="cancel btn btn-primary">キャンセル</button>
        <p id="noted_msg_usemail" style="text-align: left;" >※フォームの新規登録／情報更新ボタンをクリックした際に変更が反映されます。</p>     
    </div>
</div>
<!-- Popup mail setting warning -->
<div class="popup" id="popup_mail_radio_change" style=" width:635px;">
    <div class="content" style="padding-bottom: 0px;">
      <div>
            <h1 id="header_mail_popup" class="popup_header" style="font-size: 1.6em;">共通コンテンツに変更</h1>
        </div>
            <a class="close" id="close_radio_change" style="cursor:pointer;text-align: left;">&times;</a>
        <p style="text-align: left;">既に表示切替を設定している場合、それぞれの表示切替に設定した個別コンテンツは自動的に削除され、1つ目の表示切替の値が自動反映されます。</p>
        <div style="margin-bottom: 20px;">
            <label>
            <input type="checkbox" id="confirm_change_mail_radio"/>共通コンテンツに変更
            </label>
        </div>
        <input type="button" class="btn btn-primary" name="changeradio" id="change_mail_btn" value="変更"  disabled="disabled">
        <button id="cancel_btn"  style="cursor:pointer;background-color: #ced4da;border-color: #ced4da;color: #212529;" class="cancel btn btn-primary">キャンセル</button>
        <p id="noted_msg_usemail" style="text-align: left;" >※フォームの情報更新ボタンをクリックした際に変更が反映されます。</p>        
    </div>
</div>

<!-- Popup chnage to use each mail setting warning -->
<div class="popup" id="popup_use_each_change" style=" width:635px;">
    <div class="content" style="padding-bottom: 0px;">
      <div>
            <h1 id="header_mail_popup" class="popup_header" style="font-size: 1.6em;">表示切替ごとに異なるコンテンツに変更</h1>
        </div>
            <a class="close" id="close_radio_change" style="cursor:pointer;">&times;</a>
        <p id="msg_content" style="text-align: left;">既に表示切替を追加している場合で、メールの「使用する」に初めてチェックを付けた際、他の表示切替には1つ目の表示切替のコンテンツが自動的に複製されます。個別コンテンツの設定は各表示切替ごとに設定を行ってください。</p>
        <button  style="cursor:pointer;background-color: #349fbf;border-color: #ced4da;color: #ffffff; width: 90px;" class="cancel btn btn-primary">OK</button>
        <p id="noted_msg_usemail" style="text-align: left;" >※フォームの新規登録／情報更新ボタンをクリックした際に変更が反映されます。</p>        
    </div>
</div>

<div class="cover"></div>
<table class="wp-list-table widefat fixed striped pages sortable" id="tablecontent" style="margin-top:-2px;">
    <thead>
        <tr>
            <th colspan="3" class="displayhead"><b>表示切替<span class="dashicons dashicons-info" style="cursor: pointer; font-size: 20px; margin-top: -1px;margin-left: 1px;" ></span></b></th>
            <td colspan="10">
                <div id="display" class="inline_display">
                    <?php echo '<select id="select_display" name="select_display" onchange="location = this.value;" style="margin-right:3px;">';
                        if(!$wpfws_display_array){
                        echo '<option value="default">default</option>';
                        }else{
                            foreach ($wpfws_display_array as $key => $value){
                            echo '<option value="' . esc_url( admin_url('/admin.php?page=wpfws_form_lists&action=edit&display=' .esc_attr( $value ). '&post='.sanitize_text_field( wp_unslash( $_GET['post'] ) ).'#sptop') ) . '" ' .((isset($_GET['display']) && $value == sanitize_text_field( wp_unslash( $_GET['display']) ))?'selected="selected"' : ""). '>' . $value . '</option>';
                             }
                         }
                            echo '</select>';
                    ?>
                <button id="edit" class="button button-primary" style="margin-right: 3px;">編集</button>
                <button id="add" class="button button-primary">追加</button>
                <p style="margin-top: 5px;">フォーム設定保存後、表示切替の編集・追加を行うことができます。※最大20設定</p>
                </div>
            </td>
        </tr>
        <tr> 
        <?php
            if($wpfws_display_array){
                echo '<th colspan="3" style="padding-right:0px;"><b>フォーム埋め込み用ショートコード </b></th>';
                global $post;
                $post_name=$post->post_name;
                foreach ($wpfws_display_array as $key => $value){
                    if(!$_GET['display'] || $value == sanitize_text_field( wp_unslash( $_GET['display']) ) ){
                    echo '<td  colspan="10"><div id="shortcode_copy" class="inline_display"><p style="font-size: 14px;margin-bottom: 2px;" id="'. esc_attr( $value ) .'" class="shortcode">[wpfws_form id="' .$wpfws_post_id.'" display="'.esc_attr( $value ). '"]</p></div>';
        ?>
        <div class="copy-menu">
        <span class="btn-copy" title="Copy Short Code" role="button" onclick="copyToClipboard('<?php echo esc_js( $value ); ?>');">
        <span class="btn-copy-img"><img src="<?php echo esc_url(WPFWS_SPIRAL_PLUGIN_DIR_URL); ?>img/copy-content.png" width="15px"></span>
        </span>
        <div class="copy-info" id="copy_info_<?php echo esc_attr( $value ); ?>">
        <span>Short Code Copied</span>
        </div>
        </div>
        </td>
        <?php
         break;
        }}}
        ?>
            </td>
        </tr>
        <tr>
            <th colspan="3"><b>フォーム見出し</b><span class="requiresign">*</span></th>
            <td colspan="10">
                <input class="intro" id="wpfws_title" type="text" name="wpfws_title[<?php echo esc_attr( $fkey ); ?>]" maxlength="64" value="<?php if(isset($wpfws_title[$fkey])){echo esc_attr( $wpfws_title[$fkey] );} ?>" style="margin-left: 0px;" onkeyup="form_title_check(event)" >
                <p class="emsg hidden" id="wpfws_title_emsg"></p>
            </td>
        </tr>
        <tr>
            <th colspan="3"><b>ヘッダーフリーテキスト</b></th>
            <td colspan="10">
                <?php
                    if(isset($wpfws_free_text_header[$fkey])){$content= "$wpfws_free_text_header[$fkey]";}
                    else{$content = "";}
                    $settings = array('editor_height' => 100, 'textarea_name' => 'wpfws_free_text_header['.$fkey.']');
                    $editor_id = 'editorheader';
                    wp_editor (html_entity_decode( $content ), $editor_id, $settings);
                ?>
            </td>
        </tr>
        <tr>
            <th colspan="13">
                <b style="margin-right: 10px; line-height: 2;"> フォーム項目設定 </b>
                <button class="button button-primary" id="add_new_field" type="button" onclick="create_wpfws_form_item();">新規項目を追加</button>
                <span style="margin-left: 10px; line-height: 2;"> ※最大30項目 </span>
            </th>
        </tr>
        <tr>
            <td>移動</td>
            <td style="padding-left: 1px;">使用</td>
            <td style="padding-left: 1px;">必須</td>
            <td colspan="2">形式</td>
            <td colspan="4">項目名 <span class="requiresign">*</span></td>
            <td colspan="3">name値 <span class="requiresign">*</span></td>
            <td>詳細</td>
        </tr>
    </thead>

<tbody id="form_elements">
<?php
if(is_array($wpfws_name_array)){
    if(!empty($wpfws_display_array)){
    foreach ($wpfws_display_array as $x => $value){
      if(isset($_GET['display'])){
        if($value == sanitize_text_field( wp_unslash( $_GET['display']) )){
            $ll=$x;
            break;
        }
    }
    }
}
}
if(is_array($wpfws_name_array)){
    $i = count($wpfws_label_array);
    if(!empty($wpfws_display_array)){
    $j = count($wpfws_display_array);
    $start = ($ll*ceil($i/$j));
    $end = ceil($i/$j)*($ll+1);
    }

    for($key=$start ; $key<$end ; $key++){
        //get the field id by compare field_name in wordpress with field_name in spiral
        if(!empty($wpfws_fields_name_array)){
            $field_id = array_search($wpfws_name_array[($key)], array_slice($wpfws_fields_name_array,1));
        }
?>
    <tr class="form_element_row" id="rowid<?php echo esc_attr($key);?>">
        <input type="hidden" id="wpfws_fields_id<?php echo esc_attr($key);?>" name="wpfws_fields_id[]" value="<?php echo esc_attr( $wpfws_fields_id_array[($field_id+1)] ); ?>">
        <th>
            <div class="handle" style="width: 10%; padding: 7px; cursor: move;"><span class="dashicons dashicons-menu"></span></div>
        </th>
        <td>
        <label>
            <input type="checkbox" name="used<?php echo esc_attr($key);?>" id="used<?php echo esc_attr($key);?>" value="使用する"  onchange="set_wpfws_used_hidden(this);set_used_and_required_field(<?php echo esc_js($key);?>);"  <?php if($wpfws_field_used_array[$key]=='1' || $wpfws_field_used_array[$key]==''  ){echo 'checked = "checked"';} ?>>
        </label>
            <input type="hidden" id="used_hidden<?php echo esc_attr($key); ?>" name="wpfws_field_used[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($wpfws_field_used_array[$key]); ?>">
        </td>
        <td>
            <label>
                <input class="required" type="checkbox"  id="required_<?php echo esc_attr($key); ?>" <?php if($wpfws_required_array[$key]=='1' ){echo 'checked = "checked"';} ?> onchange="set_wpfws_required_hidden(this);set_used_and_required_field(<?php echo esc_js($key);?>);" >
            </label>
                <input type="hidden" id="required_hidden<?php echo esc_attr($key);?>" name="wpfws_form_required[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($wpfws_required_array[$key]); ?>">
        </td>
         <td colspan="2">
            <select class="select" id="select<?php echo esc_attr($key); ?>" name="wpfws_form_type[<?php echo esc_attr($key); ?>]" onchange="change_field_type(<?php echo esc_attr($key);?>);getval(this);">
                <option value="text" <?php if($wpfws_type_array[$key]=='text' ){echo 'selected';} ?>>テキスト</option>
                <option value="textarea" <?php if($wpfws_type_array[$key]=='textarea' ){echo 'selected';} ?>>テキストエリア</option>
                <option value="email" <?php if($wpfws_type_array[$key]=='email' ){echo 'selected';} ?>>メールアドレス</option>
                <option value="radio" <?php if($wpfws_type_array[$key]=='radio' ){echo 'selected';} ?>>ラジオボタン</option>
                <option value="select" <?php if($wpfws_type_array[$key]=='select' ){echo 'selected';} ?>>プルダウン</option>
                <option value="checkbox" <?php if($wpfws_type_array[$key]=='checkbox' ){echo 'selected';} ?>>チェックボックス</option>
                <option value="date_dropdown" id="date_dropdown" <?php if($wpfws_type_array[$key]=='date_dropdown' ){echo 'selected';} ?>>日付 プルダウン</option>
                <option value="date" <?php if($wpfws_type_array[$key]=='date' ){echo 'selected';} ?>>日付 カレンダー</option>
            </select>
        </td>
        <td colspan="4">
            <input class="FieldDisplayName read" type="text" id="form_label<?php echo esc_attr( $key ); ?>" name="wpfws_form_label[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $wpfws_label_array[$key] ); ?>" maxlength="64" onkeyup="validate_form_label(<?php echo esc_js( $key ); ?>,event);" onfocusin="update_field_label_select_mail(this.id,this.value);">
            <p class="emsg hidden" id="form_label_emsg<?php echo esc_attr( $key );?>"></p>
        </td>
        <td class="validate_name" colspan="3">
            <input class="validateTextName read" type="text" id="form_name<?php echo esc_attr( $key ); ?>" name="wpfws_form_name[<?php echo esc_attr( $key ); ?>]" value="<?php if(!empty($field_id)){echo esc_attr($wpfws_name_array[$field_id]);}else{echo esc_attr($wpfws_name_array[$key]);} ?>" maxlength="64" placeholder="半角英数アンダースコアのみ" onkeyup="validate_form_name(<?php echo esc_js( $key ); ?>,event);" onfocusin="update_field_name_select_mail(this.id,this.value);">
            <input type="hidden" name="wpfws_form_name_disable[]" value="<?php echo $wpfws_name_array[$field_id]; ?>">
            <p class="emsg hidden" id="form_name_emsg<?php echo esc_attr( $key );?>"></p>
            <span id="errordupname" style="color: red;"></span>
        </td>
        <td>
        <div class="dropdown">
        <img class="dropbtn" id="threedot<?php echo esc_attr($key); ?>" src="<?php echo esc_url(WPFWS_SPIRAL_PLUGIN_DIR_URL); ?>img/threedot.png" width="15px" onclick="menuDropdown(event, <?php echo esc_attr($key);?>);" >
        <div id="field_setting_menu<?php echo esc_attr($key);?>" class="dropdown-content" style="width: 120px;">
        <a href="#" id="edit_field_menu<?php echo esc_attr($key);?>" onclick="edit_field_setting(<?php echo esc_attr($key);?>);return false;" class="dropdown_menu" style=" color: black; border-bottom: none;text-align: center; display: none;">詳細設定</a>
        <div _ngcontent-c24="" class="divider dropdown-divider"></div>
        <a href="#" id="delete_field"onclick="delete_field(<?php echo esc_attr($key); ?>);return false;" class="dropdown-item text-danger spg-cursor-pointer" style="text-align: center;">削除</a>
          </div>
          </div>
             <input name="wpfws_form_placeholder[<?php echo esc_attr($key); ?>]" id="wpfws_form_placeholder<?php echo esc_attr($key); ?>" type="hidden" value="<?php echo esc_attr($wpfws_placeholder_array[$key])?>">
            <input name="wpfws_form_pretext[<?php echo esc_attr($key); ?>]" id="wpfws_form_pretext<?php echo esc_attr($key); ?>" type="hidden" value="<?php echo esc_attr($wpfws_pretext_array[$key])?>">
            <input name="wpfws_form_aftertext[<?php echo esc_attr($key); ?>]" id="wpfws_form_aftertext<?php echo esc_attr($key); ?>" type="hidden" value="<?php echo esc_attr($wpfws_aftertext_array[$key])?>">
            <textarea name="wpfws_form_options[<?php echo esc_attr($key); ?>]" id="wpfws_form_options<?php echo esc_attr($key); ?>" style="display: none;"><?php echo esc_html($wpfws_options_array[$key])?></textarea>
            <input name="wpfws_start_year[<?php echo esc_attr( $key ); ?>]" id="wpfws_start_year<?php echo esc_attr( $key ); ?>" type="hidden" value="<?php echo esc_attr( $wpfws_start_year[$key] ); ?>">
            <input name="wpfws_end_year[<?php echo esc_attr( $key ); ?>]" id="wpfws_end_year<?php echo esc_attr( $key ); ?>" type="hidden" value="<?php echo esc_attr( $wpfws_end_year[$key] ); ?>">
            <input name="wpfws_year_order[<?php echo esc_attr( $key ); ?>]" id="wpfws_year_order<?php echo esc_attr( $key ); ?>" type="hidden" value="<?php echo esc_attr( $wpfws_year_order[$key] ); ?>">
            <input name="wpfws_date_format[<?php echo esc_attr( $key ); ?>]" id="wpfws_date_format<?php echo esc_attr( $key ); ?>" type="hidden" value="<?php echo esc_attr( $wpfws_date_format[$key] ); ?>">
            <input name="wpfws_date_dr_year[<?php echo esc_attr( $key ); ?>]" id="wpfws_date_dr_year<?php echo esc_attr( $key ); ?>" type="hidden" value="<?php echo esc_attr( $wpfws_date_dr_year[$key] ); ?>"/>
            <input name="wpfws_date_dr_month[<?php echo esc_attr( $key ); ?>]" id="wpfws_date_dr_month<?php echo esc_attr( $key ); ?>" type="hidden" value="<?php echo esc_attr( $wpfws_date_dr_month[$key] ); ?>">
            <input name="wpfws_date_dr_day[<?php echo esc_attr( $key ); ?>]" id="wpfws_date_dr_day<?php echo esc_attr( $key ); ?>" type="hidden" value="<?php echo esc_attr( $wpfws_date_dr_day[$key] ); ?>">
        </td>
    </tr>
<script>
    jQuery(document).ready(function(){
       var key = <?php echo esc_js( $key ); ?>;
       var type = jQuery("#select"+key).val();
    if(type != 'date_dropdown'){
       validate_field(type, key);
    }else{
        validate_date_dropdown(key);
    }
    });
</script>

<?php $first_arr++; }}
else{
    for($i=0; $i<3; $i++){
?>
    <tr class="form_element_row" id="rowid<?php echo esc_attr($i);?>">
        <th>
            <div class="handle" style="width: 10%;padding: 7px; cursor: move;"><span class="dashicons dashicons-menu"></span></div>
        </th>
        <td>
            <label>
            <input type="checkbox" name="used<?php echo esc_attr($i);?>" id="used<?php echo esc_attr($i);?>" value="使用" onchange="set_wpfws_used_hidden(this);set_used_and_required_field(<?php echo esc_js($i);?>);" checked>
            </label>
            <input type="hidden" name="wpfws_field_used[<?php echo esc_attr( $i ); ?>]" id="used_hidden<?php echo esc_attr($i); ?>" value="1">
        </td>
        <td>
            <label>
                <input type="checkbox" onchange="set_wpfws_required_hidden(this);set_used_and_required_field(<?php echo esc_js($i);?>);" id="required_<?php echo esc_attr($i);?>">
            </label>
            <input type="hidden" name="wpfws_form_required[<?php echo esc_attr( $i ); ?>]" id="required_hidden<?php echo esc_attr($i);?>" value="">
        </td>
        <td colspan="2">
        <select class="select" id="select<?php echo esc_attr($i);?>" name="wpfws_form_type[<?php echo esc_attr( $i ); ?>]" onchange="change_field_type(<?php echo esc_attr($i);?>);getval(this);">
            <option value="text">テキスト</option>
            <option value="textarea">テキストエリア</option>
            <option value="email" >メールアドレス</option>
            <option value="radio" >ラジオボタン</option>
            <option value="select" >プルダウン</option>
            <option value="checkbox" >チェックボックス</option>
            <option value="date_dropdown" id="date_dropdown" >日付 プルダウン</option>
            <option value="date" >日付 カレンダー</option>
        </select>
        </td>
        <td colspan="4">
            <input type="text" class="FieldDisplayName read" id="form_label<?php echo esc_attr( $i ); ?>" name="wpfws_form_label[<?php echo esc_attr( $i ); ?>]"  maxlength="64" onkeyup="validate_form_label(<?php echo esc_js( $i ); ?>,event);" onfocusin="update_field_label_select_mail(this.id,this.value);">
            <p class="emsg hidden" id="form_label_emsg<?php echo esc_attr( $i ); ?>"></p>
        </td>
        <td class="validate_name" colspan="3">
            <input type="text" class="validateTextName" id="form_name<?php echo esc_attr( $i ); ?>" name="wpfws_form_name[<?php echo esc_attr( $i ); ?>]" maxlength="64" placeholder="半角英数アンダースコアのみ" value="<?php echo "field".esc_attr(($i+1)) ; ?>" onkeyup="validate_form_name(<?php echo esc_js( $i ); ?>,event);" onfocusin="update_field_name_select_mail(this.id,this.value);">
            <p class="emsg hidden" id="form_name_emsg<?php echo esc_attr( $i ); ?>"></p>
        </td>
        <td>
            <div class="dropdown">
            <img class="dropbtn" src="<?php echo esc_url(WPFWS_SPIRAL_PLUGIN_DIR_URL); ?>img/threedot.png" width="15px" onclick="menuDropdown(event, <?php echo esc_attr($i);?>);" >
            <div id="field_setting_menu<?php echo esc_attr($i);?>" class="dropdown-content" style="width: 120px;">
            <a href="#" id="edit_field_menu<?php echo esc_attr($i);?>" onclick="edit_field_setting(<?php echo esc_js($i);?>);return false;" class="dropdown_menu" style=" color: black; border-bottom: none;text-align: center; display: none;">詳細設定</a>
            <div _ngcontent-c24="" class="divider dropdown-divider"></div>
            <a href="#"onclick="delete_field(<?php echo esc_attr($i); ?>);return false;" class="dropdown-item text-danger spg-cursor-pointer" style="text-align: center;">削除</a>
            </div>
            </div>
            <input name="wpfws_form_placeholder[<?php echo esc_attr($i); ?>]" id="wpfws_form_placeholder<?php echo esc_attr($i); ?>" type="hidden" value="">
            <input name="wpfws_form_pretext[<?php echo esc_attr($i); ?>]" id="wpfws_form_pretext<?php echo esc_attr($i); ?>" type="hidden" value="">
            <input name="wpfws_form_aftertext[<?php echo esc_attr($i); ?>]" id="wpfws_form_aftertext<?php echo esc_attr($i); ?>" type="hidden" value="">
            <textarea name="wpfws_form_options[<?php echo esc_attr($i); ?>]" id="wpfws_form_options<?php echo esc_attr($i); ?>" style="display: none;"></textarea>
            <input name="wpfws_start_year[<?php echo esc_attr( $i ); ?>]" id="wpfws_start_year<?php echo esc_attr( $i ); ?>" type="hidden" value="1918">
            <input name="wpfws_end_year[<?php echo esc_attr( $i ); ?>]" id="wpfws_end_year<?php echo esc_attr( $i ); ?>" type="hidden" value="2028">
            <input name="wpfws_year_order[<?php echo esc_attr( $i ); ?>]" id="wpfws_year_order<?php echo esc_attr( $i ); ?>" type="hidden" value="false">
            <input name="wpfws_date_format[<?php echo esc_attr( $i ); ?>]" id="wpfws_date_format<?php echo esc_attr( $i ); ?>" type="hidden" value="YYYY-MM-DD">
            <input name="wpfws_date_dr_year[<?php echo esc_attr( $i ); ?>]" id="wpfws_date_dr_year<?php echo esc_attr( $i ); ?>" type="hidden" value="年"/>
            <input name="wpfws_date_dr_month[<?php echo esc_attr( $i ); ?>]" id="wpfws_date_dr_month<?php echo esc_attr( $i ); ?>" type="hidden" value="月">
            <input name="wpfws_date_dr_day[<?php echo esc_attr( $i ); ?>]" id="wpfws_date_dr_day<?php echo esc_attr( $i ); ?>" type="hidden" value="日">
        </td>
    </tr>
<?php }} ?>
</tbody>
<tfoot>
    <tr>
        <th colspan="3"><b>プルダウン未選択表示</b><span class="requiresign">*</span> </th>
        <td colspan="10">
            <input type="text" name="wpfws_dropdown_text[<?php echo esc_attr( $fkey ); ?>]" value="<?php if(isset($wpfws_dropdown_text[$fkey])){echo esc_attr( $wpfws_dropdown_text[$fkey] );}
                              else{echo "選択してください";}?>" id="pulldowntext" class="intro" style="margin-left: 0px;" maxlength="20" onkeyup="check_text_pulldown()">
            <p class="emsg hidden" id="pulldowntext_emsg"></p>
        </td>
    </tr>
    <tr>
        <td style="border:none;" colspan="3"><b>必須表示</b> <span class="requiresign">*</span> </td>
        <td colspan="10" style="border:none;">
            <input type="text" name="wpfws_required_text[<?php echo esc_attr( $fkey ); ?>]" value="<?php if(isset($wpfws_required_text[$fkey])){echo esc_attr( $wpfws_required_text[$fkey] );}
                              else{echo "必須";}?>" id="requiredtext" class="intro" style="margin-left: 0px;" maxlength="20" onkeyup="check_text_required()">
            <p class="emsg hidden" id="requiredtext_emsg"></p>
        </td>
    </tr>
    <tr>
        <th colspan="3"><b>フッターフリーテキスト</b></th>
        <td colspan="10">
        <?php
            if(isset($wpfws_free_text_footer[$fkey])){$content= "$wpfws_free_text_footer[$fkey]";}
            else{$content = "";}
            $settings = array('editor_height' => 100, 'textarea_name' => 'wpfws_free_text_footer['.$fkey.']');
            $editor_id = 'editorfooter';
            wp_editor (html_entity_decode( $content ), $editor_id, $settings);
        ?>
        </td>
    </tr>
    <tr>
        <th colspan="2" rowspan="3"><b>ボタン表示</b><span class="requiresign">*</span> </th>
        <th>確認</th>
        <td colspan="10">
            <input type="text" name="wpfws_confirm_text[<?php echo esc_attr( $fkey ); ?>]" value="<?php if(isset($wpfws_confirm_text[$fkey])){echo esc_attr( $wpfws_confirm_text[$fkey] );}else{echo"確認";}?>" id="confirmtext" class="buttontext" style="margin-left: 0px;" maxlength="30" onkeyup="check_text_confirm()">
            <p class="emsg hidden" id="confirmtext_emsg"></p>
        </td>
    </tr>
    <tr>
        <th style="border:none;">送信</th>
        <td colspan="10" style="border:none;">
            <input type="text" name="wpfws_send_text[<?php echo esc_attr( $fkey ); ?>]" value="<?php if(isset($wpfws_send_text[$fkey])){echo esc_attr( $wpfws_send_text[$fkey] );}else{echo"送信";}?>" id="sendtext" class="buttontext" style="margin-left: 0px;" maxlength="30" onkeyup="check_text_send()">
            <p class="emsg hidden" id="sendtext_emsg"></p>
        </td>
    </tr>
    <tr>
        <th style="border:none;">戻る</th>
        <td colspan="10" style="border:none;">
            <input type="text" name="wpfws_cancel_text[<?php echo esc_attr( $fkey ); ?>]" value="<?php if(isset($wpfws_cancel_text[$fkey])){echo esc_attr( $wpfws_cancel_text[$fkey] );}else{echo"戻る";}?>" id="backtext" class="buttontext" style="margin-left: 0px;" maxlength="30" onkeyup="check_text_back()">
            <p class="emsg hidden" id="backtext_emsg"></p>
        </td>
    </tr>
<tr>
    <th colspan="3" rowspan="2" ><b>サンキューページ</b><span class="requiresign">*</span></th>
    <td colspan="10">
        <label >
            <input type="radio" name="radiocheck" id="textCheck" value="TEXT" style="margin-left: 0px;"<?php if(!empty($wpfws_thanks_text[$fkey]) || !is_array($wpfws_thanks_text)){echo 'checked';} ?>/>&nbsp;&nbsp;テキスト </label>
        <label>
            <input type="radio" name="radiocheck" id="urlCheck" value="URL" <?php if(!empty($wpfws_thanks_url[$fkey])){echo 'checked';} ?>/>&nbsp;&nbsp;URL </label></td><br>
                
    <tr>
        <td colspan="10" style="border: none;">
            <div id="textfield">
                <input type='text' id="thanktext" name="wpfws_thanks_text[<?php echo esc_attr( $fkey ); ?>]" value="<?php if(!is_array($wpfws_thanks_text)){echo "登録ありがとうございました";}else echo esc_attr( $wpfws_thanks_text[$fkey] ); ?>" class="intro" style="margin-left: 0px;" onchange="required_text(this);"onkeyup="validate_thanks_url_text_input(<?php echo $key;?>)"><br>
                <p class="emsg hidden" id="thanktext_emsg"></p>
                <span>サンキューページに表示したいテキストを入力してください。</span>
            </div>
            <div id="urlfield" style="display:none">
                <input type="text" id="thankurl" name="wpfws_thanks_url[<?php echo esc_attr( $fkey ); ?>]" value="<?php echo esc_attr( $wpfws_thanks_url[$fkey] );?>" style="margin-left: 0px;"  class="intro" onkeyup="validate_thanks_url_text_input(<?php echo $key;?>)" onchange="required_url(this);"><br>
                <p class="emsg hidden" id="thankurl_emsg"></p>
                <span style="padding-left: 7px;">登録完了時、外部ページへリダイレクトさせたい場合、外部ページのURLを入力してください</span>
            </div>
        </td>
    </tr>
</tr>
        <input type="hidden" name="display" value="<?php if(isset($_GET['display'])){echo sanitize_text_field( wp_unslash( $_GET['display'] ) );} ?>"> 
        <input type="hidden" name="hidden_field_id"> 
</tfoot>
</table>
<br>
<!--Mail Form!-->
<div style="border-left: 4px solid #00a0d2; padding: 5px 5px 4px 5px;">
<b style="font-size: 1.4em;">サンキューメール</b>&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 1.4em;"><span id="thankmail_notuse"></span></b><label id="thankmail_label" for="wpfws_thankmail_active" style="font-size: 1.4em; font-weight: bold;vertical-align: text-bottom;"><input type="checkbox" id="wpfws_thankmail_active" name="wpfws_thankmail_active[<?php echo esc_attr( $fkey ); ?>]" value="1" onclick="is_wpfws_thankmail_use();" <?php if($wpfws_thankmail_active[$fkey]=="1" ){echo 'checked';} ?>/>使用する</label>&nbsp;&nbsp;<span class="mail_use_note" style="vertical-align: text-bottom;">※すべての表示切替に適用されます。</span>
</div>
<div id="thankmail_use_setting" style="display: none; margin-top: 5px">
<label id="thankmail_all" style="padding-right: 30px;">
    <input type="radio" id="use_all_thankmail" name="wpfws_used_thankmail" value="1" <?php if($wpfws_thankmail_setting != "0" ){echo 'checked';}?> >すべての表示切替で共通コンテンツを使用
</label>
<label>
     <input type="radio" id="use_one_thankmail" name="wpfws_used_thankmail" value="0" <?php if($wpfws_thankmail_setting == "0" ){echo 'checked';} ?>>表示切替ごとに異なるコンテンツを使用
</label>
<p id="decs_thankmail_msg" style="margin-top: 2px; margin-bottom: 5px; padding-left: 20px;"></p>
</div>
<fieldset id="thankmail">
<table class="wp-list-table widefat pages" id="wpfws_thankmail_use" style="display: none; width: 100%">
    <div id="thankmail_msg" class="thankmail_msg" style="display: none;margin-bottom: 0px;">
    <p>・フォームにメールアドレス形式の項目が存在しない場合、サンキューメールを設定することはできません。<br>・差出人アドレスには受信可能なメールアドレスを設定してください。<br>
・メール受信側で迷惑メール判定されない為に、送信元となるWordPressインストールサーバーのIPアドレスを差出人アドレスドメインのDNSサーバのSPFレコードに登録してください。設定方法はDNSサーバ管理者にお問い合わせください。<br>・メールの返信先アドレスは差出人アドレスになります。</p>
</div>
<div class="thankmail_content" style="display: none;">
<p style="font-size: 14px;margin-bottom: 6px;margin-top: 6px;"><b>コンテンツ: <span id="displayname_thankmail"><?php echo esc_html($wpfws_display_array[$fkey]); ?></span></b><span style="display: none;font-size: 13px;margin-left: 10px;" id="noted_form_name_thankmail"></span></p>
</div>
    <tr class="border_bottom">
    <th scope="row" style="width: 24%;">
        <label for="wpfws_thankmail_recipient"><b>送信先アドレス</b><span class="requiresign">*</span></label>
    </th>
    <td>
        <select id="wpfws_thankmail_recipient" name="wpfws_thankmail_recipient[<?php echo esc_attr( $fkey ); ?>]" class="form-control" style="width: 582px;">
            <option disabled selected value="disabled">メールアドレスフィールドを選択してください</option>
            <?php
            if( !empty($wpfws_type_array) ) {
                //Default Key index
                $Dkey = 0;

                for($key=$start ; $key<$end ; $key++){
                    if($wpfws_type_array[$key] == 'email'){
                        if ( $wpfws_thankmail_active[$fkey] == 1 && $wpfws_thankmail_setting == 1 ) {
                            $selected = ($wpfws_name_array[$key] == $wpfws_thankmail_recipient[0]) ? 'selected="selected"' : "";
                            $field_label = $wpfws_label_array[$Dkey];
                            $field_name = $wpfws_name_array[$Dkey];
                        } else {
                            $selected = ($wpfws_name_array[$key] == $wpfws_thankmail_recipient[$fkey]) ? 'selected="selected"' : "";
                            $field_label = $wpfws_label_array[$key];
                            $field_name = $wpfws_name_array[$key];
                        }

                    echo '<option value="'. esc_attr($wpfws_name_array[$key]) .'" data-row="'. $key .'" ' . $selected . '>'. esc_attr($field_label) .'('. esc_attr($field_name) .')</option>';
                    }
                    $Dkey++;
                }
            }
            ?>
        </select>
        <p style="margin-bottom: 2px;">※フォームフィールドの使用するにチェックし、ユーザーが値を入力した際に送信されます。</p>
        <p class="emsg hidden" id="wpfws_thankmail_recipient_emsg"></p>
    </td>
    </tr>
    <tr>
    <th scope="row">
        <label for="wpfws_thankmail_recipient_name"><b>差出人名</b></label>
    </th>
    <td>
        <input type="text" id="wpfws_thankmail_recipient_name" name="wpfws_thankmail_recipient_name[<?php echo esc_attr( $fkey ); ?>]" class="large-text code" size="70" value="<?php echo esc_attr($wpfws_thankmail_recipient_name[$fkey]); ?>" onkeyup="validate_thankmail_recipient_name(event);" maxlength="64"style="width: auto;"/>
        <p class="emsg hidden" id="wpfws_thankmail_recipient_name_emsg"></p>
    </td>
    </tr>
    <tr class="border_bottom">
    <th scope="row">
        <label for="wpfws_thankmail_sender"><b>差出人アドレス</b><span class="requiresign">*</span></label>
    </th>
    <td>
        <input type="text" id="wpfws_thankmail_sender" name="wpfws_thankmail_sender[<?php echo esc_attr( $fkey ); ?>]" class="large-text code" size="70" value="<?php echo esc_attr($wpfws_thankmail_sender[$fkey]); ?>" onkeyup="validate_thankmail_sender_format(event);" maxlength="76" style="width: auto;"/>
    <p class="emsg hidden" id="wpfws_thankmail_sender_emsg"></p>
    </td>
    </tr>

    <tr>
    <th scope="row">
        <label for="wpfws_thankmail_subject"><b>件名</b><span class="requiresign">*</span></label>
    </th>
    <td>
        <input type="text" id="wpfws_thankmail_subject" name="wpfws_thankmail_subject[<?php echo esc_attr( $fkey ); ?>]" class="large-text code" size="70" value="<?php echo esc_attr($wpfws_thankmail_subject[$fkey]); ?>" maxlength="128"style="width: auto;"/>
    <p class="emsg hidden" id="wpfws_thankmail_subject_emsg"></p>
    </td>
    </tr>

    <tr>
    <th scope="row">
        <label for="wpfws_thankmail_body"><b>本文</b><span class="requiresign">*</span></label>
    </th>
    <td>
        <textarea id="wpfws_thankmail_body" name="wpfws_thankmail_body[<?php echo esc_attr( $fkey ); ?>]" cols="100" rows="8" class="large-text code" value="" maxlength="4000" style="width: 582px;"><?php echo esc_html($wpfws_thankmail_body[$fkey]); ?></textarea>
    <p class="emsg hidden" id="wpfws_thankmail_body_emsg"></p>
    </td>
    </tr>

</table>
</fieldset>
<br><div class="contact-form-editor-box-mail" id="wpfws-notimail">
<div style="border-left: 4px solid #00a0d2;padding: 5px 5px 4px 5px;">
<b style="font-size: 1.4em;">通知メール</b>&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size: 1.4em;"><span id="notimail_notuse"></span></b><label id="notimail_label" for="wpfws_notimail_active" style="font-size: 1.4em; font-weight: bold;vertical-align: text-bottom;"><input type="checkbox" id="wpfws_notimail_active" name="wpfws_notimail_active[<?php echo esc_attr( $fkey ); ?>]" value="1" onclick="is_wpfws_notimail_use();" <?php if($wpfws_notimail_active[$fkey]=="1" ){echo 'checked';} ?>/>使用する</label>&nbsp;&nbsp;<span class="mail_use_note" style=" vertical-align: text-bottom;">※すべての表示切替に適用されます。</span>
</div>

<div id="notimail_use_setting" style="display: none;margin-top: 5px">
<label style="padding-right: 30px;">
    <input type="radio" id="use_all_notimail" name="wpfws_used_notimail" value="1" <?php if($wpfws_notimail_setting != "0" ){echo 'checked';}?> >すべての表示切替で共通コンテンツを使用
</label>
<label>
     <input type="radio" id="use_one_notimail" name="wpfws_used_notimail" value="0" <?php if($wpfws_notimail_setting == "0" ){echo 'checked';} ?>>表示切替ごとに異なるコンテンツを使用
</label>
<p id="decs_notimail_msg" style="margin-top: 2px; margin-bottom: 5px; padding-left: 20px;"></p>
</div>
<fieldset id="notimail">
<table class="wp-list-table widefat pages" id="wpfws_notimail_use" style="display: none;">
    <div id="notimail_msg" class="notimail_msg" style="display: none;">
        <p>・差出人アドレスには受信可能なメールアドレスを設定してください。<br>・メール受信側で迷惑メール判定されない為に、送信元となるWordPressインストールサーバーのIPアドレスを差出人アドレスドメインのDNSサーバのSPFレコードに登録してください。設定方法はDNSサーバ管理者にお問い合わせください。</p>
    </div>
<div class="notimail_content" style="display: none;">
<p style="font-size: 14px;margin-bottom: 6px;margin-top: 6px;"><b>コンテンツ: <span id="displayname_notimail"></span></b><span id="noted_form_name_notimail" style="display: none;font-size: 13px;margin-left: 10px;"></span></p>
</div>
<tbody>
    <tr class="border_bottom">
    <th scope="row" style="width: 24%;">
        <label for="wpfws_notimail_recipient"><b>通知先アドレス</b><span class="requiresign">*</span></label>
    </th>
    <td>
        <input type="text" id="wpfws_notimail_recipient" name="wpfws_notimail_recipient[<?php echo esc_attr( $fkey ); ?>]" class="large-text code" size="70" value="<?php echo esc_attr($wpfws_notimail_recipient[$fkey]); ?>" onkeyup="validate_notimail_recipient_format(event);" maxlength="76" style="width: auto;" />
    <p class="emsg hidden" id="wpfws_notimail_recipient_emsg"></p>
    </td>
    </tr>
    <tr>
    <th scope="row">
        <label for="wpfws_notimail_recipient_name"><b>差出人名</b></label>
    </th>
    <td>
        <input type="text" id="wpfws_notimail_recipient_name" name="wpfws_notimail_recipient_name[<?php echo esc_attr( $fkey ); ?>]" class="large-text code" size="70" value="<?php echo esc_attr($wpfws_notimail_recipient_name[$fkey]); ?>" onkeyup="validate_notimail_recipient_name(event);" maxlength="64" style="width: auto;"/>
        <p class="emsg hidden" id="wpfws_notimail_recipient_name_emsg"></p>
    </td>
    </tr>

    <tr class="border_bottom">
    <th scope="row">
        <label for="wpfws_notimail_sender"><b>差出人アドレス</b><span class="requiresign">*</span></label>
    </th>
    <td>
        <input type="text" id="wpfws_notimail_sender" name="wpfws_notimail_sender[<?php echo esc_attr( $fkey ); ?>]" class="large-text code" size="70" value="<?php echo esc_attr($wpfws_notimail_sender[$fkey]); ?>" onkeyup="validate_notimail_sender_format(event);"maxlength="76" style="width: auto;"/>
    <p class="emsg hidden" id="wpfws_notimail_sender_emsg"></p>
    </td>
    </tr>

    <tr>
    <th scope="row">
        <label for="wpfws_notimail_subject"><b>件名</b><span class="requiresign">*</span></label>
    </th>
    <td>
        <input type="text" id="wpfws_notimail_subject" name="wpfws_notimail_subject[<?php echo esc_attr( $fkey ); ?>]" class="large-text code" size="70" value="<?php echo esc_attr($wpfws_notimail_subject[$fkey]); ?>" maxlength="128" style="width: auto;"/>
    <p class="emsg hidden" id="wpfws_notimail_subject_emsg"></p>
    </td>
    </tr>

    <tr>
    <th scope="row">
        <label for="wpfws_notimail_body"><b>本文</b><span class="requiresign">*</span></label>
    </th>
    <td>
        <textarea id="wpfws_notimail_body" name="wpfws_notimail_body[<?php echo esc_attr( $fkey ); ?>]" cols="100" rows="8" class="large-text code" value="" maxlength="4000" style="width: 582px;"><?php echo esc_html($wpfws_notimail_body[$fkey]); ?></textarea>
    <p class="emsg hidden" id="wpfws_notimail_body_emsg"></p>
    </td>
    </tr>
    </tbody>
    </table>
</fieldset>
<!--End Mail Form!-->
        </div>
        <!-- Save form and prview form!-->
        <div>
            <input type="submit" id="save_form" name="save_form" class="button-primary" value="新規登録" style="margin-top: 1%;">
            <input type="button" id="preview_form" class="preview button" onclick="wpfws_preview_form(true);" style="margin-top: 1%; float: none;" value="プレビュー" /><span class="spinner" style="float: none;"></span>
        </div>
    </form>
    </div>
<!-- page Check if user go to other page without saving !-->
<script type="text/javascript">
var unsaved = false;
// Triger change input type
jQuery(":input").change(function(){
    unsaved = true;
});
// triger add new field
jQuery("#add_new_field").click(function(){
    unsaved = true;
});
//triger check thank mail or notification mail
jQuery('label[for="wpfws_notimail_active,wpfws_thankmail_active"]').click(function(){
    unsaved = true;
});
// avoid from click select display    
jQuery('#select_display,#confirm_delete_display_checkbox').change(function(){
        unsaved = false;
    });
// avoid from click save form confirm add diplay and edit display
jQuery('#save_form,#confirm_add,#save_display_edit').click(function(){
        unsaved = false;
    });
jQuery(window).bind('beforeunload', function(e){
    if(unsaved)return true;
    else e=null; // i.e; if form state change show warning box, else don't show it.
});

</script>
<!-- Popup warning message for displayname !-->
<script type="text/javascript">
jQuery(".dashicons-info").click(function(){
    jQuery(".cover").fadeIn();
    jQuery("#display_warn").fadeIn();
    return false;
    });
</script>
<!-- Check if display maximum 20 !-->
<script type="text/javascript">
var count_display = "<?php  if($wpfws_display_array){echo count($wpfws_display_array);}else{echo null ;} ?>";

if(count_display >= 20 ){
    jQuery('#add').attr("disabled","disabled");
}
</script>
<!-- Popup modal function !-->
<script type="text/javascript">
jQuery("#edit").click(function(){
    var current_display = "<?php echo $wpfws_display_array[$fkey]; ?>";
    jQuery("#wpfws_display_edit").val(current_display);
    jQuery(".cover").fadeIn();
    jQuery("#popup_edit").fadeIn();
    jQuery("#thanktext,#thankurl,#wpfws_title,.FieldDisplayName,.validateTextName,.intro,.buttontext,#wpfws_thankmail_recipient,#wpfws_thankmail_sender,#wpfws_thankmail_subject,#wpfws_thankmail_body,#wpfws_notimail_recipient,#wpfws_notimail_sender,#wpfws_notimail_subject,#wpfws_notimail_body").removeAttr("required");
    return false;
});

jQuery("#add").click(function(){
  var display_title = jQuery("#wpfws_display").val();
  jQuery(".cover").fadeIn();
  jQuery("#popup_add").fadeIn();
  if(display_title == ''){
    jQuery("#wpfws_display").addClass("invalid");
  }else{
    jQuery("#wpfws_display").removeClass("invalid");
  }
  jQuery("#thanktext,#thankurl,#wpfws_title,.FieldDisplayName,.validateTextName,.intro,.buttontext,#wpfws_thankmail_recipient,#wpfws_thankmail_sender,#wpfws_thankmail_subject,#wpfws_thankmail_body,#wpfws_notimail_recipient,#wpfws_notimail_sender,#wpfws_notimail_subject,#wpfws_notimail_body").removeAttr("required");
  return false;
});

jQuery("#delete").click(function(){
    jQuery(".cover").fadeIn();
    jQuery("#popup_edit").fadeOut();
    jQuery("#popup_confirm_delete").fadeIn();
    jQuery("#deletedisplay").attr("disabled","disabled");

  return false;
});

/// Checkbox confirm if the checkboc confirm checked remove disabled button but if the checkbox is unchecked add disable button
var checkbox_del_display = document.getElementById('confirm_delete_display_checkbox');
checkbox_del_display.onchange = function() {
    if(this.checked){
        jQuery("#deletedisplay").attr("disabled",false);
    }else{
       jQuery("#deletedisplay").attr("disabled","disabled");
    }
    };

jQuery(".close").click(function(){
    jQuery(".cover").fadeOut();
    jQuery("#wpfws_display_edit").removeClass("invalid");
    jQuery("#wpfws_form_options").removeClass("invalid");
    jQuery("#wpfws_display").removeClass("invalid");
    jQuery("#wpfws_start_year").removeClass("invalid");
    jQuery("#wpfws_end_year").removeClass("invalid");
    jQuery("#wpfws_date_dr_year").removeClass("invalid");
    jQuery("#wpfws_date_dr_month").removeClass("invalid");
    jQuery("#wpfws_date_dr_day").removeClass("invalid");
    jQuery(".dropdown-content").removeClass("show");
    jQuery("#wpfws_display").val("");
    jQuery(".dropdown-content").removeClass("show");
    jQuery(".popup").fadeOut();
    jQuery("#confirm_delete_checkbox,#confirm_delete_display_checkbox").attr('checked',false);
    jQuery("#confirm_change_thankmail_radio").attr('checked',false);
    jQuery("#delfield_btn").attr('disabled',true);
    jQuery('#error_del_field').css("display","none");
    jQuery("#thanktext,#thankurl,#wpfws_title,.FieldDisplayName,.validateTextName,.intro,.buttontext,#wpfws_thankmail_recipient,#wpfws_thankmail_sender,#wpfws_thankmail_subject,#wpfws_thankmail_body,#wpfws_notimail_recipient,#wpfws_notimail_sender,#wpfws_notimail_subject,#wpfws_notimail_body").attr("required",true);
    return false;
});

jQuery(".cancel").click(function(){
    jQuery(".cover").fadeOut();
    jQuery("#wpfws_display_edit").removeClass("invalid");
    jQuery("#wpfws_form_options").removeClass("invalid");
    jQuery("#wpfws_start_year").removeClass("invalid");
    jQuery("#wpfws_end_year").removeClass("invalid");
    jQuery("#wpfws_date_dr_year").removeClass("invalid");
    jQuery("#wpfws_date_dr_month").removeClass("invalid");
    jQuery("#wpfws_date_dr_day").removeClass("invalid");
    jQuery(".dropdown-content").removeClass("show");
    jQuery(".popup").fadeOut();
    jQuery("#confirm_delete_checkbox,#confirm_delete_display_checkbox").attr('checked',false);
    jQuery("#confirm_change_thankmail_radio").attr('checked',false);
    jQuery("#delfield_btn").attr('disabled',true);
    jQuery('#error_del_field').css("display","none");
    jQuery("#thanktext,#thankurl,#wpfws_title,.FieldDisplayName,.validateTextName,.intro,.buttontext,#wpfws_thankmail_recipient,#wpfws_thankmail_sender,#wpfws_thankmail_subject,#wpfws_thankmail_body,#wpfws_notimail_recipient,#wpfws_notimail_sender,#wpfws_notimail_subject,#wpfws_notimail_body").attr("required",true);
    return false;
});
</script>
<!-- End Popup modal function !-->

<!-- Display DB name if existed if not show default !-->
<script type="text/javascript">
jQuery("#wpfws_title").attr("required",true);
jQuery(".read,.buttontext,.validateTextName").attr("required",true);
jQuery("#thankurl,#thanktext,#pulldowntext,#requiredtext").attr("required",true);
var db_title = "<?php echo esc_js( $wpfws_db_name ); ?>";
var display = "<?php echo esc_js( $wpfws_display_array[0] ); ?>";
        if(display == "" ){
            jQuery("#add").attr("disabled","disabled");
            jQuery("#edit").attr("disabled","disabled");
            jQuery("#shortcode").css("display","none");
            jQuery("#form_setting_head").html("フォーム新規作成");
            jQuery('#save_form').attr('value','新規作成');
            jQuery('#app_id_db_id').css("display","none");
        }else{
            jQuery("#msgdisplaybtn").css("display","none");
            jQuery("#form_setting_head").html("フォーム設定変更");
            jQuery('#save_form').attr('value','設定変更');
        }
if(display !='' && jQuery('#show_db_name').hasClass("not_create_DB")){
        jQuery('#popup_create_DB_error').fadeIn();
        jQuery('.cover').fadeIn();
}
</script>
<!-- End Display DB name if existed if not show default !-->

<!-- Script add new field when click button add newfield !-->
<script type="text/javascript">
var rowId = <?php if(isset($key)) echo ($key-1); else echo "2" ?>;
//Check Is it form already create?
var db_id = <?php if(!empty($wpfws_db_id)){echo '1';}else{echo '0';} ?>;
var post = <?php if(isset($_GET['post'])){echo '1';}else{echo '0';} ?>;
function create_wpfws_form_item(){
    rowId++;

    var field_name = 'field'+(rowId+1);

    var element =
        '<tr class="form_element_row" id="rowid'+rowId+'">' +
        '<input type="hidden" id="wpfws_fields_id'+rowId+'" name="wpfws_fields_id[]" value="new">'+
        '<th>'+
        '<div class="handle" style="width: 10%;padding: 7px; cursor: move;"><span class="dashicons dashicons-menu"></span></div>'+
        '</th>'+
        '<td>'+
        '<label>' +
        '<input type="checkbox" name="used'+rowId+'" id="used'+rowId+'"   onchange="set_wpfws_used_hidden(this);set_used_and_required_field('+rowId+');" checked >'+
        '</label>' +
        '   <input type="hidden" name="wpfws_field_used['+ rowId +']" id="used_hidden'+rowId+'" value="1">' +
        '</td>'+
        '<td>' +
        '<label>' +
        '<input type="checkbox" id="required_'+rowId+'" onchange="set_wpfws_required_hidden(this);set_used_and_required_field('+rowId+');">' +
        '</label>' +
        '   <input type="hidden" id="required_hidden'+rowId+'" name="wpfws_form_required['+ rowId +']" value="">' +
        '</td>' +
        '<td colspan="2">' +
        '<select class="select" id="select'+rowId+'" name="wpfws_form_type['+ rowId +']" onchange="change_field_type('+rowId+');getval(this);">' +
        '<option value="text">テキスト</option>' +
        '<option value="textarea">テキストエリア</option>' +
        '<option value="email">メールアドレス</option>' +
        '<option value="radio">ラジオボタン</option>' +
        '<option value="select">プルダウン</option>' +
        '<option value="checkbox">チェックボックス</option>' +
        '<option value="date_dropdown" id="date_dropdown">日付 プルダウン</option>' +
        '<option value="date">日付 カレンダー</option>'+
        '</select>' +
        '</td>' +
        '<td colspan="4">' +
        '<input type="text" class="FieldDisplayName read" id="form_label'+ rowId +'" name="wpfws_form_label['+ rowId +']" maxlength="64" onkeyup="validate_form_label('+rowId+',event);" onfocusin="update_field_label_select_mail(this.id,this.value);" required>' +
        '<p class="emsg hidden" id="form_label_emsg'+ rowId +'"></p>'+
        '</td>' +
        '<td class="validate_name" colspan="3">' +
        '<input type="text" class="validateTextName" id="form_name'+ rowId +'" name="wpfws_form_name['+ rowId +']" maxlength="64" placeholder="半角英数アンダースコアのみ" value="'+ field_name +'" onkeyup="validate_form_name('+rowId+',event);" onfocusin="update_field_name_select_mail(this.id,this.value);" required>' +
        '<input type="hidden" name="wpfws_form_name_disable[]" value="new">'+
        '<p class="emsg hidden" id="form_name_emsg'+ rowId +'"></p>'+
        '</td>' +
        '<td>' +
        '<div class="dropdown">'+
        '<img class="dropbtn"  src="<?php echo esc_url(WPFWS_SPIRAL_PLUGIN_DIR_URL); ?>img/threedot.png" width="15px" onclick="menuDropdown(event, '+rowId+');">'+
        '<div id="field_setting_menu'+rowId+'" class="dropdown-content" style="width: 120px;">'+
        '<a href="#"onclick="edit_field_setting('+rowId+');return false;" id="edit_field_menu'+rowId+'" class="dropdown_menu" style=" color: black; border-bottom: none;text-align: center; display: none;">詳細設定</a>'+
        '<a href="#"onclick="delete_field('+rowId+');return false;" class="dropdown-item text-danger spg-cursor-pointer" style="text-align: center;">削除</a>'+
        '</div>'+
        '</div>'+
        '<input name="wpfws_form_placeholder['+ rowId +']" id="wpfws_form_placeholder'+ rowId +'" type="hidden" value="">'+
        '<input name="wpfws_form_pretext['+ rowId +']" id="wpfws_form_pretext'+ rowId +'" type="hidden" value="">'+
        '<input name="wpfws_form_aftertext['+ rowId +']" id="wpfws_form_aftertext'+ rowId +'" type="hidden" value="">'+
        '<textarea name="wpfws_form_options['+ rowId +']" id="wpfws_form_options'+ rowId +'" style="display:none;"></textarea>'+
        '<input name="wpfws_start_year['+ rowId +']" id="wpfws_start_year'+ rowId +'" type="hidden" value="1918">'+
        '<input name="wpfws_end_year['+ rowId +']" id="wpfws_end_year'+ rowId +'" type="hidden" value="2028">'+
        '<input name="wpfws_year_order['+ rowId +']" id="wpfws_year_order'+ rowId +'" type="hidden" value="false">'+
        '<input name="wpfws_date_format['+ rowId +']" id="wpfws_date_format'+ rowId +'" type="hidden" value="YYYY-MM-DD">'+
        '<input name="wpfws_date_dr_year['+ rowId +']" id="wpfws_date_dr_year'+ rowId +'" type="hidden" value="年"/>'+
        '<input name="wpfws_date_dr_month['+ rowId +']" id="wpfws_date_dr_month'+ rowId +'" type="hidden" value="月">'+
        '<input name="wpfws_date_dr_day['+ rowId +']" id="wpfws_date_dr_day'+ rowId +'" type="hidden" value="日">'+
        '</td>' +
        '</tr>';
        jQuery('#form_elements').append(element);
    // Check when the number of field is reached 30 user cannot click on add new field anymore
    var rowCount = jQuery('#tablecontent tbody tr').length;
    if(rowCount>=30){
        jQuery("#add_new_field").attr("disabled","disabled");
    }
}

//Check if the number of fields reach 30 every refresh page
jQuery(document).ready(function(){
    var rowCount = jQuery('#tablecontent tbody tr').length;
    if(rowCount>=30){
        jQuery("#add_new_field").attr("disabled","disabled");
    }
});
//End Script add new field when click button add newfield

// Add New display validation
jQuery("#confirm_add").click(function(event){
    stopAllTimeouts();
    var display_name = <?php if(!empty($wpfws_display_array)) {echo '["' . implode('","',  $wpfws_display_array  ) . '"]';}else echo 'null'; ?>;
    var display_input = jQuery('#wpfws_display').val();
    jQuery('#add_display_emsg').addClass('hidden');
    jQuery.each(display_name , function(index,display){
        if (display_input == ''){
            jQuery("#wpfws_display").addClass("invalid");
            document.getElementById("add_display_emsg").innerHTML = "入力必須です";
            jQuery('#wpfws_display').focus();
            setTimeout(function(){jQuery('#add_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#add_display_emsg').addClass('hidden');}, 5000);
            event.preventDefault();
        }else if(jQuery("#wpfws_display").val().match(/["\s'#+\\&<>]/)){
            jQuery("#wpfws_display").addClass("invalid");
            document.getElementById("add_display_emsg").innerHTML = "「' " + '"' +" & \\ + # < > スペース」を使用することはできません";
            jQuery('#wpfws_display').focus();
            setTimeout(function(){jQuery('#add_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#add_display_emsg').addClass('hidden');}, 5000);
            event.preventDefault();
        }else if(display == display_input){
            jQuery("#wpfws_display").addClass("invalid");
            document.getElementById("add_display_emsg").innerHTML = "既に使用済みの名称です";
            jQuery('#wpfws_display').focus();
            setTimeout(function(){jQuery('#add_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#add_display_emsg').addClass('hidden');}, 5000);
            event.preventDefault();
            return false;
        }else{
            jQuery("#wpfws_display").removeClass("invalid");
        }
    });
});

//Edit display Validation
jQuery( "#save_display_edit" ).click(function(event){
    stopAllTimeouts();
    var display_name = <?php if(!empty($wpfws_display_array)) {echo '["' . implode('","', $wpfws_display_array ) . '"]';}else echo 'null'; ?>;
    var display_input = jQuery('#wpfws_display_edit').val();
    jQuery('#edit_display_emsg').addClass('hidden');

    //FadeOut If the input title same as default
    var default_input_display = document.getElementById("wpfws_display_edit").defaultValue;
    if(display_input == default_input_display){
        jQuery("#popup_edit, .cover").fadeOut();
        return false;
    }

    jQuery.each(display_name , function(index,display){
        if(display_input == ''){
            jQuery("#wpfws_display_edit").addClass("invalid");
            document.getElementById("edit_display_emsg").innerHTML = "入力必須です";
            jQuery('#wpfws_display_edit').focus();
            setTimeout(function(){jQuery('#edit_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#edit_display_emsg').addClass('hidden');}, 5000);
            event.preventDefault();
        }else if(jQuery("#wpfws_display_edit").val().match(/["\s'#+\\&<>]/)){
            jQuery("#wpfws_display_edit").addClass("invalid");
            document.getElementById("edit_display_emsg").innerHTML = "「' " + '"' +" & \\ + # < > スペース」を使用することはできません";
            jQuery('#wpfws_display_edit').focus();
            setTimeout(function(){jQuery('#edit_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#edit_display_emsg').addClass('hidden');}, 5000);
            event.preventDefault();
        }else if(display == display_input){
            jQuery("#wpfws_display_edit").addClass("invalid");
            document.getElementById("edit_display_emsg").innerHTML = "既に使用済みの名称です";
            jQuery('#wpfws_display_edit').focus();
            setTimeout(function(){jQuery('#edit_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#edit_display_emsg').addClass('hidden');}, 5000);
            event.preventDefault();
            return false;
        }else{
            jQuery("#wpfws_display_edit").removeClass("invalid");
        }
    });
});
//Reorder field
jQuery(document).ready(function(){ jQuery(".sortable tbody").sortable({
    handle: '.handle'
});
});
//Change background color when format error
jQuery("#popup_date_dropdown input").keyup(function(){
    var start_year = jQuery('#wpfws_start_year').val();
    var end_year = jQuery('#wpfws_end_year').val();
    var year_text = jQuery('#wpfws_date_dr_year').val();
    var month_text = jQuery('#wpfws_date_dr_month').val();
    var day_text = jQuery('#wpfws_date_dr_day').val();
    var date_format=/["\s'#+\\&]/;
    var yearformat = /^[0-9][0-9]*$/;
    if((start_year.length == 4 && end_year.length == 4 && start_year > end_year) || start_year.length > 4 || start_year < 1600 ){
        jQuery("#wpfws_start_year").addClass("invalid");
    }else if(end_year.length < 4 || end_year.length > 4){
        jQuery("#wpfws_end_year").addClass("invalid");
    }else{
        jQuery("#wpfws_start_year").removeClass("invalid");
        jQuery("#wpfws_end_year").removeClass("invalid");     
    }
    if(year_text.match(date_format)){
        jQuery("#wpfws_date_dr_year").addClass("invalid");
    }else{
        jQuery("#wpfws_date_dr_year").removeClass("invalid");
    }
    if(month_text.match(date_format)){
        jQuery("#wpfws_date_dr_month").addClass("invalid");
    }else{
        jQuery("#wpfws_date_dr_month").removeClass("invalid");
    }
     if(day_text.match(date_format)){
        jQuery("#wpfws_date_dr_day").addClass("invalid");
    }else{
        jQuery("#wpfws_date_dr_day").removeClass("invalid");
    }
});
// Date dropdown setting Validation
function date_dropdown_validation(rowId){
    stopAllTimeouts();
    var start_year = jQuery('#wpfws_start_year').val();
    var end_year = jQuery('#wpfws_end_year').val();
    var year_text = jQuery('#wpfws_date_dr_year').val();
    var month_text = jQuery('#wpfws_date_dr_month').val();
    var day_text = jQuery('#wpfws_date_dr_day').val();
    var date_format=/["\s'#+\\&]/;
    var yearformat = /^[0-9][0-9]*$/;
    jQuery('.emsg_date').addClass('hidden');

    if(start_year == ''){//check required start year
        document.getElementById("start_year_emsg").innerHTML = "入力必須です";
        jQuery('#wpfws_start_year').focus();
        setTimeout(function(){jQuery('#start_year_emsg').removeClass('hidden');}, 200);

    }else if((start_year!="")&&(!start_year.match(yearformat))){//check start year format
        document.getElementById("start_year_emsg").innerHTML = "年は1600から9999までの数字のみ入力可能です";
        jQuery('#wpfws_start_year').focus();
        setTimeout(function(){jQuery('#start_year_emsg').removeClass('hidden');}, 200);
    }else if((end_year!="")&&(!end_year.match(yearformat))){//check end year format
        document.getElementById("end_year_emsg").innerHTML = "年は1600から9999までの数字のみ入力可能です";
        jQuery('#wpfws_end_year').focus();
        setTimeout(function(){jQuery('#end_year_emsg').removeClass('hidden');}, 200);
    }else if(start_year.length == 4 && end_year.length == 4 && start_year > end_year){//check if start_year > end_year
        document.getElementById("start_year_emsg").innerHTML = "開始年は終了年より小さい値を入力してください";
        jQuery('#wpfws_start_year').focus();
        setTimeout(function(){jQuery('#start_year_emsg').removeClass('hidden');}, 200);
    }else if(start_year < 1600){//check if start year < 1600
        document.getElementById("start_year_emsg").innerHTML = "年は1600から9999までの数字のみ入力可能です";
        jQuery('#wpfws_start_year').focus();
        setTimeout(function(){jQuery('#start_year_emsg').removeClass('hidden');}, 200);
    }else if(start_year.length < 4 || start_year.length > 4){//check 4< start_year_digit >4
        document.getElementById("start_year_emsg").innerHTML = "年は1600から9999までの数字のみ入力可能です";
        jQuery('#wpfws_start_year').focus();
        setTimeout(function(){jQuery('#start_year_emsg').removeClass('hidden');}, 200);
    }else if(end_year == ''){//check endyear required
        document.getElementById("end_year_emsg").innerHTML = "入力必須です";
        jQuery('#wpfws_end_year').focus();
        setTimeout(function(){jQuery('#end_year_emsg').removeClass('hidden');}, 200);
    }else if(end_year.length < 4 || end_year.length > 4){//check 4< end_year_digit >4
        document.getElementById("end_year_emsg").innerHTML = "年は1600から9999までの数字のみ入力可能です";
        jQuery('#wpfws_end_year').focus();
        setTimeout(function(){jQuery('#end_year_emsg').removeClass('hidden');}, 200);
    }else if(end_year.length < 4 || end_year.length > 4){//check 4< end_year_digit >4
        document.getElementById("end_year_emsg").innerHTML = "年は1600から9999までの数字のみ入力可能です";
        jQuery('#wpfws_end_year').focus();
        setTimeout(function(){jQuery('#end_year_emsg').removeClass('hidden');}, 200);
    }else if(year_text == ''){//check year text required
        document.getElementById("year_text_emsg").innerHTML = "入力必須です";
        jQuery('#wpfws_date_dr_year').focus();
        setTimeout(function(){jQuery('#year_text_emsg').removeClass('hidden');}, 200);
    }else if(year_text.match(date_format)){//check year text format
        document.getElementById("year_text_emsg").innerHTML = "「' " + '"' +" & \\ + # スペース」を使用することはできません";
        jQuery('#wpfws_date_dr_year').focus();
        setTimeout(function(){jQuery('#year_text_emsg').removeClass('hidden');}, 200);
    }else if(month_text == ''){//check month text required
        document.getElementById("month_text_emsg").innerHTML = "入力必須です";
        jQuery('#wpfws_date_dr_month').focus();
        setTimeout(function(){jQuery('#month_text_emsg').removeClass('hidden');}, 200);
    }else if(month_text.match(date_format)){//check month text format
        document.getElementById("month_text_emsg").innerHTML = "「' " + '"' +" & \\ + # スペース」を使用することはできません";
        jQuery('#wpfws_date_dr_month').focus();
        setTimeout(function(){jQuery('#month_text_emsg').removeClass('hidden');}, 200);
    }else if(day_text == ''){//check day text required
        document.getElementById("day_text_emsg").innerHTML = "入力必須です";
        jQuery('#wpfws_date_dr_day').focus();
        setTimeout(function(){jQuery('#day_text_emsg').removeClass('hidden');}, 200);
    }else if(day_text.match(date_format)){//check day text format
        document.getElementById("day_text_emsg").innerHTML = "「' " + '"' +" & \\ + # スペース」を使用することはできません";
        jQuery('#wpfws_date_dr_day').focus();
        setTimeout(function(){jQuery('#day_text_emsg').removeClass('hidden');}, 200);
    }else{//if not error save date setting
        save_date_dropdown(rowId);
        jQuery(".popup").fadeOut();
        jQuery(".cover").fadeOut();
    }
    setTimeout(function(){jQuery('.emsg_date').addClass('hidden');}, 5000);
}

function validate_form_label(id,e) {
    var input_label = jQuery("#form_label"+id).val();
    var fkey = <?php if (!empty($fkey)) {echo $fkey;} else {echo '0';} ?>;
    //Check 項目名 duplicate
    jQuery("#form_label"+id).attr('value', input_label);
    var is_dup = jQuery('.FieldDisplayName[value="' + repDquote(input_label) + '"]').length;
    if(e.keyCode != 9){
    if (input_label == "" || input_label == "表示切替" || (is_dup > 1 && fkey == 0)) {

        jQuery("#form_label"+id).addClass("invalid");

        if (input_label == "") {
            document.getElementById("form_label_emsg"+id).innerHTML = "入力必須です";
            jQuery("#form_label"+id).focus();
            setTimeout(function(){jQuery('#form_label_emsg'+id).removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#form_label_emsg'+id).addClass('hidden');}, 5000);
        } else if (input_label == "表示切替") {
            document.getElementById("form_label_emsg"+id).innerHTML = "「表示切替」という値は使用できません";
            jQuery("#form_label"+id).focus();
            setTimeout(function(){jQuery('#form_label_emsg'+id).removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#form_label_emsg'+id).addClass('hidden');}, 5000);
        } else if(is_dup > 1 && input_label.length != 0) {
            document.getElementById('form_label_emsg'+id).innerHTML = "同一DB内で同じ項目名を使用することはできません。";
            jQuery("#form_label"+id).focus();
            setTimeout(function(){jQuery('#form_label_emsg'+id).removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#form_label_emsg'+id).addClass('hidden');}, 5000);
        }
    } else {
        jQuery("#form_label"+id).removeClass("invalid");
        jQuery('#form_label_emsg'+id).addClass('hidden');

    }
}
}

//Form Meta Validation realtime check
function validate_form_name(id,e) {
    var input_name = jQuery("#form_name"+id).val();
    var $format1 = /^[a-zA-Z]/;
    var $format2 = /^[a-zA-Z][a-zA-Z0-9_]*$/;
    //Check duplicate name値
    jQuery("#form_name"+id).attr('value', input_name);
    var is_dup = jQuery('.validateTextName[value="' + repDquote(input_name) + '"]').length;
    if(e.keyCode != 9){
    if (input_name == "name" || input_name == "display" || !input_name.match($format1) || !input_name.match($format2) || is_dup > 1) {
        jQuery("#form_name"+id).addClass("invalid");

        if (input_name == "name") {
            document.getElementById("form_name_emsg"+id).innerHTML = "「name」という値は使用できません";
            jQuery("#form_name"+id).focus();
            setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#form_name_emsg'+id).addClass('hidden');}, 5000);
        } else if (input_name == "display"){
            document.getElementById("form_name_emsg"+id).innerHTML = "「display」という値は使用できません";
            jQuery("#form_name"+id).focus();
            setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#form_name_emsg'+id).addClass('hidden');}, 5000);
        }else if(input_name == ""){
            document.getElementById("form_name_emsg"+id).innerHTML = "入力必須です";
            jQuery("#form_name"+id).focus();
            setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#form_name_emsg'+id).addClass('hidden');}, 5000);
        }else if(!input_name.match($format1)){
            document.getElementById("form_name_emsg"+id).innerHTML = "1文字目に使用できるのはアルファベットのみです";
            jQuery("#form_name"+id).focus();
            setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#form_name_emsg'+id).addClass('hidden');}, 5000);
        }else if(!input_name.match($format2)){
            document.getElementById("form_name_emsg"+id).innerHTML = "半角英数アンダーバーのみ使用可能です";
            jQuery("#form_name"+id).focus();
            setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#form_name_emsg'+id).addClass('hidden');}, 5000);
        } else if(is_dup > 1 && input_name.length != 0) {
            document.getElementById('form_name_emsg'+id).innerHTML = "同一DB内で同じname値を使用することはできません。";
            jQuery("#form_name"+id).focus();
            setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#form_name_emsg'+id).addClass('hidden');}, 5000);
        }
    }else{
        jQuery("#form_name"+id).removeClass("invalid");
        jQuery('#form_name_emsg'+id).addClass('hidden');
    }
    }
}

//Check if thank url include param (url=)
function validate_thanks_url_text_input(id){
    var urlvalue = jQuery('#thankurl').val();
    var thanktext = jQuery('#thanktext').val();
    var str_https = urlvalue.substr(0,8);// https://
    var str_http = urlvalue.substr(0,7);//http://
    if(thanktext == "" ){
        document.getElementById("thanktext_emsg").innerHTML = "入力必須です";
        jQuery("#thanktext").focus();
        setTimeout(function(){jQuery('#thanktext_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#thanktext_emsg').addClass('hidden');}, 5000);
    }else{
        jQuery('#thanktext_emsg').addClass('hidden');
    }
    if(jQuery("#thankurl").val().match("url=") || !(str_http.match("http://") || str_https.match("https://")) && urlvalue !=""){
        jQuery("#thankurl").addClass("invalid");

    if(jQuery("#thankurl").val().match("url=")){
        document.getElementById("thankurl_emsg").innerHTML = "URLパラメーターを設定することはできません";
        jQuery("#thankurl").focus();
        setTimeout(function(){jQuery('#thankurl_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#thankurl_emsg').addClass('hidden');}, 5000);
    }
    if(!(str_http.match("http://") || str_https.match("https://"))){
        document.getElementById("thankurl_emsg").innerHTML = "URLにはhttp/httpsから始まる値を設定してください";
        jQuery("#thankurl").focus();
        setTimeout(function(){jQuery('#thankurl_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#thankurl_emsg').addClass('hidden');}, 5000);
    }
    }else{

        jQuery("#thankurl").removeClass("invalid");
        jQuery('#thankurl_emsg').addClass('hidden');
    }

}
//Add real time check for sender name by not allow to input mail address
function validate_thankmail_recipient_name(e){
    var $sender_name_format = /^([^\n])+([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,})[^.]*$/;
    if(e.keyCode != 9){
        if(jQuery('#wpfws_thankmail_recipient_name').val().match($sender_name_format)){
            jQuery('#wpfws_thankmail_recipient_name').addClass("invalid");
            document.getElementById("wpfws_thankmail_recipient_name_emsg").innerHTML = "差出人名にメールアドレスを含めることはできません";
            jQuery("#wpfws_thankmail_recipient_name").focus();
            setTimeout(function(){jQuery('#wpfws_thankmail_recipient_name_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#wpfws_thankmail_recipient_name_emsg').addClass('hidden');}, 5000);
        }else{
            jQuery('#wpfws_thankmail_recipient_name').removeClass("invalid");
            jQuery('#wpfws_thankmail_recipient_name_emsg').addClass('hidden');
        }
    }
}
//Add real time check for sender name by not allow to input mail address
function validate_notimail_recipient_name(e){
    var $sender_name_format = /^([^\n])+([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,})[^.]*$/;
    if(e.keyCode != 9){
        if(jQuery('#wpfws_notimail_recipient_name').val().match($sender_name_format)){
            jQuery('#wpfws_notimail_recipient_name').addClass("invalid");
            document.getElementById("wpfws_notimail_recipient_name_emsg").innerHTML = "差出人名にメールアドレスを含めることはできません";
            jQuery("#wpfws_notimail_recipient_name").focus();
            setTimeout(function(){jQuery('#wpfws_notimail_recipient_name_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#wpfws_notimail_recipient_name_emsg').addClass('hidden');}, 5000);
        }else{
            jQuery('#wpfws_notimail_recipient_name').removeClass("invalid");
            jQuery('#wpfws_notimail_recipient_name_emsg').addClass('hidden');
            
        }
    }
}
//Add real time check to email format
function validate_thankmail_sender_format(e){
    var $email_format = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,})$/;
    if(e.keyCode != 9){
        if(!jQuery('#wpfws_thankmail_sender').val().match($email_format) && jQuery('#wpfws_thankmail_sender').val() !=""){
            jQuery('#wpfws_thankmail_sender').addClass("invalid");
            document.getElementById("wpfws_thankmail_sender_emsg").innerHTML = "メールアドレスを正しく入力してください";
            jQuery("#wpfws_thankmail_sender").focus();
            setTimeout(function(){jQuery('#wpfws_thankmail_sender_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#wpfws_thankmail_sender_emsg').addClass('hidden');}, 5000);
            
        }else{
            jQuery('#wpfws_thankmail_sender').removeClass("invalid");
            jQuery('#wpfws_thankmail_sender_emsg').addClass('hidden');
        }
    }
}


function validate_notimail_recipient_format(e){
    var $email_format = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,})$/;
    if(e.keyCode != 9){
        if(!jQuery('#wpfws_notimail_recipient').val().match($email_format) && jQuery('#wpfws_notimail_recipient').val() !=""){
            jQuery('#wpfws_notimail_recipient').addClass("invalid");
            document.getElementById("wpfws_notimail_recipient_emsg").innerHTML = "メールアドレスを正しく入力してください";
            jQuery("#wpfws_notimail_recipient").focus();
            setTimeout(function(){jQuery('#wpfws_notimail_recipient_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#wpfws_notimail_recipient_emsg').addClass('hidden');}, 5000);
            
        }else{
            jQuery('#wpfws_notimail_recipient').removeClass("invalid");
            jQuery('#wpfws_notimail_recipient_emsg').addClass('hidden');
        }
    }    
}
function validate_notimail_sender_format(e){
    var $email_format = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,})$/;
    if(e.keyCode != 9){
        if(!jQuery('#wpfws_notimail_sender').val().match($email_format) && jQuery('#wpfws_notimail_sender').val() !="" ){
            jQuery('#wpfws_notimail_sender').addClass('invalid');
            document.getElementById("wpfws_notimail_sender_emsg").innerHTML = "メールアドレスを正しく入力してください";
            jQuery("#wpfws_notimail_sender").focus();
            setTimeout(function(){jQuery('#wpfws_notimail_sender_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#wpfws_notimail_sender_emsg').addClass('hidden');}, 5000);
            
        }else{
            jQuery('#wpfws_notimail_sender').removeClass('invalid');
            jQuery('#wpfws_notimail_sender_emsg').addClass('hidden');
        }
    }
}
//check if display input include invalid character for
function validate_display_add_input(id){
    var display_input = jQuery("#wpfws_display").val();
    var display_name = <?php if(!empty($wpfws_display_array)) {echo '["' . implode('","', $wpfws_display_array ) . '"]';}else echo 'null'; ?>;
    jQuery.each(display_name , function(index,display){
        if(display_input == ''){
            jQuery("#wpfws_display").addClass("invalid");
            document.getElementById("add_display_emsg").innerHTML = "入力必須です";
            jQuery('#wpfws_display').focus();
            setTimeout(function(){jQuery('#add_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#add_display_emsg').addClass('hidden');}, 5000);
        }else if(jQuery("#wpfws_display").val().match(/["\s'#+\\&<>]/)) {
            jQuery("#wpfws_display").addClass("invalid");
            document.getElementById("add_display_emsg").innerHTML = "「' " + '"' +" & \\ + # < > スペース」を使用することはできません";
            jQuery('#wpfws_display').focus();
            setTimeout(function(){jQuery('#add_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#add_display_emsg').addClass('hidden');}, 5000);
        }else if(display == display_input){
            jQuery("#wpfws_display").addClass("invalid");
            document.getElementById("add_display_emsg").innerHTML = "既に使用済みの名称です";
            jQuery('#wpfws_display').focus();
            setTimeout(function(){jQuery('#add_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#add_display_emsg').addClass('hidden');}, 5000);
            return false ;
        }else{
            jQuery('#add_display_emsg').addClass('hidden');
            jQuery("#wpfws_display").removeClass("invalid");
        }
    });
}

//check if display input include invalid character for
function validate_display_edit_input(id){
    stopAllTimeouts();
    var display_edit = jQuery("#wpfws_display_edit").val();
    var display_name = <?php if(!empty($wpfws_display_array)) {echo '["' . implode('","', $wpfws_display_array ) . '"]';}else echo 'null'; ?>;

    
    //FadeOut If the input title same as default
    var default_input_display = document.getElementById("wpfws_display_edit").defaultValue;
    if(display_edit == default_input_display){
        return false;
    }

    jQuery.each(display_name , function(index,display){
        if(display_edit == ""){
            jQuery("#wpfws_display_edit").addClass("invalid");
            document.getElementById("edit_display_emsg").innerHTML = "入力必須です";
            jQuery('#wpfws_display_edit').focus();
            setTimeout(function(){jQuery('#edit_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#edit_display_emsg').addClass('hidden');}, 5000);
        }else if (jQuery("#wpfws_display_edit").val().match(/["\s'#+\\&<>]/)){
            jQuery("#wpfws_display_edit").addClass("invalid");

            document.getElementById("edit_display_emsg").innerHTML = "「' " + '"' +" & \\ + # < > スペース」を使用することはできません";
            jQuery('#wpfws_display_edit').focus();
            setTimeout(function(){jQuery('#edit_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#edit_display_emsg').addClass('hidden');}, 5000);
        }else if(display == display_edit){
            jQuery("#wpfws_display_edit").addClass("invalid");
            document.getElementById("edit_display_emsg").innerHTML = "既に使用済みの名称です";
            jQuery('#wpfws_display_edit').focus();
            setTimeout(function(){jQuery('#edit_display_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#edit_display_emsg').addClass('hidden');}, 5000);
            return false;
    
        }else{
            jQuery("#wpfws_display_edit").removeClass("invalid");
            jQuery('#edit_display_emsg').addClass('hidden');
        }
    });    
}
//Check validation of field setting popup
function field_setting_validation(rowId){
    stopAllTimeouts();
    var select_option= jQuery('#wpfws_form_options').val();
    // jQuery('.emsg').addClass('hidden');
    var lines = select_option.split(/\r|\r\n|\n/);
    var count_line = lines.length;
    var option_label_flag = false;

    for (var i = 0; i < count_line; i++) {
        $content = lines[i];
        $option_length = $content.length;

        if($option_length>128){
            jQuery("#wpfws_form_options").addClass("invalid"); 
            document.getElementById("select_options_emsg").innerHTML = "文字数が128文字を超えている選択肢があります。";
            jQuery('#wpfws_form_options').focus();
            setTimeout(function(){jQuery('#select_options_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#select_options_emsg').addClass('hidden');}, 5000);
            option_label_flag = false;
            break;
        }else {
            option_label_flag = true;
        }
    }

    if(option_label_flag){

        if(select_option==""){
            document.getElementById("select_options_emsg").innerHTML = "入力必須です";
            jQuery('#wpfws_form_options').focus();
            setTimeout(function(){jQuery('#select_options_emsg').removeClass('hidden');}, 200);
        }else if(select_option.match(/[`~!@#$%^&¥*?()_=+,.<>;:'"|{}[\]/\\-]/)){
            jQuery("#wpfws_form_options").addClass("invalid"); 
            document.getElementById("select_options_emsg").innerHTML = "オプションに以下の記号を使用することはできません。<br> ' " + '"' +"`~!@#$%^&*¥()-_=+[]{}|\\;:,<>.?/";
            jQuery('#wpfws_form_options').focus();
            setTimeout(function(){jQuery('#select_options_emsg').removeClass('hidden');}, 200);
        }else if(count_line > 128){
            jQuery("#wpfws_form_options").addClass("invalid"); 
            document.getElementById("select_options_emsg").innerHTML = "選択肢は128個以内で設定してください。 (現在: "+count_line+"個)";
            jQuery('#wpfws_form_options').focus();
            setTimeout(function(){jQuery('#select_options_emsg').removeClass('hidden');}, 200);
        }else if(select_option.match(/^[ \t]*$/gm)){
            jQuery("#wpfws_form_options").addClass("invalid"); 
            document.getElementById("select_options_emsg").innerHTML = "選択肢に空白を指定することはできません。<br>値を入力して下さい。";
            jQuery('#wpfws_form_options').focus();
            jQuery('#select_options_emsg').removeClass('hidden');
        }else{//if not error save date setting
            save_field_setting(rowId);
            jQuery(".popup").fadeOut();
            jQuery(".cover").fadeOut();
            jQuery("#wpfws_form_options").removeClass("invalid"); 
        }
    }
    setTimeout(function(){jQuery('.emsg').addClass('hidden');}, 3000);
}

var flag_ok = false;
var flag_validate_check = false;
//Form Meta validation after click save form
jQuery("#save_form").on('click', function(event){

    if(!flag_ok){
        event.preventDefault();

        //error message position
        var move_center = false;
        jQuery('#wpwrap :input[type=text], :input[type=url],textarea,select').off().focus(function(){
            if(!move_center){
                var center = jQuery(window).height()/6;
                var top = jQuery(this).offset().top ;
                if (top > center){
                    jQuery(window).scrollTop(top-center);
                }
                move_center = true;
            }
        });
        stopAllTimeouts();
        var display_count = parseInt("<?php echo ($fkey+1); ?>");
        var $format1 = /^[a-zA-Z]/;
        var $format2 = /^[a-zA-Z][a-zA-Z0-9_]*$/;
        var $email_format = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,})$/;
        var $sender_name_format = /^([^\n])+([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,})[^.]*$/;
        var key = parseInt("<?php echo ($ll*ceil(($i+1)/($j+1))); ?>");
        //Thankurl param
        var urlvalue = jQuery('#thankurl').val();
        var str_https = urlvalue.substr(0,8);// https://
        var str_http = urlvalue.substr(0,7);//http://
        if(display_count == 1){
            var last_key = (rowId+1);
        }else{
            var last_key = parseInt("<?php echo ceil(($i+1)/($j+1))*($ll+1); ?>");
        }
        var count = 0;

        for(let id=key; id<last_key; id++){
            var input_name = jQuery("#form_name"+id).val();
            var input_label = jQuery("#form_label"+id).val();
            //Check duplicate DisplayName & Name field
            var is_name_dup = jQuery('.validateTextName[value="' + repDquote(input_name) + '"]').length;
            var is_label_dup = jQuery('.FieldDisplayName[value="' + repDquote(input_label) + '"]').length;

            if(jQuery("#wpfws_title").val() == ''){
                document.getElementById("wpfws_title_emsg").innerHTML = "入力必須です";
                jQuery("#wpfws_title").focus();
                setTimeout(function(){jQuery('#wpfws_title_emsg').removeClass('hidden');}, 200);
                break;
            }else if(input_label == null){
                count++;
                continue;
            }else if(input_label == ''){
                document.getElementById("form_label_emsg"+id).innerHTML = "入力必須です";
                jQuery("#form_label"+id).focus();
                setTimeout(function(){jQuery('#form_label_emsg'+id).removeClass('hidden');}, 200);
                break;
            }else if(input_label == "表示切替"){
                document.getElementById("form_label_emsg"+id).innerHTML = "「表示切替」という値は使用できません";
                jQuery("#form_label"+id).focus();
                setTimeout(function(){jQuery('#form_label_emsg'+id).removeClass('hidden');}, 200);
                break;
            } else if (is_label_dup > 1 && jQuery("#form_label"+id).hasClass('invalid')) {
                document.getElementById('form_label_emsg'+id).innerHTML = "同一DB内で同じ項目名を使用することはできません。";
                jQuery("#form_label"+id).focus();
                setTimeout(function(){jQuery('#form_label_emsg'+id).removeClass('hidden');}, 200);
                break;
            } else if (input_name == '') {
                document.getElementById("form_name_emsg"+id).innerHTML = "入力必須です";
                jQuery("#form_name"+id).focus();
                setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
                break;
            }else if(!input_name.match($format1)){
                document.getElementById("form_name_emsg"+id).innerHTML = "1文字目に使用できるのはアルファベットのみです";
                jQuery("#form_name"+id).focus();
                setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
                break;
            }else if(!input_name.match($format2)){
                document.getElementById("form_name_emsg"+id).innerHTML = "半角英数アンダーバーのみ使用可能です";
                jQuery("#form_name"+id).focus();
                setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
                break;
            }else if(input_name == "name"){
                document.getElementById("form_name_emsg"+id).innerHTML = "「name」という値は使用できません";
                jQuery("#form_name"+id).focus();
                setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
                break;
            }else if(input_name == "display"){
                document.getElementById("form_name_emsg"+id).innerHTML = "「display」という値は使用できません";
                jQuery("#form_name"+id).focus();
                setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
                break;
            }else if (is_name_dup > 1 && jQuery("#form_name"+id).hasClass('invalid')) {
                document.getElementById('form_name_emsg'+id).innerHTML = "同一DB内で同じname値を使用することはできません。";
                jQuery("#form_name"+id).focus();
                setTimeout(function(){jQuery('#form_name_emsg'+id).removeClass('hidden');}, 200);
                break;
            } else if(!jQuery("#used"+id).is(' :checked')){
                jQuery("#required_"+id).not(this).prop('checked', false);
                jQuery("#required_hidden"+id).val(0);
            }else if(jQuery("#used"+id).is(' :checked')){
                jQuery("#used_hidden"+id).val(1);
            }
            count++;
        }
        if(count*display_count == last_key){
            for(let i=0; i<=display_count; i++){
                if(jQuery("#pulldowntext").val() == ''){
                    document.getElementById("pulldowntext_emsg").innerHTML = "入力必須です";
                    jQuery("#pulldowntext").focus();
                    setTimeout(function(){jQuery('#pulldowntext_emsg').removeClass('hidden');}, 200);
                    break;
                }else if(jQuery("#requiredtext").val() == ''){
                    document.getElementById("requiredtext_emsg").innerHTML = "入力必須です";
                    jQuery("#requiredtext").focus();
                    setTimeout(function(){jQuery('#requiredtext_emsg').removeClass('hidden');}, 200);
                    break;
                }else if(jQuery("#confirmtext").val() == ''){
                    document.getElementById("confirmtext_emsg").innerHTML = "入力必須です";
                    jQuery("#confirmtext").focus();
                    setTimeout(function(){jQuery('#confirmtext_emsg').removeClass('hidden');}, 200);
                    break;
                }else if(jQuery("#sendtext").val() == ''){
                    document.getElementById("sendtext_emsg").innerHTML = "入力必須です";
                    jQuery("#sendtext").focus();
                    setTimeout(function(){jQuery('#sendtext_emsg').removeClass('hidden');}, 200);
                    break;
                }else if(jQuery("#backtext").val() == ''){
                    document.getElementById("backtext_emsg").innerHTML = "入力必須です";
                    jQuery("#backtext").focus();
                    setTimeout(function(){jQuery('#backtext_emsg').removeClass('hidden');}, 200);
                    break;
                }else if(jQuery("#thanktext").attr('sp_required') == 'sp_required'){
                    document.getElementById("thanktext_emsg").innerHTML = "入力必須です";
                    jQuery("#thanktext").focus();
                    setTimeout(function(){jQuery('#thanktext_emsg').removeClass('hidden');}, 200);
                    break;
                }else if(jQuery("#thankurl").attr('sp_required') == 'sp_required'){
                    document.getElementById("thankurl_emsg").innerHTML = "入力必須です";
                    jQuery("#thankurl").focus();
                    setTimeout(function(){jQuery('#thankurl_emsg').removeClass('hidden');}, 200);
                    break;
                }else if(jQuery("#thankurl").val().match("url=")){
                    document.getElementById("thankurl_emsg").innerHTML = "URLパラメーターを設定することはできません";
                    jQuery("#thankurl").focus();
                    setTimeout(function(){jQuery('#thankurl_emsg').removeClass('hidden');}, 200);
                    break;
                //check url format
                }else if((jQuery('#thankurl').val()!='')&&(!(str_http.match("http://") || str_https.match("https://")))){
                    document.getElementById("thankurl_emsg").innerHTML = "URLにはhttp/httpsから始まる値を設定してください";
                    jQuery("#thankurl").focus();
                    setTimeout(function(){jQuery('#thankurl_emsg').removeClass('hidden');}, 200);
                    setTimeout(function(){jQuery('#thankurl_emsg').addClass('hidden');}, 5000);
                    break;
                }else if(jQuery("#wpfws_thankmail_use").css("display") == "inline-table" || jQuery("#wpfws_notimail_use").css("display") == "inline-table"){
                    if(jQuery("#wpfws_thankmail_use").css("display") == "inline-table"){
                        jQuery("#thankurl").attr("required",false);
                        jQuery("#thanktext").attr("required",false);
                        if(!jQuery('#wpfws_thankmail_recipient').val()){
                            document.getElementById("wpfws_thankmail_recipient_emsg").innerHTML = "選択してください";
                            jQuery("#wpfws_thankmail_recipient").focus();
                            setTimeout(function(){jQuery('#wpfws_thankmail_recipient_emsg').removeClass('hidden');}, 200);
                            break;
                        }else if(jQuery('#wpfws_thankmail_recipient_name').val().match($sender_name_format)){
                            document.getElementById("wpfws_thankmail_recipient_name_emsg").innerHTML = "差出人名にメールアドレスを含めることはできません";
                            jQuery("#wpfws_thankmail_recipient_name").focus();
                            setTimeout(function(){jQuery('#wpfws_thankmail_recipient_name_emsg').removeClass('hidden');}, 200);
                            break;
                        }else if(jQuery('#wpfws_thankmail_sender').val()==""){
                            document.getElementById("wpfws_thankmail_sender_emsg").innerHTML = "入力必須です";
                            jQuery("#wpfws_thankmail_sender").focus();
                            setTimeout(function(){jQuery('#wpfws_thankmail_sender_emsg').removeClass('hidden');}, 200);
                            break;
                        }else if(!jQuery('#wpfws_thankmail_sender').val().match($email_format)){
                            document.getElementById("wpfws_thankmail_sender_emsg").innerHTML = "メールアドレスを正しく入力してください";
                            jQuery("#wpfws_thankmail_sender").focus();
                            setTimeout(function(){jQuery('#wpfws_thankmail_sender_emsg').removeClass('hidden');}, 200);
                            break;
                        }else if(jQuery('#wpfws_thankmail_subject').val()==""){
                            document.getElementById("wpfws_thankmail_subject_emsg").innerHTML = "入力必須です";
                            jQuery("#wpfws_thankmail_subject").focus();
                            setTimeout(function(){jQuery('#wpfws_thankmail_subject_emsg').removeClass('hidden');}, 200);
                            break;
                        }else if(jQuery('#wpfws_thankmail_body').val()==""){
                            document.getElementById("wpfws_thankmail_body_emsg").innerHTML = "入力必須です";
                            jQuery("#wpfws_thankmail_body").focus();
                            setTimeout(function(){jQuery('#wpfws_thankmail_body_emsg').removeClass('hidden');}, 200);
                            break;
                        }
                    }
                    if(jQuery("#wpfws_notimail_use").css("display") == "inline-table"){
                        jQuery("#thankurl").attr("required",false);
                        jQuery("#thanktext").attr("required",false);
                        if(jQuery('#wpfws_notimail_recipient').val()==""){
                            document.getElementById("wpfws_notimail_recipient_emsg").innerHTML = "入力必須です";
                            jQuery("#wpfws_notimail_recipient").focus();
                            setTimeout(function(){jQuery('#wpfws_notimail_recipient_emsg').removeClass('hidden');}, 200);
                            break;
                        }else if(jQuery('#wpfws_notimail_recipient_name').val().match($sender_name_format)){
                            document.getElementById("wpfws_notimail_recipient_name_emsg").innerHTML = "差出人名にメールアドレスを含めることはできません";
                            jQuery("#wpfws_notimail_recipient_name").focus();
                            setTimeout(function(){jQuery('#wpfws_notimail_recipient_name_emsg').removeClass('hidden');}, 200);
                            break;
                        }else if(!jQuery('#wpfws_notimail_recipient').val().match($email_format)){
                            document.getElementById("wpfws_notimail_recipient_emsg").innerHTML = "メールアドレスを正しく入力してください";
                            jQuery("#wpfws_notimail_recipient").focus();
                            setTimeout(function(){jQuery('#wpfws_notimail_recipient_emsg').removeClass('hidden');}, 200);
                            break;
                        }else if(jQuery('#wpfws_notimail_sender').val()==""){
                            document.getElementById("wpfws_notimail_sender_emsg").innerHTML = "入力必須です";
                            jQuery("#wpfws_notimail_sender").focus();
                            setTimeout(function(){jQuery('#wpfws_notimail_sender_emsg').removeClass('hidden');}, 200);
                            break;
                        }else if(!jQuery('#wpfws_notimail_sender').val().match($email_format)){
                            document.getElementById("wpfws_notimail_sender_emsg").innerHTML = "メールアドレスを正しく入力してください";
                            jQuery("#wpfws_notimail_sender").focus();
                            setTimeout(function(){jQuery('#wpfws_notimail_sender_emsg').removeClass('hidden');}, 200);
                            break;
                        }else if(jQuery('#wpfws_notimail_subject').val()==""){
                            document.getElementById("wpfws_notimail_subject_emsg").innerHTML = "入力必須です";
                            jQuery("#wpfws_notimail_subject").focus();
                            setTimeout(function(){jQuery('#wpfws_notimail_subject_emsg').removeClass('hidden');}, 200);
                            break;
                        }else if(jQuery('#wpfws_notimail_body').val()==""){
                            document.getElementById("wpfws_notimail_body_emsg").innerHTML = "入力必須です";
                            jQuery("#wpfws_notimail_body").focus();
                            setTimeout(function(){jQuery('#wpfws_notimail_body_emsg').removeClass('hidden');}, 200);
                            break;
                        }
                    }
                    flag_validate_check = true;
                }else if(jQuery("#wpfws_notimail_use").css("display") == "inline-table"){
                    jQuery("#thankurl").attr("required",false);
                    jQuery("#thanktext").attr("required",false);
                    flag_validate_check = true;
                }else if(jQuery("#wpfws_thankmail_use").hide()){
                    jQuery("#thankurl").attr("required",false);
                    jQuery("#thanktext").attr("required",false);
                    flag_validate_check = true;
                }
            }
        }
        setTimeout(function(){jQuery('.emsg').addClass('hidden');}, 5000);
    }

    //Check validation befor Create DB or Update DB
    if(flag_validate_check){
        var btn_click_check = this.id;
        flag_validate_check = false;
        //Save Form
        save_form_click(btn_click_check);
    }
});
// Check if click save form on default display or non default display
function save_form_click(btn_click_check){
    var wpfws_db_id = <?php if(empty($wpfws_db_id)){echo '0';}else{echo '1';} ?>;
    var no_display = <?php if (!empty($fkey)) {echo $fkey;} else {echo '0';} ?>;
    if(!wpfws_db_id && btn_click_check == 'save_form'){
        jQuery('#save_form').prop('disabled', true);
        wpfws_create_db();
        wpfws_preview_form(false);
    }else if(no_display == 0 && wpfws_db_id && btn_click_check == 'save_form'){
        jQuery('#save_form').prop('disabled', true);
        wpfws_update_db();
        wpfws_preview_form(false);
    }else{
        flag_ok = true;
        jQuery('#wpfws_form').submit();
        wpfws_preview_form(false);
    }
}
function wpfws_preview_form(preview_clik){
    var post_id = <?php if(! empty($wpfws_post_id)){echo $wpfws_post_id;}else{echo 'NULL';} ?>;

    var wpfws_field_used = [],
        wpfws_form_required = [],
        wpfws_form_type = [],
        wpfws_form_label = [],
        wpfws_form_name = [],
        wpfws_form_placeholder = [],
        wpfws_form_pretext = [],
        wpfws_form_aftertext = [],
        wpfws_form_options = [],
        wpfws_start_year = [],
        wpfws_end_year = [],
        wpfws_year_order = [],
        wpfws_date_format = [],
        wpfws_date_dr_year = [],
        wpfws_date_dr_month = [],
        wpfws_date_dr_day = [];

    var activeVisualHeaderEditor = jQuery('#editorheader').is(':hidden'),
        activeVisualFooterEditor = jQuery('#editorfooter').is(':hidden'),
        wpfws_free_text_header = new Array(),
        wpfws_free_text_footer = new Array();
    jQuery('.spinner').css("visibility","inherit");
        // Get Freetext Header
        if (activeVisualHeaderEditor) {
            wpfws_free_text_header = Array(tinymce.get('editorheader').getContent({ format: 'html' }));
        } else {
            wpfws_free_text_header =  Array(jQuery('#editorheader').val());
        }

        //Get Freetext Footer
        if (activeVisualFooterEditor) {
            wpfws_free_text_footer = Array(tinymce.get('editorfooter').getContent({ format: 'html' }));
        } else {
            wpfws_free_text_footer =  Array(jQuery('#editorfooter').val());
        }

    var wpfws_title = Array(jQuery('#wpfws_title').val()),
        wpfws_dropdown_text = Array(jQuery('#pulldowntext').val()),
        wpfws_required_text = Array(jQuery('#requiredtext').val()),
        wpfws_confirm_text = Array(jQuery('#confirmtext').val()),
        wpfws_send_text = Array(jQuery('#sendtext').val()),
        wpfws_cancel_text = Array(jQuery('#backtext').val());

    jQuery('#form_elements').find('tr').each(function(){
        var i = this.id.substr(5);
        
        wpfws_field_used.push(jQuery('#used_hidden'+i+'').val());
        wpfws_form_required.push(jQuery('#required_hidden'+i+'').val());
        wpfws_form_type.push(jQuery('#select'+i+'').val());
        wpfws_form_label.push(jQuery('#form_label'+i+'').val());
        wpfws_form_name.push(jQuery('#form_name'+i+'').val());
        wpfws_form_placeholder.push(jQuery('#wpfws_form_placeholder'+i+'').val());
        wpfws_form_pretext.push(jQuery('#wpfws_form_pretext'+i+'').val());
        wpfws_form_aftertext.push(jQuery('#wpfws_form_aftertext'+i+'').val());
        wpfws_form_options.push(jQuery('#wpfws_form_options'+i+'').val());
        wpfws_start_year.push(jQuery('#wpfws_start_year'+i+'').val());
        wpfws_end_year.push(jQuery('#wpfws_end_year'+i+'').val());
        wpfws_year_order.push(jQuery('#wpfws_year_order'+i+'').val());
        wpfws_date_format.push(jQuery('#wpfws_date_format'+i+'').val());
        wpfws_date_dr_year.push(jQuery('#wpfws_date_dr_year'+i+'').val());
        wpfws_date_dr_month.push(jQuery('#wpfws_date_dr_month'+i+'').val());
        wpfws_date_dr_day.push(jQuery('#wpfws_date_dr_day'+i+'').val());
    });

      var path = "<?php echo WPFWS_SPIRAL_PLUGIN_DIR_URL; ?>";

      jQuery.ajax({
          url: path+'libs/wpfws_save_data_preview.php',
          data: {
            'type' : 'preview',
            'post_id' : post_id,
            'wpfws_title' : wpfws_title,
            'wpfws_free_text_header' : wpfws_free_text_header,
            'wpfws_dropdown_text' : wpfws_dropdown_text,
            'wpfws_required_text' : wpfws_required_text,
            'wpfws_free_text_footer' : wpfws_free_text_footer,
            'wpfws_confirm_text' : wpfws_confirm_text,
            'wpfws_send_text' : wpfws_send_text,
            'wpfws_cancel_text' : wpfws_cancel_text,

            'wpfws_field_used' : wpfws_field_used,
            'wpfws_form_required' : wpfws_form_required,
            'wpfws_form_type' : wpfws_form_type,
            'wpfws_form_label' : wpfws_form_label,
            'wpfws_form_name' : wpfws_form_name,
            'wpfws_form_placeholder' : wpfws_form_placeholder,
            'wpfws_form_pretext' : wpfws_form_pretext,
            'wpfws_form_aftertext' : wpfws_form_aftertext,
            'wpfws_form_options' : wpfws_form_options,
            'wpfws_start_year' : wpfws_start_year,
            'wpfws_end_year' : wpfws_end_year,
            'wpfws_year_order' : wpfws_year_order,
            'wpfws_date_format' : wpfws_date_format,
            'wpfws_date_dr_year' : wpfws_date_dr_year,
            'wpfws_date_dr_month' : wpfws_date_dr_month,
            'wpfws_date_dr_day' : wpfws_date_dr_day
          },
          type: 'post',
          success: function(output){
            jQuery('.spinner').css("visibility","hidden");
            var preview_link = '<?php echo add_query_arg( array( 'action' => 'preview' ), get_post_permalink($wpfws_post_id) ); ?>'
            if(preview_clik){
                window.open(preview_link, 'wp-preview-1');
            }
          },
      });
}

//Create DB AJAX
function wpfws_create_db(){
    var wpfws_form_type = [];
        wpfws_form_name = [];
        wpfws_form_label = [];
    var wpfws_db_name = jQuery('#wpfws_title').val();
    var post_id = <?php echo $wpfws_post_id; ?>;

    jQuery('#form_elements').find('tr').each(function () {
        var i = this.id.substr(5);
        wpfws_form_type.push(jQuery('#select'+i+'').val());
        wpfws_form_label.push(jQuery('#form_label'+i+'').val());
        wpfws_form_name.push(jQuery('#form_name'+i+'').val());
    });

      var path = "<?php echo WPFWS_SPIRAL_PLUGIN_DIR_URL; ?>";
      jQuery.ajax({
          url: path+'libs/wpfws_create_DB.php',
          data: {
          'type' : 'create_db',
          'post_id': post_id,
          'wpfws_db_name' : wpfws_db_name,
          'wpfws_form_type' : wpfws_form_type,
          'wpfws_form_name' : wpfws_form_name,
          'wpfws_form_label' : wpfws_form_label
          },
          type: 'post',
          success: function(output){
            jQuery('#save_form').prop('disabled', false);
            if(output == 'success'){
                flag_ok = true;
                jQuery('#wpfws_form').submit();
            }else if(output == 'error_DB_dup'){
                jQuery('#popup_create_DB_error h1').html('SPIRALデータベース作成に失敗しました');
                jQuery('#create_db_error_p1').html('SPIRALデータベース作成に失敗しました。');
                jQuery('#create_db_error_p2').html('フォーム見出し（連携先SPIRAL DB表示名）が重複しています。<br>設定内容を確認し、再度「新規作成」ボタンをクリックしてください。');
                jQuery('#popup_create_DB_error').fadeIn();
                jQuery('.cover').fadeIn();
            }else if(output == 'error_field_dup'){
                jQuery('#popup_create_DB_error h1').html('SPIRALデータベース作成に失敗しました');
                jQuery('#create_db_error_p1').html('SPIRALデータベース作成に失敗しました。');
                jQuery('#create_db_error_p2').html('項目名（連携先SPIRAL フィールド表示名）が重複しています。<br>設定内容を確認し、再度「新規作成」ボタンをクリックしてください。');
                jQuery('#popup_create_DB_error').fadeIn();
                jQuery('.cover').fadeIn();
            }
            else{
                jQuery('#popup_create_DB_error h1').html('SPIRALデータベース作成に失敗しました');
                jQuery('#create_db_error_p1').html('SPIRALデータベース作成に失敗しました。<br>設定内容を確認し、再度「新規作成」ボタンをクリックしてください。');
                jQuery('#create_db_error_p2').html('※エラーが解消されない場合はSPIRALv2の設定をご確認ください。');
                jQuery('#popup_create_DB_error').fadeIn();
                jQuery('.cover').fadeIn();
            }
          }
      });
}

//Update DB AJAX
function wpfws_update_db(){
    var wpfws_update_fields = [];
        wpfws_new_fields = [];
        wpfws_delete_fields = [];
        wpfws_order_fields = [];
        update_fields_id = [];

    var wpfws_db_name = jQuery('#wpfws_title').val();
    var post_id = <?php echo $wpfws_post_id; ?>;
    var wpfws_fields_id = <?php echo json_encode($wpfws_fields_id_array); ?>;
    jQuery('input[name="hidden_field_id"]').val(wpfws_fields_id);

    jQuery('#form_elements').find('tr').each(function () {
        var i = this.id.substr(5);
        var field_id = jQuery('#wpfws_fields_id'+i+'').val();
            wpfws_form_name = jQuery('#form_name'+i+'').val();
            wpfws_form_label = jQuery('#form_label'+i+'').val();
            wpfws_form_type = jQuery('#select'+i+'').val();

        wpfws_order_fields.push(wpfws_form_name);
        if(field_id == 'new'){
            //Check type and covert
            var type = wpfws_form_type;
            if(type == "email"){
                type = "email";
            }else if(type == "date"){
                type = "date";
            }else if(type == "date_dropdown"){
                type = "date";
            }else{
                type = "textarea";
            }

            new_field = {name : wpfws_form_name, displayName : wpfws_form_label, type : type};
            wpfws_new_fields.push(new_field);
        }else if(jQuery.inArray(field_id, wpfws_fields_id)){
            update_field = {id: field_id, name: wpfws_form_name, displayName: wpfws_form_label};
            update_fields_id.push(field_id);
            wpfws_update_fields.push(update_field);
        }
    });
    var wpfws_delete_fields = jQuery(wpfws_fields_id).not(update_fields_id).get().slice(1);

    var path = "<?php echo WPFWS_SPIRAL_PLUGIN_DIR_URL; ?>";
    jQuery.ajax({
      url: path+'libs/wpfws_update_DB.php',
      data: {
      'type' : 'update_db',
      'post_id': post_id,
      'wpfws_db_name' : wpfws_db_name,
      'wpfws_order_fields' : wpfws_order_fields,
      'wpfws_update_fields' : wpfws_update_fields,
      'wpfws_new_fields' : wpfws_new_fields,
      'wpfws_delete_fields' : wpfws_delete_fields
      },
      type: 'post',
      success: function(output){
        jQuery('#save_form').prop('disabled', false);
        if(output == 'success'){
            flag_ok = true;
            jQuery('#wpfws_form').submit();
        }else if(output == 'error_DB_dup'){
            jQuery('#popup_create_DB_error h1').html('SPIRALデータベース更新に失敗しました');
            jQuery('#create_db_error_p1').html('SPIRALデータベース更新に失敗しました。');
            jQuery('#create_db_error_p2').html('フォーム見出し（連携先SPIRAL DB表示名）が重複しています。<br>設定内容を確認し、再度「設定変更」ボタンをクリックしてください。');
            jQuery('#popup_create_DB_error').fadeIn();
            jQuery('.cover').fadeIn();
        }else if(output == 'error_field_dup'){
            jQuery('#popup_create_DB_error h1').html('SPIRALデータベース更新に失敗しました');
            jQuery('#create_db_error_p1').html('SPIRALデータベース更新に失敗しました。');
            jQuery('#create_db_error_p2').html('項目名（連携先SPIRAL フィールド表示名）が重複しています。<br>設定内容を確認し、再度「設定変更」ボタンをクリックしてください。');
            jQuery('#popup_create_DB_error').fadeIn();
            jQuery('.cover').fadeIn();
        }
        else{
            jQuery('#popup_create_DB_error h1').html('SPIRALデータベース更新に失敗しました');
            jQuery('#create_db_error_p1').html('');
            jQuery('#create_db_error_p2').html('SPIRALデータベース更新に失敗しました。<br>設定内容を確認し、再度「設定変更」ボタンをクリックしてください。<br/>※エラーが解消されない場合はSPIRALv2の設定をご確認ください。');
            jQuery('#popup_create_DB_error').fadeIn();
            jQuery('.cover').fadeIn();
        }
      }
    });
}

function stopAllTimeouts(){
    var id = window.setTimeout(null,0);
    while (id--){
        window.clearTimeout(id);
    }
}
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function menuDropdown(e, val) {
    var $ingnoreEle = jQuery(e.target).next();
    jQuery('.dropdown-content').not($ingnoreEle).removeClass('show');
    jQuery("#field_setting_menu"+val).toggleClass("show");
    
    var type = document.getElementById("select"+val).value;
    type == "date" 
        ? 
        jQuery("#edit_field_menu"+val).css("display","none") 
        :
        jQuery("#edit_field_menu"+val).css("display","block");
    
}
//Check when click on other place rather than dropbtn
jQuery(document).on('click', function(e){
    $this = e.target;
    if(! jQuery($this).hasClass('dropbtn') && ! jQuery($this).parent('.dropdown-content').length > 0) {
        jQuery("div.dropdown-content").removeClass("show");
    }
});

 //Delete Field Popup   
function delete_field(val){
    var label = jQuery('#form_label'+val).val();
    var name = jQuery('#form_name'+val).val();
    var type = document.getElementById("select"+val).value;
    switch(type){
        case "text":
            document.getElementById('select_del').innerHTML = "テキスト";
            break;
        case "textarea":
            document.getElementById('select_del').innerHTML = "テキストエリア";
            break;
        case "email":
            document.getElementById('select_del').innerHTML = "メールアドレス";
            break;
        case "radio":
            document.getElementById('select_del').innerHTML = "ラジオボタン";
            break;
        case "select":
            document.getElementById('select_del').innerHTML = "プルダウン";
            break;
        case "checkbox":
            document.getElementById('select_del').innerHTML = "チェックボックス";
            break;
        case "date_dropdown":
            document.getElementById('select_del').innerHTML = "日付 プルダウン";
            break;
        case "date":
            document.getElementById('select_del').innerHTML = "日付 カレンダー";
            break;
        }
    document.getElementById('form_name_del').innerHTML = name;
    document.getElementById('form_label_del').innerHTML = label;
    var rowCount = jQuery('.form_element_row').length;
    jQuery('.dropdown-content').removeClass("show");
    var checkbox_del_field = document.getElementById('confirm_delete_checkbox');
    //Check if there is only one field left
    if(rowCount > 1){
        jQuery("#popup_field_delete").fadeIn();
        jQuery(".cover").fadeIn();
        checkbox_del_field.onchange = function() {
        if(this.checked){
            jQuery("#delfield_btn").attr("disabled",false);
            jQuery("#delfield_btn").attr('onclick','delete_wpfws_form_item('+val+')');
        } else{
           jQuery("#delfield_btn").attr("disabled","disabled");
        }
        };
    }else{
        jQuery("#popup_field_delete_error").fadeIn();
        jQuery(".cover").fadeIn();
    }

    return false;
}   
//delete row field function
function delete_wpfws_form_item(val){
       var rowCount = jQuery('.form_element_row').length;
       var field_name = jQuery('#form_name'+val).val();
       jQuery("#rowid"+val).remove();
       jQuery(".popup").fadeOut();
       jQuery(".cover").fadeOut();
       jQuery("#confirm_delete_checkbox").attr('checked',false);
       jQuery("#delfield_btn").attr("disabled","disabled");
       rowCount-- ;
        //Check if user delete one field so enable user to add new field
        if(rowCount < 30){
            jQuery("#add_new_field").attr("disabled",false);
        }
        //Remove field from dropdown when email field delete
        delete_option_thankmail(field_name);
    }
function set_wpfws_required_hidden(obj){
    var hidden = obj.parentNode.parentNode.children[1];
    if(obj.checked){
        hidden.value = 1;
    }else{
        hidden.value = 0;
    }
}
function set_wpfws_used_hidden(obj){
    var hidden1 = obj.parentNode.parentNode.children[1];
    if(obj.checked){
        hidden1.value = 1;
    }else{
        hidden1.value = 0;
    }
}

function set_wpfws_send_field_value(obj){
    var wpfws_send_field = obj.parentNode.parentNode.children[0].children[1];
    wpfws_send_field.value = obj.value;
}
//Set error real time to text input
function check_text_pulldown(){
    if(jQuery("#pulldowntext").val() == ""){
        document.getElementById("pulldowntext_emsg").innerHTML = "入力必須です";
        jQuery("#pulldowntext").focus();
        setTimeout(function(){jQuery('#pulldowntext_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#pulldowntext_emsg').addClass('hidden');}, 5000);
    }else{
        jQuery('#pulldowntext_emsg').addClass('hidden');
    }
}
function check_text_required(){
    if(jQuery("#requiredtext").val() == ""){
        document.getElementById("requiredtext_emsg").innerHTML = "入力必須です";
        jQuery("#requiredtext").focus();
        setTimeout(function(){jQuery('#requiredtext_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#requiredtext_emsg').addClass('hidden');}, 5000);
    }else{
        jQuery('#requiredtext_emsg').addClass('hidden');
        
    }
}
function check_text_confirm(){
    if(jQuery("#confirmtext").val() == ""){
        jQuery('#confirmtext').addClass("invalid");
        document.getElementById("confirmtext_emsg").innerHTML = "入力必須です";
        jQuery("#confirmtext").focus();
        setTimeout(function(){jQuery('#confirmtext_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#confirmtext_emsg').addClass('hidden');}, 5000)
    }else{
        jQuery('#confirmtext').removeClass("invalid");
        jQuery('#confirmtext_emsg').addClass('hidden');
    }
}
function check_text_send(){
    if(jQuery("#sendtext").val() == ""){
        jQuery('#sendtext').addClass("invalid");
        document.getElementById("sendtext_emsg").innerHTML = "入力必須です";
        jQuery("#sendtext").focus();
        setTimeout(function(){jQuery('#sendtext_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#sendtext_emsg').addClass('hidden');}, 5000);
    }else{
        jQuery('#sendtext').removeClass("invalid");
        jQuery('#sendtext_emsg').addClass('hidden');
    }
}

function check_text_back(){
    if(jQuery("#backtext").val() == ""){
         jQuery('#backtext').addClass("invalid");
        document.getElementById("backtext_emsg").innerHTML = "入力必須です";
        jQuery("#backtext").focus();
        setTimeout(function(){jQuery('#backtext_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#backtext_emsg').addClass('hidden');}, 5000);
    }else{
        jQuery('#backtext').removeClass("invalid");
        jQuery('#backtext_emsg').addClass('hidden');
        }
}
//Check option label validation
function check_select_options(obj){
    var select_option= jQuery('#wpfws_form_options').val();
    var lines = select_option.split(/\r|\r\n|\n/);
    var count_line = lines.length;
    if(select_option.match(/^[ \t]*$/gm)){
        var blank_length = select_option.match(/^[ \t]*$/gm).length;
    }
    var option_label_flag = false;
    for (var i = 0; i < count_line; i++) {
        $content = lines[i];
        $option_length = $content.length;

        if($option_length>128){
            document.getElementById("select_options_emsg").innerHTML = "1つの選択肢に入力できる文字数は最大128文字です。<br>(現在: "+$option_length+"文字)";
            jQuery("#wpfws_form_options").addClass("invalid"); 
            jQuery('#wpfws_form_options').focus();
            setTimeout(function(){jQuery('#select_options_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#select_options_emsg').addClass('hidden');}, 5000);
            option_label_flag = false;
            break;
        }else {
            option_label_flag = true;
        }
    }

    if(option_label_flag){

        if(select_option==""){
            document.getElementById("select_options_emsg").innerHTML = "入力必須です";
            jQuery("#wpfws_form_options").focus();
            setTimeout(function(){jQuery('#select_options_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#select_options_emsg').addClass('hidden');}, 5000);
        }else if(select_option.match(/[`~!@#$%^&¥*?()_=+,.<>;:'"|{}[\]/\\-]/)){
            jQuery("#wpfws_form_options").addClass("invalid"); 
            document.getElementById("select_options_emsg").innerHTML = "オプションに以下の記号を使用することはできません。<br> ' " + '"' +"`~!@#$%^&*¥()-_=+[]{}|\\;:,<>.?/";
            jQuery("#wpfws_form_options").focus();
            setTimeout(function(){jQuery('#select_options_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#select_options_emsg').addClass('hidden');}, 3000);
        }else if(blank_length >1) {
            jQuery("#wpfws_form_options").addClass("invalid"); 
            document.getElementById("select_options_emsg").innerHTML = "選択肢に空白を指定することはできません。<br>値を入力して下さい。";
            jQuery("#wpfws_form_options").focus();
            setTimeout(function(){jQuery('#select_options_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#select_options_emsg').addClass('hidden');}, 5000);
        }else if(count_line > 128){
            jQuery("#wpfws_form_options").addClass("invalid"); 
            document.getElementById("select_options_emsg").innerHTML = "選択肢は128個以内で設定してください。 (現在: "+count_line+"個)";
            jQuery('#wpfws_form_options').focus();
            setTimeout(function(){jQuery('#select_options_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#select_options_emsg').addClass('hidden');}, 5000);
        }else{

        jQuery("#wpfws_form_options").removeClass("invalid"); 
        }
    }
}
var fkey = "<?php echo esc_js( $fkey ); ?>";
//Thank mail display and required check
function is_wpfws_thankmail_use(){
    var wpfws_thankmail_use = jQuery('#wpfws_thankmail_active');
    if(wpfws_thankmail_use[0].checked){
        jQuery('#wpfws_thankmail_use').css("display","inline-table");
        jQuery('.thankmail_msg').css('display','block');
        jQuery('.thankmail_content').css('display','block');
        if(fkey == 0){    
        jQuery('#thankmail_use_setting').css("display","block");
        }
        jQuery('#wpfws_thankmail_recipient').attr("required",true);
        jQuery('#wpfws_thankmail_sender').attr("required","required");
        jQuery('#wpfws_thankmail_subject').attr("required","required");
        jQuery('#wpfws_thankmail_body').attr("required","required");
    }else{
        jQuery('#wpfws_thankmail_recipient').attr("required",false);
        jQuery('#wpfws_thankmail_sender').attr("required",false);
        jQuery('#wpfws_thankmail_subject').attr("required",false);
        jQuery('#wpfws_thankmail_body').attr("required",false);
    }
}
//Notification mail display and required check
function is_wpfws_notimail_use(){
    var wpfws_notimail_use = jQuery('#wpfws_notimail_active');
    if(wpfws_notimail_use[0].checked){
        if(fkey == 0){
        jQuery('#notimail_use_setting').css("display","block");
        }
        jQuery('.notimail_content').css('display','block');
        jQuery("#wpfws_notimail_use").css("display","inline-table");
        jQuery('.notimail_msg').css('display','block');
        jQuery('#wpfws_notimail_recipient').attr('required','required');
        jQuery('#wpfws_notimail_sender').attr('required','required');
        jQuery('#wpfws_notimail_subject').attr('required','required');
        jQuery('#wpfws_notimail_body').attr('required','required');
         
    }else{
        jQuery('#wpfws_notimail_recipient').attr('required', false);
        jQuery('#wpfws_notimail_sender').attr('required',false);
        jQuery('#wpfws_notimail_subject').attr('required',false);
        jQuery('#wpfws_notimail_body').attr('required',false);
    }
}
//Add real time required error message to form title
function form_title_check(e){
    var title = jQuery("#wpfws_title").val();
    if (e.keyCode != 9){
        if( title == ""){
            document.getElementById("wpfws_title_emsg").innerHTML = "入力必須です";
            jQuery("#wpfws_title").focus();
            setTimeout(function(){jQuery('#wpfws_title_emsg').removeClass('hidden');}, 200);
            setTimeout(function(){jQuery('#wpfws_title_emsg').addClass('hidden');}, 5000);
         }else{
            jQuery('#wpfws_title_emsg').addClass('hidden');
         }
    }
}
//Add warning popup message when check thank you mail
jQuery('#wpfws_thankmail_active').on('change',function(e){
    if(jQuery(e.currentTarget).is(':checked')){
        jQuery('#mail_setting_wmsg').fadeIn();
        jQuery('.cover').fadeIn();    
    }else if(!jQuery(e.currentTarget).is(':checked')){
        jQuery('#wpfws_thankmail_active').prop("checked","checked");
        jQuery('#confirm_UncheckThankMail').prop("checked",false);
        jQuery("#check_use_thankmail_checkbox").attr("disabled","disabled");
        jQuery('#popup_unchecked_thankmailuse').fadeIn();
        jQuery('.cover').fadeIn();
        var checkbox_notuse_mail = document.getElementById('confirm_UncheckThankMail');
            checkbox_notuse_mail.onchange = function() {
                if(this.checked){
                    jQuery("#check_use_thankmail_checkbox").attr("disabled",false);
                    jQuery('#check_use_thankmail_checkbox').click(function(){
                        jQuery('#wpfws_thankmail_use,#thankmail_use_setting,.thankmail_msg,.thankmail_content').css('display','none');
                        jQuery('#wpfws_thankmail_active').prop("checked",false);
                        jQuery('#popup_unchecked_thankmailuse').fadeOut();
                        jQuery('.cover').fadeOut();
                    });
                }else{
                    jQuery("#check_use_thankmail_checkbox").attr("disabled","disabled");
                }
            }
        jQuery('#cancel_btn,#close_radio_change').click(function(){
                jQuery('#wpfws_thankmail_active').prop("checked","checked");
                jQuery('#popup_unchecked_thankmailuse').fadeOut();
                jQuery('.cover').fadeOut();
        });
    }
    });

//Add warning popup message when check notification mail
jQuery('#wpfws_notimail_active').on('change',function(e){
    if(jQuery(e.currentTarget).is(':checked')){
        jQuery('#mail_setting_wmsg').fadeIn();
        jQuery('.cover').fadeIn();
    }else if(!jQuery(e.currentTarget).is(':checked')){
        jQuery('#wpfws_notimail_active').prop("checked","checked");
        jQuery('#confirm_UncheckNotiMail').prop("checked",false);
        jQuery("#check_use_notimail_checkbox").attr("disabled","disabled");
        jQuery('#popup_unchecked_notimailuse').fadeIn();
        jQuery('.cover').fadeIn();
        var checkbox_notuse_mail = document.getElementById('confirm_UncheckNotiMail');
            checkbox_notuse_mail.onchange = function() {
                if(this.checked){
                    jQuery("#check_use_notimail_checkbox").attr("disabled",false);
                    jQuery('#check_use_notimail_checkbox').click(function(){
                        jQuery('#wpfws_notimail_use,#notimail_use_setting,.notimail_msg,.notimail_content').css('display','none');
                        jQuery('#wpfws_notimail_active').prop("checked",false);
                        jQuery('#popup_unchecked_notimailuse').fadeOut();
                        jQuery('.cover').fadeOut();
                    });
                }else{
                    jQuery("#check_use_notimail_checkbox").attr("disabled","disabled");
                }
            }
        jQuery('#cancel_btn_notimail,#close_notuse_notimail').click(function(){
                jQuery('#wpfws_notimail_active').prop("checked","checked");
                jQuery('#popup_unchecked_notimailuse').fadeOut();
                jQuery('.cover').fadeOut();
        });
    }
});

//When page load check thank mail dropdown
jQuery(document).ready(function() {
    var count_field = "<?php echo esc_js( $end ); ?>";   
    var fkey = "<?php echo esc_js( $fkey ); ?>";

    for ( var i=0; i<count_field; i++ ) {
        var field_name = jQuery('#form_name'+i).val();
        var type = jQuery("#select"+i).val();

        if ( (jQuery('#use_all_thankmail').is(':checked') && fkey > 0) ) {
            return true;
        } else if ( ! jQuery("#used"+i).is(' :checked') ) {
           jQuery("#required_"+i).not(this).prop('checked', false);
           jQuery("#required_hidden"+i).val(0);
           jQuery('#required_'+i).css("cursor","not-allowed");
       }
    }
});
//Function check thanks mail dropdown
function getval(sel)
{
    var index = sel.id.substring(6);
    var field_name = jQuery('#form_name'+index).val();
    var field_label = jQuery('#form_label'+index).val();
    var field_name_invalid = jQuery('#form_name'+index).hasClass('invalid');
    var field_label_invalid = jQuery('#form_label'+index).hasClass('invalid');

    //checking class invalid when Onchange
    var onchange_invalid = jQuery('#form_name'+index).hasClass('invalid');

    //Add option to Thankmail select when change type to email
    if ( onchange_invalid == true) {
        return false;
    } else if ( sel.value == 'email' && field_name != '' && field_label != '' && !field_name_invalid && !field_label_invalid) {
        add_option_thankmail(field_name, field_label, index);
    } else { //Remove option to Thankmail select when change type
        delete_option_thankmail(field_name);
    }
}
//function to avoid XSS to field label in data list detail popup
function htmlEntities(str){
return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
}

//function to avoid XSS to field label in data list detail popup
function repDquote(str){
return String(str).replace(/"/g, '&quot;');
}

function add_option_thankmail(field_name, field_label, row){
    if(!jQuery('#form_name'+row).hasClass('invalid')){
        jQuery("#wpfws_thankmail_recipient").append('<option value="'+htmlEntities(field_name)+'" data-row="'+ row +'">'+htmlEntities(field_label)+'('+htmlEntities(field_name)+')</option>');
        return false;
    }
}
function delete_option_thankmail(field_name){
    jQuery('#wpfws_thankmail_recipient option[value="'+ field_name +'"] ').remove();
    return false;
}

//Update Field Name in Thankmail select
function update_field_name_select_mail(id, val) {
    var index = id.substring(9);
    var select_update = jQuery('#select'+index).val();
    var start = 0;
    var end = rowId;
    var name_dup = 0;
    var default_name = document.getElementById(id).defaultValue;

    //checking class invalid when OnFocusIn
    var onfocus_invalid = jQuery('#'+id).hasClass('invalid');

    if (default_name != '') {
        var onfocusin_dup = jQuery('.validateTextName[value="' +repDquote(default_name)+ '"]').length;
    }

    if ( select_update == 'email' ) {
        jQuery('#'+id).off().on('focusout',function(){

        invalid_check_name(default_name, onfocusin_dup);

        //Check name値 duplicate
        jQuery(this).attr('value', jQuery(this).val());

        var field_name_update = jQuery('#'+id).val();
        var field_label_update = jQuery('#form_label'+index).val();
        var field_label_invalid = jQuery('#form_label'+index).hasClass('invalid');

        //checking class invalid when Onchange
        var onchange_invalid = jQuery('#'+id).hasClass('invalid');
        
        if ( !onfocus_invalid && onchange_invalid || field_name_update == '' ) {
            delete_option_thankmail(val);
        } else if ( onfocus_invalid && !onchange_invalid && field_name_update != '' && field_label_update != '' && !field_label_invalid || val == '') {
            add_option_thankmail(field_name_update, field_label_update, index); 
        } else if ( onfocus_invalid && onchange_invalid && val != '' );
          else if ( !onfocus_invalid && !onchange_invalid);

        jQuery('#wpfws_thankmail_recipient option[data-row="'+ index +'"]').text(field_label_update+'('+field_name_update+')');
        jQuery('#wpfws_thankmail_recipient option[data-row="'+ index +'"]').val(field_name_update).attr('data-row', index);
        });
    } else {
        jQuery('#'+id).off().on('focusout',function() {
            invalid_check_name(default_name, onfocusin_dup);
        });
    }
}

//Update Field Label in Thankmail select
function update_field_label_select_mail(id, val) {
    var index = id.substring(10);
    var select_update = jQuery('#select'+index).val();
    var fkey = "<?php echo esc_js( $fkey ); ?>";
    var start = 0;
    var end = rowId;
    var name_dup = 0;
    var default_label = document.getElementById(id).defaultValue;

    //checking class invalid when OnFocusIn
    var onfocus_invalid = jQuery('#'+id).hasClass('invalid');

    if (default_label != '') {
        var onfocusin_dup = jQuery('.FieldDisplayName[value="' +repDquote(default_label)+ '"]').length;
    }

    if ( select_update == 'email' ) {
        jQuery('#'+id).off().on('focusout',function(){
        
        invalid_check_label(default_label, onfocusin_dup);

        //Check field label duplicate
        jQuery(this).attr('value', jQuery(this).val());

        var field_label_update = jQuery('#'+id).val();
        var field_name_update = jQuery('#form_name'+index).val();
        var field_name_invalid = jQuery('#form_name'+index).hasClass('invalid');

        //checking class invalid when Onchange
        var onchange_invalid = jQuery('#'+id).hasClass('invalid');

        if (jQuery('#use_all_thankmail').is(':checked') && fkey > 0) {
            return false;
        } else if ( (!onfocus_invalid && onchange_invalid || field_label_update == '') && !field_name_invalid ) {
            delete_option_thankmail(field_name_update);
        } else if ( onfocus_invalid && !onchange_invalid && field_label_update != '' && field_name_update != '' && !field_name_invalid || val == '') {
            add_option_thankmail(field_name_update, field_label_update, index); 
        } else if ( onfocus_invalid && onchange_invalid && val != '' );
          else if ( !onfocus_invalid && !onchange_invalid);
        
        jQuery('#wpfws_thankmail_recipient option[data-row="'+ index +'"]').text(field_label_update+'('+field_name_update+')');
        jQuery('#wpfws_thankmail_recipient option[data-row="'+ index +'"]').val(field_name_update).attr('data-row', index);
        });
    } else {
        jQuery('#'+id).off().on('focusout',function() {
            invalid_check_label(default_label, onfocusin_dup);
        });
    }
}

//Invalid Check Label and add to thank mail dropdown
function invalid_check_label(default_value, onfocusin_dup) {
    if (default_value != '') {
        var onfocusout_dup = jQuery('.FieldDisplayName[value="' +repDquote(default_value)+ '"]').length;
        if (onfocusin_dup >= 2 && onfocusout_dup <= (onfocusin_dup-1)) {
            var index = jQuery('.FieldDisplayName[value="' +repDquote(default_value)+ '"]').attr('id').substring(10);
            var field_name_update = jQuery('#form_name'+index).val();
            var field_label_update = jQuery('#form_label'+index).val();
            var type = jQuery('#select'+index).val();
            var invalid_name = jQuery('#form_name'+index).hasClass('invalid');
            var invalid_label = jQuery('#form_label'+index).hasClass('invalid');
            jQuery("#form_label"+index).removeClass("invalid");
            
            if (type == 'email' && invalid_label && !invalid_name){
                add_option_thankmail(field_name_update, field_label_update, index);
            }
            return false;
        }
    }
}

//Invalid Check Name and add to thank mail dropdown
function invalid_check_name(default_value, onfocusin_dup) {
    if (default_value != '') {
        var onfocusout_dup = jQuery('.validateTextName[value="' +repDquote(default_value)+ '"]').length;
        if (onfocusin_dup >= 2 && onfocusout_dup <= (onfocusin_dup-1)) {
            var index = jQuery('.validateTextName[value="' +repDquote(default_value)+ '"]').attr('id').substring(9);
            var field_name_update = jQuery('#form_name'+index).val();
            var field_label_update = jQuery('#form_label'+index).val();
            var type = jQuery('#select'+index).val();
            var invalid_name = jQuery('#form_name'+index).hasClass('invalid');
            var invalid_label = jQuery('#form_label'+index).hasClass('invalid');
            jQuery("#form_name"+index).removeClass("invalid");
            
            if (type == 'email' && invalid_name && !invalid_label){
                add_option_thankmail(field_name_update, field_label_update, index);
            }
            return false;
        }
    }
}

//thank setting required check
function required_text(obj){
    var value = jQuery(obj).val();
    if ( value == "" ) {
        jQuery("#thanktext").attr("sp_required","sp_required");
    } else {
        jQuery("#thanktext").removeAttr("sp_required","sp_required");
        jQuery("#thankurl").removeAttr("required","required");
    }
}
function required_url(obj){
    var value = jQuery(obj).val();
    if(value == ""){
        jQuery("#thankurl").attr("sp_required","sp_required");
    }else if(jQuery('#thankurl').hasClass("invalid")){
        jQuery("#thankurl").removeAttr("sp_required","sp_required");
        jQuery("#thanktext").removeAttr("required","required");
    }else{
        jQuery("#thankurl").removeAttr("sp_required","sp_required");
        jQuery("#thanktext").removeAttr("required","required");
    }

}
//Check thank text and thank url\
jQuery('#urlCheck').click(function() {
   if(jQuery('#urlCheck').is(':checked')) { jQuery("#thankurl").attr("required",true);}
});
jQuery('#textCheck').click(function() {
   if(jQuery('#textCheck').is(':checked')) { jQuery("#thankurl").attr("required",true);}
});
//thank you setting
var text = "<?php echo esc_js( $wpfws_thanks_text[$fkey] ); ?>";
var url = "<?php echo esc_js( $wpfws_thanks_url[$fkey] ); ?>";
jQuery(document).ready(function(){
    if(url != ""){
        jQuery("#urlfield").show();
        jQuery("#textfield").hide();
    }else if(text != ""){
        jQuery("#textfield").show();
        jQuery("#urlfield").hide();
    }
});

jQuery("input[type='radio']").change(function(){ 
    if(jQuery(this).val()=="URL"){
        jQuery("#urlfield").show();
        jQuery("#textfield").hide();
        jQuery("#thanktext").attr("value","");
        jQuery("#thankurl").attr("sp_required","sp_required");
        jQuery("#thanktext").removeAttr("sp_required","sp_required");
    }else if(jQuery(this).val()=="TEXT"){
        jQuery("#textfield").show();
        jQuery("#urlfield").hide();
        jQuery("#thankurl").attr("value","");
        jQuery("#thanktext").attr("sp_required","sp_required");
        jQuery("#thanktext").attr("required","required");
        jQuery("#thankurl").removeAttr("sp_required","sp_required");
    }
});

//When change field type erase all setting from previous type
function change_field_type(val){
    jQuery('#wpfws_form_placeholder'+val).val("");
    jQuery('#wpfws_form_pretext'+val).val("");
    jQuery('#wpfws_form_aftertext'+val).val("");
    var options = jQuery('#wpfws_form_options'+val).val();
    if(options == ""){
        jQuery('#wpfws_form_options'+val).val("選択肢1\n選択肢2\n選択肢3");
    }else{
        options = jQuery('#wpfws_form_options'+val).val();
    }

 }
</script>

<script type="text/javascript">//Check initial display and non-initial display

jQuery(document).ready(function(){
    var db_title = "<?php echo esc_js( $wpfws_db_name ); ?>";
    var count_display = "<?php echo esc_js( $j ); ?>";
    var count_field = "<?php echo esc_js( $end ); ?>";
    var fkey = "<?php echo esc_js( $fkey ); ?>";
    var start = "<?php echo esc_js( $start ); ?>";
    if(db_title != ''){
        for(var i=Number(start); i<Number(count_field); i++){
            var e = document.getElementById("select"+i);
            var strUser = e.options[e.selectedIndex].value;
            if(strUser == 'text' || strUser == 'textarea'){
                jQuery('#select'+ i +' option:not(:selected)').attr('disabled','disabled');
                jQuery('#select'+ i +' option[value="textarea"]').removeAttr('disabled','disabled');
                jQuery('#select'+ i +' option[value="text"]').removeAttr('disabled','disabled');
            }
            else if(strUser == 'radio' || strUser == 'select' || strUser == 'checkbox'){
                jQuery('#select'+ i +' option:not(:selected)').attr('disabled','disabled');
                jQuery('#select'+ i +' option[value="radio"]').removeAttr('disabled','disabled');
                jQuery('#select'+ i +' option[value="select"]').removeAttr('disabled','disabled');
                jQuery('#select'+ i +' option[value="checkbox"]').removeAttr('disabled','disabled');
            }
            else if(strUser == 'date' || strUser == 'date_dropdown'){
                jQuery('#select'+ i +' option:not(:selected)').attr('disabled','disabled');
                jQuery('#select'+ i +' option[value="date_dropdown"]').removeAttr('disabled','disabled');
                jQuery('#select'+ i +' option[value="date"]').removeAttr('disabled','disabled');
            }
            else if(strUser == 'email'){
                jQuery('#select'+ i +' option:not(:selected)').attr('disabled','disabled');
            }
        }
    }

    if(fkey > 0){
        jQuery('#notimail_msg').css("margin-top","10px");
        jQuery('#thankmail_msg').css("margin-top","10px");
        jQuery("#form_elements").find(".validateTextName").attr("readOnly", "readOnly");
        jQuery("#add_new_field").attr("disabled", "disabled");
        jQuery(".mail_use_note").hide();
        jQuery("#noted_form_name_thankmail,#noted_form_name_notimail").css("display","");
        jQuery('#use_all_thankmail,#use_one_thankmail,#use_one_notimail,#use_all_notimail').attr("disabled","disabled");
        jQuery('#notimail_use_setting').css("pointer-events","none");
        jQuery(".dropdown-item").css("display","none");
    if(jQuery('#use_all_thankmail').is(':checked')){
        jQuery('#wpfws_thankmail_recipient').css("pointer-events","none");
        jQuery('#wpfws_thankmail_recipient').css("background-color","#ededee");
        jQuery('#wpfws_thankmail_recipient_name,#wpfws_thankmail_sender,#wpfws_thankmail_subject,#wpfws_thankmail_body').attr("readOnly","readOnly");
    }
    if(jQuery('#use_all_notimail').is(':checked')){
        jQuery('#wpfws_notimail_recipient,#wpfws_notimail_recipient_name,#wpfws_notimail_sender,#wpfws_notimail_subject,#wpfws_notimail_body').attr("readOnly","readOnly");
    }
        //Check other display when first display is not use mail
        var thankmail_active_val = <?php  if($wpfws_thankmail_active[0]){echo "1";}else{echo "0";}; ?>;
        var notimail_active_val = <?php  if($wpfws_notimail_active[0]){echo "1";}else{echo "0";}; ?>;
        if(thankmail_active_val == "0"){
            jQuery('#wpfws_thankmail_active').prop("checked",false);
            jQuery('#thankmail_label').css("display","none");
            jQuery('#thankmail_notuse').text("：使用しない");
        }else if(thankmail_active_val == "1"){
            jQuery('#wpfws_thankmail_active').prop("checked",true);
            jQuery('#thankmail_label').css("display","none");
            jQuery('#thankmail_notuse').text("：使用する");
        }
        if(notimail_active_val == "0"){
            jQuery('#wpfws_notimail_active').prop("checked",false);
            jQuery('#notimail_label').css("display","none");
            jQuery('#notimail_notuse').text("：使用しない");
        }else if (notimail_active_val == "1"){
            jQuery('#wpfws_notimail_active').prop("checked",true);
            jQuery('#notimail_label').css("display","none");
            jQuery('#notimail_notuse').text("：使用する");
        }

    }
});
</script>

<script>
//copy link URL function
function copyToClipboard(element){
    var $temp = jQuery("<input>");
    jQuery("body").append($temp);
    $temp.val(jQuery('#'+element).text()).select();
    document.execCommand("copy");
    $temp.remove();

    setTimeout(function(){jQuery('#copy_info_'+element).css("display","block");}, 200);
    setTimeout(function(){jQuery('#copy_info_'+element).css("display","none");}, 5000);
}

//Check name duplicate when click Save Form
jQuery('#add_new_field').off().on('click', function(event){
    var field_name_inc = 'field'+(rowId+1);
    var is_name_dup = jQuery('.validateTextName[value="' + repDquote(field_name_inc) + '"]').length;

    if (is_name_dup > 1) {
        jQuery('#form_name'+rowId).focus().addClass("invalid");
        document.getElementById('form_name_emsg'+rowId).innerHTML = "同一DB内で同じname値を使用することはできません。";
        setTimeout(function(){jQuery('#form_name_emsg'+rowId).removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#form_name_emsg'+rowId).addClass('hidden');}, 5000);
    }
});
</script>

<script>
    // Add field to readOnly base on Type select
    function validate_field(type, rowId){
        jQuery("#form_label"+rowId).removeAttr("readOnly",true);
        jQuery("#form_name"+rowId).removeAttr("readOnly",true);
        jQuery("#form_placeholder"+rowId).removeAttr("readOnly",true);
        jQuery("#form_pretext"+rowId).removeAttr("readOnly",true);
        jQuery("#form_aftertext"+rowId).removeAttr("readOnly",true);
        jQuery("#form_options"+rowId).removeAttr("readOnly",true);
        jQuery("#form_options"+rowId).css("display",'block');
        jQuery("#date_edit"+rowId).css("display",'none');

        switch(type){
            case "email":
                jQuery("#form_pretext"+rowId).attr("readOnly",true);
                jQuery("#form_aftertext"+rowId).attr("readOnly",true);
                jQuery("#form_options"+rowId).attr("readOnly",true);
                reset_date_dropdown(rowId);
                break;
            case "text":
                jQuery("#form_options"+rowId).attr("readOnly",true);
                reset_date_dropdown(rowId);
                break;
            case "textarea":
                jQuery("#form_pretext"+rowId).attr("readOnly",true);
                jQuery("#form_aftertext"+rowId).attr("readOnly",true);
                jQuery("#form_options"+rowId).attr("readOnly",true);
                reset_date_dropdown(rowId);
                break;
            case "radio":
                jQuery("#form_placeholder"+rowId).attr("readOnly",true);
                jQuery("#form_pretext"+rowId).attr("readOnly",true);
                jQuery("#form_aftertext"+rowId).attr("readOnly",true);
                reset_date_dropdown(rowId);
                break;
            case "select":
                jQuery("#form_placeholder"+rowId).attr("readOnly",true);
                jQuery("#form_pretext"+rowId).attr("readOnly",true);
                jQuery("#form_aftertext"+rowId).attr("readOnly",true);
                reset_date_dropdown(rowId);
                break;
            case "checkbox":
                jQuery("#form_placeholder"+rowId).attr("readOnly",true);
                jQuery("#form_pretext"+rowId).attr("readOnly",true);
                jQuery("#form_aftertext"+rowId).attr("readOnly",true);
                reset_date_dropdown(rowId);
                break;
            case "date_dropdown":
                edit_date_dropdown(rowId);
                jQuery("#save_date").attr('onclick','date_dropdown_validation('+rowId+')');
                jQuery("#form_placeholder"+rowId).attr("readOnly",true);
                jQuery("#form_pretext"+rowId).attr("readOnly",true);
                jQuery("#form_aftertext"+rowId).attr("readOnly",true);
                jQuery("#form_options"+rowId).css("display",'none');
                jQuery("#date_edit"+rowId).css("display",'block');
                return false;
                break;
            case "date":
                jQuery("#form_placeholder"+rowId).attr("readOnly",true);
                jQuery("#form_options"+rowId).attr("readOnly",true);
                jQuery("#form_pretext"+rowId).attr("readOnly",true);
                jQuery("#form_aftertext"+rowId).attr("readOnly",true);
                reset_date_dropdown(rowId);
                break;
        }
    }
    //Date dropdown function
    function validate_date_dropdown(rowId){
        jQuery("#save_date").attr('onclick','date_dropdown_validation('+rowId+')');
        jQuery("#form_placeholder"+rowId).attr("readOnly",true);
        jQuery("#form_pretext"+rowId).attr("readOnly",true);
        jQuery("#form_aftertext"+rowId).attr("readOnly",true);
        jQuery("#form_options"+rowId).css("display",'none');
        jQuery("#date_edit"+rowId).css("display",'block');
        return false;
    }
    function reset_date_dropdown(rowId){
        jQuery('#wpfws_start_year'+rowId).val('1918');
        jQuery('#wpfws_end_year'+rowId).val('2028');
        jQuery('#wpfws_year_order'+rowId).val('false');
        jQuery('#wpfws_date_format'+rowId).val('YYYY-MM-DD');
        jQuery('#wpfws_date_dr_year'+rowId).val('年');
        jQuery('#wpfws_date_dr_month'+rowId).val('月');
        jQuery('#wpfws_date_dr_day'+rowId).val('日');
    }
    function edit_date_dropdown(rowId){
        var start_year = jQuery('#wpfws_start_year'+rowId).val();
        var end_year = jQuery('#wpfws_end_year'+rowId).val();
        var year_order = jQuery('#wpfws_year_order'+rowId).val();
        var date_format = jQuery('#wpfws_date_format'+rowId).val();
        var year_text = jQuery('#wpfws_date_dr_year'+rowId).val();
        var month_text = jQuery('#wpfws_date_dr_month'+rowId).val();
        var day_text = jQuery('#wpfws_date_dr_day'+rowId).val();

        jQuery('#wpfws_start_year').val(start_year);
        jQuery('#wpfws_end_year').val(end_year);
        jQuery('#wpfws_year_order').val(year_order);
        jQuery('#wpfws_date_format').val(date_format);
        jQuery('#wpfws_date_dr_year').val(year_text);
        jQuery('#wpfws_date_dr_month').val(month_text);
        jQuery('#wpfws_date_dr_day').val(day_text);
        jQuery("#save_date").attr('onclick','date_dropdown_validation('+rowId+')');
        jQuery(".cover").fadeIn();
        jQuery("#popup_date_dropdown").fadeIn();
    }
    function save_date_dropdown(rowId){
        var start_year = jQuery('#wpfws_start_year').val();
        var end_year = jQuery('#wpfws_end_year').val();
        var year_order = jQuery('#wpfws_year_order').val();
        var date_format = jQuery('#wpfws_date_format').val();
        var year_text = jQuery('#wpfws_date_dr_year').val();
        var month_text = jQuery('#wpfws_date_dr_month').val();
        var day_text = jQuery('#wpfws_date_dr_day').val();

        jQuery('#wpfws_start_year'+rowId).val(start_year);
        jQuery('#wpfws_end_year'+rowId).val(end_year);
        jQuery('#wpfws_year_order'+rowId).val(year_order);
        jQuery('#wpfws_date_format'+rowId).val(date_format);
        jQuery('#wpfws_date_dr_year'+rowId).val(year_text);
        jQuery('#wpfws_date_dr_month'+rowId).val(month_text);
        jQuery('#wpfws_date_dr_day'+rowId).val(day_text);
    }
    function edit_field_setting(rowId){
        var placeholder = jQuery('#wpfws_form_placeholder'+rowId).val();
        var pretext = jQuery('#wpfws_form_pretext'+rowId).val();
        var aftertext = jQuery('#wpfws_form_aftertext'+rowId).val();
        var option = jQuery('#wpfws_form_options'+rowId).val();
        var label = jQuery('#form_label'+rowId).val();
        var name = jQuery('#form_name'+rowId).val();

        jQuery('#wpfws_form_placeholder').val(placeholder);
        jQuery('#wpfws_form_pretext').val(pretext);
        jQuery('#wpfws_form_aftertext').val(aftertext);
        jQuery('#wpfws_form_options').val(option);
        jQuery("#save_setting").attr('onclick','save_field_setting('+rowId+')');
        jQuery('.dropdown-content').removeClass("show");

        jQuery("#placeholder").css("display","");
        jQuery("#pretext").css("display","");
        jQuery("#aftertext").css("display","");
        jQuery("#options").css("display",'');
        var value = document.getElementById("select"+rowId).value;
        document.getElementById('form_name').innerHTML = name;
        document.getElementById('form_label').innerHTML = label;
        switch(value){
            case "text":
                document.getElementById('select').innerHTML = "テキスト";
                jQuery("#options").css("display","none");
                jQuery(".cover").fadeIn();
                jQuery("#popup_field_setting").fadeIn();
                break;
            case "textarea":
                jQuery("#pretext").css("display","none");
                jQuery("#aftertext").css("display","none");
                jQuery("#options").css("display","none");  
                document.getElementById('select').innerHTML = "テキストエリア";
                jQuery(".cover").fadeIn();
                jQuery("#popup_field_setting").fadeIn();
                break;
            case "email":
                document.getElementById('select').innerHTML = "メールアドレス";
                jQuery("#pretext").css("display","none");
                jQuery("#aftertext").css("display","none");
                jQuery("#options").css("display","none");
                jQuery(".cover").fadeIn();
                jQuery("#popup_field_setting").fadeIn();
                break;
            case "radio":
                jQuery("#save_setting").attr('onclick','field_setting_validation('+rowId+')');
                jQuery("#placeholder").css("display","none");
                jQuery("#pretext").css("display","none");
                jQuery("#aftertext").css("display","none");
                jQuery("#options").css("display"," ");
                jQuery("#wpfws_form_options").css("height","100px");  
                document.getElementById('select').innerHTML = "ラジオボタン";
                jQuery(".cover").fadeIn();
                jQuery("#popup_field_setting").fadeIn();
                break;
            case "select":
                jQuery("#save_setting").attr('onclick','field_setting_validation('+rowId+')');
                jQuery("#placeholder").css("display","none");
                jQuery("#pretext").css("display","none");
                jQuery("#aftertext").css("display","none");
                jQuery("#wpfws_form_options").css("height","100px");
                document.getElementById('select').innerHTML = "プルダウン";
                jQuery(".cover").fadeIn();
                jQuery("#popup_field_setting").fadeIn();
                break;
            case "checkbox":
                jQuery("#save_setting").attr('onclick','field_setting_validation('+rowId+')');
                jQuery("#placeholder").css("display","none");
                jQuery("#pretext").css("display","none");
                jQuery("#aftertext").css("display","none");
                jQuery("#wpfws_form_options").css("height","100px"); 
                document.getElementById('select').innerHTML = "チェックボックス";
                jQuery(".cover").fadeIn();
                jQuery("#popup_field_setting").fadeIn();
                break;
            case "date_dropdown":
                jQuery("#save_date").attr('onclick','date_dropdown_validation('+rowId+')');
                jQuery("#form_placeholder").attr("readOnly",true);
                jQuery("#form_options").css("display",'none');
                document.getElementById('select').innerHTML = "日付 プルダウン";
                document.getElementById('form_name_date_dropdown').innerHTML = name;
                document.getElementById('form_label_date_dropdown').innerHTML = label;
                jQuery(".cover").fadeOut();
                jQuery(".popup").fadeOut();
                edit_date_dropdown(rowId);
                break;
        }
        
    }
    function save_field_setting(rowId){
        jQuery(".popup").fadeOut();
        jQuery(".cover").fadeOut();
        var placeholder = jQuery('#wpfws_form_placeholder').val();
        var pretext = jQuery('#wpfws_form_pretext').val();
        var aftertext = jQuery('#wpfws_form_aftertext').val();
        var option = jQuery('#wpfws_form_options').val();

        jQuery('#wpfws_form_placeholder'+rowId).val(placeholder);
        jQuery('#wpfws_form_pretext'+rowId).val(pretext);
        jQuery('#wpfws_form_aftertext'+rowId).val(aftertext);
        document.getElementById('wpfws_form_options'+rowId).value= option ;
    }

    jQuery.fn.OneClickSelect = function () {
        return jQuery(this).on('click', function () {

        var range, selection;

        if (window.getSelection) {
          selection = window.getSelection();
          range = document.createRange();
          range.selectNodeContents(this);
          selection.removeAllRanges();
          selection.addRange(range);
        } else if (document.body.createTextRange) {
          range = document.body.createTextRange();
          range.moveToElementText(this);
          range.select();
        }
        });
    };
</script>

<!-- Prevent user from submitting by entering -->
<script type="">
    jQuery(document).ready(function(){
      jQuery(window).keydown(function(event){
        if(event.keyCode == 13 && !jQuery( event.target ).is( 'textarea' )){
          event.preventDefault();
        }
      });
    });
//allow only number on startyear and endyear
var start_year = document.getElementById('wpfws_start_year');
var end_year = document.getElementById('wpfws_end_year');
start_year.onkeydown = function(e) {
    if(!((e.keyCode > 95 && e.keyCode < 106)
      || (e.keyCode > 47 && e.keyCode < 58) 
      || e.keyCode == 8)) {
        return false;
    }
}
end_year.onkeydown = function(e) {
    if(!((e.keyCode > 95 && e.keyCode < 106)
      || (e.keyCode > 47 && e.keyCode < 58) 
      || e.keyCode == 8)) {
        return false;
    }
}
function set_used_and_required_field(val){
    if(!jQuery("#used"+val).is(' :checked')){
       jQuery("#required_"+val).not(this).prop('checked', false);
       jQuery("#required_hidden"+val).val(0);
       jQuery('#required_'+val).css("cursor","not-allowed");
    }else{
        jQuery('#required_'+val).css("cursor","pointer");
    }
}
jQuery(".setting_input").css({"font-size": "14px", "vertical-align": "inherit","height":"25px","text-align":"left"});
</script>

<script>
    //Check the number of DB if reach or over 20
    jQuery(document).ready(function(){
      var current_db_count = <?php if (! empty($current_db_count)) { echo $current_db_count; } else { echo '0'; } ?>;
      var db_limit = 20;
      var admin_url = '<?php echo admin_url( 'admin.php?page=wpfws_form_lists') ?>';
      var current_page = '<?php echo $_GET['page'] ?>';

      if( current_db_count >= db_limit && current_page == 'wpfws_new'){
        jQuery(".cover").fadeIn();
        jQuery("#dblimit_popup").fadeIn();
        //Redirect link to form lists
        jQuery("#err_db_limit_btn").attr("onclick", "window.location.href='"+admin_url+"'");
      }

    // just one click select the shortcode
    jQuery('#shortcode_copy').OneClickSelect();

    });
</script>

<!-- Disable button when submit!-->
<script>
    jQuery(function(){
        jQuery('form').submit(function(){
            jQuery("input[type='submit']", this)
            .css('pointer-events', 'none')
            .css('cursor', 'default');
            return true;
        });
    });
</script>
<script type="text/javascript">
    var display = "<?php echo esc_js( $wpfws_display_array[0] ); ?>";
    if(display != ""){
        //Check thank you mail
        jQuery('#use_all_thankmail').on('change',function(e){
            if(jQuery(e.currentTarget).is(':checked')){
                jQuery('#use_all_thankmail').prop("checked",false);
                jQuery("#change_mail_btn").attr("disabled","disabled");
                jQuery('#confirm_change_mail_radio').prop("checked",false);
                jQuery('#popup_mail_radio_change').fadeIn();
                jQuery('.cover').fadeIn();
            }
        var checkbox_thankmail_setting = document.getElementById('confirm_change_mail_radio');
            checkbox_thankmail_setting.onchange = function() {
            if(this.checked){
                jQuery("#change_mail_btn").attr("disabled",false);
                jQuery('#change_mail_btn').click(function(){
                    jQuery('#displayname_thankmail').text("共通");
                    jQuery('#use_all_thankmail').prop("checked","checked");
                    jQuery('#popup_mail_radio_change').fadeOut();
                    jQuery('.cover').fadeOut();
                });
            }else{
               jQuery("#change_mail_btn").attr("disabled","disabled");
            }

            };

            jQuery('#cancel_btn,#close_radio_change').click(function(){
                jQuery('#use_all_thankmail').prop("checked",false);
                jQuery('#use_one_thankmail').prop("checked","checked");
                jQuery('#popup_mail_radio_change').fadeOut();
                jQuery('.cover').fadeOut();
            });

        });
        //Check notification mail
        jQuery('#use_all_notimail').on('change',function(e){
            if(jQuery(e.currentTarget).is(':checked')){
                jQuery('#use_all_notimail').prop("checked",false);
                jQuery("#change_mail_btn").attr("disabled","disabled");
                jQuery('#confirm_change_mail_radio').prop("checked",false);
                jQuery('#popup_mail_radio_change').fadeIn();
                jQuery('.cover').fadeIn();
            }
        var checkbox_thankmail_setting = document.getElementById('confirm_change_mail_radio');
            checkbox_thankmail_setting.onchange = function() {
                if(this.checked){
                    jQuery("#change_mail_btn").attr("disabled",false);
                    jQuery('#change_mail_btn').click(function(){
                        jQuery('#displayname_notimail').text("共通");
                        jQuery('#use_all_notimail').prop("checked","checked");
                        jQuery('#popup_mail_radio_change').fadeOut();
                        jQuery('.cover').fadeOut();
                    });
                }else{
                   jQuery("#change_mail_btn").attr("disabled","disabled");
                }
            };
            jQuery('#cancel_btn,#close_radio_change').click(function(){
                jQuery('#use_all_notimail').prop("checked",false);
                jQuery('#use_one_notimail').prop("checked","checked");
                jQuery('#wpfws_thankmail_active').prop("checked","checked");
                jQuery('#popup_mail_radio_change').fadeOut();
                jQuery('.cover').fadeOut();
            });
        });
    }

    //Check use each thank you mail new create form 
    jQuery('#use_one_thankmail').on('change',function(e){
        if(jQuery(e.currentTarget).is(':checked')){
            jQuery("#popup_use_each_change,.cover").fadeIn();
            jQuery('#displayname_thankmail').text("<?php echo esc_html($wpfws_display_array[$fkey]); ?>");
            if(display == ""){
                jQuery('#displayname_thankmail').text("default");
                jQuery('#msg_content').text("個別コンテンツの設定は各表示切替ごとに設定を行ってください。");
                jQuery("#msg_content").css("text-align","center");
            }  
        }
    });
    jQuery('#use_one_notimail').on('change',function(e){
        if(jQuery(e.currentTarget).is(':checked')){
            jQuery("#popup_use_each_change,.cover").fadeIn();
            jQuery('#displayname_notimail').text("<?php echo esc_html($wpfws_display_array[$fkey]); ?>");
            if(display == ""){
                jQuery('#displayname_notimail').text("default");
                jQuery('#msg_content').text("個別コンテンツの設定は各表示切替ごとに設定を行ってください。");
                jQuery("#msg_content").css("text-align","center");
            }  
        }
    });
     //Check use each thank you mail new create form 
    jQuery('#use_all_thankmail').on('change',function(e){
        if(display == ""){
        jQuery('#displayname_thankmail').text("共通");
        }
    });
     //Check use each thank you mail new create form 
    jQuery('#use_all_notimail').on('change',function(e){
        if(display == ""){
        jQuery('#displayname_notimail').text("共通");
        }
    });

    jQuery(document).ready(function(){
    if(jQuery('#use_all_thankmail')[0].checked){
        jQuery('#displayname_thankmail').text("共通");
        jQuery('#noted_form_name_thankmail').text("※共通コンテンツの編集もしくは表示切替ごとに異なるコンテンツを使用したい場合は1つ目の表示切替で設定変更してください。");
    }else if(!jQuery('#use_all_thankmail')[0].checked){
        jQuery('#noted_form_name_thankmail').text("※共通コンテンツを使用したい場合は1つ目の表示切替で設定変更してください。");
    }
    if(jQuery('#use_all_notimail')[0].checked){
        jQuery('#displayname_notimail').text("共通");
        jQuery('#noted_form_name_notimail').text("※共通コンテンツの編集もしくは表示切替ごとに異なるコンテンツを使用したい場合は1つ目の表示切替で設定変更してください。");
    }else if (!jQuery('#use_all_notimail')[0].checked){
        jQuery('#noted_form_name_notimail').text("※共通コンテンツを使用したい場合は1つ目の表示切替で設定変更してください。");
    }
    if(jQuery('#use_one_thankmail,#use_one_notimail')[0].checked){
        jQuery('#displayname').text("<?php echo esc_html($wpfws_display_array[$fkey]); ?>");
    }
    if(jQuery('#use_one_notimail')[0].checked){
        jQuery('#displayname_notimail').text("<?php echo esc_html($wpfws_display_array[$fkey]); ?>");
    }

    });
</script>
<?php
/**
 * 管理画面＞設定＞WP Form with SPIRALのアウトプット
 *
 * @package   Spiral_Form
 * @author    PIPED BITS Co.,Ltd.
 */
?>
<div class="wrap">
<h1 class="wp-heading-inline">SPIRAL連携設定</h1>
<div style="margin:3px 0 7px 0 ;">
  <span><a href="https://spiral-platform.com/login" target="blank">SPIRAL ver.2管理画面</a>で発行したAPIキーと本プラグイン用に作成したアプリのアプリIDを入力し、保存してください。</span>
</div>
<form name="admin" method="post" action="" id="form-setting">
  <table border="0" class="wp-list-table widefat fixed striped pages">
    <tbody>
        <tr style="background-color: white;">
          <div id="container">
            <th>APIキー</th>
            <td>
              <input  type="password" class="Spiralsetting" autocomplete="off" id="leksomngat" name="wpfws_lek_somngat" value="<?php echo esc_attr( get_option('wpfws_lek_somngat') ); ?>" onkeyup="validate_lek_somngat();">
              <p class="emsg hidden" id="leksomngat_emsg"></p>
            </td>
         </div>
            <td>
              <input style="width: 75px; margin-left:-10px;" class="button button-primary" type="submit" id="change_leksomngat" name="saveleksomngat" " value="変更">
            </td>
      </tr>
      <tr>
        <th>アプリID</th>
        <td>
          <input type="text" autocomplete="off" class="Spiralsetting" id="appname" name="wpfws_app_id" value="<?php echo esc_attr( get_option('wpfws_app_id') ); ?>" title="半角数字で入力してください" onkeyup="validate_app_id();">
          <p class="emsg hidden" id="app_emsg"></p>
        </td>
        <td>
          <input style="width: 75px; margin-left:-10px;" class="button button-primary" type="submit" id="change_app_id" name="saveapp" value="変更">
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <th style="border-top: none;">
          <input style="width: 75px;" class="button button-primary" type="submit" id="submit" name="SPIRAL_options" value="保存">
        </th>
      </tr>
   </tfoot>
  </table>
</form>
</div>
<script type="text/javascript">
//Do real time check the validation of LekSomngat and show pink background color
function validate_lek_somngat(){
  var leksomngat = jQuery("#leksomngat").val();
  var lenleksomngat = jQuery("#leksomngat").val().length;
  var wpfws_leksomngat = "<?php echo esc_js( get_option('wpfws_lek_somngat') ); ?>";

  if(leksomngat ==''){
    jQuery("#leksomngat").addClass("invalid");
    document.getElementById("leksomngat_emsg").innerHTML = "入力必須です";
    jQuery('#leksomngat').focus();
    setTimeout(function(){jQuery('#leksomngat_emsg').removeClass('hidden');}, 200);
    setTimeout(function(){jQuery('#leksomngat_emsg').addClass('hidden');}, 2000);
  }else if(lenleksomngat != 32 && jQuery("#leksomngat").val() != wpfws_leksomngat){
    jQuery("#leksomngat").addClass("invalid");
    document.getElementById("leksomngat_emsg").innerHTML = "32bytesで入力してください。 (現在: "+lenleksomngat+" bytes)";
    jQuery('#leksomngat').focus();
    setTimeout(function(){jQuery('#leksomngat_emsg').removeClass('hidden');}, 200);
    setTimeout(function(){jQuery('#leksomngat_emsg').addClass('hidden');}, 2000);
  }else{
    jQuery("#leksomngat").removeClass("invalid");
  }
}
// Do real time check the validation of AppID and show pink background color
function validate_app_id(){
  var appid = jQuery("#appname").val();
  var $format = /^[0-9][0-9]*$/;
  if (appid == ''){
    jQuery("#appname").addClass("invalid");
    document.getElementById("app_emsg").innerHTML = "入力必須です";
    jQuery('#appname').focus();
    setTimeout(function(){jQuery('#app_emsg').removeClass('hidden');}, 200);
    setTimeout(function(){jQuery('#app_emsg').addClass('hidden');}, 2000);
  }else if(!jQuery("#appname").val().match($format)){
    jQuery("#appname").addClass("invalid");
    document.getElementById("app_emsg").innerHTML = "半角数字で入力してください";
    jQuery('#appname').focus();
    setTimeout(function(){jQuery('#app_emsg').removeClass('hidden');}, 200);
    setTimeout(function(){jQuery('#app_emsg').addClass('hidden');}, 2000);
  }else{
    jQuery("#appname").removeClass("invalid");
  }
}
//Check first time access admin setting leksomngat
jQuery(document).ready(function(){
  var leksomngat = jQuery("#leksomngat").val();
  if(leksomngat ==''){
     jQuery("#leksomngat").addClass("invalid");
  }else{
      jQuery("#leksomngat").removeClass("invalid");
  }
});
//Check first time access admin setting appID
jQuery(document).ready(function(){
  var appid = jQuery("#appname").val();
  if (appid == ''){
    jQuery("#appname").addClass("invalid");
  }else{
   jQuery("#appname").removeClass("invalid");
  }
});

</script>
<script type="text/javascript">
  jQuery("#change_leksomngat").click(function(){
    if(jQuery("#change_leksomngat").attr("value") != "保存" ){
      jQuery("#leksomngat").attr("readOnly",false);
      jQuery("#change_leksomngat").attr("value","保存");
      jQuery("#change_leksomngat").css("color","white");
      jQuery("#change_leksomngat").css("background-color","#3a7d99");
      return false;
    }
  });

  jQuery("#change_app_id").click(function(){
    if(jQuery("#change_app_id").attr("value") != "保存" ){
      jQuery("#appname").attr("readOnly",false);
      jQuery("#change_app_id").attr("value","保存");
      jQuery("#change_app_id").css("color","white");
      jQuery("#change_app_id").css("background-color","#3a7d99");
      return false;
    }
  });

  jQuery(document).ready(function(){
    var leksomngat = jQuery("#leksomngat").val();
    var appname = jQuery("#appname").val();
    if(leksomngat == '' || appname == ''){
      document.getElementById('change_leksomngat').style.display = 'none';
      document.getElementById('change_app_id').style.display = 'none';
    }else{
      jQuery("#leksomngat").attr("readOnly","readOnly");
      jQuery("#appname").attr("readOnly","readOnly");
      document.getElementById('submit').style.display = 'none';
    }
  });

  jQuery(".tesst").css("border-top","none");
</script>

<script>
// leksomngat validation check
  jQuery('form').submit(function( event ){
    stopAllTimeouts();
    var leksomngat = "<?php echo esc_js( get_option('wpfws_lek_somngat') ); ?>";
    var lenleksomngat = jQuery("#leksomngat").val().length;
    var $format = /^[0-9][0-9]*$/;

    jQuery('#leksomngat_emsg').addClass('hidden');
      if(jQuery("#leksomngat").val() == ''){
        document.getElementById("leksomngat_emsg").innerHTML = "入力必須です";
        jQuery('#leksomngat').focus();
        setTimeout(function(){jQuery('#leksomngat_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#leksomngat_emsg').addClass('hidden');}, 2000);
        event.preventDefault();
      }else if(lenleksomngat != 32 && jQuery("#leksomngat").val() != leksomngat){
        document.getElementById("leksomngat_emsg").innerHTML = "32bytesで入力してください。 (現在: "+lenleksomngat+" bytes)";
        jQuery('#leksomngat').focus();
        setTimeout(function(){jQuery('#leksomngat_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#leksomngat_emsg').addClass('hidden');}, 2000);
        event.preventDefault();
      }else if(jQuery("#appname").val() == ''){
        document.getElementById("app_emsg").innerHTML = "入力必須です";
        jQuery('#appname').focus();
        setTimeout(function(){jQuery('#app_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#app_emsg').addClass('hidden');}, 2000);
        event.preventDefault();
      }else if(!jQuery("#appname").val().match($format)){
        document.getElementById("app_emsg").innerHTML = "半角数字で入力してください";
        jQuery('#appname').focus();
        setTimeout(function(){jQuery('#app_emsg').removeClass('hidden');}, 200);
        setTimeout(function(){jQuery('#app_emsg').addClass('hidden');}, 2000);
        event.preventDefault();
      }
  });

  jQuery("input").keyup(function(){
    jQuery('.emsg').addClass('hidden');
  });

  function stopAllTimeouts(){
    var id = window.setTimeout(null,0);
    while (id--){
      window.clearTimeout(id);
    }
  }
  //Check if there is error message , not dispplay warning message show only error
  if(jQuery('#appid_error,#lek_errormes,#first_emsg').hasClass("notice-error")){
    jQuery(".notice-warning").css("display","none");
  }
  if(jQuery('.notice-warning').hasClass("notice-warning")){
    jQuery("#appid_warning").html("使用可能なアプリIDを保存して下さい。")
    jQuery("#lek_warning").html("使用可能なAPIkeyを保存して下さい。")
  }
  if(jQuery('.notice-warning').hasClass("notice-warning-access")){
    jQuery("#appid_warning").html("使用可能なアプリIDを保存して下さい。")
    jQuery("#lek_warning").html("使用可能なAPIkeyを保存して下さい。")
    jQuery("#lek_warning_access").html("エラーが発生しました。<br/>SPIRALv2の設定を確認してください。")
  }
  if(jQuery('.notice-warning').hasClass("notice-warning-browsing")){
    jQuery("#browsing_warning").html("エラーが発生しました。<br/>SPIRALv2の設定を確認してください。");
  }

</script>
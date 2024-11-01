<?php
/**
 * 管理画面＞設定＞WP Form with SPIRALのアウトプット
 *
 * @package   Spiral_Form
 * @author    PIPED BITS Co.,Ltd.
 */
?>
<div class="wrap">
<meta charset="UTF-8">
<title>Data Record Page</title>
  <h1 class="wp-heading-inline" style="color: #23282d; margin-top: -9px;">データ閲覧</h1>

<?php
/**Variable Declaration */
$app_id = get_option('wpfws_app_id');
/**End Variable Declaration  */


//API
global $lek_somngat;

$check_leksomngat_access =  check_permission($lek_somngat);
?>


<!--Body-->
<body>

<!--Detail Popup !-->
<div class="popup_detail">
  <form id=""> 
    <div class="content">
      <div style="padding: 5px 0px;">
          <h1 class="popup_header">詳細</h1>
      </div>
      <div>
          <a class="close" style="cursor:pointer;font-size: 41px;margin-top: 1%; opacity: 0.9;">&times;</a>
      </div>
      <div class="date_dropdown_setting" style="float: left; font-size: 1.5em; margin-bottom: 10px;">
        <div style="width: auto;height: auto;max-height: 400px;overflow-y: auto;">
         <table id="rowDetail" class="wp-list-table widefat fixed striped pages" style="margin-bottom:10px;">
           <tbody>
            <!--Data Detail Popup!-->
           </tbody>
         </table>
        </div>
        <button style="cursor:pointer;background-color: #ced4da;border-color: #ced4da;color: #212529; margin-left: 46%;margin-top: 0.1%;" class="cancel btn btn-primary">閉じる</button>
      </div>
    </div>
  </form>
</div>

<div class="cover"></div>

<div style="background-color: white;padding-top: 3px;margin-top: 7px;border: 1px solid #e5e5e5;">
<div style="margin:7px">

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
<div class="row" style="margin-top: 20px;">
<div class="col-md-12 col-sm-6 col-xs-12">
<form class="form-horizontal" method="post" id="form" name="form">

<!--DB slection-->
<div class="col-xs-4">
<?php
  //check other error even leksomngat and appid corrected
  if(!$check_leksomngat_access){
    echo '<select name="db_select" id="db_select" style="width:70%;">';
    echo '<option disabled selected>DBを選択してください</option>';
  }
  else{
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
    $wpfws_form_list = get_posts($args);
    //DB Select
    $offsetdb = 0;
    $countdb = 0;
    $limitdb = 200;
    $wpfws_dbid_array = array();
    $wpfws_post_id_array = array();

    do{
      $response_db = wpfws_set_URL("dbs/?apps=$app_id&limit=$limitdb&offset=$offsetdb");
      //Check DB existed in Spiral
      if($response_db['items']){
        foreach ($response_db['items'] as $db_items){
          foreach ($wpfws_form_list as $value){
            if($db_items['id'] == get_post_meta($value->ID, 'wpfws_db_id', true)){
              $wpfws_dbid_array[] = $db_items['id'];
              $wpfws_post_id_array[] = $value->ID;
              //Show the disabled DBを選択してください in option
              if($countdb == 0){
                $tem = $db_items['id'];
                echo '<select name="db_select" id="db_select" style="width:70%;" onchange="wpfws_db_change(this.value);wpfws_hideall();">';
                echo '<option disabled>DBを選択してください</option>'; 
              }

              //Print DB options
              echo '<option value="' . esc_attr($db_items['id']) . '" ' .(($db_items['id'] == sanitize_text_field($_POST['db_select']))?'selected="selected"' : ""). '>' . esc_html($db_items['displayName']) . '</option>';
              $countdb++;
            }
          }
        }
        $offsetdb = $response_db['nextOffset'];
      }

    } while($offsetdb != null);

    //check if No DB creation
    if($countdb == 0){
      echo '<select name="db_select" id="db_select" style="width:70%;">';
      echo '<option disabled selected>DBを選択してください</option>'; 
    }
  }
  echo '</select>';
?>
</div>
<!--End DB Selection-->

<!--Filter BOX-->
<div class="form-group " style="margin: 0 !important;">
  <!--Lable FROM_DATE-->
    <div class="col-sm-3">
      <div class="input-group">

        <input class="form-control" id="from_date" name="from_date" placeholder="YYYY-MM-DD" type="text" readOnly style="cursor: pointer; background-color: white;"/>
        <label class="input-group-addon btn" for="from_date">
           <span class="dashicons dashicons-calendar-alt"></span>

        </label>
      </div>
    </div>
  <label class="control-label col-sm-1" for="date" style="text-align: center; font-size: 1.4em;">~</label>
<!--End Lable FROM_DATE-->

<!--Lable TO_DATE-->
  <div class="col-sm-3">
    <div class="input-group">

      <input class="form-control" id="to_date" name="to_date" placeholder="YYYY-MM-DD" type="text" readOnly style="cursor: pointer; background-color: white;"/>
      <label class="input-group-addon btn" for="to_date">
         <span class="dashicons dashicons-calendar-alt"></span>

      </label>
    </div>
  </div>
<!--End Lable TO_DATE-->

<!--Filter Button-->
  <div class="form-group">
    <div class="col-sm-15 col-sm-offset-4">
      <input type="button" class="button button-primary" name="filter" id="filter" value="検索">
    </div>
  </div>
</div>
<!--End Filter Button-->

<!--Table Info (Top of table)-->
<div id="dataTables_info"></div>
<!--End Table Info-->

<!--Show & Hide Button of data table-->
<div class="form-group" style="margin-bottom: 0px;">
        <input type="button" id="showall" class="button button-primary" value="全項目表示" onclick="wpfws_showall();" style="float: right;margin-right: 3%;">
        <input type="button" id="hideall" class="button button-primary" value="先頭項目のみ表示" onclick="wpfws_hideall();" style="float: right; margin-right: 3%; display: none;">
        <input type="hidden" id="th_count" name="th_count">
</div>
<!--End Show & Hide Button-->

<!--End Filter BOX-->

<!--Data Body-->
<div class="panel-body" >
  <div  id = "beforetable">
  <table class="table demo table-striped table-bordered" id="databody" style="margin:0px;">

    <!--Data Header-->
    <thead id="table_header">

    </thead>
    <!--End Data Header-->

    <!--Data Display-->
    <tbody id="table_record">
      
    </tbody>

  </table>
  <!--End Data Body-->
  </div>

<!--Footer-->
<tfoot>
  <div class="container" style="width: auto;">
    <nav aria-label="Page navigation" style="margin-left: -1.5%; height: 55px;">
      <ul class="pagination" id="pagination"></ul>
    </nav>
  </div>
  <div id="loader" class="popup_spinner" style="display: none;"></div>
</tfoot>
<!--End Footer-->

</div>
<!--End Data Body-->

<script>
    jQuery(document).on('click','.detail',function (){
      var myTr = [];
      var myTh = [];
        var $row = jQuery(this).closest("tr");    // Find the row
        $row.find('td').each(function () {
          myTr.push(jQuery(this).text());
        });
        jQuery("#table_header tr").find('th').each(function () {
          myTh.push(jQuery(this).text());
        });
        
     var myHTML = '';
      for (var i = 0; i < myTh.length; i++) {
        myHTML += '<tr class="test">'+
                  '<td id="th'+i+'" style="width:30%;font-size14px;">'+htmlEntities(myTh[i])+'</td>'+
                  '<td id="td'+i+'"style="font-size14px; white-space: pre-line;">'+htmlEntities(myTr[i])+'</td>'+
                  '</tr>';
      }
        jQuery("#rowDetail tbody").html(myHTML);
        jQuery('.popup_detail, .cover').fadeIn();
    });

    jQuery(".close,.cancel").click(function(){
        jQuery(".popup_detail, .cover").fadeOut();
        return false;
    });
</script>

<script>
    //Function Set the pagination
    function wpfws_pagination(name,header,total,limit){
      if((total/limit) == 0){totalpage = 1;}else {totalpage = Math.ceil(total/limit);}
      var current = 1;
      $pagObj = jQuery('#pagination').twbsPagination({
          totalPages: totalpage,
          visiblePages: 7,
          first: '最初',
          prev: '前',
          next: '次',
          last: '最後',
          startPage: current,
          hideOnlyOnePage: true,
          initiateStartPageClick: true,
          onPageClick: function (event, page) {
            //Avoid call twice on function
            wpfws_page_click(name,header);
          }
      });
      jQuery(".disabled").hide();
    }

    function wpfws_page_click(name,header){
      jQuery('#pagination').click(function(){
        var db_id = jQuery('#db_select').val();
        var page = jQuery('ul#pagination').find('li.active').text();

        jQuery( "#loader, .cover" ).show();
        jQuery(".disabled").hide();
        wpfws_select_page(page,name,db_id,header);
      });
    }

    //Search Pagination function
    function wpfws_search_pagination(name,total,limit){
      if((total/limit) == 0){totalpage = 1;}else {totalpage = Math.ceil(total/limit);}
      var current = 1;
      $pagObj = jQuery('#pagination').twbsPagination({
          totalPages: totalpage,
          visiblePages: 7,
          first: '最初',
          prev: '前',
          next: '次',
          last: '最後',
          startPage: current,
          hideOnlyOnePage: true,
          initiateStartPageClick: true,
          onPageClick: function (event, page) {
            wpfws_search_page_click(name);
          }
      });
      jQuery(".disabled").hide();
    }

    function wpfws_search_page_click(name){
      jQuery('#pagination').click(function(){
        var page = jQuery('ul#pagination').find('li.active').text();
        jQuery( "#loader, .cover" ).show();
        jQuery(".disabled").hide();
        wpfws_search_date_filter(page,name);
      });
    }

    //Display Data When first reload
    jQuery(document).on('ready',function() {
      var db_id = <?php if($tem){echo $tem;}else{echo '0';} ?>;
      if(db_id != 0){
        wpfws_select_header(db_id);
      }else{
        jQuery('#showall,#hideall').hide();
      }
    });
    //Destroy the old value of pagination when change DB
    jQuery('#db_select').on('change',function(){
      jQuery('#pagination').twbsPagination('destroy');
    });

    //Function Change DB
    function wpfws_db_change(db_id){
      wpfws_select_header(db_id);
      jQuery('#from_date').val("").datepicker("update");
      jQuery('#to_date').val("").datepicker("update");
    }

    //Function Select Header
    function wpfws_select_header(db_id){
      jQuery( "#loader, .cover" ).show();
      var path = "<?php echo WPFWS_SPIRAL_PLUGIN_DIR_URL; ?>";

      jQuery.ajax({
      url: path+'libs/getData.php',
      data: {
      type : 'list_header',
      db_id : db_id
      },
      type: 'post',
      success: function(output){
        var response_db = new Array();
            response_db = JSON.parse(output);
        var name = [];
        var th_count = 3;
        var html;

        html += '<tr>';
        html += '<th  class= "th_data" style="border-bottom:none;">ID</th>';
        html += '<th style="border-bottom:none;">登録日時</th>';
        jQuery.each(response_db['fields'], function(index, value){
          name[index] = value['name'];
          html += '<th id="th_' + th_count + '" style="border-bottom:none;" nowrap> ' +htmlEntities(value['displayName']) + '</th>';
          th_count++; 
        });
        html += '</tr>';

        jQuery('#th_count').val(th_count);
        wpfws_select_page(1,name,db_id,html);

        jQuery('#filter').off('click').on('click', function(){
          search_filter_name(name);
        });

        }
      });
    }

    //Function pass name to serach filter
    function search_filter_name(name){
        wpfws_search_date_filter(1,name);
        //Destroy the old value of pagination when click Filter button
        jQuery('#pagination').twbsPagination('destroy');
        jQuery( "#loader, .cover" ).show();
    }

    //Function Select query data from spiralv2
    function wpfws_select_page(page,name,db_id,header){
      jQuery( "#loader, .cover" ).show();
      var path = "<?php echo WPFWS_SPIRAL_PLUGIN_DIR_URL; ?>";

      jQuery.ajax({
      url: path+'libs/getData.php',
      data: {
      type : 'list_data',
      db_id : db_id,
      page : page
      },
      type: 'post',
      success: function(output){
        var response_db_record = new Array();
            response_db_record = JSON.parse(output);

        var total = (response_db_record['totalCount'] != null) ? response_db_record['totalCount'] : '0';

        if(total == 0){
          jQuery("#beforetable").css("overflow","");
          jQuery('#table_header, #showall, #hideall, #footer').hide();

          var html = 
              '<tr>'+
              '<td style="text-align:center;padding-top:0 !important;" style="text-align:center;"><h2>データが存在しません</h2></td>'+
              '</tr>';
          jQuery('#table_record').html(html);
          wpfws_destroy_fix_header();
        }else{
          jQuery("#beforetable").css("overflow","auto");
          jQuery('#table_header').show();

          var prevOffset = response_db_record['prevOffset'];
          var limit = 200;
          var offset = (prevOffset == null) ? 0 : (prevOffset+limit);

          var html;
          jQuery.each(response_db_record['items'], function(index, value){
            var create_date = value['_createdAt'].substr(0, 19);
            var dt = convert_tz(create_date,'+9');

            html += '<tr id="' + value['_id'] + '">';
            html += '<td nowrap><a href="#" style="text-decoration: underline;" class="detail">' +htmlEntities(value['_id']) + '</a></td>';
            html += '<td class="date" nowrap>' + dt + '</td>';
            for(var x = 0 ; x < name.length; x++) {
              var output = (value[name[x]] == null) ? "" : value[name[x]];
                html += '<td class="td_' + x + '" nowrap style="white-space:pre-line;">' + output + '</td>';
            }
            html += '</tr>';
          });
          jQuery('#table_header').html(header);
          jQuery('#table_record').html(html);
          wpfws_check_header_table();
          wpfws_pagination(name,header,total,limit);
          dataTables_info(total,offset);
        }
      //Hide Spinner
      jQuery( "#loader, .cover" ).hide();
      },
      error:function(){
        //Hide Spinner
        jQuery( "#loader, .cover" ).hide();
      }
      });
    }

    //Function Select query the date filter data
    function wpfws_search_date_filter(page_search,name){
      var db_id = jQuery('#db_select').val();
      var path = "<?php echo WPFWS_SPIRAL_PLUGIN_DIR_URL; ?>";

      var from_date = jQuery('#from_date').val();
      var to_date = jQuery('#to_date').val();

      //Get the current date
      var today = new Date();
      var date = today.getDate();
      var month = today.getMonth()+1;
      var year = today.getFullYear();
          date = date < 10 ? '0'+date : date;
          month = month < 10 ? '0'+month : month;
      var current_date = year+'-'+month+'-'+date;

      jQuery.ajax({
      url: path+'libs/getData.php',
      data: {
        type : 'filter',
        db_id : db_id,
        page : page_search,
        from_date : from_date,
        to_date : to_date,
        current_date : current_date
      },
      type: 'post',
      success: function(output){
        var response_db_record = new Array();
            response_db_record = JSON.parse(output);

        var limit = 200;
        var offset = (response_db_record['prevOffset'] != null) ? (response_db_record['prevOffset']+limit) : '0';
        var totalSearchCount = (response_db_record['totalCount'] != null) ? response_db_record['totalCount'] : '0';

        if ( totalSearchCount != 0 ) {
          jQuery("#beforetable").css("overflow","auto");
          jQuery('#table_header').show();

          var html;

          jQuery.each(response_db_record['items'], function(index, search_value){
            var create_date = search_value['_createdAt'].substr(0, 19);
            var dt = convert_tz(create_date,'+9');

            html += '<tr>';
            html += '<td nowrap><a href="#" style="text-decoration: underline;" class="detail">' + search_value['_id'] + '</a></td>';
            html += '<td nowrap>' + dt + '</td>';
              for(var x = 0; x < name.length; x++){
                var output = (search_value[name[x]] == null) ? "" : search_value[name[x]];
                html += '<td class="td_' + (x) + '" nowrap style=" white-space: pre-line;">' + output + '</td>';
              }
            html += '</tr>';
          });

          jQuery('#table_record').html(html);
          wpfws_check_header_table();
          wpfws_search_pagination(name,totalSearchCount,limit);
          dataTables_info(totalSearchCount,offset);

        } else if ( totalSearchCount == 0 ) {
            //Show Empty
            jQuery("#beforetable").css("overflow","");
            jQuery('#table_header, #showall, #hideall, #footer').hide();
            
            var html = 
                '<tr>'+
                '<td style="text-align:center;padding-top:0 !important;" style="text-align:center;"><h2>データが存在しません</h2></td>'+
                '</tr>';
            jQuery('#table_record').html(html);
            wpfws_destroy_fix_header();
        }
      // Hide Spinner
      jQuery( "#loader, .cover" ).hide();
      },
      error:function(){
        //Hide Spinner
        jQuery( "#loader, .cover" ).hide();
      }
      });
    }

    //Function to display the Table Info
    function dataTables_info(total,offset) {
      var last_data = Number(offset)+200;

      if((Number(offset)+200) > total){var last_data = total;}
      var dataTables_info = '<div class="col-xs-5">'+
                            '<div class="dataTables_info" id="footer"  style="margin:10px 0 0 0 !important;" id="example_info">' + (Number(offset)+1) + ' - ' + Number(last_data) + ' 件&nbsp;/&nbsp;' + Number(total) + '&nbsp;件</div>'+
                            '</div>';
      jQuery('#dataTables_info').html(dataTables_info);
    }

    //Date time convertion "Asia/Tokyo +9"
    function convert_tz(date,offset) {
      //convert date to miliseconds
      dt = new Date(Date.parse(date+'Z') + (3600000*offset));
      // return time as a string
      return formatDate(dt);
    }

    //Date format function
    function formatDate(date) {
      var hours = date.getUTCHours();
      var minutes = date.getUTCMinutes();
      var seconds = date.getUTCSeconds();
      var year = date.getUTCFullYear();
      var month = (date.getUTCMonth()+1);
      var date = date.getUTCDate();

      seconds = seconds < 10 ? '0'+seconds : seconds;
      minutes = minutes < 10 ? '0'+minutes : minutes;
      hours = hours < 10 ? '0'+hours : hours;
      date = date < 10 ? '0'+date : date;
      month = month < 10 ? '0'+month : month;

      var strTime = hours + ':' + minutes + ':' + seconds;
      return year + "-" + month + "-" + date + "  " + strTime;
    }
</script>

</form>
</div>
</div>
</div>
</div>
</div>
</div>

<script>
  //Date picker function
  jQuery(document).ready(function() {
    var from_date = jQuery('input[name="from_date"]');
    var to_date = jQuery('input[name="to_date"]'); //our date input has the name "date"
    var container = jQuery('.bootstrap-iso form').length > 0 ? jQuery('.bootstrap-iso form').parent() : "body";
    from_date.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      clearBtn: true,
      autoclose: true,
    });
    to_date.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      clearBtn: true,
      autoclose: true,
    });
    jQuery("body").css("background-color", "#eeeeee");
    jQuery("body").css("overflow", "hidden");
  });
</script>
<script>
  //function to avoid XSS to field label in data list detail popup
  function htmlEntities(str){
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
  }
</script>

<script type="text/javascript">
  //Check Max header to hide button
  function wpfws_check_header_table() {
    var showall = jQuery('#showall').css('display');
    var th_count = jQuery('#th_count').val();

    if(th_count<=7){
      wpfws_destroy_fix_header();
      jQuery('#showall,#hideall').hide();
    }else if(showall != 'block'){
      wpfws_showall();
    }else{
      wpfws_hideall();
    }
  }

  //Show all the header table
  function wpfws_showall() {
    wpfws_destroy_fix_header();
    var th_count = jQuery('#th_count').val();
    for(i=7; i<th_count+1; i++){
      jQuery('#th_'+i).show();
    }
    for(j=4; j<th_count-1; j++){
      jQuery('.td_'+j).show();
    }
    jQuery('#showall').hide();
    jQuery('#hideall').show();
    wpfws_fix_header();
  }
  
  //Hide the table header that over 6
  function wpfws_hideall() {
    wpfws_destroy_fix_header();
    var th_count = jQuery('#th_count').val();
    for(i=7; i<th_count+1; i++){
    jQuery('#th_'+i).hide();
    }
    for(j=4; j<th_count-1; j++){
      jQuery('.td_'+j).hide();
    }
    jQuery('#showall').show();
    jQuery('#hideall').hide();
    wpfws_fix_header();
  }

  //Function Header fixed
  function wpfws_fix_header(){
    var $table = jQuery('table.demo');
    $table.floatThead({
      position: 'absolute',
      scrollContainer: true
    });
  }

  //Function Destroy Header fixed
  function wpfws_destroy_fix_header(){
    var $table = jQuery('table.demo');
    $table.floatThead('destroy');
  }

jQuery("#wpbody-content").css("float","");
jQuery("#wpbody-content").css("padding-bottom","");
jQuery("#wpwrap").css("overflow","auto");
</script>
</body>

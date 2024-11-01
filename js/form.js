
//Disable
jQuery(document).ready(function() {
    jQuery("form").submit(function(e) {
    // ボタンを押せないように変更
    jQuery("#submit_button").attr("disabled", "disabled");
    });
});
//Return back value checkbox when click back
jQuery(function() {
    var $CheckboxButton = jQuery('input[type=checkbox]');
    var $dataSaveField = jQuery('[checkbox-name]');
    //各ラジオボタンの設定（value値記録）
    $CheckboxButton.on('change', function() {
        var $self = jQuery(this).attr("name");
        var c_check_vals = [];
        jQuery('[name="' + $self + '"]:checked').each(function() {
            c_check_vals.push(jQuery(this).val());
        });
        var valueData = c_check_vals.join();
        var nameData = $self.split(',');
        var db_field_name = nameData[0];
        var $myDataSaveField = jQuery('[checkbox-name="' + nameData + '"]');
        $myDataSaveField.val(valueData);
    });

    //隠しフィールドの値から復帰処理
    $dataSaveField.each(function(index, value) {
        var $self = jQuery(this);
        var valueData =$self.val();
        var nameData = $self.attr('checkbox-name');
        var $groupCheckboxButton = jQuery('input[name="' + nameData + '"]');
        $groupCheckboxButton.each(function() {
            var $self = jQuery(this);
            if (valueData.match($self.val())) {
                $self.prop('checked', true);
            }
        });
    });
});
//Return back radio value checked when click back
jQuery(function() {
    var $radioButton = jQuery('input[type=radio]');
    var $dataSaveField = jQuery('[radio-name]');

    //各ラジオボタンの設定（value値記録）
    $radioButton.on('change', function(e) {
        var $self = jQuery(this);
        var valueData = $self.val();
        var nameData = $self.attr('name');
        var $myDataSaveField = jQuery('[radio-name="' + nameData + '"]');
        $myDataSaveField.val(valueData);
    });

    //隠しフィールドの値から復帰処理
    $dataSaveField.each(function() {
        var $self = jQuery(this);
        var valueData = $self.val();
        var nameData = $self.attr('radio-name');
        var $groupRadioButton = jQuery('input[name="' + nameData + '"]');
        $groupRadioButton.each(function() {
            var $self = jQuery(this);
            if ($self.val() === valueData) {
                $self.prop('checked', true);
            }
        });
    });
});

//Return back select value checked when click back
jQuery(function() {
    var $dropdown = jQuery('select');
    var $dataSaveField = jQuery('[select-name]');
    //各プルダウンの設定（value値記録）
    $dropdown.on('change', function(e) {
        var $self = jQuery(this);
        var valueData =$self.val();
        var nameData = $self.attr('name');
        var $myDataSaveField = jQuery('[select-name="' + nameData + '"]');
        $myDataSaveField.val(valueData);
    });

    //隠しフィールドの値から復帰処理
    $dataSaveField.each(function() {
        var $self = jQuery(this);
        var nameData = $self.attr('select-name');
        var valueData = $self.val();
        var $groupdropdown = jQuery('select[name="' + nameData + '"] option');
        $groupdropdown.each(function() {
            var $self = jQuery(this);
            if ($self.val() === valueData) {
                    $self.prop('selected', true);
                }
        }); 
    });   
});

//Add Delete button to date calendar
jQuery(function(){
  var old_fn = jQuery.datepicker._updateDatepicker;
  jQuery.datepicker._updateDatepicker = function(inst) {
    old_fn.call(this, inst);
    var buttonPane = jQuery(this).datepicker("widget").find(".ui-datepicker-buttonpane");
    var buttonHtml = "<button type='button' class='ui-datepicker-clean ui-state-default ui-priority-primary ui-corner-all'>値を削除</button>";
    jQuery(buttonHtml).appendTo(buttonPane).click(
      function(ev) {
        jQuery.datepicker._clearDate(inst.input);
    });
  }
});

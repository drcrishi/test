jQuery(function () {
 jQuery("#servicedateFrom").datepicker({
    showButtonPanel: true,
    dateFormat: 'dd-mm-yy',
    defaultDate: null,
    autoUpdateInput: false,
    beforeShow: function (input) {
        setTimeout(function () {
            var buttonPane = jQuery(input)
            .datepicker("widget")
            .find(".ui-datepicker-buttonpane");
            var btn = jQuery('<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
            btn.unbind("click")
            .bind("click", function () {
                jQuery.datepicker._clearDate(input);
            });
            btn.appendTo(buttonPane);
        }, 1);
    }
});
 jQuery("#servicedateTo").datepicker({
    showButtonPanel: true,
    dateFormat: 'dd-mm-yy',
    defaultDate: null,
    autoUpdateInput: false,
    beforeShow: function (input) {
        setTimeout(function () {
            var buttonPane = jQuery(input)
            .datepicker("widget")
            .find(".ui-datepicker-buttonpane");
            var btn = jQuery('<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
            btn.unbind("click")
            .bind("click", function () {
                jQuery.datepicker._clearDate(input);
            });
            btn.appendTo(buttonPane);
        }, 1);
    }
});


});


jQuery( document ).ready(function() {
    var reportRecords="";
    jQuery( "#viewWagesReport" ).click(function() {
        jQuery.ajax({
            type: 'POST',
            url: BASE_URL + "WagesReport/getWageReport",
            data: jQuery("#wages-report-form").serialize(),
            beforeSend: function() {    
                jQuery(".ajaxLoader").show();
            },
            success: function (response) {
                data= jQuery.parseJSON(response);
                jQuery(".reports").html(data.response);
                reportRecords=data.response;
                jQuery(".download-div").css("display","block");
                jQuery(".ajaxLoader").hide();
            }
        })
    });
});
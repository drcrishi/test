var Revenuereport = function() {

    var handleRevenue = function() {

        var revenueForm = $('#revenue-report');
        var error1 = $('.alert-danger', revenueForm);
        var success1 = $('.alert-success', revenueForm);
        revenueForm.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            invalidHandler: function(event, validator) { //display error alert on form submit   

            },
            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function(error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            submitHandler: function(form) {
                var formData = jQuery("#revenue-report").serializeArray();
                ajaxRevenuereport(formData);
            }
        });

        $('#revenue-report input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#revenue-report').validate().form()) {
                    var formData = jQuery("#revenue-report").serializeArray();
                    ajaxRevenuereport(formData);
                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function() {
            handleRevenue();
        }
    };
}();

jQuery(document).ready(function() {
    Revenuereport.init();
});

jQuery(function() {
    $("#servicedateFrom").datepicker({
        showButtonPanel: true,
        dateFormat: 'dd-mm-yy',
        defaultDate: null,
        autoUpdateInput: false,
        beforeShow: function(input) {
            setTimeout(function() {
                var buttonPane = $(input)
                    .datepicker("widget")
                    .find(".ui-datepicker-buttonpane");
                var btn = $('<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                btn.unbind("click")
                    .bind("click", function() {
                        $.datepicker._clearDate(input);
                    });
                btn.appendTo(buttonPane);
            }, 1);
        }
    });
    $("#servicedateFrom").datepicker().val('01-01-2017');
    $("#servicedateTo").datepicker({
        showButtonPanel: true,
        dateFormat: 'dd-mm-yy',
        defaultDate: null,
        autoUpdateInput: false,
        beforeShow: function(input) {
            setTimeout(function() {
                var buttonPane = $(input)
                    .datepicker("widget")
                    .find(".ui-datepicker-buttonpane");
                var btn = $('<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                btn.unbind("click")
                    .bind("click", function() {
                        $.datepicker._clearDate(input);
                    });
                btn.appendTo(buttonPane);
            }, 1);
        }
    });
    // $("#servicedateTo").datepicker().val('');
    $("#servicedateTo").datepicker({ dateFormat: 'dd/mm/yyyy', }).datepicker("setDate", new Date().getDay + 90);
});

function ajaxRevenuereport(formData) {
    jQuery('.ajaxLoader').show();
    /**
     * Edit enquiry data......................@DRCZ
     */
    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "storageReport/viewStorageReport",
        data: formData,
        success: function(response) {
            jQuery('.ajaxLoader').hide();
            if (response.trim() == "0") {
                jQuery(".alert-danger").show();
                jQuery(".alert-danger").html("No Records Found.");
                jQuery(".reports").html("<div>No Records Found.</div>");
            } else {
                jQuery(".reports").html(response);
                //toastr.success('Data added succefully');
                // jQuery("#revenue-report").trigger('reset');
            }
        }
    })

}
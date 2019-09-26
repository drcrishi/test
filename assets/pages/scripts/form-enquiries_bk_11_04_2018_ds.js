var Enquiry = function () {

    var handleEnquiry = function () {

        var enquiryForm = $('#enquiry-form');
        var error1 = $('.alert-danger', enquiryForm);
        var success1 = $('.alert-success', enquiryForm);
        enquiryForm.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                en_name: {
                    required: true
                },
                en_fname: {
                    required: true
                },
                en_lname: {
                    required: true
                },
//                en_phone: {
//                    required: true,
//                    regx: /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/,
//                },
                en_email: {
                    required: true,
                    email: true
                },
                en_servicedate: {
                    required: true,
                    regxdate: /\d{2}(\.|-)\d{2}(\.|-)\d{4}/,
                },
                en_servicetime: {
                    required: true,
                },
                en_deliverydate: {
                    regxdate: /\d{2}(\.|-)\d{2}(\.|-)\d{4}/,
                },
                en_storagedate: {
                    regxdate: /\d{2}(\.|-)\d{2}(\.|-)\d{4}/,
                },
                en_movingfrom_postcode: {
                    number: true,
                    maxlength: 4
                },
                en_movingfrom_state: {
                    required: true
                },
                en_movingto_postcode: {
                    number: true,
                    maxlength: 4
                },
                en_movingto_state: {
                    required: true
                },
                en_addpickup_postcode: {
                    number: true,
                    maxlength: 4
                },
                en_adddelivery_postcode: {
                    number: true,
                    maxlength: 4
                },
                en_deposit_amt: {
                    required: true,
                    number: true
                },
                en_no_of_movers: {
                    required: true,
                    number: true
                },
                en_no_of_trucks: {
                    required: true,
                    number: true
                },
                en_travelfee: {
                    required: true,
                    number: true
                },
                en_client_hourly_rate: {
                    required: true,
                    number: true
                },
                en_initial_hours_booked: {
                    required: true,
                    number: true
                },
                en_ladies_booked: {
                    required: true,
                    number: true
                },
                en_initial_sellprice: {
                    required: true,
                    number: true
                },
                en_additional_charges: {
                    number: true
                },
                en_additional_charges_cost: {
                    number: true
                },
                en_total_sellprice: {
                    number: true
                },
                en_total_costprice: {
                    number: true
                },
                en_hireamover_margin: {
                    number: true
                },
                en_eway_refno: {
                    number: true
                },
                en_eft_receivedon: {
                    regxdate: /\d{2}(\.|-)\d{2}(\.|-)\d{4}/,
                },
                en_additional_item: {
                    required: function (element) {
                        if ($('#additionalChargesinput').val() != '') {
                            return true;
                        } else {
//                            element.closest('.form-group').removeClass('has-error');
                            return false;
                        }
                    }
                }
            },
            messages: {
                en_name: {
                    required: "Name is required."
                },
                en_fname: {
                    required: "First name is required."
                },
                en_lname: {
                    required: "Last name is required."
                },
//                en_phone: {
//                    required: "Phone number is required.",
//                    number: "Enter only digits."
//                },
                en_email: {
                    required: "Email is required.",
                    email: "Email is not correct."
                },
                en_servicedate: {
                    required: "Service date is required."
                },
                en_servicetime: {
                    required: "Service time is required."
                },
                en_movingfrom_postcode: {
                    number: "Enter only 4 digits."
                },
                en_movingfrom_state: {
                    required: "Moving from state is required."
                },
                en_movingto_postcode: {
                    number: "Enter only 4 digits."
                },
                en_movingto_state: {
                    required: "Moving to state is required."
                },
                en_addpickup_postcode: {
                    number: "Enter only 4 digits."
                },
                en_adddelivery_postcode: {
                    number: "Enter only 4 digits."
                },
                en_deposit_amt: {
                    required: "Deposit amount is required.",
                    number: "Enter only digits."
                },
                en_no_of_movers: {
                    required: "No of movers is required.",
                    number: "Enter only digits."
                },
                en_no_of_trucks: {
                    required: "No of trucks is required.",
                    number: "Enter only digits."
                },
                en_travelfee: {
                    required: "Travelfee is required.",
                    number: "Enter only digits."
                },
                en_client_hourly_rate: {
                    required: "Client hourly rate is required.",
                    number: "Enter only digits."
                },
                en_initial_hours_booked: {
                    required: "Initial hours is required.",
                },
                en_ladies_booked: {
                    required: "No of ladies is required.",
                },
                en_initial_sellprice: {
                    required: "Initial sell price is required.",
                },
                en_additional_item: {
                    required: "Additional item is required."
                },
                en_additional_charges: {
                    number: "Enter only digits."
                },
                en_additional_charges_cost: {
                    number: "Enter only digits."
                },
                en_total_sellprice: {
                    number: "Enter only digits."
                },
                en_total_costprice: {
                    number: "Enter only digits."
                },
                en_hireamover_margin: {
                    number: "Enter only digits."
                },
                en_eway_refno: {
                    number: "Enter only digits."
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   

            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            submitHandler: function (form) {
                var formData = jQuery("#enquiry-form").serializeArray();
                ajaxEnquiry(new FormData(form));
            }
        });
        jQuery.validator.addMethod("regx", function (value, element, regexpr) {
            if (value != "") {
                return regexpr.test(value);
            } else {
                return true;
            }
        }, "Enter valid Phone number.");
        jQuery.validator.addMethod("regxdate", function (value, element, regexpr) {
            if (value != "") {
                return regexpr.test(value);
            } else {
                return true;
            }
        }, "Enter valid Date.");
        $('#enquiry-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#enquiry-form').validate().form()) {
                    var formData = jQuery("#enquiry-form")[0];
                    ajaxEnquiry(new FormData(formData));

                }
                return false;
            }
        });
//        $('#enquiry-form input').keypress(function (e) {
//            if (e.which == 13) {
//                if ($('#enquiry-form').validate().form()) {
//                    var formData = jQuery("#enquiry-form").serializeArray();
//                    ajaxEnquiry(formData);
//                }
//                return false;
//            }
//        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleEnquiry();
        }
    };
}();

jQuery(document).ready(function () {
    Enquiry.init();
});
jQuery(function () {
    $("#servicedate").datepicker({
        showButtonPanel: true,
        dateFormat: 'dd-mm-yy',
        defaultDate: null,
        autoUpdateInput: false,
        beforeShow: function (input) {
            setTimeout(function () {
                var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                var btn = $('<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                btn.unbind("click")
                        .bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                btn.appendTo(buttonPane);
            }, 1);
        }
    });
    $("#deliverydate").datepicker({
        showButtonPanel: true,
        dateFormat: 'dd-mm-yy',
        defaultDate: null,
        autoUpdateInput: false,
        beforeShow: function (input) {
            setTimeout(function () {
                var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                var btn = $('<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                btn.unbind("click")
                        .bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                btn.appendTo(buttonPane);
            }, 1);
        }
    });
    $("#eftreceivedon").datepicker({
        showButtonPanel: true,
        dateFormat: 'dd-mm-yy',
        defaultDate: null,
        autoUpdateInput: false,
        beforeShow: function (input) {
            setTimeout(function () {
                var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                var btn = $('<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                btn.unbind("click")
                        .bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                btn.appendTo(buttonPane);
            }, 1);
        }
    });
    $("#movingstoragedate").datepicker({
        showButtonPanel: true,
        dateFormat: 'dd-mm-yy',
        defaultDate: null,
        autoUpdateInput: false,
        beforeShow: function (input) {
            setTimeout(function () {
                var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                var btn = $('<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                btn.unbind("click")
                        .bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                btn.appendTo(buttonPane);
            }, 1);
        }
    });
    $("#anniversaryDate").datepicker({
        showButtonPanel: true,
        dateFormat: 'dd-mm-yy',
        defaultDate: null,
        autoUpdateInput: false,
        beforeShow: function (input) {
            setTimeout(function () {
                var buttonPane = $(input)
                        .datepicker("widget")
                        .find(".ui-datepicker-buttonpane");
                var btn = $('<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all">Clear</button>');
                btn.unbind("click")
                        .bind("click", function () {
                            $.datepicker._clearDate(input);
                        });
                btn.appendTo(buttonPane);
            }, 1);
        }
    });

});


/**
 * Add enquiry data................@DRCZ
 * @param {type} formData
 * @returns {undefined}
 */
function ajaxEnquiry(formData) {
//    console.log(formData);
//    return false;
    $(".ajaxLoader").show();
    jQuery.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        url: BASE_URL + "enquiries/add_enquiries",
        data: formData,
        success: function (response) {
            $(".ajaxLoader").hide();
            var res = JSON.parse(response);

            if (res.error) {
               // jQuery(".alert-danger").show();
              //  jQuery(".alert-danger").html(res.error);
               toastr.error(res.error);
            } 
            else if (res.expired) {
                        window.location = BASE_URL;
                    }
            else {
                var id = res.uniqueid;
                toastr.success('Data inserted succefully');
                // jQuery("#enquiry-form").trigger('reset');
                window.location = BASE_URL + "enquiries/viewEnquiries/" + id

            }
        }
    })


}



jQuery(document).ready(function () {

    /**
     * Suburb autocomplete.............................@DRCZ
     */
    jQuery(".suburb").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: BASE_URL + "enquiries/getsuburbdata",
                dataType: "json",
                data: request,
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 3,
        select: function (event, ui) {
            if (window.console)
                // console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                jQuery(this).attr("data-selected", "true");
        }
    });

    jQuery("#movingfromsuburb").autocomplete({
        close: function (event, ui) {
            var suburbstr = jQuery("#movingfromsuburb").val();
            var suburbarr = suburbstr.split(",");
            jQuery('#movingfrompostcode').val(suburbarr[1].trim());
            jQuery('#movingfromstate').val(suburbarr[2].trim());
            jQuery('#movingfromsuburb').val(suburbarr[0].trim());
            jQuery("#movingfromsuburb").trigger('change');
        }
    });

    jQuery("#movingtosuburb").autocomplete({
        close: function (event, ui) {
            var suburbstr = jQuery("#movingtosuburb").val();
            var suburbarr = suburbstr.split(",");
            jQuery('#movingtopostcode').val(suburbarr[1].trim());
            jQuery('#movingtostate').val(suburbarr[2].trim());
            jQuery('#movingtosuburb').val(suburbarr[0].trim());
            jQuery("#movingtosuburb").trigger('change');
        }
    });

    jQuery('body').on("focus", ".addpickupsuburb", function () {
        jQuery(this).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: BASE_URL + "enquiries/getsuburbdata",
                    dataType: "json",
                    data: request,
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 3,
            select: function (event, ui) {
                if (window.console)
                    // console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                    jQuery(this).attr("data-selected", "true");
            },
            close: function (event, ui) {

                var suburbstr = jQuery(this).val();
                var suburbarr = suburbstr.split(",");
                jQuery(this).closest('.additionalPickuptxt').find(".postcodepickup").find(".addpickuppostcode").val(suburbarr[1].trim());
                jQuery(this).closest('.additionalPickuptxt').find(".suburbpickup").find(".addpickupsuburb").val(suburbarr[0].trim());
                jQuery(this).closest('.additionalPickuptxt').find(".suburbpickup").find(".addpickupstate").val(suburbarr[2].trim());
                jQuery(this).trigger('change');

            }
        });
    });
    jQuery('body').on("focus", ".adddeliverysuburb", function () {
        jQuery(this).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: BASE_URL + "enquiries/getsuburbdata",
                    dataType: "json",
                    data: request,
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 3,
            select: function (event, ui) {
                if (window.console)
                    // console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                    jQuery(this).attr("data-selected", "true");
            },
            close: function (event, ui) {

                var suburbstr = jQuery(this).val();
                var suburbarr = suburbstr.split(",");
                jQuery(this).closest('.additionalDeliverytxt').find(".postcodedelivery").find(".adddeliverypostcode").val(suburbarr[1].trim());
                jQuery(this).closest('.additionalDeliverytxt').find(".suburbdelivery").find(".adddeliverysuburb").val(suburbarr[0].trim());
                jQuery(this).closest('.additionalDeliverytxt').find(".suburbdelivery").find(".adddeliverystate").val(suburbarr[2].trim());
                jQuery(this).trigger('change');
            }
        });
    });

    /**
     * Removealist autocomplete....................@DRCZ
     */
    jQuery("#removalist").blur(function () {
        var removalist = jQuery("#removalist_data").val();
        if (removalist == "") {
            jQuery('#removealist1').find('span.error').parent("label").remove();
            jQuery('#removealist1').addClass("has-error");
            jQuery("#removalist-error").remove();
            jQuery(".remname").after("<span id=\"removalist-error\" class=\"help-block help-block-error\">Removalist is not exists in database.</span>");
        }else{
           jQuery('#removealist1').removeClass("has-error");
            jQuery("#removalist-error").remove(); 
        }
        //  jQuery(this).val('');
        //  jQuery("#removalist_data").val('');
    });
    jQuery("#removalist").autocomplete({
        source: function (request, response) {
            var enqstate = jQuery("#movingfromstate").val();
            $.ajax({
                url: BASE_URL + "enquiries/getcontactid/" + enqstate,
                dataType: "json",
                data: request,
                success: function (data) {
                    if (data.items.length > 0) {
                        response($.map(data.items, function (item) {
                            return {
                                label: item.name,
                                value: item.id
                            };
                        }));
                    } else {
                        jQuery("#removalist_data").val('');
                        response([{label: 'No results found.', value: -1}]);
                    }

//                    response(data);
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            if (ui.item.value == "" || ui.item.value == -1) {
                jQuery(this).val('');
                jQuery("#removalist_data").val('');
                return false;
            }
//            if (window.console)
//                this.value = ui.item.label;
//            jQuery(this).next("input").val(ui.item.value);
//            jQuery('#removalist_data').val(ui.item.value);

            var removalistIDs = ui.item.value;
            jQuery('#removalist').val('');
            jQuery('#removalist_data').val(removalistIDs);
            jQuery(".removalistselection").html("<li class='removalist" + ui.item.value + "' data-id='" + ui.item.value + "'>" + ui.item.label + "<span class='fa fa-times rm-removalist'></span></li>");


            event.preventDefault();
            // jQuery(this).attr("data-selected", "true");
        }



    });
  jQuery("body").on("click", ".rm-removalist", function () {
        if (confirm("Are you sure want to remove removalist?")) {
            var packerIDs = jQuery('#removalist_data').val().trim();
            var packerIDarray = packerIDs.split(",");
            var packerToRemove = jQuery(this).parent("li").data("id");
            var y = jQuery.grep(packerIDarray, function (value) {
                return value != packerToRemove;
            });
            jQuery('#removalist_data').val(y.join(','));
            jQuery(this).parent("li").remove();
        }
    });
    /**
     * Packer autocomplete.........................@DRCZ
     */
//    function split(val) {
//       // alert(val);
//        return val.split(/,\s*/);
//    }
//    function extractLast(item) {
//      //  alert(term);
//        return split(item).pop();
//    }
//        $( "#packersdata" )
//      // don't navigate away from the field on tab when selecting an item
//      .on( "keydown", function( event ) {
//        if ( event.keyCode === $.ui.keyCode.TAB &&
//            $( this ).autocomplete( "instance" ).menu.active ) {
//          event.preventDefault();
//        }
//      })
//      .autocomplete({
//   // jQuery("#packersdata").autocomplete({
//        
//        source: function (request, response) {
//           // alert("hii");
//            jQuery.ajax({
//                url: BASE_URL + "enquiries/getpackerid",
//                dataType: "json",
//                data: request,
//              //  data:{"term":extractLast(request.name)},
//                
//                success: function (data) {
//                     console.log(data);
//                    response($.map(data, function (item) {
//                       
//                            //  alert(data.length);
//                            return {
//                                label: item.name,
//                                value: item.id,
//                               // Name: item.Name
//                            };
//                        }));
//                     //response(data);
////                    response(data);
//                }
//            });
//        },
//        focus: function () {
//            // prevent value inserted on focus
//            return false;
//        },
//        minLength: 1,
//        select: function (event, ui) {
//          //  this.value = ui.item.label;
//           var item = split(this.value);
//          //  console.log(terms);
//            // remove the current input
//            item.pop();
//            // add the selected item
//            item.push(ui.item.value);
//            // add placeholder to get the comma-and-space at the end
//            item.push("");
//            this.value = item.join(", ");
//             return false;
////            if (window.console)
////                //  console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
////                this.value = ui.item.label;
////            jQuery(this).next("input").val(ui.item.value);
////            jQuery('#packer_data').val(ui.item.value);
////            event.preventDefault();
//            // jQuery(this).attr("data-selected", "true");
//        }
//    });

//    jQuery("#packersdata").autocomplete({
//        source: function (request, response) {
//           var movetype = jQuery("#enquirymovetype option:selected").val();
//
//            if (movetype == "4") {
//                var enqstate = jQuery("#movingfromstate").val();
//            } else if (movetype == "5") {
//                var enqstate = jQuery("#movingtostate").val();
//            }
//
//            $.ajax({
//                url: BASE_URL + "enquiries/getpackerid/" + enqstate,
//                dataType: "json",
//                data: request,
//                success: function (data) {
//                    if (data.items.length > 0) {
//                        response($.map(data.items, function (item) {
//                            return {
//                                label: item.name,
//                                value: item.id
//                            };
//                        }));
//                    } else {
//                        response([{label: 'No results found.', value: -1}]);
//                    }
////                    response(data);
//                }
//            });
//        },
//        minLength: 2,
//        select: function (event, ui) {
//            //alert(ui.item.value);
//            if (ui.item.value == "" || ui.item.value == -1) {
//                jQuery(this).val('');
//                return false;
//            }
//
//            this.value = ui.item.label;
////            jQuery(this).next("input").val(ui.item.value);
//
//            if (jQuery("ul.packer-listed li").hasClass("packer" + ui.item.value)) {
//
//            } else {
//                var packerIDs = ui.item.value;
//                packerIDs += "," + jQuery('#packer_data').val();
//                jQuery('#packer_data').val(packerIDs);
//                jQuery(".packer-listed").append("<li class='packer" + ui.item.value + "' data-id='" + ui.item.value + "'>" + ui.item.label + "<span class='fa fa-times rm-packer'></span></li>");
//            }
//            jQuery(this).val("");
//            event.preventDefault();
//            // jQuery(this).attr("data-selected", "true");
//        }
//    });

    /**
     * Packers autocomplete....................@DRCZ
     */
    jQuery("#packersdata").blur(function () {
        var packer_data = jQuery('#packer_data').val();
        if (packer_data == "") {
            jQuery('#packers').find('span.error').parent("label").remove();
            jQuery('#packers').addClass("has-error");
            jQuery("#packersdata-error").remove();
            jQuery(".packername").after("<span id=\"packersdata-error\" class=\"help-block help-block-error\">Packer is not exists in database.</span>");
        }else{
           jQuery('#packers').removeClass("has-error");
            jQuery("#packersdata-error").remove(); 
        }
        //   jQuery(this).val('');
        //   jQuery("#clientdata").val('');

    });
    jQuery.ui.autocomplete.prototype._renderItem = function (ul, item) {
        return $("<li>")
//                .attr("data-value", item.value)
                .append(item.label)
                .appendTo(ul);
    };
    jQuery("#packersdata").autocomplete({
        source: function (request, response) {
            var movetype = jQuery("#enquirymovetype option:selected").val();

            if (movetype == "4") {
                var enqstate = jQuery("#movingfromstate").val();
            } else if (movetype == "5") {
                var enqstate = jQuery("#movingtostate").val();
            }

            $.ajax({
                url: BASE_URL + "enquiries/getpackerid/" + enqstate,
                dataType: "json",
                data: request,
                success: function (data) {
                    if (data.items.length > 0) {
                        response($.map(data.items, function (item) {
                            return {
                                label: item.name,
                                value: item.id
                            };
                        }));
                    } else {
                        jQuery("#packer_data").val('');
                        response([{label: 'No results found.', value: -1}]);
                    }
//                    response(data);
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
//            if (ui.item.value == "" || ui.item.value == -1) {
//                jQuery(this).val('');
//                return false;
//            }
            if (ui.item.value == "" || ui.item.value == -1) {
                jQuery(this).val('');
                jQuery("#packer_data").val('');
                return false;
            }

            if (jQuery("ul.packer-listed li").hasClass("packer" + ui.item.value)) {

            } else {
                var packerIDs = ui.item.value;
                packerIDs += "," + jQuery('#packer_data').val();
                jQuery('#packer_data').val(packerIDs);
                jQuery(".packer-listed").append("<li class='packer" + ui.item.value + "' data-id='" + ui.item.value + "'>" + ui.item.label + "<span class='fa fa-times rm-packer'></span></li>");
            }
            jQuery(this).val("");
            event.preventDefault();


            /*if (window.console)
             //  console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
             this.value = ui.item.label;
             jQuery(this).next("input").val(ui.item.value);
             jQuery('#packer_data').val(ui.item.value);
             event.preventDefault();*/
            // jQuery(this).attr("data-selected", "true");
        }
    });

    jQuery("body").on("click", ".rm-packer", function () {
        if (confirm("Are you sure want to remove packer?")) {
            var packerIDs = jQuery('#packer_data').val().trim();
            var packerIDarray = packerIDs.split(",");
            var packerToRemove = jQuery(this).parent("li").data("id");
            var y = jQuery.grep(packerIDarray, function (value) {
                return value != packerToRemove;
            });
            jQuery('#packer_data').val(y.join(','));
            jQuery(this).parent("li").remove();
        }
    });
    $("#additionalCharges").click(function () {
        var addchage = $('en_additional_charges').val();
        if (addchage == "") {
            toastr.error('Additional item is required');
        }
    });


    $("#namedone, .input-close").click(function () {
        var fnames = $('#enfname').val();
        var fname = fnames.replace(/\s+/g, '');
        var lnames = $('#enlname').val();
        var lname = lnames.replace(/\s+/g, '');
        if (fname != '' && lname != '') {
            $('#enname').val(fname + ' ' + lname);
            jQuery(this).closest('.input-modal').hide();
            jQuery('.input-modal').find('.inmodal-error').hide();
            $('#enfname').val($('#enfname').val().replace(/\s+/g, ''));
            $('#enlname').val($('#enlname').val().replace(/\s+/g, ''));
        } else {
            $('#enname').val('');
            jQuery(this).closest('.input-modal').show();
            jQuery('.input-modal').find('.inmodal-error').show().addClass('eshadow').delay('1000').queue(function () {
                $(this).removeClass('eshadow').dequeue();
            });

        }
        //  $('#namedone').dialog('close');

    });

    /*$("#hamMargin").focus(function () {
        var sellprice = $('#totalsellprice').val();
        var costprice = $('#costprice').val();
        var ham = parseFloat(sellprice) - parseFloat(costprice);
        var price = ham.toFixed(2);
        $('#hamMargin').val(price);
    });*/
    
    $('#totalsellprice').blur(function () {
        var sellprice = $('#totalsellprice').val();
        var costprice = $('#costprice').val();
        if (costprice != "" && sellprice != "") {
            var ham = parseFloat(sellprice) - parseFloat(costprice);
            var price = ham.toFixed(2);
            $('#hamMargin').val(price);
        } else {
            $('#hamMargin').val("");
        }
    });
    $('#costprice').blur(function () {
        var sellprice = $('#totalsellprice').val();
        var costprice = $('#costprice').val();
        if (costprice != "" && sellprice != "") {
            var ham = parseFloat(sellprice) - parseFloat(costprice);
            var price = ham.toFixed(2);
            $('#hamMargin').val(price);
        } else {
            $('#hamMargin').val("");
        }
    });
     $('#travelfee').blur(function () {
        var travelfee = $('#travelfee').val();
        if (travelfee != "") {
            var travel = parseFloat(travelfee);
            var tprice = travel.toFixed(2);
            $('#travelfee').val(tprice);
        } else {
            $('#travelfee').val("");
        }
    });
    $('#depositamt').blur(function () {
        var depositamt = $('#depositamt').val();
        if (depositamt != "") {
            var damt = parseFloat(depositamt);
            var depoamt = damt.toFixed(2);
            $('#depositamt').val(depoamt);
        } else {
            $('#depositamt').val("");
        }
    });
    $('#clienthourlyrate').blur(function () {
        var clientrate = $('#clienthourlyrate').val();
        if (clientrate != "") {
            var clirate = parseFloat(clientrate);
            var chr = clirate.toFixed(2);
            $('#clienthourlyrate').val(chr);
        } else {
            $('#clienthourlyrate').val("");
        }
    });
    $('#additionalChargesinput').blur(function () {
        var addicharge = $('#additionalChargesinput').val();
        if (addicharge != "") {
            var ad = parseFloat(addicharge);
            var adc = ad.toFixed(2);
            $('#additionalChargesinput').val(adc);
        } else {
            $('#additionalChargesinput').val("");
        }
    });
    $('#totalsellprice').blur(function () {
        var totalprice = $('#totalsellprice').val();
        if (totalprice != "") {
            var tp = parseFloat(totalprice);
            var tprice = tp.toFixed(2);
            $('#totalsellprice').val(tprice);
        } else {
            $('#totalsellprice').val("");
        }
    });
    $('#costprice').blur(function () {
        var costprice = $('#costprice').val();
        if (costprice != "") {
            var cstprice = parseFloat(costprice);
            var cp = cstprice.toFixed(2);
            $('#costprice').val(cp);
        } else {
            $('#costprice').val("");
        }
    });
    $('#hamMargin').blur(function () {
        var hammargin = $('#hamMargin').val();
        if (hammargin != "") {
            var ham = parseFloat(hammargin);
            var hamm = ham.toFixed(2);
            $('#hamMargin').val(hamm);
        } else {
            $('#hamMargin').val("");
        }   
    });
    $('#hoursbooked').blur(function () {
        var hrbooked = $('#hoursbooked').val();
        if (hrbooked != "") {
            var hrb = parseFloat(hrbooked);
            var hrbook = hrb.toFixed(2);
            $('#hoursbooked').val(hrbook);
        } else {
            $('#hoursbooked').val("");
        }   
    });
    $('#sellprice').blur(function () {
        var sellprice = $('#sellprice').val();
        if (sellprice != "") {
            var sellP = parseFloat(sellprice);
            var sp = sellP.toFixed(2);
            $('#sellprice').val(sp);
        } else {
            $('#sellprice').val("");
        }   
    });

    /**
     * Delete enquiry..............@DRCZ
     */
    $("body").on("click", ".deleteenquiry", function () {
//$(".deleteenquiry").click(function () {
        if (confirm("Are you sure want to delete enquiry?")) {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'enquiries/deleteEnquiry/' + id,
                success: function (response) {
                    var res = JSON.parse(response);
                    //  console.log(res);
                    if (res.error) {
                        toastr.error('Something wrong.');
                    }
                    else if (res.expired) {
                        window.location = BASE_URL;
                    }
                    else {
                        toastr.success('Enquiry has been deleted.');
                        window.location = BASE_URL + "enquirieslist";
                    }
                }
            })
        }
    })
})



$("#enquirymovetype").change(function () {

    var data = $(this, ":selected").val();

    if (data == "1") {
        $("#storagedate").addClass('fhide');
        $("#deliveryDate").addClass('fhide');
        $("#deliveryDate").children().prop('disabled', true);
        $("#deliveryTime").addClass('fhide');
        $("#deliveryTime").children().prop('disabled', true);
        $("#storageProvider").addClass('fhide');
        $("#packers").addClass('fhide');
        $("#packers").children().prop('disabled', true);
        $("#packer_data").prop('disabled', true);
         $("#removalistSelection").removeClass('fhide');
        $("#removalistSelection").children().prop('disabled', false);
        $("#packerSelection").addClass('fhide');
        $("#packerSelection").children().prop('disabled', true);
        $("#packerUnpackerlbl").addClass('fhide');
        $("#packerlbl1").addClass('fhide');
        
        $("#travelFeeCost").addClass('fhide');
        $("#travelFeeCost").children().prop('disabled', true);
        $("#packingUnpackingPrice").addClass('fhide');

        $("#amountDueNow").addClass('fhide');
        $("#amountDueNow").children().prop('disabled', true);
        $("#storagePrice").addClass('fhide');
        $("#monthPayment").addClass('fhide');
        $("#payment_methods").addClass('fhide');
        $("#packingCompanyPaid").addClass('fhide');
        $("#ewayRefNo").removeClass('fhide');
        $("#EFTReceivedon").removeClass('fhide');
        $("#anniversarydate").addClass('fhide');
        $("#ewayrecurringPayment").addClass('fhide');
        $("#futurePaymentLog").addClass('fhide');
        $("#EWAYTOKEN").removeClass('fhide');

        $("#serviceDate").removeClass('fhide');
        $("#removealist1").removeClass('fhide');
        $("#removalist_data").prop('disabled', false);
        $("#removealist1").children().prop('disabled', false);
        $("#movingFromlbl").removeClass('fhide');
        $("#movingFromtxt").removeClass('fhide');
        $("#movingTolbl").removeClass('fhide');
        $("#movingTotxt").removeClass('fhide');
        $("#additionalPickuplbl").removeClass('fhide');
        $("#additionalPickuptxt").removeClass('fhide');
        $("#additionalDeliverylbl").removeClass('fhide');
        $("#additionalDeliverytxt").removeClass('fhide');
        $("#packingPrice").removeClass('fhide');
        $("#noOfTrucks").removeClass('fhide');
        $("#noOfTrucks").children().prop('disabled', false);
        $("#clientHourlyRate").removeClass('fhide');
        $("#clientHourlyRate").children().prop('disabled', false);
        $("#additionalItem").removeClass('fhide');
        $("#additionalItem").children().prop('disabled', false);
        $("#referralDetails").removeClass('fhide');
        $("#referralDetails").children().prop('disabled', false);
        $("#packingPriceInfo").removeClass('fhide');
        $("#depositReceive").removeClass('fhide');
        $("#depositPaidby").removeClass('fhide');
        $("#homeOffice").removeClass('fhide');

        $("#servicet").val('8am');
        $("#depositamt").val('50.00');
         $('select.select-mover').val('2');
       // $("#movers").val('2');
        $("#trucks").val('1');
        $("#travelfee").val('60.00');
        $("#clienthourlyrate").val('120.00');
        $("#hoursbooked").val('');
        $("#bookedladies").val('');
        $("#sellprice").val('');

    }else if(data == "2"){
        $("#storagedate").addClass('fhide');
        $("#deliveryDate").addClass('fhide');
        $("#deliveryDate").children().prop('disabled', true);
        $("#deliveryTime").addClass('fhide');
        $("#deliveryTime").children().prop('disabled', true);
        $("#storageProvider").addClass('fhide');
        $("#packers").addClass('fhide');
        $("#packers").children().prop('disabled', true);
        $("#packer_data").prop('disabled', true);
         $("#removalistSelection").removeClass('fhide');
        $("#removalistSelection").children().prop('disabled', false);
        $("#packerSelection").addClass('fhide');
        $("#packerSelection").children().prop('disabled', true);
        $("#packerUnpackerlbl").addClass('fhide');
        $("#packerlbl1").addClass('fhide');
        
        $("#travelFeeCost").addClass('fhide');
        $("#travelFeeCost").children().prop('disabled', true);
        $("#packingUnpackingPrice").addClass('fhide');

        $("#amountDueNow").addClass('fhide');
        $("#amountDueNow").children().prop('disabled', true);
        $("#storagePrice").addClass('fhide');
        $("#monthPayment").addClass('fhide');
        $("#payment_methods").addClass('fhide');
        $("#packingCompanyPaid").addClass('fhide');
        $("#ewayRefNo").removeClass('fhide');
        $("#EFTReceivedon").removeClass('fhide');
        $("#anniversarydate").addClass('fhide');
        $("#ewayrecurringPayment").addClass('fhide');
        $("#futurePaymentLog").addClass('fhide');
        $("#EWAYTOKEN").removeClass('fhide');

        $("#serviceDate").removeClass('fhide');
        $("#removealist1").removeClass('fhide');
        $("#removalist_data").prop('disabled', false);
        $("#removealist1").children().prop('disabled', false);
        $("#movingFromlbl").removeClass('fhide');
        $("#movingFromtxt").removeClass('fhide');
        $("#movingTolbl").removeClass('fhide');
        $("#movingTotxt").removeClass('fhide');
        $("#additionalPickuplbl").removeClass('fhide');
        $("#additionalPickuptxt").removeClass('fhide');
        $("#additionalDeliverylbl").removeClass('fhide');
        $("#additionalDeliverytxt").removeClass('fhide');
        $("#packingPrice").removeClass('fhide');
        $("#noOfTrucks").removeClass('fhide');
        $("#noOfTrucks").children().prop('disabled', false);
        $("#clientHourlyRate").removeClass('fhide');
        $("#clientHourlyRate").children().prop('disabled', false);
        $("#additionalItem").removeClass('fhide');
        $("#additionalItem").children().prop('disabled', false);
        $("#referralDetails").removeClass('fhide');
        $("#referralDetails").children().prop('disabled', false);
        $("#packingPriceInfo").removeClass('fhide');
        $("#depositReceive").removeClass('fhide');
        $("#depositPaidby").removeClass('fhide');
        $("#homeOffice").removeClass('fhide');
        
        $("#servicet").val('8am');
        $("#depositamt").val('50.00');
        $('select.select-mover').val('3');
       // $("#movers").val('3');
        $("#trucks").val('1');
        $("#travelfee").val('80.00');
        $("#clienthourlyrate").val('160.00');
        $("#hoursbooked").val('');
        $("#bookedladies").val('');
        $("#sellprice").val('');
    } else if (data == "3") {
        $("#serviceDate").removeClass('fhide');
        $("#deliveryDate").removeClass('fhide');
        $("#deliveryDate").children().prop('disabled', false);
        $("#deliveryTime").removeClass('fhide');
        $("#deliveryTime").children().prop('disabled', false);
        $("#storageProvider").addClass('fhide');
        $("#removealist1").removeClass('fhide');
        $("#removalist_data").prop('disabled', false);
        $("#removealist1").children().prop('disabled', false);

        $("#movingFromlbl").removeClass('fhide');
        $("#movingFromtxt").removeClass('fhide');
        $("#movingTolbl").removeClass('fhide');
        $("#movingTotxt").removeClass('fhide');
        $("#additionalPickuplbl").removeClass('fhide');
        $("#additionalPickuptxt").removeClass('fhide');
        $("#additionalDeliverylbl").removeClass('fhide');
        $("#additionalDeliverytxt").removeClass('fhide');

        $("#packingPrice").removeClass('fhide');
        $("#travelFeeCost").removeClass('fhide');
        $("#travelFeeCost").children().prop('disabled', false);
        $("#amountDueNow").removeClass('fhide');
        $("#amountDueNow").children().prop('disabled', false);
        $("#referralDetails").removeClass('fhide');
        $("#referralDetails").children().prop('disabled', false);
        $("#packingPriceInfo").removeClass('fhide');
        $("#depositReceive").removeClass('fhide');
        $("#depositPaidby").removeClass('fhide');
        $("#packingCompanyPaid").addClass('fhide');
        $("#homeOffice").removeClass('fhide');

        $("#storagedate").addClass('fhide');
        $("#packers").addClass('fhide');
        $("#packers").children().prop('disabled', true);
        $("#packer_data").prop('disabled', true);
         $("#removalistSelection").removeClass('fhide');
        $("#removalistSelection").children().prop('disabled', false);
        $("#packerSelection").addClass('fhide');
        $("#packerSelection").children().prop('disabled', true);
        $("#packerUnpackerlbl").addClass('fhide');
        $("#packerlbl1").addClass('fhide');
        
        $("#noOfTrucks").addClass('fhide');
        $("#noOfTrucks").children().prop('disabled', true);
        $("#clientHourlyRate").addClass('fhide');
        $("#clientHourlyRate").children().prop('disabled', true);
        $("#packingUnpackingPrice").addClass('fhide');

        $("#additionalItem").addClass('fhide');
        $("#additionalItem").children().prop('disabled', true);
        $("#storagePrice").addClass('fhide');
        $("#monthPayment").addClass('fhide');
        $("#payment_methods").addClass('fhide');
        $("#ewayRefNo").removeClass('fhide');
        $("#EFTReceivedon").removeClass('fhide');
        $("#anniversarydate").addClass('fhide');
        $("#ewayrecurringPayment").addClass('fhide');
        $("#futurePaymentLog").addClass('fhide');
        $("#EWAYTOKEN").removeClass('fhide');

        $("#servicet").val('8am');
        $("#depositamt").val('50.00');
        $("#movers").val('2');
        $("#trucks").val('1');
        $("#travelfee").val('60.00');
        $("#clienthourlyrate").val('120.00');
        $("#hoursbooked").val('');
        $("#bookedladies").val('');
        $("#sellprice").val('');
    } else if (data == "4") {

        $("#storagedate").addClass('fhide');
        $("#deliveryDate").addClass('fhide');
        $("#deliveryDate").children().prop('disabled', true);
        $("#deliveryTime").addClass('fhide');
        $("#deliveryTime").children().prop('disabled', true);
        $("#storageProvider").addClass('fhide');
        $("#removealist1").addClass('fhide');
        $("#removalist_data").prop('disabled', true);
        $("#removealist1").children().prop('disabled', true);
        $("#movingFromlbl").addClass('fhide');

        $("#movingTolbl").addClass('fhide');
        $("#movingTotxt").addClass('fhide');
        $("#additionalPickuplbl").addClass('fhide');
        $("#additionalPickuptxt").addClass('fhide');
        $("#additionalDeliverylbl").addClass('fhide');
        $("#additionalDeliverytxt").addClass('fhide');

        $("#packingPrice").addClass('fhide');
        $("#travelFeeCost").addClass('fhide');
        $("#travelFeeCost").children().prop('disabled', true);
        $("#amountDueNow").addClass('fhide');
        $("#amountDueNow").children().prop('disabled', true);
        $("#referralDetails").addClass('fhide');
        $("#storagePrice").addClass('fhide');
        $("#monthPayment").addClass('fhide');
        $("#payment_methods").addClass('fhide');
        $("#ewayRefNo").removeClass('fhide');
        $("#EFTReceivedon").removeClass('fhide');
        $("#anniversarydate").addClass('fhide');
        $("#ewayrecurringPayment").addClass('fhide');
        $("#futurePaymentLog").addClass('fhide');
        $("#EWAYTOKEN").addClass('fhide');

        $("#serviceDate").removeClass('fhide');
        $("#packers").removeClass('fhide');
        $("#packers").children().prop('disabled', false);
        $("#packer_data").prop('disabled', false);
        $("#removalistSelection").addClass('fhide');
        $("#removalistSelection").children().prop('disabled', true);
        $("#packerSelection").removeClass('fhide');
        $("#packerSelection").children().prop('disabled', false);
        $("#packerUnpackerlbl").removeClass('fhide');
        $("#packerlbl1").addClass('fhide');
        $("#movingFromtxt").removeClass('fhide');


        $("#noOfTrucks").removeClass('fhide');
        $("#noOfTrucks").children().prop('disabled', false);
        $("#clientHourlyRate").removeClass('fhide');
        $("#clientHourlyRate").children().prop('disabled', false);
        $("#packingUnpackingPrice").removeClass('fhide');
        $("#packingCompanyPaid").removeClass('fhide');
        $("#additionalItem").removeClass('fhide');
        $("#additionalItem").children().prop('disabled', false);
        $("#packingPriceInfo").removeClass('fhide');
        $("#depositReceive").removeClass('fhide');
        $("#depositPaidby").removeClass('fhide');

        $("#servicet").val('9am-1pm');
        $("#hoursbooked").val('4.00');
        $("#bookedladies").val('2');
        $("#sellprice").val('400.00');
        $("#depositamt").val('');
        $("#movers").val('');
        $("#trucks").val('');
        $("#travelfee").val('');
        $("#clienthourlyrate").val('');

    } else if (data == "5") {
        $("#storagedate").addClass('fhide');
        $("#deliveryDate").addClass('fhide');
        $("#deliveryDate").children().prop('disabled', true);
        $("#deliveryTime").addClass('fhide');
        $("#deliveryTime").children().prop('disabled', true);
        $("#storageProvider").addClass('fhide');
        $("#removealist1").addClass('fhide');
        $("#removalist_data").prop('disabled', true);
        $("#removealist1").children().prop('disabled', true);

        $("#movingFromlbl").addClass('fhide');
        $("#movingFromtxt").addClass('fhide');
        $("#movingTolbl").addClass('fhide');
        $("#additionalPickuplbl").addClass('fhide');
        $("#additionalPickuptxt").addClass('fhide');
        $("#additionalDeliverylbl").addClass('fhide');
        $("#additionalDeliverytxt").addClass('fhide');

        $("#packingPrice").addClass('fhide');

        $("#travelFeeCost").addClass('fhide');
        $("#travelFeeCost").children().prop('disabled', true);
        $("#amountDueNow").addClass('fhide');
        $("#amountDueNow").children().prop('disabled', true);
        $("#referralDetails").addClass('fhide');
        $("#storagePrice").addClass('fhide');
        $("#monthPayment").addClass('fhide');
        $("#payment_methods").addClass('fhide');
        $("#ewayRefNo").removeClass('fhide');
        $("#EFTReceivedon").removeClass('fhide');
        $("#anniversarydate").addClass('fhide');
        $("#ewayrecurringPayment").addClass('fhide');
        $("#futurePaymentLog").addClass('fhide');
        $("#EWAYTOKEN").addClass('fhide');

        $("#serviceDate").removeClass('fhide');
        $("#packers").removeClass('fhide');
        $("#packer_data").prop('disabled', false);
        $("#packers").children().prop('disabled', false);
         $("#removalistSelection").addClass('fhide');
        $("#removalistSelection").children().prop('disabled', true);
        $("#packerSelection").removeClass('fhide');
        $("#packerSelection").children().prop('disabled', false);
        $("#packerUnpackerlbl").addClass('fhide');
        $("#packerlbl1").removeClass('fhide');
        $("#movingTotxt").removeClass('fhide');

        $("#noOfTrucks").removeClass('fhide');
        $("#noOfTrucks").children().prop('disabled', false);
        $("#clientHourlyRate").removeClass('fhide');
        $("#clientHourlyRate").children().prop('disabled', false);
        $("#packingUnpackingPrice").removeClass('fhide');

        $("#additionalItem").removeClass('fhide');
        $("#additionalItem").children().prop('disabled', false);
        $("#packingPriceInfo").removeClass('fhide');
        $("#depositReceive").removeClass('fhide');
        $("#depositPaidby").removeClass('fhide');
        $("#packingCompanyPaid").removeClass('fhide');

        $("#servicet").val('9am-1pm');
        $("#hoursbooked").val('4.00');
        $("#bookedladies").val('2');
        $("#sellprice").val('400.00');
        $("#depositamt").val('');
        $("#movers").val('');
        $("#trucks").val('');
        $("#travelfee").val('');
        $("#clienthourlyrate").val('');
    } else if (data == "6") {
        $("#serviceDate").addClass('fhide');
        $("#deliveryDate").addClass('fhide');
        $("#deliveryDate").children().prop('disabled', true);
        $("#deliveryTime").addClass('fhide');
        $("#deliveryTime").children().prop('disabled', true);
        $("#removealist1").addClass('fhide');
        $("#removalist_data").prop('disabled', true);
        $("#removealist1").children().prop('disabled', true);
        $("#packers").addClass('fhide');
        $("#packers").children().prop('disabled', true);
        $("#packer_data").prop('disabled', true);
         $("#removalistSelection").addClass('fhide');
        $("#removalistSelection").children().prop('disabled', true);
        $("#packerSelection").addClass('fhide');
        $("#packerSelection").children().prop('disabled', true);

        $("#packerUnpackerlbl").addClass('fhide');
         $("#packerlbl1").addClass('fhide');
        $("#additionalPickuplbl").addClass('fhide');
        $("#additionalPickuptxt").addClass('fhide');
        $("#additionalDeliverylbl").addClass('fhide');
        $("#additionalDeliverytxt").addClass('fhide');
        $("#packingPrice").addClass('fhide');
        $("#travelFeeCost").addClass('fhide');
        $("#travelFeeCost").children().prop('disabled', true);
        $("#packingUnpackingPrice").addClass('fhide');
        $("#packingCompanyPaid").addClass('fhide');
        $("#amountDueNow").addClass('fhide');
        $("#amountDueNow").children().prop('disabled', true);
        $("#referralDetails").addClass('fhide');
        $("#packingPriceInfo").addClass('fhide');
        $("#depositReceive").addClass('fhide');
        $("#depositPaidby").addClass('fhide');



        $("#storagedate").removeClass('fhide');
        $("#storageProvider").removeClass('fhide');
        $("#storagePrice").removeClass('fhide');
        $("#movingFromlbl").removeClass('fhide');
        $("#movingFromtxt").removeClass('fhide');
        $("#movingTolbl").removeClass('fhide');
        $("#movingTolbl").removeClass('fhide');
        $("#monthPayment").removeClass('fhide');

        $("#payment_methods").removeClass('fhide');
        $("#ewayRefNo").removeClass('fhide');
        $("#EFTReceivedon").removeClass('fhide');
        $("#anniversarydate").removeClass('fhide');
        $("#ewayrecurringPayment").removeClass('fhide');
        $("#futurePaymentLog").removeClass('fhide');
        $("#EWAYTOKEN").addClass('fhide');


        $("#servicet").val('');
        $("#depositamt").val('');
        $("#movers").val('');
        $("#trucks").val('');
        $("#travelfee").val('');
        $("#clienthourlyrate").val('');
        $("#hoursbooked").val('');
        $("#bookedladies").val('');
        $("#sellprice").val('');
    } else {
        $("#storagedate").addClass('fhide');
        $("#deliveryDate").addClass('fhide');
        $("#deliveryDate").children().prop('disabled', true);
        $("#deliveryTime").addClass('fhide');
        $("#deliveryTime").children().prop('disabled', true);
        $("#storageProvider").addClass('fhide');
        $("#packers").addClass('fhide');
        $("#packers").children().prop('disabled', true);
        $("#packerSelection").addClass('fhide');
        $("#packerSelection").children().prop('disabled', true);

        $("#packerUnpackerlbl").addClass('fhide');
        $("#travelFeeCost").addClass('fhide');
        $("#travelFeeCost").children().prop('disabled', true);
        $("#packingUnpackingPrice").addClass('fhide');
        $("#packingCompanyPaid").addClass('fhide');
        $("#amountDueNow").addClass('fhide');
        $("#amountDueNow").children().prop('disabled', true);
        $("#storagePrice").addClass('fhide');


        $("#serviceDate").removeClass('fhide');
        $("#removealist").removeClass('fhide');
        $("#removealist").children().prop('disabled', false);
        $("#movingFromlbl").removeClass('fhide');
        $("#packingPrice").removeClass('fhide');
        $("#noOfTrucks").removeClass('fhide');
        $("#noOfTrucks").children().prop('disabled', false);
        $("#clientHourlyRate").removeClass('fhide');
        $("#clientHourlyRate").children().prop('disabled', false);
        $("#additionalItem").removeClass('fhide');
        $("#additionalItem").children().prop('disabled', false);
        $("#referralDetails").removeClass('fhide');
        $("#referralDetails").children().prop('disabled', false);
        $("#packingPriceInfo").removeClass('fhide');
        $("#homeOffice").removeClass('fhide');


        $("#servicet").val('');
        $("#depositamt").val('');
        $("#movers").val('');
        $("#trucks").val('');
        $("#travelfee").val('');
        $("#clienthourlyrate").val('');
        $("#hoursbooked").val('');
        $("#bookedladies").val('');
        $("#sellprice").val('');
    }
}).trigger("change");

//Add New Contact.............................

var Contact = function () {

    var handleContact = function () {

        var contactForm = $('#contact-form');
        var error1 = $('.alert-danger', contactForm);
        var success1 = $('.alert-success', contactForm);
        contactForm.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                contact_reltype: {
                    required: true
                },
                contact_fname: {
                    required: true,
                    maxlength: 15
                },
                contact_lname: {
                    required: true,
                    maxlength: 15
                },
                contact_email: {
                    required: true,
                    email: true

                },
                contact_phno: {
                    number: true
                },
                contact_state: {
                    required: true
                }
            },
            messages: {
                contact_reltype: {
                    required: "Relationship type is required."
                },
                contact_fname: {
                    required: "First name is required."
                },
                contact_lname: {
                    required: "Last name is required."
                },
                contact_email: {
                    required: "Email is required."
                },
                contact_phno: {
                    number: "Enter only numaric value."
                },
                contact_state: {
                    required: "State is required."
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit   

            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function (error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            submitHandler: function (form) {
                var formData = jQuery("#contact-form").serializeArray();
                ajaxContact(formData);
            }
        });

        $('#contact-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#contact-form').validate().form()) {
                    var formData = jQuery("#contact-form").serializeArray();
                    ajaxContact(formData);
                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleContact();
        }
    };
}();

jQuery(document).ready(function () {
    Contact.init();
});



function ajaxContact(formData) {

    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "contacts/add_contact",
        data: formData,
        success: function (response) {
            var res = JSON.parse(response);
            if (res.error) {
                jQuery(".alert-danger").show();
                jQuery(".alert-danger").html(res.error);
            }
            else if (res.expired) {
                        window.location = BASE_URL;
                    }
            else {
                toastr.success('Contact has been inserted succefully');
//                jQuery(".alert-success").show();
                jQuery("#contact-form").trigger('reset');
                setTimeout(function () {
                    jQuery("#new-people").modal("hide");
                }, 2000);
            }
        }
    })
}


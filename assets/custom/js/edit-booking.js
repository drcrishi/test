var Booking = function () {

    var handleBooking = function () {

        var bookingForm = $('#booking-form');
        var error1 = $('.alert-danger', bookingForm);
        var success1 = $('.alert-success', bookingForm);
        bookingForm.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                booking_status: {
                    required: true
                },
                en_home_office: {
                    required: true
                },
//                contact_data: {
//                    required: true
//                },
                en_servicedate: {
                    regxdate: /\d{2}(\.|-)\d{2}(\.|-)\d{4}/,
                },
                en_servicetime: {
                    required: true,
                },
                en_phone: {
                    required: true,
                    regx: /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/,
                },
                en_email: {
                    required: true,
                    email: true
                },
//                removalist_name: {
//                    required: function (element) {
//                        if (jQuery("#removalist_data").val() == "") {
//                            return true;
//                        } else {
//                            return false;
//                        }
//                    }
//                },
//                packers_data: {
//                    required: function (element) {
//                        if (jQuery("#packer_data").val() == "") {
//                            return true;
//                        } else {
//                            return false;
//                        }
//                    }
//                },
                en_movingfrom_postcode: {
                    number: true,
                    maxlength: 4
                },
                en_movingfrom_state: {
                    required: true
                },
                notes_attachedfile: {
                    accept: "image/jpg,image/png,image/jpeg,image/gif,image/JPG,image/PNG,image/JPEG,image/GIF"
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
                en_storage_provider:{
                    required: true
                },
                en_storagedate:{
                    required: true
                },
                photoIdReceived:{
                    required: true
                },
                serviceTimeStartHour: {
                    required: true
                },
                serviceTimeEndHour: {
                    required: true
                },
                en_additional_item: {
                    required: function (element) {
                        var movetype = jQuery("#enquirymovetype option:selected").val();

                        if (movetype == "4" || movetype == "7" || movetype == "5" || movetype == "8") {
                            if ($('.additional-charges-packer').val() != '' && $('.additional-charges-packer').val() != "0.00") {
                                return true;
                            } else {
//                            element.closest('.form-group').removeClass('has-error');
                                return false;
                            }
                        } else {
                            if ($('#additionalChargesinput').val() != '') {
                                return true;
                            } else {
//                            element.closest('.form-group').removeClass('has-error');
                                return false;
                            }
                        }
                    }
                },      
                storageAgreementRecieved:{      
                required: true,     
                }
            },
            messages: {
                booking_status: {
                    required: "Booking status is required."
                },
                en_home_office: {
                    required: "Home/Office is required."
                },
//                contact_data: {
//                    required: "Client name is required or not exists in database."
//                },
//                removalist_name: {
//                    required: "Removalist is required."
//                },
//                packers_data: {
//                    required: "Packers is required."
//                },
                en_movingfrom_state: {
                    required: "Moving from state is required."
                },
                en_movingto_state: {
                    required: "Moving to state is required."
                },
                en_phone: {
                    number: "Enter only digits."
                },
                en_email: {
                    required: "Email is required.",
                    email: "Email is not correct."
                },
                notes_attachedfile: {
                    accept: "Only accept png,jpg,jpeg,gif extension files."
                },
                en_servicedate: {
                    regxdate: /\d{2}(\.|-)\d{2}(\.|-)\d{4}/,
                },
                en_deliverydate: {
                    regxdate: /\d{2}(\.|-)\d{2}(\.|-)\d{4}/,
                },
                en_storagedate: {
                    regxdate: /\d{2}(\.|-)\d{2}(\.|-)\d{4}/,
                },
                en_servicetime: {
                    required: "Service time is required."
                },
                en_movingfrom_postcode: {
                    number: "Enter only 4 digits."
                },
                en_movingto_postcode: {
                    number: "Enter only 4 digits."
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
                },
                en_storage_provider:{
                    required: "Storage Provider is Required"
                },
                en_storagedate:{
                    required: "Storage Date is Required"
                },
                photoIdReceived:{
                    required: "Photo Id Received field is Required" 
                },
                en_eft_receivedon: {
                    regxdate: /\d{2}(\.|-)\d{2}(\.|-)\d{4}/,
                },
                final_payment_eft_payment: {
                    regxdate: /\d{2}(\.|-)\d{2}(\.|-)\d{4}/,
                },
                storageAgreementRecieved:{
                    required: "Required",
                },
                serviceTimeStartHour: {
                    required: "Service Start Time is required.",
                },
                serviceTimeEndHour: {
                    required: "Service End Time is required.",
                },
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
                } 
                else if (element.attr("name") == "serviceTimeStartHour"){
                    error.insertAfter('#serviceStartRow');
                }
                else if (element.attr("name") == "serviceTimeEndHour"){
                    error.insertAfter('#serviceEndRow');
                }
                else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            submitHandler: function (form) {
                var formData = jQuery(form).serializeArray();
                ajaxBooking(new FormData(form));
                // ajaxBooking(formData);
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
        $('#booking-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#booking-form').validate().form()) {
                    var formData = jQuery("#booking-form")[0];
                    ajaxBooking(new FormData(formData));
//                    var formData = jQuery("#booking-form").serializeArray();
//                    ajaxBooking(formData);
                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleBooking();
        }
    };
}();

jQuery(document).ready(function () {
    Booking.init();
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
    $("#finaleftpayment").datepicker({
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

    jQuery("#storageReminderDate").datepicker({
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

function ajaxBooking(formData) {
    /*If we enter 4 removalists and put a hourly rate of less than $240, Put warning..............@DRCZ*/
    var movers = $('#movers').val();
    var chr = $('#clienthourlyrate').val();
//     if (movers == '4' && chr < '240') {
//         toastr.warning('Normal price for 4 men is $240');
// //        return false;
//     }
    /*If we enter 4 removalists and put a hourly rate of less than $240, Put warning..............@DRCZ*/
    /**
     * Edit enquiry data......................@DRCZ
     */
    var removalist = jQuery("#removalist_data").val();
    var packer_data = jQuery('#packer_data').val();
    var clientdata = jQuery("#clientdata").val();
    var movetype = jQuery("#enquirymovetype option:selected").val();
//    if (movetype == '1' || movetype == '2' || movetype == '3') {
//        if (removalist == "") {
//            jQuery('#removalist').find('span.error').parent("label").remove();
//            jQuery('#removalist').addClass("has-error");
//            jQuery(".remname").after("<span id=\"removalist-error\" class=\"help-block help-block-error\">Removalist is not exists in database.</span>");
//            return false;
//        }
//    }
//    if (movetype == '4' || movetype == '5') {
//        if (packer_data == "") {
//            jQuery('#packersdata').find('span.error').parent("label").remove();
//            jQuery('#packersdata').addClass("has-error");
//            jQuery(".packername").after("<span id=\"packersdata-error\" class=\"help-block help-block-error\">Packer is not exists in database.</span>");
//            return false;
//        }
//    }
//    if (clientdata == "") {
//        jQuery('#client').find('span.error').parent("label").remove();
//        jQuery('#client').addClass("has-error");
//        //<span id="customerId-error" class="help-block help-block-error">Client name is required or not exists in database.</span>
//        jQuery("#customerId").after("<span id=\"customerId-error\" class=\"help-block help-block-error\">Client name is required or not exists in database.</span>");
//        return false;
//    }
    $(".ajaxLoader").show();
    jQuery.ajax({
        type: 'POST',
//        processData: false,
//        contentType: false,
        url: BASE_URL + "booking/editBookingData",
        data: jQuery("#booking-form").serializeArray(),
        success: function (response) {

            $(".ajaxLoader").hide();
            var res = JSON.parse(response);
            if (res.error) {
                jQuery(".alert-danger").show();
                jQuery(".alert-danger").html(res.error);
            } else if (res.expired) {
                window.location = BASE_URL;
            } else {
                if (res.success == 1) {

                    toastr.success('Data Updated successfully');
                    jQuery('#removalist').find('span.error').remove();
                    jQuery('#client').find('span.error').remove();
                    jQuery('#note-title').val('');
                    jQuery('#note-area').val('');
                    jQuery('#note-attachfile').val('');
//                window.location = BASE_URL + "enquirieslist";
//                jQuery("#enquiry-form").trigger('reset');
                }
                if (res.success == 2) {
                    toastr.success('Data Updated successfully');
                }

            }
        }

    })

}
jQuery(document).ready(function () {

    jQuery(".additional-charges-packer-section").hide();

    jQuery(".add_field_button_packers").click(function () {
        jQuery(".additional-charges-packer-section").toggle(1000);
    });

    jQuery('body').on('click', '.close-notes', function () {
        if (confirm("Are you sure want to delete note?")) {
            jQuery(this).closest('.activity-item').remove();
            var id = jQuery(this).data('id');
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'booking/deleteNotes/' + id,
                success: function (response) {
                    var res = JSON.parse(response);

                    if (res.error) {
                        toastr.error('Something wrong.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    } else {
                        toastr.success('Notes has been deleted.');
                        // window.location = BASE_URL + "enquirieslist";
                    }
                }
            })
        }
    });

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
                //  console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
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

    jQuery("#en_storage_provider_suburb").autocomplete({
        close: function (event, ui) {
            var suburbstr = jQuery("#en_storage_provider_suburb").val();
            var suburbarr = suburbstr.split(",");
            jQuery('#en_storage_provider_postcode').val(suburbarr[1].trim());
            jQuery('#en_storage_provider_state').val(suburbarr[2].trim());
            jQuery('#en_storage_provider_suburb').val(suburbarr[0].trim());
            jQuery("#en_storage_provider_suburb").trigger('change');
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
     * Suburb autocomplete.............................@DRCZ
     */

    $(".deletebooking").click(function () {
        if (confirm("Are you sure want to delete booking?")) {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'enquiries/deleteEnquiry/' + id,
                success: function (response) {
                    var res = JSON.parse(response);

                    if (res.error) {
                        toastr.error('Something wrong.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    } else {
                        toastr.success('Booking has been deleted.');
                        window.location = BASE_URL + "bookinglist";
                    }
                }
            })
        }
    })
    $(".disQualify").click(function () {
        if (confirm("Are you sure want to disqualify booking?")) {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'enquiries/disQualifyBooking/' + id,
                success: function (response) {
                    var res = JSON.parse(response);

                    if (res.error) {
                        toastr.error('Something wrong.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    } else {
                        toastr.success('Booking has been Disqualified.');
                        window.location = BASE_URL + "bookinglist";
                    }
                }
            })
        }
    })


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
        } else {
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
            jQuery('#packer_data').val('');
            jQuery('#removalist_data').val(y.join(','));
            jQuery(this).parent("li").remove();
        }
    });
    /**
     * Client autocomplete....................@DRCZ
     */
    jQuery("#customerId").blur(function () {
        var clientId = jQuery("#clientdata").val();
        if (clientId == "") {
            jQuery('#client').find('span.error').parent("label").remove();
            jQuery('#client').addClass("has-error");
            jQuery("#customerId-error").remove();
            jQuery("#customerId").after("<span id=\"customerId-error\" class=\"help-block help-block-error\">Client name not exists in database.</span>");
        } else {
            jQuery('#client').removeClass("has-error");
            jQuery("#customerId-error").remove();
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
    jQuery("#customerId").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: BASE_URL + "booking/getCustomerid",
                dataType: "json",
                data: request,
                success: function (data) {
                    if (data.items.length > 0) {
                        response($.map(data.items, function (item) {
                            return {
                                label: item.name,
                                value: item.id,
                                emailv: item.email,
                                ph: item.phno
                            };
                        }));
                    } else {
                        jQuery("#clientdata").val('');
                        response([{label: 'No results found.', value: -1}]);
                    }

//                    response(data);
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            // if (ui.item.value == "" || ui.item.value == -1) {
            if (ui.item.value == "") {
                jQuery(this).val('');
                jQuery("#clientdata").val('');
                return false;
            }
            if (window.console)
                //   console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                this.value = ui.item.label;
            this.value = ui.item.label.replace("<br/>", " ");
            this.value = this.value.replace("<br/>", " ");
            jQuery(this).next("input").val(ui.item.value);
            jQuery('#clientdata').val(ui.item.value);
            jQuery('#bookingEmail').val(ui.item.emailv);
            jQuery('#bookingPhone').val(ui.item.ph);
            event.preventDefault();
            // jQuery(this).attr("data-selected", "true");
        }

    });


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
        } else {
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

            if (movetype == "4" || movetype == "7") {
                var enqstate = jQuery("#movingfromstate").val();
            } else if (movetype == "5" || movetype == "8") {
                var enqstate = jQuery("#movingtostate").val();
            }

            $.ajax({
                url: BASE_URL + "booking/getpackerid/" + enqstate,
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
                        // jQuery("#packer_data").val('');
                        jQuery("#packersdata").val('');
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
                jQuery("#packersdata").val('');
                // jQuery("#packer_data").val('');
                return false;
            }
            jQuery("#packersdata").val('');
            if (jQuery("ul.packer-listed li").hasClass("packer" + ui.item.value)) {

            } else {
                var packerIDs = ui.item.value;
                packerIDs += "," + jQuery('#packer_data').val();
                jQuery('#packer_data').val(packerIDs);
                jQuery(".packer-listed").append("<li class='packer" + ui.item.value + "' data-id='" + ui.item.value + "'>" + ui.item.label + "<span class='fa fa-times rm-packer'></span></li>");
                var packerHoursBooked= parseFloat(jQuery("#hoursbooked").val()).toFixed(2);
                jQuery("#packer_hours").append('<div class="form-group packer-div-'+ ui.item.value +'"><label class="control-label col-md-6 packer-name-label">'+ ui.item.label +'</label><div class="col-md-6"><input type="hidden" class="packer-name" name="packer-name[]" value="'+ ui.item.value +'"><input type="text" class="form-control packer-name-text" name="packer-hours[]" value="'+ packerHoursBooked +'"></div></div>');
                jQuery("#packer_hours_non_billable").append('<div class="form-group non-billable-packer-div-'+ ui.item.value +'"><label class="control-label col-md-6 packer-name-label">'+ ui.item.label +'</label><div class="col-md-6"><input type="hidden" name="non-billable-packer-name[]" value="'+ ui.item.value +'"><input type="text" class="form-control non-billable-packer-name-text" name="non-billable-packer-hours[]" value="0.00"></div></div>');
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
            jQuery(".packer-div-"+packerToRemove).remove();
            jQuery(".non-billable-packer-div-"+packerToRemove).remove();
            var y = jQuery.grep(packerIDarray, function (value) {
                return value != packerToRemove;
            });
            jQuery('#packer_data').val(y.join(','));
            jQuery(this).parent("li").remove();
            jQuery('#hoursbooked').trigger('change');
            // jQuery(".packer-div-"+packerToRemove).remove();
        }
    });

    /*$("#hamMargin").focus(function () {
     var sellprice = $('#totalsellprice').val();
     var costprice = $('#costprice').val();
     var ham = parseFloat(sellprice) - parseFloat(costprice);
     var price = ham.toFixed(2);
     $('#hamMargin').val(price);
     });*/

    /*If we enter 4 removalists and put a hourly rate of less than $240, Put warning..............@DRCZ*/
    $("#clienthourlyrate").blur(function () {
        var movers = $('#movers').val();
        var chr = $('#clienthourlyrate').val();
        // if (movers == '4' && chr < '240') {
        //     toastr.warning('Normal price for 4 men is $240');
        // }
    });
    /*If we enter 4 removalists and put a hourly rate of less than $240, Put warning..............@DRCZ*/

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
    $('#sellprice').change(function () {
        var sellprice = $('#sellprice').val();
        var initialHoursBooked = $("#hoursbooked").val();
        var noOfLadiesBooked = $("#bookedladies").val();
        if (sellprice != "") {
            var sellP = parseFloat(sellprice);
            var sp = sellP.toFixed(2);
            $('#sellprice').val(sp);
            // $("#costprice").val(initialHoursBooked * noOfLadiesBooked * parseFloat(32.85));
            $("#costprice").trigger('blur');
        } else {
            $('#sellprice').val("");
        }
    });

    /* Auto calculation of sellprice for Packing/Unpacking.......@DRCZ */
// $("#sellprice").blur(function () {
//        
//        var hrbook = $('#hoursbooked').val();
//        var ladies = $('#bookedladies').val();
//        if (hrbook != "" && ladies != "") {
//            var totalsell = (hrbook * ladies * 50)+'.00';
//            $('#sellprice').val(totalsell);
//        } else {
//            $('#sellprice').val("");
//        }
//    });
    $("#hoursbooked").change(function () {

        var hrbook = $('#hoursbooked').val();
        var ladies = $('#bookedladies').val();
        // if (hrbook != "" && ladies != "") {
        //     var totalsell = (hrbook * ladies * 60) + '.00';
        //     var additionalCharges = parseFloat($(".additional-charges-packer").val());
        //     if (!isNaN(additionalCharges)) {
        //         totalsell = parseFloat(totalsell);
        //         totalsell += additionalCharges;
        //         totalsell = totalsell.toFixed(2);
        //     }
        //     $('#sellprice').val(totalsell);
        //     jQuery('#totalsellprice').val(totalsell);
        //     jQuery("#costprice").val((parseFloat(hrbook) * parseFloat(ladies) * (parseFloat(32.85))).toFixed(2));
        //     jQuery("#costprice").trigger('blur');
        // } else {
        //     $('#sellprice').val("");
        // }
        // console.log(hrbook);
        jQuery(".packer-name-text").val(hrbook);
    });
    $("#bookedladies").change(function () {

        // var hrbook = $('#hoursbooked').val();
        // var ladies = $('#bookedladies').val();
        // if (hrbook != "" && ladies != "") {
        //     var totalsell = (hrbook * ladies * 60) + '.00';
        //     var additionalCharges = parseFloat($(".additional-charges-packer").val());
        //     if (!isNaN(additionalCharges)) {
        //         totalsell = parseFloat(totalsell);
        //         totalsell += additionalCharges;
        //         totalsell = totalsell.toFixed(2);
        //     }
        //     $('#sellprice').val(totalsell);
        //     jQuery('#totalsellprice').val(totalsell);
        //     jQuery("#costprice").val((parseFloat(hrbook) * parseFloat(ladies) * (parseFloat(32.85))).toFixed(2));
        //     jQuery("#costprice").trigger('blur');
        // } else {
        //     $('#sellprice').val("");
        // }
    });

    /**
     * Additoinal chages summation with initial sell price
     * DRCDHS
     * 3rd Dec.,2018
     */
    $(".additional-charges-packer").blur(function () {
        $("#hoursbooked").trigger("blur");
    });

    // jQuery('#hoursbooked').on('change', function () {
    //     var HouresValue = jQuery('#hoursbooked').val();
    //     if (HouresValue == "4" || HouresValue == "4.00") {
    //         jQuery('.servicetime').val("9am-1pm");
    //     } else if (HouresValue == "5" || HouresValue == "5.00") {
    //         jQuery('.servicetime').val("9am-2pm");
    //     } else if (HouresValue == "6" || HouresValue == "6.00") {
    //         jQuery('.servicetime').val("9am-3pm");
    //     } else {
    //         jQuery('.servicetime').val("");
    //     }
    // });

    
//    $("#sellprice").click(function () {
//        
//        var hrbook = $('#hoursbooked').val();
//        var ladies = $('#bookedladies').val();
//        if (hrbook != "" && ladies != "") {
//            var totalsell = (hrbook * ladies * 50)+'.00';
//            $('#sellprice').val(totalsell);
//        } else {
//            $('#sellprice').val("");
//        }
//    });
    /* Auto calculation of sellprice for Packing/Unpacking.......@DRCZ */

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

// 24-04-19 new price rule start

jQuery(document).ready(function () {
    var data= $("#enquirymovetype").val();
    changeEnquiryMoveType(data);

    $("#enquirymovetype").change(function () {
        var data= $("#enquirymovetype").val();
        changeEnquiryMoveType(data);
    });

    jQuery('select[name="en_no_of_movers1"],#enquirymovetype,#servicedate,#trucks-select,#movingfromstate,#movingtostate,#hoursbooked,#bookedladies').on('change', function() {
        setValues();
    });


    $("#movers").focusout(function(){
        if($("#servicedate").val() ==""){
            alert("Please fill Service date");
            $("#servicedate").focus();
            return false;
        }
        setValues('customMovers');
    });
    
});

function changeEnquiryMoveType(data){
     if (data == "1" || data == "2") {
            $("#storagedate").addClass('fhide');
            $("#deliveryDate").addClass('fhide');
            $("#deliveryDate").children().prop('disabled', true);
            $("#deliveryTime").addClass('fhide');
            $("#deliveryTime").children().prop('disabled', true);
            $("#storageProvider").addClass('fhide');
            $("#packers").addClass('fhide');
            $("#packers").children().prop('disabled', true);
            $("#removalistSelection").removeClass('fhide');
            $("#removalistSelection").children().prop('disabled', false);
            $("#packer_data").prop('disabled', true);
            $("#packerSelection").addClass('fhide');
            $("#packerSelection").children().prop('disabled', true);
            $("#packerUnpackerlbl").addClass('fhide');
            $("#packerlbl1").addClass('fhide');
            $("#additionalChargesCost").addClass('fhide');
            $("#travelFeeCost").addClass('fhide');
            $("#travelFeeCost").children().prop('disabled', true);
            $("#packingUnpackingPrice").addClass('fhide');
            $(".activitylog").removeClass('fhide');
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
            $("#finalPaymentReceivedBy").removeClass('fhide');
            $("#fewayRefno").removeClass('fhide');
            $("#feftPayment").removeClass('fhide');
            $("#headofficepaid").removeClass('fhide');
            $("#horeminder").removeClass('fhide');
            $("#serviceDate").removeClass('fhide');
            $("#removealist1").removeClass('fhide');
            $("#removealist1").children().prop('disabled', false);
            $("#removalist_data").prop('disabled', false);
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
            $(".actionforstorage").removeClass('fhide');
            //            $("#servicetime").val('8am');
            //            $("#depositamt").val('50.00');
            //            $("#movers").val('2');
            //            $("#trucks").val('1');
            //            $("#travelfee").val('60.00');
            //            $("#clienthourlyrate").val('120.00');
            //19-08-19
            $(".hours-completed").addClass("fhide");
            $(".activitylog").removeClass('fhide');
            jQuery("#storageDiv").addClass('fhide');
            jQuery('#depositReceived').parent().closest('div.portlet').removeClass('fhide');
            jQuery("#storageAgreementDiv").addClass('fhide');
            //20-08-19
            jQuery(".created-from-div").removeClass('fhide');
            jQuery("#storage-provider-address").addClass('fhide');
            //22-08-19
            jQuery("#storage-provider-info").addClass('fhide');
            jQuery("#clientFeedback").removeClass('fhide');
            jQuery("#jobsheet-log").removeClass('fhide');
            jQuery("#jobsheet-div").removeClass('fhide');
            //11-09-19
            // $('#serviceEndTimeDiv').addClass('fhide');
            //23-09-19
            jQuery('#hosServiceTimeContainer').removeClass('fhide');
            jQuery('#packerServiceTimeContainer').addClass('fhide');
        } else if (data == "3") {
            $("#serviceDate").removeClass('fhide');
            $("#deliveryDate").removeClass('fhide');
            $("#deliveryDate").children().prop('disabled', false);
            $("#deliveryTime").removeClass('fhide');
            $("#deliveryTime").children().prop('disabled', false);
            $("#storageProvider").addClass('fhide');
            $("#removealist1").removeClass('fhide');
            $("#removealist1").children().prop('disabled', false);
            $("#removalist_data").prop('disabled', false);
            $(".activitylog").removeClass('fhide');
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
            $("#amountDueNow").removeClass('fhide');
            $("#amountDueNow").children().prop('disabled', false);
            $("#referralDetails").removeClass('fhide');
            $("#referralDetails").children().prop('disabled', false);
            $("#packingPriceInfo").removeClass('fhide');
            $("#depositReceive").removeClass('fhide');
            $("#depositPaidby").removeClass('fhide');
            $("#packingCompanyPaid").addClass('fhide');
            $("#homeOffice").removeClass('fhide');
            $("#finalPaymentReceivedBy").removeClass('fhide');
            $("#fewayRefno").removeClass('fhide');
            $("#feftPayment").removeClass('fhide');
            $("#headofficepaid").removeClass('fhide');
            $(".actionforstorage").removeClass('fhide');
            $("#storagedate").addClass('fhide');
            $("#packers").addClass('fhide');
            $("#horeminder").addClass('fhide');
            $("#packers").children().prop('disabled', true);
            $("#removalistSelection").removeClass('fhide');
            $("#removalistSelection").children().prop('disabled', false);
            $("#packer_data").prop('disabled', true);
            $("#packerSelection").addClass('fhide');
            $("#packerSelection").children().prop('disabled', true);
            $("#packerUnpackerlbl").addClass('fhide');
            $("#packerlbl1").addClass('fhide');
            $("#travelFeeSell").addClass('fhide');
            $("#travelFeeCost").addClass('fhide');
            $("#travelFeeCost").children().prop('disabled', true);
            $("#additionalCharges").addClass('fhide');
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
            //19-08-19
            $(".hours-completed").addClass("fhide");
            $(".activitylog").removeClass('fhide');
            jQuery("#storageDiv").addClass('fhide');
            jQuery('#depositReceived').parent().closest('div.portlet').removeClass('fhide');
            jQuery("#storageAgreementDiv").addClass('fhide');
            //20-08-19
            jQuery(".created-from-div").removeClass('fhide');
            jQuery("#storage-provider-address").addClass('fhide');
            jQuery("#storage-provider-info").addClass('fhide');
            jQuery("#clientFeedback").removeClass('fhide');
            jQuery("#jobsheet-log").removeClass('fhide');
            jQuery("#jobsheet-div").removeClass('fhide');
            //11-09-19
            // $('#serviceEndTimeDiv').addClass('fhide');
            //23-09-19
            jQuery('#hosServiceTimeContainer').removeClass('fhide');
            jQuery('#packerServiceTimeContainer').addClass('fhide');
        } else if (data == "4" || data == "7") {
            $("#storagedate").addClass('fhide');
            $("#deliveryDate").addClass('fhide');
            $("#deliveryDate").children().prop('disabled', true);
            $("#deliveryTime").addClass('fhide');
            $("#deliveryTime").children().prop('disabled', true);
            $("#storageProvider").addClass('fhide');
            $("#removealist1").addClass('fhide');
            $("#removealist1").children().prop('disabled', true);
            $("#removalist_data").prop('disabled', true);
            $("#movingFromlbl").addClass('fhide');
            $(".activitylog").removeClass('fhide');
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
            $("#referralDetails").removeClass('fhide');
            $("#storagePrice").addClass('fhide');
            $("#monthPayment").addClass('fhide');
            $("#payment_methods").addClass('fhide');
            $("#finalPaymentReceivedBy").addClass('fhide');
            $("#fewayRefno").addClass('fhide');
            $("#feftPayment").addClass('fhide');
            $("#ewayRefNo").removeClass('fhide');
            $("#EFTReceivedon").removeClass('fhide');
            $("#anniversarydate").addClass('fhide');
            $("#ewayrecurringPayment").addClass('fhide');
            $("#futurePaymentLog").addClass('fhide');
            $("#removealistpaid").addClass('fhide');
            $("#EWAYTOKEN").addClass('fhide');
            $("#headofficepaid").addClass('fhide');
            $("#serviceDate").removeClass('fhide');
            $("#packers").removeClass('fhide');
            $("#packers").children().prop('disabled', false);
            $("#removalistSelection").addClass('fhide');
            $("#removalistSelection").children().prop('disabled', true);
            $("#packer_data").prop('disabled', false);
            $("#packerSelection").removeClass('fhide');
            $("#packerSelection").children().prop('disabled', false);
            $("#packerUnpackerlbl").removeClass('fhide');
            $("#packerlbl1").addClass('fhide');
            $("#movingFromtxt").removeClass('fhide');
            $(".actionforstorage").removeClass('fhide');
            $("#horeminder").addClass('fhide');
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
            //19-08-19
            $(".activitylog").removeClass('fhide');
            $(".hours-completed").removeClass("fhide");
            jQuery("#storageDiv").addClass('fhide');
            jQuery('#depositReceived').parent().closest('div.portlet').removeClass('fhide');
            jQuery("#storageAgreementDiv").addClass('fhide');
            //20-08-19
            jQuery(".created-from-div").removeClass('fhide');
            jQuery("#storage-provider-address").addClass('fhide');
            jQuery("#storage-provider-info").addClass('fhide');
            jQuery("#clientFeedback").removeClass('fhide');
            jQuery("#jobsheet-log").removeClass('fhide');
            jQuery("#jobsheet-div").removeClass('fhide');
            //05-09-19
            jQuery(".add_field_button_packers").addClass("fhide");
            //11-09-19
            // $('#serviceEndTimeDiv').removeClass('fhide');
            //23-09-19
            jQuery('#hosServiceTimeContainer').addClass('fhide');
            jQuery('#packerServiceTimeContainer').removeClass('fhide');
        } else if (data == "5" || data == "8") {
            $("#storagedate").addClass('fhide');
            $("#deliveryDate").addClass('fhide');
            $("#deliveryDate").children().prop('disabled', true);
            $("#deliveryTime").addClass('fhide');
            $("#deliveryTime").children().prop('disabled', true);
            $("#storageProvider").addClass('fhide');
            $("#removealist1").addClass('fhide');
            $("#removealist1").children().prop('disabled', true);
            $("#removalist_data").prop('disabled', true);
            $(".activitylog").removeClass('fhide');
            $("#movingFromlbl").addClass('fhide');
            $("#movingFromtxt").addClass('fhide');
            $("#movingTolbl").addClass('fhide');
            $("#additionalPickuplbl").addClass('fhide');
            $("#additionalPickuptxt").addClass('fhide');
            $("#additionalDeliverylbl").addClass('fhide');
            $("#additionalDeliverytxt").addClass('fhide');
            $("#packingPrice").addClass('fhide');
            $("#finalPaymentReceivedBy").addClass('fhide');
            $("#fewayRefno").addClass('fhide');
            $("#feftPayment").addClass('fhide');
            $("#travelFeeCost").addClass('fhide');
            $("#travelFeeCost").children().prop('disabled', true);
            $("#amountDueNow").addClass('fhide');
            $("#amountDueNow").children().prop('disabled', true);
            $("#referralDetails").removeClass('fhide');
            $("#storagePrice").addClass('fhide');
            $("#monthPayment").addClass('fhide');
            $("#payment_methods").addClass('fhide');
            $("#removealistpaid").addClass('fhide');
            $("#ewayRefNo").removeClass('fhide');
            $("#EFTReceivedon").removeClass('fhide');
            $("#anniversarydate").addClass('fhide');
            $("#ewayrecurringPayment").addClass('fhide');
            $("#futurePaymentLog").addClass('fhide');
            $("#EWAYTOKEN").addClass('fhide');
            $("#headofficepaid").addClass('fhide');
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
            $(".actionforstorage").removeClass('fhide');
            $("#horeminder").addClass('fhide');
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
            //19-08-19
            $(".activitylog").removeClass('fhide');
            $(".hours-completed").removeClass("fhide");
            jQuery("#storageDiv").addClass('fhide');
            jQuery('#depositReceived').parent().closest('div.portlet').removeClass('fhide');
            jQuery("#storageAgreementDiv").addClass('fhide');
            //20-08-19
            jQuery(".created-from-div").removeClass('fhide');
            jQuery("#storage-provider-address").addClass('fhide');
            jQuery("#storage-provider-info").addClass('fhide');
            jQuery("#clientFeedback").removeClass('fhide');
            jQuery("#jobsheet-log").removeClass('fhide');
            jQuery("#jobsheet-div").removeClass('fhide');
            //05-09-19
            jQuery(".add_field_button_packers").addClass("fhide");
            //11-09-19
            // $('#serviceEndTimeDiv').removeClass('fhide');
            //23-09-19
            jQuery('#hosServiceTimeContainer').addClass('fhide');
            jQuery('#packerServiceTimeContainer').removeClass('fhide');
        } else if (data == "6") {
            $("#serviceDate").addClass('fhide');
            $("#deliveryDate").addClass('fhide');
            $("#deliveryDate").children().prop('disabled', true);
            $("#deliveryTime").addClass('fhide');
            $("#deliveryTime").children().prop('disabled', true);
            $("#removealist1").addClass('fhide');
            $("#removealist1").children().prop('disabled', true);
            $("#removalist_data").prop('disabled', true);
            $("#packers").addClass('fhide');
            $("#packer_data").prop('disabled', true);
            $("#packers").children().prop('disabled', true);
            $("#removalistSelection").addClass('fhide');
            $("#removalistSelection").children().prop('disabled', true);
            $("#packerSelection").addClass('fhide');
            $("#packerSelection").children().prop('disabled', true);
            $(".actionforstorage").addClass('fhide');
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
            // $("#referralDetails").removeClass('fhide');
            $("#packingPriceInfo").addClass('fhide');
            $("#depositReceive").addClass('fhide');
            $("#depositPaidby").addClass('fhide');
            $("#finalPaymentReceivedBy").addClass('fhide');
            $("#fewayRefno").addClass('fhide');
            $("#feftPayment").addClass('fhide');
            $("#headofficepaid").addClass('fhide');
            $("#removealistpaid").addClass('fhide');
            $(".activitylog").addClass('fhide');
            $("#storagedate").removeClass('fhide');
            $("#storageProvider").removeClass('fhide');
            $("#storagePrice").removeClass('fhide');
            $("#movingFromlbl").removeClass('fhide');
            $("#movingFromtxt").removeClass('fhide');
            $("#movingTolbl").removeClass('fhide');
            $("#monthPayment").removeClass('fhide');
            $("#payment_methods").removeClass('fhide');
            $("#ewayRefNo").removeClass('fhide');
            $("#EFTReceivedon").removeClass('fhide');
            $("#anniversarydate").removeClass('fhide');
            $("#ewayrecurringPayment").removeClass('fhide');
            $("#futurePaymentLog").removeClass('fhide');
            $("#EWAYTOKEN").addClass('fhide');

            $(".activitylog").addClass('fhide');
            $(".hours-completed").addClass("fhide");
            //19-08-19 start
            jQuery('#depositReceived').parent().closest('div.portlet').addClass('fhide');
            jQuery("#noOfModules").addClass('fhide');
            jQuery("#cubicMetersByStorage").addClass('fhide');
            jQuery("#movingTolbl").addClass('fhide');
            jQuery("#movingTotxt").addClass('fhide');
            jQuery("#storageDiv").removeClass('fhide');        
            // jQuery("#packerUnpackerlbl").removeClass('fhide');
            // jQuery("#movingFromlbl").addClass('fhide');
            jQuery("#storageAgreementDiv").removeClass('fhide');
            //20-08-19 
            $("#referralDetails").addClass('fhide');
            jQuery(".created-from-div").addClass('fhide');
            jQuery("#storage-provider-address").removeClass('fhide');
            jQuery("#storage-provider-info").removeClass('fhide');
            jQuery("#clientFeedback").addClass('fhide');
            jQuery("#jobsheet-log").addClass('fhide');
            jQuery("#jobsheet-div").addClass('fhide');
            //11-09-19
            // $('#serviceEndTimeDiv').addClass('fhide');
            //23-09-19
            jQuery('#hosServiceTimeContainer').removeClass('fhide');
            jQuery('#packerServiceTimeContainer').addClass('fhide');
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
            $(".activitylog").removeClass('fhide');
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
        }
}

function setValues($customMovers=""){

    if(jQuery("select[name='en_no_of_movers1']").val() != 'other' && jQuery("#servicedate").val() =="" && jQuery("#enquirymovetype").val() != '6'){
        jQuery("#servicedate").focus();
        // alert("Please fill Service Date");
        return false;
    }

    var moveType=jQuery("#enquirymovetype").val();
    var inputDate = toDate(jQuery("#servicedate").val());
    var numberOfMovers=jQuery("select[name='en_no_of_movers1']").val();
    var todaysDate = new Date();
    var movingFromState= jQuery("#movingfromstate").val();
    if(moveType == '5'){
        movingFromState= jQuery("#movingtostate").val();
    }

    var dateFormat='';

    if(jQuery("#movers").css("display")=="inline-block"){
       numberOfMovers=jQuery("#movers").val();
    }
    var numberOfTrucks = jQuery("#trucks-select").val();
    if(jQuery("#trucks").css("display")!="none"){
       numberOfTrucks=jQuery("#trucks").val();
    }

    var today = new Date();
    var dateFormat = GetDateFormat(inputDate);
    jQuery.ajax({
    type: 'POST',
    url: BASE_URL + "pricelist/getRules",
    data: { moveType : moveType, datepicker : dateFormat, noOfTrucks : numberOfTrucks,noOfMovers:numberOfMovers,state:movingFromState },
    success: function (response) {
        var res = JSON.parse(response);
        if(res == null){
            if(moveType == '1' || moveType == '2'){
                jQuery("#travelfee").val('');
                jQuery("#clienthourlyrate").val('');
            }
            else if(moveType == '4' || moveType == '5'){
                jQuery("#sellprice").val('');
            }
        }
        else{
            if(res[0].movetype == '1' || res[0].movetype =='2'){
                jQuery("#travelfee").val(parseInt(res[0].travel_fee).toFixed(2));
                jQuery("#clienthourlyrate").val(parseInt(res[0].client_hour_rate).toFixed(2));
                if(res[0].rule_type == '3'){
                    jQuery("#travelfee, input[name=en_client_hourly_rate]").addClass('holiday-highlighter');
                }
                else{
                    jQuery("#travelfee, input[name=en_client_hourly_rate]").removeClass('holiday-highlighter');
                }
            }
            else if(res[0].movetype == '4' || res[0].movetype =='5'){
                var hoursbooked = jQuery("#hoursbooked").val();
                var bookedLadies = jQuery("#bookedladies").val();
                var sellTotal = (parseFloat(res[0].per_person_packing_rate) * parseFloat(hoursbooked) * parseFloat(bookedLadies)).toFixed(2);
                if(hoursbooked !='' && bookedLadies != ''){
                    // jQuery("#sellprice").val((parseFloat(res[0].per_person_packing_rate) * parseFloat(hoursbooked) * parseFloat(bookedLadies)).toFixed(2));
                    // jQuery("#totalsellprice").val((parseFloat(res[0].per_person_packing_rate) * parseFloat(hoursbooked) * parseFloat(bookedLadies)).toFixed(2));
                    jQuery("#sellprice, #totalsellprice").val(sellTotal);
                    var totalNonBillableHours=0;
                    jQuery(".non-billable-packer-name-text").each(function() {
                        if(jQuery(this).val() != ''){
                            totalNonBillableHours+= parseFloat(jQuery(this).val());
                        }
                    });
                    jQuery("#costprice").val(((parseFloat(hoursbooked) * parseFloat(bookedLadies) * (parseFloat(res[0].packer_cost_price))) + parseFloat(totalNonBillableHours) * (parseFloat(res[0].packer_cost_price)) ).toFixed(2));
                    jQuery("#costprice").trigger('blur'); 
                }
            }
        }        
    }
    });
 
}

function GetDateFormat(date) {
   var month = (date.getMonth() + 1).toString();
   month = month.length > 1 ? month : '0' + month;
   var day = date.getDate().toString();
   day = day.length > 1 ? day : '0' + day;
   return day + '-' + month+ '-' + date.getFullYear();
}

function setFees($travelfee,$clienthourlyrate){
    $("#travelfee").val($travelfee);
    $("#clienthourlyrate").val($clienthourlyrate);  
}
function toDate(dateStr) {
  var parts = dateStr.split("-")
  return new Date(parts[2], parts[1] - 1, parts[0])
}

// new price rule end


    $("#enquirymovetype").on('change', function () {
        return true;
        var data = $(this, ":selected").val();

        if (data == "1") {
            $("#servicet").val('8am');
            $("#depositamt").val('50.00');
            $('select.select-mover').val('2');
            //  $("#movers").val('2');
            $("#trucks").val('1');
            $("#travelfee").val('60.00');
            $("#clienthourlyrate").val('120.00');
            $("#hoursbooked").val('');
            $("#bookedladies").val('');
            $("#sellprice").val('');
        } else if (data == "2") {
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
            $("#servicet").val('8am');
            $("#depositamt").val('');
            $("#movers").val('');
            $("#trucks").val('');
            $("#travelfee").val('');
            $("#clienthourlyrate").val('');
            $("#hoursbooked").val('');
            $("#bookedladies").val('');
            $("#sellprice").val('');
        } else if (data == "4" || data == "7") {
            $("#servicet").val('9am-1pm');
            // $("#hoursbooked").val('4.00');
            // $("#bookedladies").val('2');
            // $("#sellprice").val('400.00');
            $("#depositamt").val('');
            $("#movers").val('');
            $("#trucks").val('');
            $("#travelfee").val('');
            $("#clienthourlyrate").val('');
        } else if (data == "5" || data == "8") {
            $("#servicet").val('9am-1pm');
            // $("#hoursbooked").val('4.00');
            // $("#bookedladies").val('2');
            // $("#sellprice").val('400.00');
            $("#depositamt").val('');
            $("#movers").val('');
            $("#trucks").val('');
            $("#travelfee").val('');
            $("#clienthourlyrate").val('');
        } else if (data == "6") {
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
    });

    //edit Jobsheet mail............@DRCZ
    jQuery(".edit-jobsheet-mail").click(function () {
        var id = jQuery(this).data('id');
        var movetype = jQuery('#enquirymovetype').val();
        var servicedate = jQuery('.servicedate').val();
        // var servicetime = parseInt(jQuery('.servicetime').val());
        var servicetime = parseInt(jQuery('#serviceFullTime').val());
        var client = jQuery('.client').val();
        var phone = jQuery('.phone').val();
        var email = jQuery('.email').val();
        var removalistname = jQuery('#removalist_data').val();
        var packer_data = jQuery('#packer_data').val();
        var depositamt = jQuery('.depositamt').val();
        var movers = jQuery('.text-mover').val();
        var trucks = jQuery('#trucks').val();
        // var trucks = jQuery('.trucks option:selected').val();
        var travelfees = jQuery('.travelfees').val();
        var clientrate = jQuery('.chr').val();
        var fromstate = jQuery('.movingfromstate option:selected').val();
        var tostate = jQuery('.movingtostate option:selected').val();
        var hoursbook = jQuery('.hoursbook').val();
        var ladiesbook = jQuery('.ladiesbook').val();
        var inisellprice = jQuery('.inisellprice').val();
        var deporeceive = jQuery('#deporeceive').val();
        var depopaidby = jQuery('#depopaidby option:selected').val();
        var ewayref = jQuery('#ewayref').val();
        var eftRecievedOn = $('#eftreceivedon').val();

        if (movetype == "1" || movetype == "2") {
            if (client == "" || email == "" || depositamt == "" || movers == "" || trucks == "" || travelfees == "" || clientrate == "" || fromstate == "" || tostate == "") {

                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (removalistname == "") {
                toastr.error("Removalist should not be blank for send email");
                return false;
            } else {
            	sendWarningMail(id, ewayref, eftRecievedOn);
                window.open(BASE_URL + "booking/editJobsheetMail/" + id + '/4', "_blank", "edit-jobsheet-mail");
                return false;
            }
        }
        if (movetype == "4" || movetype == "7") {
            if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || fromstate == "") {
                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (packer_data == "") {
                toastr.error("Packers should not be blank for send email");
                return false;
            } else {
            	sendWarningMail(id, ewayref, eftRecievedOn);
                window.open(BASE_URL + "booking/editJobsheetMail/" + id + '/4', "_blank", "edit-jobsheet-mail");
                return false;
            }
        }
        if (movetype == "5" || movetype == "8") {
            if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || tostate == "") {
                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (packer_data == "") {
                toastr.error("Packers should not be blank for send email");
                return false;
            } else {
            	sendWarningMail(id, ewayref, eftRecievedOn);
                window.open(BASE_URL + "booking/editJobsheetMail/" + id + '/4', "_blank", "edit-jobsheet-mail");
                return false;
            }
        }
    });
    jQuery(".edit-removalist-jobsheet-mail").click(function () {
        var id = jQuery(this).data('id');
        var movetype = jQuery('#enquirymovetype').val();
        var servicedate = jQuery('.servicedate').val();
        var servicetime = parseInt(jQuery('.servicetime').val());
        var client = jQuery('.client').val();
        var phone = jQuery('.phone').val();
        var email = jQuery('.email').val();
        var removalistname = jQuery('#removalist_data').val();
        var packer_data = jQuery('#packer_data').val();
        var depositamt = jQuery('.depositamt').val();
        var movers = jQuery('.text-mover').val();
        var trucks = jQuery('#trucks').val();
        // var trucks = jQuery('.trucks option:selected').val();
        var travelfees = jQuery('.travelfees').val();
        var clientrate = jQuery('.chr').val();
        var fromstate = jQuery('.movingfromstate option:selected').val();
        var tostate = jQuery('.movingtostate option:selected').val();
        var hoursbook = jQuery('.hoursbook').val();
        var ladiesbook = jQuery('.ladiesbook').val();
        var inisellprice = jQuery('.inisellprice').val();

        if (movetype == "1" || movetype == "2") {
            if (client == "" || email == "" || depositamt == "" || movers == "" || trucks == "" || travelfees == "" || clientrate == "" || fromstate == "" || tostate == "") {
                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (removalistname == "") {
                toastr.error("Removalist should not be blank for send email");
                return false;
            } else {
                window.open(BASE_URL + "booking/editReminderJobsheetMail/" + id + '/4', "_blank", "edit-removalist-jobsheet-mail");
                return false;
            }
        }
        if (movetype == "4" || movetype == "7") {
            if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || fromstate == "") {
                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (packer_data == "") {
                toastr.error("Packers should not be blank for send email");
                return false;
            } else {
                window.open(BASE_URL + "booking/editReminderJobsheetMail/" + id + '/4', "_blank", "edit-removalist-jobsheet-mail");
                return false;
            }
        }
        if (movetype == "5" || movetype == "8") {
            if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || tostate == "") {
                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (packer_data == "") {
                toastr.error("Packers should not be blank for send email");
                return false;
            } else {
                window.open(BASE_URL + "booking/editReminderJobsheetMail/" + id + '/4', "_blank", "edit-removalist-jobsheet-mail");
                return false;
            }
        }
    });
    //edit Booking confirmation mail............@DRCZ
    jQuery(".edit-bookingconfirm-mail").click(function () {
        var id = jQuery(this).data('id');
        var movetype = jQuery('#enquirymovetype').val();
        var servicedate = jQuery('.servicedate').val();
        // var servicetime = parseInt(jQuery('.servicetime').val());
        var servicetime = parseInt(jQuery('#serviceFullTime').val());
        var client = jQuery('.client').val();
        var phone = jQuery('.phone').val();
        var email = jQuery('.email').val();
        var removalistname = jQuery('#removalist_data').val();
        var packer_data = jQuery('#packer_data').val();

        var depositamt = jQuery('.depositamt').val();
        var movers = jQuery('.text-mover').val();
        var trucks = jQuery('#trucks').val();
        // var trucks = jQuery('.trucks option:selected').val();
        var travelfees = jQuery('.travelfees').val();
        var clientrate = jQuery('.chr').val();
        var fromstate = jQuery('.movingfromstate option:selected').val();
        var tostate = jQuery('.movingtostate option:selected').val();
        var hoursbook = jQuery('.hoursbook').val();
        var ladiesbook = jQuery('.ladiesbook').val();
        var inisellprice = jQuery('.inisellprice').val();
        var deporeceive = jQuery('#deporeceive').val();
        var depopaidby = jQuery('#depopaidby option:selected').val();
        var ewayref = jQuery('#ewayref').val();
        var eftRecievedOn = $('#eftreceivedon').val();

        if (movetype == "1" || movetype == "2") {
            if (client == "" || email == "" || depositamt == "" || movers == "" || trucks == "" || travelfees == "" || clientrate == "" || fromstate == "" || tostate == "") {
                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (removalistname == "") {
                toastr.error("Removalist should not be blank for send email");
                return false;
            } else {
				sendWarningMail(id, ewayref, eftRecievedOn);
                window.open(BASE_URL + "booking/editBookingConfirmationMail/" + id + '/5', "_blank", "edit-bookingconfirm-mail");
                return false;
            }
        }
        if (movetype == "4" || movetype == "7") {
            if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || fromstate == "") {
                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (packer_data == "") {
                toastr.error("Packers should not be blank for send email");
                return false;
            } else {
            	sendWarningMail(id, ewayref, eftRecievedOn);
                window.open(BASE_URL + "booking/editBookingConfirmationMail/" + id + '/5', "_blank", "edit-bookingconfirm-mail");
                return false;
            }
        }
        if (movetype == "5" || movetype == "8") {
            if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || tostate == "") {
                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (packer_data == "") {
                toastr.error("Packers should not be blank for send email");
                return false;
            } else {
            	sendWarningMail(id, ewayref, eftRecievedOn);
                window.open(BASE_URL + "booking/editBookingConfirmationMail/" + id + '/5', "_blank", "edit-bookingconfirm-mail");
                return false;
            }
        }
    });
    //edit Booking confirmation mail............@DRCZ
    jQuery(".edit-sendfeedback-mail").click(function () {
        var client = jQuery('.client').val();
        if (client != "") {
            var id = jQuery(this).data('id');
            window.open(BASE_URL + "booking/editSendFeedbackMail/" + id + '/6', "_blank", "edit-sendfeedback-mail");
            return false;
        } else {
            toastr.error('Please fill required field.');
            return false;
        }
    });
    //edit Booking confirmation mail............@DRCZ
    jQuery(".edit-sendreminder-mail").click(function () {
        var id = jQuery(this).data('id');
        var movetype = jQuery('#enquirymovetype').val();
        var servicedate = jQuery('.servicedate').val();
        // var servicetime = parseInt(jQuery('.servicetime').val());
        var servicetime = parseInt(jQuery('#serviceFullTime').val());
        var client = jQuery('.client').val();
        var phone = jQuery('.phone').val();
        var email = jQuery('.email').val();
        var removalistname = jQuery('#removalist_data').val();
        var packer_data = jQuery('#packer_data').val();
        var depositamt = jQuery('.depositamt').val();
        var movers = jQuery('.text-mover').val();
        var trucks = jQuery('#trucks').val();
        // var trucks = jQuery('.trucks option:selected').val();
        var travelfees = jQuery('.travelfees').val();
        var clientrate = jQuery('.chr').val();
        var fromstate = jQuery('.movingfromstate option:selected').val();
        var tostate = jQuery('.movingtostate option:selected').val();
        var hoursbook = jQuery('.hoursbook').val();
        var ladiesbook = jQuery('.ladiesbook').val();
        var inisellprice = jQuery('.inisellprice').val();

        if (movetype == "1" || movetype == "2") {
            if (client == "" || email == "" || depositamt == "" || movers == "" || trucks == "" || travelfees == "" || clientrate == "" || fromstate == "" || tostate == "") {
                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (removalistname == "") {
                toastr.error("Removalist should not be blank for send email");
                return false;
            } else {
                window.open(BASE_URL + "booking/editSendReminderMail/" + id + '/7', "_blank", "edit-sendreminder-mail");
                return false;
            }
        }
        if (movetype == "4" || movetype == "7") {
            if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || fromstate == "") {
                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (packer_data == "") {
                toastr.error("Packers should not be blank for send email");
                return false;
            } else {
                window.open(BASE_URL + "booking/editSendReminderMail/" + id + '/7', "_blank", "edit-sendreminder-mail");
                return false;
            }
        }
        if (movetype == "5" || movetype == "8") {
            if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || tostate == "") {
                toastr.error('Please fill required field.');
                return false;
            } else if (servicedate == "") {
                toastr.error("Servicedate is required for send email.");
                return false;
            } else if (servicetime == "" || isNaN(servicetime)) {
                toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
                return false;
            } else if (packer_data == "") {
                toastr.error("Packers should not be blank for send email");
                return false;
            } else {
                window.open(BASE_URL + "booking/editSendReminderMail/" + id + '/7', "_blank", "edit-sendreminder-mail");
                return false;
            }
        }
    });
    /*No Answer Feedback edit.......@DRCZ 17-5-2018*/
    jQuery(".edit-no-answer-feedback").click(function () {

        var client = jQuery('.client').val();
        if (client != "") {
            var id = jQuery(this).data('id');
            window.open(BASE_URL + "booking/editNoAnswerFeedback/" + id + '/9', "_blank", "edit-no-answer-feedback");
            return false;
        } else {
            toastr.error('Please fill required field.');
            return false;
        }
    });
    /*No Answer Feedback edit.......@DRCZ 17-5-2018*/

    /*For Jobsheet log*/
    var bookingID = jQuery("input[name='en_unique_id']").val();
    var datastr = "bookingID=" + bookingID;
    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + 'booking/getJobLog',
        data: datastr,
        success: function (data) {
            data=data.trim();
            var res = jQuery.parseJSON(data);
            var html = "";
            $.each(res, function (i, v) {
                html += "<div class=\"joblog-item\"><p>" + v.mod_payment + "- #" + v.trans_no + " (" + v.amount + ")<span class=\"joblog-date\">"+v.trans_date+"</span></p><span class=\"joblog-status\"><a href='"+BASE_URL+"jobsheet/open/"+v.id+"' target='_blank'>Job Sheet</a></span></div>";
            })
            if (html == "") {
                html = "No log found.";
            }
            jQuery(".joblog-wrapepr").html(html);
        }
    })

})


jQuery(".send-job-sheet").click(function () {
    var movetype = jQuery('#enquirymovetype').val();
    var servicedate = jQuery('.servicedate').val();
    // var servicetime = parseInt(jQuery('.servicetime').val());
    var servicetime = parseInt(jQuery('#serviceFullTime').val());
    var client = jQuery('.client').val();
    var phone = jQuery('.phone').val();
    var email = jQuery('.email').val();
    var removalistname = jQuery('#removalist_data').val();
    var packer_data = jQuery('#packer_data').val();

    var depositamt = jQuery('.depositamt').val();
    var movers = jQuery('.text-mover').val();
    var trucks = jQuery('#trucks').val();
    // var trucks = jQuery('.trucks option:selected').val();
//    alert(trucks);
    var travelfees = jQuery('.travelfees').val();
    var clientrate = jQuery('.chr').val();
    var fromstate = jQuery('.movingfromstate option:selected').val();
    var tostate = jQuery('.movingtostate option:selected').val();
    var hoursbook = jQuery('.hoursbook').val();
    var ladiesbook = jQuery('.ladiesbook').val();
    var inisellprice = jQuery('.inisellprice').val();
    var deporeceive = jQuery('#deporeceive').val();
    var depopaidby = jQuery('#depopaidby option:selected').val();
    var ewayref = jQuery('#ewayref').val();
    var eftRecievedOn = $('#eftreceivedon').val();
    var id = jQuery(this).data("id");
    var datastr = "emailAction=JobSheet&id=" + id;
    
    if (movetype == "1" || movetype == "2") {
        if (client == "" || email == "" || depositamt == "" || movers == "" || trucks == "" || travelfees == "" || clientrate == "" || fromstate == "" || tostate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (removalistname == "") {
            toastr.error("Removalist should not be blank for send email");
            return false;
        } else {
        	sendWarningMail(id, ewayref, eftRecievedOn);
            $(".ajaxLoader").show();
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
    if (movetype == "4" || movetype == "7") {
        if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || fromstate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (packer_data == "") {
            toastr.error("Packers should not be blank for send email");
            return false;
        } else {
        	sendWarningMail(id, ewayref, eftRecievedOn);
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=JobSheet&id=" + id;
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
    if (movetype == "5" || movetype == "8") {
        if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || tostate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (packer_data == "") {
            toastr.error("Packers should not be blank for send email");
            return false;
        } else {
        	sendWarningMail(id, ewayref, eftRecievedOn);
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=JobSheet&id=" + id;
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
});

function sendWarningMail($id, $ewayref, $eftRecievedOn){
	if($ewayref == '' && $eftRecievedOn == ''){
        alert("There is no eway reference number or EFT payment date - has this customer paid?");
        jQuery.ajax({
            type: 'POST',
            data: "emailAction=WarningJobsheet&id=" + $id,
            url: BASE_URL + "email/send",
            success: function (response) {
                
            }
        });
    }
}

jQuery(".send-removalist-job-sheet").click(function () {
    var movetype = jQuery('#enquirymovetype').val();
    var servicedate = jQuery('.servicedate').val();
    var servicetime = parseInt(jQuery('.servicetime').val());
    var client = jQuery('.client').val();
    var phone = jQuery('.phone').val();
    var email = jQuery('.email').val();
    var removalistname = jQuery('#removalist_data').val();
    var packer_data = jQuery('#packer_data').val();
    var depositamt = jQuery('.depositamt').val();
    var movers = jQuery('.text-mover').val();
    var trucks = jQuery('#trucks').val();
    // var trucks = jQuery('.trucks option:selected').val();
    var travelfees = jQuery('.travelfees').val();
    var clientrate = jQuery('.chr').val();
    var fromstate = jQuery('.movingfromstate option:selected').val();
    var tostate = jQuery('.movingtostate option:selected').val();
    var hoursbook = jQuery('.hoursbook').val();
    var ladiesbook = jQuery('.ladiesbook').val();
    var inisellprice = jQuery('.inisellprice').val();

    if (movetype == "1" || movetype == "2") {
        if (client == "" || email == "" || depositamt == "" || movers == "" || trucks == "" || travelfees == "" || clientrate == "" || fromstate == "" || tostate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (removalistname == "") {
            toastr.error("Removalist should not be blank for send email");
            return false;
        } else {
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=RemovalistJobSheet&id=" + id;
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
    if (movetype == "4" || movetype == "7") {
        if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || fromstate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (packer_data == "") {
            toastr.error("Packers should not be blank for send email");
            return false;
        } else {
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=RemovalistJobSheet&id=" + id;
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
    if (movetype == "5" || movetype == "8") {
        if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || tostate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (packer_data == "") {
            toastr.error("Packers should not be blank for send email");
            return false;
        } else {
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=RemovalistJobSheet&id=" + id;
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
});

jQuery(".send-booking-confirmation").click(function () {
    var movetype = jQuery('#enquirymovetype').val();
    var servicedate = jQuery('.servicedate').val();
    // var servicetime = parseInt(jQuery('.servicetime').val());
    var servicetime = parseInt(jQuery('#serviceFullTime').val());
    var client = jQuery('.client').val();
    var phone = jQuery('.phone').val();
    var email = jQuery('.email').val();
    var removalistname = jQuery('#removalist_data').val();
    var packer_data = jQuery('#packer_data').val();

    var depositamt = jQuery('.depositamt').val();
    var movers = jQuery('.text-mover').val();
    var trucks = jQuery('#trucks').val();
    // var trucks = jQuery('.trucks option:selected').val();
    var travelfees = jQuery('.travelfees').val();
    var clientrate = jQuery('.chr').val();
    var fromstate = jQuery('.movingfromstate option:selected').val();
    var tostate = jQuery('.movingtostate option:selected').val();
    var hoursbook = jQuery('.hoursbook').val();
    var ladiesbook = jQuery('.ladiesbook').val();
    var inisellprice = jQuery('.inisellprice').val();
    var deporeceive = jQuery('#deporeceive').val();
    var depopaidby = jQuery('#depopaidby option:selected').val();
    var ewayref = jQuery('#ewayref').val();
    var eftRecievedOn = $('#eftreceivedon').val();
    var id = jQuery(this).data("id");
    var datastr = "emailAction=BookingConfirmation&id=" + id;

    if (movetype == "1" || movetype == "2") {
        if (client == "" || email == "" || depositamt == "" || movers == "" || trucks == "" || travelfees == "" || clientrate == "" || fromstate == "" || tostate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (removalistname == "") {
            toastr.error("Removalist should not be blank for send email");
            return false;
        } else {

			sendWarningMail(id, ewayref, eftRecievedOn);
            $(".ajaxLoader").show();
            
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
    if (movetype == "4" || movetype == "7") {
        if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || fromstate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (packer_data == "") {
            toastr.error("Packers should not be blank for send email");
            return false;
        } else {
        	sendWarningMail(id, ewayref, eftRecievedOn);
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=BookingConfirmation&id=" + id;
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
    if (movetype == "5" || movetype == "8") {
        if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || tostate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (packer_data == "") {
            toastr.error("Packers should not be blank for send email");
            return false;
        } else {
        	sendWarningMail(id, ewayref, eftRecievedOn);
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=BookingConfirmation&id=" + id;
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
})

jQuery(".send-feedback").click(function () {
    var client = jQuery('.client').val();
    if (client != "") {
        if (confirm('Are you sure want to send "Request Review" email?')) {
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=SendFeedback&id=" + id;

            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    } else {
        toastr.error('Please fill required field.');
        return false;
    }

});
jQuery(".send-reminder").click(function () {
    var movetype = jQuery('#enquirymovetype').val();
    var servicedate = jQuery('.servicedate').val();
    // var servicetime = parseInt(jQuery('.servicetime').val());
    var servicetime = parseInt(jQuery('#serviceFullTime').val());
    var client = jQuery('.client').val();
    var phone = jQuery('.phone').val();
    var email = jQuery('.email').val();
    var removalistname = jQuery('#removalist_data').val();
    var packer_data = jQuery('#packer_data').val();

    var depositamt = jQuery('.depositamt').val();
    var movers = jQuery('.text-mover').val();
    var trucks = jQuery('#trucks').val();
    // var trucks = jQuery('.trucks option:selected').val();
    var travelfees = jQuery('.travelfees').val();
    var clientrate = jQuery('.chr').val();
    var fromstate = jQuery('.movingfromstate option:selected').val();
    var tostate = jQuery('.movingtostate option:selected').val();
    var hoursbook = jQuery('.hoursbook').val();
    var ladiesbook = jQuery('.ladiesbook').val();
    var inisellprice = jQuery('.inisellprice').val();

    if (movetype == "1" || movetype == "2") {
        if (client == "" || email == "" || depositamt == "" || movers == "" || trucks == "" || travelfees == "" || clientrate == "" || fromstate == "" || tostate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (removalistname == "") {
            toastr.error("Removalist should not be blank for send email");
            return false;
        } else {
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=SendReminder&id=" + id;
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
    if (movetype == "4" || movetype == "7") {
        if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || fromstate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (packer_data == "") {
            toastr.error("Packers should not be blank for send email");
            return false;
        } else {
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=SendReminder&id=" + id;
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
    if (movetype == "5" || movetype == "8") {
        if (client == "" || email == "" || hoursbook == "" || ladiesbook == "" || inisellprice == "" || tostate == "") {
            toastr.error('Please fill required field.');
            return false;
        } else if (servicedate == "") {
            toastr.error("Servicedate is required for send email.");
            return false;
        } else if (servicetime == "" || isNaN(servicetime)) {
            toastr.error("Servicetime field is either blank or No Preference that time you can not send email.");
            return false;
        } else if (packer_data == "") {
            toastr.error("Packers should not be blank for send email");
            return false;
        } else {
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=SendReminder&id=" + id;
            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
        }
    }
});
/*Not Answer Feedback email.....@DRCZ 17-5-2018*/
jQuery(".no-answer-feedback").click(function () {
    var client = jQuery('.client').val();
    if (client != "") {
        if (confirm('Are you sure want to send "No Answer Feedback" email?')) {
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=NoAnswerFeedback&id=" + id;

            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
        }
        return false;
    } else {
        toastr.error('Please fill required field.');
        return false;
    }
});


/* Send feedback reminder */
jQuery(".send-feedback-reminder").click(function () {
    var client = jQuery('.client').val();
    if (client != "") {
        if (confirm('Are you sure want to send "Feedback Reminder" email?')) {
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=FeedbackReminder&id=" + id;

            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    // GetEmailLogOnAjax(id);
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
        }
        return false;
    } else {
        toastr.error('Please fill required field.');
        return false;
    }
});


function GetEmailLogOnAjax(id) {
    var datastr = "id=" + id;

    jQuery.ajax({
        type: 'POST',
        data: datastr,
        url: BASE_URL + "Booking/EmailActivitiesLogAjax",
        success: function (response) {
            jQuery('.admin-notes .mt-actions').html('');
            jQuery('.admin-notes .mt-actions').append(response);
        }
    })
    return false;
}

/**
 * Duplicate booking................
 */
jQuery("body").on("click", "#duplicateBookingform", function () {

    if (confirm("Are you sure to duplicate booking ?")) {
        var id = jQuery(this).data("id");

        jQuery.ajax({
            type: 'POST',
            url: BASE_URL + "booking/getBookingdataforDuplicate/" + id,
            // data: {ids: enquirysIds},
            success: function (response) {
                var res = JSON.parse(response);
                // console.log(res.id);
                var enid = res.id;
                if (res.error) {
                    toastr.error('Something wrong.');
                } else {
                    toastr.success('Booking is saved.');
                    window.location = BASE_URL + "booking/viewBooking/" + enid;
//                        var table = $('#enquirylist').DataTable();
//                        table.ajax.reload();
                }
            }
        })
    }
})

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


        //  packer hours script start
    
    $moveTypeP=jQuery('#enquirymovetype').val();
    if($moveTypeP == '4' || $moveTypeP == '5'){
        if((jQuery(".packer-listed li").length != jQuery("#packer_hours .form-group").length) || jQuery(".packer-listed li").length != jQuery("#packer_hours_non_billable .form-group").length ){
            $hours = jQuery('#hoursbooked').val();
            $packerEnquiryId=jQuery('input[name=enquiry_id]').val();
            var packerArr = [];
            jQuery( "#packer_hours .packer-name" ).each(function( index ) {
              packerArr.push(jQuery( this ).val());
            });
            var allPackerId=[];
            var packerId='';

            jQuery( ".packer-listed li" ).each(function( index ) {
                $pId= jQuery( this ).attr('data-id');
                allPackerId.push($pId);
                $pName=jQuery( this ).text();
                if(jQuery.inArray($pId, packerArr) === -1){
                    packerId+=$pId+',';
                    jQuery("#packer_hours").append('<div class="form-group packer-div-'+ $pId +'"><label class="control-label col-md-6 packer-name-label">'+ $pName +'</label><div class="col-md-6"><input type="hidden" class="packer-name" name="packer-name[]" value="'+ $pId +'"><input type="text" class="form-control packer-name-text" name="packer-hours[]" value="'+ $hours +'"></div></div>');
                }
            });

            jQuery.each(packerArr, function( index, value ) {
                if(jQuery.inArray(value, allPackerId) === -1){
                    jQuery('.packer-div-'+value).remove();
                     jQuery.ajax({
                        type: 'POST',
                        url: BASE_URL + "booking/remove_packer_hours",
                        data: { 'packerId': value,'packerEnquiryId':$packerEnquiryId },
                        success: function (response) {
                            var res = JSON.parse(response);
                        }
                    });
                }
            });

            jQuery.ajax({
            type: 'POST',
            url: BASE_URL + "booking/add_packer_hours",
            data: { 'packerIds': packerId,'hours' : $hours,'packerEnquiryId':$packerEnquiryId },
            success: function (response) {
                var res = JSON.parse(response);
            }
            });
        }
    }

    //  packer hours script end


    //25-07-19 cost price start
    if(costPriceUpdatedFlag == '0'){
        $moveType = jQuery("#enquirymovetype").val();
        if($moveType == '4' || $moveType == '5'){
            
            var totalHours=0;
            jQuery(".packer-name-text").each(function() {
                totalHours+= parseFloat(jQuery(this).val());
            });

            var moveType= jQuery("#enquirymovetype").val();
            var movingFromState ='';
            if(moveType == '4'){
                movingFromState=jQuery("#movingfromstate").val();
            }
            else if(moveType == '5'){
                movingFromState=jQuery("#movingtostate").val();
            }
            var dateFormat = jQuery('#servicedate').val();

            jQuery.ajax({
                type: 'POST',
                url: BASE_URL + "pricelist/getRules",
                data: { moveType : moveType, datepicker : dateFormat,state:movingFromState },
                success: function (response) {
                    var res = JSON.parse(response);
                    jQuery("#totalsellprice").val(jQuery("#sellprice").val());
                    var totalHours=0;
                    jQuery(".packer-name-text").each(function() {
                        totalHours+= parseFloat(jQuery(this).val());
                    });
                    $totalCostPrice=jQuery('#hoursbooked').val() * jQuery('#bookedladies').val() * res[0].packer_cost_price;
                    jQuery("#costprice").val(($totalCostPrice).toFixed(2)).trigger('blur');
                    jQuery(".non-billable-packer-name-text").trigger('blur');

                }
            });

            // $totalCostPrice=jQuery('#hoursbooked').val() * jQuery('#bookedladies').val() * 32.85;
            // jQuery("#costprice").val(($totalCostPrice).toFixed(2)).trigger('blur');
        }
    }

    //25-07-19 cost price end

    //storage - 09-08-19 start
    jQuery('input[name=en_quotedcost_price]').on('change', function(e) {
    var storageCost=jQuery('input[name=en_quotedcost_price]').val(); 
    jQuery(this).val(parseFloat(storageCost).toFixed(2));
    if(jQuery('input[name=en_quotedsell_price]').val() != ''){
        var storageSell=jQuery('input[name=en_quotedsell_price]').val();
        jQuery('input[name=en_hireamover_margin]').val((storageSell - storageCost).toFixed(2));
    }

    });
    //storage - 09-08-19 end
    
    //08-07-19 initial sell price start

    // if(jQuery("#totalsellprice").val() == ""){
    //     $moveType = jQuery("#enquirymovetype").val();
    //     if($moveType == '4' || $moveType == '5'){
    //         jQuery("#totalsellprice").val(jQuery("#sellprice").val());
    //         // jQuery("#bookedladies").trigger('blur');
    //         var totalHours=0;
    //         jQuery(".packer-name-text").each(function() {
    //             totalHours+= parseFloat(jQuery(this).val());
    //         });
    //         if(totalHours == 0){
    //             $totalCostPrice=jQuery('#hoursbooked').val() * jQuery('#bookedladies').val() * 32.85;
    //             jQuery("#costprice").val(($totalCostPrice).toFixed(2)).trigger('blur');
    //         }
    //     }
    // }

    //08-07-19 initial sell price end

    // jQuery('body').on('change, blur','.packer-name-text', function(e) {
    //     var totalHours=0;
    //     jQuery(".packer-name-text").each(function() {
    //         totalHours+= parseFloat(jQuery(this).val());
    //     });

    //     var moveType= jQuery("#enquirymovetype").val();
    //     var movingFromState ='';
    //     if(moveType == '4'){
    //         movingFromState=jQuery("#movingfromstate").val();
    //     }
    //     else if(moveType == '5'){
    //         movingFromState=jQuery("#movingtostate").val();
    //     }
    //     var dateFormat = jQuery('#servicedate').val();

    //     jQuery.ajax({
    //         type: 'POST',
    //         url: BASE_URL + "pricelist/getRules",
    //         data: { moveType : moveType, datepicker : dateFormat,state:movingFromState },
    //         success: function (response) {
    //             var res = JSON.parse(response);
    //             jQuery("#totalsellprice").val((totalHours*res[0].per_person_packing_rate).toFixed(2));
    //             jQuery("#costprice").val((totalHours*res[0].packer_cost_price).toFixed(2));
    //             jQuery("#hamMargin").val((jQuery("#totalsellprice").val() - jQuery("#costprice").val()).toFixed(2)) ; 
    //         }
    //     });

    //     // jQuery("#costprice").val((totalHours*32.85).toFixed(2));
    //     // jQuery("#totalsellprice").val((totalHours*60).toFixed(2));
    //     // jQuery("#hamMargin").val((jQuery("#totalsellprice").val() - jQuery("#costprice").val()).toFixed(2)) ;
    // });

    // var totalHours=0;
    // jQuery(".packer-name-text").each(function() {
    //     totalHours+= parseFloat(jQuery(this).val());
    // });
    // if(totalHours > 0){
    //     // jQuery('.packer-name-text').trigger('blur');
    //     // jQuery('.packer-name-text:eq(0)').trigger('blur');
    // }
    
});



function ajaxContact(formData) {

    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "contacts/add_contact",
        data: formData,
        success: function (response) {
            var res = JSON.parse(response);
            //  console.log(res);
            if (res.error) {
                jQuery(".alert-danger").show();
                jQuery(".alert-danger").html(res.error);
            } else if (res.expired) {
                window.location = BASE_URL;
            } else {
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

//04-09-19 start

jQuery( document ).ready(function() {
    jQuery("#en_storage_provider").change(function(){
        var storageProvider = jQuery(this).val();
        var storageMovingFromState = jQuery('#movingfromstate').val();
        if(["","Super Easy Storage"].includes(storageProvider)){
            jQuery("input[name=en_storage_provider_street],#en_storage_provider_postcode,#en_storage_provider_suburb").val('');
            jQuery("#en_storage_provider_state").val(jQuery("#en_storage_provider_state option:first").val());
        }
        else if(storageProvider == "Storage Plus"){
            if(storageMovingFromState == 'VIC'){
                changeStorageAddress('167-169 Cremorne Street','3121','Richmond','VIC'); 
            }
            else{
                changeStorageAddress('87-103 Epsom Rd','2018','Rosebery','NSW'); 
            }
        }
        else if(storageProvider = "Holloways Storage"){
            changeStorageAddress('12-28 Arncliffe Street','2205','Wolli Creek','NSW'); 
        }

    });

    //10-09-19 service time start
    jQuery('#serviceTimeStartHour, #serviceTimeStartMinute, #serviceTimeEndHour, #serviceTimeEndMinute').select2({ width: 'auto'});

    jQuery("#serviceTimeStartHour, #serviceTimeStartMinute, #serviceTimeEndHour, #serviceTimeEndMinute").change(function(){
        var moveType = jQuery('#enquirymovetype').val();
        var startHour=jQuery('#serviceTimeStartHour').val();
        var startMinute=jQuery('#serviceTimeStartMinute').val();
        var endHour=jQuery('#serviceTimeEndHour').val();
        var endMinute=jQuery('#serviceTimeEndMinute').val();
        var serviceFullTime = '';
        var seperatedHourStart='';
        var seperatedHourEnd='';
        var startFormat = '';
        var endFormat = '';

        if(jQuery(this).attr('id') == 'serviceTimeStartHour'){
            var endHourArr = ['9pm','8pm','7pm','6pm','5pm','4pm','3pm','2pm','1pm','12pm','11am','10am','9am','8am','7am','6am'];
            jQuery.each(endHourArr, function (i, item) {
                if(jQuery("#serviceTimeEndHour option[value='"+ item +"']").length > 0){
                    // console.log("present");
                }
                else{
                    // console.log("not present");
                    jQuery('#serviceTimeEndHour').prepend(jQuery('<option>', { 
                        value: item,
                        text : item 
                    }));
                }
            });

            var selectedVal = jQuery(this).val();
            jQuery("#serviceTimeStartHour option").each(function()
            {
                var thisVal = jQuery(this).val();


                if(thisVal == ''){
                    $('#serviceTimeEndHour option')
                    .filter(function() {
                        return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
                    })
                    .remove();    
                }
                else{
                    jQuery("#serviceTimeEndHour  option[value=" + thisVal + "]").remove();
                    if(selectedVal == jQuery(this).val()){
                        return false;
                    }    
                }
            });
            jQuery('#serviceTimeEndHour').val(jQuery('#serviceTimeEndHour').val());
        }
        endHour=jQuery('#serviceTimeEndHour').val();
        
        if(startHour.indexOf('am') != -1){
            seperatedHourStart = startHour.substr(0, startHour.indexOf('am'));
            startFormat = 'am';
        }
        else{
            seperatedHourStart = startHour.substr(0, startHour.indexOf('pm'));
            startFormat = 'pm';
            seperatedHourStart = parseInt(seperatedHourStart)+parseInt(12);
        }

        if(endHour.indexOf('am') != -1){
            seperatedHourEnd = endHour.substr(0, endHour.indexOf('am'));
            endFormat = 'am';
        }
        else{
            seperatedHourEnd = endHour.substr(0, endHour.indexOf('pm'));
            endFormat = 'pm';
            seperatedHourEnd = parseInt(seperatedHourEnd)+parseInt(12);
        }
        
        var startFullTime =seperatedHourStart;
        var endFullTime =seperatedHourEnd;

        if(startMinute != '00'){
            startFullTime = seperatedHourStart + ':'+startMinute;
        }
        if(endMinute != '00'){
            endFullTime = seperatedHourEnd + ':'+endMinute;
        }

        if(['1','2','6'].includes(moveType)){
            tempStartMinute = (startMinute) == '00' ? '' : (':'+ startMinute);
            serviceFullTime = ((seperatedHourStart) > 12 ? parseInt(seperatedHourStart) - parseInt(12) : seperatedHourStart ) +  tempStartMinute + startFormat;
        }
        else if(moveType== '4' ||  moveType == '5'){
            var tempStartHour = seperatedHourStart;
            var tempEndHour = seperatedHourEnd;
            if(seperatedHourStart == 24 || seperatedHourStart == 12){
                seperatedHourStart = seperatedHourStart - 12;
            }
            if(seperatedHourEnd == 24){
                seperatedHourEnd = seperatedHourEnd - 12;
            }

            serviceFullTime = ((seperatedHourStart) > 12 ? parseInt(seperatedHourStart) - parseInt(12) : seperatedHourStart) + ':' + startMinute + startFormat + '-' + (seperatedHourEnd > 12 ? parseInt(seperatedHourEnd) - parseInt(12) : seperatedHourEnd) + ':' + endMinute + endFormat;

            var packingStartFullTime='';
            var packingEndFullTime = '';
            if(startMinute == '00'){
                packingStartFullTime = seperatedHourStart + ':00';
            }
            else{
                packingStartFullTime = seperatedHourStart + ':'+startMinute;
            }
            if(endMinute == '00'){
                packingEndFullTime = seperatedHourEnd + ':00';
            }
            else{
                packingEndFullTime = seperatedHourEnd + ':'+endMinute;
            }

            var d = new Date();
            var todayDate = (d.getMonth()+1) + "/" + d.getDate() + "/" + d.getFullYear();
            var dtStart = new Date(todayDate + ' ' + packingStartFullTime);
            var dtEnd = new Date(todayDate + ' ' + packingEndFullTime);
            var timeDiff = Math.abs(dtStart - dtEnd);
            var hh = Math.floor(timeDiff / 1000 / 60 / 60);
            timeDiff -= hh * 1000 * 60 * 60;
            var mm = Math.floor(timeDiff / 1000 / 60);
            var hours = hh * 60;          
            var tmin = parseFloat(hours) + parseFloat(mm);
            var remaining = tmin;
            var hrs = Math.floor(remaining / 60);
            var min = remaining % 60;
            var formattedMin = '00';
            if(min == '00'){
                formattedMin = '.00';
            }
            else if(min == '15'){
                formattedMin = '.25';
            }
            else if(min == '30'){
                formattedMin = '.50';
            }
            else if(min == '45'){
                formattedMin = '.75';
            }
            if(!isNaN(hrs +formattedMin)){
                jQuery("#hoursbooked").val(hrs +formattedMin).trigger('change');
                // console.log(hrs +formattedMin);
            }
        }
        jQuery('#serviceFullTime').val(serviceFullTime);
        // console.log(serviceFullTime);
    });
    //10-09-19 service time end

});

 //04-09-19 end

 //10-09-19 start
function changeStorageAddress($street, $postcode, $suburb, $state){
    jQuery("input[name=en_storage_provider_street]").val($street);
    jQuery("#en_storage_provider_postcode").val($postcode);
    jQuery("#en_storage_provider_suburb").val($suburb);
    jQuery('#en_storage_provider_state').val($state);
}

jQuery('#movingfromstate').on('change', function() {
    jQuery("#en_storage_provider").trigger('change');
});

//10-09-19 end

// 16-09-19 non-billable start

jQuery('body').on('change, blur','.non-billable-packer-name-text', function(e) {
    var totalNonBillableHours=0;
    jQuery(".non-billable-packer-name-text").each(function() {
        if(jQuery(this).val() != ''){
            totalNonBillableHours+= parseFloat(jQuery(this).val());
        }
    });
    if(jQuery(this).val() == ''){
        jQuery(this).val('0.00');
    }
    else{
        jQuery(this).val(parseFloat(jQuery(this).val()).toFixed(2));
    }

    var moveType= jQuery("#enquirymovetype").val();
    var movingFromState ='';
    if(moveType == '4'){
        movingFromState=jQuery("#movingfromstate").val();
    }
    else if(moveType == '5'){
        movingFromState=jQuery("#movingtostate").val();
    }
    var dateFormat = jQuery('#servicedate').val();
    var hoursBooked = jQuery('#hoursbooked').val();
    var noOfLadies = jQuery('#bookedladies').val();

    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "pricelist/getRules",
        data: { moveType : moveType, datepicker : dateFormat,state:movingFromState },
        success: function (response) {
            var res = JSON.parse(response);
            var totalHours = (hoursBooked * noOfLadies) + totalNonBillableHours;
            jQuery('#costprice').val((parseFloat(totalHours) * parseFloat(res[0].packer_cost_price)).toFixed(2));
            jQuery("#costprice").trigger('blur'); 
        }
    });
});


// 16-09-19 non-billable end

jQuery("body").on("click blur", "#servicet", function(event){
    jQuery('#serviceFullTime').val(jQuery(this).val());
});
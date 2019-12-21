var Enquiry = function() {

    var handleEnquiry = function() {

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
                // en_servicetime: {
                //     required: true,
                // },
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
                serviceTimeStartHour: {
                    required: true
                },
                serviceTimeEndHour: {
                    required: true
                },
                en_additional_item: {
                    required: function(element) {
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
                // en_servicetime: {
                //     required: "Service time is required."
                // },
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
                },
                serviceTimeStartHour: {
                    required: "Service Start Time is required.",
                },
                serviceTimeEndHour: {
                    required: "Service End Time is required.",
                },
            },
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
                } else if (element.attr("name") == "serviceTimeStartHour") {
                    error.insertAfter('#serviceStartRow');
                } else if (element.attr("name") == "serviceTimeEndHour") {
                    error.insertAfter('#serviceEndRow');
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            submitHandler: function(form) {
                var formData = jQuery("#enquiry-form").serializeArray();
                ajaxEnquiry(new FormData(form));
            }
        });
        jQuery.validator.addMethod("regx", function(value, element, regexpr) {
            if (value != "") {
                return regexpr.test(value);
            } else {
                return true;
            }
        }, "Enter valid Phone number.");
        jQuery.validator.addMethod("regxdate", function(value, element, regexpr) {
            if (value != "") {
                return regexpr.test(value);
            } else {
                return true;
            }
        }, "Enter valid Date.");
        $('#enquiry-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('#enquiry-form').validate().form()) {
                    var formData = jQuery("#enquiry-form")[0];
                    ajaxEnquiry(new FormData(formData));

                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function() {
            handleEnquiry();
        }
    };
}();

jQuery(document).ready(function() {
    Enquiry.init();
});
jQuery(function() {
    $("#servicedate").datepicker({
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
    $("#deliverydate").datepicker({
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
    $("#eftreceivedon").datepicker({
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
    $("#movingstoragedate").datepicker({
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
    $("#anniversaryDate").datepicker({
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

});



function ajaxEnquiry(formData) {

    if (jQuery('.additionalPickuptxt').length > 0) {
        jQuery(".additionalPickuptxt").each(function() {
            if (jQuery(this).find('.suburbpickup .addpickupsuburb').val() == '') {
                jQuery(this).remove();
            }
        })
    }
    if (jQuery('.additionalDeliverytxt').length > 0) {
        jQuery(".additionalDeliverytxt").each(function() {
            if (jQuery(this).find('.suburbdelivery .adddeliverysuburb').val() == '') {
                jQuery(this).remove();
            }
        })
    }

    var moveType = jQuery('#enquirymovetype').val();
    if (['1', '2'].includes(moveType)) {
        if (parseFloat($('#clienthourlyrate').val()) < parseFloat($('#travelfee').val())) {
            alert('Hourly rate is less than travel fee.');
        }
    }
    var movers = $('#movers').val();
    var chr = $('#clienthourlyrate').val();
    $(".ajaxLoader").show();
    jQuery.ajax({
        type: 'POST',
        //        processData: false,
        //        contentType: false,
        url: BASE_URL + "enquiries/add_enquiries",
        data: jQuery("#enquiry-form").serializeArray(),
        success: function(response) {
            $(".ajaxLoader").hide();
            var res = JSON.parse(response);
            if (res.error) {
                toastr.error(res.error);
            } else if (res.expired) {
                window.location = BASE_URL;
            } else {
                var id = res.uniqueid;
                toastr.success('Data inserted succefully');
                window.location = BASE_URL + "enquiries/viewEnquiries/" + id
            }
        }
    })
}



jQuery(document).ready(function() {

    jQuery(".additional-charges-packer-section").hide();

    jQuery(".add_field_button_packers").click(function() {
        jQuery(".additional-charges-packer-section").toggle(1000);
    });


    /**
     * Suburb autocomplete.............................@DRCZ
     */
    jQuery(".suburb").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: BASE_URL + "enquiries/getsuburbdata",
                dataType: "json",
                data: request,
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 3,
        select: function(event, ui) {
            if (window.console)
            // console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                jQuery(this).attr("data-selected", "true");
        }
    });

    jQuery("#movingfromsuburb").autocomplete({
        close: function(event, ui) {
            var suburbstr = jQuery("#movingfromsuburb").val();
            var suburbarr = suburbstr.split(",");
            jQuery('#movingfrompostcode').val(suburbarr[1].trim());
            jQuery('#movingfromstate').val(suburbarr[2].trim());
            jQuery('#movingfromsuburb').val(suburbarr[0].trim());
            jQuery("#movingfromsuburb").trigger('change');
        }
    });

    jQuery("#movingtosuburb").autocomplete({
        close: function(event, ui) {
            var suburbstr = jQuery("#movingtosuburb").val();
            var suburbarr = suburbstr.split(",");
            jQuery('#movingtopostcode').val(suburbarr[1].trim());
            jQuery('#movingtostate').val(suburbarr[2].trim());
            jQuery('#movingtosuburb').val(suburbarr[0].trim());
            jQuery("#movingtosuburb").trigger('change');
        }
    });

    jQuery('body').on("focus", ".addpickupsuburb", function() {
        jQuery(this).autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: BASE_URL + "enquiries/getsuburbdata",
                    dataType: "json",
                    data: request,
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 3,
            select: function(event, ui) {
                if (window.console)
                // console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                    jQuery(this).attr("data-selected", "true");
            },
            close: function(event, ui) {

                var suburbstr = jQuery(this).val();
                var suburbarr = suburbstr.split(",");
                jQuery(this).closest('.additionalPickuptxt').find(".postcodepickup").find(".addpickuppostcode").val(suburbarr[1].trim());
                jQuery(this).closest('.additionalPickuptxt').find(".suburbpickup").find(".addpickupsuburb").val(suburbarr[0].trim());
                jQuery(this).closest('.additionalPickuptxt').find(".suburbpickup").find(".addpickupstate").val(suburbarr[2].trim());
                jQuery(this).trigger('change');

            }
        });
    });
    jQuery('body').on("focus", ".adddeliverysuburb", function() {
        jQuery(this).autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: BASE_URL + "enquiries/getsuburbdata",
                    dataType: "json",
                    data: request,
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 3,
            select: function(event, ui) {
                if (window.console)
                // console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
                    jQuery(this).attr("data-selected", "true");
            },
            close: function(event, ui) {

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
    jQuery("#removalist").blur(function() {
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
        source: function(request, response) {
            var enqstate = jQuery("#movingfromstate").val();
            $.ajax({
                url: BASE_URL + "enquiries/getcontactid/" + enqstate,
                dataType: "json",
                data: request,
                success: function(data) {
                    if (data.items.length > 0) {
                        response($.map(data.items, function(item) {
                            return {
                                label: item.name,
                                value: item.id
                            };
                        }));
                    } else {
                        jQuery("#removalist_data").val('');
                        response([{ label: 'No results found.', value: -1 }]);
                    }

                    //                    response(data);
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
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
    jQuery("body").on("click", ".rm-removalist", function() {
        if (confirm("Are you sure want to remove removalist?")) {
            var packerIDs = jQuery('#removalist_data').val().trim();
            var packerIDarray = packerIDs.split(",");
            var packerToRemove = jQuery(this).parent("li").data("id");
            var y = jQuery.grep(packerIDarray, function(value) {
                return value != packerToRemove;
            });
            jQuery('#removalist_data').val(y.join(','));
            jQuery(this).parent("li").remove();
        }
    });

    /**
     * Packers autocomplete....................@DRCZ
     */
    jQuery("#packersdata").blur(function() {
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
    jQuery.ui.autocomplete.prototype._renderItem = function(ul, item) {
        return $("<li>")
            //                .attr("data-value", item.value)
            .append(item.label)
            .appendTo(ul);
    };
    jQuery("#packersdata").autocomplete({
        source: function(request, response) {
            var movetype = jQuery("#enquirymovetype option:selected").val();

            if (movetype == "4" || movetype == "7") {
                var enqstate = jQuery("#movingfromstate").val();
            } else if (movetype == "5" || movetype == "8") {
                var enqstate = jQuery("#movingtostate").val();
            }

            $.ajax({
                url: BASE_URL + "enquiries/getpackerid/" + enqstate,
                dataType: "json",
                data: request,
                success: function(data) {
                    if (data.items.length > 0) {
                        response($.map(data.items, function(item) {
                            return {
                                label: item.name,
                                value: item.id
                            };
                        }));
                    } else {
                        // jQuery("#packer_data").val('');
                        jQuery("#packersdata").val('');
                        response([{ label: 'No results found.', value: -1 }]);
                    }
                    //                    response(data);
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            //            if (ui.item.value == "" || ui.item.value == -1) {
            //                jQuery(this).val('');
            //                return false;
            //            }
            if (ui.item.value == "" || ui.item.value == -1) {
                jQuery(this).val('');
                // jQuery("#packer_data").val('');
                jQuery("#packersdata").val('');
                return false;
            }
            jQuery("#packersdata").val('');

            if (jQuery("ul.packer-listed li").hasClass("packer" + ui.item.value)) {

            } else {
                var packerIDs = ui.item.value;
                packerIDs += "," + jQuery('#packer_data').val();
                jQuery('#packer_data').val(packerIDs);
                jQuery(".packer-listed").append("<li class='packer" + ui.item.value + "' data-id='" + ui.item.value + "'>" + ui.item.label + "<span class='fa fa-times rm-packer'></span></li>");

                var packerHoursBooked = parseFloat(jQuery("#hoursbooked").val()).toFixed(2);
                jQuery("#packer_hours").append('<div class="form-group packer-div-' + ui.item.value + '"><label class="control-label col-md-6 packer-name-label">' + ui.item.label + '</label><div class="col-md-6"><input type="hidden" name="packer-name[]" value="' + ui.item.value + '"><input type="text" class="form-control packer-name-text" name="packer-hours[]" value="' + packerHoursBooked + '"></div></div>');
                jQuery("#packer_hours_non_billable").append('<div class="form-group non-billable-packer-div-' + ui.item.value + '"><label class="control-label col-md-6 packer-name-label">' + ui.item.label + '</label><div class="col-md-6"><input type="hidden" name="non-billable-packer-name[]" value="' + ui.item.value + '"><input type="text" class="form-control non-billable-packer-name-text" name="non-billable-packer-hours[]" value="0.00"></div></div>');
            }
            jQuery(this).val("");
            event.preventDefault();

        }
    });

    jQuery("body").on("click", ".rm-packer", function() {
        if (confirm("Are you sure want to remove packer?")) {
            var packerIDs = jQuery('#packer_data').val().trim();
            var packerIDarray = packerIDs.split(",");
            var packerToRemove = jQuery(this).parent("li").data("id");
            jQuery(".packer-div-" + packerToRemove).remove();
            jQuery(".non-billable-packer-div-" + packerToRemove).remove();
            var y = jQuery.grep(packerIDarray, function(value) {
                return value != packerToRemove;
            });
            jQuery('#packer_data').val(y.join(','));
            jQuery(this).parent("li").remove();
        }
    });
    $("#additionalCharges").click(function() {
        var addchage = $('en_additional_charges').val();
        if (addchage == "") {
            toastr.error('Additional item is required');
        }
    });


    $("#namedone, .input-close").click(function() {
        var fnames = $('#enfname').val().trim();
        //var fname = fnames.replace(/\s+/g, '');        
        var fname = fnames.replace(/\s+/g, ' ');
        var lnames = $('#enlname').val().trim();
        //var lname = lnames.replace(/\s+/g, '');
        var lname = lnames.replace(/\s+/g, ' ');
        if (fname != '' && lname != '') {
            $('#enname').val(fname + ' ' + lname);
            jQuery(this).closest('.input-modal').hide();
            jQuery('.input-modal').find('.inmodal-error').hide();
            $('#enfname').val($('#enfname').val().replace(/\s+/g, ' ').trim());
            $('#enlname').val($('#enlname').val().replace(/\s+/g, ' ').trim());
        } else {
            $('#enname').val('');
            jQuery(this).closest('.input-modal').show();
            jQuery('.input-modal').find('.inmodal-error').show().addClass('eshadow').delay('1000').queue(function() {
                $(this).removeClass('eshadow').dequeue();
            });

        }
        //  $('#namedone').dialog('close');

    });


    /*If we enter 4 removalists and put a hourly rate of less than $240, Put warning..............@DRCZ*/
    $("#clienthourlyrate").blur(function() {
        var movers = $('#movers').val();
        var chr = $('#clienthourlyrate').val();
        // if (movers == '4' && chr < '240') {
        //     toastr.warning('Normal price for 4 men is $240');
        // }
    });
    /*If we enter 4 removalists and put a hourly rate of less than $240, Put warning..............@DRCZ*/

    $('#totalsellprice').blur(function() {
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
    $('#costprice').blur(function() {
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
    $('#travelfee').blur(function() {
        var travelfee = $('#travelfee').val();
        if (travelfee != "") {
            var travel = parseFloat(travelfee);
            var tprice = travel.toFixed(2);
            $('#travelfee').val(tprice);
        } else {
            $('#travelfee').val("");
        }
    });
    $('#depositamt').blur(function() {
        var depositamt = $('#depositamt').val();
        if (depositamt != "") {
            var damt = parseFloat(depositamt);
            var depoamt = damt.toFixed(2);
            $('#depositamt').val(depoamt);
        } else {
            $('#depositamt').val("");
        }
    });
    $('#clienthourlyrate').blur(function() {
        var clientrate = $('#clienthourlyrate').val();
        if (clientrate != "") {
            var clirate = parseFloat(clientrate);
            var chr = clirate.toFixed(2);
            $('#clienthourlyrate').val(chr);
        } else {
            $('#clienthourlyrate').val("");
        }
    });
    $('#additionalChargesinput').blur(function() {
        var addicharge = $('#additionalChargesinput').val();
        if (addicharge != "") {
            var ad = parseFloat(addicharge);
            var adc = ad.toFixed(2);
            $('#additionalChargesinput').val(adc);
        } else {
            $('#additionalChargesinput').val("");
        }
    });
    $('#totalsellprice').blur(function() {
        var totalprice = $('#totalsellprice').val();
        if (totalprice != "") {
            var tp = parseFloat(totalprice);
            var tprice = tp.toFixed(2);
            $('#totalsellprice').val(tprice);
        } else {
            $('#totalsellprice').val("");
        }
    });
    $('#costprice').blur(function() {
        var costprice = $('#costprice').val();
        if (costprice != "") {
            var cstprice = parseFloat(costprice);
            var cp = cstprice.toFixed(2);
            $('#costprice').val(cp);
        } else {
            $('#costprice').val("");
        }
    });
    $('#hamMargin').blur(function() {
        var hammargin = $('#hamMargin').val();
        if (hammargin != "") {
            var ham = parseFloat(hammargin);
            var hamm = ham.toFixed(2);
            $('#hamMargin').val(hamm);
        } else {
            $('#hamMargin').val("");
        }
    });
    $('#hoursbooked').blur(function() {
        var hrbooked = $('#hoursbooked').val();
        if (hrbooked != "") {
            var hrb = parseFloat(hrbooked);
            var hrbook = hrb.toFixed(2);
            $('#hoursbooked').val(hrbook);
        } else {
            $('#hoursbooked').val("");
        }
    });
    $('#sellprice').blur(function() {
        var sellprice = $('#sellprice').val();
        if (sellprice != "") {
            var sellP = parseFloat(sellprice);
            var sp = sellP.toFixed(2);
            $('#sellprice').val(sp);
        } else {
            $('#sellprice').val("");
        }
    });


    $("#hoursbooked").blur(function() {
        var hrbook = jQuery('#hoursbooked').val();
        var packingTimePeriod = jQuery('#packing-interval-time').val();
        if (hrbook != packingTimePeriod) {
            toastr.error("Service time hours doesn't match with \'Initial hours booked\'");
        }
    });

    $(".additional-charges-packer").blur(function() {
        $("#hoursbooked").trigger("blur");
    });

    jQuery('#hoursbooked').on('change', function() {
        var HouresValue = jQuery('#hoursbooked').val();
        if (HouresValue == "4" || HouresValue == "4.00") {
            jQuery('.servicetime').val("9am-1pm");
        } else if (HouresValue == "5" || HouresValue == "5.00") {
            jQuery('.servicetime').val("9am-2pm");
        } else if (HouresValue == "6" || HouresValue == "6.00") {
            jQuery('.servicetime').val("9am-3pm");
        } else {
            jQuery('.servicetime').val("");
        }
    });

    /* Auto calculation of sellprice for Packing/Unpacking.......@DRCZ */

    /**
     * Delete enquiry..............@DRCZ
     */
    $("body").on("click", ".deleteenquiry", function() {
        //$(".deleteenquiry").click(function () {
        if (confirm("Are you sure want to delete enquiry?")) {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'enquiries/deleteEnquiry/' + id,
                success: function(response) {
                    var res = JSON.parse(response);
                    //  console.log(res);
                    if (res.error) {
                        toastr.error('Something wrong.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    } else {
                        toastr.success('Enquiry has been deleted.');
                        window.location = BASE_URL + "enquirieslist";
                    }
                }
            })
        }
    })
})

// 24-04-19 new price rule start

jQuery(document).ready(function() {
    changeEnquiryMoveType('1');
    $('#enquirymovetype').on('change', function() {
        var data = $(this, ":selected").val();
        changeEnquiryMoveType(data);
        if ($("#servicedate").val() != "") {
            setValues();
        }
    });

    jQuery('select[name="en_no_of_movers1"],#servicedate,#trucks-select,#movingfromstate,#movingtostate,#hoursbooked,#bookedladies').on('change', function() {
        setValues();
    });


    $("#movers").focusout(function() {
        if ($("#servicedate").val() == "") {
            alert("Please fill Service date");
            $("#servicedate").focus();
            return false;
        }
        setValues('customMovers');
    });
});

function changeEnquiryMoveType(data) {
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
        $("#hoursbooked").val('');
        $("#bookedladies").val('');
        $("#sellprice").val('');
        $(".additional-charges-packer").attr("disabled", "disabled");
        $(".additional-charges-item-packer").attr("disabled", "disabled");
        $('#serviceFullTime').val('8am');
        jQuery('#hosServiceTimeContainer').removeClass('fhide');
        jQuery('#packerServiceTimeContainer').addClass('fhide');
    } else if (data == "2") {
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
        $("#hoursbooked").val('');
        $("#bookedladies").val('');
        $("#sellprice").val('');
        $('#serviceFullTime').val('8am');
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
        $(".additional-charges-packer").attr("disabled", "disabled");
        $(".additional-charges-item-packer").attr("disabled", "disabled");
        $('#serviceFullTime').val('8am');
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
        // $("#servicet").val('9am-1pm');
        $("#hoursbooked").val('4.00');
        $("#bookedladies").val('2');
        //$("#sellprice").val('480.00');
        $("#depositamt").val('');
        $("#movers").val('');
        $("#trucks").val('');
        $("#travelfee").val('');
        $("#clienthourlyrate").val('');
        $(".additional-charges-packer").val("");
        $(".additional-charges-item-packer").val("");
        $(".additional-charges-packer").removeAttr("disabled");
        $(".additional-charges-item-packer").removeAttr("disabled");
        $(".add_field_button_packers").addClass("fhide");
        $('#serviceTimeStartHour').val('9am').trigger('change');
        $('#serviceTimeEndHour').val('1pm').trigger('change');
        $('#serviceFullTime').val('9am-1pm');
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
        // $("#servicet").val('9am-1pm');
        $("#hoursbooked").val('4.00');
        $("#bookedladies").val('2');
        //$("#sellprice").val('480.00');
        $("#depositamt").val('');
        $("#movers").val('');
        $("#trucks").val('');
        $("#travelfee").val('');
        $("#clienthourlyrate").val('');
        $(".additional-charges-packer").val("");
        $(".additional-charges-item-packer").val("");
        $(".additional-charges-packer").removeAttr("disabled");
        $(".additional-charges-item-packer").removeAttr("disabled");
        $(".add_field_button_packers").addClass("fhide");
        $('#serviceTimeStartHour').val('9am').trigger('change');
        $('#serviceTimeEndHour').val('1pm').trigger('change');
        $('#serviceFullTime').val('9am-1pm');
        jQuery('#hosServiceTimeContainer').addClass('fhide');
        jQuery('#packerServiceTimeContainer').removeClass('fhide');

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
        $(".additional-charges-packer").attr("disabled", "disabled");
        $(".additional-charges-item-packer").attr("disabled", "disabled");
        $('#serviceFullTime').val('8am');
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
        $(".additional-charges-packer").attr("disabled", "disabled");
        $(".additional-charges-item-packer").attr("disabled", "disabled");
    }
}

function setValues($customMovers = "") {

    if ($("select[name='en_no_of_movers1']").val() != 'other' && $("#servicedate").val() == "") {
        $("#servicedate").focus();
        // alert("Please fill Service Date");
        return false;
    }

    var moveType = $("#enquirymovetype").val();
    var inputDate = toDate($("#servicedate").val());
    var numberOfMovers = $("select[name='en_no_of_movers1']").val();
    var todaysDate = new Date();
    var movingFromState = jQuery("#movingfromstate").val();
    if (moveType == '5') {
        movingFromState = jQuery("#movingtostate").val();
    }
    var dateFormat = '';

    if (jQuery("#movers").css("display") == "inline-block") {
        numberOfMovers = jQuery("#movers").val();
    }
    var numberOfTrucks = jQuery("#trucks-select").val();
    if (jQuery("#trucks").css("display") != "none") {
        numberOfTrucks = jQuery("#trucks").val();
    }

    var today = new Date();
    var dateFormat = GetDateFormat(inputDate);
    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "pricelist/getRules",
        data: { moveType: moveType, datepicker: dateFormat, noOfTrucks: numberOfTrucks, noOfMovers: numberOfMovers, state: movingFromState },
        success: function(response) {
            var res = JSON.parse(response);
            // console.log(res);
            if (res == null) {
                if (moveType == '1' || moveType == '2') {
                    jQuery("#travelfee").val('');
                    jQuery("#clienthourlyrate").val('');
                } else if (moveType == '4' || moveType == '5') {
                    jQuery("#sellprice").val('');
                }
            } else {
                if (res[0].movetype == '1' || res[0].movetype == '2') {
                    jQuery("#travelfee").val(parseInt(res[0].travel_fee).toFixed(2));
                    jQuery("#clienthourlyrate").val(parseInt(res[0].client_hour_rate).toFixed(2));
                    if (res[0].rule_type == '3') {
                        jQuery("#travelfee, #clienthourlyrate").addClass('holiday-highlighter');
                    } else {
                        jQuery("#travelfee, #clienthourlyrate").removeClass('holiday-highlighter');
                    }
                } else if (res[0].movetype == '4' || res[0].movetype == '5') {
                    var hoursbooked = jQuery("#hoursbooked").val();
                    var bookedLadies = jQuery("#bookedladies").val();
                    if (hoursbooked != '' && bookedLadies != '') {
                        jQuery("#sellprice").val((parseFloat(res[0].per_person_packing_rate) * parseFloat(hoursbooked) * parseFloat(bookedLadies)).toFixed(2));
                    }
                    if (res[0].rule_type == '5') {
                        jQuery("#sellprice").addClass('holiday-highlighter');
                    } else {
                        jQuery("#sellprice").removeClass('holiday-highlighter');
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
    return day + '-' + month + '-' + date.getFullYear();
}

function setFees($travelfee, $clienthourlyrate) {
    $("#travelfee").val($travelfee);
    $("#clienthourlyrate").val($clienthourlyrate);
}

function toDate(dateStr) {
    var parts = dateStr.split("-")
    return new Date(parts[2], parts[1] - 1, parts[0])
}

// new price rule end

//Add New Contact.............................

var Contact = function() {

    var handleContact = function() {

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
                var formData = jQuery("#contact-form").serializeArray();
                ajaxContact(formData);
            }
        });

        $('#contact-form input').keypress(function(e) {
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
        init: function() {
            handleContact();
        }
    };
}();

jQuery(document).ready(function() {
    Contact.init();

    //storage - 09-08-19 start
    jQuery('input[name=en_quotedcost_price]').on('change', function(e) {
        var storageCost = jQuery('input[name=en_quotedcost_price]').val();
        jQuery(this).val(parseFloat(storageCost).toFixed(2));
        if (jQuery('input[name=en_quotedsell_price]').val() != '') {
            var storageSell = jQuery('input[name=en_quotedsell_price]').val();
            jQuery('input[name=en_hireamover_margin]').val((storageSell - storageCost).toFixed(2));
        }

    });
    //storage - 09-08-19 end

});



function ajaxContact(formData) {

    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "contacts/add_contact",
        data: formData,
        success: function(response) {
            var res = JSON.parse(response);
            if (res.error) {
                jQuery(".alert-danger").show();
                jQuery(".alert-danger").html(res.error);
            } else if (res.expired) {
                window.location = BASE_URL;
            } else {
                toastr.success('Contact has been inserted succefully');
                //                jQuery(".alert-success").show();
                jQuery("#contact-form").trigger('reset');
                setTimeout(function() {
                    jQuery("#new-people").modal("hide");
                }, 2000);
            }
        }
    })
}

$(document).ready(function() {

    var url = window.location.href;
    if (url.search('new') >= 0 && url.search('enquiries') >= 0) {
        $("input[name=en_email]").autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: 'post',
                    url: BASE_URL + "enquiries/searchEmail",
                    data: { keyword: request.term },
                    dataType: "json",
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.contact_email,
                                value: item.contact_email,
                                fname: item.contact_fname,
                                lname: item.contact_lname,
                                phone: item.contact_phno,
                            }
                        }));
                    }
                });
            },
            minLength: 3,
            select: function(event, ui) {
                $('#enfname').val(ui.item.fname);
                $('#enlname').val(ui.item.lname);
                $('input[name=en_phone]').val(ui.item.phone);
                $('#enname').val(ui.item.fname + ' ' + ui.item.lname);
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            var appendData = "<p>" + item.label + " </p>";
            return $("<li></li>")
                .data("item.autocomplete", item)
                .append(appendData)
                .appendTo(ul);
        };
    }

    jQuery("#enquirymovetype").change(function() {
        if (jQuery(this).val() == '4' || jQuery(this).val() == '5') {
            jQuery(".hours-completed").css("display", "block");
        } else {
            jQuery(".hours-completed").css("display", "none");
        }
    });

    //10-09-19 service time start
    jQuery('#serviceTimeStartHour, #serviceTimeStartMinute, #serviceTimeEndHour, #serviceTimeEndMinute').select2({ width: 'auto' });

    jQuery("#serviceTimeStartHour, #serviceTimeStartMinute, #serviceTimeEndHour, #serviceTimeEndMinute").change(function() {
        var moveType = jQuery('#enquirymovetype').val();
        var startHour = jQuery('#serviceTimeStartHour').val();
        var startMinute = jQuery('#serviceTimeStartMinute').val();
        var endHour = jQuery('#serviceTimeEndHour').val();
        var endMinute = jQuery('#serviceTimeEndMinute').val();
        var serviceFullTime = '';
        var seperatedHourStart = '';
        var seperatedHourEnd = '';
        var startFormat = '';
        var endFormat = '';

        if (jQuery(this).attr('id') == 'serviceTimeStartHour') {
            var endHourArr = ['9pm', '8pm', '7pm', '6pm', '5pm', '4pm', '3pm', '2pm', '1pm', '12pm', '11am', '10am', '9am', '8am', '7am', '6am'];
            jQuery.each(endHourArr, function(i, item) {
                if (jQuery("#serviceTimeEndHour option[value='" + item + "']").length > 0) {
                    // console.log("present");
                } else {
                    // console.log("not present");
                    jQuery('#serviceTimeEndHour').prepend(jQuery('<option>', {
                        value: item,
                        text: item
                    }));
                }
            });

            var selectedVal = jQuery(this).val();
            jQuery("#serviceTimeStartHour option").each(function() {
                var thisVal = jQuery(this).val();


                if (thisVal == '') {
                    $('#serviceTimeEndHour option')
                        .filter(function() {
                            return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
                        })
                        .remove();
                } else {
                    jQuery("#serviceTimeEndHour  option[value=" + thisVal + "]").remove();
                    if (selectedVal == jQuery(this).val()) {
                        return false;
                    }
                }
            });
            jQuery('#serviceTimeEndHour').val(jQuery('#serviceTimeEndHour').val()).trigger('change');
        }
        endHour = jQuery('#serviceTimeEndHour').val();

        if (startHour.indexOf('am') != -1) {
            seperatedHourStart = startHour.substr(0, startHour.indexOf('am'));
            startFormat = 'am';
        } else {
            seperatedHourStart = startHour.substr(0, startHour.indexOf('pm'));
            startFormat = 'pm';
            seperatedHourStart = parseInt(seperatedHourStart) + parseInt(12);
        }

        if (endHour.indexOf('am') != -1) {
            seperatedHourEnd = endHour.substr(0, endHour.indexOf('am'));
            endFormat = 'am';
        } else {
            seperatedHourEnd = endHour.substr(0, endHour.indexOf('pm'));
            endFormat = 'pm';
            seperatedHourEnd = parseInt(seperatedHourEnd) + parseInt(12);
        }

        var startFullTime = seperatedHourStart;
        var endFullTime = seperatedHourEnd;

        if (startMinute != '00') {
            startFullTime = seperatedHourStart + ':' + startMinute;
        }
        if (endMinute != '00') {
            endFullTime = seperatedHourEnd + ':' + endMinute;
        }

        if (['1', '2', '6'].includes(moveType)) {
            tempStartMinute = (startMinute) == '00' ? '' : (':' + startMinute);
            serviceFullTime = ((seperatedHourStart) > 12 ? parseInt(seperatedHourStart) - parseInt(12) : seperatedHourStart) + tempStartMinute + startFormat;
        } else if (moveType == '4' || moveType == '5') {
            var tempStartHour = seperatedHourStart;
            var tempEndHour = seperatedHourEnd;
            if (seperatedHourStart == 24 || seperatedHourStart == 12) {
                seperatedHourStart = seperatedHourStart - 12;
            }
            if (seperatedHourEnd == 24) {
                seperatedHourEnd = seperatedHourEnd - 12;
            }

            serviceFullTime = ((seperatedHourStart) > 12 ? parseInt(seperatedHourStart) - parseInt(12) : seperatedHourStart) + ':' + startMinute + startFormat + '-' + (seperatedHourEnd > 12 ? parseInt(seperatedHourEnd) - parseInt(12) : seperatedHourEnd) + ':' + endMinute + endFormat;

            var packingStartFullTime = '';
            var packingEndFullTime = '';
            if (startMinute == '00') {
                packingStartFullTime = seperatedHourStart + ':00';
            } else {
                packingStartFullTime = seperatedHourStart + ':' + startMinute;
            }
            if (endMinute == '00') {
                packingEndFullTime = seperatedHourEnd + ':00';
            } else {
                packingEndFullTime = seperatedHourEnd + ':' + endMinute;
            }

            var d = new Date();
            var todayDate = (d.getMonth() + 1) + "/" + d.getDate() + "/" + d.getFullYear();
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
            if (min == '00') {
                formattedMin = '.00';
            } else if (min == '15') {
                formattedMin = '.25';
            } else if (min == '30') {
                formattedMin = '.50';
            } else if (min == '45') {
                formattedMin = '.75';
            }
            if (!isNaN(hrs + formattedMin)) {
                jQuery('#packing-interval-time').val(hrs + formattedMin);
                jQuery("#hoursbooked").val(hrs + formattedMin).trigger('change');
                // console.log(hrs +formattedMin);
            }
        }
        serviceFullTime = serviceFullTime.replace(new RegExp(':00', 'g'), '');
        jQuery('#serviceFullTime').val(serviceFullTime);
        // console.log(serviceFullTime);
    });
    //10-09-19 service time end

    jQuery('body').on('change, blur', '.non-billable-packer-name-text', function(e) {
        if (jQuery(this).val() == '') {
            jQuery(this).val('0.00');
        } else {
            jQuery(this).val(parseFloat(jQuery(this).val()).toFixed(2));
        }
    });

});
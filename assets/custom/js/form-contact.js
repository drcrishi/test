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
                },
                contact_lname: {
                    required: true,
                },
                contact_email: {
                    required: true,
                    email: true

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
            //  console.log(res);
            if (res.error) {
               // jQuery(".alert-danger").show();
              //  jQuery(".alert-danger").html(res.error);
              toastr.error(res.error);
            }
            else if (res.expired) {
                        window.location = BASE_URL;
                    }
            else {
                toastr.success('Data inserted succefully');
//                jQuery(".alert-success").show();
                jQuery("#contact-form").trigger('reset');
                setTimeout(function () {
                    jQuery("#new-people").modal("hide");
                }, 2000);
                var table = $('#contactlist').DataTable();
                table.ajax.reload();
            }
        }
    })
}
var editID = "";
jQuery(document).ready(function () {
var scval = jQuery('select.contact-rel').val();
    if (scval == '1' || scval == '2') {
        jQuery("#contact-password").removeClass('fhide');
    } else {
        jQuery("#contact-password").addClass('fhide');
    }


    jQuery('select.contact-rel').change(function () {
        var selval = jQuery(this).val();
        if (selval == '1' || selval == '2') {
            jQuery("#contact-password").removeClass('fhide');
        } else {
            jQuery("#contact-password").addClass('fhide');
        }
    });
//    jQuery(".state").autocomplete({
//        source: function (request, response) {
//            $.ajax({
//                url: BASE_URL + "contacts/getsuburbdata",
//                dataType: "json",
//                data: request,
//                success: function (data) {
//                    //console.log(data);
//                    if (data.items.length > 0) {
//                        response($.map(data.items, function (item) {
//                            return {
//                                //label: item.name,
//                                value: item.name
//                            };
//                        }));
//                    } else {
//                        jQuery("#contactstate").val('');
//                        response([{label: 'No results found.', value: -1}]);
//                    }
//
////                    response(data);
//                }
//            });
//        },
//        minLength: 1,
//        select: function (event, ui) {
//            if (ui.item.value == "" || ui.item.value == -1) {
//                jQuery(this).val('');
//                jQuery("#contactstate").val('');
//                return false;
//            }
//            if (window.console)
//                //   console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
//                this.value = ui.item.value;
//            // jQuery(this).next("input").val(ui.item.value);
//            jQuery('#contactstate').val(ui.item.value);
//            event.preventDefault();
//            // jQuery(this).attr("data-selected", "true");
//        }
//
//
//
//    });

     $("body").on("click", ".editcontact", function () {
        var editCid = $(this).data('id');
        editID = editCid;
        jQuery.ajax({
            type: 'POST',
            url: BASE_URL + 'contacts/editContact/' + editCid,
            success: function (html) {
                // console.log(html);
                jQuery(".edit-contact .modal-body").html(html);
                
                var mscval = jQuery('#edit-contact select.contact-rel').val();                
                if (mscval == '1' || mscval == '2') {
                    jQuery("#contactt-password").removeClass('fhide');
                } else {
                    jQuery("#contactt-password").addClass('fhide');
                }


                jQuery('#edit-contact select.contact-rel').change(function () {
                    var selval = jQuery(this).val();
                    if (selval == '1' || selval == '2') {
                        jQuery("#contactt-password").removeClass('fhide');
                    } else {
                        jQuery("#contactt-password").addClass('fhide');
                    }
                });
                
                var pval = jQuery('.password').val();
            jQuery('#chkpassword').change(function () {
                if (this.checked) {
                    jQuery(".password").removeClass('fhide');
                    jQuery('.password').attr('value', '');
                    jQuery('.password').attr("readonly", false);
                } else {
                    jQuery(".password").addClass('fhide');
                    jQuery('.password').attr('value', pval);
                    jQuery('.password').attr("readonly", true);
                }
            });
           jQuery(".password").addClass('fhide');
            }
        })

        jQuery(".updateContact").click(function () {
//            return false;
            //            jQuery.ajax({
            //                type: 'POST',
            //                url: BASE_URL + 'contacts/updateContactData/' + editCid,
            //                // data: 'contactId=' + editCid,
            //                success: function (response) {
            //                    var res = JSON.parse(response);
            //                    // console.log(res);
            //                    if (res.error) {
            //                        toastr.error('Something wrong.');
            //                    } else {
            //                        toastr.success('Contact updated sucessfully');
            ////                    window.location=BASE_URL+"contacts";
            //                    }
            //                }
            //            })
        })
    })

    $("body").on("click", ".deletecontact", function () {

        if (confirm("Are you sure want to delete contact?")) {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'contacts/deleteContact/' + id,
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
                        toastr.success('Contact has been deleted.');
                        window.location = BASE_URL + "contacts";
                    }
                }
            })
        }
    })

    //set Import data success message......................
    if (jQuery("#truemsg").hasClass("hide")) {
        toastr.success(jQuery("#truemsg").html());
    }

    if (jQuery("#falsemsg").hasClass("hide")) {
        toastr.error(jQuery("#falsemsg").html());
    }


    $("body").on("click", "#deleteContactlist", function () {
        var contactIds = $('.checkbox_val:checked').map(function ()
        {
            return $(this).val();
        }).get();

        if (contactIds.length == 0) {
            toastr.error('Please select Contacts.');
            return false;
        }

        if (confirm("Are you sure want to delete contact?")) {

            $.ajax({
                type: 'POST',
                url: BASE_URL + 'contacts/deleteContactList/',
                data: {ids: contactIds},
                success: function (response) {
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Something wrong.');
                    }
                    else if (res.expired) {
                        window.location = BASE_URL;
                    }
                    else {
                        toastr.success('Contacts has been deleted.');
                        var table = $('#contactlist').DataTable();
                        table.ajax.reload();
                    }
                }
            })
        }
    })
})



var Contact1 = function () {

    var handleContact = function () {

        var contactForm = $('#editcontact-form');
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
                },
                contact_lname: {
                    required: true,
                },
                contact_email: {
                    required: true,
                    email: true

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
                var formData = jQuery("#editcontact-form").serializeArray();
                ajaxContact1(formData);
            }
        });

        $('#editcontact-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#editcontact-form').validate().form()) {
                    var formData = jQuery("#editcontact-form").serializeArray();
                    ajaxContact1(formData);
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
    Contact1.init();

});

function ajaxContact1(formData) {
    var editCid = editID;
    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "contacts/updateContactData/" + editCid,
        data: formData,
        success: function (response) {
            var res = JSON.parse(response);
            //  console.log(res);
            if (res.error) {
                jQuery(".alert-danger").show();
                jQuery(".alert-danger").html(res.error);
            }
            else if (res.expired) {
                        window.location = BASE_URL;
                    }
            else {
                toastr.success('Data updated succefully');
                setTimeout(function () {
                    jQuery("#edit-contact").modal("hide");
                }, 2000);
                var table = $('#contactlist').DataTable();
                table.ajax.reload();
            }
        }
    })

}
jQuery(document).ready(function () {

    jQuery('#edit-contact').on('shown.bs.modal', function (e) {

//        jQuery("#contactstate1").autocomplete({
//            source: function (request, response) {
//                $.ajax({
//                    url: BASE_URL + "contacts/getsuburbdata",
//                    dataType: "json",
//                    data: request,
//                    success: function (data) {
//
//                        if (data.items.length > 0) {
//                            response($.map(data.items, function (item) {
//                                return {
//                                    //label: item.name,
//                                    value: item.name
//                                };
//                            }));
//                        } else {
//                            jQuery("#contactstate1").val('');
//                            response([{label: 'No results found.', value: -1}]);
//                        }
//
////                    response(data);
//                    }
//                });
//            },
//            minLength: 1,
//            select: function (event, ui) {
//                if (ui.item.value == "" || ui.item.value == -1) {
//                    jQuery(this).val('');
//                    jQuery("#contactstate1").val('');
//                    return false;
//                }
//                if (window.console)
//                    //   console.log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
//                    this.value = ui.item.value;
//                // jQuery(this).next("input").val(ui.item.value);
//                jQuery('#contactstate1').val(ui.item.value);
//                event.preventDefault();
//                // jQuery(this).attr("data-selected", "true");
//            }
//        });
    });


});


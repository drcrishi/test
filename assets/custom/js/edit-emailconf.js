var Emailconf = function () {

    var handleEmailconf = function () {

        var emailconfForm = $('#emailconf-form');
        var error1 = $('.alert-danger', emailconfForm);
        var success1 = $('.alert-success', emailconfForm);
        emailconfForm.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                smtp_port: {
                    required: true,
                    maxlength: 15,
                },
                protocol: {
                    required: true,
                    maxlength: 15,
                },
//                smtp_user: {
//                    required: true,
//                    
//                },
//                smtp_pass: {
//                    required: true,
//                    minlength: 3,
//                },
                smtp_host: {
                    required: true,
                },
                jobtype: {
                    required: true,
                }
            },
            messages: {
                smtp_port: {
                    required: "Port is required."
                },
                protocol: {
                    required: "Protocol is required."
                },
//                smtp_user: {
//                    required: "User is required.",
//                    email: "Email is not correct."
//                },
//                smtp_pass: {
//                    required: "Password is required."
//                },
                smtp_host: {
                    required: "Host is required."
                },
                jobtype: {
                    required: "Jobtype is required."
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
                var formData = jQuery(form).serializeArray();
                ajaxEmailconf(new FormData(form));
            }
        });

        $('#emailconf-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#emailconf-form').validate().form()) {
                    var formData = jQuery("#emailconf-form")[0];
                    ajaxEmailconf(new FormData(formData));
//                    var formData = jQuery("#userlogin-form").serializeArray();
//                    ajaxUserprofile(formData);
                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleEmailconf();
        }
    };
}();

jQuery(document).ready(function () {
    Emailconf.init();
});




function ajaxEmailconf(formData) {
    jQuery.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        url: BASE_URL + "EmailConf/editEmailconfData",
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
                toastr.success('Configuration has been successfully updated.');

            }
        }
    })
}

/* START EMAIL CONFIGURATION MASTER @DRCZ */
var Emailconfmaster = function () {

    var handleEmailconfmaster = function () {

        var emailconfFormmaster = $('#emailconfmaster-form');
        var error1 = $('.alert-danger', emailconfFormmaster);
        var success1 = $('.alert-success', emailconfFormmaster);
        emailconfFormmaster.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                smtp_user: {
                    required: true,
                    
                },
                smtp_pass: {
                    required: true,
                    minlength: 3,
                },
                jobtype: {
                    required: true,
                }
            },
            messages: {
                smtp_user: {
                    required: "User is required.",
                    email: "Email is not correct."
                },
                smtp_pass: {
                    required: "Password is required."
                },
                jobtype: {
                    required: "Jobtype is required."
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
                var formData = jQuery(form).serializeArray();
                ajaxEmailconfmaster(new FormData(form));
            }
        });

        $('#emailconfmaster-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#emailconfmaster-form').validate().form()) {
                    var formData = jQuery("#emailconfmaster-form")[0];
                    ajaxEmailconfmaster(new FormData(formData));
//                    var formData = jQuery("#userlogin-form").serializeArray();
//                    ajaxUserprofile(formData);
                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleEmailconfmaster();
        }
    };
}();

jQuery(document).ready(function () {
    Emailconfmaster.init();
});



function ajaxEmailconfmaster(formData) {
    jQuery.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        url: BASE_URL + "EmailConf/editMasterEmailconfData",
        data: formData,
        success: function (response) {
            var res = JSON.parse(response);
            //  console.log(res);
            if (res.error) {
              //  jQuery(".alert-danger").show();
               // jQuery(".alert-danger").html(res.error);
               toastr.error(res.error);
            } else if (res.expired) {
                window.location = BASE_URL;
            } else {
                toastr.success('Data inserted succefully');
                jQuery("#emailconfmaster-form").trigger('reset');

            }
        }
    })
}
/* END EMAIL CONFIGURATION MASTER @DRCZ */


var Login = function () {

    var handleLogin = function () {

        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                },
                remember: {
                    required: false
                }
            },
            messages: {
                username: {
                    required: "Email is required."
                },
                password: {
                    required: "Password is required."
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
                var formData = jQuery(".login-form").serializeArray();
                ajaxLogin(formData);
            }
        });

        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    var formData = jQuery(".login-form").serializeArray();
                    ajaxLogin(formData);
                }
                return false;
            }
        });
    }

    var handleForgetPassword = function () {
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                username: {
                    required: true,
                    email: true
                }
            },
            messages: {
                username: {
                    required: "Email is required.",
                    email: "Enter valid email."
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
                var formData = jQuery(".forget-form").serializeArray();
                ajaxForgotPwd(formData);
            }
        });

        $('.forget-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function () {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });
        $('.forget-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    var formData = jQuery(".forget-form").serializeArray();
                    ajaxForgotPwd(formData);
                }
                return false;
            }
        });
//        jQuery('#back-btn').click(function () {
//            jQuery('.login-form').show();
//            jQuery('.forget-form').hide();
//        });

    }

//    var handleRegister = function () {
//
//        function format(state) {
//            if (!state.id) {
//                return state.text;
//            }
//            var $state = $(
//                    '<span><img src="../assets/global/img/flags/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
//                    );
//
//            return $state;
//        }
//
//        if (jQuery().select2 && $('#country_list').size() > 0) {
//            $("#country_list").select2({
//                placeholder: '<i class="fa fa-map-marker"></i>&nbsp;Select a Country',
//                templateResult: format,
//                templateSelection: format,
//                width: 'auto',
//                escapeMarkup: function (m) {
//                    return m;
//                }
//            });
//
//
//            $('#country_list').change(function () {
//                $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
//            });
//        }
//
//        $('.register-form').validate({
//            errorElement: 'span', //default input error message container
//            errorClass: 'help-block', // default input error message class
//            focusInvalid: false, // do not focus the last invalid input
//            ignore: "",
//            rules: {
//                fullname: {
//                    required: true
//                },
//                email: {
//                    required: true,
//                    email: true
//                },
//                address: {
//                    required: true
//                },
//                city: {
//                    required: true
//                },
//                country: {
//                    required: true
//                },
//                username: {
//                    required: true
//                },
//                password: {
//                    required: true
//                },
//                rpassword: {
//                    equalTo: "#register_password"
//                },
//                tnc: {
//                    required: true
//                }
//            },
//            messages: {// custom messages for radio buttons and checkboxes
//                tnc: {
//                    required: "Please accept TNC first."
//                }
//            },
//            invalidHandler: function (event, validator) { //display error alert on form submit   
//
//            },
//            highlight: function (element) { // hightlight error inputs
//                $(element)
//                        .closest('.form-group').addClass('has-error'); // set error class to the control group
//            },
//            success: function (label) {
//                label.closest('.form-group').removeClass('has-error');
//                label.remove();
//            },
//            errorPlacement: function (error, element) {
//                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
//                    error.insertAfter($('#register_tnc_error'));
//                } else if (element.closest('.input-icon').size() === 1) {
//                    error.insertAfter(element.closest('.input-icon'));
//                } else {
//                    error.insertAfter(element);
//                }
//            },
//            submitHandler: function (form) {
//                form[0].submit();
//            }
//        });
//
//        $('.register-form input').keypress(function (e) {
//            if (e.which == 13) {
//                if ($('.register-form').validate().form()) {
//                    $('.register-form').submit();
//                }
//                return false;
//            }
//        });
//
//        jQuery('#register-btn').click(function () {
//            jQuery('.login-form').hide();
//            jQuery('.register-form').show();
//        });
//
//        jQuery('#register-back-btn').click(function () {
//            jQuery('.login-form').show();
//            jQuery('.register-form').hide();
//        });
//    }

    return {
        //main function to initiate the module
        init: function () {

            handleLogin();
            handleForgetPassword();
         //   handleRegister();

        }

    };

}();

jQuery(document).ready(function () {
    Login.init();
});

function ajaxLogin(formData) {
    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "ajaxLogin",
        data: formData,
        success: function (response) {
            var res = JSON.parse(response);
            if (res.error) {
                jQuery(".alert-danger").show();
                jQuery(".alert-danger").html(res.error);
            } else if(res.success == 1){
                window.location = BASE_URL + "enquirieslist";
            }else{
                window.location = BASE_URL + "driver/userbookinglist";
            }
        }
    })
}

function ajaxForgotPwd(formData) {
    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "login/ajaxForgotPwd",
        data: formData,
        success: function (response) {
            var res = JSON.parse(response); 
            if (res.error) {
                toastr.error('No user can be found for this email address!');
            } else {
                toastr.success('Email sent successfully for new password.');
                window.location = BASE_URL;
            }
        }
    })
}
var Userprofile = function () {

    var handleUserprofile = function () {

        var userprofileForm = $('#userlogin-form');
        var error1 = $('.alert-danger', userprofileForm);
        var success1 = $('.alert-success', userprofileForm);
        userprofileForm.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                admin_firstname: {
                    required: true,
                    maxlength: 15,
                },
                admin_lastname: {
                    required: true,
                    maxlength: 15,
                },
                username: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 3,
                }
            },
            messages: {
                admin_firstname: {
                    required: "First name is required."
                },
                admin_lastname: {
                    required: "Last name is required."
                },
                username: {
                    required: "Username is required.",
                    email: "Email is not correct."
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
                var formData = jQuery(form).serializeArray();
                ajaxUserprofile(new FormData(form));
            }
        });

        $('#userlogin-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#userlogin-form').validate().form()) {
                    var formData = jQuery("#userlogin-form")[0];
                    ajaxUserprofile(new FormData(formData));
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
            handleUserprofile();
        }
    };
}();

jQuery(document).ready(function () {
    Userprofile.init();
});



function ajaxUserprofile(formData) {
    jQuery.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        url: BASE_URL + "userprofile/editUserprofileData",
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
                toastr.success('Profile has been successfully updated.');
                jQuery('#adminprofilepic').attr('src', BASE_URL+'/assets/uploads/userprofile/'+res.userprofile);
                // window.location = BASE_URL + "userprofilelist"
                //jQuery("#userlogin-form").trigger('reset');

            }
        }
    })
}
jQuery(document).ready(function(){
      jQuery('body').on('click', '.deleteuserprofile', function () {

        if (confirm("Are you sure want to delete user?")) {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'userprofile/deleteUserprofile/' + id,
                success: function (response) {
                    var res = JSON.parse(response);

                    if (res.error) {
                        toastr.error('Something wrong.');
                    }
                    else if (res.expired) {
                        window.location = BASE_URL;
                    }
                    else {
                        toastr.success('User profile has been deleted.');
                        window.location = BASE_URL + "userprofilelist";
                    }
                }
            })
        }
    })
})






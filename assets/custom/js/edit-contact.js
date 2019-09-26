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
                    number: "Enter only 15 digits."
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
                ajaxContact(formData);
            }
        });

        $('#editcontact-form input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#editcontact-form').validate().form()) {
                    var formData = jQuery("#editcontact-form").serializeArray();
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
    Contact1.init();
});

function ajaxContact1(formData) {
    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "contacts/editContact",
        data: formData,
        success: function (response) {
            var res = JSON.parse(response);
            //  console.log(res);
            if (res.error) {
                jQuery(".alert-danger").show();
                jQuery(".alert-danger").html(res.error);
            } else {
                toastr.success('Data updated succefully');
                setTimeout(function () {
                    jQuery("#edit-contact").modal("hide");
                }, 2000);
            }
        }
    })
}

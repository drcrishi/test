var summerNote = "";
var EmailTemplate = function () {

    var handleEmailTemplate = function () {

        var emailTemplateForm = $('#email_template');
        var error1 = $('.alert-danger', emailTemplateForm);
        var success1 = $('.alert-success', emailTemplateForm);
        emailTemplateForm.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                temp_name: {
                    required: true,
                    maxlength: 50
                },
                move_type: {
                    required: true,
                },
                temp_type: {
                    required: true,
                },
                from: {
                    required: true,
                    maxlength: 40,
                    email: true
                },
                to: {
                    maxlength: 40,
                    email: true

                },
                cc: {
                    maxlength: 40,
                    email: true

                },
                bcc: {
                    maxlength: 40,
                    email: true

                },
                subject: {
                    required: true,
                    maxlength: 70,
                },
            },
            messages: {
                temp_name: {
                    required: "Template name is required."
                },
                move_type: {
                    required: "Move type is required."
                },
                temp_type: {
                    required: "Template type is required."
                },
                from: {
                    required: "From is required.",
                    email: "From email is not valid."
                },
                to: {
                    email: "To email is not valid."
                },
                cc: {
                    email: "Cc email is not valid."
                },
                bcc: {
                    email: "Bcc email is not valid."
                },
                subject: {
                    required: "Subject is required."
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
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            submitHandler: function (form) {
                jQuery(".editor2").val(summerNote.summernote('code'));
                var formData = jQuery("#email_template").serializeArray();
                ajaxEmailTemplate(formData);
            }
        });

        $('#email_template input').keypress(function (e) {
            if (e.which == 13) {
                if ($('#email_template').validate().form()) {
                    jQuery(".editor2").val(summerNote.summernote('code'));
                    var formData = jQuery("#email_template").serializeArray();
                    ajaxEmailTemplate(formData);
                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleEmailTemplate();
        }
    };
}();

jQuery(document).ready(function () {
    EmailTemplate.init();
    summerNote = jQuery('#summernote_1').summernote({
        height: 350,
    });
    summerNote.summernote('code', jQuery(".editor2").val());
});
function ajaxEmailTemplate(formData) {
//    return false;
    $(".ajaxLoader").show();
    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "emailtemplate/seteditemailtemplate",
        data: formData,
        success: function (response) {
            $(".ajaxLoader").hide();
            var res = JSON.parse(response);
            //  console.log(res);
            if (res.error) {
                toastr.error('Something wrong.');
            } else if (res.expired) {
                window.location = BASE_URL;
            } else {
                toastr.success('Data updated successfully.');
            }

        }
    })
}
$(".saveData").click(function () {
    $(".saveEdit").trigger('click');
    return false;
});
$(".deleteData").click(function () {
    if (confirm("Are you sure want to delete email template?")) {
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'emailtemplate/delete/' + id,
            success: function (response) {
                var res = JSON.parse(response);
                //  console.log(res);
                if (res.error) {
                    toastr.error('Something wrong.');
                } else if (res.expired) {
                    window.location = BASE_URL;
                } else {
                    toastr.success('Email template has been deleted.');
                    window.location = BASE_URL + "emailtemplate";
                }
            }
        })
    }
})
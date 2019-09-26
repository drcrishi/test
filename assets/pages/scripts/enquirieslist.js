jQuery(document).ready(function () {
    // Multiple Delete
    $("body").on("click", "#deleteenquirylist", function () {
        var enquirysIds = $('.checkbox_val:checked').map(function ()
        {
            return $(this).val();
        }).get();

        if (enquirysIds.length == 0)
        {
            toastr.error('Please select Enquiries.');
            return false;
        }

        if (confirm("Are you sure want to delete enquiry?")) {

            $.ajax({
                type: 'POST',
                url: BASE_URL + 'enquirieslist/deleteEnquiryList/',
                data: {ids: enquirysIds},
                success: function (response) {
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Something wrong.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    } else {
                        toastr.success('Enquiry has been deleted.');
                        var table = $('#enquirylist').DataTable();
                        table.ajax.reload();
                    }
                }
            })
        }
    })

    // Multiple Qualify...............@DRCZ
    $("body").on("click", "#qualifiedenquirylist", function () {
        var enquirysIds = $('.checkbox_val:checked').map(function ()
        {
            return $(this).val();
        }).get();

        if (enquirysIds.length == 0)
        {
            toastr.error('Please select Enquiries.');
            return false;
        }

        if (confirm("Are you sure want to qualify enquiry?")) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'enquirieslist/qualifyEnquiryList/',
                data: {ids: enquirysIds},
                success: function (response) {
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Something wrong.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    } else {
                        toastr.success('Enquiry has been Qualified.');
                        var table = $('#enquirylist').DataTable();
                        table.ajax.reload();
                    }
                }
            })
        }
    })

    if (jQuery("#truemsg").hasClass("hide")) {
        toastr.success(jQuery("#truemsg").html());
    }
    $("body").on("click", "#duplicateEnqform", function () {
        var chkLen = jQuery(".checkbox_val:checked").length;
        var enquirysIds = $('.checkbox_val:checked').map(function ()
        {
            return $(this).val();
        }).get();
        if (chkLen == 1) {
            if (confirm("Are you sure to duplicate selected enquiry ?")) {
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + 'enquirieslist/getEnquirydataforDuplicate/',
                    data: {ids: enquirysIds},
                    success: function (response) {
                        var res = JSON.parse(response);
                        // console.log(res.id);
                        var enid = res.id;
                        if (res.error) {
                            toastr.error('Something wrong.');
                        } else if (res.expired) {
                            window.location = BASE_URL;
                        } else {
                            toastr.success('Enquiry is saved.');
                            window.location = BASE_URL + "enquiries/viewEnquiries/" + enid+"/d";
//                        var table = $('#enquirylist').DataTable();
//                        table.ajax.reload();
                        }
                    }
                })
            }
        } else if (chkLen == 0) {
            toastr.error('Please select atleast one enquiry.');
            return false;
        } else {
            toastr.error('Multiple selection is not supported.');
            return false;
        }
    })

    /**
     * Send quote mail.............@DRCZ
     */
    jQuery("html body").on("click", ".send-quote-mail", function (e) {

        //duplicate email sent warning
        var result = checkDuplicateMail(jQuery(this).data("id"),jQuery(this).data("movetype"),'Quote');
        if(result == "0"){
            return false;
        }

        //if (confirm("Are you sure to send quote ?")) {
            $(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=Quote&id=" + id;

            jQuery.ajax({
                type: 'POST',
                data: datastr,
                url: BASE_URL + "email/send",
                success: function (response) {
                    $(".ajaxLoader").hide();
                    var res = JSON.parse(response);
                    if (res.error) {
                        toastr.error('Email has not been sent.');
                    } else if (res.success) {
                        toastr.success('Email has been sent.');
                        var table = $('#enquirylist').DataTable();
                        table.ajax.reload();
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
            return false;
       // }
    });

})
function checkDuplicateMail($id,$moveType,$templateType){
    var confirmationVar = "";
    jQuery.ajax({
        type: 'POST',
        async: false,
        url: BASE_URL + "email/getEmailMasterId",
        data: {'enquiry_id':$id, 'moveType' : $moveType,'templateType':$templateType },
        success: function (data) {
            data = JSON.parse(data);
            if(data.code == "1"){
                if (confirm(data.msg)) {
                    confirmationVar="1";
                } else {
                    confirmationVar="0";
                }
            }
            else{
                console.log("");
            }
        }
    });
    return confirmationVar;
}
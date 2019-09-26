
jQuery(document).ready(function () {
  
        jQuery('body').on('click','.viewjobsheetuser', function () {
            var id = jQuery(this).data("id");
            var url = BASE_URL + "driver/userbookinglist/save_download/" + id;
            window.open(url);
        });
        jQuery('body').on('click','.wavierform', function () {
            var id = jQuery(this).data("id");
            var url = "https://www.hireamover.com.au/jobsheet/waiver-form.php?id=" + id;
            window.open(url);
        });
        jQuery('body').on('click', '.printjobsheet', function () {
            var id = jQuery(this).data("id");
            var url = "https://www.hireamover.com.au/jobsheet/?id=" + id;
            window.open(url);
        });

        jQuery('body').on('click', '.jobsheet', function () {
            jQuery(".ajaxLoader").show();
            var id = jQuery(this).data("id");
            var datastr = "emailAction=JobSheet&id=" + id;
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
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    }
                }
            })
        
        });
        
//        jQuery('body').on('click', '.printjobsheet', function () {
//        var id = jQuery(this).data("id");
//        var url = BASE_URL + "driver/userbookinglist/viewJobsheet/" + id;
//        window.open(url);
//    });
});



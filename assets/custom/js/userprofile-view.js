
jQuery(document).ready(function () {

    var tableAjax1 = jQuery('#userprofile').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": { 
            "url":BASE_URL + "userprofile/ajaxUserprofileDatalist",
        },
        "columns": [
            {"data": "admin_firstname"},
            {"data": "admin_lastname"},
            {"data": "username"},
          //  {"data": "null"},
        ],
        
    });
});
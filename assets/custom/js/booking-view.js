
jQuery(document).ready(function () {

    var tableAjax1 = jQuery('#bookinglist').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": { 
            "url":BASE_URL + "booking/ajaxBookingDatalist",
        },
        "columns": [
            {"data": "en_movetype"},
            {"data": "en_home_office"},
            {"data": "en_servicedate"},
            {"data": "en_servicetime"},
            {"data": "en_fname"},
           // {"data": "en_lname"},
           // {"data": "en_phone"},
           // {"data": "null"},
            
        ],
        

    });
});
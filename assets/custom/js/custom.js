/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(".add-more").on('click', function () {
    var dynamicClass = $(this).data('id');
    var elementHtml = $("." + dynamicClass).first().parent("div").html();
    $(this).parent("div").prev(".add-more-div-section").append("<div class='form-group form-md-line-input' style='margin-top: -19px;padding-top: 0px;'>" + elementHtml + "</div>");
    $(".add-more-div-section").find(".formLbl").remove();

});

//Validation

function chkValidation() {
    var requiredRegexp = new RegExp(/^[A-Za-z\s]+$/);
    var emailRegexp = new RegExp(/[a-z\-_.0-9]+[@]{1}[a-z]+[.]{1}[a-z]{2,4}/);
    if (requiredRegexp.test($(".name").val().trim()) == false) {
        $(".name").parent("div").find(".error").remove();
        $(".name").parent("div").append("<span class='error'>This field is required.</span>");
    } else {
        $(".name").parent("div").find(".error").remove();
    }
    $(".email").each(function () {
        $(this).parent("div").find(".error").remove();
        if ($(this).val().trim() == "") {
            $(this).parent("div").append("<span class='error'>This field is required.</span>");
        } else if (emailRegexp.test($(this).val().trim()) == false) {
            $(this).parent("div").append("<span class='error'>Please correct email address format.</span>");
        } else {
            $(this).parent("div").find(".error").remove();
        }
    })

}

$("#people_new_form").submit(function () {
    if (chkValidation()) {
        alert("success");
    }
    return false;
});



/* DRCD Enquery Grid */
$(document).ready(function () {

    var wd = $(window).width();
    if (wd < 1199) {
        $('.alphabet').after('<select class="filter-ul form-control"></select>');
        $('.alphabet > span').each(function () {
            var spclass = $(this).find('span').attr('class');
            var spid = $(this).find('span').attr('id');
            var spval = $(this).find('span').text();
            $('.filter-ul').append('<option class="' + spclass + '" id="' + spid + '">' + spval + '</option>');
        });
        $('.alphabet').html('<p class="filter-title">Search</p>');

        $('.filter-btn').click(function () {
            $('.filter-wrapper').addClass('filter-show');
            $('body').addClass('body-left');
            $('.filter-overlay').addClass('overlay-show');
        });

        $('.filter-overlay').click(function () {
            $('.filter-wrapper').removeClass('filter-show');
            $('body').removeClass('body-left');
            $(this).removeClass('overlay-show');
        });

        $('.filter-close').click(function () {
            $('.filter-wrapper').removeClass('filter-show');
            $('body').removeClass('body-left');
            $('.filter-overlay').removeClass('overlay-show');
        });
        $('.filter-submit').click(function () {
            $('.filter-wrapper').removeClass('filter-show');
            $('body').removeClass('body-left');
            $('.filter-overlay').removeClass('overlay-show');
        });
    }

});

var calcDataTableHeight = function () {
    return $(window).height() - 310;
};
//alert(calcDataTableHeight());
$(document).ready(function () {
    var myData = {};
    var view_enquiries = $("#view_enquiries").val();
    myData.view_enquiries = view_enquiries;
    var quote_received_date = $("#en_date").val();
    myData.en_date = quote_received_date;
    var table = $('#enquirylist').DataTable({
        "columns": [
            {"data": "checkbox_val"},
            {"data": "en_date"},
            {"data": "en_servicedate"},
            {"data": "quoteSent"},
            {"data": "en_fname"},
            {"data": "en_lname"},
            // {"data": "en_phone"},
            {"data": "en_movingfrom_suburb"},
            {"data": "en_movingto_suburb"},
            {"data": "en_movingfrom_state"},
            {"data": "movetype_name"},
            {"data": "sendquote"},
        ],
        "columnDefs": [
            {"targets": [0], "orderable": false, },
            {"targets": [10], "orderable": false, },
            {"width": "30px", "targets": 0},
            {"width": "140px", "targets": 1},
            {"width": "150px", "targets": 6},
            {"width": "55px", "targets": 8},
            // {"width": "80px", "targets": 10},
        ],
        "order": [[1, "desc"]], //for enquiry_id desc

        "scrollY": calcDataTableHeight(),
        "scrollX": true,
        "sScrollXInner": "110%",
        "scrollCollapse": true,
        "processing": true,
        //"autoWidth": false,
        "serverSide": true,
        "bStateSave": false,
        "stateSave": false,
        "pageLength": 100,
        "ajax": {
            url: 'enquirieslist/ajaxData',
            "data": function (d) {
                $.getJSON('enquirieslist/ajaxData', myData, function (json) {
                    if (json.expired == '1') {
                        window.location = BASE_URL;
                    }
                });
                return  $.extend(d, myData);

            },
            type: 'POST'
        }
    });
    //setInterval(function(){table.ajax.reload();},30000)

//    $(".alphasearch").click(function () {
//        $(".alphasearch").removeClass("open");
//        $(this).toggleClass('open');
//        var alpha = $(".open").attr("id");
//        myData.alphabet = alpha;
//
//        var view_enquiries = $("#view_enquiries").val();
//        myData.view_enquiries = view_enquiries;
//        table.ajax.reload();
//    });

    $(".enqsearch").click(function () {
        var fullname = $("#fullname").val();
        myData.fullname = fullname;
        var view_enquiries = $("#view_enquiries").val();
        myData.view_enquiries = view_enquiries;

        // myData.en_lname = fullname;

        table.ajax.reload();
    });

    $("#view_enquiries").change(function () {
        var view_enquiries = $("#view_enquiries").val();
        myData.view_enquiries = view_enquiries;

        var alpha = $(".open").attr("id");
        myData.alphabet = alpha;
        table.ajax.reload();
    });
//}).trigger("change");

    $('#select_all_inq').change(function () {
        var cells = table.cells( ).nodes();
        if ($(this).is(':checked')) {
            $(cells).closest('tr').addClass('select');
            $(cells).closest('tr:last').addClass('lasttr');
            $(cells).find(':checkbox').prop('checked', true);
            var itm = $(cells).parent('tr').length;
            $('.dataTables_info').find('.select-itm').remove();
            $('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
        } else {
            $(cells).closest('tr').removeClass('select');
            $(cells).closest('tr.lasttr').removeClass('lasttr');
            $(cells).find(':checkbox').prop('checked', false);
            $('.dataTables_info').find('.select-itm').remove();
        }

        //$(cells).find(':checkbox').prop('checked', $(this).is(':checked'));

    });



    $('body').on('change', '.filter-ul', function () {
        var selval = $(this).val();
        myData.alphabet = selval;
        table.ajax.reload();
    });

    $('input').on('keypress', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {

            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var fullname = $("#fullname").val();
            var view_enquiries = $("#view_enquiries").val();
            myData.view_enquiries = view_enquiries;
            // var quote_received_date = $("#en_date").val();
            // var service_date = $("#en_servicedate").val();


            myData.first_name = first_name;
            myData.last_name = last_name;
            myData.fullname = fullname;
            // myData.en_date = quote_received_date;
            //  myData.en_servicedate = service_date;

            table.ajax.reload();
        }
    });

    $('select').on('keypress', function (e) {
        var key = e.which;
        if (key == 13)// the enter key code
        {
            var state = $("#state").val();
            var movetype_name = $("#movetype_name").val();
            myData.en_movingfrom_state = state;
            myData.movetype_name = movetype_name;
            table.ajax.reload();
        }
    });
    $("#en_servicedate").on("change", function () {
        var service_date = $("#en_servicedate").val();
        myData.en_servicedate = service_date;

        table.ajax.reload();
    });
    $("#en_date").on("change", function () {
        var quote_received_date = $("#en_date").val();
        myData.en_date = quote_received_date;

        table.ajax.reload();
    });
    $('#apply').click(function () {

        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var state = $("#state").val();
        var movetype_name = $("#movetype_name").val();
        var email = $("#email").val();
        var quote_received_date = $("#en_date").val();
        var service_date = $("#en_servicedate").val();
        var view_enquiries = $("#view_enquiries").val();
        myData.view_enquiries = view_enquiries;


        myData.first_name = first_name;
        myData.last_name = last_name;
        myData.en_movingfrom_state = state;
        myData.movetype_name = movetype_name;
        myData.email = email;
        myData.en_date = quote_received_date;
        myData.en_servicedate = service_date;

        table.ajax.reload();
    });
    $("#reset").click(function () {
        var first_name = $("#first_name").val('');
        var last_name = $("#last_name").val('');
        var state = $("#state").val('');
        var movetype_name = $("#movetype_name").val('');
        var email = $("#email").val('');
        var quote_received_date = $("#en_date").val('');
        var service_date = $("#en_servicedate").val('');


        myData.first_name = "";
        myData.last_name = "";
        myData.en_movingfrom_state = "";
        myData.movetype_name = "";
        myData.email = "";
        myData.en_date = "";
        myData.en_servicedate = "";

        table.ajax.reload();
    });



});

// Filter Datepicker For Quote received date
jQuery(function () {
    $('#enquirylist_filter').hide();
    $('#enquirylist_length').hide();
    $('#en_date').datepicker({dateFormat: 'yy-mm-dd', defaultDate: null, autoUpdateInput: false});
    $('#en_servicedate').datepicker({dateFormat: 'yy-mm-dd', defaultDate: null, autoUpdateInput: false});
});
/* DRCD Enquery Grid */



/* DRCZ Booking Grid */
$(document).ready(function () {
    var myData = {};
    var view_booking = $("#view_booking").val();
    myData.view_booking = view_booking;
    var quote_received_date = $("#en_date").val();
    myData.en_date = quote_received_date;
    var service_date = $("#en_servicedate").val();
    myData.en_servicedate = service_date;
    var en_monthstart = $("#en_monthstart").val();
    myData.en_date1 = en_monthstart;
    var en_monthend = $("#en_monthend").val();
    myData.en_date2 = en_monthend;
    
    var table = $('#bookinglist').DataTable({
        "columns": [
            {"data": "checkbox_val"},
            {"data": "qualified_date"},
            {"data": "booking_created_by"},
            {"data": "en_servicedate"},
            {"data": "contact_fullname"},
            {"data": "en_servicetime"},
            {"data": "clientname"},
            // {"data": "en_lname"},
            //  {"data": "en_phone"},
            {"data": "en_movingfrom_state"},
            {"data": "movetype_name"},
            //  {"data": "is_deposited"},
            {"data": "booking_status"},
            {"data": "JobSheet"},
            {"data": "BookingConfirmation"},
        ],
        "columnDefs": [
            {"targets": [0], "orderable": false, },
            // {"targets": [12], "orderable": false, },
            {"width": "20px", "targets": 0},
            {"width": "130px", "targets": 1},
            {"width": "30px", "targets": 2},
            {"width": "100px", "targets": 3},
            {"width": "180px", "targets": 4},
            {"width": "120px", "targets": 5},
            {"width": "150px", "targets": 6},
            {"width": "60px", "targets": 7},
            {"width": "100px", "targets": 8},
            {"width": "50px", "targets": 9},
            {"width": "50px", "targets": 10},
            {"width": "50px", "targets": 11},
            // {"width": "15%", "targets": 0},
        ],
        "order": [[1, "desc"]], //for enquiry_id desc

        "scrollY": calcDataTableHeight(),
        "scrollX": true,
        "sScrollXInner": "110%",
        "scrollCollapse": true,
        "processing": true,
        //"autoWidth": false,
        "serverSide": true,
        "bStateSave": false,
        "stateSave": false,
        "pageLength": 100,
        "ajax": {
            url: 'bookinglist/ajaxData',
            "data": function (d) {
                $.getJSON('bookinglist/ajaxData', myData, function (json) {
                    if (json.expired == '1') {
                        window.location = BASE_URL;
                    }
                });
                return  $.extend(d, myData);
            },
            type: 'POST'
        }
    });

//    $(".alphasearch").click(function () {
//        $(".alphasearch").removeClass("open");
//        $(this).toggleClass('open');
//        var alpha = $(".open").attr("id");
//        myData.alphabet = alpha;
//
//        var view_booking = $("#view_booking").val();
//        myData.view_booking = view_booking;
//        table.ajax.reload();
//    });

    $('body').on('change', '.filter-ul', function () {
        var selval = $(this).val();
        myData.alphabet = selval;
        table.ajax.reload();
    });

    $('input').on('keypress', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var removalistfilter = $("#removalistfilter").val();
            var fullname = $("#fullname").val();
            var view_booking = $("#view_booking").val();
            myData.view_booking = view_booking;
            myData.first_name = first_name;
            myData.last_name = last_name;
            myData.removalistfilter = removalistfilter;
            myData.fullname = fullname;
            table.ajax.reload();
        }
    });

    $('select').on('keypress', function (e) {
        var key = e.which;
        if (key == 13)// the enter key code
        {

            var movingfromstate = $("#movingfromstate").val();
            var movetype_name = $("#movetype_name").val();

            myData.en_movingfrom_state = movingfromstate;
            myData.movetype_name = movetype_name;
            table.ajax.reload();
        }
    });
    $("#en_servicedate").on("change", function () {
        var service_date = $("#en_servicedate").val();
        myData.en_servicedate = service_date;
        table.ajax.reload();
    });
    $("#en_date").on("change", function () {
        var quote_received_date = $("#en_date").val();
        myData.en_date = quote_received_date;
        table.ajax.reload();
    });
    jQuery('html, body').on('change', '.filterdate', function () {
        var service_date = jQuery(this).val();
        myData.en_servicedate = service_date;
        table.ajax.reload();
    });
    jQuery('html, body').on('change', '.filterdate', function () {
        var service_date = jQuery(this).val();
        myData.en_servicedate = service_date;
        table.ajax.reload();
    });
    $(".bookingsearch").click(function () {
        var fullname = $("#fullname").val();
        myData.fullname = fullname;
        var view_booking = $("#view_booking").val();
        myData.view_booking = view_booking;
        table.ajax.reload();
    });

//    $(".bookingsearch").click(function () {
//        var fullname = $("#fullname").val();
//        myData.fullname = fullname;
//       
//        table.ajax.reload();
//    }).trigger("click");

    $('#select_all_booking').change(function () {
        var cells = table.cells( ).nodes();
        if ($(this).is(':checked')) {
            $(cells).closest('tr').addClass('select');
            $(cells).closest('tr:last').addClass('lasttr');
            $(cells).find(':checkbox').prop('checked', true);
            var itm = $(cells).parent('tr').length;
            $('.dataTables_info').find('.select-itm').remove();
            $('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
        } else {
            $(cells).closest('tr').removeClass('select');
            $(cells).closest('tr.lasttr').removeClass('lasttr');
            $(cells).find(':checkbox').prop('checked', false);
            $('.dataTables_info').find('.select-itm').remove();
        }
    });

    $("#view_booking").change(function () {
        var view_booking = $("#view_booking").val();
        myData.view_booking = view_booking;

        var alpha = $(".open").attr("id");
        myData.alphabet = alpha;
        table.ajax.reload();
    });

    $('#apply').click(function () {

        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var removalistfilter = $("#removalistfilter").val();

        var movingfromstate = $("#movingfromstate").val();
        var movetype_name = $("#movetype_name").val();
        var email = $("#email").val();
        var quote_received_date = $("#en_date").val();
        var service_date = $("#en_servicedate").val();
        var view_booking = $("#view_booking").val();
        myData.view_booking = view_booking;

        myData.first_name = first_name;
        myData.last_name = last_name;
        myData.removalistfilter = removalistfilter;
        myData.en_movingfrom_state = movingfromstate;
        myData.movetype_name = movetype_name;
        myData.email = email;
        myData.en_date = quote_received_date;
        myData.en_servicedate = service_date;

        table.ajax.reload();
    });
    $('#reset').click(function () {

        var first_name = $("#first_name").val('');
        var last_name = $("#last_name").val('');
        var removalistfilter = $("#removalistfilter").val('');
        var movingfromstate = $("#movingfromstate").val('');
        var movetype_name = $("#movetype_name").val('');
        var email = $("#email").val('');
        var quote_received_date = $("#en_date").val('');
        var service_date = $("#en_servicedate").val('');


        myData.first_name = '';
        myData.last_name = '';
        myData.removalistfilter = '';
        myData.en_movingfrom_state = '';
        myData.movetype_name = '';
        myData.email = '';
        myData.en_date = '';
        myData.en_servicedate = '';

        table.ajax.reload();
    });

});
/* DRCZ Booking Grid */

/* DRCD Contact Grid */
$(document).ready(function () {
    var myData = {};
    var table = $('#contactlist').DataTable({
        "columns": [
            {"data": "checkbox_val"},
            {"data": "contactfullname"},
            {"data": "contact_email"},
            {"data": "contact_state"},
            {"data": "contact_phno"},
            //   {"data": "contact_reltype"},
            //   {"data": "edit"},
        ],
        "columnDefs": [
            {"targets": [0], "orderable": false, },
            //  {"targets": [6], "orderable": false, },
            {"width": "30px", "targets": 0},
            {"width": "200px", "targets": 1},
            {"width": "150px", "targets": 4},
        ],
        "order": [[1, "desc"]], //for contact_id desc
        "scrollY": calcDataTableHeight(),
        "scrollX": true,
        "sScrollXInner": "110%",
        "scrollCollapse": true,
        "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "stateSave": true,
        "pageLength": 100,
        "ajax": {
            url: 'contacts/ajaxData',
            "data": function (d) {
                $.getJSON('contacts/ajaxData', myData, function (json) {
                    if (json.expired == '1') {
                        window.location = BASE_URL;
                    }
                });
                return  $.extend(d, myData);
            },
            type: 'POST'
        }
    });
    //setInterval(function(){table.ajax.reload();},30000)

    $(".alphasearch").click(function () {
        $(".alphasearch").removeClass("open");
        $(this).toggleClass('open');
        var alpha = $(".open").attr("id");
        myData.alphabet = alpha;
        table.ajax.reload();
    });
    $('body').on('change', '.filter-ul', function () {
        var selval = $(this).val();
        myData.alphabet = selval;
        table.ajax.reload();
    });

    $('#select_all_contact').change(function () {
        var cells = table.cells( ).nodes();
        if ($(this).is(':checked')) {
            $(cells).closest('tr').addClass('select');
            $(cells).closest('tr:last').addClass('lasttr');
            $(cells).find(':checkbox').prop('checked', true);
            var itm = $(cells).parent('tr').length;
            $('.dataTables_info').find('.select-itm').remove();
            $('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
        } else {
            $(cells).closest('tr').removeClass('select');
            $(cells).closest('tr.lasttr').removeClass('lasttr');
            $(cells).find(':checkbox').prop('checked', false);
            $('.dataTables_info').find('.select-itm').remove();
        }
    });

    $('#apply').click(function () {

        var first_name = $("#contact_fname").val();
        var last_name = $("#contact_lname").val();
        var email = $("#contact_email").val();
        var company_name = $("#company_name").val();
        var phone = $("#phone").val();
        var contact_reltype = $("#contact_reltype").val();
        var contact_state = $("#contact_state").val();

        myData.contact_fname = first_name;
        myData.contact_lname = last_name;
        myData.contact_email = email;
        myData.company_name = company_name;
        myData.contact_phno = phone;
        myData.contact_reltype = contact_reltype;
        myData.contact_state = contact_state;

        table.ajax.reload();
    });
    $('#reset').click(function () {

        var first_name = $("#contact_fname").val('');
        var last_name = $("#contact_lname").val('');
        var email = $("#contact_email").val('');
        var company_name = $("#company_name").val('');
        var phone = $("#phone").val('');
        var reltype = $("#contact_reltype").val('');
        var state = $("#contact_state").val('');

        myData.contact_fname = '';
        myData.contact_lname = '';
        myData.contact_email = '';
        myData.company_name = '';
        myData.contact_phno = '';
        myData.contact_reltype = '';
        myData.contact_state = '';

        table.ajax.reload();
    });
});
/* DRCD Contact Grid */

/* DRCD Email Template Grid */
$(document).ready(function () {
    var myData = {};
    var table = $('#emailtemplatelist').DataTable({
        "columns": [
            {"data": "en_movetype"},
//			{"data": "template_master_id"},
            {"data": "email_master_template_name"},
//			{"data": "email_from"},			
//			{"data": "email_cc"},			
//			{"data": "email_bcc"},			
            {"data": "email_subject"},
            //{"data": "email_editor"},			
//			{"data": "is_deleted"},			
//            {"data": "is_disabled"},
            {"data": "created_date"},
        ],
        "columnDefs": [
            {"width": "110px", "targets": 0},
        ],
//        "columnDefs": [
//           {
//             "targets": [4],
//             "orderable": false,			
//             },
//            //{ "width": "190px", "targets": 0 },
//       ],

        "scrollY": calcDataTableHeight(),
        "scrollX": true,
        "sScrollXInner": "110%",
        "scrollCollapse": true,
        "processing": true,
        //"autoWidth": true,
        "serverSide": true,
        "bStateSave": true,
        "stateSave": true,
        "pageLength": 100,
        "ajax": {
            url: 'emailtemplate/ajaxData',
            "data": function (d) {
                $.getJSON('emailtemplate/ajaxData', myData, function (json) {
                    if (json.expired == '1') {
                        window.location = BASE_URL;
                    }
                });
                return  $.extend(d, myData);
            },
            type: 'POST'
        }
    });




});
/* DRCD Contact Grid */

/*DRCZ User profile grid*/
$(document).ready(function () {
    var myData = {};
    var table = $('#userprofile').DataTable({
        "columns": [
            {"data": "checkbox_val"},
            {"data": "admin_firstname"},
            {"data": "admin_lastname"},
            {"data": "username"},
            // {"data": "edit"},
        ],
        "columnDefs": [
            {"targets": [0], "orderable": false, },
                    //   {"targets": [4], "orderable": false, },
        ],
        "scrollY": calcDataTableHeight(),
        "scrollX": true,
        "sScrollXInner": "110%",
        "scrollCollapse": true,
        "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "stateSave": true,
        "pageLength": 50,
        "ajax": {
            url: 'userprofilelist/ajaxData',
            "data": function (d) {
                $.getJSON('userprofilelist/ajaxData', myData, function (json) {
                    if (json.expired == '1') {
                        window.location = BASE_URL;
                    }
                });
                return  $.extend(d, myData);
            },
            type: 'POST'
        }
    });

    $(".alphasearch").click(function () {
        $(".alphasearch").removeClass("open");
        $(this).toggleClass('open');
        var alpha = $(".open").attr("id");
        myData.alphabet = alpha;
        table.ajax.reload();
    });
    $('body').on('change', '.filter-ul', function () {
        var selval = $(this).val();
        myData.alphabet = selval;
        table.ajax.reload();
    });
    $('#select_all_profile').change(function () {
        var cells = table.cells( ).nodes();
        if ($(this).is(':checked')) {
            $(cells).closest('tr').addClass('select');
            $(cells).closest('tr:last').addClass('lasttr');
            $(cells).find(':checkbox').prop('checked', true);
            var itm = $(cells).parent('tr').length;
            $('.dataTables_info').find('.select-itm').remove();
            $('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
        } else {
            $(cells).closest('tr').removeClass('select');
            $(cells).closest('tr.lasttr').removeClass('lasttr');
            $(cells).find(':checkbox').prop('checked', false);
            $('.dataTables_info').find('.select-itm').remove();
        }
    });

});
/* DRCZ Driver Booking Grid */
$(document).ready(function () {
    var myData = {};
    var driverView_booking = $("#driverView_booking").val();
    myData.driverView_booking = driverView_booking;
    var table = $('#userbookinglist').DataTable({
        "columns": [
            {"data": "checkbox_val"},
            {"data": "en_servicedate"},
            {"data": "booking_status"},
            {"data": "en_servicetime"},
            {"data": "clientname"},
            // {"data": "en_lname"},
            //  {"data": "en_phone"},
            {"data": "en_movingfrom_state"},
            {"data": "en_movingfrom_suburb"},
            {"data": "en_movingto_suburb"},
            //  {"data": "is_deposited"},
            {"data": "movetype_name"},
            {"data": "jobsheet"},
        ],
        "columnDefs": [
            {"targets": [0], "orderable": false, },
            {"targets": [9], "orderable": false, },
            {"width": "20px", "targets": 0},
            {"width": "550px", "targets": 9},
        ],
        "order": [[1, "desc"]], //for enquiry_id desc

        "scrollY": calcDataTableHeight(),
        "scrollX": true,
        "sScrollXInner": "110%",
        "scrollCollapse": true,
        "processing": true,
        //"autoWidth": false,
        "serverSide": true,
        "bStateSave": true,
        "stateSave": true,
        "pageLength": 100,
        "ajax": {
            url: 'userbookinglist/ajaxData',
            "data": function (d) {
                $.getJSON('userbookinglist/ajaxData', myData, function (json) {
                    if (json.expired == '1') {
                        window.location = BASE_URL;
                    }
                });
                return  $.extend(d, myData);
            },
            type: 'POST'
        }
    });

    $(".userbookingsearch").click(function () {
        var userfullname = $("#userfullname").val();

        myData.userfullname = userfullname;
        // myData.en_lname = fullname;

        table.ajax.reload();
    }).trigger("click");

    $('body').on('change', '.filter-ul', function () {
        var selval = $(this).val();
        myData.alphabet = selval;
        table.ajax.reload();
    });


    $('input').on('keypress', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var removalistfilter = $("#removalistfilter").val();
            var userfullname = $("#userfullname").val();



            myData.first_name = first_name;
            myData.last_name = last_name;
            myData.removalistfilter = removalistfilter;
            myData.userfullname = userfullname;
            table.ajax.reload();
        }
    });


    // $('#select_all_booking').change(function () {
    //     var cells = table.cells( ).nodes();
    //     if ($(this).is(':checked')) {
    //         $(cells).closest('tr').addClass('select');
    //         $(cells).closest('tr:last').addClass('lasttr');
    //         $(cells).find(':checkbox').prop('checked', true);
    //         var itm = $(cells).parent('tr').length;
    //         $('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
    //     } else {
    //         $(cells).closest('tr').removeClass('select');
    //         $(cells).closest('tr.lasttr').removeClass('lasttr');
    //         $(cells).find(':checkbox').prop('checked', false);
    //         $('.dataTables_info').find('.select-itm').remove();
    //     }
    // });

    $("#driverView_booking").change(function () {
        var driverView_booking = $("#driverView_booking").val();
        myData.driverView_booking = driverView_booking;
        var alpha = $(".open").attr("id");
        myData.alphabet = alpha;
        table.ajax.reload();
    });

});
/* DRCZ Driver Booking Grid */
/* DRCZ Email Config Grid */
$(document).ready(function () {

    var myData = {};
    var table = $('#emailconf').DataTable({
        "columns": [
            {"data": "checkbox_val"},
            {"data": "smtp_user"},
            {"data": "smtp_host"},
            {"data": "jobtype"},
            {"data": "emailtype"},
            // {"data": "edit"},
        ],
        "columnDefs": [
            {"targets": [0], "orderable": false, },
                    //   {"targets": [4], "orderable": false, },
        ],
        "scrollY": calcDataTableHeight(),
        "scrollX": true,
        "sScrollXInner": "110%",
        "scrollCollapse": true,
        "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "stateSave": true,
        "pageLength": 50,
        "ajax": {
            url: 'ajaxData',
            "data": function (d) {
                $.getJSON('ajaxData', myData, function (json) {
                    if (json.expired == '1') {
                        window.location = BASE_URL;
                    }
                });
                return  $.extend(d, myData);
            },
            type: 'POST'
        }
    });

    $('body').on('change', '.filter-ul', function () {
        var selval = $(this).val();
        myData.alphabet = selval;
        table.ajax.reload();
    });
    $('#select_all_emailconf').change(function () {
        var cells = table.cells( ).nodes();
        if ($(this).is(':checked')) {
            $(cells).closest('tr').addClass('select');
            $(cells).closest('tr:last').addClass('lasttr');
            $(cells).find(':checkbox').prop('checked', true);
            var itm = $(cells).parent('tr').length;
            $('#emailconf_info').find('.select-itm').remove();
            $('#emailconf_info').append('<span class="select-itm">' + itm + '  selected</span>');
        } else {
            $(cells).closest('tr').removeClass('select');
            $(cells).closest('tr.lasttr').removeClass('lasttr');
            $(cells).find(':checkbox').prop('checked', false);
            $('#emailconf_info').find('.select-itm').remove();
        }
    });

});
/* DRCZ Email Config Grid */
/* DRCZ Email Config Master Grid */
$(document).ready(function () {

    var myData = {};
    var table = $('#emailconfmaster').DataTable({
        "columns": [
            {"data": "checkbox_val"},
            {"data": "smtp_user"},
            {"data": "jobtype"},
            // {"data": "edit"},
        ],
        "columnDefs": [
            {"targets": [0], "orderable": false, },
                    //   {"targets": [4], "orderable": false, },
        ],
        "scrollY": calcDataTableHeight(),
        "scrollX": true,
        "sScrollXInner": "110%",
        "scrollCollapse": true,
        "processing": true,
        "serverSide": true,
        "bStateSave": true,
        "stateSave": true,
        "pageLength": 50,
        "ajax": {
            url: 'masterEmailconfajaxData',
            "data": function (d) {
                $.getJSON('masterEmailconfajaxData', myData, function (json) {
                    if (json.expired == '1') {
                        window.location = BASE_URL;
                    }
                });
                return  $.extend(d, myData);
            },
            type: 'POST'
        }
    });

    $('body').on('change', '.filter-ul', function () {
        var selval = $(this).val();
        myData.alphabet = selval;
        table.ajax.reload();
    });
    $('#select_all_emailconfmaster').change(function () {
        var cells = table.cells( ).nodes();
        if ($(this).is(':checked')) {
            $(cells).closest('tr').addClass('select');
            $(cells).closest('tr:last').addClass('lasttr');
            $(cells).find(':checkbox').prop('checked', true);
            var itm = $(cells).parent('tr').length;
            $('#emailconfmaster_info').find('.select-itm').remove();
            $('#emailconfmaster_info').append('<span class="select-itm">' + itm + '  selected</span>');
        } else {
            $(cells).closest('tr').removeClass('select');
            $(cells).closest('tr.lasttr').removeClass('lasttr');
            $(cells).find(':checkbox').prop('checked', false);
            $('#emailconfmaster_info').find('.select-itm').remove();
        }
    });

});
/* DRCZ Email Config Master Grid */






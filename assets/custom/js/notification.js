/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 if ('Notification' in window) {
 	if (Notification.permission !== "granted") {
 		newPrompt = Notification.requestPermission();
 	} 
 }

 setInterval(function () {
 	jQuery.ajax({
 		type: 'POST',
 		url: BASE_URL + "notification",
 		success: function (response) {
 			var res = JSON.parse(response);
 			if (res.expired) {
 				window.location = BASE_URL;
 			} else if (res.success > 0) {
 				toastr.success(res.success + ' new enquiries.');
 			}
 		}
 	})
 }, 20000);

 jQuery(document).ready(function () {
 	jQuery.ajax({
 		type: 'POST',
 		url: BASE_URL + "enquiries/countDepositNotification",
 		data: {'enquiry_id':jQuery("input[name=enquiry_id]").val()},
 		success: function (response) {
 			var res = JSON.parse(response);
 			if (res.expired) {
 				window.location = BASE_URL;
 			} else if (res.success > 0) {
                //  $('.icon-bell').html('<span class="badge badge-default">'+res.success+'</span>');
                jQuery('.notibadge').html(res.success).css('opacity', '1');
                var id=jQuery("input[name=enquiry_id]").val();
                if(id!= null && jQuery.inArray(id, res.enquiryArr) !== -1 ){
                    if(jQuery(location).attr("href").search("viewEnquiries") != -1 
                        && !jQuery("input[name=en_deposit_received]").is(":checked")){
                        toastr.success('Deposit received. Please wait for updation of fields.').delay(3000)
                    .fadeOut(1000);
                    getEnquiryDetails(id,'enquiry');
                	}
            	}
            }
        }
    })
 });

 setInterval(function () {
 	jQuery.ajax({
 		type: 'POST',
 		url: BASE_URL + "enquiries/countDepositNotification",
 		data: {'enquiry_id':jQuery("input[name=enquiry_id]").val()},
 		success: function (response) {
            var res = JSON.parse(response);
            if (res.expired) {
                window.location = BASE_URL;
            } else if (res.success > 0) {
                jQuery('.notibadge').html(res.success).css('opacity', '1');
                var id=jQuery("input[name=enquiry_id]").val();
                if(id!= null && jQuery.inArray(id, res.enquiryArr) !== -1 ){
                    if(jQuery(location).attr("href").search("viewEnquiries") != -1 
                        && !jQuery("input[name=en_deposit_received]").is(":checked")){
                        toastr.success('Deposit received. Please wait for updation of fields.').delay(3000)
                    .fadeOut(1000);
                    getEnquiryDetails(id,'enquiry');
                    }
                }
            }
            else{
                jQuery('.notibadge').html(res.success).css('opacity', '0');
            }
            if(jQuery(location).attr("href").search("viewBooking") != -1
            && jQuery("input[name=final_payment_eway_refno]").val() == ""){
                fillBookingDetails(res.bookingArr[0]); 
            }
        }
 })
}, 30000); 

function getEnquiryDetails($id,$type){
    jQuery.ajax({
        type: 'POST',
        url: BASE_URL + "enquiries/getPaymentDetails",
        data: {'enquiry_id':$id, 'type' : $type },
        success: function (data) {
            data = JSON.parse(data);
            // console.log(data);
            if($type=="booking" && data[0].final_payment_eway_refno == null){
                return;
            }
            if(data[0].final_payment_eway_refno != null){
                toastr.success('Deposits received. Please wait for updation of fields.').delay(3000)
                .fadeOut(1000);
            }
            if(data[0].en_deposit_received){
                jQuery('input[name=en_deposit_received]').prop("checked", true);
            }
            else{
                jQuery('input[name=en_deposit_received]').prop("checked", false);
            }
            if(data[0].en_deposit_paidby == "1" || data[0].en_deposit_paidby == "2"){
                jQuery('select[name="en_deposit_paidby"]').val(data[0].en_deposit_paidby);
            }
            if(data[0].en_eway_refno != null){
                jQuery("input[name=en_eway_refno]").val(data[0].en_eway_refno);
            }
            if(data[0].en_eft_receivedon != null){
                jQuery("input[name=en_eft_receivedon]").val(reformatDate(data[0].en_eft_receivedon));
            }
            if(data[0].en_eway_token!= null){
                jQuery("input[name=en_eway_token]").val(data[0].en_eway_token);
            }
        }
    });
}

// desktop notification - 26-03-19
$( document ).ready(function() {
	myVar = setInterval("checkNotification()", 60000);
});

// checkNotification();

function checkNotification(){
	if ('Notification' in window) {
		jQuery.ajax({
			type: 'POST',
			url: BASE_URL + "notification/getunreadNotification",
			success: function (data) {
				data = JSON.parse(data);
				jQuery.each(data, function() {
					jQuery.each(this, function(k, v) {
						var title;
						var msg;
						var img = BASE_URL+"assets/uploads/notification/logo-hire-a-mover.jpg";
						if(v.type == "enquiry"){
							title = "Enquiry";
							msg= "A new enquiry received "  + v.en_fname + ' ' + v.en_lname + ' ' + v.en_servicedate
						}
						else if(v.type == "deposit"){
							title = "Deposit";
							msg= '$' + v.en_deposit_amt + ' deposit received for ' + v.en_fname + ' ' + v.en_lname + ' ' +v.en_servicedate
						}
						var e = new Notification(title, {
							body: msg,
							icon: img,
						});

						e.onclick = function() {
							e.close();
							var url=BASE_URL+"enquiries/viewEnquiries/"+v.en_unique_id;
							window.open(url, '_blank');
						};
					});
				});
			}
		}); 
	}
}

function reformatDate(dateStr)
{
  dArr = dateStr.split("-"); 
  return dArr[2]+ "-" +dArr[1]+ "-" +dArr[0]; 
}

function fillBookingDetails($data){
    // console.log($data);return;
    if($data == null){
        return;
    }
    if($data.final_payment_eway_refno != null){
        toastr.success('Deposits received. Please wait for updation of fields.').delay(3000)
        .fadeOut(1000);
    }
    if($data.en_deposit_received){
        jQuery('input[name=en_deposit_received]').prop("checked", true);
    }
    else{
        jQuery('input[name=en_deposit_received]').prop("checked", false);
    }
    if($data.en_deposit_paidby == "1" || $data.en_deposit_paidby == "2"){
        jQuery('select[name="en_deposit_paidby"]').val($data.en_deposit_paidby);
    }
    if($data.en_eway_refno != null){
        jQuery("input[name=en_eway_refno]").val($data.en_eway_refno);        
    }
    if($data.en_eft_receivedon != null){
        jQuery("input[name=en_eft_receivedon]").val(reformatDate($data.en_eft_receivedon));    
    }
    if($data.en_eway_token != null){
        jQuery("input[name=en_eway_token]").val($data.en_eway_token);
    }
    if($data.final_payment_receivedby == "1" || $data.final_payment_receivedby == "2"
     || $data.final_payment_receivedby == "3"){
        jQuery('select[name="final_payment_receivedby"]').val($data.final_payment_receivedby);
    }
    if($data.final_payment_eway_refno != null){
        jQuery("input[name=final_payment_eway_refno]").val($data.final_payment_eway_refno);    
    }
    if($data.final_payment_eft_payment != null){
        jQuery("input[name=final_payment_eft_payment]").val(reformatDate($data.final_payment_eft_payment));
    }
    if($data.head_office_paid != null){
        jQuery("input[name=head_office_paid]").val($data.head_office_paid);    
    }
    if($data.removalist_paid != null){
        jQuery("input[name=removalist_paid]").val($data.removalist_paid);    
    }
    if($data.en_month_payment_received){
        jQuery('input[name=en_month_payment_received]').prop("checked", true);
    }
    else{
        jQuery('input[name=en_month_payment_received]').prop("checked", false);
    }
    if($data.en_paymentmethod == "1" || $data.en_paymentmethod == "2"
     || $data.en_paymentmethod == "3"){
        jQuery('select[name="en_paymentmethod"]').val($data.en_paymentmethod);
    }
    if($data.en_anniversarydate != null){
        jQuery("input[name=en_anniversarydate]").val($data.en_anniversarydate);
    }
    if($data.en_ewayrecurring_payment != null){
        jQuery("input[name=en_ewayrecurring_payment]").val($data.en_ewayrecurring_payment);    
    }
    if($data.en_futurepayment_log != null){
        jQuery("input[name=en_futurepayment_log]").val($data.en_futurepayment_log);    
    }    
}
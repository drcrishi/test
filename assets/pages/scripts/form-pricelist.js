jQuery(document).ready(function () {

    // add and update

    // jQuery( "body" ).on( "click", ".update-pricelist", function() {
    jQuery(".update-pricelist").click(function () {
        $divId = jQuery(this).parents('.pricelist-values').attr('id');
        if ($divId == null) {
            $ruleType = "";
            $containerId = jQuery(this).parents('.parent-pricelist-div').attr('id');
            $containerType = $containerId.split("-")[0];
            if ($containerType == "default") {
                $ruleType = "1";
            }
            else if ($containerType == "custom") {
                $ruleType = "2";
            }
            else if ($containerType == "holiday") {
                $ruleType = "3";
            }
            else if ($containerType == "packing") {
                $ruleType = "4";
            }
            $divCount = jQuery("#" + $containerType + "-price-rules-container").find(".pricelist-values").length;
            if ($divCount == 0) {
                $divCount = 1;
            }
            $divId = $containerType + '-pricelist-row-' + $divCount;
            jQuery("#" + $divId).find('#ruleType').val($ruleType);
        }
        $parentElement = jQuery("#" + $divId).parent().prop('nodeName');
        $formId = $divId + "-form";
        if ($parentElement != "FORM") {
            var form = document.createElement("form");
            form.setAttribute("id", $formId);
            form.setAttribute("name", $formId);
            jQuery("#" + $divId).wrap(form);
        }
        validateInputValues($formId);
        jQuery("#" + $divId).find('.submit-button').trigger('click');
    });

    //delete
    jQuery(".delete-pricelist").click(function () {
        if (confirm("Are you sure you want to delete?")) {
            $toBeDeleted = jQuery(this).parents('.pricelist-values');
            if(jQuery(this).attr('data-pricelist-id') == "0"){
                $toBeDeleted.remove();
                toastr.success("Deleted Successfully");
            }
            else{
                jQuery.ajax({
                url: BASE_URL + "pricelist/delete",
                type: "POST",
                data: { 'pricelistId': jQuery(this).attr('data-pricelist-id') },
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.code == 1) {
                        toastr.success(data.msg);
                        $toBeDeleted.remove();
                    }
                }
                });
            }
        }
        else {
            return false;
        }
    });

    //change status value
    jQuery(".status-class").click(function () {
        var status = '';
        if (jQuery(this).val() == 1) {
            jQuery(this).val('0');
            status=0;
        }
        else {
            jQuery(this).val('1');
            status=1;
        }
        var parentDiv = jQuery(this).parents('.pricelist-values').attr('id');
        pricelistId=jQuery("#"+parentDiv).find('#pricelistId').val();
        jQuery.ajax({
            url: BASE_URL + "pricelist/updateStatus",
            type: "POST",
            data: { 'status': status,'pricelistId' : pricelistId },
            success: function (data) {
                data = JSON.parse(data);
                if(data.code == 1){
                    toastr.success(data.msg);
                }
                else if(data.code == 0){
                    toastr.error(data.msg);
                }
            }
        });

    });

    //toggle
    jQuery(".toggleAnchor").click(function () {
        if(jQuery(this).find('.toggleArrow').hasClass('fa-arrow-circle-down')){
            jQuery(this).find('.toggleArrow').removeClass('fa-arrow-circle-down');
            jQuery(this).find('.toggleArrow').addClass('fa-arrow-circle-up');
        }
        else{
            jQuery(this).find('.toggleArrow').removeClass('fa-arrow-circle-up');
            jQuery(this).find('.toggleArrow').addClass('fa-arrow-circle-down');
        }
    });
    jQuery("#anchorDefault").trigger("click");



    var dates = [];
    jQuery('.date-picker').multiDatesPicker({
        dateFormat: 'dd-mm-yy',
        minDate: new Date(),
    });

    // movetype
    jQuery('.movetype').on('change', function() {
        var moveType= this.value;
        if(moveType == "1" || moveType == "2"){
            alert("home");      }
        else if(moveType == "4" || moveType == "5"){
            alert("packing");
        }
    });


    // select 2
    jQuery('.select2-js').select2();

    // jQuery('.selectStates').on('select2:select', function (e) {
    //     var selectedValues= jQuery(this).val();
    //     if(selectedValues != null && selectedValues.indexOf("All") > -1){
    //         jQuery(this).val("-1").trigger("change");
    //         jQuery(this).val("All");
    //     }
    // });

});

//clone row when clicking add new
function clonePricelistDiv($type) {
    var divLength = $("#" + $type + "-price-rules-container").find(".pricelist-values").length;
    var divLengthContainerDivName =  $type + "-price-rules-container";
    var rowName= $type+"-pricelist-row-"+divLength;

    if(divLength > 0){
        if(checkAllFieldsFilled(rowName,$type) == '1'){
            toastr.error("Please fill up the previous fields");
            return false;
        }    
    }
    
    if (jQuery("#" + $type + "-price-rules-container").find(".pricelist-values").length > 0) {
        $divRowId = jQuery('#' + $type + '-price-rules-container').children().last().attr('id');
        $explodedArr = $divRowId.split('-');
        $lastDivId = $explodedArr[$explodedArr.length - 1];
        $newDivId = parseInt($lastDivId) + 1;
        $newFullId = $type + "-pricelist-row-" + $newDivId;
        $clonedHtml = jQuery("#" + $type + "-pricelist-row-" + $lastDivId).clone(true).insertAfter("#" + $type + "-pricelist-row-" + $lastDivId);

        jQuery('#' + $type + '-price-rules-container').children().last().attr('id', $newFullId);
        jQuery("#" + $newFullId).find('.hidden-val').val('');
        jQuery("#"+$newFullId).find('.delete-pricelist').attr('data-pricelist-id','0');
        jQuery("#" + $newFullId).find('.date-picker').attr('id','datefrom'+$newDivId);
        jQuery("#" + $newFullId).find('.update-pricelist').attr('title','Add');
        jQuery("#" + $newFullId).find('.copy-pricelist').addClass('hide');


        //select2
        $selectHtml=jQuery('#duplicate-state').html();
        jQuery('#'+$newFullId).find('.select2-container').remove();
        jQuery('#'+$newFullId).find('.selectStates').replaceWith($selectHtml);
        jQuery("#" + $newFullId).find('.selectStates').attr('id','states-'+$newDivId);
        jQuery("#" + $newFullId).find('.selectStates').select2();
        jQuery("#" + $newFullId).find('.selectStates').val(null).trigger("change"); 

        jQuery('#datefrom'+$newDivId).multiDatesPicker('destroy');
        jQuery('#datefrom'+$newDivId).val('');
        var dates=[];
        jQuery('#datefrom'+$newDivId).multiDatesPicker({
            dateFormat: 'dd-mm-yy',
            minDate: new Date(),
            onSelect: function (e) {
                dates.push(e);
                var dateList = "";
                $.each(dates, function (i, d) {
                    if (dateList.length > 0) {
                        dateList += ",";
                    }
                    dateList += d;
                });
                $("#dates").val(dateList);
            }

        });
        clear_form_elements($newFullId);
    }
    else {
        $ruleType='0';
        if($type == "default"){
            $ruleType= '1';
        }
        else if($type == "custom"){
            $ruleType= '2';
        }
        else if($type == "holiday"){
            $ruleType= '3';
        }
        else if($type == "packing"){
            $ruleType= '4';  
        }
        $duplicatedRow = jQuery("#duplicate-row").clone(true);
        jQuery("#" + $type + "-price-rules-container").html($duplicatedRow);
        $newFullId = $type + "-pricelist-row-1";
        jQuery('#' + $type + '-price-rules-container').children().last().attr('id', $newFullId);
        jQuery('#' + $type + '-values-div').find('.custom-show').hide();
        jQuery('#'+$newFullId).find('#ruleType').val($ruleType);
        jQuery("#" + $newFullId).find('.date-picker').attr('id','datefrom1');
        if ($type == "default" || $type == "custom") {
            if($type == "default"){
                jQuery('#' + $type + '-values-div').find('.states-show').hide(); 
            //     jQuery('#' + $type + '-values-div').find('.default-and-custom-show').addClass('hide'); 
            //     jQuery('#' + $type + '-values-div').find('.default-day-from-to').removeClass('hide'); 
            }
            jQuery('#' + $type + '-values-div').find('.holiday-show').hide();
            jQuery('#' + $type + '-values-div').find('.default-and-custom-show').show();
        }
        else if ($type == "holiday") {
            jQuery('#' + $type + '-values-div').find('.default-and-custom-show').hide();
            jQuery('#' + $type + '-values-div').find('.holiday-show').show();
        }
        if ($type == "custom") {
            jQuery('#' + $type + '-values-div').find('.custom-show').show();
        }
        if($type == "custom" || $type == "holiday"){
            jQuery('#' + $type + '-values-div').find('.states-show').show();   
        }
        if($type == "packing"){
            jQuery('#' + $type + '-values-div').find('.packer-hide').hide();      
            jQuery('#' + $type + '-values-div').find('.custom-show').show(); 
            jQuery("#"+$newFullId).find('#movetype').empty();     
            jQuery("#"+$newFullId).find('#movetype').append(new Option("Packing", "4")).
            append(new Option("Unpacking", "5"));
        }
        else{
            jQuery('#' + $type + '-values-div').find('.packer-show').hide(); 
        }

        //select2
        $selectHtml=jQuery('#duplicate-state').html();
        jQuery('#'+$newFullId).find('.select2-container').remove();
        jQuery('#'+$newFullId).find('.selectStates').replaceWith($selectHtml);
        jQuery("#" + $newFullId).find('.selectStates').attr('id','states-1');
        jQuery("#" + $newFullId).find('.selectStates').select2();
        jQuery("#" + $newFullId).find('.selectStates').val(null).trigger("change"); 

        //datepicker
        jQuery('#datefrom1').multiDatesPicker('destroy');
        jQuery('#datefrom1').val('');
        jQuery('#datefrom1').multiDatesPicker({
            dateFormat: 'dd-mm-yy',
            minDate: new Date(),
            onSelect: function (e) {
                dates=[];
                dates.push(e);
                var dateList = "";
                $.each(dates, function (i, d) {
                    if (dateList.length > 0) {
                        dateList += ",";
                    }
                    dateList += d;
                });
                $("#dates").val(dateList);
            }
        });
        jQuery('.'+ $type +'-no-records-found').hide();
    }
}

//empty form elements after cloning row
function clear_form_elements($id_name) {
    jQuery("#" + $id_name).find(':input').each(function () {
        switch (this.type) {
            case 'password':
            case 'text':
            case 'textarea':
            case 'file':
            case 'select-one':
            case 'select-multiple':
            case 'date':
            case 'number':
            case 'tel':
            case 'email':
            jQuery(this).val('');
            break;
            // case 'checkbox':
            case 'radio':
            this.checked = false;
            break;
        }
    });
    jQuery('#' + $id_name).find('.fa-save').toggleClass('fa-save fa-check');
}

//validate form elements
function validateInputValues($formId) {
    $childDiv = jQuery("#" + $formId.substr(0, $formId.length - 5));
    $ruleType = jQuery("#" + $formId).find('#ruleType').val();
    $ruleName='';
    if($ruleType =='1'){ $ruleName = 'default'; }else if($ruleType == '2'){ $ruleName ='custom' } else if($ruleType =='3'){ $ruleName = 'holiday'; }
    jQuery("#" + $formId).validate({
        rules: {
            movetype: 'required',
            dayFrom: {
                required: function (element) {
                    return ($ruleType != '1' || $ruleType != '3');
                }
            },
            dayTo: {
                required: function (element) {
                    return ($ruleType != '1' || $ruleType != '3');
                },
            },
            "states[]": {
                required: function (element) {
                    return ($ruleType == '2' || $ruleType == '3' || $ruleType == '4');
                }
            },
            datefrom: {
                required: function (element) {
                    return ($ruleType == '3');
                }
            },
            noOfTrucks: {
                required: function (element) {
                    return ($ruleType == '1' || $ruleType == '2' || $ruleType == '3');
                }
            },
            noOfMovers: {
                required: function (element) {
                    return ($ruleType == '1' || $ruleType == '2' || $ruleType == '3');
                }
            },
            travelFee: {
                required: function (element) {
                    return ($ruleType == '1' || $ruleType == '2' || $ruleType == '3');
                },
                digits: true,
                min: 1
            },
            clientHourRate: {
                required: function (element) {
                    return ($ruleType == '1' || $ruleType == '2' || $ruleType == '3');
                },
                digits: true,
                min: 1
            },
            priority: {
                required: function (element) {
                    return ($ruleType == '2' || $ruleType == '3' || $ruleType == '4');
                },
                digits: true,
                min: 1,
            },
            perPersonPackingRate:{
                required: function (element) {
                    return ($ruleType == '4');
                },
                digits: true,
                min: 1,
            },
        },
        messages: {
            movetype: 'Required',
            dayFrom: 'Required',
            dayTo: {
                required: 'Required',
                notEqual: "Should be different than Day From"
            },
            dayTo: 'Required',
            'states[]': 'Required',
            datefrom: 'Required',
            noOfTrucks: 'Required',
            noOfMovers: 'Required',
            travelFee: {
                required: 'Required',
                digits: 'Only numbers allowed',
                min:'Minimun value should be greater than 0'
            },
            clientHourRate: {
                required: 'Required',
                digits: 'Only numbers allowed',
                min:'Minimun value should be greater than 0'
            },
            priority: {
                required: 'Required',
                digits: 'Only numbers allowed'
            },
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "states[]"){
                error.insertAfter('#'+ $formId +' .select2-container--bootstrap');
            }
            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            jQuery.ajax({
                url: BASE_URL + "pricelist/add",
                type: "POST",
                data: jQuery("#" + $formId).serialize() + '&priceListStatus=' + jQuery("#" + $formId).find('#priceListStatus').val(),
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.code == "1") {
                        toastr.success(data.msg);
                        jQuery($childDiv).find('[name=pricelistId]').val(data.id);
                        jQuery($childDiv).find('.copy-pricelist').attr('data-pricelist-id',data.id).attr('data-type',$ruleName).removeClass('hide');
                        jQuery($childDiv).find('.update-pricelist, .delete-pricelist').attr('data-pricelist-id',data.id);
                        jQuery($childDiv).find('.form-control').removeClass("error-border");
                        jQuery($childDiv).find('.fa-check').toggleClass('fa-check fa-save');
                        jQuery($childDiv).find('.update-pricelist').attr('title','Update');
                        jQuery($childDiv).find('.fa-copy').removeClass('hide');
                    }
                    else if (data.code == "2") {
                        toastr.success(data.msg);
                        jQuery($childDiv).find('.form-control').removeClass("error-border");
                        jQuery($childDiv).find('.fa-check').toggleClass('fa-check fa-save');
                    }
                    else if (data.code == "0") {
                        jQuery.each(data.msg, function (index, value) {
                            jQuery($childDiv).find('[name=' + index + ']').addClass("error-border");
                        });
                    }
                    else if (data.code == "3") {
                        toastr.error(data.msg);
                    }
                    else if (data.code == "4") {
                        toastr.error(data.msg);
                    }
                },
                complete: function (data) {
                    jQuery($childDiv).unwrap();
                }
            });
        }
    });
}

jQuery.validator.addMethod("notEqual", function (value, element, param) {
    return this.optional(element) || value != $(param).val();
}, "This has to be different...");

function checkAllFieldsFilled($name,$type){
    var movetype = jQuery("#"+$name).find("#movetype").val();
    var noOfTrucks = jQuery("#"+$name).find("#noOfTrucks").val();
    var noOfMovers = jQuery("#"+$name).find("#noOfMovers").val();
    var travelFee = jQuery("#"+$name).find("#travelFee").val();
    var clientHourRate = jQuery("#"+$name).find("#clientHourRate").val();
    var dayFrom = jQuery("#"+$name).find("#dayFrom").val();
    var dayTo = jQuery("#"+$name).find("#dayTo").val();
    var priority = jQuery("#"+$name).find("#priority").val();
    var states = jQuery("#"+$name).find(".selectStates").val();
    var datefrom = jQuery("#"+$name).find("input[name=datefrom]").val();
    var packingperhour = jQuery("#"+$name).find("input[name=perPersonPackingRate]").val();
    var errFlag=0;
    if($type =='default'){
        if(movetype == null || noOfTrucks == null || noOfMovers == null || travelFee == "" || clientHourRate == ""){
            errFlag =1;
        }
    }
    else if($type == 'custom'){
        if(movetype == null || states == null || dayFrom == null || dayTo == null || noOfTrucks == null || noOfMovers == null || travelFee == "" || clientHourRate == ""){
            errFlag =1;
        }
    }
    else if($type == 'holiday'){
        if(movetype == null || states == null || datefrom == "" || noOfTrucks == null || noOfMovers == null || travelFee == "" || clientHourRate == ""){
            errFlag =1;
        }
    }
    return errFlag;
}

// jQuery( "body" ).on( "click", ".copy-pricelist", function() {
jQuery(".copy-pricelist").click(function () {
    $type=jQuery(this).attr('data-type');
    $id=jQuery(this).attr('data-pricelist-id');
    $length = jQuery('#'+$type+'-price-rules-container').find(".pricelist-values").length;

    $dayFrom = '';
    $dayTo = '';
    $dateFrom = '';
    $states = '';
    $moveType = jQuery(this).parents('.pricelist-values').find('#movetype').val();
    $noOfTrcuks = jQuery(this).parents('.pricelist-values').find('#noOfTrucks').val();
    $noOfMovers = jQuery(this).parents('.pricelist-values').find('#noOfMovers').val();

    if($type == 'deafult' || $type == 'custom'){
        $dayFrom = jQuery(this).parents('.pricelist-values').find('#dayFrom').val();
        $dayTo = jQuery(this).parents('.pricelist-values').find('#dayTo').val();    
    }

    if($type == 'holiday'){
        // $dateFrom = jQuery(this).parents('.pricelist-values').find('#datefrom'+$length).val();
        $dateFrom = jQuery(this).parents('.pricelist-values').find('.date-picker').val();
    }

    if($type == 'custom' || $type == 'holiday' ){
        $states = jQuery(this).parents('.pricelist-values').find('.selectStates').val();
    }

    $clonnedHtml=jQuery(this).parents('.pricelist-values').clone(true).insertAfter("#" + $type + "-pricelist-row-" + $length);
    $copiedFromDiv= $type+'-pricelist-row-'+($length);
    $copiedToDiv= $type+'-pricelist-row-'+($length+1); 
    $clonnedHtml.find('#pricelistId').val('');
    $clonnedHtml.find('.copy-pricelist').attr('data-pricelist-id','').addClass('hide');
    $clonnedHtml.find('.update-pricelist').attr('data-pricelist-id','');
    $clonnedHtml.find('.delete-pricelist').attr('data-pricelist-id','');
    jQuery('#' + $type + '-price-rules-container').children().last().attr('id',$copiedToDiv);

    //select2
    $selectHtml=jQuery('#duplicate-state').html();
    $clonnedHtml.find('.select2-container').remove();
    $clonnedHtml.find('.selectStates').replaceWith($selectHtml);
    $clonnedHtml.find('.selectStates').attr('id','states-'+($length+1));
    $clonnedHtml.find('.selectStates').select2();
    $clonnedHtml.find('.selectStates').val($states);
    $clonnedHtml.find('.selectStates').trigger('change'); 

    $clonnedHtml.find('#movetype').val($moveType);
    $clonnedHtml.find('#noOfTrucks').val($noOfTrcuks);
    $clonnedHtml.find('#noOfMovers').val($noOfMovers);

    if($type == 'deafult' || $type == 'custom'){
        $clonnedHtml.find('#dayFrom').val($dayFrom);
        $clonnedHtml.find('#dayTo').val($dayTo);    
    }

    if($type == 'holiday'){
        $newDtId= ($length+1);
        $clonnedHtml.find('.date-picker').attr('id','datefrom'+$newDtId);
        jQuery('#datefrom'+$newDtId).multiDatesPicker('destroy');
        jQuery('#datefrom'+$newDtId).val('');

        $dateFrom = $dateFrom.split(" ").join("");
        var explodedArr= $dateFrom.split(',');
        var dates=[];
        jQuery('#datefrom'+$newDtId).multiDatesPicker({
            dateFormat: 'dd-mm-yy',
            minDate: new Date(),
            addDates: explodedArr,
            onSelect: function (e) {
                dates.push(e);
                var dateList = "";
                $.each(dates, function (i, d) {
                    if (dateList.length > 0) {
                        dateList += ",";
                    }
                    dateList += d;
                });
                $("#dates").val(dateList);
            }

        });
    }

    if($type == 'custom' || $type == 'holiday' ){
        $clonnedHtml.find('.selectStates').val($states);
    }

});
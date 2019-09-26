jQuery(document).ready(function () {

    //packerholiday
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
            else if ($containerType == "packerholiday") {
                $ruleType = "5";
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

    jQuery('.select2-js').select2();

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
        if($type == "packing"){
            $ruleType= '4';  
        }
        else if($type == "packerholiday"){
            $ruleType= '5';
        }

        $duplicatedRow = jQuery("#duplicate-row").clone(true);
        jQuery("#" + $type + "-price-rules-container").html($duplicatedRow);
        $newFullId = $type + "-pricelist-row-1";
        jQuery('#' + $type + '-price-rules-container').children().last().attr('id', $newFullId);
        jQuery('#' + $type + '-values-div').find('.custom-show').hide();
        jQuery('#'+$newFullId).find('#ruleType').val($ruleType);
        jQuery("#" + $newFullId).find('.date-picker').attr('id','datefrom1');
        if($type == "packing"){
            jQuery('#' + $type + '-values-div').find('.packer-hide').hide();      
            jQuery('#' + $type + '-values-div').find('.custom-show').show(); 
            jQuery("#"+$newFullId).find('#movetype').empty();     
            jQuery("#"+$newFullId).find('#movetype').append(new Option("Packing", "4")).
            append(new Option("Unpacking", "5"));
        }
        else if($type == 'packerholiday'){
            jQuery('#' + $type + '-values-div').find('.holiday-hide').hide();
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
    if($ruleType =='4'){ $ruleName = 'packing'; }else if($ruleType == '5'){ $ruleName ='packerholiday' }
    jQuery("#" + $formId).validate({
        rules: {
            movetype: 'required',
            dayFrom: {
                required: function (element) {
                    return ($ruleType == '4');
                }
            },
            dayTo: {
                required: function (element) {
                    return ($ruleType == '4');
                },
            },
            "states[]": 'required',
            datefrom: {
                required: function (element) {
                    return ($ruleType == '5');
                }
            },
            perPersonPackingRate:{
                required:true,
                number: true,
                min: 1,
            },
            packerCost:{
                required:true,
                number: true,
                min: 1,
            },
        },
        messages: {
            movetype: 'Required',
            dayFrom: 'Required',
            dayTo: 'Required',
            'states[]': 'Required',
            datefrom: 'Required',
            perPersonPackingRate:{
                required: 'Required',
                digits: 'Only numbers allowed',
                min:'Minimun value should be greater than 0'
            },
            packerCost:{
                required: 'Required',
                digits: 'Only numbers allowed',
                min:'Minimun value should be greater than 0'
            }
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

            // console.log(jQuery("#" + $formId).serialize());

            jQuery.ajax({
                url: BASE_URL + "packer/add",
                type: "POST",
                data: jQuery("#" + $formId).serialize() + '&priceListStatus=' + jQuery("#" + $formId).find('#priceListStatus').val(),
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.code == "1") {
                        toastr.success(data.msg);
                        jQuery($childDiv).find('[name=pricelistId]').val(data.id);
                        jQuery($childDiv).find('.copy-pricelist').attr('data-pricelist-id',data.id).attr('data-type',$ruleName).removeClass('hide');
                        jQuery($childDiv).find('.update-pricelist').attr('data-pricelist-id',data.id);
                        jQuery($childDiv).find('.delete-pricelist').attr('data-pricelist-id',data.id);
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


function checkAllFieldsFilled($name,$type){
    var movetype = jQuery("#"+$name).find("#movetype").val();
    var dayFrom = jQuery("#"+$name).find("#dayFrom").val();
    var dayTo = jQuery("#"+$name).find("#dayTo").val();
    var states = jQuery("#"+$name).find(".selectStates  ").val();
    var datefrom = jQuery("#"+$name).find("input[name=datefrom]").val();
    var packingperhour = jQuery("#"+$name).find("input[name=perPersonPackingRate]").val();

    console.log(states);

    var errFlag=0;
    if($type =='packing'){
        if(movetype == null || states == null || dayFrom == null || dayTo == null || packingperhour == ''){
            errFlag =1;
        }
    }
    else if($type == 'packerholiday'){
        if(movetype == null || states == null || datefrom == '' || packingperhour == ''){
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

    // console.log($type+' - '+$id+ ' - '+ $length);

    $dayFrom = '';
    $dayTo = '';
    $dateFrom = '';
    $states = jQuery(this).parents('.pricelist-values').find('.selectStates').val();
    $moveType = jQuery(this).parents('.pricelist-values').find('#movetype').val();
    if($type == 'packing'){
        $dayFrom = jQuery(this).parents('.pricelist-values').find('#dayFrom').val();
        $dayTo = jQuery(this).parents('.pricelist-values').find('#dayTo').val();    
    }

    if($type == 'packerholiday'){
        $dateFrom = jQuery(this).parents('.pricelist-values').find('.date-picker').val();
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
    if($type == 'packing'){
        $clonnedHtml.find('#dayFrom').val($dayFrom);
        $clonnedHtml.find('#dayTo').val($dayTo);    
    }

    if($type == 'packerholiday'){
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
    $clonnedHtml.find('.selectStates').val($states);

});
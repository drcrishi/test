jQuery(document).ready(function () {
    jQuery("#anchorBedroomDesk").trigger("click");

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

    //save new
    jQuery('.update-rule').click(function (){
        $type=jQuery(this).data('ruletype');
        $formId=jQuery(this).parents('.'+$type+'-form').attr('id');
        jQuery("#" + $formId).validate({
            rules: {
                bedroom: {
                    required: function (element) {
                        return ($type == 'bedroom');
                    },
                    min: 1,
                },
                desk:{
                    required: function (element) {
                        return ($type == 'desk');
                    },
                    min: 1,
                },
                movers: {
                    required: function (element) {
                        return ($type == 'bedroom' || $type == 'desk');
                    },
                    min: 1,
                },
                mover: {
                    required: function (element) {
                        return ($type == 'mover');
                    },
                    min: 1,
                },
                truck: {
                    required: function (element) {
                        return ($type == 'mover');
                    },
                    min: 1,
                },
            },
            messages: {
                bedroom: {
                    required: 'Required',
                    min: "Minimum value should be greater than 0"
                }, 
                desk: {
                    required: 'Required',
                    min: "Minimum value should be greater than 0"
                },           
                movers: {
                    required: 'Required',
                    min: "Minimum value should be greater than 0"
                },
                mover: {
                    required: 'Required',
                    min: "Minimum value should be greater than 0"
                },
                truck: {
                    required: 'Required',
                    min: "Minimum value should be greater than 0"
                },
            },
            submitHandler: function (form) {
                jQuery.ajax({
                    url: BASE_URL + "bedroom/add",
                    type: "POST",
                    data: jQuery("#" + $formId).serialize(),
                    success: function (data) {
                        data = JSON.parse(data);
                        if(data.code =='0'){
                            toastr.error(data.msg);
                        }
                        else if(data.code == '1'){
                            toastr.success(data.msg);
                            jQuery("#" + $formId).find('.ruleId').val(data.recordid);
                            // jQuery("#" + $formId).find('.update-rule').attr('data-id',data.recordid);
                            jQuery("#" + $formId).find('.update-rule').attr({'data-id': data.recordid,'title': 'Update'});
                            jQuery("#" + $formId).find('.delete-pricelist').attr('data-id',data.recordid);
                            jQuery("#" + $formId).find('.fa-check').removeClass('fa-check').addClass('fa-save');
                        }
                        else if(data.code =='2'){
                            toastr.success(data.msg);
                        }
                        else if(data.code =='3'){
                            toastr.error(data.msg);   
                        }
                    }
                });
            }
        });
        jQuery("#" + $formId).find('.submit-form').trigger('click');
    });


    //delete
    jQuery(".delete-pricelist").click(function () {
        if (confirm("Are you sure you want to delete?")) {
            $type=jQuery(this).attr('data-ruletype');
            $toBeDeleted = jQuery(this).parents('.'+$type+'-form');
            if(jQuery(this).attr('data-id') == ''){
                $toBeDeleted.remove();
            }
            else{
                jQuery.ajax({
                    url: BASE_URL + "bedroom/delete",
                    type: "POST",
                    data:  { 'recordId': jQuery(this).attr('data-id'),'type':$type },
                    success: function (data) {
                        data = JSON.parse(data);
                        if(data.code == 1){
                            toastr.success(data.msg);
                            $toBeDeleted.remove();
                        }
                        else{
                            toastr.error(data.msg);
                        }
                    }
                });
            }
            // return false;
        }
        else{
            return false;
        }
    });

});

function cloneRow($type){
    var noOfRecords = jQuery("#"+$type+"-container").find("."+$type+"-row").length;
    var newRowId= noOfRecords+1;
    $errorReport = checkAllFieldsFilled(noOfRecords,$type);
    if($errorReport == 1){
        toastr.error('Please fill previous records');
        return false;
    }
    
    if(noOfRecords >0){
        $formId=$type+'-form-'+newRowId;
        $rowId=$type+'-row-'+newRowId;
        jQuery('#'+$type+'-form-').clone(true).insertAfter('#'+$type+'-form-'+noOfRecords).css('display','block');
        jQuery('#'+$type+'-form-').attr('id',$formId).attr('name',$formId);
        jQuery('#'+$formId).find('.'+$type+'-row').attr('id',$rowId);
    }
    else{
        $duplicatedRow = jQuery("#"+$type+"-form-").clone(true);
        jQuery("#"+$type+"-container").html($duplicatedRow);
        jQuery('#'+$type+'-form-').attr('id',$type+'-form-1').attr('name',$type+'-form-1').css('display','block');
        jQuery('#'+$type+'-form-1').find('.'+$type+'-row').attr('id',$type+'-row-1');
    }
}

function checkAllFieldsFilled($formId,$type){
    var formName='#'+$type+'-row-'+$formId;
    var noOfBedroom='';
    var noOfMoversBedroom='';
    var noOfDesk='';
    var noOfMoversDesk='';
    var noOfTruck='';
    var noOfMoverTruck='';
    var flagErr=0;

    if($type=='bedroom'){
        noOfBedroom=jQuery(formName).find('#bedroom').val();
        noOfMoversBedroom=jQuery(formName).find('#movers').val();
        if(noOfBedroom == '' || noOfMoversBedroom == '' ){
            flagErr =1;
        }
    }
    else if($type=='desk'){
        noOfDesk=jQuery(formName).find('#desk').val();
        noOfMoversDesk=jQuery(formName).find('#movers').val();
        if(noOfDesk == '' || noOfMoversDesk == '' ){
            flagErr =1;
        }
    }
    else if($type == 'mover'){
        var noOfTruck=jQuery(formName).find('#truck').val();
        var noOfMoverTruck=jQuery(formName).find('#mover').val();
        if(noOfTruck == '' || noOfMoverTruck == '' ){
            flagErr =1;
        }
    }
    return flagErr;
}
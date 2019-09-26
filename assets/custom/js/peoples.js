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
})

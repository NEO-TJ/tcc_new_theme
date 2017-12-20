// ************************************************ Event **********************************************
// ------------------------------------------- Document Load -------------------------------------------
$(document).ready(function() {
    $("a.refresh").click(function() {
alert("test");
        let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
        $.ajax({
            url: baseUrl + "users/captcha_refresh",
            type: "POST",
            success: function(res) {
                if (res) {
                    jQuery("div.image").html(res);
                }
            }
        });
    });
});
// ----------------------------------------------- Button ----------------------------------------------
// Submit & Reset
$('form#formInputData').on('submit', function(e) {
    e.preventDefault();

    if (ValidateInputRequire()) {
        SaveInputData();
    } else {
        ShowDialog(dltValidate);
    }
});






//************************************************ Method **********************************************
//------------------------------------------------- Save -----------------------------------------------
function SaveInputData() {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
    let dataType = $('input#dataType').val();
    let data = $('form#formInputData').serializeArray();
  
    // Ajax add or edit record.
    $.ajax({
        url: baseUrl + 'userAuthentication/ajaxSaveInputData',
        type: 'post',
        data: data,
        beforeSend: function() {
            swal({
                title: "Saving...",
                text: '<span class="text-info"><i class="fa fa-refresh fa-spin"></i> Saving please wait...</span>',
                showConfirmButton: false,
            });
        },
        error: function(xhr, textStatus) {
            swal("Error", textStatus + xhr.responseText, "error");
        },
        complete: function() {},
        success: function(result) {
            if (result == 0) {
                swal({
                    title: "Success",
                    text: "Save data to database has success",
                    type: "success",
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonText: "Done",
                    confirmButtonClass: "btn btn-success",
                }).then(function() {
                    window.location.href = baseUrl + "index"
                });
            } else {
                swal({
                    title: "Unsuccess!",
                    text: "Can't save<span class='text-info'> data </span>to database" + result,
                    type: "error",
                    confirmButtonColor: "#DD6B55"
                });
            }
        }
    });
}
// ************************************************ Event **********************************************
$("a#captchaRefresh").click(function() {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";

    $.ajax({
        url: baseUrl + "users/captchaRefresh",
        type: "post",
        beforeSend: function() {},
        error: function(xhr, textStatus) {
            swal("Error", textStatus, "error");
        },
        complete: function() {},
        success: function(result) {
            if (result) {
                $("div#captchaImage").html(result);
            }
        }
    });
});
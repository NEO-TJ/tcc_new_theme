// ************************************************ Event **********************************************
$("a#captchaRefresh").click(function() {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";

    $.ajax({
        url: baseUrl + "users/captcha_refresh",
        type: "post",
        beforeSend: function() {},
        error: function(xhr, textStatus) {
            swal("Error", textStatus + xhr.responseText, "error");
        },
        complete: function() {},
        success: function(result) {
            if (result) {
                $("div#captchaImage").html(result);
            }
        }
    });
});
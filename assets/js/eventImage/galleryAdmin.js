// ******************************************************************************************** Event.
// -------------------------------------------------------------------------------------------- AJAX.
$(document).on('click', '.content-img span', function() {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
    let iccCardId = $("input#iccCardId").val();

    let eventImageId = this.id.split("_")[1];
    let pathFile = $('img#img_' + eventImageId).attr("src");
    let fileNameSpliter = pathFile.split("/");
    let fileName = fileNameSpliter[fileNameSpliter.length - 1];

    let data = {
        "fileName"      : fileName,
        "iccCardId"     : iccCardId,
        "eventImageId"  : eventImageId
    };

    // Delete image by ajax.
    $.ajax({
        url: baseUrl + 'eventImageAdmin/ajaxDeleteImage',
        type: 'post',
        data: data,
        dataType: 'json',
        beforeSend: function() {},
        error: function(xhr, textStatus) {
            swal("Error", textStatus, "error");
        },
        complete: function() {},
        success: function(result) {
            if(result.response == 1) {
                swal("ทำการลบภาพออกจากระบบเรียบร้อย");
                $("div#eventImage").html(result.htmlTable);
            } else {
                swal("เกิดปัญหาในการลบภาพ. โปรดลองอีกครั้ง");
            }
        }
    });
});
// -------------------------------------------------------------------------------------------- End AJAX.
// ******************************************************************************************** End Event.
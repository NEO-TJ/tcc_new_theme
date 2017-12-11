// ************************************************ Event **********************************************
//------------------------------------------------ Button ----------------------------------------------
// Submit & Reset
$('form#formInputData').on('submit', function(e) {
    e.preventDefault();

    if (ValidateInputRequire()) {
        SaveInputData();
    } else {
        ShowDialog(dltValidate);
    }
});


//------------------------------------------------ Delete Process ---------------------------------------
$(document).on('click', 'a#deleteRow', function(e) { confirmDeleteMasterdata(e); });

function confirmDeleteMasterdata(e) {
    let tr = $(e.target).closest('tr');
    let rowId = tr.find('td input#rowId').val();

    swal({
        title: "โปรดยืนยันการลบข้อมูล",
        html: '<div class="container">'
            + '<div class="row">'
            + '<div class="col-md-5">'
            + '<div class="text-center">การลบข้อมูลหลักในระบบ</div>'
            + '<div class="text-center">อาจส่งผลกระทบต่อข้อมูลอื่นที่เกี่ยวพันก่อนหน้านี้</div>'
            + '<p><p>'
            + '<div class="text-center">โปรดยืนยันการลบข้อมูล หากท่านตรวจสอบจนแน่ใจแล้ว</div>'
            + '</div></div></div>',
        type: "warning",
        showConfirmButton: true,
        showCancelButton: true,
        focusCancel: true,
        allowEnterKey: false,
        allowOutsideClick: false,
        closeOnConfirm: false,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'ยืนยัน!',
        cancelButtonText: "ยกเลิก",
        confirmButtonClass: 'btn btn-danger',
        closeOnConfirm: false,
        closeOnCancel: false,
    })
    .then((result) => {
        if(result) {
            deleteMasterdata(rowId);
        } else if (result.dismiss === 'cancel') {
            swal(
                'ยกเลิกการลบข้อมูล'
            )
        }
    });
}

function deleteMasterdata(rowId) {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
    let dataType = $('input#dataType').val();
    let data = {
        "rowId"     : rowId,
        "dataType"  : dataType,
    };

    // Ajax add or edit record.
    $.ajax({
        url: baseUrl + 'masterdata/ajaxDeleteMasterdata',
        type: 'post',
        data: data,
        beforeSend: function() {
            swal({
                title: "บันทึกข้อมูล...",
                text: '<span class="text-info"><i class="fa fa-refresh fa-spin"></i> กำลังดำเนินการ กรุณารอซักครู่...</span>',
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
                    title: "ดำเนินการเรียบร้อย!",
                    text: "ข้อมูลถูกลบออกจากระบบแล้ว",
                    type: "success",
                    showCancelButton: false,
                    allowOutsideClick: false,
                    confirmButtonText: "Done",
                    confirmButtonClass: "btn btn-success",
                }).then(function() {
                    successDeleteFullIccCard(dataType);
                });
            } else {
                swal({
                    title: "ไม่สำเร็จ!",
                    text: "เกิดความผิดพลาดในการลบข้อมูลจากระบบ กรุณาลองใหม่อีกครั้ง"
                        + "\n\n\n\n\n\n\n\n\n\n" + result,
                    type: "error",
                    confirmButtonColor: "#DD6B55"
                });
            }
        }
    });
}

function successDeleteFullIccCard(dataType) {
    window.location.href = window.location.origin + "/" 
        + window.location.pathname.split('/')[1] + "/masterdata/view/" + dataType;
}
//------------------------------------------------ End Delete Process -----------------------------------

//------------------------------------------------ Edit Process ---------------------------------------
$(document).on('click', 'a#editRow', function(e) { setChooseRowIdAndSubmitToEditMode(e); });

function setChooseRowIdAndSubmitToEditMode(e) {
    e.preventDefault();
    let tr = $(e.target).closest('tr');
    let rowId = tr.find('td input#rowId').val();

    $("input[name=rowId]").val(rowId);
    $("form#formChoose").submit();
}
//------------------------------------------------ End Edit Process -----------------------------------





//************************************************ Method **********************************************
//------------------------------------------------- Save -----------------------------------------------
function SaveInputData() {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
    let dataType = $('input#dataType').val();
    let data = $('form#formInputData').serializeArray();

    // Ajax add or edit record.
    $.ajax({
        url: baseUrl + 'masterdata/ajaxSaveInputData',
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
                    window.location.href = baseUrl + "masterdata/view/" + dataType
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
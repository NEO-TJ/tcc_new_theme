// -------------------------------------------------------------------------------------------- Daterange filter.
$('#daterange').on('apply.daterangepicker', function(ev, picker) { ChangeDaterange(picker); });
// -------------------------------------------------------------------------------------------- Province filter
$('select#provinceCode').on('change', function(e) { changeProvinceWithDateRange(e); });


// ******************************************************************************************** Method
// -------------------------------------------------------------------------------------------- AJAX
// ____________________________________________________________________________________________ Daterange.
function ChangeDaterange(picker) {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
    let strDateStart = picker.startDate.format('YYYY-MM-DD');
    let strDateEnd = picker.endDate.format('YYYY-MM-DD');

    let data = {
        'strDateStart'  : strDateStart,
        'strDateEnd'    : strDateEnd
    };

    // Filter with daterange by ajax.
    $.ajax({
        url: baseUrl + 'iccCard/ajaxGetPlaceByDaterange',
        type: 'post',
        data: data,
        dataType: 'json',
        beforeSend: function() {},
        error: function(xhr, textStatus) {
            swal("Error", textStatus + xhr.responseText, "error");
        },
        complete: function() {},
        success: function(result) {
            setSelectElementOfProvince(result.dsProvince, $('select#provinceCode'));
            setSelectElementOfProjectName(result.dsProjectName, $('select#projectName'));
        }
    });
}
// ____________________________________________________________________________________________ Province
function changeProvinceWithDateRange(e) {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
    picker = $('#daterange').data('daterangepicker');
    let strDateStart = picker.startDate.format('YYYY-MM-DD');
    let strDateEnd = picker.endDate.format('YYYY-MM-DD');
    let provinceCode = $('select#provinceCode :selected').val();

    let data = {
        'strDateStart'  : strDateStart,
        'strDateEnd'    : strDateEnd,
        'provinceCode'  : provinceCode
    };

    // Filter with province code by ajax.
    $.ajax({
        url: baseUrl + 'iccCard/ajaxGetFullSubProvince',
        type: 'post',
        data: data,
        dataType: 'json',
        beforeSend: function() {},
        error: function(xhr, textStatus) {
            swal("Error", textStatus + xhr.responseText, "error");
        },
        complete: function() {},
        success: function(result) {
            setSelectElementOfProjectName(result.dsProjectName, $('select#projectName'));
        }
    });
}



// ____________________________________________________________________________________________ End Province
// -------------------------------------------------------------------------------------------- Tool
// ____________________________________________________________________________________________ Set Select Elecment
function setSelectElementOfProvince(dataSet, $selector) {
    $selector.empty();
    $selector.append('<option value="0">เลือกทั้งหมด</option>');
    for (var i = 0; i < dataSet.length; i++) {
        $selector.append('<option value="' + dataSet[i].ProvinceCode + '">' + dataSet[i].ProvinceName + '</option>');
    }
}
function setSelectElementOfProjectName(dataSet, $selector) {
    $selector.empty();
    $selector.append('<option value="0">เลือกทั้งหมด</option>');
    for (var i = 0; i < dataSet.length; i++) {
        $selector.append('<option value="' + dataSet[i].id + '">' + dataSet[i].Project_Name + '</option>');
    }
}
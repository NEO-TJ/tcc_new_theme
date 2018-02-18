// -------------------------------------------------------------------------------------------- Binding multiselect element.
function bindingMultiselectProvinceCode() {
    $('select#provinceCode').multiselect({
        header: true,
        noneSelectedText: 'เลือกทั้งหมด',
        close: function(event, ui) { changeProvinceToPlaceWithDateRange(); }
    }).multiselectfilter();
}

// -------------------------------------------------------------------------------------------- Daterange filter.
$('#daterange').on('apply.daterangepicker', function(ev, picker) { ChangeDaterange(picker); });


// ******************************************************************************************** Method
// -------------------------------------------------------------------------------------------- AJAX
// ____________________________________________________________________________________________ Daterange.
function ChangeDaterange(picker) {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
    let strDateStart = picker.startDate.format('YYYY-MM-DD');
    let strDateEnd = picker.endDate.format('YYYY-MM-DD');

    let data = {
        'strDateStart'  : strDateStart,
        'strDateEnd'    : strDateEnd,
        'filterOrg'     : 0,
    };

    // Filter with daterange by ajax.
    $.ajax({
        url: baseUrl + 'ajaxService/ajaxGetPlaceByDaterange',
        type: 'post',
        data: data,
        dataType: 'json',
        beforeSend: function() {},
        error: function(xhr, textStatus) {
            swal("Error", textStatus, "error");
        },
        complete: function() {},
        success: function(result) {
            setSelectElementOfProvince(result.dsProvince);
            setSelectElementOfProjectName(result.dsProject, $('select#projectName'));
        }
    });
}
// ____________________________________________________________________________________________ Province
function changeProvinceToPlaceWithDateRange() {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
    picker = $('#daterange').data('daterangepicker');
    let strDateStart = picker.startDate.format('YYYY-MM-DD');
    let strDateEnd = picker.endDate.format('YYYY-MM-DD');
    let rProvinceCode = $('select#provinceCode').multiselect("getChecked").map(function() {
        return this.value;
    }).get();

    let data = {
        'strDateStart'  : strDateStart,
        'strDateEnd'    : strDateEnd,
        'rProvinceCode' : rProvinceCode,
        'filterOrg'     : 0,
    };

    // Filter with province code by ajax.
    $.ajax({
        url: baseUrl + 'ajaxService/ajaxGetPlaceByMultiProvince',
        type: 'post',
        data: data,
        dataType: 'json',
        beforeSend: function() {},
        error: function(xhr, textStatus) {
            swal("Error", textStatus, "error");
        },
        complete: function() {},
        success: function(result) {
            setSelectElementOfProjectName(result.dsProject, $('select#projectName'));
        }
    });
}



// ____________________________________________________________________________________________ End Province
// -------------------------------------------------------------------------------------------- Tool
// ____________________________________________________________________________________________ Set Select Elecment
function setSelectElementOfProvince(dataSet) {
    elementId = 'provinceCode';
    let elementTagInputSelecter = '<select class="form-control multi-select input-require"'
        + ' id="' + elementId + '" multiple="multiple">';
    for (let i = 0; i < dataSet.length; i++) {
        elementTagInputSelecter += '<option value="' + dataSet[i].ProvinceCode + '">';
        elementTagInputSelecter += dataSet[i].ProvinceName + '</option>';
    }

    $('div#' + elementId).html(elementTagInputSelecter);
    bindingMultiselectProvinceCode();
}
function setSelectElementOfProjectName(dataSet, $selector) {
    $selector.empty();
    $selector.append('<option value="0">เลือกทั้งหมด</option>');
    for (let i = 0; i < dataSet.length; i++) {
        $selector.append('<option value="' + dataSet[i].id + '">' + dataSet[i].Project_Name + '</option>');
    }
}
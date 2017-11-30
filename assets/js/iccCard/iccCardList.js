// ******************************************************************************************** Event.
// -------------------------------------------------------------------------------------------- Page Load.
$(document).ready(function() {
    initDaterange();
    initialPage();
});
// -------------------------------------------------------------------------------------------- Init DatetimePicker.
function initDaterange() {
    var start = moment().subtract(1, 'year').startOf('year');
    var end = moment();

    function cb(start, end) {
        $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month')
            , moment().subtract(1, 'month').endOf('month')],

            'This Year': [moment().startOf('year'), moment().endOf('year')],
            'Last Year': [moment().subtract(1, 'year').startOf('year')
            , moment().subtract(1, 'year').endOf('year')],

            '2 Year': [moment().subtract(1, 'year').startOf('year'), moment()],
            '5 Year': [moment().subtract(5, 'year').startOf('year'), moment()],
            '10 Year': [moment().subtract(10, 'year').startOf('year'), moment()]
        }
    }, cb);

    cb(start, end);
}
// -------------------------------------------------------------------------------------------- End Page Load.



// -------------------------------------------------------------------------------------------- Submit.
$(document).on("click", "a#editIccCard", function(e){
    e.preventDefault();

    let tr = $(e.target).closest('tr');
    let iccCardId = tr.find('td input#iccCardId').val();
    $('input[name=iccCardId]').val(iccCardId);

    $('form#formChoose').submit();
});
$(document).on("click", "a#eventImage", function(e){
    e.preventDefault();

    let tr = $(e.target).closest('tr');
    let iccCardId = tr.find('td input#iccCardId').val();
    $('input[name=iccCardId]').val(iccCardId);
    
    $('form#formChoose').attr('action', "eventImage/manipulate").submit();
});
// -------------------------------------------------------------------------------------------- Search.
$('button#search').on('click', function(e) { filterThenRenderIccCardList(0); });
// -------------------------------------------------------------------------------------------- Click command.
$(document).on('click', 'button#approveIccCard', function(e) { confirmApproveIccCardStatus(getConfirmInfo(e)); });
// -------------------------------------------------------------------------------------------- End Click command.




// ******************************************************************************************** Method.
// -------------------------------------------------------------------------------------------- AJAX.
// ____________________________________________________________________________________________ Search
function filterThenRenderIccCardList(pageCode) {
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
    picker = $('#daterange').data('daterangepicker');
    let strDateStart = picker.startDate.format('YYYY-MM-DD');
    let strDateEnd = picker.endDate.format('YYYY-MM-DD');
    let provinceCode = $('select#provinceCode :selected').val();
    let amphurCode = $('select#amphurCode :selected').val();
    let projectName = $('select#projectName :selected').val();
    let orgId = $('select#orgId :selected').val();
    let garbageTypeId = $('select#garbageTypeId :selected').val();
    let iccCardStatusCode = $('select#iccCardStatusCode :selected').val();
    page = ( (pageCode) ? pageCode : 0); 

    let data = {
        "rDataFilter" : {
            'strDateStart'      : strDateStart,
            'strDateEnd'        : strDateEnd,
            'provinceCode'      : provinceCode,
            'amphurCode'        : amphurCode,
            'projectName'       : projectName,
            'orgId'             : orgId,
            'garbageTypeId'     : garbageTypeId,
            'iccCardStatusCode' : iccCardStatusCode
        },
        "page" : page
    };

    // Get ICC Card List by ajax.
    $.ajax({
        url: baseUrl + 'iccCard/ajaxGetIccCardList',
        type: 'post',
        data: data,
        dataType: 'json',
        beforeSend: function() {},
        error: function(xhr, textStatus) {
            swal("Error", textStatus + xhr.responseText, "error");
        },
        complete: function() {},
        success: function(rDataResult) {
            $('div#paginationLinks').html(rDataResult.paginationLinks);
            RenderBodyTable(rDataResult.dsIccCardList, rDataResult.rIccCardStatus, rDataResult.userAuthenLevel);
        }
    });
}
// ____________________________________________________________________________________________ Pagination.
$(document).on("click", ".pagination li a", function(e) {
    e.preventDefault();

    let pageCode = $(this).data("ci-pagination-page");
    filterThenRenderIccCardList(pageCode);
});
// -------------------------------------------------------------------------------------------- End AJAX.

// -------------------------------------------------------------------------------------------- Click command.
function successApproveIccCardStatus() { window.location.href = window.location.href }
// -------------------------------------------------------------------------------------------- End Click command.

// -------------------------------------------------------------------------------------------- Tool.
function getConfirmInfo(e) {
    let tr = $(e.target).closest('tr');

    let rData = {
        "iccCardId"     : tr.find('td input#iccCardId').val(),
        "projectName"   : tr.find('td:nth-child(3)').text(),
        "provinceName"  : tr.find('td:nth-child(6)').text(),
        "eventDate"     : tr.find('td:nth-child(7)').text(),
        "status"        : tr.find('td:nth-child(8)').text()
    };

    return rData;
}
// -------------------------------------------------------------------------------------------- End Tool.


function RenderBodyTable(dsIccCardList, rIccCardStatus, userAuthenLevel) {
    let html = "";
    let lastColumn
    for(let i = 0; i < dsIccCardList.length; i++) {
        let row = dsIccCardList[i];
        html += '<tr>';
        html += '<td class="text-center">' + (i+1) + '</td>';
        html += '<td class="text-left">' + row["ชื่อโครงการ"] + '</td>';
        html += '<td class="text-left">' + row["ชื่อสถานที่ทำกิจกรรม"] + '</td>';
        html += '<td class="text-left">' + row["อำเภอ"] + '</td>';
        html += '<td class="text-left">' + row["จังหวัด"] + '</td>';
        html += '<td class="text-left">' + row["วันที่ทำกิจกรรม"] + '</td>';

        html += '<td class="text-center">' + rIccCardStatus[row["สถานะของโครงการ"]];
        if( ((userAuthenLevel == 1) || (userAuthenLevel == 2)) && (row["สถานะของโครงการ"] == 1) ) {
            html += '<div><button id="approveIccCard" type="button" class="btn btn-info">อนุมัติ</button></div>';
        }
        html += '</td>';

        html += '<td class="text-center">';
        html += '<a style="float:left; margin-right:8px;"';
        html += ' title="แก้ไขแบบฟอร์ม" class="btn btn-primary btn-xs"';
        html += ' href="#" role="button" id="editIccCard">';
        html += '<i class="fa fa-cog"></i>';
        html += '</a>';
        html += '<input type="hidden" id="iccCardId" value=' + row['id'] + '>'
        html += '</td>';

        html += '<td class="text-center">';
        html += '<a href="#" id="eventImage" class="button button-block button-rounded button-large">';
        html += 'ภาพกิจกรรม';
        html += '</a>';
        html += '</td>';

        html += '</tr>';
    }
    $('table#iccCard tbody').html(html);
}



// ____________________________________________________________________________________________ Initial Page load.
function initialPage() {
    $('select#provinceCode').trigger('change');
}
// ____________________________________________________________________________________________ End Initial Page load.
// ******************************************************************************************** End Method.
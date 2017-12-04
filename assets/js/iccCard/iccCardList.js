// ******************************************************************************************** Event.
// -------------------------------------------------------------------------------------------- Page Load.
$(document).ready(function() {
    initDaterange();
    initPageLoad();
});
// -------------------------------------------------------------------------------------------- Init DatetimePicker.
function initDaterange() {
    var start = moment().subtract(10, 'year').startOf('year');
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
$(document).on("click", "a#eventImageAdmin", function(e){
    e.preventDefault();
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";

    let tr = $(e.target).closest('tr');
    let iccCardId = tr.find('td input#iccCardId').val();
    $('input[name=iccCardId]').val(iccCardId);
    
    $('form#formChoose').attr('action', baseUrl + "eventImageAdmin").submit();
});
// -------------------------------------------------------------------------------------------- Search.
$('button#search').on('click', function(e) { filterThenRenderIccCardList(0); });
// -------------------------------------------------------------------------------------------- Pagination.
$(document).on("click", '.pagination a', function (e) {
    e.preventDefault();

    let link = $(this).get(0).href; // get the link from the DOM object
    let segments = link.split('/');
    let pageCode = segments[segments.length - 1];
    
    if( (pageCode !== "#") && ($.isNumeric(pageCode)) ) {
        filterThenRenderIccCardList(pageCode);
    } else {
        document.getElementById('sectionBody').scrollIntoView(true);
    }
});
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
    let iccCardId = $('select#projectName :selected').val();
    let orgId = $('select#orgId :selected').val();
    let garbageTypeId = $('select#garbageTypeId :selected').val();
    let iccCardStatusCode = $('select#iccCardStatusCode :selected').val();
    pageCode = ( (pageCode) ? pageCode : 0); 

    let data = {
        "rDataFilter" : {
            'strDateStart'      : strDateStart,
            'strDateEnd'        : strDateEnd,
            'provinceCode'      : provinceCode,
            'amphurCode'        : amphurCode,
            'iccCardId'         : iccCardId,
            'orgId'             : orgId,
            'garbageTypeId'     : garbageTypeId,
            'iccCardStatusCode' : iccCardStatusCode
        },
        "pageCode" : pageCode
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
            $('table#iccCard tbody').html(rDataResult.htmlTableBody);
        }
    });
}
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

// ____________________________________________________________________________________________ Initial Page load.
function initPageLoad() {
    changeProvinceWithDateRange();
    filterThenRenderIccCardList();
}
// ____________________________________________________________________________________________ End Initial Page load.
// ******************************************************************************************** End Method.
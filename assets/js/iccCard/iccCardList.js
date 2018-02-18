// ******************************************************************************************** Event.
// -------------------------------------------------------------------------------------------- Page Load.
$(document).ready(function() {
    initDaterange();
    initPageLoad();
});

// ____________________________________________________________________________________________ Initial Page load.
function initPageLoad() {
    ChangeDaterange($('#daterange').data('daterangepicker'));
    filterThenRenderIccCardList();
}
// ____________________________________________________________________________________________ End Initial Page load.
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
$(document).on("click", "a#approveIccCard", function(e){
    e.preventDefault();
    confirmApproveIccCardStatus(getConfirmInfo(e));
});
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
            swal("Error", textStatus, "error");
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
// ******************************************************************************************** End Method.
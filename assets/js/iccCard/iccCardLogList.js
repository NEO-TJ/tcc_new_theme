// ******************************************************************************************** Event.
// -------------------------------------------------------------------------------------------- Page Load.
$(document).ready(function() {
    initDaterange();
    initPageLoad();
});

// -------------------------------------------------------------------------------------------- Init DatetimePicker.
function initDaterange() {
    let start = moment("10-01-2017", "MM-DD-YYYY");
    let end = moment("09-30-2018", "MM-DD-YYYY");

    function cb(start, end) {
        $('#daterange span').html(start.format('MMMM D, YYYY') + '  ---  ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'วันนี้': [moment(), moment()],
            'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],

            'ปีงบประมาณ 2561'
                : [moment("10-01-2017", "MM-DD-YYYY"), moment("09-30-2018", "MM-DD-YYYY")],
            'ปีงบประมาณ 2560'
                : [moment("10-01-2016", "MM-DD-YYYY"), moment("09-30-2017", "MM-DD-YYYY")],
            'ปีงบประมาณ 2559'
                : [moment("10-01-2015", "MM-DD-YYYY"), moment("09-30-2016", "MM-DD-YYYY")],
            'ปีงบประมาณ 2558'
                : [moment("10-01-2014", "MM-DD-YYYY"), moment("09-30-2015", "MM-DD-YYYY")],
            'ปีงบประมาณ 2557'
                : [moment("10-01-2013", "MM-DD-YYYY"), moment("09-30-2014", "MM-DD-YYYY")],
        }
    }, cb);

    cb(start, end);
}
// -------------------------------------------------------------------------------------------- End Page Load.



// -------------------------------------------------------------------------------------------- Search.
$('button#search').on('click', function(e) { filterThenRenderIccCardLogList(0); });
// -------------------------------------------------------------------------------------------- Pagination.
$(document).on("click", '.pagination a', function (e) {
    e.preventDefault();

    let link = $(this).get(0).href; // get the link from the DOM object
    let segments = link.split('/');
    let pageCode = segments[segments.length - 1];
    
    if( (pageCode !== "#") && ($.isNumeric(pageCode)) ) {
        filterThenRenderIccCardLogList(pageCode);
    } else {
        document.getElementById('sectionBody').scrollIntoView(true);
    }
});




// ******************************************************************************************** Method.
// -------------------------------------------------------------------------------------------- AJAX.
// ____________________________________________________________________________________________ Search
function filterThenRenderIccCardLogList(pageCode) {
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
        url: baseUrl + 'iccCard/ajaxGetIccCardLogList',
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


// ____________________________________________________________________________________________ Initial Page load.
function initPageLoad() {
    ChangeDaterange($('#daterange').data('daterangepicker'));
    filterThenRenderIccCardLogList();
}
// ____________________________________________________________________________________________ End Initial Page load.
// ******************************************************************************************** End Method.
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
    pageCode = ( (pageCode) ? pageCode : 0); 

    let data = {
        "rDataFilter" : {
            'strDateStart'      : strDateStart,
            'strDateEnd'        : strDateEnd,
            'provinceCode'      : provinceCode,
            'amphurCode'        : amphurCode,
            'iccCardId'         : iccCardId,
        },
        "pageCode" : pageCode
    };

    // Get ICC Card List by ajax.
    $.ajax({
        url: baseUrl + 'eventImageGallery/ajaxGetIccCardList',
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
// ******************************************************************************************** End Method.
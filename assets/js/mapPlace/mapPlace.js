// ******************************************************************************************** Event.
// -------------------------------------------------------------------------------------------- Page Load.
$(document).ready(function() {
    initDaterange();
    initPageLoad();
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

// ____________________________________________________________________________________________ Force AJAX.
// -------------------------------------------------------------------------------------------- Click Render main report
$('button#search').on('click', function(e) { filterThenRenderMapPlace(); });
// ******************************************************************************************** End Event.





// ******************************************************************************************** AJAX.
function filterThenRenderMapPlace() {
    picker = $('#daterange').data('daterangepicker');
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
    let strDateStart = picker.startDate.format('YYYY-MM-DD');
    let strDateEnd = picker.endDate.format('YYYY-MM-DD');
    let provinceCode = $('select#provinceCode :selected').val();
    let iccCardId = $('select#projectName :selected').val();
    let orgId = $('select#orgId :selected').val();
    
    let data = {
        "rDataFilter" : {
            'strDateStart'  : strDateStart,
            'strDateEnd'    : strDateEnd,
            'provinceCode'  : provinceCode,
            'iccCardId'     : iccCardId,
            'orgId'         : orgId,
        },
    };

    // Get dashboard report by ajax.
    $.ajax({
        url: baseUrl + 'mapPlace/ajaxGetMapPlaceList',
        type: 'post',
        data: data,
        dataType: 'json',
        beforeSend: function(){},
        error: function(xhr, textStatus){
            swal("Error", textStatus + xhr.responseText, "error");
        },
        complete: function(){},
        success: function(result) {
            renderMarkerMapPlace(result);
        }
    });
}
// ******************************************************************************************** End AJAX.





// ******************************************************************************************** Method.
// ____________________________________________________________________________________________ Initial Page load.
function initPageLoad() {
    ChangeDaterange($('#daterange').data('daterangepicker'));
    filterThenRenderMapPlace();
}
// ____________________________________________________________________________________________ End Initial Page load.


// &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& Render.
// ____________________________________________________________________________________________ Map.
function renderMarkerMapPlace(data) {
    //Removing already Added Markers//////////
    for(let i=0; i < markers_map.length; i++){
        markers_map[i].setMap(null);
    }
    markers_map = new Array();
    //////////////////////////////////////////
    // Adding New Markers////////////////////
    $.each(data, function(index, value) {
        let lat = parseFloat(value.Lat);
        let lng = parseFloat(value.Lon);
        let myLatlng = new google.maps.LatLng(lat,lng);

        let marker = {
            map                 : map,
            position            : myLatlng, // These are the minimal Options, you can add others too
            title               : value.Project_Name,
            infowindow_open     : true,
            infowindow_content  : value.Project_Name + "<p>" + value.sumQty,
        };
        createMarker_map(marker);
    });
}
// ____________________________________________________________________________________________ End Map.
// &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& End Render.
// ******************************************************************************************** End Method.
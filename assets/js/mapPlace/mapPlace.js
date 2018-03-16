// ******************************************************************************************** Event.
// -------------------------------------------------------------------------------------------- Page Load.
$(document).ready(function() {
    // Multiselect element.
    bindingMultiselectProvinceCode();
    // Daterange element.
    initDaterange();

    initPageLoad();
});

// ____________________________________________________________________________________________ Initial Page load.
function initPageLoad() {
    ChangeDaterange($('#daterange').data('daterangepicker'));
    filterThenRenderMapPlace();
}
// ____________________________________________________________________________________________ End Initial Page load.


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
    let iccCardId = $('select#projectName :selected').val();
    let orgId = $('select#orgId :selected').val();
    let rProvinceCode = $('select#provinceCode').multiselect("getChecked").map(function() {
        return this.value;
    }).get();
    
    let data = {
        "rDataFilter" : {
            'strDateStart'  : strDateStart,
            'strDateEnd'    : strDateEnd,
            'rProvinceCode' : rProvinceCode,
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
            swal("Error", textStatus, "error");
        },
        complete: function(){},
        success: function(result) {
            renderMarkerMapPlace(result);
        }
    });
}
// ******************************************************************************************** End AJAX.





// ******************************************************************************************** Method.
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
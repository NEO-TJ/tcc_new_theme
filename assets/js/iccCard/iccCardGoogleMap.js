// ************************************************ Method *********************************************
var map = null;
var marker = null;
var markers = [];
var enalbeZoom = 0;

function initMap2() {
//unset($dsInput['dsGeoLocation'][0]['Lat'] );
                
            //  unset($dsInput['dsGeoLocation'][0]['Lon']);

if( isset($dsInput['dsGeoLocation'][0]['Lat']) && isset($dsInput['dsGeoLocation'][0]['Lon']) && $dsInput['dsGeoLocation'][0]['Lat']){
            var mapOptions = {
                zoom: 11,
                center: {lat: $dsInput['dsGeoLocation'][0]['Lat'], lng: $dsInput['dsGeoLocation'][0]['Lon']},
                mapTypeId: google.maps.MapTypeId.ROADMAP
        };
     }else{
            var mapOptions = {
                zoom: 8,
                center: {lat: 14.843921460859, lng: 100.42971611023},
                mapTypeId: google.maps.MapTypeId.ROADMAP
        };
}
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        google.maps.event.addListener(map, 'click', function(e) {
                placeMarker(e.latLng, map);
        });
        if(isset($dsInput['dsGeoLocation'][0]['Lat']) && isset($dsInput['dsGeoLocation'][0]['Lon']) && $dsInput['dsGeoLocation'][0]['Lat']){
        var myLatLng = new google.maps.LatLng({lat: $dsInput['dsGeoLocation'][0]['Lat'], lng: $dsInput['dsGeoLocation'][0]['Lon']});
        placeMarker(myLatLng, map); 
        }
        google.maps.event.addListener(map, 'zoom_changed', function(e) {
                var zoom = map.getZoom();
                if (enalbeZoom) { document.getElementById('labinfoform-zoom').value = zoom; }
        });
}

initMap2();

function placeMarker(position, map) {
        if (!marker) {
                marker = new google.maps.Marker({
                        position: position,
                        draggable: true,
                        map: map
                });
                
                var lat = position.lat();
                var lng = position.lng();
                var zoom = map.getZoom();
                
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                if (enalbeZoom) { document.getElementById('labinfoform-zoom').value = zoom; }

                google.maps.event.addListener(marker, 'drag', function(e) {
                        var lat = e.latLng.lat();
                        var lng = e.latLng.lng();
                        var zoom = map.getZoom();
                        
                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lng;
                        if (enalbeZoom) { document.getElementById('labinfoform-zoom').value = zoom; }
                });

                map.panTo(position);
                markers.push(marker);
                markers[0].setMap(map);
        }
}
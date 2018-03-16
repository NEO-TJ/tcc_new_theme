<?php 
    // Plugin.
    //echo my_js_asset("plugins/bootstrap-daterangepicker-master/js/moment.min.js");
    echo my_js_asset("plugins/bootstrap-daterangepicker-master/js/daterangepicker.js");
    echo my_js_asset('plugins/jquery-multiselect/js/jquery.multiselect.js');
    echo my_js_asset('plugins/jquery-multiselect/js/jquery.multiselect.filter.js');

    // My Java Script.
    echo $map['js'];
    echo js_asset('mapPlace/mapPlace.js');
    echo js_asset('customize/initialDaterange.js');
    echo js_asset('mapPlace/mapPlaceFilterRelation.js');
?>
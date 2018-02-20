<?php 
    // Plugin.
    //echo my_js_asset("plugins/bootstrap-daterangepicker-master/js/moment.min.js");
    echo my_js_asset("plugins/bootstrap-daterangepicker-master/js/daterangepicker.js");
    echo my_js_asset("plugins/jquery-fileDownload/js/jquery.fileDownload.js");

    // My Java Script.
    echo js_asset('iccCard/iccCardList.js');
    echo js_asset('customize/initialDaterange.js');
    echo js_asset('iccCard/iccCardFilterRelation.js');
    echo js_asset('iccCard/iccCardStatus.js');
?>
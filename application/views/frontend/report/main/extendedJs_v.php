<?php 
    // Plugin.
    //echo my_js_asset("plugins/bootstrap-daterangepicker-master/js/moment.min.js");
    echo my_js_asset("plugins/bootstrap-daterangepicker-master/js/daterangepicker.js");
    echo my_js_asset("plugins/fusioncharts/js/fusioncharts.js");
    echo my_js_asset("plugins/fusioncharts/js/themes/fusioncharts.theme.fint.js");
    echo my_js_asset("plugins/table2excel/js/jquery.table2excel.min.js");
    echo my_js_asset('plugins/jquery-multiselect/js/jquery.multiselect.js');
    echo my_js_asset('plugins/jquery-multiselect/js/jquery.multiselect.filter.js');

    // My Java Script.
    echo $map['js'];
    echo js_asset('report/reportMain.js');
    echo js_asset('customize/initialDaterange.js');
    echo js_asset('report/reportFilterRelation.js');
?>
<?php 
    // Plugin.
    echo my_css_asset("plugins/bootstrap-daterangepicker-master/css/daterangepicker.css");
    //echo $map['js'];
    // Shared Css.
    $this->load->view('template/sharedCss_v');
    // My Css.
    echo css_asset('iccCard/stylesheet.css');
?>
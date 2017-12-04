<?php 
    // Plugin.
    echo my_css_asset("plugins/prettyPhoto/css/prettyPhoto.css");
    // Shared Css.
    $this->load->view('template/sharedCss_v');
    // My Css.
    echo css_asset('eventImage/stylesheet.css');
?>
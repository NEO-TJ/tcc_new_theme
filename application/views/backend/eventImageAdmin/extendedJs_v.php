<?php 
    // Plugin.
    echo my_js_asset("plugins/prettyPhoto/js/jquery.prettyPhoto.js");
    // Shared Java Script.
    $this->load->view('template/sharedJs_v');
    
    // My Java Script.
    echo js_asset('eventImage/galleryPlugin.js');
?>
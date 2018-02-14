<?php 
    // Plugin.
    echo js_asset('plugin/moment/moment.min.js');
    echo js_asset('plugin/bootstrap/bootstrap-datetimepicker.min.js');
    echo my_js_asset("plugins/printPreview/js/printPreview.js");

    // My Java Script.
    echo js_asset('iccCard/iccCardInput.js');
    echo js_asset('iccCard/iccCardContactInfo.js');
    echo js_asset('iccCard/iccCardEntangledAnimal.js');
    echo js_asset('iccCard/iccCardGarbageTransaction.js');
    //echo js_asset('iccCard/iccCardGoogleMap.js');
    echo js_asset('iccCard/iccCardfilterRelation.js');
    echo js_asset('iccCard/iccCardStatus.js');
    echo js_asset('iccCard/iccCardPrint.js');
    ?>
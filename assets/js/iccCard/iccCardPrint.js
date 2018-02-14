// ******************************************************************************************** Event
// -------------------------------------------------------------------------------------------- Page Load
$(document).ready(function() {
    $("#btnPrintIccCard").printPreview({
        obj2print:'#iccCardPrint',

        // additonal CSS styles
        style:'',
        // the width of the print preview window
        width:screen.width,
        // the width of the print preview window
        height:screen.height,
        // top position
        top:0, 
        // left position
        left:'center',
        // resizable
        resizable :'yes',
        // display scrollbar
        scrollbars:'yes',
        // display status
        status:'no',
        // title of the print preview window
        title:'_'
    });
});
// -------------------------------------------------------------------------------------------- End Page Load
// ******************************************************************************************** End Event
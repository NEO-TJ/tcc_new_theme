;(function ( $ ) {
    $.fn.printPreview = function( options ) {
        let elem = this;
        
        let opt = $.extend({
            obj2print:'body',
            style:'',
            width:'670',
            height:screen.height-105,
            top:0,
            left:'center',
            resizable : 'yes',
            scrollbars:'yes',
            status:'no',
            title:'Print Preview'
        }, options );
        if(opt.left == 'center'){
            opt.left=(screen.width/2)-(opt.width/2);
        }
    // Edited by Koravit.
        /*
        $(opt.obj2print+" input").each(function(){
            $(this).attr('value',$(this).val());
        });
        $(opt.obj2print+" textarea").each(function(){
            $(this).html($(this).val());
        });
        */
    // End Edited by Koravit.
        return elem.bind("click.printPreview", function () {
        // Edited by Koravit.
            $(opt.obj2print+" input").each(function(){
                if(!$(this).val()) {
                    $(this).attr("placeholder", "");
                }
                $(this).attr('value', $(this).val());
            });
            $(opt.obj2print+" textarea").each(function(){
                $(this).html($(this).val());
            });
            $(opt.obj2print+" select").each(function(){
                let elemSelected = $(this).prop("id");
                $("#" + elemSelected + " :first").html("");
            });
        // End Edited by Koravit.

            let btnCode = elem[0].outerHTML;
            let headString = '';
            headString = $("head").html();
            let str = "<!DOCTYPE html><html><head>"+headString+opt.style+"</head><body>";
            str+=$(opt.obj2print)[0].outerHTML.replace(btnCode,'')+"</body></html>";
            //top open multiple instances we have to name newWindow differently, so getting milliseconds
            let d = new Date();
            let n = 'newWindow'+d.getMilliseconds();
            let newWindow = window.open(
                    "", 
                    n, 
                    "width="+opt.width+
                    ",top="+opt.top+
                    ",height="+opt.height+
                    ",left="+opt.left+
                    ",resizable="+opt.resizable+
                    ",scrollbars="+opt.scrollbars+
                    ",status="+opt.status
                    );
            newWindow.document.write(str);
            newWindow.document.title = opt.title;
        });
    };
}( jQuery ));

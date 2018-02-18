// ******************************************************************************************** Global Variable.
let rDataSinglePlaceChart = Array();
let rCaptionSinglePlaceChart = Array();
// ******************************************************************************************** End Global Variable.


// ******************************************************************************************** Event.
// -------------------------------------------------------------------------------------------- Page Load.
$(document).ready(function() {
    // Multiselect element.
    bindingMultiselectProvinceCode();
    // Daterange element.
    initDaterange();
    
    initPageLoad();
});

// ____________________________________________________________________________________________ Initial Page load.
function initPageLoad() {
    ChangeDaterange($('#daterange').data('daterangepicker'));
    filterThenRenderMainReport();
}



// -------------------------------------------------------------------------------------------- radio button.
$("input#chartPie3").on("click", renderChartMarineDebrisSinglePlace);
$("input#chartLine").on("click", renderChartMarineDebrisSinglePlace);

// -------------------------------------------------------------------------------------------- Click Export table to csv
$("a#marineDebrisSinglePlaceExport").click(function(e){
    e.preventDefault();

    $("table#marineDebrisSinglePlaceTable").table2excel({
        exclude: ".noExl",                  // exclude CSS class
        name: "MarinDebris Summary",
        filename: "MarinDebris_Summary.xls" //do not include extension
    });
});
$("a#marineDebrisGroupingPlaceExport").click(function(e){
    e.preventDefault();

    $("table#marineDebrisGroupingPlaceTable").table2excel({
        exclude: ".noExl",                  // exclude CSS class
        name: "MarinDebris ByPlace",
        filename: "MarinDebris_ByPlace.xls" //do not include extension
    });
});

// ____________________________________________________________________________________________ Force AJAX.
// -------------------------------------------------------------------------------------------- Click Render main report
$('button#genReport').on('click', function(e) { filterThenRenderMainReport(); });
// ******************************************************************************************** End Event.




// ******************************************************************************************** AJAX.
function filterThenRenderMainReport() {
    picker = $('#daterange').data('daterangepicker');
    let baseUrl = window.location.origin + "/" + window.location.pathname.split('/')[1] + "/";
    let rankingLimit = $("input[name='rankingLimit']:checked").val();
    let strDateStart = picker.startDate.format('YYYY-MM-DD');
    let strDateEnd = picker.endDate.format('YYYY-MM-DD');
    let iccCardId = $('select#projectName :selected').val();
    let rProvinceCode = $('select#provinceCode').multiselect("getChecked").map(function() {
        return this.value;
    }).get();

    let data = {
        'rankingLimit'  : rankingLimit,
        'strDateStart'  : strDateStart,
        'strDateEnd'    : strDateEnd,
        'rProvinceCode' : rProvinceCode,
        'iccCardId'     : iccCardId
    }

    // Get dashboard report by ajax.
    $.ajax({
        url: baseUrl + 'report/ajaxGetMainReportData',
        type: 'post',
        data: data,
        dataType: 'json',
        beforeSend: function(){},
        error: function(xhr, textStatus){
            swal("Error", textStatus, "error");
        },
        complete: function(){},
        success: function(result) {
            // Set Global MarineDebrisSinglePlace data.
            rDataSinglePlaceChart = result.dsMarineDebrisSinglePlace;
            // Set Global Caption.
            rCaptionSinglePlaceChart = createCaptionReportByFilter();

            // Render all elements.
            renderMarkerMapPlace(result.dsMarineDebrisEventMapPlace);
            renderChart(result);
            renderTable(result.dsMarineDebrisSinglePlace, result.dsMarineDebrisGroupingPlace);
        }
    });
}
// ******************************************************************************************** End AJAX.








// ******************************************************************************************** Method.
// ____________________________________________________________________________________________ MultiSelect.
function getMultiProvinceName() {
    let selText = "";
    $("select#provinceCode :selected").each(function () {
        let $this = $(this);
        if ($this.length) {
            selText += $this.text() + ", ";
        }
    });
    if(selText.length > 3) {
        selText = selText.substring(0, selText.length - 2)
    }

    return selText;
}
function createReportCaptionMultiProvince() {
    let rProvinceCode = $('select#provinceCode').multiselect("getChecked").map(function() {
        return this.value;
    }).get();

    let strPlaceName = (($('select#projectName :selected').val() > 0)
        ? $('select#projectName :selected').html()
        : (
            (rProvinceCode.length == 0)
            ? "ประเทศไทย"
            : (
                (rProvinceCode.length == 1)
                ? "จังหวัด" + $('select#provinceCode :selected').html()
                : " " + rProvinceCode.length + " จังหวัด"
            )
        )
    );

    return strPlaceName;
}
function createTableCaptionMultiProvince() {
    let rProvinceCode = $('select#provinceCode').multiselect("getChecked").map(function() {
        return this.value;
    }).get();

    let strPlaceName = (($('select#projectName :selected').val() > 0)
        ? $('select#projectName :selected').html()
        : (
            (rProvinceCode.length == 0)
            ? "ในประเทศไทย"
            : (
                (rProvinceCode.length == 1)
                ? $('select#provinceCode :selected').html()
                : getMultiProvinceName()
            )
        )
    );

    return strPlaceName;
}




// &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& Render.
// ____________________________________________________________________________________________ Map.
function renderMarkerMapPlace(data) {
    //Removing already Added Markers//////////
    for(let i=0; i < markers_map.length; i++){
        markers_map[i].setMap(null);
    }
    markers_map = new Array();
    //////////////////////////////////////////
    // Adding New Markers////////////////////
    $.each(data, function(index, value) {
        let lat = parseFloat(value.Lat);
        let lng = parseFloat(value.Lon);
        let myLatlng = new google.maps.LatLng(lat,lng);

        let marker = {
            map                 : map,
            position            : myLatlng, // These are the minimal Options, you can add others too
            title               : value.Project_Name,
            infowindow_open     : true,
            infowindow_content  : value.Project_Name + "<p>" + value.sumQty,
        };
        createMarker_map(marker);
    });
}
// ____________________________________________________________________________________________ End Map.






// ____________________________________________________________________________________________ Render Charts.
function createCaptionReportByFilter(){
    result = Array();
    // Prepare project name caption.
    result['placeName'] = createReportCaptionMultiProvince();
    // Prepare period time caption.
    let d1 = $('#daterange').data('daterangepicker').startDate;
    let d2 = moment("10-01-2017", "MM-DD-YYYY");
    let years = moment(d1).diff(d2, 'years');
    result['periodTime'] = Number("2561") + Number(years);

    return result;
}

function renderChart(rDsData) {
    // Render Marin debrise single place chart.
    renderChartMarineDebrisSinglePlace();
    // Render Marin debrise grouping place chart.
    renderChartMarineDebrisGroupingPlace(rDsData);
}

// ============================================================================================ Single Place Charts.
function renderChartMarineDebrisSinglePlace() {
    // Get chart type.
    let chartTypeJSName = ($("input[name='chartType']:checked").val() == 1) ? "pie3d" : "line";
    // Render chart.
    FusionCharts.ready(function () {
        let marineDebrisSinglePlaceChart = new FusionCharts({
            "type": chartTypeJSName,
            "renderAt": "marineDebrisSinglePlaceChart",
            "width": "100%",
            "height": "450",
            "dataFormat": "json",
            "dataSource": {
                "chart": {
                    "exportEnabled": "1",
                    "exportFileName": "marinDebris_" + chartTypeJSName + "Chart",
                    "exportFormats": "PNG=Export As PNG|"
                        + "JPG=Export As JPG|"
                        + "PDF=Export As PDF|"
                        + "SVG=Export As SVG|",
                    "caption": "ข้อมูลปริมาณขยะทะเลใน"
                        + rCaptionSinglePlaceChart['placeName']
                        + " (ปีงบประมาณ " + rCaptionSinglePlaceChart['periodTime'] + ")",
                    "subCaption": "โดยกรมทรัพยากรทางทะเลและชายฝั่ง",
                    "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
                    "bgColor": "#ffffff",
                    "showBorder": "0",
                    "use3DLighting": "0",
                    "showShadow": "0",
                    "enableSmartLabels": "1",
                    "startingAngle": "0",
                    "showValue" : "1", 
                    "showPercentValues": "0",
                    "showPercentInTooltip": "1",
                    "formatNumber": "1",
                    "decimals": "1",
                    "captionFontSize": "14",
                    "subcaptionFontSize": "14",
                    "subcaptionFontBold": "0",
                    "toolTipColor": "#ffffff",
                    "toolTipBorderThickness": "0",
                    "toolTipBgColor": "#000000",
                    "toolTipBgAlpha": "80",
                    "toolTipBorderRadius": "2",
                    "toolTipPadding": "5",
                    "showHoverEffect": "1",
                    "showLegend": "1",
                    "legendBgColor": "#ffffff",
                    "legendBorderAlpha": "0",
                    "legendShadow": "0",
                    "legendItemFontSize": "10",
                    "legendItemFontColor": "#666666",
                    "useDataPlotColorForLabels": "1",
                },
                "data": rDataSinglePlaceChart
            }
        }).render();
    });
}

// ============================================================================================ Grouping Place Charts.
function renderChartMarineDebrisGroupingPlace(rDsData) {
    // Prepare data and caption.
    let rDataGroupingPlaceChart = PrepareGroupingPlaceDataToChart(
        rDsData.dsMarineDebrisGroupingPlace, rDsData.placeCount, rDsData.rankingLimit);

    // Render chart.
    FusionCharts.ready(function () {
        let marineDebrisGroupingPlaceChart = new FusionCharts({
            "type": "stackedcolumn3d",
            "renderAt": "marineDebrisPlaceGroupChart",
            "width": "100%",
            "height": "1200",
            "dataFormat": "json",
            "dataSource": {
                "chart": {
                    "exportEnabled": "1",
                    "exportFileName": "marinDebris_columnChart",
                    "exportFormats": "PNG=Export As PNG|"
                                    + "JPG=Export As JPG|"
                                    + "PDF=Export As PDF|"
                                    + "SVG=Export As SVG|",
                    "caption": "รายงานแผนภูมิแท่ง เปรียบเทียบชนิดและปริมาณขยะทะเลใน"
                        + rCaptionSinglePlaceChart['placeName']
                        + " (ปีงบประมาณ " + rCaptionSinglePlaceChart['periodTime'] + ")",
                    "subCaption": "โดยกรมทรัพยากรทางทะเลและชายฝั่ง",
                    "xAxisName": "สถานที่",
                    "yAxisName": "จำนวน",
                    "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
                    "bgColor": "#ffffff",
                    "showBorder": "0",
                    "use3DLighting": "0",
                    "showShadow": "0",
                    "enableSmartLabels": "1",
                    "startingAngle": "0",
                    "showsum": "1",
                    "showValue" : "1", 
                    "showPercentValues": "0",
                    "showPercentInTooltip": "1",
                    "formatNumber": "1",
                    "decimals": "1",
                    "captionFontSize": "14",
                    "subcaptionFontSize": "14",
                    "subcaptionFontBold": "0",
                    "toolTipColor": "#ffffff",
                    "toolTipBorderThickness": "0",
                    "toolTipBgColor": "#000000",
                    "toolTipBgAlpha": "80",
                    "toolTipBorderRadius": "2",
                    "toolTipPadding": "5",
                    "showHoverEffect": "1",
                    "showLegend": "1",
                    "legendBgColor": "#ffffff",
                    "legendBorderAlpha": "0",
                    "legendShadow": "0",
                    "legendItemFontSize": "10",
                    "legendItemFontColor": "#666666",
                    "useDataPlotColorForLabels": "1"
                },
                "categories": [{"category" : rDataGroupingPlaceChart.category}],
                "dataset" : rDataGroupingPlaceChart.dataset
            }
        }).render();
    });
}
function PrepareGroupingPlaceDataToChart(dsMarineDebrisGroupingPlace, placeCount, rankingLimit) {
    let dataset = new Array();
    let rCategory = new Array();
    let rDataRanking = new Array();
    for(let i=0; i<rankingLimit; i++) { rDataRanking[i] = {"value" : 0}; }

    let iRanking = 0;
    let placeOrder = -1;
    let placeName = "This is null.";

    $.each(dsMarineDebrisGroupingPlace, function(index, value) {
        if(value.PlaceName == placeName) {
            if(iRanking < rankingLimit) {
                rDataRanking[iRanking][placeOrder] = {"value" : value.sumQty};
            }
        } else {
            if( (iRanking > 0) && (iRanking < rankingLimit) && (placeOrder >= 0) ) {
                for( ; iRanking < rankingLimit; iRanking++) { rDataRanking[iRanking][placeOrder] = {"value" : 0}; }
            }
            iRanking = 0;
            placeOrder++;
            placeName = value.PlaceName;

            rCategory.push({"label" : value.PlaceName});
            rDataRanking[iRanking][placeOrder] = {"value" : value.sumQty};
        }
        iRanking++;
    });
    for(let i = 0; i < rDataRanking.length; i++) {
        dataset.push({"seriesname" : "อันดับที่ " + (i+1), "data" : rDataRanking[i]});
    }
    result = {
        "category" : rCategory, 
        "dataset" : dataset, 
    };

    return result;
}
// ____________________________________________________________________________________________ End Render Charts.




// ____________________________________________________________________________________________ Table.
function renderTable(dsMarineDebrisSinglePlace, dsMarineDebrisGroupingPlace) {
    $('u#singlePlaceTableCaption').html("ตาราง แสดงข้อมูลปริมาณขยะทะเลใน"
        + rCaptionSinglePlaceChart['placeName']
        + " (ปีงบประมาณ " + rCaptionSinglePlaceChart['periodTime'] + ")");
    $('u#groupingPlaceTableCaption').html("เปรียบเทียบชนิดและปริมาณขยะทะเลใน"
        + rCaptionSinglePlaceChart['placeName']
        + " (ปีงบประมาณ " + rCaptionSinglePlaceChart['periodTime'] + ")");


    $('table#marineDebrisSinglePlaceTable > tbody').html(genTableSinglePlace(dsMarineDebrisSinglePlace));
    $('table#marineDebrisGroupingPlaceTable > tbody').html(genTableGroupPlace(dsMarineDebrisGroupingPlace));
}

// ----------- Generate Table SinglePlace Place.
function genTableSinglePlace(data) {
	let htmlTable = "";
    
    let rankingLimit = $("input[name='rankingLimit']:checked").val();
    let placeName = createTableCaptionMultiProvince();
    let summaryMarineDebrisQty = 0;
    let row;

    for(let i=0; i<data.length; i++) {
        row = data[i];

        htmlTable += genData(placeName, row["label"], row["value"], null, i+1);
        summaryMarineDebrisQty = parseInt(summaryMarineDebrisQty) + parseInt(row["value"]);

        placeName = "";
    }

    htmlTable += ( (rankingLimit == 10) 
        ? genSummary(summaryMarineDebrisQty, false, null)
        : genSummary(false, summaryMarineDebrisQty, null) );
    
    return htmlTable;
}
// ----------- End Generate Table Summary Place.
// ----------- Generate Table By Place.
function genTableGroupPlace(data) {
	let htmlTable = "";
    
    let rankingLimit = $("input[name='rankingLimit']:checked").val();
    let totalTopTenMarineDebrisQty = 0;
    let totalMarineDebrisQty = 0;
    let placeName = "";
    let placeOrder = 1;
    let iRanking = 0;
	let row;
	for(let i=0; i<data.length; i++) {
        row = data[i];

        if(row["PlaceName"] == placeName) {
            if(iRanking < rankingLimit) {
                row["PlaceName"] = "";
                htmlTable += genData(row["PlaceName"], row["Name"], row["sumQty"], "", iRanking+1);
                totalTopTenMarineDebrisQty = parseInt(totalTopTenMarineDebrisQty) + parseInt(row["sumQty"]);
            }
        } else {
            if(iRanking > 0) {
                htmlTable += genSummary( ((rankingLimit == 10) ? totalTopTenMarineDebrisQty : false)
                    , totalMarineDebrisQty, true);
                totalMarineDebrisQty = 0;
                totalTopTenMarineDebrisQty = 0;
            }

            iRanking = 0;
            placeName = row["PlaceName"];
            htmlTable += genData(row["PlaceName"], row["Name"], row["sumQty"], placeOrder++, iRanking+1);
            totalTopTenMarineDebrisQty = parseInt(totalTopTenMarineDebrisQty) + parseInt(row["sumQty"]);
        }
    
        totalMarineDebrisQty = parseInt(totalMarineDebrisQty) + parseInt(row["sumQty"]);
        iRanking++;
    }
    if(iRanking > 0) {
        htmlTable += genSummary( ((rankingLimit == 10) ? totalTopTenMarineDebrisQty : false)
            , totalMarineDebrisQty, true);
    }

    return htmlTable;
}
// ----------- End Generate Table By Place.

// ----------- End Generate Table Row.
function genData(placeName, marineDebrisName, marineDebrisQty, placeOrder, marineDebrisOrder) {
	let htmlTable;

    htmlTable +='<tr>';
    htmlTable +=((placeOrder === null) ? '' : '<td class="text-right">' + placeOrder + '</td>');
    htmlTable +='<td class="text-left">' + placeName + '</td>';
    htmlTable +='<td class="text-right">' + marineDebrisOrder + '.</td>';
    htmlTable +='<td class="text-left">' + marineDebrisName + '</td>';
	htmlTable +='<td class="text-right">' + marineDebrisQty.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '</td>';
	htmlTable +='</tr>';

	return htmlTable;
}
function genSummary(summaryTopTenMarineDebrisQty, summaryMarineDebrisQty, showPlaceOrder) {
	let htmlTable;
    // Top 10 marine debris.
    if(summaryTopTenMarineDebrisQty != false) {
        htmlTable +='<tr class="bg-warning color-table-sum">';
        htmlTable +=((showPlaceOrder) ? '<td class="text-right"></td>' : '');
        htmlTable +='<td class="text-left"></td>';
        htmlTable +='<td class="text-right"></td>';
        htmlTable +='<td class="text-left">';
        htmlTable +='<h5><u><mark><strong><em>';
        htmlTable +='<abbr>';
        htmlTable +='ผลรวมปริมาณขยะ 10 อันดับแรก';
        htmlTable +='</abbr>';
        htmlTable +='</em></strong></mark></u><h5>';
        htmlTable +='</td>';
        htmlTable +='<td class="text-right">' 
        htmlTable +='<h5><u><mark><strong><em>';
        htmlTable +='<abbr title="Total Top 10 marine debris">';
        htmlTable +=summaryTopTenMarineDebrisQty.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
        htmlTable +='</abbr>';
        htmlTable +='</em></strong></mark></u><h5>';
        htmlTable +='</td>';
        htmlTable +='</tr>';
    }
    // Top 10 marine debris.
    if(summaryMarineDebrisQty != false) {
        htmlTable +='<tr class="bg-warning color-table-sum">';
        htmlTable +=((showPlaceOrder) ? '<td class="text-right"></td>' : '');
        htmlTable +='<td class="text-left"></td>';
        htmlTable +='<td class="text-right"></td>';
        htmlTable +='<td class="text-left">';
        htmlTable +='<h5><u><mark><strong><em>';
        htmlTable +='<abbr>';
        htmlTable +='ผลรวมปริมาณขยะทั้งหมด';
        htmlTable +='</abbr>';
        htmlTable +='</em></strong></mark></u><h5>';
        htmlTable +='</td>';
        htmlTable +='<td class="text-right">' 
        htmlTable +='<h5><u><mark><strong><em>';
        htmlTable +='<abbr title="Total marine debris">';
        htmlTable +=summaryMarineDebrisQty.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
        htmlTable +='</abbr>';
        htmlTable +='</em></strong></mark></u><h5>';
        htmlTable +='</td>';
        htmlTable +='</tr>';
    }
	
	return htmlTable;
}
// ----------- End Generate Table Row.
// ____________________________________________________________________________________________ End Table.
// &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& End Render.
// ******************************************************************************************** End Method.
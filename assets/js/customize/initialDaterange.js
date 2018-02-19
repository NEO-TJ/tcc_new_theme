// -------------------------------------------------------------------------------------------- Init DatetimePicker.
function initDaterange() {
    let fiscalYear = getRangesArray();
    let start = fiscalYear.currentFiscalYear[0];
    let end = fiscalYear.currentFiscalYear[1];

    function cb(start, end) {
        $('#daterange span').html(start.format('MMMM D, YYYY') + '  ---  ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: fiscalYear.rRanges,
    }, cb);

    cb(start, end);
}
// -------------------------------------------------------------------------------------------- End Init DatetimePicker.

function getRangesArray() {
    let fiscalYearRelate = getFiscalYearRelate();
    let rRanges = {'เดือนนี้': [moment().startOf('month'), moment().endOf('month')]}

    for(let i = 0; i < 10; i++) {
        rRanges["ปีงบประมาณ " + (Number("2561") + Number(fiscalYearRelate - i))]
            = [moment("10-01-" + (Number("2017") + Number(fiscalYearRelate - i)), "MM-DD-YYYY")
            , moment("09-30-" + (Number("2018") + Number(fiscalYearRelate - i)), "MM-DD-YYYY")];
    }

    let result = {
        "rRanges" : rRanges,
        "currentFiscalYear" : [moment("10-01-" + (Number("2017") + Number(fiscalYearRelate)), "MM-DD-YYYY")
                            , moment("09-30-" + (Number("2018") + Number(fiscalYearRelate)), "MM-DD-YYYY")]
    };

    return result;
}

function getFiscalYearRelate(){
    let d1 = moment("10-01-2018", "MM-DD-YYYY");
    let d2 = moment();
    let years = moment(d1).diff(d2, 'years');

    return years;
}
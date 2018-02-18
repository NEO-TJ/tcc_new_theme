// -------------------------------------------------------------------------------------------- Init DatetimePicker.
function initDaterange() {
    let start = moment("10-01-2017", "MM-DD-YYYY");
    let end = moment("09-30-2018", "MM-DD-YYYY");

    function cb(start, end) {
        $('#daterange span').html(start.format('MMMM D, YYYY') + '  ---  ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],

            'ปีงบประมาณ 2561'
                : [moment("10-01-2017", "MM-DD-YYYY"), moment("09-30-2018", "MM-DD-YYYY")],
            'ปีงบประมาณ 2560'
                : [moment("10-01-2016", "MM-DD-YYYY"), moment("09-30-2017", "MM-DD-YYYY")],
            'ปีงบประมาณ 2559'
                : [moment("10-01-2015", "MM-DD-YYYY"), moment("09-30-2016", "MM-DD-YYYY")],
            'ปีงบประมาณ 2558'
                : [moment("10-01-2014", "MM-DD-YYYY"), moment("09-30-2015", "MM-DD-YYYY")],
            'ปีงบประมาณ 2557'
                : [moment("10-01-2013", "MM-DD-YYYY"), moment("09-30-2014", "MM-DD-YYYY")],
            'ปีงบประมาณ 2556'
                : [moment("10-01-2012", "MM-DD-YYYY"), moment("09-30-2013", "MM-DD-YYYY")],
            'ปีงบประมาณ 2555'
                : [moment("10-01-2011", "MM-DD-YYYY"), moment("09-30-2012", "MM-DD-YYYY")],
            'ปีงบประมาณ 2554'
                : [moment("10-01-2010", "MM-DD-YYYY"), moment("09-30-2011", "MM-DD-YYYY")],
            'ปีงบประมาณ 2553'
                : [moment("10-01-2009", "MM-DD-YYYY"), moment("09-30-2010", "MM-DD-YYYY")],
            'ปีงบประมาณ 2552'
                : [moment("10-01-2008", "MM-DD-YYYY"), moment("09-30-2009", "MM-DD-YYYY")],
            'ปีงบประมาณ 2551'
                : [moment("10-01-2007", "MM-DD-YYYY"), moment("09-30-2008", "MM-DD-YYYY")],
        }
    }, cb);

    cb(start, end);
}
// -------------------------------------------------------------------------------------------- End Init DatetimePicker.
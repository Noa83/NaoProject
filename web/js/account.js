
    $( function() {


        var array = ["12-25","05-01","11-01"];

        $( ".date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"

        }).attr("readonly","readonly")
    });
function setDatePicker(){
    $(".datepicker").datetimepicker({
        format: "DD-MM-YYYY",
        useCurrent: false,
    })
}

function setDateRangePicker(input1, input2){
    $(input1).datetimepicker({
        format: "DD-MM-YYYY",
        useCurrent: false
    })

    $(input1).on("change.datetimepicker", function (e) {
        $(input2).val("")
        $(input2).datetimepicker('minDate', e.date);
    })

    $(input2).datetimepicker({
        format: "DD-MM-YYYY",
        useCurrent: false
    })
}

function setMonthPicker(){
    $(".monthpicker").datetimepicker({
        format: "MM",
        useCurrent: false,
        viewMode: "months"
    })
}

function setYearPicker(){
    $(".yearpicker").datetimepicker({
        format: "YYYY",
        useCurrent: false,
        viewMode: "years"
    })
}

function setYearRangePicker(input1, input2){
    $(input1).datetimepicker({
        format: "YYYY",
        useCurrent: false,
        viewMode: "years"
    })

    $(input1).on("change.datetimepicker", function (e) {
        $(input2).val("")
        $(input2).datetimepicker('minDate', e.date);
    })

    $(input2).datetimepicker({
        format: "YYYY",
        useCurrent: false,
        viewMode: "years"
    })
}

function setMonthRangePicker(input1, input2){
    $(input1).datetimepicker({
        format: "MM",
        useCurrent: false,
        viewMode: "months"
    })

    $(input1).on("change.datetimepicker", function (e) {
        $(input2).val("")
        $(input2).datetimepicker('minDate', e.date);
    })

    $(input2).datetimepicker({
        format: "MM",
        useCurrent: false,
        viewMode: "months"
    })
}

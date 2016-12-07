// Restrict Weekends and Past Dates in jQuery DatePicker
$('.datepicker').datepicker({
    minDate: 0,
    beforeShowDay: $.datepicker.noWeekends
});
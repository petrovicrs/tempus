$(document).ready(function() {
    var locale = $('html').attr('lang'),
        language;
    if (locale == 'sr') {
        language = 'sr';
    } else if (locale == 'lat') {
        language = 'sr-latin';
    } else {
        language = 'en-GB';
    }
    $('.js-datepicker').datepicker({
        format: "dd.mm.yyyy",
        weekStart: 1,
        maxViewMode: 0,
        todayBtn: "linked",
        clearBtn: true,
        language: language
    });
});
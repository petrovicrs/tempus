function initCollectionElement() {
    var numItems = $('.jquery-collection-element').length;
    if (numItems) {
        $('.jquery-collection-element').collection({
            up: '<a href="#" class="btn btn-default"><span class="fa fa-arrow-up"></span></span></a>',
            down: '<a href="#" class="btn btn-default"><span class="fa fa-arrow-down"></span></span></a>',
            add: '<a href="#" class="btn btn-default"><span class="fa fa-plus-circle"></span></a>',
            remove: '<a href="#" class="btn btn-default"><span class="fa fa-trash-o"></span></a>',
            allow_up: false,
            allow_down: false,
            allow_duplicate: false
        });
    }
}

function initSelect2() {
    var locale = $('html').attr('lang'),
        language;
    if (locale == 'sr') {
        language = 'sr-Cyrl';
    } else if (locale == 'lat') {
        language = 'sr';
    } else {
        language = 'en';
    }
    $('.jquery-select2-element').select2({
        language: language
    });
}
$(document).ready(function() {
    initCollectionElement();
    initSelect2();
});

$(function() {
    var collapsibleTriggers = $('[data-collapsible-open]');

    $.each(collapsibleTriggers, function(i) {
        if(i !== 0) {
            $('[data-collapsible-close=' + i + ']').find('.details-wrapper-inner').hide();
        }
    });

    collapsibleTriggers.on('click', function() {
        var index = $(this).data('collapsible-open');
        $('[data-collapsible-close=' + index + ']').find('.details-wrapper-inner').slideToggle();
    });
});
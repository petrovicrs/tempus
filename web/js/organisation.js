$(function()
{
    var i = 1, j = 0;

    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var currentEntry = $(this).parents('.entry:first'),
        newEntry = $(currentEntry.clone()).appendTo("#vat-fields");
        newEntry.find(".form-control")[0].setAttribute("id", "form-control-vat-" + i);
        newEntry.find(".validated-vat")[0].setAttribute("id", "validated-vat-" + i);
        newEntry.find(".radio-vat")[0].setAttribute("id", "radio-vat-" + i);

        newEntry.find('input').val('');
        $("#vat-fields").find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
        i++;
    }).on('click', '.btn-remove', function(e)
    {
        $(this).parents('.entry:first').remove();

        i--;

        e.preventDefault();
        return false;
    });

    $(document).on('click', '.btn-add-contact', function(e)
    {
        e.preventDefault();

        var currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo("#contact-fields");

        // newEntry.find(".form-control")[0].setAttribute("id", "form-control-vat" + i);
        // newEntry.find(".validated-vat")[0].setAttribute("id", "validated-vat-" + i);
        // newEntry.find(".radio-vat")[0].setAttribute("id", "radio-vat-" + i);

        newEntry.find('input').val('');
        $("#contact-fields").find('.entry:not(:last) .btn-add-contact')
            .removeClass('btn-add-contact').addClass('btn-remove-contact')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove-contact', function(e)
    {
        $(this).parents('.entry:first').remove();

        e.preventDefault();
        return false;
    });
});
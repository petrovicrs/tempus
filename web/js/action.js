

jQuery(document).ready(function() {
    initActivityForm();
});

function initActivityForm() {
    var $addLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add</a>');
    var $addLinkDiv = $('<li></li>').append($addLink);

    var $collectionHolder = $('ul.activities');

    $collectionHolder.find('li').each(function() {
        $addFormDeleteLink($(this));
        if($(this).parent().hasClass('action-details') && $(this).is(':last-child')) {
            var $addLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add</a>');
            var $addLinkDiv = $('<li></li>').append($addLink);

            var $collectionHolder = $(this).parent();
            $collectionHolder.append($addLinkDiv);

            $collectionHolder.data('index', $collectionHolder.find(':input').length);

            $addLink.on('click', function(e) {
                // prevent the link from creating a "#" on the URL
                e.preventDefault();
                // add a new tag form (see code block below)
                $addActionDetailsForm($collectionHolder, $addLinkDiv);

                $('.selectpicker').selectpicker('render');
            });
        }
    });

    $collectionHolder.append($addLinkDiv);
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    // if($collectionHolder.data('purpose') == 'edit') {
    //     $addActivityForm($collectionHolder, $addLinkDiv, 'activities');
    // }

    $addLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // add a new tag form (see code block below)
        $addActivityForm($collectionHolder, $addLinkDiv);
    });
}

function $addActivityForm($collectionHolder, $addLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    // get the new index
    var index = $collectionHolder.data('index');
    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/(activities|activities]\[)(__name__)/gm, "$1" + index);
    // var newForm = prototype.replace(/__name__/g, index);
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);
    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove</a>');

    $addLinkDiv.before($newFormDiv);

    initActionDetailsForm($collectionHolder);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();
        $(this).parent().remove();

        return false;
    });
}

function initActionDetailsForm(parent) {
    var $addLink = $('<a href="#" class="btn btn-add btn-success "><span aria-hidden="true"></span>add</a>');
    var $addLinkDiv = $('<li></li>').append($addLink);

    // var $collectionHolder = $('ul.action-details');
    var $collectionHolder = parent.children().eq(-2).find('ul.action-details');

    $collectionHolder.find('li').each(function() {
        $addFormDeleteLink($(this));
    });

    $collectionHolder.append($addLinkDiv);
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // add a new tag form (see code block below)
        $addActionDetailsForm($collectionHolder, $addLinkDiv);

        $('.selectpicker').selectpicker('render');
    });
}

function $addActionDetailsForm($collectionHolder, $addLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    // get the new index
    var index = $collectionHolder.data('index');
    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    // var newForm = prototype.replace(/__name__/g, index);
    var newForm = prototype.replace(/(actionDetails|actionDetails]\[)(__name__)/gm, "$1" + index);
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<li></li>').append(newForm);
    // also add a remove button, just for this example
    $newFormDiv.append('<a href="#" class="btn btn-remove btn-danger"><span aria-hidden="true"></span>remove</a>');

    $addLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.btn-remove').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function $addFormDeleteLink($formDiv) {
    var $removeFormA = $('<a href="#">delete</a>');
    $formDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $formDiv.remove();
    });
}

function addDays(event) {
    var daysWithoutTravel = $(this).parent().find('.days_without_travel').find('input').val();
    var daysTravel = $(this).parent().find('.days_travel').find('input').val();

    if (daysWithoutTravel) {
        daysWithoutTravel = parseInt(daysWithoutTravel);
    } else {
        daysWithoutTravel = parseInt(0);
    }

    if (daysTravel) {
        daysTravel = parseInt(daysTravel);
    } else {
        daysTravel = parseInt(0);
    }

    var totalDays = daysTravel + daysWithoutTravel;

    $(this).parent().find('.days_total').find('input').val(parseInt(totalDays));
}
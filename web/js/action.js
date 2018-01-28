var $addActionActivityLink = $('<a href="#" class="action-activity btn btn-add btn-success"><span aria-hidden="true"></span>Add activity</a>');
var $newLinkLi = $('<li></li>').append($addActionActivityLink);

var $addActionDetailsLink = $('<a href="#" class="action-details btn btn-add btn-success"><span aria-hidden="true"></span>Add a action detail</a>');
var $newActionDetailsLinkLi = $('<li></li>').append($addActionDetailsLink);

jQuery(document).ready(function() {
    var $activityCollectionHolder = $('div.activities');
    // Get the ul that holds the collection of tags
    var $actionDetailsCollectionHolder = $('ul.action-details');

    // add a delete link to all of the existing tag form li elements
    $actionDetailsCollectionHolder.find('li').each(function() {
        addFormDeleteLink($(this));
    });

    $activityCollectionHolder.find('li').each(function() {
        addFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $actionDetailsCollectionHolder.append($newActionDetailsLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $actionDetailsCollectionHolder.data('index', $actionDetailsCollectionHolder.find(':input').length);

    // Load one on page load if not edit
    if($actionDetailsCollectionHolder.data('purpose') !== 'edit') {
        addForm($actionDetailsCollectionHolder, $newActionDetailsLinkLi);
    }

    $addActionDetailsLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addForm($actionDetailsCollectionHolder, $newActionDetailsLinkLi);
    });
});

function addForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-action btn btn-remove btn-danger"><span aria-hidden="true"></span>Remove Action Details</a>');

    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-action').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addFormDeleteLink($contactFormLi) {
    var $removeFormA = $('<a href="#">delete</a>');
    $contactFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormLi.remove();
    });
}

function addActionDetailsForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-action btn btn-remove btn-danger">Remove</a>');

    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-action').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addActionDetailsFormDeleteLink($contactFormLi) {
    var $removeFormA = $('<a href="#">delete this action</a>');
    $contactFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $contactFormLi.remove();
    });
}